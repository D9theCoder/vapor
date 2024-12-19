<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Flood Map</title>
  <link href='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.css' rel='stylesheet' />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
  <style>
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    #map {
      height: 100vh;
      width: 100%;
      position: relative;
      z-index: 1;
    }

    .navbar {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 60px;
      background-color: #333;
      color: white;
      display: flex;
      align-items: center;
      padding: 0 20px;
      transition: transform 0.3s ease-in-out;
      z-index: 1000;
    }

    .navbar.hidden {
      transform: translateY(-100%);
    }

    #leftPopup {
      position: fixed;
      left: 30px;
      top: 80px;
      width: 300px;
      background-color: rgba(171, 156, 239, 0.6);
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
      z-index: 1000;
      overflow: hidden;
      display: none;
      transition: all 0.3s ease-in-out;
      transform: translateX(-320px);
    }

    #leftPopup.visible {
      transform: translateX(0);
    }

    #leftPopup h3 {
      margin: 0;
      padding: 15px;
      background-color: #6366f1;
      color: white;
      font-size: 18px;
    }

    #leftPopup .content {
      padding: 15px;
    }

    #cityDetailsPopup {
      margin-top: 10px;
      background-color: rgba(171, 156, 239, 0.6);
      border-radius: 8px;
      padding: 10px;
      display: none;
    }

    .marker {
      background-color: #6366f1;
      width: 24px;
      height: 24px;
      border-radius: 50%;
      border: 2px solid #fff;
      cursor: pointer;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
      display: flex;
      justify-content: center;
      align-items: center;
      color: white;
      font-size: 14px;
    }

    .detail-marker {
      width: 18px;
      height: 18px;
      border-radius: 50%;
      border: 2px solid #fff;
      cursor: pointer;
      box-shadow: 0 0 8px rgba(0, 0, 0, 0.3);
    }

    .toggle-button {
      background-color: #4CAF50;
      border: none;
      color: white;
      padding: 10px 20px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      border-radius: 4px;
    }

    @media (max-width: 1024px) {
      #leftPopup {
        left: 30px;
        width: 300px;
        max-width: none;
      }

      .weather-item {
        font-size: 14px;
      }
    }
  </style>
</head>

