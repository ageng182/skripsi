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
// Hapus pengguna
if ($module == 'pengguna' AND $act == 'delete') {

    mysqli_query($koneksi, "DELETE FROM pengguna WHERE id_pengguna='$_GET[id]'");
    header('location:../../module.php?module=' . $module);
}

// Input pengguna
elseif ($module == 'pengguna' AND $act == 'input') {

    $pass = md5($_POST[password]);

    mysqli_query($koneksi, "INSERT INTO pengguna(nama,username,password,level) VALUES('$_POST[nama]','$_POST[username]','$pass','$_POST[level]')");
    header('location:../../module.php?module=' . $module);
}

// Update Kategori
elseif ($module == 'pengguna' AND $act == 'update') {

    if (empty($_POST[password])) {
        mysqli_query($koneksi, "UPDATE pengguna SET nama='$_POST[nama]',username = '$_POST[username]',level = '$_POST[level]' WHERE id_pengguna='$_POST[id_pengguna]'");
    } else {
        $pass = md5($_POST[password]);

        mysqli_query($koneksi, "UPDATE pengguna SET nama='$_POST[nama]',username = '$_POST[username]',password = '$pass',level = '$_POST[level]' WHERE id_pengguna='$_POST[id_pengguna]'");
    }
    header('location:../../module.php?module=' . $module);
}
?>
