<?php
include "../config/fungsi_rupiah.php";

$aksi = "modules/barang/aksi_barang.php";
switch ($_GET[act]) {
// Tampil kriteria
    default:
        ?>

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Barang</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">

                        <button onclick="location.href = '?module=barang&act=add';" type="button" class="btn btn-info d-none d-lg-block m-l-15">
                            <i class="ti-plus"></i> Tambah</button>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Barang</h4>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">
                                                No.
                                            </th>
                                            <th>
                                                Nama
                                            </th>

                                            <th>
                                                Harga Sewa Harian
                                            </th>
                                            <th>
                                                Jumlah Barang
                                            </th>
                                            <th style="width: 100px">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM barang  ORDER BY nama_barang ASC");
                                        $no = 1;
                                        while ($r = mysqli_fetch_array($tampil)) {
                                            ?>
                                            <tr>
                                                <td >
                                                    <?php echo $no++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['nama_barang']; ?>
                                                </td>

                                                <td>
                                                    <?php echo 'Rp. ' . format_rupiah($r['harga']); ?>
                                                </td>
                                                <td>
                                                    <?php echo format_rupiah($r['jumlah_barang']); ?>
                                                </td>
                                                <td>
                                                    <a href="?module=barang&act=edit&id=<?php echo $r[id_barang]; ?>" class="btn btn-sm btn-warning"><i class="ti-pencil-alt"></i></a>
                                                    <a href="<?= $aksi ?>?module=barang&act=delete&id=<?php echo $r[id_barang]; ?>" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>
                                                </td>

                                                <?php
                                            }
                                            ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php
        break;
    case 'add':
        ?>


        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Barang</h4>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h4 class="card-title">Form Tambah Barang</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?= $aksi ?>?module=barang&act=input" method="POST">

                                    <div class="form-group">
                                        <label for="nama_barang">Nama</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter Nama Barang">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Sewa Harian (Rp.)</label>
                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter Harga Sewa">
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_barang">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="Enter Jumlah Barang">
                                    </div>


                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button type="button" onclick="location.href = '?module=barang';"  class="btn btn-dark">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <?php
        break;

    case 'edit':
        $edit = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$_GET[id]'");
        $r = mysqli_fetch_array($edit);
        ?>

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Barang</h4>
                </div>

            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Start Page Content -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-12">
                    <div class="card card-body">
                        <h4 class="card-title">Form Ubah Barang</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?= $aksi ?>?module=barang&act=update" method="POST">

                                    <div class="form-group">
                                        <label for="nama_barang">Nama</label>
                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Enter Nama Barang" value="<?= $r[nama_barang] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="harga">Harga Sewa Harian (Rp.)</label>
                                        <input type="text" class="form-control" id="harga" name="harga" placeholder="Enter Harga Sewa" value="<?= $r[harga] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah_barang">Jumlah Barang</label>
                                        <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="Enter Jumlah Barang" value="<?= $r[jumlah_barang] ?>">
                                    </div>

                                    <input type="hidden" class="form-control" id="jumlah_barang" name="id_barang" value="<?= $r[id_barang] ?>">

                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button type="button" onclick="location.href = '?module=barang';"  class="btn btn-dark">Cancel</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
}
?>
