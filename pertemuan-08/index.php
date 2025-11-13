<?php
session_start();

$sesnim = "";
if (isset($_SESSION["nim"] = $nim));{
  $sesnim = $_SESSION["sesnim"];
endif;

$sesnama = "";
if (isset($_SESSION["nama"] = $nama));
  $sesnama = $_SESSION["sesnama"];
endif;

$sesnama = "";
if (isset($_SESSION["tempat"] = $tempat));
  $sestempat = $_SESSION["sestempat"];
endif;

$sesnama = "";
if (isset($_SESSION["tanggal"] = $tanggal));
  $sestempat = $_SESSION["sestempat"]
endif;

$sesnama = "";
if (isset($_SESSION["hobi"] = $hobi));
  $seshobi = $_SESSION["seshobi"];
endif;

$sesnama = "";
if (isset($_SESSION["pasangan"] = $pasangan));
  $sespasangan = $_SESSION["sespasangan"];
endif;

$sesnama = "";
if (isset($_SESSION["pekerjaan"] = $pekerjaan));
  $sespekerjaan = $_SESSION["sespekerjaan"];
endif;

$sesnama = "";
if (isset($_SESSION["ortu"] = $ortu));
  $sesortu = $_SESSION["sesortu"];
endif;

$sesnama = "";
if (isset($_SESSION["kakak"] = $kakak));
  $seskakak = $_SESSION["seskakak"];
endif;

$sesnama = "";
if (isset($_SESSION["adik"] = $adik));
  $sesadik = $_SESSION["sesadik"];
endif;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Judul Halaman</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <header>
    <h1>Ini Header</h1>
    <button class="menu-toggle" id="menuToggle" aria-label="Toggle Navigation">
      &#9776;
    </button>
    <nav>
      <ul>
        <li><a href="#home">Beranda</a></li>
        <li><a href="#about">Tentang</a></li>
        <li><a href="#contact">Kontak</a></li>
      </ul>
    </nav>
  </header>
  <main>
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya hadi";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>
<section id="entry">
      <h2>Entry Data Mahasiswa</h2>
      <form action="proses_entry.php" method="POST">
        
      <label for="txtNim"><span>NIM:</span>
        <input type="text" id="txtNim" nama="txtNim" placeholder="Masukan nim" required autocomplete="nim">
        </label>

        <label for="txtNama"><span>Nama Lengkap:</span>
        <input type="text" id="txtNama" name="txtNama"  placeholder="Masukan nama lengkap" required autocomplete="nama">
        </label>

        <label for="txtTempat"><span>Tempat Lahir:</span>
        <input type="text" id="txtTempat" name="txtTempat" placeholder="Masukan tempat lahir" required autocomplete="tempat">
        </label>

        <label for="txtTanggal"><span>Tanggal Lahir:</span>
        <input type="date" id="txtTanggal" name="txtTanggal" placeholder="Masukan tanggal lahir" required autocomplete="tanggal">
        </label>

        <label for="txtHobi"><span>Hobi:</span>
        <input type="text" id="txtHobi" name="txthobi" placeholder="Masukan Hobi" required autocomplete="hobi">
        </label>

        <label for="txtPasangan"><span>Pasangan:</span>
        <input type="text" id="txtPasangan" name="txtpasangan" placeholder="Masukan pasangan" required autocomplete="pasangan">
        </label>

        <label for="txtPekerjaan"><span>Pekerjaan:</span>
        <input type="text" id="txtPasangan" name="txtpekerjaan" placeholder="Masukan pekerjaan" required autocomplete="pekerjaan">
        </label>

        <label for="txtNamaOrtu"><span>Nama Orang Tua:</span>
        <input type="text" id="txtNamaOrtu" name="txtortu" placeholder="Masukan nama orang tua" required autocomplete="ortu">
        </label>

        <label for="txtNamaKakak"><span>Nama Kakak:</span>
        <input type="text" id="txtKakak" name="txtkakak" placeholder="Masukan nama kakak" required autocomplete="namakakak">
        </label>

        <label for="txtNamaAdik"><span>Nama Adik:</span>
        <input type="text" id="txtNamaAdik" name="txtadik" placeholder="Masukan nama adik" required autocomplete="namaadik">
        </label>

        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
      </form>
    </section>

    <section id="about">
      <?php
      $nim = 2511500010;
      $NIM = '0344300002';
      $nama = "Say'yid Abdullah";
      $Nama = 'Al\'kautar Benyamin';
      $tempat = "Jebus";
      ?>
      <h2>Tentang Saya</h2>
      <p><strong>NIM:</strong>
        <?php
        echo $NIM;
        ?>
      </p>
      <p><strong>Nama Lengkap:</strong>
        <?php
        echo $Nama;
        ?> &#128526;
      </p>
      <p><strong>Tempat Lahir:</strong> <?php echo $tempat; ?></p>
      <p><strong>Tanggal Lahir:</strong> 1 Januari 2000</p>
      <p><strong>Hobi:</strong> Memasak, coding, dan bermain musik &#127926;</p>
      <p><strong>Pasangan:</strong> Belum ada &hearts;</p>
      <p><strong>Pekerjaan:</strong> Dosen di ISB Atma Luhur &copy; 2025</p>
      <p><strong>Nama Orang Tua:</strong> Bapak Setiawan dan Ibu Maria</p>
      <p><strong>Nama Kakak:</strong> Antonius Setiawan</p>
      <p><strong>Nama Adik:</strong> <?php echo $sespesan ?></p>
    </section>

    <section id="contact">
      <h2>Kontak Kami</h2>
      <form action="proses.php" method="POST">

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

      <?php if (!empty($sesnama)): ?>
        <br><hr>
        <h2>Yang menghubungi kami</h2>
        <p><strong>Nama :</strong> <?php echo $sesnama ?></p>
        <p><strong>Email :</strong> <?php echo $sesemail ?></p>
        <p><strong>Pesan :</strong> <?php echo $sespesan ?></p>
      <?php endif; ?>



    </section>
  </main>

  <footer>
    <p>&copy; 2025 Yohanes Setiawan Japriadi [0344300002]</p>
  </footer>

  <script src="script.js"></script>
</body>

</html>