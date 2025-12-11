<?php
require 'koneksi.php';

$fieldConfigKontak = [
    "nama" => ["label" => "Nama:", "suffix" => ""],
    "email" => ["label" => "Email:", "suffix" => ""],
    "pesan" => ["label" => "Pesan:", "suffix" => ""],
];

$sql = "SELECT * FROM tbl_tamu ORDER BY cid DESC";
$q = mysqli_query($koneksi, $sql);
if (!$q) {
    echo "<p>Gagal membaca data tamu: " . htmlspecialchars(mysqli_error($koneksi)) . "</p>";
} elseif (mysqli_num_rows($q) === 0) {
    echo "<p>Belum ada data tamu yang tersimpan.</p>";
} else {
    while ($row = mysqli_fetch_assoc($q)) {
        $arrKontak = [
            "nama" => $row["cnama"] ?? "",
            "email" => $row["cemail"] ?? "",
            "pesan" => $row["cpesan"] ?? "",
        ];
        echo tampilkanBiodata($fieldConfigKontak, $arrKontak);
    }
}
$q = mysqli_query($koneksi, $sql);
?>
