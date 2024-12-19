@extends('layouts.app')

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  @vite('resources/css/app.css')
  @vite('resources/js/app.js')
  <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <title>Document</title>
</head>

<body class="h-full" style="background-color: #eae8e0">
  <x-header />
  <main class="pb-8 max-lg:pt-4">
    <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:max-w-7xl lg:px-8">
      <section id="support-us" class="mt-8">
        <h2 class="sr-only">Support Us</h2>
        <div class="overflow-hidden rounded-lg bg-white shadow mb-8">
          <div class="p-6">
            <h1 class="text-3xl font-bold text-gray-800 mb-8">Support Our Flood Mapping Initiative</h1>

            @if (session('success'))
              <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4"
                role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
              </div>
            @endif

            {{-- If the user is not authenticated --}}
            @if (!Auth::check())
            <div class="grid md:grid-cols-2 gap-8">
              <!-- Report Flood -->
              <div class="bg-blue-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <h2 class="text-xl font-semibold text-blue-700 mb-4">Report Flood Incidents</h2>
                <p class="text-gray-600 mb-4">Your local insights are crucial. Help us keep our map accurate and
                  up-to-date.</p>
              </div>
            @elseif (Auth::user()->role == 'contributor')
              <div class="grid md:grid-cols-2 gap-8">
                <!-- Report Flood -->
                <div class="bg-blue-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                  <h2 class="text-xl font-semibold text-blue-700 mb-4">Report Flood Incidents</h2>
                  <p class="text-gray-600 mb-4">Your local insights are crucial. Help us keep our map accurate and
                    up-to-date.</p>
                  <button onclick="showModal('report-modal')"
                    class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                    Report Now
                  </button>
                </div>
            @elseif (Auth::user()->role == 'admin' || Auth::user()->role == 'superadmin' || Auth::user()->role == 'reporter')
            <div class="grid md:grid-cols-2 gap-8">
              <!-- Report Flood -->
              <div class="bg-red-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
                <h2 class="text-xl font-semibold text-red-700 mb-4">Submit Flood Incidents Point</h2>
                <p class="text-gray-600 mb-4">Your Submission will be shown on the map to inform other people</p>
                <button onclick="showModal('create-modal')"
                  class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                  Report Now
                </button>
              </div>
            @endif
            <!-- Share -->
            <div class="bg-green-50 p-6 rounded-lg shadow-md transition-all duration-300 hover:shadow-lg">
              <h2 class="text-xl font-semibold text-green-700 mb-4">Spread the Word</h2>
              <p class="text-gray-600 mb-4">Share our app and help build a more flood-resilient community.</p>
              <button onclick="showModal('share-modal')"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition-colors">
                Share Now
              </button>
            </div>
          </div>

          <!-- Impact Tracker -->
          {{-- <div class="mt-12 bg-gray-50 p-6 rounded-lg shadow-md">
              <h2 class="text-2xl font-semibold text-gray-800 mb-6">Our Collective Impact</h2>
              <div class="grid grid-cols-2 gap-4">
                <div class="text-center">
                  <span id="report-count" class="text-3xl font-bold text-blue-600">0</span>
                  <p class="text-sm text-gray-600">Flood Reports Submitted</p>
                </div>
                <div class="text-center">
                  <span id="share-count" class="text-3xl font-bold text-green-600">0</span>
                  <p class="text-sm text-gray-600">Times App Shared</p>
                </div>
              </div>
            </div> --}}

          <!-- Support Explanation -->
          <div class="mt-12">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">How Your Support Helps</h2>
            <div class="grid md:grid-cols-2 gap-6">
              <div class="bg-yellow-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-yellow-700 mb-2">Improved Accuracy</h3>
                <p class="text-gray-600">Your reports help us maintain an up-to-date and accurate flood map, crucial
                  for community safety.</p>
              </div>
              <div class="bg-purple-50 p-4 rounded-lg">
                <h3 class="text-lg font-semibold text-purple-700 mb-2">Wider Reach</h3>
                <p class="text-gray-600">By sharing our app, you help more people access vital flood information,
                  increasing community resilience.</p>
              </div>
            </div>
          </div>

          <!-- Modals -->
          <!-- Report Modal -->
          <div id="report-modal"
            class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center @if ($errors->any()) flex @else hidden @endif">
            <div class="bg-white p-8 rounded-lg max-w-md w-full">
              <h3 class="text-xl font-semibold mb-4">Report a Flood Incident</h3>
              <form id="report-form" class="space-y-4" method="POST" action="/submitReport">
                @csrf
                <select name="city_name" class="w-full p-2 border rounded" required>
                  <option value="" disabled selected>Select Administrative City</option>
                  @foreach ($floodLocations as $location)
                    <option value="{{ $location->name }}">{{ $location->name }}</option>
                  @endforeach
                </select>
                @error('city_name')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input type="text" name="subdistrict" placeholder="Subdistricts (e.g., Tegal Alur)"
                  class="w-full p-2 border rounded" required>
                @error('subdistrict')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <textarea name="description" placeholder="Description" class="w-full p-2 border rounded" required></textarea>
                @error('description')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <button type="submit"
                  class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                  Submit Report
                </button>
              </form>
              <button onclick="hideModal('report-modal')" class="mt-4 text-gray-600 hover:text-gray-800">Close</button>
            </div>
          </div>

          <!-- Create Modal -->
          <div id="create-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-8 rounded-lg max-w-md w-full">
              <h3 class="text-xl font-semibold mb-4">Submit Flood Incident Point</h3>
              <form id="create-form" class="space-y-4" method="POST" action="/submitFloodPoint">
                @csrf
                <select name="flood_location_id" class="w-full p-2 border rounded" required>
                  <option value="" disabled selected>Select Flood Location</option>
                  @foreach ($floodLocations as $location)
                    <option value="{{ $location->id }}">{{ $location->name }}</option>
                  @endforeach
                </select>
                @error('flood_location_id')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input type="text" name="kelurahan" placeholder="Kelurahan" class="w-full p-2 border rounded" required>
                @error('kelurahan')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input type="text" name="latitude" placeholder="Latitude" class="w-full p-2 border rounded" required>
                @error('latitude')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input type="text" name="longitude" placeholder="Longitude" class="w-full p-2 border rounded" required>
                @error('longitude')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <input type="text" name="indeksBanjir" placeholder="Indeks Banjir" class="w-full p-2 border rounded" required>
                @error('indeksBanjir')
                  <div class="text-red-500 text-sm">{{ $message }}</div>
                @enderror
                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition-colors">
                  Submit
                </button>
              </form>
              <button onclick="hideModal('create-modal')" class="mt-4 text-gray-600 hover:text-gray-800">Close</button>
            </div>
          </div>

          <!-- Share Modal -->
          <div id="share-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
            <div class="bg-white p-8 rounded-lg max-w-md w-full">
              <h3 class="text-xl font-semibold mb-4">Share Our App</h3>
              <p class="mb-4">Help us reach more people by sharing our app:</p>
              <div class="flex space-x-4">
                <button onclick="shareApp('twitter')"
                  class="bg-blue-400 text-white px-4 py-2 rounded hover:bg-blue-500 transition-colors">Twitter</button>
                <button onclick="shareApp('facebook')"
                  class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">Facebook</button>
                <button onclick="shareApp('linkedin')"
                  class="bg-blue-800 text-white px-4 py-2 rounded hover:bg-blue-900 transition-colors">LinkedIn</button>
              </div>
              <button onclick="hideModal('share-modal')" class="mt-4 text-gray-600 hover:text-gray-800">Close</button>
            </div>
          </div>
        </div>
    </div>
    </section>

    <script>
      let reportCount = 0;
      let shareCount = 0;

      function showModal(id) {
        document.getElementById(id).classList.remove('hidden');
      }

      function hideModal(id) {
        document.getElementById(id).classList.add('hidden');
      }

      // function shareApp(platform) {
      //     // Kalo backend bakal ribet bisa di delete ini sama semua function counter nya bg
      //     shareCount++;
      //     updateCounts();
      //     hideModal('share-modal');
      // }

      document.getElementById('report-form').addEventListener('submit', function(e) {
        e.preventDefault();
        //reportCount++;
        //updateCounts();
        hideModal('report-modal');
        this.submit();
      });

      document.getElementById('create-form').addEventListener('submit', function(e) {
        e.preventDefault();
        hideModal('create-modal');
        this.submit();
      });

      // function updateCounts() {
      //     document.getElementById('report-count').textContent = reportCount;
      //     document.getElementById('share-count').textContent = shareCount;
      // }

      // updateCounts();
    </script>
    </div>
  </main>
</body>

</html>
