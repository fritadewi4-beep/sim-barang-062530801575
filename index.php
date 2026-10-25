<?php
session_start();

// Proteksi halaman: Jika belum login, lempar kembali ke login.php
if (!isset($_SESSION["is_logged_in"]) || $_SESSION["is_logged_in"] !== true) {
    header("Location: login.php");
    exit;
}
?>

<?php
require "koneksi.php";

$sql = "SELECT b.kode_barang, b.nama_barang, k.nama_kategori, b.jumlah, b.kondisi
        FROM barang b
        JOIN kategori k ON b.kategori_id = k.id
        ORDER BY b.kode_barang";
$data = $pdo->query($sql)->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sim-Barang</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div>
            <h1>SIM-Barang</h1>
            <p>Sistem Informasi Manajemen Inventaris Barang Jurusan</p>
        </div>
        <div>
            <span style="margin-right: 15px; font-weight: bold;">Halo, <?= htmlspecialchars($_SESSION['user']) ?></span>
            <a href="logout.php" style="background: #c62828; color: #fff; padding: 8px 12px; border-radius: 4px; text-decoration: none;">Logout</a>
        </div>
    </header>

    <nav>
        <a href="#inventaris">Data Barang</a>
        <a href="#form">Tambah Barang</a>
        <a href="logout.php">Logout</a>
    </nav>

    <main>
        <section id="inventaris">
            <h2>Tabel Inventaris Barang</h2>
            <input type="text" id="cari" placeholder="Cari barang..." aria-label="Cari barang">
            <table>
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Jumlah</th>
                        <th>Kondisi</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['kode_barang']) ?></td>
                        <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                        <td><?= htmlspecialchars($row['nama_kategori']) ?></td>
                        <td><?= htmlspecialchars($row['jumlah']) ?></td>
                        <td><?= htmlspecialchars($row['kondisi']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section id="form">
            <h2>Formulir Input Barang</h2>
            <form id="formBarang" action="simpan.php" method="post">
                <label for="kode">Kode Barang</label>
                <input type="text" id="kode" name="kode" placeholder="BRG-001" required>

                <label for="nama">Nama Barang</label>
                <input type="text" id="nama" name="nama" placeholder="Nama barang" required>

                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori" required>
                    <option value="">-- Pilih Kategori --</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Furnitur">Furnitur</option>
                    <option value="Alat Lab">Alat Lab</option>
                </select>

                <label for="jumlah">Jumlah</label>
                <input type="number" id="jumlah" name="jumlah" min="1" placeholder="Contoh: 5" required>

                <label for="harga">Harga satuan (Rp)</label>
                <input type="number" id="harga" name="harga" min="1" placeholder="Contoh: 2500000" required>

                <label for="kondisi">Kondisi</label>
                <select id="kondisi" name="kondisi" required>
                    <option value="">-- Pilih Kondisi --</option>
                    <option value="Baik">Baik</option>
                    <option value="Rusak Ringan">Rusak Ringan</option>
                    <option value="Rusak Berat">Rusak Berat</option>
                </select>

                <button type="submit">Simpan</button>
            </form>
        </section>
    </main>

    <div id="toast" class="toast"></div>
    <script src="main.js"></script>

    <footer>
        <p>&copy; 2026 SIM-Barang | Afrita Mukti Sari Dewi | 062530801575 | 3IB</p>
    </footer>
</body>
</html>