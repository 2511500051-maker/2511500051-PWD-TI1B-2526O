<?php
session_start();

$sesnama = "";
if (isset($_SESSION["sesnama"])):
  $sesnama = $_SESSION["sesnama"];
endif;

$sesemail = "";
if (isset($_SESSION["sesemail"])):
  $sesemail = $_SESSION["sesemail"];
endif;

$sespesan = "";
if (isset($_SESSION["sespesan"])):
  $sespesan = $_SESSION["sespesan"];
endif;
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
        <li><a href="#data-mahasiswa">Data</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section id="home">
      <h2>Selamat Datang</h2>
      <?php
      echo "halo dunia!<br>";
      echo "nama saya DIVA";
      ?>
      <p>Ini contoh paragraf HTML.</p>
    </section>

        <section id="data-mahasiswa">
  <h2>Entry Data Mahasiswa</h2>

  <?php
if (isset($_SESSION["history_mahasiswa"]) && count($_SESSION["history_mahasiswa"]) > 0):
?>
<section id="history-mahasiswa">
  <h2>History Entry Data Mahasiswa</h2>
  <table border="1" cellpadding="8" cellspacing="0" style="width:100%; border-collapse: collapse;">
    <thead>
      <tr>
        <th>NIM</th>
        <th>Nama Lengkap</th>
        <th>Tempat Lahir</th>
        <th>Tanggal Lahir</th>
        <th>Hobi</th>
        <th>Pasangan</th>
        <th>Pekerjaan</th>
        <th>Nama Orang Tua</th>
        <th>Nama Kakak</th>
        <th>Nama Adik</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($_SESSION["history_mahasiswa"] as $entry): ?>
        <tr>
          <td><?= htmlspecialchars($entry["nim"]) ?></td>
          <td><?= htmlspecialchars($entry["nama"]) ?></td>
          <td><?= htmlspecialchars($entry["tempat_lahir"]) ?></td>
          <td><?= htmlspecialchars($entry["tanggal_lahir"]) ?></td>
          <td><?= htmlspecialchars($entry["hobi"]) ?></td>
          <td><?= htmlspecialchars($entry["pasangan"]) ?></td>
          <td><?= htmlspecialchars($entry["pekerjaan"]) ?></td>
          <td><?= htmlspecialchars($entry["nama_ortu"]) ?></td>
          <td><?= htmlspecialchars($entry["nama_kakak"]) ?></td>
          <td><?= htmlspecialchars($entry["nama_adik"]) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</section>
<?php endif; ?>

  <form action="proses_entry.php" method="POST">

      <label for="nim">
        <span>NIM:</span>
        <input type="text" id="nim" name="nim" placeholder="Masukkan NIM" required>
      </label>

      <label for="nama">
        <span>Nama Lengkap:</span>
        <input type="text" id="nama" name="nama" placeholder="Masukkan nama lengkap" required>
      </label>

      <label for="tempat_lahir">
        <span>Tempat Lahir:</span>
        <input type="text" id="tempat_lahir"  name="tempat_lahir" placeholder ="Masukan tempat lahir" required>
      </label>

      <label for="tanggal_lahir">
        <span>Tanggal Lahir:</span>
        <input type="date" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukan tanggal lahir" required>
      </label>

      <label for="hobi">
        <span>Hobi:</span>
        <input type="text" id="hobi" name="hobi" placeholder="Masukan hobi" required>
      </label>

      <label for="pasangan">
        <span>Pasangan:</span>
        <input type="text" id="pasangan" name="pasangan" placeholder="Masukan pasangan kalo ada" required>
      </label>

      <label for="pekerjaan">
        <span>Pekerjaan:</span>
        <input type="text" id="pekerjaan" name="pekerjaan" placeholder="Masukan pekerjaan jika bkn pengangguran" required>
      </label>

      <label for="nama_ortu">
        <span>Nama Orang Tua:</span>
        <input type="text" id="nama_ortu" name="nama_ortu" placeholder="Masukan nama orang tua" required>
      </label>

      <label for="nama_kakak">
        <span>Nama Kakak:</span>
        <input type="text" id="nama_kakak" name="nama_kakak" placeholder="Masukan nama kakak" required>
      </label>

      <label for="nama_adik">
        <span>Nama Adik:</span>
        <input type="text" id="nama_adik" name="nama_adik" placeholder="Masukan nama adek" required>
      </label>

        <label for="Nama">
          <span>Nama:</span>
          <input type="text" id="txtNama" name="txtNama" placeholder="Masukkan nama" required autocomplete="name">
        </label>

        <label for="txtEmail">
          <span>Email:</span>
          <input type="email" id="txtEmail" name="txtEmail" placeholder="Masukkan email" required autocomplete="email">
        </label>

        <label for="txtPesan">
          <span>Pesan Anda:</span>
          <textarea id="txtPesan" name="txtPesan" rows="4" placeholder="Tulis pesan anda..." required></textarea>
          <small id="charCount">0/200 karakter</small>
        </label>

     <div class="button-group">
        <button type="submit">Kirim</button>
        <button type="reset">Batal</button>
     </div>

  </form>
