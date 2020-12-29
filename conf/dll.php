<?php

include 'conf/conn.php';
$revenue_mtd = '';
// loop tanggal
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    // revenue mtd
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");

    // last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");







    $data = mysqli_fetch_array($sql);
    $data['revenue_mtd'];

    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    echo round($hasil_rupiah, 1);

    $queryMoM = (($hasil_rupiah / $hasil_rupiahlastmonth - 1) * 100);
    echo round($queryMoM, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");
    $data = mysqli_fetch_array($sql);
    $data['revenue_mtd'];
    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $hasil_rupiah;

    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $datalm = mysqli_fetch_array($sqllastmonth);
    $datalm['revenue_lm'];
    $hasil_rupiahlastmonth = " " . number_format($datalm['revenue_lm'], 2, ',', '.');
    $hasil_rupiahlastmonth;
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");
    $data = mysqli_fetch_array($sql);
    $data['revenue_mtd'];
    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $hasil_rupiah;

    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $dataly = mysqli_fetch_array($sqllastyear);
    $dataly['revenue_ly'];
    $hasil_rupiahlastyear = " " . number_format($dataly['revenue_ly'], 2, ',', '.');
    $hasil_rupiahlastyear;

    $queryYoY = (($hasil_rupiah / $hasil_rupiahlastyear - 1) * 100);
    echo round($queryYoY, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}


if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $sqllastyear19 = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lytd from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $dataly19 = mysqli_fetch_array($sqllastyear19);
    $dataly19['revenue_lytd'];
    $hasil_rupiahlastyear19 = " " . number_format($dataly19['revenue_lytd'], 2, ',', '.');
    $hasil_rupiahlastyear19;

    $sqlytd20 = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lytdd from excel where excel.date between '$tgl' and '$tgl2'");
    $dataytd20 = mysqli_fetch_array($sqlytd20);
    $dataytd20['revenue_lytdd'];
    $hasil_rupiahytd20 = " " . number_format($dataytd20['revenue_lytdd'], 2, ',', '.');
    $hasil_rupiahytd20;


    $queryYtd = ($hasil_rupiahytd20 / $hasil_rupiahlastyear19 - 1) * 100;
    echo round($queryYtd, 2);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}



if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");
    $data = mysqli_fetch_array($sql);
    $data['revenue_mtd'];
    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $hasildu = round($hasil_rupiah, 1);

    // $sql_diff = mysqli_query($koneksi,"SELECT * from excel where excel.date between '$tgl' and '$tgl2' ");
    $tglawal = new DateTime("$tgl");
    $tglakhir = new DateTime("$tgl2");
    $d = $tglakhir->diff($tglawal)->days + 1;
    $d;

    $duMtd = $hasildu / $d;
    echo round($duMtd, 2);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}


