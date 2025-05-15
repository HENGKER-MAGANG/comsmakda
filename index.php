<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>COM SMAKDA - Portofolio Developer</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/scrollreveal"></script>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f8f9fa;
      color: #212529;
      transition: background-color 0.4s ease, color 0.4s ease;
    }
    .dark-mode {
      background-color: #1e1e2f;
      color: #f1f1f1;
    }
    .navbar, .card, .bg-light {
      transition: background-color 0.3s ease, color 0.3s ease;
    }
    .dark-mode .navbar,
    .dark-mode .card,
    .dark-mode .bg-light {
      background-color: #2c2c3e !important;
      color: #f1f1f1;
    }
    .dark-mode .card-text,
    .dark-mode .card-title,
    .dark-mode .nav-link {
      color: #fff;
    }
    .navbar-brand {
      font-weight: bold;
      letter-spacing: 1px;
    }
    .nav-link {
      position: relative;
      transition: color 0.3s ease;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      width: 0;
      height: 2px;
      left: 0;
      bottom: -5px;
      background: #0d6efd;
      transition: 0.3s;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .btn-outline-primary,
    .btn-primary {
      transition: all 0.3s ease;
    }
    .btn-outline-primary:hover,
    .btn-primary:hover {
      transform: scale(1.05);
    }
    .section-title {
      font-size: 2.25rem;
      margin-bottom: 2rem;
      font-weight: 700;
    }
    .card {
      border: none;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
    }
    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    }
    .team-img {
      width: 120px;
      height: 120px;
      object-fit: cover;
      border: 4px solid #0d6efd;
      transition: transform 0.3s ease;
    }
    .team-img:hover {
      transform: scale(1.1);
    }
    footer {
      padding: 1rem 0;
      background-color: #f1f1f1;
      text-align: center;
      font-size: 0.9rem;
    }
    .dark-mode footer {
      background-color: #2c2c3e;
      color: #ccc;
    }
    input, textarea {
      background-color: #fff;
      color: #000;
      border-radius: 0.5rem;
    }
    .dark-mode input,
    .dark-mode textarea {
      background-color: #3a3a4d;
      color: #fff;
      border: 1px solid #555;
    }
  </style>
</head>
<body>

<!-- Navbar -->
<!-- Tambahkan di dalam <body> atau ganti bagian navbar lama -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <i class="fas fa-code me-2"></i> COM SMAKDA
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarUtama">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarUtama">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.html"><i class="fas fa-home me-1"></i> Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="galeri_umum.php"><i class="fas fa-image me-1"></i> Dokumentasi</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php"><i class="fas fa-sign-in-alt me-1"></i> Login</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<!-- Hero Section -->
<section class="text-center py-5 bg-light sr">
  <div class="container">
    <h1 class="display-4 fw-bold">Membangun Solusi Digital dari Sekolah untuk Dunia</h1>
    <p class="lead">Kami adalah komunitas pelajar SMKN 2 Pinrang yang membangun aplikasi dan website berbasis teknologi modern.</p>
    <a href="#portofolio" class="btn btn-outline-primary btn-lg">Lihat Portofolio</a>
  </div>
</section>

<!-- Visi Misi -->
<section class="py-5 sr" id="visimisi">
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
<section class="py-5 bg-white sr" id="portofolio">
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
            <h5 class="card-title">UKK Website</h5>
            <p class="card-text">Website Ujian Kompetensi Keahlian untuk jurusan RPL.</p>
            <a href="#" class="btn btn-sm btn-outline-primary">Lihat Demo</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Struktur Tim -->
<section class="py-5 sr" id="tim">
  <div class="container">
    <h2 class="section-title text-center">Struktur Tim</h2>
    <div class="row text-center">
      <div class="col-md-4 mb-3">
        <img src="img/user1.jpg" alt="Ketua" class="team-img rounded-circle mb-2">
        <h5 class="fw-bold">Andi Putra</h5>
        <p>Ketua</p>
      </div>
      <div class="col-md-4 mb-3">
        <img src="img/user2.jpg" alt="Wakil" class="team-img rounded-circle mb-2">
        <h5 class="fw-bold">Rina Sari</h5>
        <p>Wakil Ketua</p>
      </div>
      <div class="col-md-4 mb-3">
        <img src="img/user3.jpg" alt="Developer" class="team-img rounded-circle mb-2">
        <h5 class="fw-bold">Budi Anwar</h5>
        <p>Frontend Developer</p>
      </div>
    </div>
  </div>
</section>

<!-- Kontak -->
<section class="py-5 bg-light sr" id="kontak">
  <div class="container">
    <h2 class="section-title text-center">Kontak & Pemesanan</h2>
    <form>
      <div class="row">
        <div class="col-md-6 mb-3">
          <input type="text" class="form-control" placeholder="Nama Anda" required>
        </div>
        <div class="col-md-6 mb-3">
          <input type="email" class="form-control" placeholder="Email Anda" required>
        </div>
        <div class="col-12 mb-3">
          <textarea class="form-control" rows="4" placeholder="Pesan atau permintaan Anda..." required></textarea>
        </div>
        <div class="col-12 text-center">
          <button type="submit" class="btn btn-primary px-5">Kirim Pesan</button>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- Footer -->
<footer class="mt-5">
  <div class="container">
    &copy; 2025 COM SMAKDA. Dibuat oleh Tim Developer SMKN 2 Pinrang.
  </div>
</footer>

<script>
  // Toggle Dark Mode
  document.getElementById('toggleDark').addEventListener('click', () => {
    document.body.classList.toggle('dark-mode');
  });

  // Scroll Reveal Animasi
  ScrollReveal().reveal('.sr', {
    duration: 1000,
    origin: 'bottom',
    distance: '30px',
    easing: 'ease-in-out',
    reset: false
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
