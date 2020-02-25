<?php

session_start();

include "../../config/koneksi.php";


$module = $_GET['module'];
$act = $_GET['act'];

//print_r($_POST);
//print_r($_GET);
//
//die();
//echo $module;
//die();
// Hapus rekap
if ($module == 'rekap' AND $act == 'delete') {

    mysqli_query($koneksi, "DELETE FROM rekap WHERE id_rekap='$_GET[id]'");
    header('location:../../module.php?module=' . $module);
}

// Input rekap
elseif ($module == 'rekap' AND $act == 'input') {


    mysqli_query($koneksi, "INSERT INTO rekap(id_barang,tanggal,masuk,keluar,stok) VALUES('$_POST[id_barang]','$_POST[tanggal]','$_POST[masuk]','$_POST[keluar]','$_POST[stok]')");
    header('location:../../module.php?module=' . $module);
}

// Update Kategori
elseif ($module == 'rekap' AND $act == 'update') {


    mysqli_query($koneksi, "UPDATE rekap SET id_barang='$_POST[id_barang]',tanggal = '$_POST[tanggal]',masuk = '$_POST[masuk]',keluar = '$_POST[keluar]',stok = '$_POST[stok]' WHERE id_rekap='$_POST[id_rekap]'");

    header('location:../../module.php?module=' . $module);
}
?>
