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

header("Location: index.php#about");
exit;
?>
