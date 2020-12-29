<?php
require("conf/conn.php");
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
  <!-- CSS Files -->
  <link href="assets/css/material-dashboard.css?v=2.1.2" rel="stylesheet" />
  <link href="assets/css/custom.css" rel="stylesheet" />
</head>

<body class="dark-edition">
  <div class="wrapper ">
    <div class="sidebar" data-color="danger" data-background-color="black">
      <div class="logo"><a href="#" class="simple-text logo-normal">
          Dashboard
        </a></div>
      <div class="sidebar-wrapper" style="width: auto;">
        <ul class="nav">
          <li class="nav-item active  ">
            <a class="nav-link" href="index.php">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="examples/user.php">
              <i class="material-icons">person</i>
              <p>User Profile</p>
            </a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="examples/tables.php">
              <i class="material-icons">content_paste</i>
              <p>Table List</p>
            </a>
          </li>

          <li class="nav-item ">
            <a class="nav-link" href="examples/map.php">
              <i class="material-icons">location_ons</i>
              <p>Maps</p>
            </a>
          </li>

        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top " id="navigation-example">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation" data-target="#navigation-example">
            <span class="sr-only">Toggle navigation</span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
            <span class="navbar-toggler-icon icon-bar"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end">
            <form class="navbar-form">
              <div class="input-group no-border">
                <input type="text" value="" class="form-control" placeholder="Search...">
                <button type="submit" class="btn btn-default btn-round btn-just-icon">
                  <i class="material-icons">search</i>
                  <div class="ripple-container"></div>
                </button>
              </div>
            </form>
            <ul class="navbar-nav">
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
      <!-- End Navbar -->
      <div class="content" style="margin-top: 50px;">
        <div class="container-fluid">
          <!-- container row -->
          <div class="row align-item-start">
            <div class="col-xl-9 col-lg-8 col-md-9 col-sm-9" style="border: 1px solid black;padding-right:0px;">

              <div class="row">
                <!-- revenue mtd -->
                <div class="col-md-3 col-sm-5 col-5">
                  <div class="card card-stats">
                    <div class="card-header">
                      <p class="card-category">Revenue MTD</p>
                      <h5>
                        Rp. <?php
                        if (isset($_GET['tanggal'])) {
                          $tgl = $_GET['tanggal'];
                          $tgl2 = $_GET['tanggal2'];
                          $sql = mysqli_query($koneksi, "SELECT SUM(revenue) as revenue_mtd from excel where excel.date between '$tgl' and '$tgl2'");
                          $data = mysqli_fetch_array($sql);
                          $data['revenue_mtd'];
                          $hasil_rupiah = " " . number_format($data['revenue_mtd'], 2, ',', '.');
                          echo round($hasil_rupiah, 1);
                        } else {
                          $sql = mysqli_query($koneksi, "SELECT * from excel");
                        }
                        ?>B
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
                        error_reporting(0);
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

                          $queryMoM = (($hasil_rupiah / $hasil_rupiahlastmonth - 1) * 100);
                          echo round($queryMoM, 1);
                        } else {
                          $sql = mysqli_query($koneksi, "SELECT * from excel");
                        }
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
                        error_reporting(0);
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
                        error_reporting(0);
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
                        } else {
                          $sql = mysqli_query($koneksi, "SELECT * from excel");
                        }

                        $queryYtd = ($hasil_rupiahytd20 / $hasil_rupiahlastyear19 - 1) * 100;
                        echo round($queryYtd, 2);
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
                        error_reporting(0);
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
                        error_reporting(0);
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
                        ?>B
                      </h5>
                    </div>
                  </div>
                </div>

              </div>

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
                              ?>
                              B</td>
                            <td>Rp.
                              <?php
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
                              ?>
                              B</td>
                          </tr>
                          <!-- mom -->
                          <tr>
                            <td></td>
                            <td></td>
                            <td>
                              <?php
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
                              ?>
                              %
                            </td>
                            <td>
                              <?php
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
                              ?>
                              %
                            </td>
                            <td>
                              <?php
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
            <div class="col-xl-3 col-lg-4 col-md-4" style="border: 1px solid blue;">
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
                      <form method="get">
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
                        <select class="form-control">
                          <option>All</option>
                          <option>SUMBAGUT </option>
                          <option>SUMBAGTENG</option>
                          <option>SUMBAGSEL</option>

                        </select>
                        <br>
                        <h6 style="margin-top: 10px;">Select L1_Name</h6>
                        <select class="l1 form-control">
                          <option>All</option>
                          <option>SMS P2P</option>
                          <option>Voice P2P</option>
                        </select>
                        <br>
                        <button type="submit" class="btn btn-danger" value="FILTER" style="margin:0px; line-height:1;">Tampilkan</button>

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
    </div>

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
    <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
    <script src="assets/js/plugins/bootstrap-tagsinput.js"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="assets/js/plugins/jasny-bootstrap.min.js"></script>
    <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
    <script src="assets/js/plugins/fullcalendar.min.js"></script>
    <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
    <script src="assets/js/plugins/jquery-jvectormap.js"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="assets/js/plugins/nouislider.min.js"></script>
    <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
    <!-- Library for adding dinamically elements -->
    <script src="assets/js/plugins/arrive.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chartist JS -->
    <script src="assets/js/plugins/chartist.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" integrity="sha512-mf78KukU/a8rjr7aBRvCa2Vwg/q0tUjJhLtcK53PHEbFwCEqQ5durlzvVTgQgKpv+fyNMT6ZQT1Aq6tpNqf1mg==" crossorigin="anonymous"></script>
    <script>
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
    </script>
    <script>
      $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        md.initDashboardPageCharts();

      });
    </script>


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
              ?>,
              <?php
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
</body>

</html>