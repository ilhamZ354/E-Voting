<?php
session_start();
if(isset($_SESSION['login'])){
$id=$_SESSION['userId'];

//echo $id;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/swipe.js" defer></script>
    <script src="js/sticky.js"></script>
    <style>
</style>
</head>
<body>

<header>
  <div class="row shadow-sm mb-2 rounded">
    <div class="col-1" >
      <img src="../images/company_logo.png" alt="Logo" style="width:100%;margin:3%">
    </div>
      <div class="title col-11 mt-3">
        <p style="font-size:2.5vw; text-align:left;">E-VOTING ( Company/Organization )</p>
      </div>
    </div>
</header>

<div id="navbar">
<ul class="navigasi shadow-sm mb-2 rounded">
  <li ><a  href="/E-Vote/user/index.php">Dashboard</a></li>
  <li><a href="/E-Vote/user/grafik.php">Grafik</a></li>
  <li style="float:center"><a class="active" href="/E-Vote/user/profil.php">Profil</a></li>
  <li style="float:right;"><a class="logout" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
</ul>
</div>

<script src="js/sticky.js"></script>

<div class="container shadow-sm mb-2 pb-4 rounded" style="background-color:white;">
    <div class="row">
        <div class="col-2 mx-auto">
            <img src="../images/user.jpg" alt="user" style="width:100%;">
        </div>
    <div class="container">
        <div class="row">
        <div class="col-6 mx-auto">
            <div class="card">
                <div class="card-header bg-primary mx-auto" style="width:100%;">
                    <div style="text-align:center;color:white;">Your Profile</div>
                </div>
                <?php
                include("../koneksi.php");
                $sql=mysqli_query($konn,"SELECT * FROM users WHERE userId='$id'");
                $data=mysqli_fetch_assoc($sql);

            $act='';
            if(isset($_GET['set'])){
                $act=='';
            }else{
                    $act='disabled';
                }

                echo 
                '<form method="POST">
                <div class="container" style="margin-top:5%;">
                <div class="col-12">
                <label for="username" class="form-label" >Username</label>
                <input type="text" class="form-control" id="username" name="username" value="'.$data['username'].'" disabled>
                </div>
                <div class="col-12">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama" value="'.$data['nama'].'" disabled>
                </div>
                <div class="col-12">
                <label for="pass" class="form-label">Password</label>
                <input type="text" class="form-control" id="pass" name="password" value="'.$data['password'].'" '.$act.'>
                </div>
                <div class="col-2 mt-2 mb-2">
                <tr>
                <td>';
                if($act!==''){
                   echo' <a href="profil.php?set=edit" class="btn btn-warning">Edit</a>';
                }else{
                    echo '<button type="submit" class="btn btn-success" name="simpan">simpan</button>';
                    }
                '</td>
                </tr>
               </div>
                </div>
                </form>
        </div>
    </div>
</div>
';
          if(isset($_POST['simpan']))  {
            $password=$_POST['password'];
            

            $sql=mysqli_query($konn,"UPDATE users SET password='$password'  WHERE userId='$id' ");
            if($sql){
                header("location:profil.php");
            }
          }

}else{
    echo '<script type ="text/JavaScript">';  
          echo 'alert("KAMU HARUS LOGIN !")';  
          echo '</script>';  
    }
?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
<footer class="shadow-lg p-5 mt-3 bg-light" style="background-color:#FFFFFF;">
  <div class="row">
    <div class="col-12 text-center">
        <h5 style="color:gray;">Copyright 2023</h5>
        <h6 style="color:#C1D0B5">Ilham Zukhri | Manajemen informatika</h6>
    </div>
  </div>
</footer>
</html>