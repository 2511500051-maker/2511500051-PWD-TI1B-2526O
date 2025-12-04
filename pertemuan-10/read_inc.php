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
            "nama" => $_POST["txtNama"] ?? "",
            "email" => $_POST["txtEmail"] ?? "",
            "pesan" => $_POST["txtPesan"] ?? "",
        ];
        echo tampilkanBiodata($fieldConfigKontak, $kontak);
    }
}
?>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Pesan</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($q)): ?>
        <tr>
            <td><?= $row['cid']; ?></td>
            <td><?= htmlspecialchars($row['cnama']); ?></td>
            <td><?= htmlspecialchars($row['cemail']); ?></td>
            <td><?= nl2br(htmlspecialchars($row['cpesan'])); ?></td>
        </tr>
    <?php endwhile; ?>
</table>