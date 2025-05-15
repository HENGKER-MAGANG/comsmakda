<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>
<?php include '../db.php'; ?>

<style>
  @media print {
    body {
      -webkit-print-color-adjust: exact;
    }

    .navbar, .btn, input, .form-control, .row.mb-3,
    .sidebar, .side-nav, .sidebar-menu, .main-sidebar {
      display: none !important;
    }

    .table-responsive {
      overflow: visible !important;
    }

    table {
      width: 100% !important;
      font-size: 12px;
    }

    th, td {
      padding: 8px;
      text-align: center;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    @page {
      margin: 1cm;
    }
  }
</style>

<h2>Rekap Data Anggota</h2>

<!-- Tombol Cetak -->
<div class="mb-3">
  <button class="btn btn-primary" onclick="window.print()">
    <i class="bi bi-printer"></i> Cetak Rekap
  </button>
</div>

<!-- Pencarian -->
<div class="row mb-3">
  <div class="col-md-4">
    <input type="text" id="searchRekap" class="form-control" placeholder="Cari nama..." />
  </div>
</div>

<!-- Tabel Rekap -->
<div class="table-responsive">
  <table class="table table-bordered table-striped" id="rekapTable">
    <thead class="table-dark text-center">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Hadir</th>
        <th>Izin</th>
        <th>Alpa</th>
        <th>Total Kas Masuk</th>
        <th>Jumlah Tunggakan</th>
        <th>Total Tunggakan</th>
      </tr>
    </thead>
    <tbody id="dataRekap">
      <?php
        $sql = "SELECT 
                  u.id,
                  u.username,
                  u.tanggal_daftar,
                  SUM(CASE WHEN a.status = 'Hadir' THEN 1 ELSE 0 END) AS hadir,
                  SUM(CASE WHEN a.status = 'Izin' THEN 1 ELSE 0 END) AS izin,
                  SUM(CASE WHEN a.status = 'Alpa' THEN 1 ELSE 0 END) AS alpa,
                  COALESCE((SELECT SUM(jumlah) FROM kas WHERE kas.username = u.username), 0) AS kas
                FROM users u
                LEFT JOIN absensi a ON a.username = u.username
                WHERE u.role = 'anggota'
                GROUP BY u.id, u.username, u.tanggal_daftar";

        $result = mysqli_query($conn, $sql);
        $i = 1;
        $tanggal_akhir = date('Y-m-d');

        while ($row = mysqli_fetch_assoc($result)) {
          $id_user = $row['id'];
          $tanggal_daftar = $row['tanggal_daftar'];

          // Hitung jumlah hari Rabu & Jumat sejak tanggal_daftar
          $period = new DatePeriod(
              new DateTime($tanggal_daftar),
              new DateInterval('P1D'),
              new DateTime($tanggal_akhir . ' +1 day')
          );
          $tanggal_iuran = [];
          foreach ($period as $date) {
              $day = $date->format('N');
              if ($day == 3 || $day == 5) {
                  $tanggal_iuran[] = $date->format('Y-m-d');
              }
          }

          // Ambil tanggal yang sudah dibayar dan disetujui
          $query_bayar = "SELECT tanggal_pengajuan FROM pembayaran_tunggakan WHERE id_user = $id_user AND status = 'Disetujui'";
          $result_bayar = mysqli_query($conn, $query_bayar);
          $tanggal_bayar = [];
          while ($bayar = mysqli_fetch_assoc($result_bayar)) {
              $tanggal_bayar[] = $bayar['tanggal_pengajuan'];
          }

          // Hitung tunggakan
          $jumlah_tunggakan = 0;
          foreach ($tanggal_iuran as $tgl) {
              if (!in_array($tgl, $tanggal_bayar)) {
                  $jumlah_tunggakan++;
              }
          }
          $total_tunggakan = $jumlah_tunggakan * 2000;

          echo "<tr class='text-center'>";
          echo "<td>{$i}</td>";
          echo "<td>{$row['username']}</td>";
          echo "<td>{$row['hadir']}</td>";
          echo "<td>{$row['izin']}</td>";
          echo "<td>{$row['alpa']}</td>";
          echo "<td>Rp" . number_format($row['kas'], 0, ',', '.') . "</td>";
          echo "<td>{$jumlah_tunggakan} kali</td>";
          echo "<td>Rp" . number_format($total_tunggakan, 0, ',', '.') . "</td>";
          echo "</tr>";
          $i++;
        }
      ?>
    </tbody>
  </table>
</div>

<script>
  // Pencarian Anggota berdasarkan Nama
  const searchRekap = document.getElementById("searchRekap");
  const rekapRows = document.querySelectorAll("#rekapTable tbody tr");

  searchRekap.addEventListener("input", () => {
    const searchValue = searchRekap.value.toLowerCase();
    rekapRows.forEach(row => {
      const nama = row.cells[1].textContent.toLowerCase();
      row.style.display = nama.includes(searchValue) ? "" : "none";
    });
  });
</script>

<?php include 'partials/footer.php'; ?>
