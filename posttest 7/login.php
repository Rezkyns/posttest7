<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h3>Login Akun</h3>
    <form action="" method="post">
        <label for="">username / email</label><br>
        <input type="text" name="user"><br><br>

        <label for="">password</label><br>
        <input type="password" name="password"><br><br>

        <input type="submit" name="login"><br><br>
    </form>
    
</body>
</html>


<?php
    session_start();
    require'config.php';

    if(isset($_POST['login'])){
        $user = $_POST['user'];
        $password = $_POST['password'];

        echo $user;

        $sql = "SELECT * FROM akun WHERE username='$user' OR email='$user'";
        $result = $db->query($sql);


        //cek akun ada atau tidak ada
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $username = $row['username'];
            echo $row['psw'];

            //cek password apakah valid atau tidak
            if(password_verify($password, $row['psw'])){

                $_SESSION['login'] = true;
                
                echo "<script> 
                        alert('Selamat Datang $username');   
                        document.location.href = 'index.php';  
                </script>";
            }else {
                echo "<script> 
                    alert('Username dan Password anda salah');     
                </script>";
            }
        }else {
            echo "<script> 
                 alert('Username dan password anda belum teregistrasi');   
             </script>";
        }
    }
?>