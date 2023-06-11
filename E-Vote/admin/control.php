<?php
ob_start();
session_start();
include('timeModal.php');
if(isset($_SESSION['login'])){
    $id=$_SESSION['userId'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/swipe.js" defer></script>
    <script src="js/sticky.js"></script>
    <style>
      input[type=text]{
        border-radius:10px;
        border-style:none;
                      }

.aksi ul{
  display:block;
} 
.tool{
  list-style-type: none;
  margin: 0;
  padding: 0;
  margin-top:10%;
  background-color:#FFFFFF;
  overflow: hidden;

}

.tool li {
  margin:2px;
  display: block;
  float: left;
  background-color:none;

}

.tool li button {
  display: block;
  color:white;
  border-width:2px;
  text-align: center;
  padding: 14px;
  transition: 0.2s;
}
.tool .btn{
  padding:0;
  padding-top:7px;
  padding-bottom:7px;
  padding-left:10px;
  padding-right:10px;
  border-radius:0.5rem;
}

.tool button:hover{
  transform:scale(1.02);
  color:#FFFFFF;
}

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
  <li><a href="/E-Vote/admin/index.php">Dashboard</a></li>
  <li><a href="/E-Vote/admin/voter.php">Voter</a></li>
  <li><a  href="/E-Vote/admin/grafik.php">Grafik</a></li>
  <li><a class="active" href="/E-Vote/admin/control.php">Control</a></li>
  <li style="float:center"><a href="/E-Vote/admin/profil.php">profil</a></li>
    <li style="float:right;"><a class="logout" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
</ul>
</div>
<script src="js/sticky.js"></script>
<?php
include("../koneksi.php");
    $sql2 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' AND pilihan!='0' ");
    $jmlh2 = mysqli_num_rows($sql2);

    $sql = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' ");
    $jmlh = mysqli_num_rows($sql);

    $sql3 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='admin' AND userId='$id' ");
    $query= mysqli_fetch_assoc($sql3);
    $value=$query['status'];

    $bg ="";
    if($value=="closed"){
      $value="CLOSED";
      $bg = "danger";
    }else{
      $value="OPEN";
      $bg = "success";
    }

//tanggal
if(isset($_POST['tanggal'])){
    $tanggal= $_POST['tanggal'];
    $jam=$_POST['jam'];
    if(strlen($jam)<2){
      $jam = '0'.$jam;
    }
    $menit=$_POST['menit'];
    $menit=$_POST['menit'];
    if(strlen($menit)<2){
      $menit = '0'.$menit;
    }
    $detik=$_POST['detik'];
    $detik=$_POST['detik'];
    if(strlen($detik)<2){
      $detik = '0'.$detik;
    }

    $pukul = $jam.":".$menit.":".$detik;
    // echo $tanggal;
    // echo $pukul;

    $query2 = mysqli_query($konn,"SELECT * FROM waktu");
    $tot = mysqli_num_rows($query2);

    if($tot==0){
    $sql = mysqli_query($konn,"INSERT INTO waktu VALUE ('$tanggal','$pukul')");
    $sql2 = mysqli_query($konn,"UPDATE users SET status='open'");
    }else{
    $sql = mysqli_query($konn,"UPDATE waktu SET tanggal='$tanggal',jam='$pukul'");
    $sql2 = mysqli_query($konn,"UPDATE users SET status='open'");
    }
    if($sql){
      ?>
      <script>
        alert("PROSES BERHASIL !");
        window.location.href="control.php";
      </script><?php
    }
    
}

//WAKTU HABIS
if(isset($_POST['timer'])){
  $tgl = $_POST['timer'];
  
    $sql = mysqli_query($konn,"UPDATE users SET status='closed'");
    header("location:control.php");
    // echo '<script type="text/javascript"> location.reload() </script>';
    
  
  
}

//UNTUK SET TIME
$query = mysqli_query($konn,"SELECT * FROM waktu");

if($query){
    if(mysqli_num_rows($query)!=0){
        $batas=mysqli_fetch_assoc($query);

        $date= $batas['tanggal'];
        $hour=$batas['jam'];

        // echo $date ." ". $hour;
    }else{
      $date=0;
      $hour=0;
    }
}
echo'
<div class="row">
        <div class="col-12">
              <form method="post" id="habis" action="control.php">
                <div class="row">
                  <div class="col-md-9 offset-md-9 "><label for="timer" style="color:gray;">Batas Waktu : </label> <input  type="text" name="timer" id="waktu" value="" readonly="true" style="width:20%;text-align:center;color:gray;"></div>
                </div>
        </div>
      </div>
      </form>
  
  <div class="container shadow-sm " style="background-color:#FFFFFF;">
  <form method="post">
    <div class="mt-2">
    <label for="status" style="color:gray;">STATUS VOTE :</label>
    <input class="bg-'.$bg.' mt-3" type="text" name="votter" id="status" value="'.$value.'" style="width:100px;color:white;text-align:center;border:none;" readonly="true">
    </div>

  
  <div class="row">
    <div class="container mt-5">
      <div class="col-5">
                    <div class="container shadow-sm mb-2 rounded">
                      <div class="row align-items-center">
                        <div class="col-2 container shadow-sm rounded" style="background-color:#F7D060">
                              <i class="bi bi-people" style="font-size:3vw;color:white"></i>
                        </div>
                              <div class="col-9">
                                <h2 class="mt-2" style="color:#F7D060">Jumlah Voter</h2>
                                <h6 style="color:gray">'.$jmlh.' Mahasiswa</h6>
                              </div>
                      </div>
                    </div>
      </div>
      <div class="col-5">
                    <div class="container shadow-sm mb-2 rounded">
                      <div class="row align-items-center">
                        <div class="col-2 container shadow-sm rounded mx-auto" style="background-color:#5BB318">
                              <i class="bi bi-pin-angle-fill" style="font-size:3vw;color:white"></i>
                        </div>
                              <div class="col-9">
                                <h2 class="mt-2" style="color:#5BB318">Total Vote</h2>
                                <h6 style="color:gray">'.$jmlh2.' Suara</h6>
                              </div>
                      </div>
                    </div>
      </div>

    </div>
</div>


    <input type="text" name="tanggal" id="date" value='.$date.' style="display:none;" >
    <input type="text" name="jam" id="hour" value='.$hour.' style="display:none;" >
    

    </form>';?>

<script>
  var date = document.getElementById("date");
  var pukul = document.getElementById("hour");
   const timer = document.getElementById("waktu");

if(date.value ==0){
  timer.value="BELUM DITETAPKAN";
}
else
{
const waktu = setInterval(function(){
  const sekarang = new Date();
  console.log(date);

  const batas = new Date(date.value +" "+ pukul.value);

  const selisih = new Date(batas - sekarang);

    const hari = Math.floor(selisih / (1000 * 60 * 60 * 24));
      // console.log(hari);
  const hour = set(Math.floor((selisih % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)));
  const menit = set(selisih.getMinutes());
  const detik = set(selisih.getSeconds());

  if(hour==0 && menit==0 && detik==0){ 
    document.getElementById("habis").submit();
  }


  console.log(detik);
 
  if(selisih <0){
    clearInterval(waktu);
    timer.value= 'WAKTU HABIS';

  }else{
  timer.value = hari+" hari " +hour+":"+menit+":"+detik;
  }
  function set(timer) {
    timer = timer < 10 ? "0" + timer : timer;
    return timer;
  }

  
});
}

</script>



<div class="aksi container">
    <ul class="tool">
      <form method="post">
      <li><button type="submit" name="clear" class="btn btn-warning shadow-sm" >Clear Vote</button></li>
        <li style="float:right"><button type="submit" name="close" class="btn btn-danger">Close Vote</button></li>
        </form>
      <li style="float:right"><button type="button" name="open" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Open Vote</button></li>
    </ul>
</div>

<hr>
</form><?php

            $no=0;
            $query=mysqli_query($konn, "SELECT * FROM calon");
            while($result=mysqli_fetch_array($query)){
            $total[]=$result['total'];
            $no++;
            
          
            }
            $maks=max($total);
            //echo $maks;

            $query2=mysqli_query($konn,"SELECT * FROM calon WHERE total='$maks' ");
            $row=mysqli_num_rows($query2);
            $sql=mysqli_fetch_assoc($query2);
            
            if($maks==0){
              $nomor='';
              $hasil=" ";
            }else{
              if($row>1){
                $nomor='';
                $hasil="Didapatkan Hasil Sementara Voting 'Seri', perlu tindakan pihak panitia";
              }else{
              $nomor=$sql['nomor'];
              $hasil="Didapatkan Hasil Sementara Vote Tertinggi Pasang Calon Nomor Urut ' $nomor '";
              }
            }
    
            
            //echo $nomor;
?>

<div class="card mt-5" style="background-color:#C1EFFF;">
  <div class="card-header">
    <h5 style="color:#FFFFFF;">DATA TERTINGGI</h5>
  </div>
  <div class="card">
  <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="row container">
                      <div class="col-5 container">
                        <div class="row shadow-sm justify-content-start">
                          <div class="col-2.3 text-center">
                            <div class="container rounded bg-warning "><i class="bi bi-bar-chart-fill" style="font-size:2.2vw;color:white"></i></div>
                          </div>
                          <div class="col-8">
                            <h6 style="color:#3B9AE1;">Total Vote Tertinggi</h6>
                            <span style="color:gray;"><?php echo $maks?> Suara </span>
                          </div>
                        </div>
                      </div>

                      <div class="col-5 container ">
                        <div class="row shadow-sm justify-content-start">
                          <div class="col-2.3 text-center">
                            <div class="container rounded bg-info"><i class="bi bi-person-lines-fill" style="font-size:2.2vw;color:white"></i></div>
                          </div>
                          <div class="col-8 justify-content-start">
                            <h6 style="color:#3B9AE1;">Nomor Urut :</h6>
                            <span style="color:gray;"><?php echo $nomor?></span>
                          </div>
                        </div>
                      </div>

                    </div>
                </div>
            </div>
      
            
            <div class="row mt-5">
              <div class="container">
                <div class="col-12 text-center">
                    <p style="color:gray;"><?php echo $hasil ?> </p>
                </div>
              </div>
            </div>


  <input type="text" class="form-control" id="total" name="total" value="<?php echo $maks?>" style="display:none;">
  <input type="text" class="form-control" id="nomor" name="nomor" value="<?php echo $nomor ?>" style="display:none;">
  
  <div class="container mt-2">
  <div class="col-2 mx-auto">
  <form method="POST">
  <button type="submit" name="umumkan" class="btn btn-primary mt-2"><i class="bi bi-bell"></i> umumkan</button>
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
</html><?php

if(isset($_POST['close'])){
    $sql = mysqli_query($konn,"UPDATE users SET status='closed'");
    $sql2 = mysqli_query($konn,"DELETE FROM waktu");?>
    <script>
        alert("VOTE TELAH DITUTUP !");
        window.location.href="control.php";
      </script><?php
}

if(isset($_POST['clear'])){
  ?>
  <script>
   var yakin = confirm("Apakah kamu yakin ?");

    if (yakin) {
    <?php
    $sql = mysqli_query($konn,"UPDATE users SET pilihan=0, status='closed' ");
    $sql2 = mysqli_query($konn,"DELETE FROM waktu");
    $query=mysqli_query($konn,"SELECT * FROM calon");
    $jmlh=mysqli_num_rows($query);

    for($k=1;$k<=$jmlh;$k++){
    $query=mysqli_query($konn,"SELECT * FROM users WHERE pilihan='$k' ");
    $total=mysqli_num_rows($query);

    
    $query2=mysqli_query($konn,"UPDATE calon SET  total='$total' WHERE nomor='$k' ");
    
    }?>
    }else{
          window.location.href="control.php";
        }

        alert("VOTE TELAH DITUTUP !");
        window.location.href="control.php";
       </script> 
        <?php
   
}
if(isset($_POST['umumkan'])){

  if($nomor!=''){
  $sql = mysqli_query($konn,"UPDATE users SET status='closed' ");
  ?>
  <script>
  alert("HASIL VOTING TELAH DI UMUMKAN ");
  </script><?php
}else{
  echo "<script>alert('DATA BELUM DITEMUKAN')</script>";
}

}
}else{
    echo '<script type ="text/JavaScript">';  
      echo 'alert("KAMU HARUS LOGIN !")';  
      echo '</script>';  
  }
?>
