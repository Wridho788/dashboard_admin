<?php
include("conf/conn.php");

// revenue
$hasil_rupiah = '';
$hasil_rupiahsms = '';
$hasil_rupiahvoice = '';

// $revenue_ib = '';
// $revenue_others = '';
// $revenue_ds = '';

// selected region
// $selected_region = '';

// mom
$mom = '';
$mom_sms = '';
$mom_voice = '';
// $mom_ib = '';
// $mom_others = '';
// $mom_ds = '';

// yoy
$yoy = '';
$yoy_sms = '';
$yoy_voice = '';
// $yoy_ib = '';
// $yoy_others = '';
// $yoy_ds = '';

// ytd
$ytd = '';
$ytd_sms = '';
$ytd_voice = '';
// $ytd_ib = '';
// $ytd_others = '';
// $ytd_ds = '';

$duMtd = '';
$hasil_rupiahlastmonth = '';

error_reporting(0);

if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    // revenue mtd, du mtd,ytd 2020
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from sheet3 where sheet3.date between '$tgl' and '$tgl2'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.l1 = 'SMS P2P' ");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.l1 = 'Voice P2P' ");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.l1 = 'SMS P2P' ");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.l1 = 'Voice P2P' ");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.l1 = 'SMS P2P'");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.l1 = 'Voice P2P'");


    // fetch
    $data = mysqli_fetch_array($sql);
    $datasms = mysqli_fetch_array($sqlsms);
    $datavoice = mysqli_fetch_array($sqlvoice);

    $datalastmonth = mysqli_fetch_array($sqllastmonth);
    $datasmslm = mysqli_fetch_array($sqlsmslastmonth);
    $datavoicelm = mysqli_fetch_array($sqlvoicelastmonth);

    $datalastyear = mysqli_fetch_array($sqllastyear);
    $dataly_sms = mysqli_fetch_array($sqllastyear_sms);
    $dataly_voice = mysqli_fetch_array($sqllastyear_voice);


    $data['revenue_mtd'];
    $datasms['revenue_sms'];
    $datavoice['revenue_voice'];

    $datalastmonth['revenue_lm'];
    $datasmslm['revenue_smslm'];
    $datavoicelm['revenue_voicelm'];

    $datalastyear['revenue_ly'];
    $dataly_sms['revenue_lysms'];
    $dataly_voice['revenue_lyvoice'];


    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $revenue;

    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    round($hasil_rupiah, 1);
    $hasil_rupiah;

    $hasil_rupiahsms = " " . number_format($datasms['revenue_sms'], 2, ',', '.');
    $hasil_rupiahsms;

    $hasil_rupiahvoice = " " . number_format($datavoice['revenue_voice'], 2, ',', '.');
    $hasil_rupiahvoice;

    // last month, du last month
    $hasil_rupiahlastmonth = " " . number_format($datalastmonth['revenue_lm'], 2, ',', '.');
    $hasil_rupiahlastmonth;

    $hasil_rupiahlastmonthsms = " " . number_format($datasmslm['revenue_smslm'], 2, ',', '.');
    $hasil_rupiahlastmonthsms;

    $hasil_rupiahlastmonthvoice = " " . number_format($datavoicelm['revenue_voicelm'], 2, ',', '.');
    $hasil_rupiahlastmonthvoice;

    // last year, ytd 2019
    $hasil_rupiahlastyear = " " . number_format($datalastyear['revenue_ly'], 2, ',', '.');
    $hasil_rupiahlastyear;

    $hasil_rupiahlastyear_sms = " " . number_format($dataly_sms['revenue_lysms'], 2, ',', '.');
    $hasil_rupiahlastyear_sms;

    $hasil_rupiahlastyear_voice = " " . number_format($dataly_voice['revenue_lyvoice'], 2, ',', '.');
    $hasil_rupiahlastyear_voice;
    // MoM
    $mom = (($hasil_rupiah / $hasil_rupiahlastmonth - 2) * 100);
    $mom;

    $mom_sms = (($hasil_rupiahsms / $hasil_rupiahlastmonthsms - 2) * 100);
    $mom_sms;

    $mom_voice = (($hasil_rupiahvoice / $hasil_rupiahlastmonthvoice - 2) * 100);
    $mom_voice;

    // yoy
    $yoy = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $yoy;

    $yoy_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $yoy_sms;

    $yoy_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $yoy_voice;

    // ytd
    $ytd = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $ytd;

    $ytd_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $ytd_sms;

    $ytd_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $ytd_voice;


    // du mtd
    $tglawal = new DateTime("$tgl");
    $tglakhir = new DateTime("$tgl2");
    $d = $tglakhir->diff($tglawal)->days + 1;
    $d;

    $duMtd = ($hasil_rupiah / $d);
    $duMtd;
} else
 if (isset($_GET['tanggal'], $_GET['region'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $select_Region = $_GET['region'];

    // revenue mtd, du mtd,ytd 2020
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from sheet3 where sheet3.date between '$tgl' and '$tgl2' and sheet3.region = '$selectRegion'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.l1 = 'SMS P2P' and sheet3.region = '$selectRegion'");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.l1 = 'Voice P2P' and sheet3.region = '$selectRegion'");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)and sheet3.region = '$selectRegion'");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.l1 = 'SMS P2P' and sheet3.region = '$selectRegion'");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.l1 = 'Voice P2P' and sheet3.region = '$selectRegion'");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)and sheet3.region = '$selectRegion'");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.l1 = 'SMS P2P'and sheet3.region = '$selectRegion'");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.l1 = 'Voice P2P'and sheet3.region = '$selectRegion'");


    // fetch
    $data = mysqli_fetch_array($sql);
    $datasms = mysqli_fetch_array($sqlsms);
    $datavoice = mysqli_fetch_array($sqlvoice);

    $datalastmonth = mysqli_fetch_array($sqllastmonth);
    $datasmslm = mysqli_fetch_array($sqlsmslastmonth);
    $datavoicelm = mysqli_fetch_array($sqlvoicelastmonth);

    $datalastyear = mysqli_fetch_array($sqllastyear);
    $dataly_sms = mysqli_fetch_array($sqllastyear_sms);
    $dataly_voice = mysqli_fetch_array($sqllastyear_voice);


    $data['revenue_mtd'];
    $datasms['revenue_sms'];
    $datavoice['revenue_voice'];

    $datalastmonth['revenue_lm'];
    $datasmslm['revenue_smslm'];
    $datavoicelm['revenue_voicelm'];

    $datalastyear['revenue_ly'];
    $dataly_sms['revenue_lysms'];
    $dataly_voice['revenue_lyvoice'];


    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $revenue;

    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    round($hasil_rupiah, 1);
    $hasil_rupiah;

    $hasil_rupiahsms = " " . number_format($datasms['revenue_sms'], 2, ',', '.');
    $hasil_rupiahsms;

    $hasil_rupiahvoice = " " . number_format($datavoice['revenue_voice'], 2, ',', '.');
    $hasil_rupiahvoice;

    // last month, du last month
    $hasil_rupiahlastmonth = " " . number_format($datalastmonth['revenue_lm'], 2, ',', '.');
    $hasil_rupiahlastmonth;

    $hasil_rupiahlastmonthsms = " " . number_format($datasmslm['revenue_smslm'], 2, ',', '.');
    $hasil_rupiahlastmonthsms;

    $hasil_rupiahlastmonthvoice = " " . number_format($datavoicelm['revenue_voicelm'], 2, ',', '.');
    $hasil_rupiahlastmonthvoice;

    // last year, ytd 2019
    $hasil_rupiahlastyear = " " . number_format($datalastyear['revenue_ly'], 2, ',', '.');
    $hasil_rupiahlastyear;

    $hasil_rupiahlastyear_sms = " " . number_format($dataly_sms['revenue_lysms'], 2, ',', '.');
    $hasil_rupiahlastyear_sms;

    $hasil_rupiahlastyear_voice = " " . number_format($dataly_voice['revenue_lyvoice'], 2, ',', '.');
    $hasil_rupiahlastyear_voice;
    // MoM
    $mom = (($hasil_rupiah / $hasil_rupiahlastmonth - 2) * 100);
    $mom;

    $mom_sms = (($hasil_rupiahsms / $hasil_rupiahlastmonthsms - 2) * 100);
    $mom_sms;

    $mom_voice = (($hasil_rupiahvoice / $hasil_rupiahlastmonthvoice - 2) * 100);
    $mom_voice;

    // yoy
    $yoy = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $yoy;

    $yoy_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $yoy_sms;

    $yoy_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $yoy_voice;

    // ytd
    $ytd = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $ytd;

    $ytd_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $ytd_sms;

    $ytd_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $ytd_voice;


    // du mtd
    $tglawal = new DateTime("$tgl");
    $tglakhir = new DateTime("$tgl2");
    $d = $tglakhir->diff($tglawal)->days + 1;
    $d;

    $duMtd = ($hasil_rupiah / $d);
    $duMtd;
} else 
    if (isset($_GET['tanggal'], $_GET['L1'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $select_l1 = $_GET['L1'];

    // revenue mtd, du mtd,ytd 2020
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from sheet3 where sheet3.date between '$tgl' and '$tgl2'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.l1 '$l1' ");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.l1 '$l1' ");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.l1 '$l1' ");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.l1 '$l1' ");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.l1 '$l1' ");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.l1 '$l1' ");


    // fetch
    $data = mysqli_fetch_array($sql);
    $datasms = mysqli_fetch_array($sqlsms);
    $datavoice = mysqli_fetch_array($sqlvoice);

    $datalastmonth = mysqli_fetch_array($sqllastmonth);
    $datasmslm = mysqli_fetch_array($sqlsmslastmonth);
    $datavoicelm = mysqli_fetch_array($sqlvoicelastmonth);

    $datalastyear = mysqli_fetch_array($sqllastyear);
    $dataly_sms = mysqli_fetch_array($sqllastyear_sms);
    $dataly_voice = mysqli_fetch_array($sqllastyear_voice);


    $data['revenue_mtd'];
    $datasms['revenue_sms'];
    $datavoice['revenue_voice'];

    $datalastmonth['revenue_lm'];
    $datasmslm['revenue_smslm'];
    $datavoicelm['revenue_voicelm'];

    $datalastyear['revenue_ly'];
    $dataly_sms['revenue_lysms'];
    $dataly_voice['revenue_lyvoice'];


    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $revenue;

    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    round($hasil_rupiah, 1);
    $hasil_rupiah;

    $hasil_rupiahsms = " " . number_format($datasms['revenue_sms'], 2, ',', '.');
    $hasil_rupiahsms;

    $hasil_rupiahvoice = " " . number_format($datavoice['revenue_voice'], 2, ',', '.');
    $hasil_rupiahvoice;

    // last month, du last month
    $hasil_rupiahlastmonth = " " . number_format($datalastmonth['revenue_lm'], 2, ',', '.');
    $hasil_rupiahlastmonth;

    $hasil_rupiahlastmonthsms = " " . number_format($datasmslm['revenue_smslm'], 2, ',', '.');
    $hasil_rupiahlastmonthsms;

    $hasil_rupiahlastmonthvoice = " " . number_format($datavoicelm['revenue_voicelm'], 2, ',', '.');
    $hasil_rupiahlastmonthvoice;

    // last year, ytd 2019
    $hasil_rupiahlastyear = " " . number_format($datalastyear['revenue_ly'], 2, ',', '.');
    $hasil_rupiahlastyear;

    $hasil_rupiahlastyear_sms = " " . number_format($dataly_sms['revenue_lysms'], 2, ',', '.');
    $hasil_rupiahlastyear_sms;

    $hasil_rupiahlastyear_voice = " " . number_format($dataly_voice['revenue_lyvoice'], 2, ',', '.');
    $hasil_rupiahlastyear_voice;
    // MoM
    $mom = (($hasil_rupiah / $hasil_rupiahlastmonth - 2) * 100);
    $mom;

    $mom_sms = (($hasil_rupiahsms / $hasil_rupiahlastmonthsms - 2) * 100);
    $mom_sms;

    $mom_voice = (($hasil_rupiahvoice / $hasil_rupiahlastmonthvoice - 2) * 100);
    $mom_voice;

    // yoy
    $yoy = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $yoy;

    $yoy_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $yoy_sms;

    $yoy_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $yoy_voice;

    // ytd
    $ytd = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $ytd;

    $ytd_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $ytd_sms;

    $ytd_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $ytd_voice;


    // du mtd
    $tglawal = new DateTime("$tgl");
    $tglakhir = new DateTime("$tgl2");
    $d = $tglakhir->diff($tglawal)->days + 1;
    $d;

    $duMtd = ($hasil_rupiah / $d);
    $duMtd;
} else
    if (isset($_GET['tanggal'], $_GET['region'], $_GET['l1'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];
    $region = $_GET['region'];
    $l1 = $_GET['l1'];

    // revenue mtd, du mtd,ytd 2020
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from sheet3 where sheet3.date between '$tgl' and '$tgl2'and sheet3.region = '$selectRegion'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.region = '$selectRegion' and sheet3.l1 '$l1' ");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from sheet3 WHERE sheet3.date BETWEEN '$tgl' and '$tgl2' and sheet3.region = '$selectRegion' and sheet3.l1 '$l1' ");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)and sheet3.region = '$selectRegion'");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.region = '$selectRegion' and sheet3.l1 '$l1' ");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and sheet3.region = '$selectRegion'and sheet3.l1 '$l1' ");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from sheet3 where sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.region = '$selectRegion'and sheet3.l1 '$l1' ");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from sheet3 WHERE sheet3.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and sheet3.region = '$selectRegion'and sheet3.l1 '$l1' ");

    // fetch
    $data = mysqli_fetch_array($sql);
    $datasms = mysqli_fetch_array($sqlsms);
    $datavoice = mysqli_fetch_array($sqlvoice);

    $datalastmonth = mysqli_fetch_array($sqllastmonth);
    $datasmslm = mysqli_fetch_array($sqlsmslastmonth);
    $datavoicelm = mysqli_fetch_array($sqlvoicelastmonth);

    $datalastyear = mysqli_fetch_array($sqllastyear);
    $dataly_sms = mysqli_fetch_array($sqllastyear_sms);
    $dataly_voice = mysqli_fetch_array($sqllastyear_voice);


    $data['revenue_mtd'];
    $datasms['revenue_sms'];
    $datavoice['revenue_voice'];

    $datalastmonth['revenue_lm'];
    $datasmslm['revenue_smslm'];
    $datavoicelm['revenue_voicelm'];

    $datalastyear['revenue_ly'];
    $dataly_sms['revenue_lysms'];
    $dataly_voice['revenue_lyvoice'];


    // revenue mtd, du mtd, ytd 2020
    $revenue = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    $revenue;

    $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
    round($hasil_rupiah, 1);
    $hasil_rupiah;

    $hasil_rupiahsms = " " . number_format($datasms['revenue_sms'], 2, ',', '.');
    $hasil_rupiahsms;

    $hasil_rupiahvoice = " " . number_format($datavoice['revenue_voice'], 2, ',', '.');
    $hasil_rupiahvoice;

    // last month, du last month
    $hasil_rupiahlastmonth = " " . number_format($datalastmonth['revenue_lm'], 2, ',', '.');
    $hasil_rupiahlastmonth;

    $hasil_rupiahlastmonthsms = " " . number_format($datasmslm['revenue_smslm'], 2, ',', '.');
    $hasil_rupiahlastmonthsms;

    $hasil_rupiahlastmonthvoice = " " . number_format($datavoicelm['revenue_voicelm'], 2, ',', '.');
    $hasil_rupiahlastmonthvoice;

    // last year, ytd 2019
    $hasil_rupiahlastyear = " " . number_format($datalastyear['revenue_ly'], 2, ',', '.');
    $hasil_rupiahlastyear;

    $hasil_rupiahlastyear_sms = " " . number_format($dataly_sms['revenue_lysms'], 2, ',', '.');
    $hasil_rupiahlastyear_sms;

    $hasil_rupiahlastyear_voice = " " . number_format($dataly_voice['revenue_lyvoice'], 2, ',', '.');
    $hasil_rupiahlastyear_voice;
    // MoM
    $mom = (($hasil_rupiah / $hasil_rupiahlastmonth - 2) * 100);
    $mom;

    $mom_sms = (($hasil_rupiahsms / $hasil_rupiahlastmonthsms - 2) * 100);
    $mom_sms;

    $mom_voice = (($hasil_rupiahvoice / $hasil_rupiahlastmonthvoice - 2) * 100);
    $mom_voice;

    // yoy
    $yoy = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $yoy;

    $yoy_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $yoy_sms;

    $yoy_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $yoy_voice;

    // ytd
    $ytd = (($hasil_rupiah / $hasil_rupiahlastyear - 2) * 100);
    $ytd;

    $ytd_sms = (($hasil_rupiahsms / $hasil_rupiahlastyear_sms - 2) * 100);
    $ytd_sms;

    $ytd_voice = (($hasil_rupiahvoice / $hasil_rupiahlastyear_voice - 2) * 100);
    $ytd_voice;


    // du mtd
    $tglawal = new DateTime("$tgl");
    $tglakhir = new DateTime("$tgl2");
    $d = $tglakhir->diff($tglawal)->days + 1;
    $d;

    $duMtd = ($hasil_rupiah / $d);
    $duMtd;
} else {
    $sql = mysqli_query($koneksi, "SELECT * from sheet3");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        Dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <!-- Our Custom CSS -->
    <link rel="stylesheet" href="assets/css/style3.css">
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">

    <!-- CSS Files -->
    <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<style>
    .main-panel>.content {
        margin-top: 0px;
        padding: 15px 10px;
        min-height: calc(100vh - 120px)
    }
</style>

<body class="dark-edition">
    <div class="wrapper ">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>
            <div class="sidebar-header">
                <h3>Dashboard</h3>
            </div>

            <ul class="list-unstyled components">
                <li class="active">
                    <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                    <ul class="collapse list-unstyled" id="homeSubmenu">
                        <li class="nav-item ">
                            <a class="nav-link" href="index2.php">
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="examples/user.php">
                                <p>User Profile</p>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="examples/tables.php">
                                <p>Table List</p>
                            </a>
                        </li>

                        <li class="nav-item ">
                            <a class="nav-link" href="examples/map.php">
                                <p>Maps</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>

        </nav>

        <!-- End Navbar -->
        <div class="content">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-danger">
                        <i class="fas fa-align-left"></i>
                        <span>Dashboard</span>
                    </button>
                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-align-justify"></i>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <form class="navbar-form" style="margin-left:50px;">
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                                    <i class="material-icons">search</i>
                                    <div class="ripple-container"></div>
                                </button>
                            </div>
                        </form>
                        <ul class="nav navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <i class="material-icons">dashboard</i>
                                    <p class="d-lg-none d-md-block">
                                        Stats
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link" href="javscript:void(0)" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">notifications</i>
                                    <span class="notification">5</span>
                                    <p class="d-lg-none d-md-block">
                                        Some Actions
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="javascript:void(0)">You have 5 new tasks</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another Notification</a>
                                    <a class="dropdown-item" href="javascript:void(0)">Another One</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0)">
                                    <i class="material-icons">person</i>
                                    <p class="d-lg-none d-md-block">
                                        Account
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- <h3>Dashboard</h3> -->
            <div class="container-fluid">
                <!-- container row -->
                <div class="row align-item-start">
                    <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9">

                        <div class="row">
                            <!-- revenue mtd -->
                            <div class="col-md-3 col-sm-5 col-5">
                                <div class="card card-stats">
                                    <div class="card-header">
                                        <p class="card-category">Revenue MTD</p>
                                        <h5>
                                            Rp. <?php
                                            // echo var_dump($hasil_rupiah);
                                                echo round($hasil_rupiah, 1);
                                                ?>
                                            B
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <!-- growth mom -->
                            <div class="col-md-3 col-sm-5 col-5">
                                <div class="card card-stats">
                                    <div class="card-header">
                                        <p class="card-category">Growth MoM</p>
                                        <h5><?php
                                            echo round($mom, 1);
                                            ?>%
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <!-- growth YoY -->
                            <div class="col-md-3 col-sm-5 col-5">
                                <div class="card card-stats">
                                    <div class="card-header">

                                        <p class="card-category">Growth YoY</p>
                                        <h5> <?php
                                                echo round($yoy, 1);
                                                ?>%
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <!-- growth ytd-->
                            <div class="col-md-3 col-sm-5 col-5">
                                <div class="card card-stats">
                                    <div class="card-header">
                                        <p class="card-category">Growth YTD</p>
                                        <h5> <?php
                                                echo round($ytd, 1);
                                                ?>%
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -20px;">
                            <!-- DU MTD -->
                            <div class="col-md-3 col-sm-5 col-5">
                                <div class="card card-stats">
                                    <div class="card-header">
                                        <p class="card-category">DU MTD</p>
                                        <h5>Rp.
                                            <?php
                                            echo round($duMtd, 1);
                                            ?>B
                                        </h5>
                                    </div>
                                </div>
                            </div>

                            <!-- DU lAST MONTH -->
                            <div class="col-md-3 col-sm-5 col-5">
                                <div class="card card-stats">
                                    <div class="card-header">
                                        <p class="card-category">DU Last Month</p>
                                        <h5> Rp.
                                            <?php
                                            echo round($hasil_rupiahlastmonth, 1);
                                            ?>B
                                        </h5>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- tabel l1 -->
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-header card-header-danger">
                                        <h4 class="card-title">L1</h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-hover">
                                            <thead class="text-warning">
                                                <th>Broadband</th>
                                                <th>Digital Services</th>
                                                <th>SMS P2P</th>
                                                <th>Voice P2P</th>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Revenue MTD</td>
                                                    <td>Revenue MTD</td>
                                                    <td>Revenue MTD</td>
                                                    <td>Revenue MTD</td>
                                                </tr>
                                                <!-- revenue mtd -->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>Rp.
                                                        <?php
                                                        echo round($hasil_rupiahsms, 1);
                                                        ?>
                                                        B</td>
                                                    <td>Rp.
                                                        <?php
                                                        echo round($hasil_rupiahvoice, 1);
                                                        ?>
                                                        B</td>
                                                </tr>
                                                <!-- mom -->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <?php
                                                        echo round($mom_sms, 1);
                                                        ?>
                                                        %
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo round($mom_voice, 1);
                                                        ?>
                                                        %
                                                    </td>
                                                </tr>
                                                <!-- yoy -->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <?php
                                                        echo round($yoy_sms, 1);
                                                        ?>
                                                        %
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo round($yoy_voice, 1);
                                                        ?>
                                                        %
                                                    </td>
                                                </tr>
                                                <!-- ytd -->
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td>
                                                        <?php
                                                        echo round($ytd_sms, 1);
                                                        ?>
                                                        %
                                                    </td>
                                                    <td>
                                                        <?php
                                                        echo round($ytd_voice, 1);
                                                        ?>
                                                        %
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <!-- pie -->
                            <div class="col-lg-6 col-md-12">
                                <div class="card card-chart">
                                    <canvas id="pieChart">
                                    </canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- form -->
                    <div class="col-xl-3 col-lg-4 col-md-4">
                        <div class="col">
                            <div class="card" style="margin-bottom:0px; width: 90%;">
                                <div class="card-header card-header-danger" style="margin-top:0px; padding:10px;">
                                    <div class="nav-tabs-navigation">
                                        <div class="nav-tabs-wrapper">
                                            <span class="nav-tabs-title">Form</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" style="padding:0.9375rem 15px;">

                                    <div class="form-group bmd-form-group is-filled" style="margin:0px 0 0;">
                                        <form method="get" action="">
                                            <label>Update Date:</label>
                                            <input type="date" name="tanggal" class="form-control datepicker">
                                            <label>Start Date:</label>
                                            <input type="date" name="tanggal2" class="form-control datepicker">

                                            <h6 style="margin-top: 10px;">Revenue Type</h6>
                                            <select class="revenue form-control">
                                                <option>L1</option>
                                            </select>
                                            <br>
                                            <h6 style="margin-top: 10px;">Select Area</h6>
                                            <select class="form-control">
                                                <option>Area 1</option>
                                            </select>
                                            <br>
                                            <h6 style="margin-top: 10px;">Select Region</h6>
                                            <select class="form-control" id="region" name="select_Region">
                                                <option>All</option>
                                                <option value="SUMBAGUT">SUMBAGUT </option>
                                                <option value="SUMBAGTENG">SUMBAGTENG</option>
                                                <option value="SUMBAGSEL">SUMBAGSEL</option>

                                            </select>
                                            <br>
                                            <h6 style="margin-top: 10px;">Select L1</h6>
                                            <select class="form-control" id="l1" name="l1">
                                                <option>All</option>
                                                <option value="SMS_P2P">SMS P2P</option>
                                                <option value="Voice_P2P">Voice P2P</option>
                                            </select>
                                            <br>
                                            <button type="submit" class="btn btn-danger" style="margin:0px; line-height:1;">Tampilkan</button>

                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav class="float-left">
                        <ul>
                            <li>
                                <a href="index.php">
                                    Admin Dashboard
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    About Us
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Licenses
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright float-right" id="date">
                        , made with <i class="material-icons">favorite</i> by
                        <a href="#" target="_blank">Ridho Wahyu</a>
                    </div>
                </div>
            </footer>
            <script>
                const x = new Date().getFullYear();
                let date = document.getElementById('date');
                date.innerHTML = '&copy; ' + x + date.innerHTML;
            </script>
        </div>

        <div class="overlay"></div>
        <!-- pie chart -->
        <script type="text/javascript">
            // Build the chart
            var ctx = document.getElementById('pieChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'pie',
                // data set
                data: {
                    labels: ["SMS P2P", "Voice P2P"],
                    datasets: [{
                        label: '1',
                        data: [
                            <?php
                            // sms
                            echo round($hasil_rupiahsms, 1);
                            ?>,
                            <?php
                            echo round($hasil_rupiahvoice, 1);
                            ?>
                        ],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            })
        </script>

        <!-- line -->
        <script>
            var ctx = document.getElementById('lineChart').getContext('2d');
            var data = {
                // data set
                data: {
                    datasets: [{
                        label: "MTD",
                        fill: false,
                        lineTension: 0.1,
                        backgroundColor: "#29B0D0",
                        borderColor: "#29B0D0",
                        pointHoverBackgroundColor: "#29B0D0",
                        pointHoverBorderColor: "#29B0D0",
                        data: [
                            <?php

                            ?>
                        ]
                    }]
                }
            };
            var chart = new Chart(ctx, {
                type: 'line',
                data: data,
                options: {
                    legend: {
                        display: true
                    },
                    barValueSpacing: 20,
                    scales: {
                        yAxes: [{
                            ticks: {
                                min: 0,
                            }
                        }],
                        xAxes: [{
                            gridLines: {
                                color: "rgba(0, 0, 0, 0)",
                            }
                        }]
                    }
                }
            });
        </script>
        <!--   Core JS Files   -->
        <script src="assets/js/core/jquery.min.js"></script>
        <script src="assets/js/core/popper.min.js"></script>
        <script src="assets/js/core/bootstrap-material-design.min.js"></script>
        <script src="https://unpkg.com/default-passive-events"></script>
        <script src="assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Place this tag in your head or just before your close body tag. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chartist JS -->
        <script src="assets/js/plugins/chartist.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="assets/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="assets/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="assets/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="assets/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="assets/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="assets/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="assets/js/plugins/jquery.dataTables.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="assets/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="assets/js/plugins/jquery-jvectormap.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
        <!-- Chartist JS -->
        <script src="assets/js/plugins/chartist.min.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha512-mf78KukU/a8rjr7aBRvCa2Vwg/q0tUjJhLtcK53PHEbFwCEqQ5durlzvVTgQgKpv+fyNMT6ZQT1Aq6tpNqf1mg==" crossorigin="anonymous"></script>
        <!-- Font Awesome JS -->
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>

        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <!-- Popper.JS -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <!-- Bootstrap JS -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <!-- jQuery Custom Scroller CDN -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

        <!-- <script>
            $(document).ready(function() {
                $().ready(function() {
                    $sidebar = $('.sidebar');

                    $sidebar_img_container = $sidebar.find('.sidebar-background');

                    $full_page = $('.full-page');

                    $sidebar_responsive = $('body > .navbar-collapse');

                    window_width = $(window).width();

                    fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                    if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                        if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                            $('.fixed-plugin .dropdown').addClass('open');
                        }

                    }

                    $('.fixed-plugin a').click(function(event) {
                        // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                        if ($(this).hasClass('switch-trigger')) {
                            if (event.stopPropagation) {
                                event.stopPropagation();
                            } else if (window.event) {
                                window.event.cancelBubble = true;
                            }
                        }
                    });

                    $('.fixed-plugin .active-color span').click(function() {
                        $full_page_background = $('.full-page-background');

                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data-color', new_color);
                        }

                        if ($full_page.length != 0) {
                            $full_page.attr('filter-color', new_color);
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.attr('data-color', new_color);
                        }
                    });

                    $('.fixed-plugin .background-color .badge').click(function() {
                        $(this).siblings().removeClass('active');
                        $(this).addClass('active');

                        var new_color = $(this).data('background-color');

                        if ($sidebar.length != 0) {
                            $sidebar.attr('data-background-color', new_color);
                        }
                    });

                    $('.fixed-plugin .img-holder').click(function() {
                        $full_page_background = $('.full-page-background');

                        $(this).parent('li').siblings().removeClass('active');
                        $(this).parent('li').addClass('active');


                        var new_image = $(this).find("img").attr('src');

                        if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                            $sidebar_img_container.fadeOut('fast', function() {
                                $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                                $sidebar_img_container.fadeIn('fast');
                            });
                        }

                        if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                            $full_page_background.fadeOut('fast', function() {
                                $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                                $full_page_background.fadeIn('fast');
                            });
                        }

                        if ($('.switch-sidebar-image input:checked').length == 0) {
                            var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                            var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                            $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                            $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        }

                        if ($sidebar_responsive.length != 0) {
                            $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                        }
                    });

                    $('.switch-sidebar-image input').change(function() {
                        $full_page_background = $('.full-page-background');

                        $input = $(this);

                        if ($input.is(':checked')) {
                            if ($sidebar_img_container.length != 0) {
                                $sidebar_img_container.fadeIn('fast');
                                $sidebar.attr('data-image', '#');
                            }

                            if ($full_page_background.length != 0) {
                                $full_page_background.fadeIn('fast');
                                $full_page.attr('data-image', '#');
                            }

                            background_image = true;
                        } else {
                            if ($sidebar_img_container.length != 0) {
                                $sidebar.removeAttr('data-image');
                                $sidebar_img_container.fadeOut('fast');
                            }

                            if ($full_page_background.length != 0) {
                                $full_page.removeAttr('data-image', '#');
                                $full_page_background.fadeOut('fast');
                            }

                            background_image = false;
                        }
                    });

                    $('.switch-sidebar-mini input').change(function() {
                        $body = $('body');

                        $input = $(this);

                        if (md.misc.sidebar_mini_active == true) {
                            $('body').removeClass('sidebar-mini');
                            md.misc.sidebar_mini_active = false;

                            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                        } else {

                            $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                            setTimeout(function() {
                                $('body').addClass('sidebar-mini');

                                md.misc.sidebar_mini_active = true;
                            }, 300);
                        }

                        // we simulate the window Resize so the charts will get updated in realtime.
                        var simulateWindowResize = setInterval(function() {
                            window.dispatchEvent(new Event('resize'));
                        }, 180);

                        // we stop the simulation of Window Resize after the animations are completed
                        setTimeout(function() {
                            clearInterval(simulateWindowResize);
                        }, 1000);

                    });
                });
            });
        </script> -->
        <script type="text/javascript">
            $(document).ready(function() {
                $("#sidebar").mCustomScrollbar({
                    theme: "minimal"
                });

                $('#dismiss, .overlay').on('click', function() {
                    $('#sidebar').removeClass('active');
                    $('.overlay').removeClass('active');
                });

                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar').addClass('active');
                    $('.overlay').addClass('active');
                    $('.collapse.in').toggleClass('in');
                    $('a[aria-expanded=true]').attr('aria-expanded', 'false');
                });
            });
        </script>

        <script>
            $(document).ready(function() {
                // Javascript method's body can be found in assets/js/demos.js
                md.initDashboardPageCharts();

            });
        </script>

        <script type="text/javascript">
            $(region).ready(function() {
                $('#region').select2();
            });
        </script>
        <script type="text/javascript">
            $(l1).ready(function() {
                $('#l1').select2();
            });
        </script>


</body>

</html>