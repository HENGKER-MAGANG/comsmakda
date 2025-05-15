<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>COM SMAKDA - Portofolio Developer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  body {
    font-family: 'Segoe UI', sans-serif;
    background-color: #f8f9fa;
    color: #212529;
    transition: background-color 0.3s, color 0.3s;
  }

  .navbar {
    padding: 0.8rem 1rem;
  }

  .navbar-brand {
    font-weight: bold;
    font-size: 1.4rem;
    color: #0d6efd;
  }

  .nav-link {
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .nav-link:hover,
  .nav-link.active {
    color: #0d6efd !important;
  }

  .section-title {
    font-size: 2.25rem;
    font-weight: 700;
    color: #0d6efd;
    margin-bottom: 2rem;
    border-bottom: 2px solid #0d6efd;
    display: inline-block;
    padding-bottom: 0.3rem;
  }

  .card-img-top {
    height: 200px;
    object-fit: cover;
    border-bottom: 1px solid #e9ecef;
  }

  .card {
    border: none;
    transition: transform 0.2s ease, box-shadow 0.3s;
  }

  .card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
  }

  .team-img {
    width: 120px;
    height: 120px;
    object-fit: cover;
    border: 3px solid #0d6efd;
    padding: 2px;
  }

  section {
    padding-top: 4rem;
    padding-bottom: 4rem;
  }

  .lead {
    font-size: 1.1rem;
    color: #5c5c5c;
  }

  .btn-outline-primary {
    border-radius: 8px;
    font-weight: 500;
    transition: 0.3s ease-in-out;
  }

  .btn-outline-primary:hover {
    background-color: #0d6efd;
    color: #fff;
  }

  .btn-primary {
    border-radius: 8px;
    font-weight: 500;
  }

  .form-section input,
  .form-section textarea {
    font-size: 0.95rem;
  }

  footer {
    background-color: #f1f3f5;
    color: #555;
    padding: 1rem 0;
    text-align: center;
    font-size: 0.9rem;
  }

  @media (max-width: 768px) {
    .display-4 {
      font-size: 2rem;
    }

    .lead {
      font-size: 1rem;
    }

    .team-img {
      width: 100px;
      height: 100px;
    }

    .section-title {
      font-size: 1.5rem;
    }

    .navbar-nav {
      text-align: center;
    }

    .navbar-collapse {
      background-color: #ffffff;
      padding-bottom: 1rem;
    }

    .form-section {
      padding: 1rem;
    }

    .btn-lg {
      width: 100%;
    }
  }

  /* Dark Mode */
  body.dark-mode {
    background-color: #121212;
    color: #e0e0e0;
  }

  body.dark-mode .bg-light,
  body.dark-mode .bg-white {
    background-color: #1f1f1f !important;
  }

  body.dark-mode .text-primary {
    color: #90caf9 !important;
  }

  body.dark-mode .btn-outline-primary {
    color: #90caf9;
    border-color: #90caf9;
  }

  body.dark-mode .btn-outline-primary:hover {
    background-color: #90caf9;
    color: #121212;
  }

  body.dark-mode .navbar,
  body.dark-mode footer {
    background-color: #1f1f1f !important;
    border-color: #333 !important;
  }

  body.dark-mode .card {
    background-color: #1e1e1e;
    color: #e0e0e0;
    border: 1px solid #333;
  }
</style>


</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container">
    <a class="navbar-brand" href="#">COM SMAKDA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
      aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-center">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#portofolio">Portofolio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#visimisi">Visi Misi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#tim">Tim</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#kontak">Kontak</a>
        </li>
        <li class="nav-item">
          <a class="btn btn-primary btn-sm mt-2 mt-lg-0 ms-lg-2" href="login.php">Login</a>
        </li>
        <li class="nav-item">
          <button id="toggleDark" class="btn btn-outline-secondary btn-sm mt-2 mt-lg-0 ms-lg-2">🌙</button>
        </li>
      </ul>
    </div>
  </div>
