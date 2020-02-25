<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h4 class="text-themecolor">Grafik </h4>
        </div>

    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">
        <!-- column -->
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Grafik Riwayat Rekap Stokan</h4>
                    <ul class="list-inline text-right">
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-inverse"></i>Stok</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-info"></i>Masuk</h5>
                        </li>
                        <li>
                            <h5><i class="fa fa-circle m-r-5 text-success"></i>Keluar</h5>
                        </li>
                    </ul>
                    <div id="morris-area-chart"></div>
                </div>
            </div>
        </div>
        <!-- column -->


        <!-- column -->
    </div>
    <!-- ============================================================== -->
    <!-- End PAge Content -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Right sidebar -->
    <!-- ============================================================== -->
    <!-- .right-sidebar -->

    <!-- ============================================================== -->
    <!-- End Right sidebar -->
    <!-- ============================================================== -->
</div>

<script src="assets/node_modules/jquery/jquery-3.2.1.min.js"></script>

<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->
<!--Morris JavaScript -->
<script src="assets/node_modules/raphael/raphael-min.js"></script>
<script src="assets/node_modules/morrisjs/morris.js"></script>
<!--<script src="dist/js/pages/morris-data.js"></script>-->

<?php
$tampil = mysqli_query($koneksi, "SELECT * FROM rekap JOIN barang ON rekap.id_barang=barang.id_barang ORDER BY tanggal DESC");
$no = 1;
$array_object = array();

//echo '<pre>';
while ($r = mysqli_fetch_object($tampil)) {
    $obj = new stdClass();
    $obj->keluar = $r->keluar;
    $obj->masuk = $r->masuk;
    $obj->stok = $r->stok;
    $obj->period = $r->tanggal;
    
    array_push($array_object, $obj);
}

//print_r(json_encode($array_object));

//echo '</pre>';
?>


<script>
    // Dashboard 1 Morris-chart
    $(function () {
        "use strict";
        Morris.Area({
            element: 'morris-area-chart',
            data: <?=json_encode($array_object)?>,
            xkey: 'period',
            ykeys: ['keluar', 'masuk', 'stok'],
            labels: ['Keluar', 'Masuk', 'Stok Gudang'],
            pointSize: 3,
            fillOpacity: 0,
            pointStrokeColors: ['#55ce63', '#40c4ff', '#414755'],
            behaveLikeLine: true,
            gridLineColor: '#e0e0e0',
            lineWidth: 3,
            hideHover: 'auto',
            lineColors: ['#55ce63', '#40c4ff', '#414755'],
            resize: true

        });


    });
</script>