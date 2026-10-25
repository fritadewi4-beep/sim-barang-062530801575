<?php
session_start();
require "Barang.php";

// Halaman ini hanya untuk pengguna yang sudah login
if (!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] !== true) {
    header("Location: login.php");
    exit;
}

// Fungsi untuk menghitung total estimasi nilai aset
function hitungTotalAset($jumlah, $harga)
{
    return $jumlah * $harga;
}

// Kalau dibuka langsung tanpa kirim form, kembali ke halaman utama
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

// Tangkap data form dengan $_POST
$kode     = htmlspecialchars(trim($_POST["kode"]));
$nama     = htmlspecialchars(trim($_POST["nama"]));
$kategori = htmlspecialchars($_POST["kategori"]);
$jumlah   = (int) $_POST["jumlah"];
$harga    = (float) $_POST["harga"];
$kondisi  = htmlspecialchars($_POST["kondisi"]);

// Buat objek dari class Barang (Pastikan method di class Barang.php bernama tampilkanInfo atau getInfoBarang)
$barang = new Barang($kode, $nama, $jumlah);

$total = hitungTotalAset($jumlah, $harga);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ringkasan Input Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>SIM-Barang</h1>
        <p>Ringkasan Pemrosesan Data Barang</p>
    </header>

    <main style="grid-template-columns: 1fr;">
        <section>
            <h2>Data barang berhasil diterima</h2>
            <table>
                <tr><th>Informasi Barang (class Barang)</th><td><?= method_exists($barang, 'tampilkaninfo') ? $barang->tampilkaninfo() : $barang->getInfoBarang() ?></td></tr>
                <tr><th>Kode Barang</th><td><?= $kode ?></td></tr>
                <tr><th>Nama Barang</th><td><?= $nama ?></td></tr>
                <tr><th>Kategori</th><td><?= $kategori ?></td></tr>
                <tr><th>Jumlah</th><td><?= $jumlah ?></td></tr>
                <tr><th>Kondisi</th><td><?= $kondisi ?></td></tr>
                <tr><th>Harga Satuan</th><td>Rp <?= number_format($harga, 0, ",", ".") ?></td></tr>
                <tr><th>Total Estimasi Nilai Aset</th>
                    <td><strong>Rp <?= number_format($total, 0, ",", ".") ?></strong></td></tr>
            </table>
            <p style="margin-top: 16px;"><a href="index.php">Kembali ke halaman utama</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 SIM-Barang | Afrita Mukti Sari dewi | 062530801575 | 3IB</p>
    </footer>

</body>
</html>