<?php
include "../config/fungsi_rupiah.php";
include "../config/fungsi_indotgl.php";

$aksi = "modules/rekap/aksi_rekap.php";
switch ($_GET[act]) {
// Tampil kriteria
    default:

        $id_barang = isset($_GET[id_barang]) ? $_GET[id_barang] : 0;
        ?>

        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Peramalan Rental</h4>
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
                        <h4 class="card-title">Form Peramalan Rental</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form>

                                    <div class="form-group">
                                        <label>Barang</label>
                                        <select class="form-control custom-select" name="id_barang" required>
                                            <option value="">--Pilih Barang--</option>
                                            <?php
                                            $tampil = mysqli_query($koneksi, "SELECT * FROM barang  ORDER BY nama_barang ASC");
                                            while ($rb = mysqli_fetch_array($tampil)) {
                                                ?>
                                                <option <?= $id_barang == $rb[id_barang] ? 'selected' : NULL ?> value="<?= $rb[id_barang] ?>" > <?= $rb[nama_barang] ?></option>

                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <input type="hidden" name="module" value="peramalan">
                                    <button type="submit" class="btn btn-success mr-2">Proses</button>
                                    <button type="button" onclick="location.href = '?module=peramalan';"  class="btn btn-dark">Reset</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($id_barang != 0) {

            $tampil = mysqli_query($koneksi, "SELECT * FROM rekap JOIN barang ON rekap.id_barang=barang.id_barang WHERE barang.id_barang = $id_barang  ORDER BY rekap.tanggal ASC");
            $no = 1;
            while ($r = mysqli_fetch_array($tampil)) {

                $x[$no][keluar] = $r[keluar];
                $x[$no][masuk] = $r[masuk];
                $x[$no][stok] = $r[stok];

                $no++;
            }

            $n = count($x);
            $alpha = 2 / ($n + 1);

            foreach ($x as $t => $value) {
                if ($t == 1) {
                    $sa[$t][keluar] = $x[$t][keluar];
                    $saa[$t][keluar] = $x[$t][keluar];
                    $a[$t][keluar] = 0;
                    $b[$t][keluar] = 0;
                    $f[$t][keluar] = 0;

                    $sa[$t][masuk] = $x[$t][masuk];
                    $saa[$t][masuk] = $x[$t][masuk];
                    $a[$t][masuk] = 0;
                    $b[$t][masuk] = 0;
                    $f[$t][masuk] = 0;
                } else if ($t == 2) {
                    $sa[$t][keluar] = ($alpha * $x[$t][keluar]) + ((1 - $alpha) * $sa[($t - 1)][keluar]);
                    $saa[$t][keluar] = ($alpha * $sa[$t][keluar]) + ((1 - $alpha) * $saa[($t - 1)][keluar]);
                    $a[$t][keluar] = (2 * $sa[$t][keluar]) - $saa[$t][keluar];
                    $b[$t][keluar] = (($alpha) / (1 - $alpha)) * ($sa[$t][keluar] - $saa[$t][keluar]);
                    $f[$t][keluar] = 0;

                    $sa[$t][masuk] = ($alpha * $x[$t][masuk]) + ((1 - $alpha) * $sa[($t - 1)][masuk]);
                    $saa[$t][masuk] = ($alpha * $sa[$t][masuk]) + ((1 - $alpha) * $saa[($t - 1)][masuk]);
                    $a[$t][masuk] = (2 * $sa[$t][masuk]) - $saa[$t][masuk];
                    $b[$t][masuk] = (($alpha) / (1 - $alpha)) * ($sa[$t][masuk] - $saa[$t][masuk]);
                    $f[$t][masuk] = 0;
                } else {
                    $sa[$t][keluar] = ($alpha * $x[$t][keluar]) + ((1 - $alpha) * $sa[($t - 1)][keluar]);
                    $saa[$t][keluar] = ($alpha * $sa[$t][keluar]) + ((1 - $alpha) * $saa[($t - 1)][keluar]);
                    $a[$t][keluar] = (2 * $sa[$t][keluar]) - $saa[$t][keluar];
                    $b[$t][keluar] = (($alpha) / (1 - $alpha)) * ($sa[$t][keluar] - $saa[$t][keluar]);
                    $f[$t][keluar] = $a[$t][keluar] + $b[$t][keluar];

                    $sa[$t][masuk] = ($alpha * $x[$t][masuk]) + ((1 - $alpha) * $sa[($t - 1)][masuk]);
                    $saa[$t][masuk] = ($alpha * $sa[$t][masuk]) + ((1 - $alpha) * $saa[($t - 1)][masuk]);
                    $a[$t][masuk] = (2 * $sa[$t][masuk]) - $saa[$t][masuk];
                    $b[$t][masuk] = (($alpha) / (1 - $alpha)) * ($sa[$t][masuk] - $saa[$t][masuk]);
                    $f[$t][masuk] = $a[$t][masuk] + $b[$t][masuk];
                }
            }

            $f[$n + 1][keluar] = $a[$t][keluar] + ($b[$t][keluar] * 1);
            $f[$n + 1][masuk] = $a[$t][masuk] + ($b[$t][masuk] * 1);



//        echo '<pre>';
//
//        echo 'n';
//        echo '<br>';
//
//        print_r($n);
//
//
//        echo 'a';
//        echo '<br>';
//
//        print_r($alpha);
//
//        echo '<br>';
//
//        echo 'X';
//        echo '<br>';
//
//        print_r($x);
//
//        echo '<br>';
//        echo 'sa';
//        echo '<br>';
//
//        print_r($sa);
//
//        echo '<br>';
//        echo 'saa';
//
//        echo '<br>';
//        print_r($saa);
//
//        echo '<br>';
//        echo 'a';
//        echo '<br>';
//
//        print_r($a);
//
//
//        echo '<br>';
//
//        echo 'b';
//        echo '<br>';
//
//        print_r($b);
//
//
//        echo '<br>';
//        echo 'f';
//        echo '<br>';
//        print_r($f);
//            echo '</pre>';
            ?>
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Prediksi Rental</h4>
                                <div class="table-responsive m-t-40">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>

                                                <th>
                                                    Bulan
                                                </th>

                                                <th>
                                                    Keluar (Buah)
                                                </th>
                                                <th>
                                                    Masuk (Buah)
                                                </th>
                                                <th>
                                                    Stok Bulan lalu(Buah)
                                                </th>
                                                <th>
                                                    Stok Peramalan  (Buah)<br>(Masuk + Stok) - Keluar
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>

                                                <td>
                                                    <?php echo date('M Y'); ?>
                                                </td>

                                                <td>
                                                    <?php echo format_rupiah($f[$n + 1][keluar]); ?>   </td>
                                                <td>
                                                    <?php echo format_rupiah($f[$n + 1][masuk]); ?>
                                                </td>
                                                <td>
                                                    <?php echo format_rupiah($x[$n][stok]); ?>
                                                </td>

                                                <?php
                                                $kebutuhan = ($f[$n + 1][masuk] + $x[$n][stok]) - $f[$n + 1][keluar];
                                                ?>
                                                <td>
                                                    <?php echo format_rupiah($kebutuhan); ?>
                                                </td>
                                            <tr>
                                            <tr>

                                                <td>
                                                    Detail Perhitungan
                                                </td>

                                                <td>
                                                    <a href="?module=peramalan&act=detail_keluar&id_barang=<?php echo $id_barang; ?>" class="btn btn-sm btn-info"><i class="ti-list"></i></a>

                                                </td>
                                                <td>
                                                    <a href="?module=peramalan&act=detail_masuk&id_barang=<?php echo $id_barang; ?>" class="btn btn-sm btn-info"><i class="ti-list"></i></a>
                                                </td>
                                                <td>
                                                </td>
                                                <td>
                                                </td>
                                            <tr>
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

            <?php
            if ($kebutuhan < 0) {
                $alert = 'danger';
                $text = 'Stok Tidak Aman';
            } else {
                $alert = 'success';
                $text = 'Stok Aman';
            }
            ?>
            <div class="alert alert-<?= $alert ?>">
                <h3 class="text-<?= $alert ?>"><i class="fa fa-check-circle"></i> <?=$text?></h3> Jumlah Stok yang ada di gudang berdasarkan peramalan sebanyak <strong>"<?= format_rupiah($kebutuhan) ?>"</strong>
            </div>
        </div>
        <?php
        break;
    case 'detail_keluar':
        $id_barang = isset($_GET[id_barang]) ? $_GET[id_barang] : 0;

        $tampil = mysqli_query($koneksi, "SELECT * FROM rekap JOIN barang ON rekap.id_barang=barang.id_barang WHERE barang.id_barang = $id_barang  ORDER BY rekap.tanggal ASC");
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {

            $x[$no] = $r[keluar];

            $no++;
        }

        $n = count($x);
        $alpha = 2 / ($n + 1);

        foreach ($x as $t => $value) {
            if ($t == 1) {
                $sa[$t] = $x[$t];
                $saa[$t] = $x[$t];
                $a[$t] = 0;
                $b[$t] = 0;
                $f[$t] = 0;
            } else if ($t == 2) {
                $sa[$t] = ($alpha * $x[$t]) + ((1 - $alpha) * $sa[($t - 1)]);
                $saa[$t] = ($alpha * $sa[$t]) + ((1 - $alpha) * $saa[($t - 1)]);
                $a[$t] = (2 * $sa[$t]) - $saa[$t];
                $b[$t] = (($alpha) / (1 - $alpha)) * ($sa[$t] - $saa[$t]);
                $f[$t] = 0;
            } else {
                $sa[$t] = ($alpha * $x[$t]) + ((1 - $alpha) * $sa[($t - 1)]);
                $saa[$t] = ($alpha * $sa[$t]) + ((1 - $alpha) * $saa[($t - 1)]);
                $a[$t] = (2 * $sa[$t]) - $saa[$t];
                $b[$t] = (($alpha) / (1 - $alpha)) * ($sa[$t] - $saa[$t]);
                $f[$t] = $a[$t] + $b[$t];
            }
        }

        $f[$n + 1] = $a[$t] + ($b[$t] * 1);
//        $f[$n+2] = $a[$t] + ($b[$t] * 2);

        $smse = 0;
        $pangkat = 2;
        foreach ($x as $t => $value) {
            if ($t <= 2) {
                $mad[$t] = 0;
                $mse[$t] = 0;
            } else {
                $mad[$t] = abs($value - $f[$t]);
                $mse[$t] = pow(($value - $f[$t]), $pangkat);
            }

            $mape[$t] = ($mad[$t] / $value) * 100;
        }
//
//        echo '<pre>';
//
//        echo 'n';
//        echo '<br>';
//
//        print_r($n);
//
//
//        echo 'a';
//        echo '<br>';
//
//        print_r($alpha);
//
//        echo '<br>';
//
//        echo 'X';
//        echo '<br>';
//
//        print_r($x);
//
//        echo '<br>';
//        echo 'sa';
//        echo '<br>';
//
//        print_r($sa);
//
//        echo '<br>';
//        echo 'saa';
//
//        echo '<br>';
//        print_r($saa);
//
//        echo '<br>';
//        echo 'a';
//        echo '<br>';
//
//        print_r($a);
//
//
//        echo '<br>';
//
//        echo 'b';
//        echo '<br>';
//
//        print_r($b);
//
//
//        echo '<br>';
//        echo 'f';
//        echo '<br>';
//        print_r($f);
//
//
//        echo '</pre>';
        ?>
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Detail Peramalan Barang Keluar (Sewa)</h4>
                            <div class="table-responsive m-t-40">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">t.</th>
                                            <th>X</th>
                                            <th>S'</th>
                                            <th>S"</th>
                                            <th>a</th>
                                            <th>b</th>
                                            <th>f</th>
                                            <th>MAD</th>
                                            <th>MSE</th>
                                            <th>MAPE</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($x as $t => $value) {
                                            ?>
                                            <tr>
                                                <td><?= $t ?></td>
                                                <td><?= $value ?></td>
                                                <td><?= $sa[$t] ?></td>
                                                <td><?= $saa[$t] ?></td>
                                                <td><?= $a[$t] ?></td>
                                                <td><?= $b[$t] ?></td>
                                                <td><?= $f[$t] ?></td>
                                                <td><?= $mad[$t] ?></td>
                                                <td><?= $mse[$t] ?></td>
                                                <td><?= $mape[$t] ?></td>

                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 20px">
                                                Peramalan
                                            </th>
                                            <th>

                                            </th>

                                            <th>

                                            </th>
                                            <th>

                                            </th>
                                            <th>

                                            </th>

                                            <th>

                                            </th>
                                            <th>
                                                <?= $f[($t + 1)] ?>
                                            </th>
                                            <th>

                                            </th>
                                            <th>

                                            </th>

                                            <th>

                                            </th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 'detail_masuk':
        $id_barang = isset($_GET[id_barang]) ? $_GET[id_barang] : 0;

        $tampil = mysqli_query($koneksi, "SELECT * FROM rekap JOIN barang ON rekap.id_barang=barang.id_barang WHERE barang.id_barang = $id_barang  ORDER BY rekap.tanggal ASC");
        $no = 1;
        while ($r = mysqli_fetch_array($tampil)) {

            $x[$no] = $r[masuk];

            $no++;
        }

        $n = count($x);
        $alpha = 2 / ($n + 1);

        foreach ($x as $t => $value) {
            if ($t == 1) {
                $sa[$t] = $x[$t];
                $saa[$t] = $x[$t];
                $a[$t] = 0;
                $b[$t] = 0;
                $f[$t] = 0;
            } else if ($t == 2) {
                $sa[$t] = ($alpha * $x[$t]) + ((1 - $alpha) * $sa[($t - 1)]);
                $saa[$t] = ($alpha * $sa[$t]) + ((1 - $alpha) * $saa[($t - 1)]);
                $a[$t] = (2 * $sa[$t]) - $saa[$t];
                $b[$t] = (($alpha) / (1 - $alpha)) * ($sa[$t] - $saa[$t]);
                $f[$t] = 0;
            } else {
                $sa[$t] = ($alpha * $x[$t]) + ((1 - $alpha) * $sa[($t - 1)]);
                $saa[$t] = ($alpha * $sa[$t]) + ((1 - $alpha) * $saa[($t - 1)]);
                $a[$t] = (2 * $sa[$t]) - $saa[$t];
                $b[$t] = (($alpha) / (1 - $alpha)) * ($sa[$t] - $saa[$t]);
                $f[$t] = $a[$t] + $b[$t];
            }
        }

        $f[$n + 1] = $a[$t] + ($b[$t] * 1);
//        $f[$n+2] = $a[$t] + ($b[$t] * 2);

        $smse = 0;
        $pangkat = 2;
        foreach ($x as $t => $value) {
            if ($t <= 2) {
                $mad[$t] = 0;
                $mse[$t] = 0;
            } else {
                $mad[$t] = abs($value - $f[$t]);
                $mse[$t] = pow(($value - $f[$t]), $pangkat);
            }

            $mape[$t] = ($mad[$t] / $value) * 100;
        }
//
//        echo '<pre>';
//
//        echo 'n';
//        echo '<br>';
//
//        print_r($n);
//
//
//        echo 'a';
//        echo '<br>';
//
//        print_r($alpha);
//
//        echo '<br>';
//
//        echo 'X';
//        echo '<br>';
//
//        print_r($x);
//
//        echo '<br>';
//        echo 'sa';
//        echo '<br>';
//
//        print_r($sa);
//
//        echo '<br>';
//        echo 'saa';
//
//        echo '<br>';
//        print_r($saa);
//
//        echo '<br>';
//        echo 'a';
//        echo '<br>';
//
//        print_r($a);
//
//
//        echo '<br>';
//
//        echo 'b';
//        echo '<br>';
//
//        print_r($b);
//
//
//        echo '<br>';
//        echo 'f';
//        echo '<br>';
//        print_r($f);
//
//
//        echo '</pre>';
        ?>
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Data Detail Peramalan Barang Kembali (Masuk)</h4>
                            <div class="table-responsive m-t-40">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px">t.</th>
                                            <th>X</th>
                                            <th>S'</th>
                                            <th>S"</th>
                                            <th>a</th>
                                            <th>b</th>
                                            <th>f</th>
                                            <th>MAD</th>
                                            <th>MSE</th>
                                            <th>MAPE</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($x as $t => $value) {
                                            ?>
                                            <tr>
                                                <td><?= $t ?></td>
                                                <td><?= $value ?></td>
                                                <td><?= $sa[$t] ?></td>
                                                <td><?= $saa[$t] ?></td>
                                                <td><?= $a[$t] ?></td>
                                                <td><?= $b[$t] ?></td>
                                                <td><?= $f[$t] ?></td>
                                                <td><?= $mad[$t] ?></td>
                                                <td><?= $mse[$t] ?></td>
                                                <td><?= $mape[$t] ?></td>

                                            </tr>
                                            <?php
                                        }
                                        ?>

                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th style="width: 20px">
                                                Peramalan
                                            </th>
                                            <th>

                                            </th>

                                            <th>

                                            </th>
                                            <th>

                                            </th>
                                            <th>

                                            </th>

                                            <th>

                                            </th>
                                            <th>
                                                <?= $f[($t + 1)] ?>
                                            </th>
                                            <th>

                                            </th>
                                            <th>

                                            </th>

                                            <th>

                                            </th>

                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 'sample':
        echo '<pre>';

        $x[1] = 26;
        $x[2] = 10;
        $x[3] = 89;
        $x[4] = 1;
        $x[5] = 75;
        $x[6] = 124;
        $x[7] = 92;
        $x[8] = 46;
        $x[9] = 6;
        $x[10] = 30;
        $x[11] = 162;
        $x[12] = 52;


        $n = 12;
        $alpha = 2 / ($n + 1);
//        $alpha = 0.1;
//t=1
        $sa[1] = $x[1];
        $saa[1] = $x[1];
        $a[1] = 0;
        $b[1] = 0;
        $f[1] = 0;
//t=2
        $sa[2] = ($alpha * $x[2]) + ((1 - $alpha) * $sa[1]);
        $saa[2] = ($alpha * $sa[2]) + ((1 - $alpha) * $saa[1]);
        $a[2] = (2 * $sa[2]) - $saa[2];
        $b[2] = (($alpha) / (1 - $alpha)) * ($sa[2] - $saa[2]);
        $f[2] = 0;
//t=3
        $sa[3] = ($alpha * $x[3]) + ((1 - $alpha) * $sa[2]);
        $saa[3] = ($alpha * $sa[3]) + ((1 - $alpha) * $saa[2]);
        $a[3] = (2 * $sa[3]) - $saa[3];
        $b[3] = (($alpha) / (1 - $alpha)) * ($sa[3] - $saa[3]);
        $f[3] = $a[3] + $b[3];


//t=4
        $sa[4] = ($alpha * $x[4]) + ((1 - $alpha) * $sa[3]);
        $saa[4] = ($alpha * $sa[4]) + ((1 - $alpha) * $saa[3]);
        $a[4] = (2 * $sa[4]) - $saa[4];
        $b[4] = (($alpha) / (1 - $alpha)) * ($sa[4] - $saa[4]);
        $f[4] = $a[4] + $b[4];
        //t=5
        $sa[5] = ($alpha * $x[5]) + ((1 - $alpha) * $sa[4]);
        $saa[5] = ($alpha * $sa[5]) + ((1 - $alpha) * $saa[4]);
        $a[5] = (2 * $sa[5]) - $saa[5];
        $b[5] = (($alpha) / (1 - $alpha)) * ($sa[5] - $saa[5]);
        $f[5] = $a[5] + $b[5];
        //t=6
        $sa[6] = ($alpha * $x[6]) + ((1 - $alpha) * $sa[5]);
        $saa[6] = ($alpha * $sa[6]) + ((1 - $alpha) * $saa[5]);
        $a[6] = (2 * $sa[6]) - $saa[6];
        $b[6] = (($alpha) / (1 - $alpha)) * ($sa[6] - $saa[6]);
        $f[6] = $a[6] + $b[6];
        //t=7
        $sa[7] = ($alpha * $x[7]) + ((1 - $alpha) * $sa[6]);
        $saa[7] = ($alpha * $sa[7]) + ((1 - $alpha) * $saa[6]);
        $a[7] = (2 * $sa[7]) - $saa[6];
        $b[7] = (($alpha) / (1 - $alpha)) * ($sa[7] - $saa[7]);
        $f[7] = $a[7] + $b[7];
        //t=8
        $sa[8] = ($alpha * $x[8]) + ((1 - $alpha) * $sa[7]);
        $saa[8] = ($alpha * $sa[8]) + ((1 - $alpha) * $saa[7]);
        $a[8] = (2 * $sa[8]) - $saa[8];
        $b[8] = (($alpha) / (1 - $alpha)) * ($sa[8] - $saa[8]);
        $f[8] = $a[8] + $b[8];
        //t=9
        $sa[9] = ($alpha * $x[9]) + ((1 - $alpha) * $sa[8]);
        $saa[9] = ($alpha * $sa[9]) + ((1 - $alpha) * $saa[8]);
        $a[9] = (2 * $sa[9]) - $saa[9];
        $b[9] = (($alpha) / (1 - $alpha)) * ($sa[9] - $saa[9]);
        $f[9] = $a[9] + $b[9];
        //t=10
        $sa[10] = ($alpha * $x[10]) + ((1 - $alpha) * $sa[9]);
        $saa[10] = ($alpha * $sa[10]) + ((1 - $alpha) * $saa[9]);
        $a[10] = (2 * $sa[10]) - $saa[10];
        $b[10] = (($alpha) / (1 - $alpha)) * ($sa[10] - $saa[10]);
        $f[10] = $a[10] + $b[10];
        //t=11
        $sa[11] = ($alpha * $x[11]) + ((1 - $alpha) * $sa[10]);
        $saa[11] = ($alpha * $sa[11]) + ((1 - $alpha) * $saa[10]);
        $a[11] = (2 * $sa[11]) - $saa[11];
        $b[11] = (($alpha) / (1 - $alpha)) * ($sa[11] - $saa[11]);
        $f[11] = $a[11] + $b[11];
        //t=12
        $sa[12] = ($alpha * $x[12]) + ((1 - $alpha) * $sa[11]);
        $saa[12] = ($alpha * $sa[12]) + ((1 - $alpha) * $saa[11]);
        $a[12] = (2 * $sa[12]) - $saa[12];
        $b[12] = (($alpha) / (1 - $alpha)) * ($sa[12] - $saa[12]);
        $f[12] = $a[12] + $b[12];


        echo 'a';
        echo '<br>';

        print_r($alpha);

        echo '<br>';

        echo 'X';
        echo '<br>';

        print_r($x);

        echo '<br>';
        echo 'sa';
        echo '<br>';

        print_r($sa);

        echo '<br>';
        echo 'saa';

        echo '<br>';
        print_r($saa);

        echo '<br>';
        echo 'a';
        echo '<br>';

        print_r($a);


        echo '<br>';

        echo 'b';
        echo '<br>';

        print_r($b);


        echo '<br>';
        echo 'f';
        echo '<br>';
        print_r($f);


        echo '</pre>';
        ?>



        <?php
        break;
}
?>