<?php
 session_start();
 require 'db.php';
 include("check_rights.php");
 if (!isset($_SESSION['uid'])) {
     header("Location:index.php");
 }

 if ($ppr == 0) {
     header("Location:index.php");
 }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PPR | Dashboard </title>
    <?php // echo $_SERVER['DOCUMENT_ROOT']; 
    ?>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="./theme/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="./theme/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="pprScript/pprDashboard.css">
    <link rel="stylesheet" href="pprScript/libs/multiselect/multiselect.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>


</head>

<body class="hold-transition sidebar-mini" onload='onloadFNs();'>
    <div class="wrapper">
        <!-- Navbar -->
        <?php require 'partials/header.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <!-- <a href="pprScript/server/getDataTable.php">getDataTable</a> -->
        <?php require 'partials/sidebar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                        <div class="card" style="box-shadow: none;background: none;">
                            <div class="card-header" style="background: none;border:0">
                                <h1>SACA ANALYTICS</h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <!-- drop down -->
                    <div class="col-md-4 col-xl-2 col-lg-3 col-sm-12">
                        <select class="custom-select" name="DDDivision" id="DDDivision"
                            onchange="setFiltersDropDowns('DDRegion');">
                            <!-- <option value="%">All Division</option> -->
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-2 col-lg-3 col-sm-12">
                        <select class="custom-select" name="DDRegion" multiple id="DDRegion">
                            <!-- <option value="%">All Region</option> -->
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-2 col-lg-3 col-sm-12">
                        <select class="custom-select" name="DDSector" multiple id="DDSector">
                            <!-- <option value="%">All Sector</option> -->
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-2 col-lg-3 col-sm-12">
                        <select class="custom-select" name="DDMonths" id="DDMonths">
                            <!-- <option value="%">All Month</option> -->
                        </select>
                    </div>
                    <div class="col-md-4 col-xl-1 col-lg-2 col-sm-12">
                        <button type="button" onclick="searchLoadFn();" id="filterapplyBtn" class="btn btn-success"
                            style="width: inherit;">Apply</button>
                    </div>
                    <div class="col-md-4 col-xl-1 col-lg-2 col-sm-12">
                        <button type="button" onclick="onloadFNs();" id="resetfilterBtn"
                            class="btn btn-secondary">Reset</button>
                    </div>
                    <!-- <div class="col-md-4 col-xl-2 col-lg-2 col-sm-12">
                        </div> -->
                </div>
                <!-- </div> -->
                <!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <!-- <div class="container-fluid"> -->
                <div class="row">
                    <!-- top table -->
                    <div class="col-md-12 col-xl-12 col-lg-12 col-sm-12">
                        <div class="card">
                            <!-- <div class="card-header" style="background-color: #1d3a67;color:white;">
                                <h3 class="card-title" id="">PPR</h3>
                                <span style="font-size:12px;float: right;">All Figures In AUD(000)</span>
                            </div> -->
                            <div class="card-body" style="overflow: auto;padding:0;">
                                <table class="table table-bordered table-striped ownTbl" id="analysisSummaryTableTop"
                                    style="table-layout: fixed;">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="width:140px">All Figures In AUD(000)</th>
                                            <th style="width:100px;">Actual MTD</th>
                                            <th style="width:100px;display:none;">MTD Forecast</th>
                                            <th style="width:100px">MTD Budget</th>
                                            <th style="width:100px">Var. To Budget</th>
                                            <th style="width:100px">% of Budget</th>
                                            <th style="width:100px">Actual YTD</th>
                                            <th style="width:100px;display:none;">YTD Forecast</th>
                                            <th style="width:100px">YTD Budget</th>
                                            <th style="width:100px">Var. To Budget</th>
                                            <th style="width:100px">% of Budget</th>
                                            <!-- <th style="width:100px">EAC Budget</th>
                                        <th style="width:120px">EAC Forecast</th>
                                        <th style="width:200px">Straight Line Projection</th> -->
                                        </tr>
                                    </thead>
                                    <tr style="line-height: 0;" class="table-light">
                                        <td>Total Revenue</td>
                                        <td id="actualmtd1"></td>
                                        <td style="display:none;" id="mtdforcast1"></td>
                                        <td id="mtdbudget1"></td>
                                        <td id="mtdyartobudget1"></td>
                                        <td id="mtdinpercenofbudget1"></td>
                                        <td id="actualytd1"></td>
                                        <td style="display:none;" id="ytdforcast1"></td>
                                        <td id="ytdbudget1"></td>
                                        <td id="ytdyartobudget1"></td>
                                        <td id="ytdinpercenofbudget1"></td>
                                        <!-- <td id="eacbudget1"></td>
                                    <td id="eacforcast1"></td>
                                    <td id="straightlineprojection1"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;" class="table-light">
                                        <td>Fee Revenue</td>
                                        <td id="actualmtd2"></td>
                                        <td style="display:none;" id="mtdforcast2"></td>
                                        <td id="mtdbudget2"></td>
                                        <td id="mtdyartobudget2"></td>
                                        <td id="mtdinpercenofbudget2"></td>
                                        <td id="actualytd2"></td>
                                        <td style="display:none;" id="ytdforcast2"></td>
                                        <td id="ytdbudget2"></td>
                                        <td id="ytdyartobudget2"></td>
                                        <td id="ytdinpercenofbudget2"></td>
                                        <!-- <td id="eacbudget2"></td>
                                    <td id="eacforcast2"></td>
                                    <td id="straightlineprojection2"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;">
                                        <td>Contribution </td>
                                        <td id="actualmtd3"></td>
                                        <td style="display:none;" id="mtdforcast3"></td>
                                        <td id="mtdbudget3"></td>
                                        <td id="mtdyartobudget3"></td>
                                        <td id="mtdinpercenofbudget3"></td>
                                        <td id="actualytd3"></td>
                                        <td style="display:none;" id="ytdforcast3"></td>
                                        <td id="ytdbudget3"></td>
                                        <td id="ytdyartobudget3"></td>
                                        <td id="ytdinpercenofbudget3"></td>
                                        <!-- <td id="eacbudget3"></td>
                                    <td id="eacforcast3"></td>
                                    <td id="straightlineprojection3"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;">
                                        <td>Contribution %</td>
                                        <td id="actualmtd4"></td>
                                        <td style="display:none;" id="mtdforcast4"></td>
                                        <td id="mtdbudget4"></td>
                                        <td id="mtdyartobudget4"></td>
                                        <td id="mtdinpercenofbudget4"></td>
                                        <td id="actualytd4"></td>
                                        <td style="display:none;" id="ytdforcast4"></td>
                                        <td id="ytdbudget4"></td>
                                        <td id="ytdyartobudget4"></td>
                                        <td id="ytdinpercenofbudget4"></td>
                                        <!-- <td id="eacbudget4"></td>
                                    <td id="eacforcast4"></td>
                                    <td id="straightlineprojection4"></td> -->
                                    </tr>
                                    <tr style="line-height: 0; ">
                                        <td>Overhead</td>
                                        <td id="actualmtd5"></td>
                                        <td style="display:none;" id="mtdforcast5"></td>
                                        <td id="mtdbudget5"></td>
                                        <td id="mtdyartobudget5"></td>
                                        <td id="mtdinpercenofbudget5"></td>
                                        <td id="actualytd5"></td>
                                        <td style="display:none;" id="ytdforcast5"></td>
                                        <td id="ytdbudget5"></td>
                                        <td id="ytdyartobudget5"></td>
                                        <td id="ytdinpercenofbudget5"></td>
                                        <!-- <td id="eacbudget5"></td>
                                    <td id="eacforcast5"></td>
                                    <td id="straightlineprojection5"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;Country</td>
                                        <td id="actualmtd6"></td>
                                        <td style="display:none;" id="mtdforcast6"></td>
                                        <td id="mtdbudget6"></td>
                                        <td id="mtdyartobudget6"></td>
                                        <td id="mtdinpercenofbudget6"></td>
                                        <td id="actualytd6"></td>
                                        <td style="display:none;" id="ytdforcast6"></td>
                                        <td id="ytdbudget6"></td>
                                        <td id="ytdyartobudget6"></td>
                                        <td id="ytdinpercenofbudget6"></td>
                                        <!-- <td id="eacbudget6"></td>
                                    <td id="eacforcast6"></td>
                                    <td id="straightlineprojection6"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;">
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;Division</td>
                                        <td id="actualmtd7"></td>
                                        <td style="display:none;" id="mtdforcast7"></td>
                                        <td id="mtdbudget7"></td>
                                        <td id="mtdyartobudget7"></td>
                                        <td id="mtdinpercenofbudget7"></td>
                                        <td id="actualytd7"></td>
                                        <td style="display:none;" id="ytdforcast7"></td>
                                        <td id="ytdbudget7"></td>
                                        <td id="ytdyartobudget7"></td>
                                        <td id="ytdinpercenofbudget7"></td>
                                        <!-- <td id="eacbudget7"></td>
                                    <td id="eacforcast7"></td>
                                    <td id="straightlineprojection7"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;">
                                        <td>Net Contribution</td>
                                        <td id="actualmtd8"></td>
                                        <td style="display:none;" id="mtdforcast8"></td>
                                        <td id="mtdbudget8"></td>
                                        <td id="mtdyartobudget8"></td>
                                        <td id="mtdinpercenofbudget8"></td>
                                        <td id="actualytd8"></td>
                                        <td style="display:none;" id="ytdforcast8"></td>
                                        <td id="ytdbudget8"></td>
                                        <td id="ytdyartobudget8"></td>
                                        <td id="ytdinpercenofbudget8"></td>
                                        <!-- <td id="eacbudget8"></td>
                                    <td id="eacforcast8"></td>
                                    <td id="straightlineprojection8"></td> -->
                                    </tr>
                                    <tr style="line-height: 0; ">
                                        <td>Net Contribution %</td>
                                        <td id="actualmtd9"></td>
                                        <td style="display:none;" id="mtdforcast9"></td>
                                        <td id="mtdbudget9"></td>
                                        <td id="mtdyartobudget9"></td>
                                        <td id="mtdinpercenofbudget9"></td>
                                        <td id="actualytd9"></td>
                                        <td style="display:none;" id="ytdforcast9"></td>
                                        <td id="ytdbudget9"></td>
                                        <td id="ytdyartobudget9"></td>
                                        <td id="ytdinpercenofbudget9"></td>
                                        <!-- <td id="eacbudget9"></td>
                                    <td id="eacforcast9"></td>
                                    <td id="straightlineprojection9"></td> -->
                                    </tr>
                                    <tr style="line-height: 0;border-top: thin solid" class="table-light">
                                        <td>WIP</td>
                                        <td id="actualmtd10"></td>
                                        <td style="display:none;" id="mtdforcast10"></td>
                                        <td id="mtdbudget10"></td>
                                        <td id="mtdyartobudget10"></td>
                                        <td id="mtdinpercenofbudget10"></td>
                                        <td id="actualytd10"></td>
                                        <td style="display:none;" id="ytdforcast10"></td>
                                        <td id="ytdbudget10"></td>
                                        <td id="ytdyartobudget10"></td>
                                        <td id="ytdinpercenofbudget10"></td>
                                        <!-- <td id="eacbudget10"></td>
                                    <td id="eacforcast10"></td>
                                    <td id="straightlineprojection10"></td> -->
                                    </tr>
                                    <tr style="line-height: 0" class="table-light">
                                        <td>WIP Days</td>
                                        <td id="actualmtd11"></td>
                                        <td style="display:none;" id="mtdforcast11"></td>
                                        <td id="mtdbudget11"></td>
                                        <td id="mtdyartobudget11"></td>
                                        <td id="mtdinpercenofbudget11"></td>
                                        <td id="actualytd11"></td>
                                        <td style="display:none;" id="ytdforcast11"></td>
                                        <td id="ytdbudget11"></td>
                                        <td id="ytdyartobudget11"></td>
                                        <td id="ytdinpercenofbudget11"></td>
                                        <!-- <td id="eacbudget11"></td>
                                    <td id="eacforcast11"></td>
                                    <td id="straightlineprojection11"></td> -->
                                    </tr>
                                    <tr style="line-height: 0" class="table-light">
                                        <td>Debtors</td>
                                        <td id="actualmtd12"></td>
                                        <td style="display:none;" id="mtdforcast12"></td>
                                        <td id="mtdbudget12"></td>
                                        <td id="mtdyartobudget12"></td>
                                        <td id="mtdinpercenofbudget12"></td>
                                        <td id="actualytd12"></td>
                                        <td style="display:none;" id="ytdforcast12"></td>
                                        <td id="ytdbudget12"></td>
                                        <td id="ytdyartobudget12"></td>
                                        <td id="ytdinpercenofbudget12"></td>
                                        <!-- <td id="eacbudget12"></td>
                                    <td id="eacforcast12"></td>
                                    <td id="straightlineprojection12"></td> -->
                                    </tr>
                                    <tr style="line-height: 0" class="table-light">
                                        <td>Debtors Days</td>
                                        <td id="actualmtd13"></td>
                                        <td style="display:none;" id="mtdforcast13"></td>
                                        <td id="mtdbudget13"></td>
                                        <td id="mtdyartobudget13"></td>
                                        <td id="mtdinpercenofbudget13"></td>
                                        <td id="actualytd13"></td>
                                        <td style="display:none;" id="ytdforcast13"></td>
                                        <td id="ytdbudget13"></td>
                                        <td id="ytdyartobudget13"></td>
                                        <td id="ytdinpercenofbudget13"></td>
                                        <!-- <td id="eacbudget13"></td>
                                    <td id="eacforcast13"></td>
                                    <td id="straightlineprojection13"></td> -->
                                    </tr>
                                    <!-- <tbody id="analysisSummaryTablebody"></tbody> -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- top table end -->
                <!-- </div> -->
                <!-- /.row -->
                <!-- charts rows -->
                <div class="row">
                    <div class="col-md-6 col-xl-4 col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body" id="projectChartCounts" style="height:250px;padding:0;"></div>
                        </div>
                        <!-- <canvas id="projectChartCounts" style="max-height: 250px;"></canvas> -->
                    </div>
                    <div class="col-md-6 col-xl-4 col-lg-6 col-sm-12">
                        <div class="card">
                            <div class="card-body" id="MTDFeeChartByRegion" style="height:250px;padding:0;"></div>
                        </div>
                        <!-- <canvas id="MTDFeeChartByRegion" style="max-height: 250px;"></canvas> -->
                    </div>
                    <div class="col-md-12 col-xl-4 col-lg-12 col-sm-12">
                        <div class="card">
                            <div class="card-body" id="MTDFeeChartBySector" style="height:250px;padding:0;"></div>
                        </div>
                        <!-- <canvas id="MTDFeeChartBySector" style="max-height: 250px;"></canvas> -->
                    </div>
                    <!-- <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4 border" style="height:250px;">
                            MTDNWWByMarketChart
                            <canvas id="MTDNWWByMarketChart"></canvas>
                        </div> -->
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12" id="">
                        <div class="card">
                            <div class="card-body" id="MonthlyInvoicesStatisticChart" style="height:250px;padding:0;">
                            </div>
                        </div>
                        <!-- <canvas id="MonthlyInvoicesStatisticChart" style="max-height: 250px;"></canvas> -->
                    </div>
                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12" id="">
                        <div class="card">
                            <div class="card-body" id="WipAndDebtorChart" style="height:250px;padding:0;"></div>
                        </div>
                        <!-- <canvas id="WipAndDebtorChart" style="max-height: 250px;"></canvas> -->
                    </div>
                    <!-- <div class="col-md-4 col-xl-4 col-lg-4 col-sm-4 border" style="height:250px;"
                            id="PipeLineAndNWWChart">PipeLineAndNWWChart</div> -->
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12" id="">
                        <div class="card">
                            <div class="card-body" id="MonthlyPercenMTDFeeRevenueChart" style="height:250px;padding:0;">
                            </div>
                        </div>
                        <!-- <canvas id="MonthlyPercenMTDFeeRevenueChart" style="max-height: 250px;"></canvas> -->
                    </div>
                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12" id="">
                        <div class="card">
                            <div class="card-body" id="PPRChartRevenueVsContribution" style="height:250px;padding:0;">
                            </div>
                        </div>
                        <!-- <canvas id="PPRChartRevenueVsContribution" style="max-height: 250px;"></canvas> -->
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12" id="">
                        <div class="card">
                            <div class="card-body" id="SectorWiseYTDFeeByCountChart" style="height:250px;padding:0;">
                            </div>
                        </div>
                        <!-- <canvas id="MonthlyPercenMTDFeeRevenueChart" style="max-height: 250px;"></canvas> -->
                    </div>
                    <div class="col-md-6 col-xl-6 col-lg-6 col-sm-12" id="">
                        <div class="card">
                            <div class="card-body" id="SectorWiseYTDNWWByCountChart" style="height:250px;padding:0;">
                            </div>
                        </div>
                        <!-- <canvas id="PPRChartRevenueVsContribution" style="max-height: 250px;"></canvas> -->
                    </div>
                </div>
                <!-- charts rows end -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b></b>
        </div>
        <strong><a href="https://adminlte.io"></a></strong>
    </footer>
    <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Add Content Here -->
    </aside>
    <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="./theme/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="./theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <!-- <script src="./theme/plugins/chart.js/Chart.min.js"></script> -->
    <!-- <script src="./theme/plugins/chart.js/Charts.Utiles.js"></script> -->
    <!-- <script src="pprScript/libs/chartjs_labels_plugin.js"></script> -->
    <script src="pprScript/libs/highcharts/highcharts.js"></script>
    <!-- AdminLTE App -->
    <script src="./theme/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <!-- <script src="../../sacadb/theme/dist/js/demo.js"></script> -->
    <!-- Page specific script -->
    <!-- Custom -->
    <script src="pprScript/libs/multiselect/multiselect.js"></script>
    <script src="pprScript/pprDashboardScript.js"></script>

</body>

</html>