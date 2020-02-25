<?php
$aksi = "modules/pengguna/aksi_pengguna.php";
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
                    <h4 class="text-themecolor">Pengguna</h4>
                </div>
                <div class="col-md-7 align-self-center text-right">
                    <div class="d-flex justify-content-end align-items-center">

                        <button onclick="location.href = '?module=pengguna&act=add';" type="button" class="btn btn-info d-none d-lg-block m-l-15">
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
                            <h4 class="card-title">Data Pengguna</h4>
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
                                                Username
                                            </th>
                                            <th>
                                                Level
                                            </th>
                                            <th style="width: 100px">
                                                Aksi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $tampil = mysqli_query($koneksi, "SELECT * FROM pengguna  ORDER BY nama ASC");
                                        $no = 1;
                                        while ($r = mysqli_fetch_array($tampil)) {
                                            ?>
                                            <tr>
                                                <td >
                                                    <?php echo $no++; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['nama']; ?>
                                                </td>

                                                <td>
                                                    <?php echo $r['username']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $r['level']; ?>
                                                </td>
                                                <td>
                                                    <a href="?module=pengguna&act=edit&id=<?php echo $r[id_pengguna]; ?>" class="btn btn-sm btn-warning"><i class="ti-pencil-alt"></i></a>
                                                    <!--<a href="<? $aksi ?>?module=pengguna&act=delete&id=<?php // echo $r[id_pengguna]; ?>" class="btn btn-sm btn-danger"><i class="ti-trash"></i></a>-->
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
                    <h4 class="text-themecolor">Pengguna</h4>
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
                        <h4 class="card-title">Form Tambah Pengguna</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?= $aksi ?>?module=pengguna&act=input" method="POST">

                                    <div class="form-group">
                                        <label for="exampleInputEmail12">Nama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail12" name="nama" placeholder="Enter Nama">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">User Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" name="username" placeholder="Enter Username">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword11">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword11" name="password" placeholder="Password">
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Level</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio11" name="customRadio" class="custom-control-input" name="level" value="admin" >
                                            <label class="custom-control-label" for="customRadio11">Admin</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio22" name="customRadio" class="custom-control-input" name="level" value="owner" >
                                            <label class="custom-control-label" for="customRadio22">Owner</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button type="button" onclick="location.href = '?module=pengguna';"  class="btn btn-dark">Cancel</button>
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
        $edit = mysqli_query($koneksi, "SELECT * FROM pengguna WHERE id_pengguna='$_GET[id]'");
        $r = mysqli_fetch_array($edit);
        ?>
        <div class="container-fluid">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">Pengguna</h4>
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
                        <h4 class="card-title">Form Ubah Pengguna</h4>
                        <div class="row">
                            <div class="col-sm-12 col-xs-12">
                                <form action="<?= $aksi ?>?module=pengguna&act=update" method="POST">

                                    <div class="form-group">
                                        <label for="exampleInputEmail12">Nama</label>
                                        <input type="text" class="form-control" id="exampleInputEmail12" name="nama" placeholder="Enter Nama" value="<?= $r[nama] ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail111">User Name</label>
                                        <input type="text" class="form-control" id="exampleInputEmail111" name="username" placeholder="Enter Username" value="<?= $r[username] ?>">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputPassword11">Password</label>
                                        <input type="password" class="form-control" id="exampleInputPassword11" name="password" placeholder="Password">
                                    </div>


                                    <div class="form-group">
                                        <label class="control-label">Level</label>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio11"  class="custom-control-input" name="level" value="admin" <?= $r[level] == 'admin' ? 'checked' : NULL ?> >
                                            <label class="custom-control-label" for="customRadio11">Admin</label>
                                        </div>
                                        <div class="custom-control custom-radio">
                                            <input type="radio" id="customRadio22"  class="custom-control-input" name="level" value="owner" <?= $r[level] == 'owner' ? 'checked' : NULL ?>>
                                            <label class="custom-control-label" for="customRadio22">Owner</label>
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="id_pengguna" name="id_pengguna" value="<?= $r[id_pengguna] ?>">

                                    <button type="submit" class="btn btn-success mr-2">Submit</button>
                                    <button type="button" onclick="location.href = '?module=pengguna';"  class="btn btn-dark">Cancel</button>
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
