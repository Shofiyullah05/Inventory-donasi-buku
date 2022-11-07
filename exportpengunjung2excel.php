<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-pendonasi-masuk.xls");
require 'functions.php';
$bukudonasi = query("SELECT * FROM bukudonasi");


?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>INVENTORY PERPUSDA KUDUS</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/jquery.table2excel.js"></script>
        <script src="exportmasuk2.js"></script>
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
                                        <div class="flex mb-10 justify-between">
                                            <h1 class="text-3xl font-medium text-center font-bold">DAFTAR BUKU DONASI</h1>
                                        </div>
                                    </div>
                                    <thead>
                                            <tr>
                                                <th scope="col">No.</th>
                                                <th scope="col">DONATUR</th>
                                                <th scope="col">ALAMAT</th>
                                                <th scope="col">Tanggal Masuk</th>

                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Nomor telepon</th>

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
                                            <?php endforeach ?>
                                        </tr>                                        
                                    </table>  
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
    </body>
</html>
