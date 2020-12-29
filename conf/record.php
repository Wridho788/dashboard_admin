<?php
include("conn.php");

error_reporting(0);

if (isset($_GET['tanggal'])) {
    $tgl = $_GET['tanggal'];
    $tgl2 = $_GET['tanggal2'];

    // revenue mtd, du mtd,ytd 2020
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.l1 = 'SMS P2P' ");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.l1 = 'Voice P2P' ");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.l1 = 'SMS P2P' ");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.l1 = 'Voice P2P' ");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.l1 = 'SMS P2P'");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.l1 = 'Voice P2P'");


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
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2' and excel.region = '$selectRegion'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.l1 = 'SMS P2P' and excel.region = '$selectRegion'");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.l1 = 'Voice P2P' and excel.region = '$selectRegion'");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)and excel.region = '$selectRegion'");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.l1 = 'SMS P2P' and excel.region = '$selectRegion'");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.l1 = 'Voice P2P' and excel.region = '$selectRegion'");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)and excel.region = '$selectRegion'");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.l1 = 'SMS P2P'and excel.region = '$selectRegion'");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.l1 = 'Voice P2P'and excel.region = '$selectRegion'");


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
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.l1 '$l1' ");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.l1 '$l1' ");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.l1 '$l1' ");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.l1 '$l1' ");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.l1 '$l1' ");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.l1 '$l1' ");


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
    $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'and excel.region = '$selectRegion'");
    // table l1
    $sqlsms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_sms from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.region = '$selectRegion' and excel.l1 '$l1' ");
    $sqlvoice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voice from excel WHERE excel.date BETWEEN '$tgl' and '$tgl2' and excel.region = '$selectRegion' and excel.l1 '$l1' ");

    // last month, du last month
    $sqllastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lm from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH)and excel.region = '$selectRegion'");
    $sqlsmslastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_smslm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.region = '$selectRegion' and excel.l1 '$l1' ");
    $sqlvoicelastmonth = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_voicelm from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 MONTH) and DATE_SUB('$tgl2', INTERVAL 1 MONTH) and excel.region = '$selectRegion'and excel.l1 '$l1' ");

    // last year, ytd 2019
    $sqllastyear = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_ly from excel where excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR)");
    $sqllastyear_sms = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lysms from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.region = '$selectRegion'and excel.l1 '$l1' ");
    $sqllastyear_voice = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_lyvoice from excel WHERE excel.date between DATE_SUB('$tgl', INTERVAL 1 YEAR) and DATE_SUB('$tgl2', INTERVAL 1 YEAR) and excel.region = '$selectRegion'and excel.l1 '$l1' ");

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
    $sql = mysqli_query($koneksi, "SELECT * from excel");
}
