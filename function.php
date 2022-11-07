<?php 

session_start();
$conn = mysqli_connect("localhost","root","","donasibuku");

//menambah buku
if(isset($_POST["tambah"])) {
    
    $pengarang = $_POST['pengarang'];
    $judulbuku = $_POST['judulbuku'];
    $penerbit = $_POST['penerbit'];
    $tahun = $_POST['tahun'];
    $cet = $_POST['cet'];
    $jenisbuku = $_POST['jenisbuku'];
    $jumlah = $_POST['jumlahfull'];
    $asal = $_POST['asal'];
    $updatejumlah = $_POST['jumlahfull'];
    $keterangan = $_POST['keterangan'];

    $addtotable = mysqli_query($conn, "insert into buku (pengarang, judulbuku, penerbit, tahun, cet, jenisbuku, jumlahfull,
    updatejumlah,keterangan) values ('$pengarang', '$judulbuku', '$penerbit', '$tahun', '$cet', '$jenisbuku', '$jumlah',
    '$updatejumlah', '$keterangan')");


    
    $addtotable2 = mysqli_query($conn, "insert into masuk (judulbuku, asal) values ('$judulbuku', '$asal')");
    $id = "UPDATE buku,masuk SET masuk.idbuku = buku.idbuku WHERE buku.judulbuku = masuk.judulbuku";
    $id_buku_masuk = mysqli_query($conn, $id);

    if ($addtotable && $addtotable2 && $id_buku_masuk) {
        header('location:indexadmin.php');
    } else {
        echo 'gagal menambahkan';
        header('location:indexadmin.php');
    }

}



// menambah barang keluar
if (isset($_POST['barangkeluar'])) {
    $judulkeluar = $_POST['judulkeluar'];
    $jmlkeluar = $_POST['jmlkeluar'];
    $penerima = $_POST['penerima'];
    $keterangan_terima = $_POST['keterangan_terima'];


    $cekjumlahsekarang = mysqli_query($conn, "select * from buku where judulbuku='$judulkeluar'");
    $getdata = mysqli_fetch_array($cekjumlahsekarang);

    $jumlahsekarang = $getdata['updatejumlah'];
    if ($jmlkeluar<=$jumlahsekarang) {
        $updatestocksekarang = $jumlahsekarang-$jmlkeluar;
        $addtokeluar = mysqli_query($conn, "insert into keluar (judulbuku, penerima, jmlkeluar, keterangan_terima) values ('$judulkeluar', '$penerima',
        '$jmlkeluar', '$keterangan_terima')");
        $updatestockkeluar = mysqli_query($conn,"update buku set updatejumlah='$updatestocksekarang' where judulbuku='$judulkeluar'");
        
        $id_buku_keluar = "UPDATE buku,keluar SET keluar.idbuku = buku.idbuku WHERE buku.judulbuku = keluar.judulbuku";
        $query_id_buku_keluar = mysqli_query($conn, $id_buku_keluar);

        if ($addtokeluar&&$updatestockkeluar&&$query_id_buku_keluar) {
            header('location:keluar.php');
        } else {
            echo '<script type ="text/JavaScript"-->'; 
            echo 'gagal menambahkan';
            header('location:keluar.php');
        }
    } else {
        echo '
        <script>
            alert ("Barang yang didonasikan jumlahnya terlalu besar, dan stock nya tidak cukup");
            window.location.href="keluar.php";
        </script> ';

    }
        

    
}

//update info buku masuk
if(isset($_POST['updatebuku'])) {
    $idbukuupdate = $_POST['idbuku'];
    $pengarangupdate = $_POST['pengarang'];
    $judulbukuupdate = $_POST['judulbuku'];
    $penerbitupdate = $_POST['penerbit'];
    $tahunupdate = $_POST['tahun'];
    $cetupdate = $_POST['cet'];
    $jenisbukuupdate = $_POST['jenisbuku'];
    $jumlahupdate = $_POST['jumlahfull'];
    $asalupdate = $_POST['asal'];
    $keteranganupdate = $_POST['keterangan'];
    


    $update_pengarang = mysqli_query($conn, "update buku set pengarang ='$pengarangupdate' where idbuku= '$idbukuupdate'");
    $update_judul_buku = mysqli_query($conn, "update buku set judulbuku ='$judulbukuupdate' where idbuku= '$idbukuupdate'");
    $query_judul_masuk = "UPDATE masuk SET judulbuku = '$judulbukuupdate' WHERE idbuku = '$idbukuupdate' ";
    $update_judul_masuk = mysqli_query($conn, $query_judul_masuk);
    $update_penerbit = mysqli_query($conn, "update buku set penerbit ='$penerbitupdate' where idbuku= '$idbukuupdate'");
    $update_tahun = mysqli_query($conn, "update buku set tahun ='$tahunupdate' where idbuku= '$idbukuupdate'");
    $update_cet = mysqli_query($conn, "update buku set cet ='$cetupdate' where idbuku= '$idbukuupdate'");
    $update_jenis = mysqli_query($conn, "update buku set jenisbuku ='$jenisbukuupdate' where idbuku= '$idbukuupdate'");
    $update_jumlah = mysqli_query($conn, "update buku set jumlahfull ='$jumlahupdate' where idbuku= '$idbukuupdate'");
    $update_tersedia = mysqli_query($conn, "update buku set updatejumlah = '$jumlahupdate' where idbuku= '$idbukuupdate'");
    
    $update_keterangan = mysqli_query($conn, "update buku set keterangan ='$keteranganupdate' where idbuku= '$idbukuupdate'");
    $query_asal_update = "UPDATE masuk SET asal = '$asalupdate' WHERE idbuku = '$idbukuupdate'";
    $update_asal = mysqli_query($conn, $query_asal_update);
    
    if($update_pengarang || $update_judul_masuk || $update_judul_buku || $update_penerbit || $update_tahun || 
    $update_cet || $update_jenis || $update_jumlah || $update_tersedia || $update_asal || $update_keterangan ) {
        header('location:tersedia.php');
        
        header('location:indexadmin.php');
        
        
    } else {
        echo 'gagal';
        header('location:indexadmin.php');
        header('location:tersedia.php');
        
    }






}





