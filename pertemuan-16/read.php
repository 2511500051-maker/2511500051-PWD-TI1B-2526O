<?php
  session_start();
  require 'koneksi.php';
  require 'fungsi.php';

  $sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
  $q = mysqli_query($conn, $sql);
  if (!$q) {
    die("Query error: " . mysqli_error($conn));
  }
?>

<?php
  $flash_sukses = $_SESSION['flash_sukses'] ?? ''; #jika query sukses
  $flash_error  = $_SESSION['flash_error'] ?? ''; #jika ada error
  #bersihkan session ini
  unset($_SESSION['flash_sukses'], $_SESSION['flash_error']); 
?>

<?php if (!empty($flash_sukses)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#d4edda; color:#155724; border-radius:6px;">
          <?= $flash_sukses; ?>
        </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
        <div style="padding:10px; margin-bottom:10px; 
          background:#f8d7da; color:#721c24; border-radius:6px;">
          <?= $flash_error; ?>
        </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Nama</th>
    <th>Email</th>
    <th>Pesan</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit.php?cid=<?= (int)$row['cid']; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($row['cnama']); ?>?')" href="proses_delete.php?cid=<?= (int)$row['cid']; ?>">Delete</a>
      </td>
      <td><?= $row['cid']; ?></td>
      <td><?= htmlspecialchars($row['cnama']); ?></td>
      <td><?= htmlspecialchars($row['cemail']); ?></td>
      <td><?= nl2br(htmlspecialchars($row['cpesan'])); ?></td>
      <td><?= formatTanggal(htmlspecialchars($row['dcreated_at'])); ?></td>
    </tr>
  <?php endwhile; ?>
</table>

<br><br>

<?php
$sql = "SELECT * FROM tbl_mahasiswa ORDER BY cid DESC";
$q = mysqli_query($conn, $sql);
if (!$q) {
  die("Query error: " . mysqli_error($conn));
}
?>

<?php
$flash_sukses = $_SESSION['flash_sukses'] ?? '';
$flash_error  = $_SESSION['flash_error'] ?? '';
unset($_SESSION['flash_sukses'], $_SESSION['flash_error']);
?>

<?php if (!empty($flash_sukses)): ?>
  <div style="padding:10px; margin-bottom:10px;
          background:#d4edda; color:#155724; border-radius:6px;">
    <?= $flash_sukses; ?>
  </div>
<?php endif; ?>

<?php if (!empty($flash_error)): ?>
  <div style="padding:10px; margin-bottom:10px;
          background:#f8d7da; color:#721c24; border-radius:6px;">
    <?= $flash_error; ?>
  </div>
<?php endif; ?>

<table border="1" cellpadding="8" cellspacing="4">
  <tr>
    <th>No</th>
    <th>Aksi</th>
    <th>ID</th>
    <th>Kode Penggunjung</th>
    <th>Alamat Rumah</th>
    <th>Tanggal Kunjungan</th>
    <th>Hobi</th>
    <th>Asal SLTA</th>
    <th>Pekerjaan</th>
    <th>Nama Orang Tua</th>
    <th>Nama Pacar</th>
    <th>Nama Mantan</th>
    <th>Created At</th>
  </tr>
  <?php $i = 1; ?>
  <?php while ($row = mysqli_fetch_assoc($q)): ?>
    <?php
    $cid               = $row['cid']             ?? 0;
    $kode_penggunjung  = $row['ckode_penggunjung'] ?? '';
    $alamat_rumah      = $row['calamat_rumah']   ?? '';
    $tanggal_kunjungan = $row['ctanggal_kunjungan']  ?? '';
    $hobi              = $row['chobi']           ?? '';
    $pasangan          = $row['cpasangan']       ?? '';
    $pekerjaan         = $row['cpekerjaan']      ?? '';
    $nama_orang_tua    = $row['cnama_orang_tua'] ?? '';
    $nama_pacar        = $row['cnama_pacar']     ?? '';
    $nama_mantan       = $row['cnama_mantan']      ?? '';
    $created_at        = $row['dcreated_at']     ?? '';
    ?>
    <tr>
      <td><?= $i++ ?></td>
      <td>
        <a href="edit.php?cid=<?= (int)$cid; ?>">Edit</a>
        <a onclick="return confirm('Hapus <?= htmlspecialchars($kode_penggunjung, ENT_QUOTES, 'UTF-8'); ?>?')"
           href="proses_delete.php?cid=<?= (int)$cid; ?>">Delete</a>
      </td>
      <td><?= (int)$cid; ?></td>
      <td><?= htmlspecialchars($kode_penggunjung, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($alamat_rumah, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars(formatTanggal($tanggal_kunjungan), ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($hobi, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($pasangan, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($pekerjaan, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($nama_orang_tua, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($nama_pacar, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars($nama_mantan, ENT_QUOTES, 'UTF-8'); ?></td>
      <td><?= htmlspecialchars(formatTanggal($created_at), ENT_QUOTES, 'UTF-8'); ?></td>
    </tr>
  <?php endwhile; ?>
</table>