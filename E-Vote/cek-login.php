<?php
session_start();
include('koneksi.php');

if(isset($_POST['login'])){
  $username=$_POST['username'];
  $password=$_POST['password'];

 // echo $username; 
 // echo $nama;
$query =mysqli_query($konn,"SELECT * FROM users WHERE username='$username'AND password='$password'");

if($query){
  
  if(mysqli_num_rows($query)!=0){
    
    $cek=mysqli_fetch_assoc($query);
    
    if($cek['hak_akses']=='admin'){
        header("location:/E-Vote/admin");
        $_SESSION['login']='berhasil';
        $_SESSION['userId']=$cek['userId'];
    }elseif ($cek['hak_akses']=='user'){
        header("location:/E-Vote/user");
        $_SESSION['userId']=$cek['userId'];
        $_SESSION['login']='berhasil';
    }
}else
    {
        header("location:index.php?pesan='gagal'");
    }
}}
?>
