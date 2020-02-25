<?php

function tgl_indo($tgl) {
    $tanggal = substr($tgl, 8, 2);
    $bulan = getBulan(substr($tgl, 5, 2));
    $tahun = substr($tgl, 0, 4);
    return $tanggal . ' ' . $bulan . ' ' . $tahun;
}

function getBulan($bln) {
    switch ($bln) {
        case 1:
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

function dateToSql($date) {
    $date = str_replace('/', '-', $date);
    return date('Y-m-d', strtotime($date));
}

function dateRangeToSql($daterange) {
        $daterange = explode(' - ', $daterange);

        $datestart = explode('/', $daterange[0]);
        $dateend = explode('/', $daterange[1]);

        $finalDate['start'] = $datestart[2] . '-' . $datestart[0] . '-' . $datestart[1];
        $finalDate['end'] = $dateend[2] . '-' . $dateend[0] . '-' . $dateend[1];


        return $finalDate;
    }

?>
