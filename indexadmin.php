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
        <title>INVENTORY PERPUSDA KUDUS</title>
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script src="js/jquery.table2excel.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
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
                                Donasi dari Pengunjung
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
                        <h1 class="mt-4">INVENTORY PERPUSTAKAAN</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                 
                                 
                                <div class="row">
                                    <div class="col">
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                    Tambah Buku
                                </button>
                                <button type="button" class="btn btn-primary ml-5" onclick="return confirm('Want to EXPORT data buku Donasi?'), window.open('exportmasuk2excel.php')">
                                    Export Buku Masuk To Excel
                                </button>    
                                    
                                </div>
                                    
                                </div>
                                <div class="row mt-4">
                                    <div class="col">
                                        <h4>Cari berdasarkan tanggal</h4>
                                        <form method="post" class="form-inline">
                                            <input type="date" name="tgl_mulai_masuk" class="form-control mr-2">
                                            sampai
                                            <input type="date" name="tgl_selesai_masuk" class="form-control ml-2">
                                            <button type="submit" name="filter_tgl_masuk" class="btn btn-info ml-3">Filter</button>
                                              
                                        </form>
                                        
                                    </div>
                                    
                                </div>
                                <br>
                                <br>
                                
                                 
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php 
                                                if (isset($_POST['filter_tgl_masuk'])) {
                                                    $mulai_masuk = mysqli_real_escape_string($conn, $_POST['tgl_mulai_masuk']) ;
                                                    $selesai_masuk = mysqli_real_escape_string($conn,  $_POST['tgl_selesai_masuk']);
                                                    
                                                    if ($mulai_masuk!=null || $selesai_masuk!=null) {
                                                        $query = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku and TanggalMasuk BETWEEN 
                                                    '$mulai_masuk' and DATE_ADD('$selesai_masuk', INTERVAL 1 DAY) order by TanggalMasuk DESC");
                                                    } else {
                                                        $query = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku order by TanggalMasuk DESC");    
                                                    }
                                                    
                                                } else {
                                                    $query = mysqli_query($conn, "select * from buku, masuk where buku.idbuku=masuk.idbuku order by TanggalMasuk DESC");
                                                }


                                                
                                                $i=1;
                                                while ($data = mysqli_fetch_array($query)) {
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
                                                        
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$idbuku;?>">
                                                            Edit
                                                        </button>
                                                        <input type="hidden" name="ideditbuku" value="<?=$idbuku;?>">
                                                        
                                                    </tr>

                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="edit<?=$idbuku;?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Edit Buku</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <form method="post">
                                                            <div class="modal-body">
                                                                <input type="text" name="pengarang" value="<?=$pengarang;?>" class="form-control" required>
                                                                <input type="hidden" name="idbuku" value="<?=$idbuku;?>">
                                                                <br>
                                                                <input type="text" name="judulbuku" value="<?=$judulbuku;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="penerbit" value="<?=$penerbit;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="tahun" value="<?=$tahun;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="cet" value="<?=$cet;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="jenisbuku" value="<?=$jenisbuku;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="asal" value="<?=$asal;?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="jumlahfull" value="<?=$jumlah;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="keterangan" value="<?=$keterangan;?>" class="form-control" required>
                                                                <br>
                                                                
                                                                <button type="submit" class="btn btn-primary" name="updatebuku">UPDATE</button>
                                                            </form>
                                                            
                                                            </div>
                                                            
                                                        </div>
                                                        </div>
                                                    </div>
                                                                                                      
                                                    <?php
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
                    
                                
                                <a href="http://perpustakaan.kuduskab.go.id/">Kunjungi kami di</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <!-- Script -->
        
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

    </div>                                        

     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Tambah Buku</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post">
        <div class="modal-body">
            <span class="label-text">PENGARANG</span>
            <input type="text" name="pengarang" placeholder="example 'Hajime Isayama'" class="form-control" required>
            <span class="label-text">Judul Buku</span>
            <input type="text" name="judulbuku" placeholder="example 'Attack On Titan'" class="form-control" required>
            <span class="label-text">Penerbit</span>
            <input type="text" name="penerbit" placeholder="example 'Mappa'" class="form-control" required>
            <span class="label-text">tahun</span>
            <input type="text" name="tahun" placeholder="example '2022'" class="form-control" required>
            <span class="label-text">cet</span>
            <input type="text" name="cet" placeholder="example 'Cet ke 6'" class="form-control" required>
            <span class="label-text">Jenis Buku</span>
            <input type="text" name="jenisbuku" placeholder="example 'Manga'" class="form-control" required>
            <span class="label-text">Asal Buku</span>
            <input type="text" name="asal" placeholder="example 'diki, dkk'" class="form-control" required>
            <span class="label-text">Jumlah Buku</span>
            <input type="number" name="jumlahfull" placeholder="example '129'" class="form-control" required>
            <span class="label-text">Keterangan</span>
            <input type="text" name="keterangan" placeholder="example 'Buku Baru'" class="form-control" required>
            <br>
            <button type="submit" class="btn btn-primary" name="tambah">TAMBAH</button>
        </form>
          
        </div>
        
      </div>
    </div>
  </div>
</html>
