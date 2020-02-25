<?php
include "../config/fungsi_rupiah.php";
include "../config/fungsi_indotgl.php";

$aksi = "modules/rekap/aksi_rekap.php";
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
                    <h4 class="text-themecolor">Rekap Rental</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">

                        <button onclick="location.href = '?module=rekap&act=add';" type="button" class="btn btn-info d-none d-lg-block m-l-15">
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
                            <h4 class="card-title">Data Rekap Rental</h4>
                            <div class="table-responsive m-t-40">
                                <table id="myTable" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 20px">
                                                No.
                                            </th>
                                            <th>
                                                Tanggal
                                            </th>
                                            <th>
                                                Nama Barang
                                            </th>

                                            <th>
                                                Masuk (Buah)
                                            </th>
                                            <th>
                                                Keluar (Buah)
                                            </th>
                                            <th>
                                                Setok (Buah)
                                            </th>
                                            <th style="width: 100px">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM rekap JOIN barang ON rekap.id_barang=barang.id_barang ORDER BY tanggal DESC");
                                        $no = 1;
                                        while ($r = mysqli_fetch_array($tampil)) {
                                            ?>
                                            <tr>
                                                <td >
                                                    <?php echo $no++; ?>
                                                </td>
                                                <td>
                                                    <?php echo tgl_indo($r['tanggal']); ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['nama_barang']; ?>
                                                </td>

                                                <td>
                                                    <?php echo format_rupiah($r['masuk']); ?>
                                                </td>
                                                <td>
                                                    <?php echo format_rupiah($r['keluar']); ?>
                                                </td>
                                                <td>
                                                    <?php echo format_rupiah($r['stok']); ?>
                                                </td>
                                                <td>
                                                    <a href="?module=rekap&act=edit&id=<?php echo $r[id_rekap]; ?>" class="btn btn-sm btn-warning"><i class="ti-pencil-alt"></i></a>
                                                    <a href="<?= $aksi ?>?module=rekap&act=delete&id=<?php echo $r[id_rekap]; ?>" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>
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
                    <h4 class="text-themecolor">Rekap Rental</h4>
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
                        <h4 class="card-title">Form Tambah Rekap Rental</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?= $aksi ?>?module=rekap&act=input" method="POST">
                                    <div class="form-group">
                                        <label for="masuk">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Enter Tanggal" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Barang</label>
                                        <select class="form-control custom-select" name="id_barang" required>
                                            <option value="">--Pilih Barang--</option>
                                            <?php
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM barang  ORDER BY nama_barang ASC");
                                            while ($rb = mysqli_fetch_array($tampil)) {
                                                ?>
                                                <option value="<?= $rb[id_barang] ?>"><?= $rb[nama_barang] ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="masuk">Masuk (Buah)</label>
                                        <input type="number" class="form-control" id="masuk" name="masuk" placeholder="Enter Barang Masuk" value="0">
                                    </div>
                                    <div class="form-group">
                                        <label for="keluar">Keluar (Buah)</label>
                                        <input type="number" class="form-control" id="keluar" name="keluar" placeholder="Enter Barang Keluar" value="0">
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok (Buah)</label>
                                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Enter Jumlah Stok" value="0">
                                    </div>


                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button type="button" onclick="location.href = '?module=rekap';"  class="btn btn-dark">Cancel</button>
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
        $edit = mysqli_query($koneksi, "SELECT * FROM rekap WHERE id_rekap='$_GET[id]'");
        $r = mysqli_fetch_array($edit);
        ?>

        
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Rekap Rental</h4>
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
                        <h4 class="card-title">Form Edit Rekap Rental</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?= $aksi ?>?module=rekap&act=update" method="POST">
                                    <div class="form-group">
                                        <label for="masuk">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" placeholder="Enter Tanggal" required value="<?= $r[tanggal] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Barang</label>
                                        <select class="form-control custom-select" name="id_barang" required>
                                            <option value="">--Pilih Barang--</option>
                                            <?php
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM barang  ORDER BY nama_barang ASC");
                                            while ($rb = mysqli_fetch_array($tampil)) {
                                                ?>
                                                <option <?= $r[id_barang]==$rb[id_barang]?'selected':NULL ?> value="<?= $rb[id_barang] ?>"><?= $rb[nama_barang] ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="masuk">Masuk (Buah)</label>
                                        <input type="number" class="form-control" id="masuk" name="masuk" placeholder="Enter Barang Masuk" value="<?= $r[masuk] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keluar">Keluar (Buah)</label>
                                        <input type="number" class="form-control" id="keluar" name="keluar" placeholder="Enter Barang Keluar" value="<?= $r[keluar] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok (Buah)</label>
                                        <input type="number" class="form-control" id="stok" name="stok" placeholder="Enter Jumlah Stok" value="<?= $r[stok] ?>">
                                    </div>

                                    <input type="hidden" class="form-control" id="jumlah_rekap" name="id_rekap" value="<?= $r[id_rekap] ?>">

                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button type="button" onclick="location.href = '?module=rekap';"  class="btn btn-dark">Cancel</button>
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
