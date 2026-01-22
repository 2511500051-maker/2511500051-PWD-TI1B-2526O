<?php
session_start();
require __DIR__ . './koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
  redirect_ke('index.php#biodata');
}

#ambil dan bersihkan nilai dari form
$kode_pengunjung  = bersihkan($_POST['txtKodePengunjung']  ?? '');
$nama_pengunjung = bersihkan($_POST['txtNamaPengunjung'] ?? '');
$tanggal_kunjungan = bersihkan($_POST['txtTanggalKunjungan']   ?? '');
$hobi          = bersihkan($_POST['txtHobi']     ?? '');
$pasangan      = bersihkan($_POST['txtPasangan'] ?? '');
$pekerjaan     = bersihkan($_POST['txtPekerjaan']    ?? '');
$nama_orang_tua = bersihkan($_POST['txtNamaOrangTua']   ?? '');
$nama_pacar    = bersihkan($_POST['txtNamaPacar']  ?? '');
$nama_mantan   = bersihkan($_POST['txtNamaMantan']   ?? '');


#Validasi sederhana
$errors = []; #ini array untuk menampung semua error yang ada

if ($kode_pengunjung === '') {
  $errors[] = 'Kode Pengunjung wajib diisi.';
}

if ($nama_pengunjung === '') {
  $errors[] = 'Nama pengunjung wajib diisi.';
}

if ($tanggal_kunjungan === '') {
  $errors[] = 'Tanggal kunjungan wajib diisi.';
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

if ($nama_pacar === '') {
  $errors[] = 'Nama pacar wajib diisi.';
}

if ($nama_mantan === '') {
  $errors[] = 'Nama mantan wajib diisi.';
}

/*
kondisi di bawah ini hanya dikerjakan jika ada error, 
simpan nilai lama dan pesan error, lalu redirect (konsep PRG)
*/
if (!empty($errors)) {
  $_SESSION['old'] = [
    'kode_pengunjung'    => $kode_pengunjung,
    'nama_pengunjung'    => $nama_pengunjung,
    'tanggal_kunjungan'  => $tanggal_kunjungan,
    'hobi'               => $hobi,
    'pasangan'           => $pasangan,
    'pekerjaan'          => $pekerjaan,
    'nama_orang_tua'     => $nama_orang_tua,
    'nama_pacar'         => $nama_pacar,
    'nama_mantan'        => $nama_mantan
  ];
  $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
  redirect_ke('index.php#biodata');
}

#menyiapkan query INSERT dengan prepared statement
$sql = "INSERT INTO tbl_pengunjung (ckode_pengunjung, cnama_pengunjung, ctanggal_kunjungan, chobi, cpasangan, cpekerjaan, cnama_orang_tua, cnama_pacar, cnama_mantan)
 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
  #jika gagal prepare, kirim pesan error ke pengguna (tanpa detail sensitif)
  $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('index.php#biodata');
}
#bind parameter dan eksekusi (s = string)
mysqli_stmt_bind_param($stmt, "ssssssssss", $nim, $nama_lengkap, $tempat_lahir, $tanggal_lahir, $hobi, $pasangan, $pekerjaan, $nama_orang_tua, $nama_kakak, $nama_adik);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value, beri pesan sukses
  unset($_SESSION['old']);
  $_SESSION['flash_sukses_biodata'] = 'Terima kasih, data Anda sudah tersimpan.';
  redirect_ke('index.php#biodata'); #pola PRG: kembali ke form / halaman home
} else { #jika gagal, simpan kembali old value dan tampilkan error umum
  $_SESSION['old'] = [
    'kode_pengunjung'    => $kode_pengunjung,
    'nama_pengunjung'    => $nama_pengunjung,
    'tanggal_kunjungan'  => $tanggal_kunjungan,
    'hobi'               => $hobi,
    'pasangan'           => $pasangan,
    'pekerjaan'          => $pekerjaan,
    'nama_orang_tua'     => $nama_orang_tua,
    'nama_pacar'         => $nama_pacar,
    'nama_mantan'        => $nama_mantan
  ];
  $_SESSION['flash_error_biodata'] = 'Data gagal disimpan. Silakan coba lagi.';
  redirect_ke('index.php#biodata');
}
#tutup statement
mysqli_stmt_close($stmt);

$biodata = [
  "kode_pengunjung"    => $_POST["txtKodePengunjung"] ?? "",
  "nama_pengunjung"    => $_POST["txtNamaPengunjung"] ?? "",
  "tanggal_kunjungan"  => $_POST["txtTglKunjungan"] ?? "",
  "hobi"               => $_POST["txtHobi"] ?? "",
  "pasangan"           => $_POST["txtPasangan"] ?? "",
  "pekerjaan"          => $_POST["txtKerja"] ?? "",
  "ortu"               => $_POST["txtNmOrtu"] ?? "",
  "pacar"              => $_POST["txtNmPacar"] ?? "",
  "mantan"             => $_POST["txtNmMantan"] ?? ""
];
$_SESSION["biodata"] = $biodata;

header("location: index.php#about");
