<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $_SESSION["nim"]       = $_POST["nim"];
  $_SESSION["nama"]      = $_POST["nama"];
  $_SESSION["tempat"]    = $_POST["tempat_lahir"];
  $_SESSION["tanggal"]   = $_POST["tanggal_lahir"];
  $_SESSION["hobi"]      = $_POST["hobi"];
  $_SESSION["pasangan"]  = $_POST["pasangan"];
  $_SESSION["pekerjaan"] = $_POST["pekerjaan"];
  $_SESSION["ortu"]      = $_POST["nama_ortu"];
  $_SESSION["kakak"]     = $_POST["nama_kakak"];
  $_SESSION["adik"]      = $_POST["nama_adik"];
}

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

header("Location: index.php#data-mahasiswa");
exit;
?>
