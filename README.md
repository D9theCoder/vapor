<!-- Improved compatibility of back to top link -->
<a id="readme-top"></a>

<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/sheraldo-ux/WebProg-Blade">
    <img src="public/logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Web Pemetaan Banjir</h3>

  <p align="center">
    Aplikasi Prediksi dan Mitigasi Risiko Banjir
    <br />
    <a href="https://github.com/sheraldo-ux/WebProg-Blade"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/sheraldo-ux/WebProg-Blade">View Demo</a>
    ·
    <a href="https://github.com/sheraldo-ux/WebProg-Blade/issues/new">Report Bug</a>
    ·
    <a href="https://github.com/sheraldo-ux/WebProg-Blade/issues/new">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#features">Features</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#team">Team</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About The Project

Aplikasi Web Pemetaan Banjir ini dikembangkan untuk mendukung tujuan SDG 13: Climate Action, yang bertujuan untuk meningkatkan kesadaran dan mengurangi dampak perubahan iklim. Indonesia, sebagai negara yang rawan bencana, sering menghadapi bencana banjir yang semakin tidak terprediksi dalam hal pola dan intensitasnya, terutama di kota-kota besar.

Website ini memberikan solusi berbasis data yang memanfaatkan informasi historis banjir untuk memetakan risiko banjir di berbagai lokasi. Dengan adanya prediksi ini, masyarakat dapat lebih siap menghadapi bencana dan mengambil tindakan preventif yang lebih tepat.

Kontribusi Aplikasi terhadap SDG 13:

- Peringatan Dini: Memberikan pemberitahuan kepada pengguna mengenai tingkat risiko banjir di lokasi mereka berdasarkan indeks banjir.
- Edukasi Masyarakat: Melalui fitur informasi banjir dan tips bertahan hidup, aplikasi ini meningkatkan kesadaran masyarakat tentang mitigasi risiko banjir.
- Akses Informasi: Pengguna dapat mendapatkan informasi mengenai titik rawan banjir, yang memungkinkan mereka untuk mengambil tindakan preventif lebih awal.


<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

Teknologi utama yang digunakan dalam pengembangan proyek:

