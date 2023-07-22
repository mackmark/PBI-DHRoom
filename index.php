<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PBI Dry-Charge</title>

      <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/bootstrap4.6.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="assets/css/datatables.min.css"/>

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="assets/fonts/fontawesome/css/all.min.css">

    <!-- style CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
    <body>

        <div class="container-fluid text-center bg-light p-2">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <span class="text-secondary float-left mt-1" style="font-weight:bold;">DEHUMIDIFICATION SYSTEM </span>

                        <img src="weatherIcons/dehumidifier.png" class="img-fluid float-right" alt="" width="30">
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
            
        </div>

        <div class="container mt-2">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div id="weather_container" class="container-fluid shadow-sm bg-white p-2 mb-2 rounded">
                    </div>

                    <div id="DeviceConnection_container" class="container-fluid shadow-sm bg-white p-0 mb-1 mt-3 rounded">
                    </div>

                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-6">
                                    <div id="Temp_container" class="container-fluid shadow-sm bg-white p-2 mb-1 mt-3 rounded">
                                    </div>
                            </div>

                            <div class="col-lg-6">
                                    <div id="RH_container" class="container-fluid shadow-sm bg-white p-2 mb-1 mt-3 rounded">
                                    </div>
                            </div>
                        </div>
                    </div>

                    <div id="chart_container" class="container-fluid shadow-sm bg-white p-2 mb-2 mt-3 rounded">
                        <canvas id="myChart"></canvas>
                    </div>
                    
                </div>
                <div class="col-lg-3"></div>
            </div>

        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/popper.min.js"></script>

        <!--DataTable -->
        <script src="assets/js/datatables.min.js"></script>
        <script src="assets/js/dataTables.responsive.min.js"></script>
        <script src="assets/js/dataTables.buttons.min.js"></script>
        <script src="assets/js/jszip.min.js"></script>
        <!-- <script src="assets/js/pdfmake.min.js"></script> -->
        <!-- <script src="assets/js/vfs_fonts.js"></script> -->
        <script src="assets/js/buttons.html5.min.js"></script>
        <script src="assets/js/jquery.tabledit.min.js"></script>
        <!--DataTable END-->

        <script src="assets/bootstrap4.6.2/js/bootstrap.bundle.min.js"></script>

        <script src="assets/js/sweetalert.min.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script src="js/repository.js"></script>
        <script src="js/chart.js"></script>

    </body>
</html>