if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $datalm = mysqli_fetch_array($sqllastmonth);
    $datalm['revenue_lm'];
    $hasil_rupiahlastmonth = " " . number_format($datalm['revenue_lm'], 2, ',', '.');
    echo round($hasil_rupiahlastmonth, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

// table l1
// revenue mtd
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(excel.revenue) as revenue_sms from excel WHERE excel.l1 = 'SMS P2P' AND excel.date BETWEEN '$tgl' and '$tgl2'");
    $datasms = mysqli_fetch_array($sqlsms);
    $datasms['revenue_sms'];
    $hasil_rupiahsms = " " . number_format($datasms['revenue_sms'], 2, ',', '.');
    echo round($hasil_rupiahsms, 2);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(excel.revenue) as revenue_voice from excel WHERE excel.l1 = 'Voice P2P' AND excel.date BETWEEN '$tgl' and '$tgl2'");
    $datavoice = mysqli_fetch_array($sqlvoice);
    $datavoice['revenue_voice'];
    $hasil_rupiahvoice = " " . number_format($datavoice['revenue_voice'], 2, ',', '.');
    echo round($hasil_rupiahvoice, 2);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

// mom
error_reporting(0);
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sqlsmsmtd = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smsmtd from excel WHERE excel.l1 = 'SMS P2P' AND excel.date between '$tgl' and '$tgl2'");
    $datasmsmtd = mysqli_fetch_array($sqlsmsmtd);
    $datasmsmtd['revenue_smsmtd'];
    $hasil_rupiahsmsmtd = " " . number_format($datasmsmtd['revenue_smsmtd'], 2, ',', '.');
    $hasil_rupiahsmsmtd;

    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from excel WHERE excel.l1 = 'SMS P2P' AND excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $datasmslm = mysqli_fetch_array($sqlsmslastmonth);
    $datasmslm['revenue_smslm'];
    $hasil_rupiahlastmonthsms = " " . number_format($datasmslm['revenue_smslm'], 2, ',', '.');
    $hasil_rupiahlastmonthsms;

    $queryMoMsms = (($hasil_rupiahsmsmtd / $hasil_rupiahlastmonthsms - 1) * 100);
    echo round($queryMoMsms, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

error_reporting(0);
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sqlvoicemtd = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicemtd from excel WHERE excel.l1 = 'Voice P2P' AND excel.date between '$tgl' and '$tgl2'");
    $datavoicemtd = mysqli_fetch_array($sqlvoicemtd);
    $datavoicemtd['revenue_voicemtd'];
    $hasil_rupiahvoicemtd = " " . number_format($datavoicemtd['revenue_voicemtd'], 2, ',', '.');
    $hasil_rupiahvoicemtd;

    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from excel WHERE excel.l1 = 'Voice P2P' AND excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $datavoicelm = mysqli_fetch_array($sqlvoicelastmonth);
    $datavoicelm['revenue_voicelm'];
    $hasil_rupiahlastmonthvoice = " " . number_format($datavoicelm['revenue_voicelm'], 2, ',', '.');
    $hasil_rupiahlastmonthvoice;

    $queryMoMvoice = (($hasil_rupiahvoicemtd / $hasil_rupiahlastmonthvoice - 1) * 100);
    echo round($queryMoMvoice, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

// yoy
error_reporting(0);
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sql_mtd_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtdsms from excel WHERE excel.l1 = 'SMS P2P' AND excel.date between '$tgl' and '$tgl2'");
    $data_mtd_sms = mysqli_fetch_array($sql_mtd_sms);
    $data_mtd_sms['revenue_mtdsms'];
    $hasil_rupiah_mtd_sms = " " . number_format($data_mtd_sms['revenue_mtdsms'], 2, ',', '.');
    $hasil_rupiah_mtd_sms;

    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from excel WHERE excel.l1 = 'SMS P2P' AND excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $dataly_sms = mysqli_fetch_array($sqllastyear_sms);
    $dataly_sms['revenue_lysms'];
    $hasil_rupiahlastyear_sms = " " . number_format($dataly_sms['revenue_lysms'], 2, ',', '.');
    $hasil_rupiahlastyear_sms;

    $queryYoYsms = (($hasil_rupiah_mtd_sms / $hasil_rupiahlastyear_sms - 1) * 100);
    echo round($queryYoYsms, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

error_reporting(0);
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    $sql_mtd_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mdvoice from excel WHERE excel.l1 = 'Voice P2P' AND excel.date between '$tgl' and '$tgl2'");
    $data_mtd_voice = mysqli_fetch_array($sql_mtd_voice);
    $data_mtd_voice['revenue_mdvoice'];
    $hasil_rupiah_mtd_voice = " " . number_format($data_mtd_voice['revenue_mdvoice'], 2, ',', '.');
    $hasil_rupiah_mtd_voice;

    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from excel WHERE excel.l1 = 'Voice P2P' AND excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $dataly_voice = mysqli_fetch_array($sqllastyear_voice);
    $dataly_voice['revenue_lyvoice'];
    $hasil_rupiahlastyear_voice = " " . number_format($dataly_voice['revenue_lyvoice'], 2, ',', '.');
    $hasil_rupiahlastyear_voice;

    $queryYoYvoice = (($hasil_rupiah_mtd_voice / $hasil_rupiahlastyear_voice - 1) * 100);
    echo round($queryYoYvoice, 1);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

// data set pie 
// sms
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(excel.revenue) as revenue_sms from excel WHERE excel.l1 = 'SMS P2P' AND excel.date BETWEEN '$tgl' and '$tgl2'");
    $datasms = mysqli_fetch_array($sqlsms);
    $datasms['revenue_sms'];
    $hasil_rupiahsms = " " . number_format($datasms['revenue_sms'], 2, ',', '.');
    $hasilround = round($hasil_rupiahsms, 2);
    echo $hasilround;
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}

// voice
if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(excel.revenue) as revenue_voice from excel WHERE excel.l1 = 'Voice P2P' AND excel.date BETWEEN '$tgl' and '$tgl2'");
    $datavoice = mysqli_fetch_array($sqlvoice);
    $datavoice['revenue_voice'];
    $hasil_rupiahvoice = " " . number_format($datavoice['revenue_voice'], 2, ',', '.');
    echo round($hasil_rupiahvoice, 2);
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}




if (isset($_GET['tanggal'], $_GET['region'], $_GET['l1'])){
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $region = $_GET['region'];
    $l1 = $_GET['l1'];
    
    // query
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as mtd from excel where excel.date between '$tgl' and '$tgl2' and excel.region '$region' and excel.l1 '$l1' ");

    // fetch
    $data = mysqli_fetch_array($sql);

    $data['mtd'];

    // revenue mtd, du mtd, ytd 2020
    $mtd_l1 = " " . number_format($data['mtd'], 2, ',', '.');
    $mtd_l1;


} else if (isset($_GET['tanggal'], $_GET['region'])){
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $selectRegion = $_GET['region'];

    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as mtd_region from excel where excel.date between '$tgl' and '$tgl2' and  excel.region = '$selectRegion'");
    // fetch
    $data = mysqli_fetch_array($sql);

    $data['mtd_region'];

    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['mtd_region'], 2, ',', '.');
    $revenue;

} else if (isset($_GET['tanggal'], $_GET['L1'])){
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $select_l1 = $_GET['L1'];

    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2' and where excel.l1 = '$select_l1' ");

    // fetch
    $data = mysqli_fetch_array($sql);

    $data['revenue_mtd'];


    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $revenue;
} else if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    // revenue mtd, du mtd,ytd 2020
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");

    // fetch
    $data = mysqli_fetch_array($sql);
    $datalastmonth = mysqli_fetch_array($sqllastmonth);
    $datalastyear = mysqli_fetch_array($sqllastyear);

    $data['revenue_mtd'];
    $datalastmonth['revenue_lm'];
    $datalastyear['revenue_ly'];

    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $revenue;

    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    round($hasil_rupiah, 1);
    $hasil_rupiah;

    // last month, du last month
    $hasil_rupiahlastmonth = " " . number_format($datalastmonth['revenue_lm'], 2, ',', '.');
    $hasil_rupiahlastmonth;

    // last year, ytd 2019
    $hasil_rupiahlastyear = " " . number_format($datalastyear['revenue_ly'], 2, ',', '.');
    $hasil_rupiahlastyear;

    // MoM
    $mom = (($hasil_rupiah / $hasil_rupiahlastmonth - 1) * 100);
    $mom;

    // yoy
    $yoy = (($hasil_rupiah / $hasil_rupiahlastyear - 1) * 100);
    $yoy;

    // ytd
    $ytd = (($hasil_rupiah / $hasil_rupiahlastyear - 1) * 100);
    $ytd;

    // du mtd
    $tglawal = new DateTime("$tgl");
    $tglakhir = new DateTime("$tgl2");
    $d = $tglakhir->diff($tglawal)->days + 1;
    $d;

    $duMtd = ($hasil_rupiah / $d);
    $duMtd;
} else {
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}