<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $entry = [
        "nim" => $_POST["nim"],
        "nama" => $_POST["nama"],
        "tempat_lahir" => $_POST["tempat_lahir"],
        "tanggal_lahir" => $_POST["tanggal_lahir"],
        "hobi" => $_POST["hobi"],
        "pasangan" => $_POST["pasangan"],
        "pekerjaan" => $_POST["pekerjaan"],
        "nama_ortu" => $_POST["nama_ortu"],
        "nama_kakak" => $_POST["nama_kakak"],
        "nama_adik" => $_POST["nama_adik"]
    ];

    if (!isset($_SESSION["history_mahasiswa"])) {
        $_SESSION["history_mahasiswa"] = [];
    }

    $_SESSION["history_mahasiswa"][] = $entry;

    header("Location: index.php#data-mahasiswa");
    exit;
}
