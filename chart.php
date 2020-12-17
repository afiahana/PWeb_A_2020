<?php session_start();
    if($_SESSION["username"]){
        //blok program jika user telah login terlebih dahulu
        include "koneksi.php";
        ?>
        <head>
            <!-- Bootstrap CSS -->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
            <link href="myStyle.css" rel="stylesheet">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
            <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
            <script>
                window.onload = function () {

                var dps = []; // dataPoints
                var chart = new CanvasJS.Chart("chartContainer", {
                    title :{
                        text: "Data Covid-19 Surabaya"
                    },
                    data: [{
                        type: "bar",
                        dataPoints: dps
                    }]
                });

                var xVal = 0;
                var yVal = 500; 
                var updateInterval = 1000;
                var dataLength = 10; // number of dataPoints visible at any point

                var updateChart = function (count) {

                    count = count || 1;

                    for (var j = 0; j < count; j++) {
                        yVal = yVal +  Math.round(10 + Math.random() *(-5-5));
                        dps.push({
                            x: xVal,
                            y: yVal
                        });
                        xVal++;
                    }

                    if (dps.length > dataLength) {
                        dps.shift();
                    }

                    chart.render();
                };

                updateChart(dataLength);
                setInterval(function(){updateChart()}, updateInterval);

                }
            </script>
        </head>
        <body class="bg-info">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-item nav-link" href="home.php">HOME</a>
                        <a class="nav-item nav-link active" href="chart.php">CHART<span class="sr-only">(current)</span></a>
                        <a class="nav-item nav-link" href="upload.php">UPLOAD</a>
                        <a class="nav-item nav-link" href="log.php">LOG</a>
                    </div>
                </div>
            </nav>
            <br>
            <div class="container-fluid">
                <div class="animated fadeIn">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <!-- <div class="card-header">
                                    <h4 class="card-title">
                                        CHARTS DATA COVID-19
                                    </h4>
                                </div> -->
                                <div class="card-body">
                                <div id="chartContainer" style="height: 500px; width: 100%;"></div>
                                <!-- <canvas id="bar-chart" width="600" height="400"></canvas> -->
                                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>
    <?php
    }
    else{
        header("location:login.php");
    }
?>