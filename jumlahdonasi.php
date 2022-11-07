<?php
require 'functions.php';
$bukudonasi = query("SELECT * FROM bukudonasi ORDER BY tanggaldonasi DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>Donasi Pengunjung</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/jquery.table2excel.js"></script>
        
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
                        <h1 class="mt-4">Donasi dari Pengunjung</h1>
                        <div class="card mb-4">
                            <div class="card-header">               
                                <button type="button" class="btn btn-primary" onclick="return confirm('Want to EXPORT data buku Donasi?'), window.open('exportpengunjung2excel.php')">
                                    Export Data Buku Donasi To Excel
                                </button>
                                 
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">DONATUR</th>
                                                <th scope="col">ALAMAT</th>
                                                <th scope="col">Tanggal Masuk</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">No Telpon</th>
                                                <th scope="col">Aktivitas</th>
                                                
                                            </tr>
                                        </thead>
                                        <?php $i=1;?>
                                        <?php foreach ($bukudonasi as $item) : ?>
                                        <tr>
                                            <td><?php echo $i++;?>
                                            <td><?= $item['donatur']; ?></td>
                                            <td><?= $item['alamat']; ?></td>
                                            <td><?= $item['tanggaldonasi']; ?></td>
                                            <td><?= $item['jumlah']; ?></td>
                                            <td><?= $item['nomortelepon']; ?></td>
                                            <td>
                                                <a class="btn btn-danger" href="hapus.php?id=<?= $item["id"]; ?>"onclick="return confirm('Are You Sure want to DELETE?')" >Delete</a>
                                            </td>
                                                                                                                                
                                            <?php endforeach ?>
                                        </tr>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

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
