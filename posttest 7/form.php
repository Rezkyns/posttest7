<?php
    require 'config.php';
    $tgl = date('Y/m/d');


    if(isset($_POST["kirim"])){
        $jenis = $_POST['jenis'];
        $warna = $_POST['warna'];
        $kelamin = $_POST['kelamin'];
        $ekor = $_POST['ekor'];
        $lomba = $_POST['lomba'];
        $filename = $_FILES["fileToUpload"]["name"];
        $temp = $_FILES["fileToUpload"]["tmp_name"];
        $folder = "./gambar/" . $filename;

        $result = mysqli_query($db, 
        "INSERT INTO web (nama, warna, Gender, Model, Lomba, tanggal, files)
        VALUES ('$jenis', '$warna', '$kelamin', '$ekor', '$lomba', '$tgl', '$filename')");

        if($result){
            move_uploaded_file($temp, $folder);
            echo "
                <script>
                    alert('Data Berhasil di Kirim');
                </script>
                ";
            header('Location: tabel.php');
        }else {
            echo "
                <script>
                    alert('Gagal');
                </script>
                ";
            }
            header('Location: tabel.php');    
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
    <h3> Masukkan Data Ikan Cupang</h3>
    <form action="" method="post" enctype="multipart/form-data">
    <label for="">Jenis Cupang : </label>
    <input type="text" name="jenis"><br><br>
    <label for="">Warna Cupang : </label>
    <input type="text" name="warna"> <br><br>
    <label for="">Jenis Kelamin : </label>
    <input type="text" name="kelamin"> <br><br>
    <label for="">Bentuk ekor : </label>
    <input type="text" name="ekor"> <br><br>
    <label for="">Jenis Perlombaan : </label>
    <input type="text" name="lomba"> <br><br>
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" name="kirim"> 
    </form>
</body>
</html>