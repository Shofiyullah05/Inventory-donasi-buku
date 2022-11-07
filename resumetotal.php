


<?php
require 'function.php';
require 'cek.php';

$posttotalmasuk = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku");
$totalmasuk = 0;
$gettotalmasuk=0;
while ($masuk = $posttotalmasuk ->fetch_assoc()) {
    $totalmasuk = $masuk['jumlahfull'];
    $gettotalmasuk+= $totalmasuk;
}

$posttotaltersedia = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku");
$totaltersedia = 0;
$gettotaltersedia=0;
while ($tersedia = $posttotaltersedia ->fetch_assoc()) {
    $totaltersedia = $tersedia['updatejumlah'];
    $gettotaltersedia+= $totaltersedia;
}

$posttotalkeluar = mysqli_query($conn, "select * from buku, keluar where buku.idbuku=keluar.idbuku");
$totalkeluar = 0;
$gettotalkeluar=0;
while ($keluar = $posttotalkeluar ->fetch_assoc()) {
    $totalkeluar = $keluar['jmlkeluar'];
    $gettotalkeluar+= $totalkeluar;
}



 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Resume Total</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/jquery.table2excel.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
        

        <script src="exportmasuk2excel.js"></script>

    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="indexadmin.php">Perpusda Kudus</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="resumetotal.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Resume
                            </a>
                            <a class="nav-link" href="indexadmin.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Buku Masuk
                            </a>
                            <a class="nav-link" href="tersedia.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Buku Tersedia
                            </a>
                            <a class="nav-link" href="keluar.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Buku Keluar
                            </a>
                            <a class="nav-link" href="jumlahdonasi.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Donasi dari pengunjung
                            </a>
                            <a class="nav-link" href="logout.php" onclick="return confirm('want to LOGOUT?')" >
                                Logout
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">RESUME TOTAL</h1>
                        <div class="card mb-4">
                            
                            <div class="card-body">
                            <div style="width: 800px;margin: 0px auto;">
                                <canvas id="myChart"></canvas>
                            </div>
                            <h6>Total Buku Masuk : <?= $gettotalmasuk; ?></h6>
                            <h6>Total Buku Keluar :  <?= $gettotalkeluar; ?> </h6>
                            <h6>Total Buku Tersedia : <?= $gettotaltersedia; ?> </h6>

                            <script>
                                var ctx = document.getElementById("myChart").getContext('2d');
                                var myChart = new Chart(ctx, {
                                    type: 'bar',
                                    data: {
                                        labels: ["Buku Masuk", "Buku Tersedia", "Buku Keluar"],
                                        datasets: [{
                                            label: '',
                                            data: [
                                                <?= $gettotalmasuk; ?>, 
                                                <?= $gettotaltersedia; ?>, 
                                                <?= $gettotalkeluar; ?> 
                                            
                                            ],
                                            backgroundColor: [
                                            'rgba(255, 99, 132, 0.2)',
                                            'rgba(54, 162, 235, 0.2)',
                                            'rgba(255, 206, 86, 0.2)'
                                            ],
                                            borderColor: [
                                            'rgba(255,99,132,1)',
                                            'rgba(54, 162, 235, 1)',
                                            'rgba(255, 206, 86, 1)'
                                            ],
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        scales: {
                                            yAxes: [{
                                                ticks: {
                                                    beginAtZero:true
                                                }
                                            }]
                                        }
                                    }
                                });
                            </script>

                            

                            </div>
                        </div>
                    </div>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Perpustakaan Kabupaten Kudus</div>
                            <div>
                    
                                
                                <a href="http://perpustakaan.kuduskab.go.id/">Kunjungi kami di</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>

</html>
 