</section>

    <?php
if (session_status() === PHP_SESSION_NONE) {
  session_start();
}
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nim            = $_POST["nim"];
  $nama_lengkap   = $_POST["nama"];
  $tempat_lahir   = $_POST["tempat_lahir"];
  $tanggal_lahir  = $_POST["tanggal_lahir"];
  $hobi           = $_POST["hobi"];
  $pasangan       = $_POST["pasangan"];
  $pekerjaan      = $_POST["pekerjaan"];
  $nama_ortu      = $_POST["nama_ortu"];
  $nama_kakak     = $_POST["nama_kakak"];
  $nama_adik      = $_POST["nama_adik"];

   
 if (!isset($_SESSION["history_mahasiswa"])) {
   $_SESSION["history_mahasiswa"] = [];
}

   
  $_SESSION["history_mahasiswa"][] = [
    "nim"           => $_POST["nim"],
    "nama"          => $_POST["nama"],
    "tempat_lahir"  => $_POST["tempat_lahir"],
    "tanggal_lahir" => $_POST["tanggal_lahir"],
    "hobi"          => $_POST["hobi"],
    "pasangan"      => $_POST["pasangan"],
    "pekerjaan"     => $_POST["pekerjaan"],
    "nama_ortu"     => $_POST["nama_ortu"],
    "nama_kakak"    => $_POST["nama_kakak"],
    "nama_adik"     => $_POST["nama_adik"]
];

  $_SESSION["nim"]           = $nim;
  $_SESSION["nama_lengkap"]  = $nama_lengkap;
  $_SESSION["tempat_lahir"]  = $tempat_lahir;
  $_SESSION["tanggal_lahir"] = $tanggal_lahir;
  $_SESSION["hobi"]          = $hobi;
  $_SESSION["pasangan"]      = $pasangan;
  $_SESSION["pekerjaan"]     = $pekerjaan;
  $_SESSION["nama_ortu"]     = $nama_ortu;
  $_SESSION["nama_kakak"]    = $nama_kakak;
  $_SESSION["nama_adik"]     = $nama_adik;

  header("Location: index.php#data-mahasiswa");
  exit;
}
?>

    <section id="about">
      <?php

    $NIM = "2511500051";
    $Nama_lengkap = "Cintia Divanti Agustin";
    $Tempat_lahir = "Sumber Jayapermai";
    $Tanggal_lahir = "05 Maret 2007";
    $Hobby = "Mencoba hal baru";
    $Pasangan = "Single";
    $Pekerjaan = "Mahaganda mahasiswa dan usaha nail art";
    $Nama_Orang_Tua = "Agus salim dan Puji sulistiowati";
    $Nama_Kakak = "Refana fernanda mariska";
    $Nama_Adik = "Athallah rafasya bagasditya";
    ?>

      <h2>Tentang Saya</h2>
      <p><strong>NIM:</strong>
        <?php
        echo $NIM;
        ?>
      </p>
      <p><strong>Nama Lengkap:</strong>
        <?php
        echo $Nama_lengkap;
        ?> &#128526;
      </p>
      <p><strong>Tempat Lahir:</strong> <?php echo $Tempat_lahir; ?></p>
      <p><strong>Tanggal Lahir:</strong> <?php echo $Tanggal_lahir; ?></p>
      <p><strong>Hobi:</strong> <?php echo $Hobby;?></p>
      <p><strong>Pasangan:</strong> <?php echo $Pasangan;?></p>
      <p><strong>Pekerjaan:</strong> <?php echo $Pekerjaan;?></p>
      <p><strong>Nama Orang Tua:</strong> <?php echo $Nama_Orang_Tua;?></p>
      <p><strong>Nama Kakak:</strong> <?php echo $Nama_Kakak?></p>
    </section>

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
    <p>&copy; 2025 Cintia Divanti Agustin [2511500051]</p>
  </footer>

  <script src="script.js"></script>
</body>