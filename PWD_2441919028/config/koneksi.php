<?php
$servername ="localhost";
$username ="root";
$password ="";
$database ="pwd_2441919028";


$conn = mysqli_connect($servername, $username, $password, $database);

if(!$conn){
    die("koneksi Gagal:". mysqli_connect_error());
}

echo "koneksi Berhasil";
mysqli_close($conn);
?>