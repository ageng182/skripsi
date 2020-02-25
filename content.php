<?php

include "config/koneksi.php";
include "./config/fungsi_indotgl.php";
include "./config/fungsi_rupiah.php";

// Bagian dashboard
if ($_GET['module'] == 'dashboard') {
    include"modules/dashboard/dashboard.php";
} else

// Bagian Tools
if ($_GET['module'] == 'barang') {
    include"modules/barang/barang.php";
} else

// Bagian User
if ($_GET['module'] == 'pengguna') {
    include"modules/pengguna/pengguna.php";
} else

// Bagian Penggajian
if ($_GET['module'] == 'peramalan') {
    include"modules/peramalan/peramalan.php";
} else

// Bagian presensi
if ($_GET['module'] == 'grafik') {
    include"modules/grafik/grafik.php";
} else
// Bagian Work Order
if ($_GET['module'] == 'rekap') {
    include"modules/rekap/rekap.php";
} else {
// Apabila modul tidak ditemukan
    echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
