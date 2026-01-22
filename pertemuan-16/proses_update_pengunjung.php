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
$kode_pengunjung  = bersihkan($_POST['txtKodePengunjung']  ?? '');
$nama_pengunjung = bersihkan($_POST['txtNamaPengunjung'] ?? '');
$tanggal_kunjungan = bersihkan($_POST['txtTanggalKunjungan'] ?? '');
$hobi = bersihkan($_POST['txtHobi'] ?? '');
$pasangan = bersihkan($_POST['txtPasangan'] ?? '');
$pekerjaan = bersihkan($_POST['txtPekerjaan'] ?? '');
$nama_orang_tua = bersihkan($_POST['txtNamaOrangTua'] ?? '');
$nama_pacar = bersihkan($_POST['txtNamaPacar'] ?? '');
$nama_mantan = bersihkan($_POST['txtNamaMantan'] ?? '');


#Validasi sederhana
$errors = []; #ini array untuk menampung semua error yang ada

if ($kode_pengunjung === '') {
  $errors[] = 'Kode Pengunjung wajib diisi.';
}

if ($nama_pengunjung === '') {
  $errors[] = 'Nama pengunjungwajib diisi.';
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
    'kode_pengunjung'     => $kode_pengunjung,
    'nama_pengunjung'     => $nama_pengunjung,
    'tanggal_kunjungan'   => $tanggal_kunjungan,
    'hobi'                => $hobi,
    'pasangan'            => $pasangan,
    'pekerjaan'           => $pekerjaan,
    'nama_orang_tua'      => $nama_orang_tua,
    'nama_pacar'          => $nama_pacar,
    'nama_mantan'         => $nama_mantan
  ];

  $_SESSION['flash_error_biodata'] = implode('<br>', $errors);
  redirect_ke('edit.php?cid=' . (int)$cid);
}

/*
    Prepared statement untuk anti SQL injection.
    menyiapkan query UPDATE dengan prepared statement 
    (WAJIB WHERE cid = ?)
  */
$stmt = mysqli_prepare($conn, "UPDATE tbl_pengunjung 
                                SET ckode_pengunjung = ?, cnama_pengunjung = ?, ctanggal_kunjungan = ?, chobi = ?, cpasangan = ?, cpekerjaan = ?, cnama_orang_tua = ?, cnama_pacar = ?, cnama_mantan = ? 
                                WHERE cid = ?");

if (!$stmt) {
  #jika gagal prepare, kirim pesan error (tanpa detail sensitif)
  $_SESSION['flash_error_biodata'] = 'Terjadi kesalahan sistem (prepare gagal).';
  redirect_ke('edit.php?cid=' . (int)$cid);
}


#bind parameter dan eksekusi (s = string, i = integer)
mysqli_stmt_bind_param($stmt, "ssssssssssi", $kode_pengunjung, $nama_pengunjung, $tanggal_kunjungan, $hobi, $pasangan, $pekerjaan, $nama_orang_tua, $nama_pacar, $nama_mantan, $cid);

if (mysqli_stmt_execute($stmt)) { #jika berhasil, kosongkan old value
  unset($_SESSION['old']);
  /*
      Redirect balik ke read.php dan tampilkan info sukses.
    */
  $_SESSION['flash_sukses_biodata'] = 'Terima kasih, data Anda sudah diperbaharui.';
  redirect_ke('read.php'); #pola PRG: kembali ke data dan exit()
} else { #jika gagal, simpan kembali old value dan tampilkan error umum
  $_SESSION['old'] = [
    'kode_pengunjung'     => $kode_pengunjung,
    'nama_pengunjung'     => $nama_pengunjung,
    'tanggal_kunjungan'   => $tanggal_kunjungan,
    'hobi'                => $hobi,
    'pasangan'            => $pasangan,
    'pekerjaan'           => $pekerjaan,
    'nama_orang_tua'      => $nama_orang_tua,
    'nama_pacar'          => $nama_pacar,
    'nama_mantan'         => $nama_mantan
  ];
  $_SESSION['flash_error_biodata'] = 'Data gagal diperbaharui. Silakan coba lagi.';
  redirect_ke('edit.php?cid=' . (int)$cid);
}
#tutup statement
mysqli_stmt_close($stmt);

redirect_ke('edit.php?cid=' . (int)$cid);
