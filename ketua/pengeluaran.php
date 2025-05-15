
<?php include 'partials/header.php'; ?>
<?php include 'partials/navbar.php'; ?>
<?php include '../db.php'; ?>
<?php
// Proses tambah pengeluaran
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['aksi']) && $_POST['aksi'] == 'tambah') {
    $tanggal = $_POST['tanggal'];
    $jumlah = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $stmt = $conn->prepare("INSERT INTO pengeluaran (tanggal, jumlah, keterangan) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $tanggal, $jumlah, $keterangan);
    if ($stmt->execute()) {
        echo "<script>
            Swal.fire('Berhasil', 'Pengeluaran ditambahkan!', 'success')
                .then(() => window.location.href = 'pengeluaran.php');
        </script>";
    } else {
        echo "<script>Swal.fire('Gagal', 'Gagal menyimpan data.', 'error');</script>";
    }
}

// Proses hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $conn->query("DELETE FROM pengeluaran WHERE id = $id");
    echo "<script>
        Swal.fire('Dihapus!', 'Data pengeluaran telah dihapus.', 'success')
            .then(() => window.location.href = 'pengeluaran.php');
    </script>";
}
?>

<div class="container mt-4">
    <h2>Data Pengeluaran</h2>

    <!-- Tombol Modal Tambah -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalTambah">+ Tambah Pengeluaran</button>

    <!-- Tabel Data -->
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $total = 0;
                $result = $conn->query("SELECT * FROM pengeluaran ORDER BY tanggal DESC");
                while ($row = $result->fetch_assoc()) {
                    $total += $row['jumlah'];
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['tanggal']}</td>
                        <td>Rp" . number_format($row['jumlah'], 0, ',', '.') . "</td>
                        <td>{$row['keterangan']}</td>
                        <td>
                            <button class='btn btn-sm btn-danger' onclick='konfirmasiHapus({$row['id']})'>Hapus</button>
                        </td>
                      </tr>";
                    $no++;
                }
                ?>
            </tbody>
            <tfoot>
                <tr class="table-light fw-bold">
                    <td colspan="2">Total</td>
                    <td colspan="3">Rp<?= number_format($total, 0, ',', '.') ?></td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" class="modal-content">
      <input type="hidden" name="aksi" value="tambah">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTambahLabel">Tambah Pengeluaran</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label>Tanggal</label>
          <input type="date" name="tanggal" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Jumlah (Rp)</label>
          <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="mb-3">
          <label>Keterangan</label>
          <textarea name="keterangan" class="form-control" required></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Batal</button>
        <button class="btn btn-primary" type="submit">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Script Hapus -->
<script>
function konfirmasiHapus(id) {
    Swal.fire({
        title: 'Yakin hapus?',
        text: "Data tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = 'pengeluaran.php?hapus=' + id;
        }
    });
}
</script>

<?php include 'partials/footer.php'; ?>
