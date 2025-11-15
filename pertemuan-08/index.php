<?php
session_start();
$history_mahasiswa = $_SESSION["history_mahasiswa"] ?? [];
$kontak = [
    "nama" => $_SESSION["sesnama"] ?? "",
    "email" => $_SESSION["sesemail"] ?? "",
    "pesan" => $_SESSION["sespesan"] ?? ""
];

?>
<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Data Mahasiswa</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<header>
<h1>Portal Mahasiswa</h1>
<nav>
<ul>
<li><a href="#home">Beranda</a></li>
<li><a href="#data-mahasiswa">Data Mahasiswa</a></li>
<li><a href="#about">Tentang</a></li>
<li><a href="#contact">Kontak</a></li>
</ul>
</nav>
</header>

<main>

<section id="home">
<h2>Selamat Datang</h2>
<p>Halo dunia! Nama saya DIVA</p>
</section>

<section id="data-mahasiswa">
<h2>Entry Data Mahasiswa</h2>

<!-- History Mahasiswa -->
<?php if (!empty($history_mahasiswa)): ?>
<h3>History Entry Mahasiswa</h3>
<table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse:collapse;">
<thead>
<tr>
<th>NIM</th><th>Nama</th><th>Tempat Lahir</th><th>Tanggal Lahir</th>
<th>Hobi</th><th>Pasangan</th><th>Pekerjaan</th>
<th>Orang Tua</th><th>Kakak</th><th>Adik</th>
</tr>
</thead>
<tbody>
<?php foreach ($history_mahasiswa as $mhs): ?>
<tr>
<td><?= htmlspecialchars($mhs["nim"]) ?></td>
<td><?= htmlspecialchars($mhs["nama"]) ?></td>
<td><?= htmlspecialchars($mhs["tempat_lahir"]) ?></td>
<td><?= htmlspecialchars($mhs["tanggal_lahir"]) ?></td>
<td><?= htmlspecialchars($mhs["hobi"]) ?></td>
<td><?= htmlspecialchars($mhs["pasangan"]) ?></td>
<td><?= htmlspecialchars($mhs["pekerjaan"]) ?></td>
<td><?= htmlspecialchars($mhs["nama_ortu"]) ?></td>
<td><?= htmlspecialchars($mhs["nama_kakak"]) ?></td>
<td><?= htmlspecialchars($mhs["nama_adik"]) ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
<?php endif; ?>


<form action="proses_entry.php" method="POST">
<label>NIM: <input type="text" name="nim" required></label>
<label>Nama: <input type="text" name="nama" required></label>
<label>Tempat Lahir: <input type="text" name="tempat_lahir" required></label>
<label>Tanggal Lahir: <input type="date" name="tanggal_lahir" required></label>
<label>Hobi: <input type="text" name="hobi" required></label>
<label>Pasangan: <input type="text" name="pasangan"></label>
<label>Pekerjaan: <input type="text" name="pekerjaan"></label>
<label>Nama Orang Tua: <input type="text" name="nama_ortu" required></label>
<label>Nama Kakak: <input type="text" name="nama_kakak"></label>
<label>Nama Adik: <input type="text" name="nama_adik"></label>
<button type="submit">Simpan</button>
<button type="reset">Reset</button>
</form>
</section>


<section id="about">
<h2>Tentang Saya</h2>
<p>NIM: 2511500051</p>
<p>Nama Lengkap: Cintia Divanti Agustin</p>
<p>Tempat Lahir: Sumber Jayapermai</p>
<p>Tanggal Lahir: 05 Maret 2007</p>
<p>Hobi: Mencoba hal baru</p>
<p>Pasangan: Single</p>
<p>Pekerjaan: Mahasiswa dan usaha nail art</p>
<p>Orang Tua: Agus Salim & Puji Sulistiowati</p>
<p>Kakak: Refana Fernanda Mariska</p>
<p>Adik: Athallah Rafasya Bagasditya</p>
</section>

<section id="contact">
      <h2>Kontak Kami</h2>
      <form action="" method="GET">

        <label for="txtNama"><span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail"><span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan"><span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>


        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>
  </main>

<footer>
<p>&copy; 2025 Cintia Divanti Agustin</p>
</footer>

</body>
</html>
