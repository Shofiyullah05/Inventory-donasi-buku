<?php
require 'functions.php';

//memeriksa apakah tombol submit telah ditekan atau belum
if (isset($_POST["submit"])) {
    //jika sudah ditekan dijalankan function tambah
    if (tambah($_POST) > 0) {
        echo "
        <script>
            alert('Buku Anda Berhasil Ditambahkan.. Terimakasih banyak atas donasinya...');
            document.location.href = 'indexvisitor.php';
        </script>
        ";
    } else {
        echo "
        <script>
            alert('Data Gagal Ditambahkan!');
            document.location.href = 'index2visitor.php';
        </script>
        ";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/daisyui@1.20.0/dist/full.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />
  <link href="https://cdn.jsdelivr.net/npm/daisyui@1.20.0/dist/themes.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>

</head>

<body class="bg-base-100 text-base-content relative" style="min-height: 100vh">

  <div class="container mx-auto pt-10">
  <a class="btn btn-warning" href="indexvisitor.php" onclick="return confirm('tidak jadi mendonasikan buku?')" >BACK</a>
    <div class="px-10 py-5 card bg-base-200 w-1/2 mx-auto">
      <h1 class="text-3xl font-bold text-center mb-4">Donasi Buku</h1>
      <form method="post">
        <div class="form-control mb-2">
          <label class="label">
            <span class="label-text">NAMA</span>
          </label>
          <input type="text" placeholder="Exampple: 'Hajime Isayama' " class="input" name="donatur" required>
        </div>
        <div class="form-control mb-2">
          <label class="label">
            <span class="label-text">ALAMAT</span>
          </label>
          <input type="text" placeholder="Example: 'Kudus'" class="input" name="alamat" required>
        </div>
        <input type="hidden" name="tanggaldonasi" value="<?php echo date("Y-m-d"); ?>">
        <div class="form-control mb-2">
          <label class="label">
            <span class="label-text">JUMLAH</span>
          </label>
          <input type="int" placeholder="Example: '19'" class="input" name="jumlah" required>
        </div>
        <div class="form-control mb-2">
          <label class="label">
            <span class="label-text">NO TELEPON</span>
          </label>
          <input type="text" placeholder="Example: '081234567891'" class="input" name="nomortelepon" >
        </div>
        <button type="submit" class="btn btn-block btn-success" name="submit">Submit</button>
      </form>
    </div>
  </div>
</body>

</html>