<body>
  <div id="map"></div>
  <div id="leftPopup">
    <h3 id="popupTitle"></h3>
    <div id="popupContent" class="content"></div>
    <div id="cityDetailsPopup"></div>
    <div id="weatherPopup" style="display: none;"></div>
    <button id="toggleButton" class="toggle-button" style="display: none;">Weather Check</button>
  </div>

  <script src='https://api.mapbox.com/mapbox-gl-js/v2.14.1/mapbox-gl.js'></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Flood locations
      fetch('/api/flood-locations')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
          }
          return response.json();
        })
        .then(data => {
          window.floodLocations = data.map(location => ({
            lnglat: [location.longitude, location.latitude],
            city: location.city,
            count: location.count
          }));

          requestGeolocation();
        })
        .catch(error => console.error('Error fetching flood locations:', error));

      // Fetch city details
      fetch('/api/city-details')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
          }
          return response.json();
        })
        .then(data => {
          window.cityDetails = data;
        })
        .catch(error => {
          console.error('Error fetching city details:', error);
        });

      function requestGeolocation() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            position => {
              const userCoordinates = [position.coords.longitude, position.coords.latitude];

              // Center the map on the user's location
              map.setCenter(userCoordinates);
              map.setZoom(12);

              // Add or update the circle layer for user's location
              if (map.getSource('user-location')) {
                map.getSource('user-location').setData({
                  type: 'FeatureCollection',
                  features: [{
                    type: 'Feature',
                    geometry: {
                      type: 'Point',
                      coordinates: userCoordinates
                    }
                  }]
                });
              } else {
                map.addSource('user-location', {
                  type: 'geojson',
                  data: {
                    type: 'FeatureCollection',
                    features: [{
                      type: 'Feature',
                      geometry: {
                        type: 'Point',
                        coordinates: userCoordinates
                      }
                    }]
                  }
                });

                map.addLayer({
                  id: 'user-location-circle',
                  type: 'circle',
                  source: 'user-location',
                  paint: {
                    'circle-radius': 10,
                    'circle-color': '#007cbf',
                    'circle-opacity': 0.8
                  }
                });
              }

              // Get the nearest flood location
              const nearest = getNearestFloodLocation(userCoordinates);

              // Add or update marker for user's location
              if (window.userMarker) {
                window.userMarker.setLngLat(userCoordinates);
              } else {
                const el = document.createElement('div');
                el.className = 'marker';
                el.innerHTML = '<i class="fas fa-user"></i>';
                el.style.backgroundColor = getMarkerColor(nearest.indeksBanjir);

                window.userMarker = new mapboxgl.Marker(el)
                  .setLngLat(userCoordinates)
                  .addTo(map);

                // Add click event to user marker
                window.userMarker.getElement().addEventListener('click', () => {
                  showUserLocationPopup(userCoordinates, nearest);
                });
              }

              // Show user location popup
              showUserLocationPopup(userCoordinates, nearest);
            },
            error => {
              console.error('Geolocation error:', error);
              alert('Unable to retrieve your location. Please enable location services and refresh the page.');
            }, {
              enableHighAccuracy: true,
              timeout: 5000,
              maximumAge: 0
            }
          );
        } else {
          console.error('Geolocation is not supported by this browser.');
          alert('Geolocation is not supported by your browser. Some features may not work correctly.');
        }
      }

      async function fetchWeatherData(lat, lon) {
        const apiKey = '3d3081b6edd1db1586dd4ae459aeab56';
        const url =
          `http://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`;

        try {
          const response = await fetch(url);
          const data = await response.json();

          const forecastList = data.list.slice(0, 4).map(item => ({
            datetime: item.dt_txt,
            temperature: item.main.temp,
            description: item.weather[0].description,
            icon: item.weather[0].icon
          }));

          return forecastList;
        } catch (error) {
          console.error('Error fetching weather data:', error);
          throw error;
        }
      }

      mapboxgl.accessToken =
        'pk.eyJ1IjoiZG9kb3hkIiwiYSI6ImNtMXNzc3o2eDBham0ya3BybjAzdHh6dTUifQ.j4wY9CcmmjYGbPizv6b-Dg';

      // Define a default map view in case geolocation fails
      let defaultCoordinates = [106.8456, -6.2088]; // Jakarta coordinates
      let zoomLevel = 10;

      // Create the map
      const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/dark-v11',
        center: defaultCoordinates,
        zoom: zoomLevel,
        pitch: 45,
        bearing: -17.6,
        projection: 'globe'
      });

      // Try to get the user's current location using Geolocation API
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(position => {
          const userCoordinates = [position.coords.longitude, position.coords.latitude];

          // Center the map on the user's location
          map.setCenter(userCoordinates);
          map.setZoom(12);

          // Add a circle layer to indicate user's location
          map.addSource('user-location', {
            type: 'geojson',
            data: {
              type: 'FeatureCollection',
              features: [{
                type: 'Feature',
                geometry: {
                  type: 'Point',
                  coordinates: userCoordinates
                }
              }]
            }
          });

          map.addLayer({
            id: 'user-location-circle',
            type: 'circle',
            source: 'user-location',
            paint: {
              'circle-radius': 10,
              'circle-color': '#007cbf',
              'circle-opacity': 0.8
            }
          });

          // Get the nearest flood location
          const nearest = getNearestFloodLocation(userCoordinates);

          // Add a marker for user's location
          const el = document.createElement('div');
          el.className = 'marker';
          el.innerHTML = '<i class="fas fa-user"></i>';
          el.style.backgroundColor = getMarkerColor(nearest.indeksBanjir);

          const userMarker = new mapboxgl.Marker(el)
            .setLngLat(userCoordinates)
            .addTo(map);

          // Show user location popup
          showUserLocationPopup(userCoordinates, nearest);

          // Add click event to user marker
          userMarker.getElement().addEventListener('click', () => {
            showUserLocationPopup(userCoordinates, nearest);
          });

        }, error => {
          console.error('Geolocation error:', error);
          // If error occurs or permission is denied, the map will default to Jakarta
        });
      } else {
        console.error('Geolocation is not supported by this browser.');
        // If geolocation isn't available, the map stays at the default center
      }

      // Make sure these functions are defined earlier in your script

      function getNearestFloodLocation(userCoords) {
        let nearest = null;
        let minDistance = Infinity;

        for (const city in cityDetails) {
          cityDetails[city].forEach(location => {
            const distance = getDistance(userCoords, location.lnglat);
            if (distance < minDistance) {
              minDistance = distance;
              nearest = location;
            }
          });
        }

        return nearest;
      }

      function getDistance(coord1, coord2) {
        const [lon1, lat1] = coord1;
        const [lon2, lat2] = coord2;
        const R = 6371; // Radius of the Earth in km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
          Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
          Math.sin(dLon / 2) * Math.sin(dLon / 2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c;
      }

      function getMarkerColor(index) {
        if (index >= 2.0) return "#FF0000";
        if (index >= 1.5) return "#FFA500";
        return "#00FF00";
      }

      function showUserLocationPopup(userCoords, nearest) {
        closeAllPopups(); // Tutup semua popup ketika membuka lokasi pengguna
        const popupTitle = document.getElementById('popupTitle');
        const popupContent = document.getElementById('popupContent');
        const leftPopup = document.getElementById('leftPopup');
        const toggleButton = document.getElementById('toggleButton');

        popupTitle.textContent = "Your Location";
        popupContent.innerHTML = `
            <p><i class="fas fa-map-marker-alt"></i> Coordinates: ${userCoords[1].toFixed(4)}, ${userCoords[0].toFixed(4)}</p>
            <p><i class="fas fa-tint"></i> Nearest Flood Index: ${nearest.indeksBanjir}</p>
            <p><i class="fas fa-exclamation-triangle"></i> Category: ${nearest.kategori}</p>
            <p><i class="fas fa-info-circle"></i> Nearest Location: ${nearest.kelurahan}</p>
        `;
        leftPopup.style.display = 'block';
        leftPopup.classList.add('visible');
        toggleButton.style.display = 'block';
        toggleButton.textContent = 'Weather Check';

        // Store the current location for weather checking
        currentDetail = {
          lnglat: userCoords,
          kelurahan: "Your Location"
        };
      }

      map.on('load', () => {
        // Add 3D building layer (unchanged)
        map.addLayer({
          'id': '3d-buildings',
          'source': 'composite',
          'source-layer': 'building',
          'filter': ['==', 'extrude', 'true'],
          'type': 'fill-extrusion',
          'minzoom': 15,
          'paint': {
            'fill-extrusion-color': '#aaa',
            'fill-extrusion-height': [
              "interpolate", ["linear"],
              ["zoom"],
              15, 0,
              15.05, ["get", "height"]
            ],
            'fill-extrusion-opacity': .6
          }
        });

        // Add markers for flood locations (unchanged)
        floodLocations.forEach((location) => {
          const el = document.createElement('div');
          el.className = 'marker';
          el.innerHTML = `<i class="fas fa-water"></i>`;

          const marker = new mapboxgl.Marker(el)
            .setLngLat(location.lnglat)
            .addTo(map);

          marker.getElement().addEventListener('click', () => {
            showFloodLocationPopup(location);
          });
        });
        requestGeolocation();
      });
      const detailMarkers = [];
      let currentCity = null;
      let currentDetail = null;

      function showFloodLocationPopup(location) {
        closeAllPopups(true); // Tutup semua popup kecuali lokasi pengguna
        const popupTitle = document.getElementById('popupTitle');
        const popupContent = document.getElementById('popupContent');
        const leftPopup = document.getElementById('leftPopup');
        const cityDetailsPopup = document.getElementById('cityDetailsPopup');

        if (!popupTitle || !popupContent || !leftPopup || !cityDetailsPopup) {
          console.error('One or more required DOM elements are missing');
          return;
        }

        popupTitle.textContent = location.city;

        // Count areas with indeksBanjir >= 1.5
        const significantRiskCount = cityDetails[location.city].filter(detail => detail.indeksBanjir >= 1.5).length;

        popupContent.innerHTML = `
                    <p><i class="fas fa-map-marker-alt"></i> Total Lokasi: ${cityDetails[location.city].length}</p>
                    <p><i class="fas fa-exclamation-triangle"></i> Lokasi Berisiko Signifikan: ${significantRiskCount}</p>
                    <p><i class="fas fa-info-circle"></i> Klik pada marker berwarna untuk informasi lebih lanjut.</p>
                `;
        leftPopup.style.display = 'block';
        leftPopup.classList.add('visible');

        map.flyTo({
          center: location.lnglat,
          zoom: 11,
          essential: true
        });

        // Clear previous markers
        detailMarkers.forEach((marker) => marker.remove());
        detailMarkers.length = 0;

        cityDetails[location.city].forEach((detail) => {
          const el = document.createElement('div');
          el.className = 'detail-marker';
          el.style.backgroundColor = detail.indeksBanjir >= 2.0 ? "#FF0000" :
            detail.indeksBanjir >= 1.5 ? "#FFA500" : "#00FF00";

          const marker = new mapboxgl.Marker(el)
            .setLngLat(detail.lnglat)
            .addTo(map);

          marker.getElement().addEventListener('click', () => {
            showCityDetailPopup(detail);
          });

          detailMarkers.push(marker);
        });

        currentCity = location.city;
      }


      function showCityDetailPopup(detail) {
        const cityDetailsPopup = document.getElementById('cityDetailsPopup');
        const weatherPopup = document.getElementById('weatherPopup');
        const toggleButton = document.getElementById('toggleButton');

        currentDetail = detail;

        cityDetailsPopup.innerHTML = `
                    <strong>Kelurahan : ${detail.kelurahan}</strong>
                    <p><i class="fas fa-tint"></i> Indeks Banjir: ${detail.indeksBanjir}</p>
                    <p><i class="fas fa-exclamation-triangle"></i> Kategori: ${detail.kategori}</p>
                `;
        cityDetailsPopup.style.display = 'block';
        weatherPopup.style.display = 'none';
        toggleButton.style.display = 'block';
        toggleButton.textContent = 'Weather Check';

        cityDetailsPopup.style.opacity = '0';
        cityDetailsPopup.style.transform = 'translateY(20px)';
        setTimeout(() => {
          cityDetailsPopup.style.transition = 'all 0.3s ease-in-out';
          cityDetailsPopup.style.opacity = '1';
          cityDetailsPopup.style.transform = 'translateY(0)';
        }, 50);
      }


      function isMobileView() {
        return window.innerWidth <= 1024;
      }

      function showWeatherPopup(detail) {
        const weatherPopup = document.getElementById('weatherPopup');
        weatherPopup.innerHTML = '<p>Loading weather data...</p>';
        weatherPopup.style.display = 'block';

        fetchWeatherData(detail.lnglat[1], detail.lnglat[0]).then(forecast => {
          const forecastHours = isMobileView() ? 6 : 12;
          const forecastItems = isMobileView() ? forecast.slice(0, 2) : forecast;

          weatherPopup.innerHTML = `<h5>Weather Forecast (Next ${forecastHours} hours):</h5>`;
          if (forecastItems.length) {
            forecastItems.forEach(item => {
              const weatherItem = document.createElement('div');
              weatherItem.className = 'weather-item';
              weatherItem.innerHTML = `
                                <img src="http://openweathermap.org/img/wn/${item.icon}.png" alt="${item.description}">
                                <div>
                                    <p>${item.datetime}</p>
                                    <p>${item.temperature.toFixed(1)}°C, ${item.description}</p>
                                </div>
                            `;
              weatherPopup.appendChild(weatherItem);
            });
          } else {
            weatherPopup.innerHTML += '<p>No forecast data available.</p>';
          }
        }).catch(err => {
          console.error('Failed to fetch weather data:', err);
          weatherPopup.innerHTML = '<p>Error fetching weather data.</p>';
        });
      }

      const toggleButton = document.getElementById('toggleButton');
      toggleButton.addEventListener('click', () => {
        const cityDetailsPopup = document.getElementById('cityDetailsPopup');
        const weatherPopup = document.getElementById('weatherPopup');

        if (weatherPopup.style.display === 'none') {
          weatherPopup.style.display = 'block';
          toggleButton.textContent = 'Show Details';
          showWeatherPopup(currentDetail);
        } else {
          weatherPopup.style.display = 'none';
          if (currentDetail.kelurahan === "Your Location") {
            const userCoords = currentDetail.lnglat;
            const nearest = getNearestFloodLocation(userCoords);
            showUserLocationPopup(userCoords, nearest);
          } else {
            showCityDetailPopup(currentDetail);
          }
        }
      });

      let lastScrollTop = 0;
      const navbar = document.querySelector('.navbar');

      window.addEventListener('scroll', () => {
        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        if (scrollTop > lastScrollTop) {
          navbar.classList.add('hidden');
        } else {
          navbar.classList.remove('hidden');
        }
        lastScrollTop = scrollTop;
      });
    });

    function getNearestFloodLocation(userCoords) {
      let nearest = null;
      let minDistance = Infinity;

      for (const city in cityDetails) {
        cityDetails[city].forEach(location => {
          const distance = getDistance(userCoords, location.lnglat);
          if (distance < minDistance) {
            minDistance = distance;
            nearest = location;
          }
        });
      }

      return nearest;
    }

    function getDistance(coord1, coord2) {
      const [lon1, lat1] = coord1;
      const [lon2, lat2] = coord2;
      const R = 6371; // Radius of the Earth in km
      const dLat = (lat2 - lat1) * Math.PI / 180;
      const dLon = (lon2 - lon1) * Math.PI / 180;
      const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
        Math.sin(dLon / 2) * Math.sin(dLon / 2);
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
      return R * c;
    }

    function getMarkerColor(index) {
      if (index >= 2.0) return "#FF0000";
      if (index >= 1.5) return "#FFA500";
      return "#00FF00";
    }

    function showUserLocationPopup(userCoords, nearest) {
      closeAllPopups();
      const popupTitle = document.getElementById('popupTitle');
      const popupContent = document.getElementById('popupContent');
      const leftPopup = document.getElementById('leftPopup');
      const toggleButton = document.getElementById('toggleButton');

      popupTitle.textContent = "Your Location";
      popupContent.innerHTML = `
                <p><i class="fas fa-map-marker-alt"></i> Coordinates: ${userCoords[1].toFixed(4)}, ${userCoords[0].toFixed(4)}</p>
                <p><i class="fas fa-tint"></i> Nearest Flood Index: ${nearest.indeksBanjir}</p>
                <p><i class="fas fa-exclamation-triangle"></i> Category: ${nearest.kategori}</p>
                <p><i class="fas fa-info-circle"></i> Nearest Location: ${nearest.kelurahan}</p>
            `;
      leftPopup.style.display = 'block';
      leftPopup.classList.add('visible');
      toggleButton.style.display = 'block';
      toggleButton.textContent = 'Weather Check';

      // Store the current location for weather checking
      currentDetail = {
        lnglat: userCoords,
        kelurahan: "Your Location"
      };
    }

    function closeAllPopups(exceptUser = false) {
      const leftPopup = document.getElementById('leftPopup');
      const cityDetailsPopup = document.getElementById('cityDetailsPopup');
      const weatherPopup = document.getElementById('weatherPopup');
      const toggleButton = document.getElementById('toggleButton');

      if (exceptUser) {
        // Hanya tutup popup yang bukan lokasi pengguna
        if (popupTitle.textContent !== "Your Location") {
          leftPopup.style.display = 'none';
        }
      } else {
        leftPopup.style.display = 'none';
      }

      cityDetailsPopup.style.display = 'none';
      weatherPopup.style.display = 'none';
      toggleButton.style.display = 'none';
    }
  </script>
</body>

</html>
