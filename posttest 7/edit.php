<?php
    require 'config.php';
    $t = date('Y/m/d');

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $result = mysqli_query($db,
        "SELECT * FROM web WHERE id='$id'");
    $row = mysqli_fetch_array($result);


    if(isset($_POST["kirim"])) {
        $jenis = $_POST['jenis'];
        $warna = $_POST['warna'];
        $kelamin = $_POST['kelamin'];
        $ekor = $_POST['ekor'];
        $lomba = $_POST['lomba'];
        $filename = $_FILES["Upload"]["name"];
        $temp = $_FILES["Upload"]["tmp_name"];
        $folder = "./gambar/" . $filename;

        $result = mysqli_query($db, "UPDATE web SET
            nama='$jenis',
            warna='$warna',
            Gender='$kelamin',
            Model='$ekor',
            Lomba='$lomba',
            tanggal='$t',
            files='$filename'
        WHERE id='$id'");

        if($result){
            move_uploaded_file($temp, $folder);
            echo "
                <script>
                    alert('Data Berhasil di Kirim');
                    document.location.href = 'tabel.php';
                </script>
                ";
        }else {
            echo "
                <script>
                    alert('Gagal');
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
    <meta name="viewport" content="width=h3, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tambah.CSS"> 
</head>
<body>
    <h3>Edit Data Ikan Cupang</h3>
    <form action="" method="post" enctype="multipart/form-data">
    <label for="">Jenis Cupang : </label>
    <input type="text" name="jenis" value=<?=$row['nama']?>><br>
    <label for="">Warna Cupang : </label>
    <input type="text" name="warna" value=<?=$row['warna']?>> <br>
    <label for="">Jenis Kelamin : </label>
    <input type="text" name="kelamin" value=<?=$row['Gender']?>> <br>
    <label for="">Bentuk ekor : </label>
    <input type="text" name="ekor" value=<?=$row['Model']?>> <br>
    <label for="">Jenis Perlombaan : </label>
    <input type="text" name="lomba" value=<?=$row['Lomba']?>> <br>
    Ganti gambar <input type="file" name="Upload" id="Upload">
    <input type="submit" name="kirim">
    </form>
</body>
</html>