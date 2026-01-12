<?php
session_start();
require __DIR__ . '/koneksi.php';
require_once __DIR__ . '/fungsi.php';

#cek method form, hanya izinkan POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  $_SESSION['flash_error_biodata'] = 'Akses tidak valid.';
  redirect_ke('read.php');
}

#validasi cid wajib angka dan > 0
$cid = filter_input(INPUT_POST, 'cid', FILTER_VALIDATE_INT, [
  'options' => ['min_range' => 1]
]);

if (!$cid) {
  $_SESSION['flash_error_biodata'] = 'CID Tidak Valid.';
  redirect_ke('edit.php?cid=' . (int)$cid);
}

#ambil dan bersihkan (sanitasi) nilai dari form
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

  $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
  redirect_ke('edit.php?cid=' . (int)$cid);
}

/*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE cid = ?)
  */
$stmt = mysqli_prepare($conn, "UPDATE tbl_mahasiswa 
                                SET cnim = ?, cnama_lengkap = ?, ctempat_lahir = ?, ctanggal_lahir = ?, chobi = ?, cpasangan = ?, cpekerjaan = ?, cnama_orang_tua = ?, cnama_kakak = ?, cnama_adik = ? 
                                WHERE cid = ?");
if (!$stmt) {
  #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
  $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('edit.php?cid=' . (int)$cid);
}


#bind parameter dan eksekusi (s = string, i = integer)
mysqli_stmt_bind_param($stmt, "ssssssssssi", $nim, $nama_lengkap, $tempat_lahir, $tanggal_lahir, $hobi, $pasangan, $pekerjaan, $nama_orang_tua, $nama_kakak, $nama_adik, $cid);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
  unset($_SESSION['old']);
  /*
      Redirect balik ke read.php dan tampilkan info sukses.
    */
  $_SESSION['flash_sukses_biodata'] = 'Terima kasih, data Anda sudah diperbaharui.';
  redirect_ke('read.php'); #pola PRG: kembali ke data dan exit()
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
  $_SESSION['flash_error_biodata'] = 'Data gagal diperbaharui. Silakan coba lagi.';
  redirect_ke('edit.php?cid=' . (int)$cid);
}
#tutup statement
mysqli_stmt_close($stmt);

redirect_ke('edit.php?cid=' . (int)$cid);
