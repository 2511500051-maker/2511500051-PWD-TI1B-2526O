<?php
require 'koneksi.php';

$fieldContact = [
  "kode_pengunjung" => ["label" => "Kode Pengunjung:", "suffix" => ""],
  "nama_pengunjung" => ["label" => "Nama Pengunjung:", "suffix" => ""],
  "alamat_rumah" => ["label" => "Alamat Rumah:", "suffix" => ""],
  "tanggal_kunjungan" => ["label" => "Tanggal Kunjungan:", "suffix" => ""],
  "hobi"         => ["label" => "Hobi:", "suffix" => ""],
  "pasangan"     => ["label" => "Pasangan:", "suffix" => ""],
  "pekerjaan"    => ["label" => "Pekerjaan:", "suffix" => ""],
  "nama_orang_tua" => ["label" => "Nama Orang Tua:", "suffix" => ""],
  "nama_pacar"   => ["label" => "Nama Pacar:", "suffix" => ""],
  "nama_mantan"    => ["label" => "Nama Mantan:", "suffix" => ""]
];

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q = mysqli_query($conn, $sql);
if (!$q) {
  echo "<p>Gagal membaca data tamu: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
} elseif (mysqli_num_rows($q) === 0) {
  echo "<p>Belum ada data tamu yang tersimpan.</p>";
} else {
  while ($row = mysqli_fetch_assoc($q)) {
    $arrContact = [
      "nama"  => $row["cnama"]  ?? "",
      "email" => $row["cemail"] ?? "",
      "pesan" => $row["cpesan"] ?? "",
    ];
    echo tampilkanBiodata($fieldContact, $arrContact);
  }
}
?>

<?php
$fieldConfig = [
  "kode_pengunjung" => ["label" => "Kode Pengunjung:", "suffix" => ""],
  "nama_pengunjung" => ["label" => "Nama Pengunjung:", "suffix" => ""],
  "alamat_rumah" => ["label" => "Alamat Rumah:", "suffix" => ""],
  "tanggal_kunjungan" => ["label" => "Tanggal Kunjungan:", "suffix" => ""],
  "hobi"         => ["label" => "Hobi:", "suffix" => ""],
  "pasangan"     => ["label" => "Pasangan:", "suffix" => ""],
  "pekerjaan"    => ["label" => "Pekerjaan:", "suffix" => ""],
  "nama_orang_tua" => ["label" => "Nama Orang Tua:", "suffix" => ""],
  "nama_pacar"   => ["label" => "Nama Pacar:", "suffix" => ""],
  "nama_mantan"    => ["label" => "Nama Mantan:", "suffix" => ""]
];

$sql = "SELECT * FROM tbl_pengunjung ORDER BY cid DESC";
$q = mysqli_query($conn, $sql);
if (!$q) {
  echo "<p>Gagal membaca data pengunjung: " . htmlspecialchars(mysqli_error($conn)) . "</p>";
} elseif (mysqli_num_rows($q) === 0) {
  echo "<p>Belum ada data pengunjung yang tersimpan.</p>";
} else {
  while ($row = mysqli_fetch_assoc($q)) {
    $biodata = [
      "kode_pengunjung"   => $row["ckode_pengunjung"] ?? "",
      "nama_pengunjung"   => $row["cnama_pengunjung"] ?? "",
      "alamat_rumah"      => $row["calamat_rumah"] ?? "",
      "tanggal_kunjungan" => $row["ctanggal_kunjungan"] ?? "",
      "hobi"              => $row["chobi"] ?? "",
      "pasangan"          => $row["cpasangan"] ?? "",
      "pekerjaan"         => $row["cpekerjaan"] ?? "",
      "nama_orang_tua"    => $row["cnama_orang_tua"] ?? "",
      "nama_pacar"        => $row["cnama_pacar"] ?? "",
      "nama_mantan"       => $row["cnama_mantan"] ?? ""
    ];  
    echo tampilkanBiodata($fieldConfig, $biodata);
  }
}
?>