* [![Laravel][Laravel.com]][Laravel-url]
* [![Mapbox][Mapbox-shield]][Mapbox-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![PHP][PHP-shield]][PHP-url]
* [![JavaScript][JavaScript-shield]][JavaScript-url]
* [![MySQL][MySQL-shield]][MySQL-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

Panduan untuk mengatur proyek di lingkungan lokal Anda.

### Prerequisites

Pastikan Anda memiliki prasyarat berikut:
* PHP 8.1
* Composer
* Node.js
* MySQL
  ```sh
  # Contoh instalasi Composer
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  ```

### Installation

1. Clone repositori
   ```sh
   git clone https://github.com/sheraldo-ux/WebProg-Blade.git
   ```
2. Install dependensi Composer
   ```sh
   composer install
   ```
3. Install dependensi NPM
   ```sh
   npm install
   ```
4. Konfigurasi environment
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
5. Konfigurasi database
   ```sh
   php artisan migrate
   ```
6. Jalankan aplikasi
   ```sh
   npm run dev
   php artisan serve
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- FEATURES -->
## Features

### Halaman Utama (Home Page):
- Deteksi Lokasi dengan Koordinat GPS: Pengguna dapat memanfaatkan fitur deteksi lokasi menggunakan GPS untuk mengetahui titik rawan banjir terdekat. Lokasi pengguna akan dipetakan secara otomatis di peta, dan prediksi banjir akan disesuaikan dengan wilayah mereka.
- Perhitungan Indeks Banjir Terdekat: Aplikasi mengolah data historis untuk menunjukkan tingkat risiko banjir berdasarkan lokasi pengguna. Hal ini membantu pengguna untuk mempersiapkan diri jika banjir diprediksi terjadi.
- Prakiraan Cuaca 12 Jam ke Depan: Menggunakan data cuaca terkini, aplikasi memberikan prakiraan cuaca untuk membantu pengguna mengantisipasi cuaca ekstrem yang dapat menyebabkan banjir.
- Penanda Peta Risiko Banjir: Peta interaktif yang menunjukkan titik-titik rawan banjir dengan penanda yang memberikan informasi tentang tingkat bahaya di setiap lokasi.

### Halaman Informasi:
- Dampak Banjir: Menyediakan informasi mengenai dampak banjir bagi masyarakat dan lingkungan, termasuk tips untuk mengurangi kerugian akibat banjir.
- Kontak Darurat: Daftar nomor kontak penting dan pusat bantuan yang bisa dihubungi selama banjir atau bencana alam lainnya.
Game Flood Myths and Facts: Game edukatif yang mengajarkan masyarakat tentang fakta banjir dan mengurangi miskonsepsi terkait bencana banjir.

### Halaman Berita:
- Form Kontribusi Berita: Pengguna dapat berkontribusi dengan mengirimkan laporan atau berita terkait kejadian banjir di wilayah mereka.
Tampilan Berita Terbaru: Menampilkan berita terkini mengenai banjir dan keadaan darurat yang bisa membantu masyarakat lebih waspada.
- Sistem Berbagi Informasi Banjir Real-Time: Pengguna bisa berbagi informasi terbaru mengenai banjir melalui platform ini, membantu penyebaran informasi lebih cepat.

### Halaman Tips:
- SMART Tips for Flood Survival: Tips bertahan hidup yang berbasis pada prinsip SMART (Stay Informed, Move to Higher Ground, Assemble an Emergency Kit, Respond Immediately, & Turn Off Utilities) untuk membantu masyarakat bertindak secara efektif selama banjir.
Studi Kasus Nyata: Contoh-contoh kejadian banjir nyata dan cara mitigasi yang efektif yang diterapkan di lokasi-lokasi terdampak.
- Video Edukasi: Menyediakan video pendek yang memberikan penjelasan tentang cara bertahan hidup saat banjir, mengurangi kerusakan, dan meminimalisir risiko.

### Halaman About
- Meet Our Team, Bagian ini menampilkan profil anggota tim yang terlibat dalam pengembangan aplikasi, yang mencakup informasi berikut:
Foto Profil: Gambar anggota tim yang jelas dan profesional.
Nama/User: Nama lengkap atau username anggota tim.
Posisi/Role: Posisi atau peran anggota dalam proyek.
Tautan Media Sosial: Link ke akun media sosial masing-masing anggota untuk memberikan kesempatan kepada pengguna untuk terhubung lebih lanjut dengan tim.

### Halaman Support Us 

Mengajak pengguna untuk berpartisipasi dalam inisiatif pemetaan banjir dan memberikan dukungan untuk meningkatkan dampak aplikasi.
Flood Mapping Initiative
Bagian ini memiliki dua fitur utama untuk melibatkan pengguna dalam pemetaan banjir:
- Report Flood Incidents: Fitur ini memungkinkan pengguna untuk melaporkan kejadian banjir di daerah mereka, yang akan membantu memperbarui data dan meningkatkan akurasi peta risiko banjir.
- Spread the Word: Fitur ini memungkinkan pengguna untuk membagikan aplikasi ke komunitas atau teman-teman mereka untuk meningkatkan kesadaran tentang risiko banjir dan pentingnya kesiapsiagaan.

Collective Impact Statistics
Tampilan ini menunjukkan statistik dampak kolektif dari dukungan pengguna, termasuk:
- Jumlah Laporan Banjir yang Diterima: Menunjukkan jumlah laporan banjir yang berhasil dikumpulkan dari pengguna.
- Jumlah Aplikasi yang Dibagikan: Menampilkan jumlah aplikasi yang telah dibagikan oleh pengguna ke komunitas mereka.


<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->
## Roadmap

- [x] Pengembangan prototipe awal
- [x] Implementasi sistem deteksi lokasi dan pemetaan banjir
- [x] Integrasi Mapbox API
- [x] Pengembangan fitur informasi banjir
- [x] Sistem kontribusi berita
- [x] Implementasi autentikasi pengguna
- [ ] Sistem kontribusi pelaporan titik banjir
- [ ] Dukungan multi-bahasa
    - [ ] Bahasa Indonesia
    - [ ] Bahasa Inggris

Lihat [open issues](https://github.com/sheraldo-ux/WebProg-Blade/issues) untuk daftar lengkap usulan fitur.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- TEAM -->
## Team

### Anggota Tim Pengembang & Kontribusi

- **Sheraldo Halim**
  [![GitHub][github-shield]](https://github.com/sheraldo-ux) | FrontEnd

- **Raphaelle Albetho Wijaya**
  [![GitHub][github-shield]](https://github.com/Zweych) | FrontEnd

- **Pierre Adrian Tiopan Octavianus Sitorus**
  [![GitHub][github-shield]](https://github.com/PierreKoding) | FrontEnd

- **Timothy Paendong**
  [![GitHub][github-shield]](https://github.com/voidt01) | BackEnd

- **Kevin Purnomo**
  [![GitHub][github-shield]](https://github.com/D9theCoder) | FullStack

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->
## License

Didistribusikan di bawah Lisensi MIT. Lihat `LICENSE` untuk informasi lebih lanjut.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->
## Contact

Sheraldo Halim - [@sheraldo_ux](https://twitter.com/sheraldo_ux) - sheraldohalim@gmail.com

Link Proyek: [https://github.com/sheraldo-ux/WebProg-Blade](https://github.com/sheraldo-ux/WebProg-Blade)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

Sumber daya yang membantu dalam pengembangan proyek:

* [Choose an Open Source License](https://choosealicense.com)
* [Img Shields](https://shields.io)
* [Google Font](https://fonts.google.com)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
[contributors-shield]: https://img.shields.io/github/contributors/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[contributors-url]: https://github.com/sheraldo-ux/WebProg-Blade/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[forks-url]: https://github.com/sheraldo-ux/WebProg-Blade/network/members
[stars-shield]: https://img.shields.io/github/stars/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[stars-url]: https://github.com/sheraldo-ux/WebProg-Blade/stargazers
[issues-shield]: https://img.shields.io/github/issues/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[issues-url]: https://github.com/sheraldo-ux/WebProg-Blade/issues
[license-shield]: https://img.shields.io/github/license/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[license-url]: https://github.com/sheraldo-ux/WebProg-Blade/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/sheraldo-halim

[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Mapbox-shield]: https://img.shields.io/badge/Mapbox-000000?style=for-the-badge&logo=mapbox&logoColor=white
[Mapbox-url]: https://www.mapbox.com/
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com

[PHP-shield]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[JavaScript-shield]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[JavaScript-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript
[MySQL-shield]: https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/

[github-shield]: https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white
