<?php

header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan-masuk.xls");
require 'function.php';
require 'cek.php';


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
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            
        </nav>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">INVENTORY PERPUSTAKAAN</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                 <!-- Button to Open the Modal -->
                                 
                                 <h1>Laporan Buku Masuk</h1>
                                 
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Pengarang</th>
                                                <th>Judul</th>
                                                <th>Penerbit</th>
                                                <th>Tahun</th>
                                                <th>Cet</th>
                                                <th>Jenis Buku</th>
                                                <th>Asal</th>
                                                <th>Jumlah</th>
                                                <th>Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                 
                                                
                                                $query_masuk = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku order by TanggalMasuk DESC");
                                                $i=1;
                                                while ($data = mysqli_fetch_array($query_masuk)) {
                                                    $idbuku = $data['idbuku'];
                                                    $TanggalMasuk = $data['TanggalMasuk'];
                                                    $pengarang = $data['pengarang'];
                                                    $judulbuku = $data ['judulbuku'];
                                                    $penerbit = $data ['penerbit'];
                                                    $tahun  = $data['tahun'];
                                                    $cet = $data['cet'];
                                                    $jenisbuku = $data['jenisbuku'];
                                                    $asal = $data['asal'];
                                                    $jumlah = $data['jumlahfull'];
                                                    $keterangan = $data ['keterangan'];
                                                    if ($jumlah>0) {
                                                    
                                                    
                                                    ?>
                                                    
                                                    <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $TanggalMasuk; ?></td>
                                                    <td><?= $pengarang; ?></td>
                                                    <td><?= $judulbuku; ?></td>
                                                    <td><?= $penerbit; ?></td>
                                                    <td><?= $tahun; ?></td>
                                                    <td><?= $cet; ?></td>
                                                    <td><?= $jenisbuku; ?></td>
                                                    <td><?= $asal; ?></td>
                                                    <td><?= $jumlah; ?></td>
                                                    <td><?= $keterangan; ?></td>
                                                    <td>
                                                    
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

    </body>
</html>
