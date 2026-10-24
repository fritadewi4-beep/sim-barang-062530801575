// Ambil elemen yang dibutuhkan (sesuai id di index.html)
const form = document.querySelector("#form form");
const inputKode = document.getElementById("kode");
const inputJumlah = document.getElementById("jumlah");
const inputCari = document.getElementById("cari");
const baris = document.querySelectorAll("#inventaris tbody tr");
const toast = document.getElementById("toast");

// Fungsi menampilkan toast selama 3 detik
function tampilkanToast(pesan, jenis) {
    toast.textContent = pesan;
    toast.className = "toast tampil " + jenis;
    setTimeout(function () {
        toast.className = "toast";
    }, 3000);
}

// Fitur 1: pencarian tabel secara real-time
if (inputCari) {
    inputCari.addEventListener("input", function () {
        const kataKunci = inputCari.value.toLowerCase();
        baris.forEach(function (tr) {
            const teks = tr.textContent.toLowerCase();
            tr.style.display = teks.includes(kataKunci) ? "" : "none";
        });
    });
}

// Fitur 2: validasi formulir saat submit + toast
if (form) {
    form.addEventListener("submit", function (event) {
        event.preventDefault();

        const kode = inputKode.value.trim();
        const jumlah = Number(inputJumlah.value);

        // Kode wajib diawali "BRG-" lalu angka, contoh BRG-001
        const polaKode = /^BRG-\d+$/;
        if (!polaKode.test(kode)) {
            tampilkanToast('Kode barang harus diawali "BRG-" lalu angka, contoh: BRG-001', "error");
            inputKode.focus();
            return;
        }

        // Jumlah harus angka positif (lebih dari 0)
        if (isNaN(jumlah) || jumlah <= 0) {
            tampilkanToast("Jumlah barang harus berupa angka lebih dari 0", "error");
            inputJumlah.focus();
            return;
        }

        // Lolos validasi
        tampilkanToast("Data barang berhasil divalidasi!", "sukses");
        setTimeout(function ()) {
            form.sumbit();
        }, 800);
    });
}