<?php
session_start();
include '../db.php';
include 'partials/header.php';
include 'partials/navbar.php';

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM absensi WHERE id = $id");
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Data berhasil dihapus',
                confirmButtonText: 'OK'
            }).then(() => {
                window.location.href = 'absensi.php';
            });
        });
    </script>";
}
?>

<h2 class="mb-4"><i class="fas fa-calendar-check me-2"></i>Data Absensi</h2>

<!-- Filter dan Pencarian -->
<div class="row mb-3">
  <div class="col-md-4">
    <input type="date" id="filterTanggal" class="form-control" />
  </div>
  <div class="col-md-4">
    <input type="text" id="searchInput" class="form-control" placeholder="Cari nama..." />
  </div>
</div>

<!-- Statistik -->
<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="card text-white bg-success">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-user-check me-2"></i>Hadir</h5>
        <p class="card-text fs-4" id="totalHadir">0</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-white bg-warning">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-user-clock me-2"></i>Izin</h5>
        <p class="card-text fs-4" id="totalIzin">0</p>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <div class="card text-white bg-danger">
      <div class="card-body">
        <h5 class="card-title"><i class="fas fa-user-times me-2"></i>Alpa</h5>
        <p class="card-text fs-4" id="totalAlpa">0</p>
      </div>
    </div>
  </div>
</div>

<!-- Tabel Absensi -->
<div class="table-responsive">
  <table class="table table-bordered table-striped" id="absensiTable">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="dataAbsensi">
      <?php
        $no = 1;
        $query = mysqli_query($conn, "SELECT * FROM absensi ORDER BY tanggal DESC");
        while ($row = mysqli_fetch_assoc($query)) {
            echo "<tr>";
            echo "<td>{$no}</td>";
            echo "<td>{$row['username']}</td>";
            echo "<td>{$row['tanggal']}</td>";
            echo "<td>{$row['status']}</td>";
            echo "<td>
                <a href='absensi.php?hapus={$row['id']}' class='btn btn-sm btn-danger' onclick='return confirmDelete(event)'>
                  <i class=\"fas fa-trash me-1\"></i>Hapus
                </a>
              </td>";
            echo "</tr>";
            $no++;
        }
      ?>
    </tbody>
  </table>
</div>

<script>
  // Konfirmasi hapus menggunakan SweetAlert2
  function confirmDelete(e) {
    e.preventDefault();
    const url = e.currentTarget.getAttribute('href');

    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: "Data yang dihapus tidak bisa dikembalikan!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = url;
      }
    });

    return false;
  }

  // Filter dan pencarian
  const filterTanggal = document.getElementById("filterTanggal");
  const searchInput = document.getElementById("searchInput");
  const table = document.getElementById("absensiTable");
  const rows = table.querySelectorAll("tbody tr");

  function filterData() {
    const tanggal = filterTanggal.value;
    const search = searchInput.value.toLowerCase();
    let hadir = 0, izin = 0, alpa = 0;

    rows.forEach(row => {
      const nama = row.cells[1].textContent.toLowerCase();
      const tgl = row.cells[2].textContent;
      const status = row.cells[3].textContent;

      const matchTanggal = tanggal === "" || tgl === tanggal;
      const matchNama = nama.includes(search);

      if (matchTanggal && matchNama) {
        row.style.display = "";
        if (status === "Hadir") hadir++;
        if (status === "Izin") izin++;
        if (status === "Alpa") alpa++;
      } else {
        row.style.display = "none";
      }
    });

    document.getElementById("totalHadir").textContent = hadir;
    document.getElementById("totalIzin").textContent = izin;
    document.getElementById("totalAlpa").textContent = alpa;
  }

  filterTanggal.addEventListener("input", filterData);
  searchInput.addEventListener("input", filterData);
  window.onload = filterData;
</script>

<?php include 'partials/footer.php'; ?>
