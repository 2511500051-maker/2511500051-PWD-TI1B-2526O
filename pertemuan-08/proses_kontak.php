<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["sesnama"] = $_POST["nama"];
    $_SESSION["sesemail"] = $_POST["email"];
    $_SESSION["sespesan"] = $_POST["pesan"];

    header("Location: index.php#kontak");
    exit;
}
