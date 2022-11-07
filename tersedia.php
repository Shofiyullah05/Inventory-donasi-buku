<?php 
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
        <title>Buku Tersedia</title>
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
                        <h1 class="mt-4">Buku Tersedia</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <div class="row">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Donasikan Buku
                                    </button>
                                
                                    <button type="button" class="btn btn-primary ml-5" onclick="return confirm('Apakah anda ingin EXPORT Data Buku Tersedia ke excel?'), window.open('exporttersedia2excel.php')">
                                    Export Buku Tersedia To Excel
                                    </button>

                                </div>
                                 
                                <div class="row mt-4">
                                    <div class="col">
                                        <h4>Cari berdasarkan tanggal</h4>
                                        <form method="post" class="form-inline">
                                            <input type="date" name="tgl_mulai" class="form-control mr-2">
                                            sampai
                                            <input type="date" name="tgl_selesai" class="form-control ml-2">
                                            <button type="submit" name="filter_tgl" class="btn btn-info ml-3">Filter</button>    
                                        </form>
                                    </div>
                                    
                                </div>
                                
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
                                                <th>Update Jumlah</th>
                                                <th>Ket</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                           <?php
                                            if (isset($_POST['filter_tgl'])) {
                                                $mulai = mysqli_real_escape_string($conn, $_POST['tgl_mulai']) ;
                                                $selesai = mysqli_real_escape_string($conn,  $_POST['tgl_selesai']);
                                                
                                                if ($mulai!=null || $selesai!=null) {
                                                    $query = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku and TanggalMasuk BETWEEN 
                                                '$mulai' and DATE_ADD('$selesai', INTERVAL 1 DAY) order by TanggalMasuk DESC");
                                                } else {
                                                    $query = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku order by TanggalMasuk DESC");    
                                                }
                                                
                                            } else {
                                                $query = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku order by TanggalMasuk DESC");
                                            }                                            
                                            
                                            $i =1;
                                            while ($data = mysqli_fetch_array($query)) {
                                                if ($data['updatejumlah']>0) {
                                                
                                                ?>
                                                <tr>
                                                <td><?= $i++; ?></td>
                                                <td><?= $data ['TanggalMasuk']; ?></td>
                                                <td><?= $data ['pengarang']; ?></td>
                                                <td><?= $data ['judulbuku']; ?></td>
                                                <td><?= $data ['penerbit']; ?></td>
                                                <td><?= $data ['tahun']; ?></td>
                                                <td><?= $data ['cet']; ?></td>
                                                <td><?= $data ['jenisbuku']; ?></td>
                                                <td><?= $data ['asal']; ?></td>
                                                <td><?= $data ['updatejumlah']; ?></td>
                                                <td><?= $data ['keterangan']; ?></td>
                                                </td>
                                                </tr>
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
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Perpustakaan Kabupaten Kudus</div>
                            <div>
                    
                                
                                <a href="#http://perpustakaan.kuduskab.go.id/">Kunjungi kami di</a>
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
    </body>  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Buku Keluar</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
                <div class="modal-body">
                    <span class="label-text">Judul Buku</span>
                    <input type="text" name="judulkeluar" placeholder="Masukkan judul buku yang ingin di donasikan" class="form-control" required>
                    <span class="label-text">Penerima</span>
                    <input type="text" name="penerima" placeholder="Masukkan Penerima" class="form-control" required>
                    <span class="label-text">Jumlah Keluar</span>
                    <input type="number" name="jmlkeluar" placeholder="Jumlah Keluar" class="form-control" required>
                    <span class="label-text">Keterangan</span>
                    <input type="text" name="keterangan_terima" placeholder="KETERANGAN" class="form-control" required>
                    <br>
                    <button type="submit" class="btn btn-primary" name="barangkeluar">TAMBAH</button>
                    <br>
        </form>
          
        </div>
        
      </div>
    </div>
  </div>
</html>
