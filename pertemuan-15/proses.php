<?php
session_start();
require __DIR__ . './koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error'] = 'Akses tidak valid.';
  redirect_ke('index.php#contact');
}

#ambil dan bersihkan nilai dari form
$nim  = bersihkan($_POST['txtNim']  ?? '');
$nama_lengkap = bersihkan($_POST['txtNamaLengkap'] ?? '');
$tempat_lahir = bersihkan($_POST['txtTempatLahir'] ?? '');
$tanggal_lahir = bersihkan($_POST['txtTanggalLahir'] ?? '');
$hobi = bersihkan($_POST['txtHobi'] ?? '');
$pasangan = bersihkan($_POST['txtPasangan'] ?? '');
$pekerjaan = bersihkan($_POST['txtPekerjaan'] ?? '');
$nama_orang_tua = bersihkan($_POST['txtNamaOrangTua'] ?? '');
$nama_kakak = bersihkan($_POST['txtNamaKakak'] ?? '');
$nama_adik = bersihkan($_POST['txtNamaAdik'] ?? '');

#Validasi sederhana
$errors = []; #ini array untuk menampung semua error yang ada

if ($nim === '') {
  $errors[] = 'NIM wajib diisi.';
}

if ($nama_lengkap === '') {
  $errors[] = 'Nama wajib diisi.';
}

if ($tempat_lahir === '') {
  $errors[] = 'Tempat lahir wajib diisi.';
}

if ($tanggal_lahir === '') {
  $errors[] = 'Tanggal lahir wajib diisi.';
}

if ($hobi === '') {
  $errors[] = 'Hobi wajib diisi.';
}

if ($pasangan === '') {
  $errors[] = 'Pasangan wajib diisi.';
}

if ($pekerjaan === '') {
  $errors[] = 'Pekerjaan wajib diisi.';
}

if ($nama_orang_tua === '') {
  $errors[] = 'Nama orang tua wajib diisi.';
}

if ($nama_kakak === '') {
  $errors[] = 'Nama kakak wajib diisi.';
}

if ($nama_adik === '') {
  $errors[] = 'Nama adik wajib diisi.';
}

/*
kondisi di bawah ini hanya dikerjakan jika ada error, 
simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
*/
if (!empty($errors)) {
  $_SESSION['old'] = [
    'nim'  => $nim,
    'nama_lengkap' => $nama_lengkap,
    'tempat_lahir' => $tempat_lahir,
    'tanggal_lahir' => $tanggal_lahir,
    'hobi' => $hobi,
    'pasangan' => $pasangan,
    'pekerjaan' => $pekerjaan,
    'nama_orang_tua' => $nama_orang_tua,
    'nama_kakak' => $nama_kakak,
    'nama_adik' => $nama_adik
  ];
  $_SESSION['flash_error'] = implode('<br>', $errors);
  redirect_ke('index.php#contact');
}

#menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO tbl_mahasiswa (cnim, cnama_lengkap, ctempat_lahir, ctanggal_lahir, chobi, cpasangan, cpekerjaan, cnama_orang_tua, cnama_kakak, cnama_adik) VALUES (?, ?, ?, ?, ?, ?, ?, ? ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  #jika gagal prepare, kirim pesan error ke pengguna (tanpa detail sensitif)
  $_SESSION['flash_error'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('index.php#contact');
}
#bind parameter dan eksekusi (s = string)
mysqli_stmt_bind_param($stmt, "ssssssssss", $nim, $nama_lengkap, $tempat_lahir, $tanggal_lahir, $hobi, $pasangan, $pekerjaan, $nama_orang_tua, $nama_kakak, $nama_adik);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value, beri pesan sukses
  unset($_SESSION['old']);
  $_SESSION['flash_sukses'] = 'Terima kasih, data Anda sudah tersimpan.';
  redirect_ke('index.php#contact'); #pola PRG: kembali ke form / halaman home
} else { #jika gagal, simpan kembali old value dan tampilkan error umum
  $_SESSION['old'] = [
    'nim'  => $nim,
    'nama_lengkap' => $nama_lengkap,
    'tempat_lahir' => $tempat_lahir,
    'tanggal_lahir' => $tanggal_lahir,
    'hobi' => $hobi,
    'pasangan' => $pasangan,
    'pekerjaan' => $pekerjaan,
    'nama_orang_tua' => $nama_orang_tua,
    'nama_kakak' => $nama_kakak,
    'nama_adik' => $nama_adik
  ];
  $_SESSION['flash_error'] = 'Data gagal disimpan. Silakan coba lagi.';
  redirect_ke('index.php#contact');
}
#tutup statement
mysqli_stmt_close($stmt);

$arrBiodata = [
  "nim" => $_POST["txtNim"] ?? "",
  "nama" => $_POST["txtNmLengkap"] ?? "",
  "tempat" => $_POST["txtT4Lhr"] ?? "",
  "tanggal" => $_POST["txtTglLhr"] ?? "",
  "hobi" => $_POST["txtHobi"] ?? "",
  "pasangan" => $_POST["txtPasangan"] ?? "",
  "pekerjaan" => $_POST["txtKerja"] ?? "",
  "ortu" => $_POST["txtNmOrtu"] ?? "",
  "kakak" => $_POST["txtNmKakak"] ?? "",
  "adik" => $_POST["txtNmAdik"] ?? ""
];
$_SESSION["biodata"] = $arrBiodata;

header("location: index.php#about");
