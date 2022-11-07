<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "donasibuku");

//fungsi untuk mengambil data dari database
function query($query)
{
    global $conn;
    $data = mysqli_query($conn, $query);
    $bukudonasi = [];
    while ($pengunjung = mysqli_fetch_assoc($data)) {
        $bukudonasi[] = $pengunjung;
    }
    return $bukudonasi;
}

//fungsi untuk menambah data
function tambah($data)
{
    global $conn;

    $donatur = ($data['donatur']);
    $alamat = ($data['alamat']);
    $tanggal = $_POST["tanggaldonasi"];
    $jumlah = ($data['jumlah']);
    $nomortelepon = ($data['nomortelepon']);

    $query = "INSERT INTO bukudonasi
                    VALUES
                    ('', '$donatur', '$tanggal', '$alamat', '$jumlah', '$nomortelepon')
                ";
    //menggunakan query untuk menambah data yaitu memerlukan parameter penghubung database dan query sql
    mysqli_query($conn, $query);
    //mengembalikan jumlah pada database,
    //contoh: jika id = 3 terdapat pada database maka akan mereturn nilai 1, jika tidak ada maka return 0
    return mysqli_affected_rows($conn);
}

//fungsi untuk menghapus data
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM bukudonasi WHERE id = $id");
    return mysqli_affected_rows($conn);
}
