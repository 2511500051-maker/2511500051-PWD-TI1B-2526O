<?php
session_start();
require 'koneksi.php';
require 'fungsi.php';
if (!isset($_SESSION['captcha_result']) || !isset($_SESSION['captcha_label'])) {
    $a = rand(1, 9);
    $b = rand(1, 9);
    $_SESSION['captcha_result'] = $a + $b;
    $_SESSION['captcha_label']  = "$a + $b";
}

/* validasi cid */
$cid = filter_input(INPUT_GET, 'cid', FILTER_VALIDATE_INT, [
    'options' => ['min_range' => 1]
]);

if (!$cid) {
    $_SESSION['flash_error'] = 'Akses tidak valid.';
    redirect_ke('read.php');
    exit;
}

/* flash message */
$flash_sukses = $_SESSION['flash_sukses'] ?? '';
$flash_error  = $_SESSION['flash_error'] ?? '';
$old          = $_SESSION['old'] ?? [];

unset($_SESSION['flash_sukses'], $_SESSION['flash_error'], $_SESSION['old']);

/* ambil data */
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT cid, cnama, cemail, cpesan FROM tbl_tamu WHERE cid = ? LIMIT 1"
);

if (!$stmt) {
    $_SESSION['flash_error'] = 'Query tidak benar.';
    redirect_ke('read.php');
    exit;
}

mysqli_stmt_bind_param($stmt, 'i', $cid);
mysqli_stmt_execute($stmt);
$res = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($res);
mysqli_stmt_close($stmt);

if (!$row) {
    $_SESSION['flash_error'] = 'Record tidak ditemukan.';
    redirect_ke('read.php');
    exit;
}

/* isi form */
$nama  = $old['nama']  ?? $row['cnama'];
$email = $old['email'] ?? $row['cemail'];
$pesan = $old['pesan'] ?? $row['cpesan'];

/* captcha (buat SEKALI) */
?>

<!DOCTYPE html>
<html lang="id">

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
        <section id="contact">
            <h2>Edit Buku Tamu</h2>

            <?php if (!empty($flash_sukses)) : ?>
                <div style="padding:10px; margin-bottom:10px; 
                        background: #d4edda; color: #155724; border-radius: 6px;">
                    <?= $flash_sukses; ?>
                </div>
            <?php endif; ?>
            <form action="proses_update.php" method="POST">

                <input type="hidden" name="cid" value="<?= (int)$cid; ?>">

                <label for="txtNama"><span>Nama:</span>
                    <input type="text" id="txtNama" name="txtNama"
                        placeholder="Masukkan nama" required autocomplete="name"
                       value="<?= htmlspecialchars($nama) ?>">
                </label>

                <label for="txtEmail"><span>Email:</span>
                    <input type="email" id="txtEmail" name="txtEmail"
                        placeholder="Masukkan email" required autocomplete="email"
                        value="<?= htmlspecialchars($email) ?>">
                </label>

                <label for="txtPesan"><span>Pesan Anda:</span>
                    <textarea id="txtPesan" name="txtPesan" rows="4"
                        placeholder="Tulis pesan anda..."
                        required><?= htmlspecialchars($pesan) ?></textarea>
                </label>

                <label for="txtCaptcha">
                    <span>Captcha (<?= $_SESSION['captcha_label']; ?> = ?):</span>
                    <input type="text" id="txtCaptcha" name="txtCaptcha" placeholder="Jawabannya?" required>
                </label>

                <button type="submit">Kirim</button>
                <button type="reset">Batal</button>
                <a href="read.php" class="reset">Kembali</a>
            </form>
        </section>
    </main>

    <script src="script.js"></script>
</body>

</html>