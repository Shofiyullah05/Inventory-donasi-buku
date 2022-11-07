<?php
//memanggil file functions.php
require 'functions.php';
$bukudonasi = query("SELECT * FROM bukudonasi");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <title>INVENTORY PERPUSDA KUDUS</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/jquery.table2excel.js"></script>
    </head>
    <body class="sb-nav-fixed">
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                        <div class="card mb-4">                           
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <div class="container mx-auto pt-10">
                                        <h1 class="text-center">DAFTAR BUKU DONASI</h1>
                                        <a class="btn btn-success " href="tambah.php">Donasikan Buku</a>
                                    </div>
                                    <br>
                                    <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">DONATUR</th>
                                                <th scope="col">ALAMAT</th>
                                                <th scope="col">Tanggal Masuk</th>
                                                <th scope="col">Jumlah</th>
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
                                            <?php endforeach ?>
                                        </tr>                                        
                                    </table>  
                                    <br>                                  
                                <a class="btn btn-warning" href="logout.php" onclick="return confirm('want to LOGOUT?')" >LOGOUT</a>
                                <br>
                                <br>   
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
