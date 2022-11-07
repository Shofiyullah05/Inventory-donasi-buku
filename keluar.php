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
        <title>Buku Keluar</title>
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
                        <h1 class="mt-4">Daftar Buku Terdonasikan</h1>
                        <div class="card mb-4">
                            <div class="card-header">
                                <button type="button" class="btn btn-primary" onclick="return confirm('Apakah anda ingin EXPORT Data Buku Keluar ke excel?'), window.open('exportkeluar2excel.php')">
                                    Export Buku Keluar To Excel
                                </button>
                                <div class="row mt-4">
                                    <div class="col">
                                        <h4>Cari berdasarkan tanggal</h4>
                                        <form method="post" class="form-inline">
                                            <input type="date" name="tgl_mulai_keluar" class="form-control mr-2">
                                            sampai
                                            <input type="date" name="tgl_selesai_keluar" class="form-control ml-2">
                                            <button type="submit" name="filter_keluar" class="btn btn-info ml-3">Filter</button>
                                             
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
                                                <th>Tanggal Keluar</th>
                                                <th>Pengarang</th>
                                                <th>Judul</th>
                                                <th>Penerbit</th>
                                                <th>Tahun</th>
                                                <th>Cet</th>
                                                <th>Jenis Buku</th>
                                                <th>Penerima</th>
                                                <th>Jumlah Keluar</th>
                                                <th>Ket</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                                if (isset($_POST['filter_keluar'])) {
                                                    $mulai_keluar = mysqli_real_escape_string($conn, $_POST['tgl_mulai_keluar']);
                                                    $selesai_keluar = mysqli_real_escape_string($conn, $_POST['tgl_selesai_keluar']);
                                                    if($mulai_keluar!=null || $mulai_keluar!=null) {
                                                        $keluar = mysqli_query($conn, "select * from buku, keluar where buku.idbuku=keluar.idbuku and TanggalKeluar BETWEEN 
                                                        '$mulai_keluar' and DATE_ADD('$selesai_keluar', INTERVAL 1 DAY) order by TanggalKeluar DESC");    
                                                    } else {
                                                        $keluar = mysqli_query($conn, "select * from buku, keluar where buku.idbuku=keluar.idbuku order by TanggalKeluar DESC");    
                                                    }
                                            
                                                } else {
                                                    $keluar = mysqli_query($conn, "select * from buku, keluar where buku.idbuku=keluar.idbuku order by TanggalKeluar DESC");
                                                }

                                                $i =1;
                                                while ($datakeluar = mysqli_fetch_array($keluar)) {
                                                    $datakeluar['idbuku'];
                                                    $idkeluar = $datakeluar['idkeluar'];
                                                    $TanggalKeluar = $datakeluar ['TanggalKeluar'];
                                                    $idkeluar = $datakeluar['idkeluar'];
                                                    $judulbuku = $datakeluar ['judulbuku'];
                                                    $pengarang = $datakeluar ['pengarang'];
                                                    $penerbit = $datakeluar ['penerbit'];
                                                    $tahun = $datakeluar ['tahun'];
                                                    $cet = $datakeluar ['cet'];
                                                    $jenisbuku = $datakeluar ['jenisbuku'];
                                                    $penerima = $datakeluar ['penerima']; 
                                                    $jmlkeluar = $datakeluar ['jmlkeluar'];
                                                    $keterangan_terima = $datakeluar ['keterangan_terima'];

                                                    
                                                    ?>
                                                    <tr>
                                                    <td><?= $i++; ?></td>
                                                    <td><?= $TanggalKeluar; ?></td>
                                                    <td><?= $pengarang; ?></td>
                                                    <td><?= $judulbuku; ?></td>
                                                    <td><?= $penerbit; ?></td>
                                                    <td><?= $tahun; ?></td>
                                                    <td><?= $cet; ?></td>
                                                    <td><?= $jenisbuku; ?></td>
                                                    <td><?= $penerima; ?></td>
                                                    <td><?= $jmlkeluar; ?></td>
                                                    <td><?= $keterangan_terima; ?></td>
                                                    <td>
                                                        
                                                        <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#edit<?=$datakeluar['idbuku'];?>">
                                                            Edit
                                                        </button>
                                                        <input type="hidden" name="ideditbuku" value="<?=$datakeluar['idbuku'];?>">
                                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus<?=$datakeluar['idbuku'];?>">
                                                            Hapus
                                                        </button>
                                                        <input type="hidden" name="idhapusbuku" value="<?=$idbuku;?>">
                                                    </tr>
                                                    <!-- Edit Modal -->
                                                    <div class="modal fade" id="edit<?=$datakeluar['idbuku'];?>">
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
                                                                <input type="text" name="judulbuku" value="<?=$judulbuku;?>" class="form-control" required>
                                                                <input type="hidden" name="idbuku" value="<?=$datakeluar['idbuku'];;?>">
                                                                <br>
                                                                <input type="text" name="penerima" value="<?=$penerima;?>" class="form-control" required>
                                                                <br>
                                                                <input type="number" name="jmlkeluar" value="<?=$jmlkeluar;?>" class="form-control" required>
                                                                <br>
                                                                <input type="text" name="keterangan_terima" value="<?=$keterangan_terima;?>" class="form-control" required>
                                                                <br>
                                                                <button type="submit" class="btn btn-primary" name="updatekeluar">UPDATE</button>
                                                            </div>
                                                            </form>
                                                        </div>

                                                            
                                                        </div>
                                                    </div>
                                                    

                                                    <!-- Hapus Modal -->
                                                    <div class="modal fade" id="hapus<?=$datakeluar['idbuku'];?>">
                                                        <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        
                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                            <h4 class="modal-title">Hapus Buku</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            
                                                            <!-- Modal body -->
                                                            <form method="post">
                                                            <div class="modal-body">
                                                                
                                                                <input type="hidden" name="judulbuku" value="<?=$judulbuku;?>" class="form-control" >
                                                                <input type="hidden" name="idbuku" value="<?=$datakeluar['idbuku'];;?>">
                                                                
                                                                <input type="hidden" name="penerima" value="<?=$penerima;?>" class="form-control" >
                                                                
                                                                <input type="hidden" name="jmlkeluar" value="<?=$jmlkeluar;?>" class="form-control" >
                                                                
                                                                <input type="hidden" name="keterangan_terima" value="<?=$keterangan_terima;?>" class="form-control" >
                                                                <input type="hidden" name="idkeluar" value="<?=$idkeluar;?>" class="form-control" >
                                                                
                                                                <h6>Apakah anda yakin ingin menghapus <?=$datakeluar['judulbuku'];?>? </h6>
                                                                <button type="submit" class="btn btn-primary" name="deletekeluar">Hapus</button>
                                                            </div>
                                                                
                                                            </form>
                                                            
                                                            </div>
                                                            
                                                        </div>
                                                    </div>
                                                    <?php
                                                };
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
    </body>
</html>
