<?php 
session_start();
include '../../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php 
    if(isset($_POST['login'])){
        $input = $_POST['username'];
        $password = $_POST['password'];

        // Cek Input ke database apakah sudah sesuai atau belum dengan data yg ada
        if(filter_var($input, FILTER_VALIDATE_EMAIL)){
            $query = "SELECT * FROM ranii WHERE email ='$input'";
        } else {
            $query = "SELECT * FROM ranii WHERE username ='$input'";
        }

        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_assoc($result);

            if(password_verify($password, $row['password'])){
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['nama_lengkap'] = $row['nama_lengkap'];
                $_SESSION['username'] = $row['username'];

                // arahkan ke admin
                header("Location: dashboard.php");
                exit();
            }
            else {
                echo "<p style='color: red'> Password Salah</p>";
            }
        }
        else{
            echo "<p style='color: red'> Username/email tidak sesuai</p>";
        }
    }
    ?>

    <form method="post" action="">
        <label>Username atau Email</label> <br> 
        <input type="text" name="username" placeholder="Masukkan Username Email" required> <br>

        <label>Password</label> <br>
        <input type="password" name="password" placeholder="Masukkan Password" required> <br>
        <br>

        <button type="submit" name="login">Login</button>
    </form>
    
</body>
</html>