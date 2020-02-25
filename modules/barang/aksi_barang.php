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
// Hapus barang
if ($module == 'barang' AND $act == 'delete') {

    mysqli_query($koneksi, "DELETE FROM barang WHERE id_barang='$_GET[id]'");
    header('location:../../module.php?module=' . $module);
}

// Input barang
elseif ($module == 'barang' AND $act == 'input') {


    mysqli_query($koneksi, "INSERT INTO barang(nama_barang,harga,jumlah_barang) VALUES('$_POST[nama_barang]','$_POST[harga]','$_POST[jumlah_barang]')");
    header('location:../../module.php?module=' . $module);
}

// Update Kategori
elseif ($module == 'barang' AND $act == 'update') {

   
        mysqli_query($koneksi, "UPDATE barang SET nama_barang='$_POST[nama_barang]',harga = '$_POST[harga]',jumlah_barang = '$_POST[jumlah_barang]' WHERE id_barang='$_POST[id_barang]'");
    
    header('location:../../module.php?module=' . $module);
}
?>