//Update info keluar

if(isset($_POST['updatekeluar'])) {
    $idbukukeluar = $_POST['idbuku'];
    $judulkeluarupdate = $_POST['judulbuku'];
    $penerimaupdate = $_POST['penerima'];
    $jmlkeluar_update = $_POST['jmlkeluar'];
    $keterangan_terima_update = $_POST['keterangan_terima'];


    $update_judulkeluar = mysqli_query($conn, "update keluar set judulbuku ='$judulkeluarupdate' where idbuku= '$idbukukeluar'");
    $update_penerima = mysqli_query($conn, "update keluar set penerima ='$penerimaupdate' where idbuku= '$idbukukeluar'");
    $update_jml_keluar = mysqli_query($conn, "update keluar set jmlkeluar ='$jmlkeluar_update' where idbuku= '$idbukukeluar'");
    $update_keterangan_terima = mysqli_query($conn, "update keluar set keterangan_terima ='$keterangan_terima_update' where idbuku= '$idbukukeluar'");
    
    $cek_jml_sekarang = mysqli_query($conn, "select * from buku where idbuku='$idbukukeluar'");
    $ambildata = mysqli_fetch_array($cek_jml_sekarang);
    $jumlah_keluar_sekarang = $ambildata['jumlahfull'];
    $update_stock = $jumlah_keluar_sekarang-$jmlkeluar_update;


    $stocksekarang = mysqli_query($conn, "update buku set buku.updatejumlah = '$update_stock' where idbuku = '$idbukukeluar'");

    if($update_judulkeluar || $update_penerima || $update_jml_keluar || $update_keterangan_terima || $stocksekarang ) {
        header('tersedia.php');
        header('keluar.php');
    } else {
        echo '<script>
        alert ("gagal update, coba cek kembali datanya");
        window.location.href="keluar.php";
    </script>' ;
        header('keluar.php');
    }
}

//Delete Buku Keluar
if (isset($_POST['deletekeluar'])) {
    $idkeluarhapus = $_POST['idbuku'];
    $id_keluar = $_POST['idkeluar'];
    $jmlkeluar_hapus = $_POST['jmlkeluar'];
    $judul_keluar_hapus = $_POST['judulbuku'];
    $penerima_hapus = $_POST['penerima'];
    $keterangan_terima_hapus = $_POST['keterangan_terima'];
   

    $cek_jml_sekarang = mysqli_query($conn, "select * from buku where idbuku='$idkeluarhapus'");
    $ambildata = mysqli_fetch_array($cek_jml_sekarang);
    $jumlah_keluar_sekarang = $ambildata['jumlahfull'];
    $update_stock = $jumlah_keluar_sekarang;
    $update_jumlah_stock = mysqli_query($conn, "update buku set updatejumlah = '$update_stock' where idbuku = '$idkeluarhapus'");
    
    $query_keluar_hapus = mysqli_query($conn, "delete from keluar where idkeluar ='$id_keluar'");

    $update_judulkeluar = mysqli_query($conn, "update keluar set judulbuku ='$judul_keluar_hapus' where idbuku= '$idkeluarhapus'");
    $update_penerima = mysqli_query($conn, "update keluar set penerima ='$penerima_hapus' where idbuku= '$idkeluarhapus'");
    $update_jml_keluar = mysqli_query($conn, "update keluar set jmlkeluar ='$jmlkeluar_hapus' where idbuku= '$idkeluarhapus'");
    $update_keterangan_terima = mysqli_query($conn, "update keluar set keterangan_terima ='$keterangan_terima_hapus' where idbuku= '$idkeluarhapus'");

    if( $query_keluar_hapus || $update_jumlah_stock || $update_judulkeluar || $update_penerima || $update_jml_keluar || $update_keterangan_terima ) {
        header('tersedia.php');
        header('keluar.php');
    } else {
        echo '<script>
        alert ("gagal update, coba cek kembali datanya");
        window.location.href="keluar.php";
    </script>' ;
        header('keluar.php');
        header('tersedia.php');
    }

}





 ?>