</nav>


  <!-- Hero Section -->
  <section class="text-center py-5 bg-light">
    <div class="container">
      <h1 class="display-4 fw-bold">Membangun Solusi Digital dari Sekolah untuk Dunia</h1>
      <p class="lead">Kami adalah komunitas pelajar SMKN 2 Pinrang yang membangun aplikasi dan website berbasis teknologi modern.</p>
      <a href="#portofolio" class="btn btn-outline-primary btn-lg">Lihat Portofolio</a>
    </div>
  </section>

  <!-- Visi Misi -->
  <section class="py-5" id="visimisi">
    <div class="container">
      <h2 class="section-title text-center">Visi & Misi</h2>
      <div class="row">
        <div class="col-md-6 mb-4">
          <h4 class="text-primary">Visi</h4>
          <p>Menjadi komunitas digital kreatif pelajar terdepan yang mampu bersaing secara global melalui karya teknologi yang bermanfaat.</p>
        </div>
        <div class="col-md-6">
          <h4 class="text-primary">Misi</h4>
          <ul>
            <li>Mengembangkan keterampilan programming dan design melalui praktik langsung.</li>
            <li>Mendorong kolaborasi antar siswa dalam membangun solusi nyata berbasis IT.</li>
            <li>Mewadahi karya pelajar dalam bentuk portofolio profesional.</li>
            <li>Menjadi pusat inovasi IT di lingkungan sekolah.</li>
          </ul>
        </div>
      </div>
    </div>
  </section>

  <!-- Portofolio -->
  <section class="py-5 bg-white" id="portofolio">
    <div class="container">
      <h2 class="section-title text-center">Portofolio Project</h2>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="img/panicbully.png" class="card-img-top" alt="Project 1">
            <div class="card-body">
              <h5 class="card-title">Panic Bully Button</h5>
              <p class="card-text">Aplikasi pelaporan bullying di sekolah dengan fitur tombol darurat dan pelacakan lokasi.</p>
              <a href="https://buttonpanicbully.cdcdisdiksulsel.info/" class="btn btn-sm btn-outline-primary">Lihat Demo</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="https://via.placeholder.com/600x300?text=Manajemen+Organisasi" class="card-img-top" alt="Project 2">
            <div class="card-body">
              <h5 class="card-title">Manajemen Organisasi</h5>
              <p class="card-text">Sistem manajemen absensi, kas, dan dokumentasi organisasi untuk COM SMAKDA.</p>
              <a href="#" class="btn btn-sm btn-outline-primary">Lihat Demo</a>
            </div>
          </div>
        </div>
        <div class="col">
          <div class="card h-100 shadow-sm">
            <img src="https://via.placeholder.com/600x300?text=Website+UKK" class="card-img-top" alt="Project 3">
            <div class="card-body">
              <h5 class="card-title">Baru Panic Bully</h5>
              <p class="card-text">masi kosong</p>
              <a href="#" class="btn btn-sm btn-outline-primary">Lihat Demo</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Struktur Tim -->
  <section class="py-5" id="tim">
    <div class="container">
      <h2 class="section-title text-center">Struktur Tim</h2>
      <div class="row text-center">
        <div class="col-md-4 mb-3">
          <img src="img/pembina.jpg" class="rounded-circle mb-2 team-img" alt="Pembina">
          <h5>Pembina</h5>
          <p>Arwinsyah, S.Kom, Gr</p>
        </div>
        <div class="col-md-4 mb-3">
          <img src="img/ketua.jpg" class="rounded-circle mb-2 team-img" alt="Ketua">
          <h5>Ketua</h5>
          <p>Ikhsan Pratama</p>
        </div>
        <div class="col-md-4 mb-3">
          <img src="img/fotbarr.jpeg" class="rounded-circle mb-2 team-img" alt="Programmer">
          <h5>Tim Programmer</h5>
          <p>All Developer COM SMAKDA</p>
        </div>
      </div>
    </div>
  </section>

 <!-- Kontak -->
<section class="py-5 bg-light" id="kontak">
  <div class="container">
    <h2 class="section-title text-center">Kontak & Pemesanan Jasa</h2>
    <div class="row">
      <div class="col-md-6">
        <h5>Alamat:</h5>
        <p>SMKN 2 Pinrang, Jl. Kesehatan Sawitto, Kec. Watang Sawitto, Kab. Pinrang, Sulsel</p>
        <h5>Email:</h5>
        <p>comsmakda@gmail.com</p>
        <h5>Instagram:</h5>
        <p>@com_smakdapinrang</p>
      </div>
      <div class="col-md-6">
<!-- Formulir Pesan Jasa -->
<section id="pesan" class="section bg-light">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 form-section">
        <h3 class="text-center mb-4">Formulir Pemesanan Jasa</h3>
        <form action="kirim_pesan.php" method="POST">
          <div class="mb-3">
            <label for="nama" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control" id="nama" name="nama" required />
          </div>
          <div class="mb-3">
            <label for="nomor_wa" class="form-label">Nomor WhatsApp</label>
            <input type="text" class="form-control" id="nomor_wa" name="nomor_wa" required />
          </div>
          <div class="mb-3">
            <label for="pesan" class="form-label">Pesan / Permintaan</label>
            <textarea class="form-control" id="pesan" name="pesan" rows="4" required></textarea>
          </div>
          <div class="d-grid">
            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</section>

  <!-- Footer -->
  <footer class="text-center py-4 mt-5 bg-white border-top">
    <p class="mb-0">© 2025 Ikhsan Pratama | SMKN 2 Pinrang.</p>
  </footer>

  <!-- Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/scrollreveal"></script>
  <script>
    // Toggle Dark Mode
    const toggleBtn = document.getElementById('toggleDark');
    toggleBtn.addEventListener('click', () => {
      document.body.classList.toggle('dark-mode');
    });

    ScrollReveal().reveal('.section-title', { delay: 100, origin: 'top', distance: '20px', duration: 800 });
    ScrollReveal().reveal('.card', { delay: 200, origin: 'bottom', distance: '20px', interval: 200 });
    ScrollReveal().reveal('.team-img', { delay: 300, scale: 0.9, duration: 600, interval: 200 });
  </script>
</body>
</html>
