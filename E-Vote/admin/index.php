<?php
session_start();
ob_start();

  if(isset($_SESSION['login'])){

    include('../koneksi.php');
  
  $sql = mysqli_query($konn,"SELECT * FROM calon ");
  $jmlhcalon = mysqli_num_rows($sql);

  //timer
$query_waktu = mysqli_query($konn,"SELECT * FROM waktu");

if($query_waktu){
    if(mysqli_num_rows($query_waktu)!=0){
        $batas=mysqli_fetch_assoc($query_waktu);

        $date= $batas['tanggal'];
        $hour=$batas['jam'];

        // echo $date ." ". $hour;
    }else{
      $date=0;
      $hour=0;
    }
}

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
      .tambahCalon a{
        color:#7FE9DE;
      }
      .tambahCalon a:hover{
        background-color:#7FE9DE;

      }
      .tambahCalon a:hover{
        color:#FFFFFF;
      }
      input[type=text]{
        border-radius:10px;
        border-style:none;
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
  <li><a class="active" href="/E-Vote/admin/index.php">Dashboard</a></li>
  <li><a href="/E-Vote/admin/voter.php">Voter</a></li>
  <li><a href="/E-Vote/admin/grafik.php">Grafik</a></li>
  <li><a href="/E-Vote/admin/control.php">Control</a></li>
  <li style="float:center"><a href="/E-Vote/admin/profil.php">profil</a></li>
    <li style="float:right;"><a class="logout" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
</ul>
</div>

<div class="row">
        <div class="col-12">
            <form method="post">
            <input type="text" name="tanggal" id="date" value='<?php echo $date ?>' style="display:none;" >
            <input type="text" name="jam" id="hour" value='<?php echo $hour ?>' style="display:none;" >
            </form>
              <form method="post" id="habis" action="index.php">
                <div class="row">
                  <div class="col-md-9 offset-md-9"><label for="timer" style="color:gray;">Batas Waktu : </label> <input  type="text" name="timer" id="waktu" value="" readonly="true" style="width:20%;text-align:center;color:gray;"></div>
                </div>
        </div>

<script src="js/sticky.js"></script>

<div class="container mt-3 shadow-sm" style="background-color:#FFFFFF;">   
    <div class="row">
        <div class="col-12 mx-auto mt-5">
            <h6 style="font-size:20pt;color:orange;">E-VOTING CALON KETUA & WAKIL KETUA .............................</h3>
            <hr>
        </div>
    </div>


<?php


echo'
<div class="container mx-auto">
  <div class="row">
  <div class="col-12">
  <div class="tambahCalon">
    <a href="edit.php?&aksi=tambah" class="btn btn-none mb-5 rounded-pill" style="border-color:#7FE9DE;"><i class="bi bi-plus"></i> tambah calon</a>
    </div>
    </div>';
for($k=1;$k<=$jmlhcalon;$k++){
  $sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$k'");
  $query=mysqli_fetch_array($sql);

  //echo $query['misi'];
$text = $query['misi'];
$misi = explode("\n", $text);


    // echo $baris_misi. "<br>";

  /*$visi = $sql['visi'][$k];
  $visi = $sql['misi'][$k];
  $query = mysqli_query($konn,"SELECT * FROM calon WHERE visi='$visi', misi='$misi'");*/
echo'

    <div class="col-4">
      <div class="card bg-info" style="width: 22rem;">
          <h5 class="card-header" style="color:white;">No.'.$k.'</h5>
          <img src="../images/'.$query['foto'].'" class="card-img-top" alt="...">
        <div class="card-body bg-light">
          <p class="card-text" style="text-align:justify;color:green;font-weight:bold;">VISI :<br>'.$query['visi'].'</p>
          <p class="card-text" style="text-align:left;color:blue;font-weight:bold;">Misi :<br>';foreach ($misi as $baris_misi) 
          {
            echo $baris_misi.'<br>';
          }
          echo '</p>
        </div>
        <div class="card-footer">
        <h6 style="text-align:center;color:white">'.$query['nama'].'</h6>
        </div>
        </div>
        <table>
        <tr>
        <td>
        <a href="edit.php?nomor='.$k.'&aksi=edit" class="btn btn-success"><i class="bi bi-pencil"></i></a>
        <a href="edit.php?nomor='.$k.'&aksi=hapus" class="btn btn-warning"><i class="bi bi-archive"></i></a>
        </td>
        </tr>
        </table>
    
  </div>';
}?>
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


  console.log(hour);
 
  if(selisih <=0){
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
<?php
  }else{
    echo '<script type ="text/JavaScript">';  
      echo 'alert("KAMU HARUS LOGIN !")';  
      echo '</script>';  
  }
  ?>