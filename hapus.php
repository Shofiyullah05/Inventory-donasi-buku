<?php

require 'functions.php';
//mengambil id yg ingin dihapus
$id = $_GET["id"];

//hapus jumlah donasi
if( hapus($id) > 0) {
    echo "
        <script>
            alert('data berhasil dihapus!');
            document.location.href = 'jumlahdonasi.php';
        </script>
    ";
} else {
    echo "
        <script>
            alert('data berhasil dihapus!');
            document.location.href = 'jumlahdonasi.php';
        </script>
    ";
}
?>