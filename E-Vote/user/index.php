<?php
ob_start();
session_start();

if(isset($_SESSION['login'])){
    $id=$_SESSION['userId'];

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
    <meta http-equiv='refresh' content='5'>
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

 input[type=text]{
  border-radius:10px;
  border-style:none;
}
div.card{
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
  transition:all 400ms ease;
}
div .card:hover{
  transform:scale(1.02);
}

.down button{
  border-radius:10px;
  border-style:none;
  opacity: 0.3;
  color:black;
}
.down button:hover{
  border-radius:10px;
  border-style:none;
  background-color:black;
  color:white;
}
.main{
  border-radius:10px;
}
body{
  margin-bottom:0;
}
</style>
</head>
<?php
echo '
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
  <li ><a class="active" href="/E-Vote/user/index.php">Dashboard</a></li>
  <li><a href="/E-Vote/user/grafik.php">Grafik</a></li>
  <li style="float:center"><a href="/E-Vote/user/profil.php">Profil</a></li>
  <li style="float:right;"><a class="logout" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
</ul>
</div>

<form method="post">
    <input type="text" name="tanggal" id="date" value='.$date.' style="display:none;" >
    <input type="text" name="jam" id="hour" value='.$hour.' style="display:none;" >
  </form>

<form method="post" id="habis" action="index.php">
    <div class="row">
     <div class="col-md-9 offset-md-9"><label for="timer" style="color:gray;">Batas Waktu : </label> <input  type="text" name="timer" id="waktu" value="" readonly="true" style="width:20%;text-align:center;color:gray;"></div>
      </div>
</div>
</form>
';

$sql2 = mysqli_query($konn,"SELECT * FROM users WHERE userId='$id' ");
$status=mysqli_fetch_assoc($sql2);

echo'
<div id="informasi">';
if($status['status']=='open' & $status['pilihan']==0){

echo'
    <div class="row">
        <div class="col-12 mx-auto mt-2">
            <h6 style="font-size:20pt;color:orange;text-align:center;">CALON KETUA & WAKIL KETUA HMPS LISTRIK</h3>
        </div>
  
    </div>

<div class="container mx-auto mt-2">
<div class="main shadow p-3 mb-5 bg-body-tertiary rounded-start bg-light">
<div class="row">';
for($k=1;$k<=$jmlhcalon;$k++){
$sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$k'");
$query=mysqli_fetch_array($sql);
  //echo $query['misi'];
$text = $query['misi'];
$misi = explode("\n", $text);

/*$visi = $sql['visi'][$k];
$visi = $sql['misi'][$k];
$query = mysqli_query($konn,"SELECT * FROM calon WHERE visi='$visi', misi='$misi'");*/
echo'
  <div class="col-4 mx-auto">
    <div class="card" style="width: 100%;">
        <h5 class="card-header bg-info" style="color:white;">No.'.$k.'</h5>
        <img src="../images/'.$query['foto'].'" class="card-img-top" alt="...">
        <h6 class="card-footer bg-success" style="text-align:center;color:white">'.$query['nama'].'</h6>
      <div class="card-body bg-dark">
        <p class="card-text" style="text-align:center;color:white;font-weight:bold;">VISI :</p><p style="text-align:;color:cyan;">'.$query['visi'].'<span id="visi'.$k.'"> .... </span></p>
        <div id="misi'.$k.'" style="display:none">
        <p class="card-text" style="text-align:center;color:white;font-weight:bold;">MISI :</p><p style="text-align:left;color:cyan;">';foreach ($misi as $baris_misi) 
          {
            echo $baris_misi.'<br><br>';
          }
          echo '</p>
      </div>
      <div class="down">
      <button  type="button" id="btnView'.$k.'" value="'.$k.'" style="width:100%;">View More <i class="bi bi-chevron-compact-down"></i></button>
      </div>
      </div>
  
      <form method="post"> 
      <div class="card-footer bg-light">
      <input type="hidden" name="vote" value="'.$k.'">
      <button type="submit" name="submit" class="btn btn-success" style="width:100%;">Vote</button>
      </div>
      </div>
      </form>
</div>'
;
//WAKTU HABIS
if(isset($_POST['timer'])){
  $tgl = $_POST['timer'];
  
    $sql = mysqli_query($konn,"UPDATE users SET status='closed'");
    header("location:index.php");
    // echo '<script type="text/javascript"> location.reload() </script>';
    
  
  
}

if(isset($_POST['submit'])){

$query_calon=mysqli_query($konn,"SELECT * FROM calon");
$jmlh=mysqli_num_rows($query_calon);

for($k=1;$k<=$jmlh;$k++){
    $query=mysqli_query($konn,"SELECT * FROM users WHERE pilihan='$k' ");
    $total=mysqli_num_rows($query);

    $query2=mysqli_query($konn,"UPDATE calon SET  total='$total' WHERE nomor='$k' ");
    $vote=$_POST['vote'];
    $sql = mysqli_query($konn,"UPDATE users SET pilihan='$vote',status='closed' WHERE userId='$id' ");
    header("location:index.php");

}

}
}
}else if($status['status']=='closed' & $status['pilihan']!=0){
    echo'
    <div class="row mb-10">
        <div class="col-5 mx-auto">
          <div class="card shadow-sm">
          <div class="card-body mx-auto">
            <div class="col-6 mx-auto">
                <img src="../images/thanks.png" alt="thanks" style="width:100%;">
              </div>
            </div>
          <div class="card-footer">
              <h2 class="bg-light" style="color:gray;text-align:center;">TERIMA KASIH TELAH MEMILIH</h2>
          </div>
          </div> 
        </div>
    </div>';
}
else{
  echo'
    <div class="row mb-10">
        <div class="col-5 mx-auto">
          <div class="card shadow-sm">
          <div class="card-body mx-auto">
            <div class="col-6 mx-auto">
                <img src="../images/close.png" alt="thanks" style="width:100%;">
              </div>
            </div>
          <div class="card-footer">
              <h2 class="bg-light" style="color:gray;text-align:center;">MAAF VOTING TELAH BERAKHIR !</h2>
          </div>
          </div> 
        </div>
    </div>';
}
echo '
</div>
</div>
  </div>
</div>';?>

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
    window.location.href="index.php";
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
$sql2=mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='admin' ");
$row=mysqli_num_rows($sql2);

$total_query=mysqli_query($konn,"SELECT * FROM calon WHERE total!='0' ");
$tot=mysqli_num_rows($total_query);

// echo $total;

for($k=1;$k<=$row;$k++){
  $sql2=mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='admin' AND userId='$k' ");
  $status2=mysqli_fetch_assoc($sql2);

}

if($status2['status']=='closed' && $tot!==0){
?>
<script>
  info = document.getElementById('informasi');
  info.style.display="none";
</script>
<?php
echo'

    <div class="row">
    <div class="col-16 text-center mx-auto mt-5">
            <h1 style="color:green">SELAMAT KEPADA</h1>
        </div>
        </div>
        <div class="row">
        <div class="col-4 mx-auto">
            <p class="btn btn-success" style="width:100%;">PASANGAN CALON TERPILIH</p>
        </div>
       
    </div>'
    
    ;
$no=0;
$query_tot=mysqli_query($konn, "SELECT * FROM calon");
while($result=mysqli_fetch_array($query_tot)){
$total_vote[]=$result['total'];
$no++;

}
$maks=max($total_vote);
//echo $maks;

$query2=mysqli_query($konn,"SELECT * FROM calon WHERE total='$maks' ");
$sql=mysqli_fetch_array($query2);

if($maks==0){
  $nomor='';
}else{
  $nomor=$sql['nomor'];
}
echo '
<div class="container">
<div class="row">';

$sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$nomor'");
$query=mysqli_fetch_array($sql);

/*$visi = $sql['visi'][$k];
$visi = $sql['misi'][$k];
$query = mysqli_query($konn,"SELECT * FROM calon WHERE visi='$visi', misi='$misi'");*/
echo'

<div class="col-4 mx-auto">
  <div class="card" style="width: 100%;">
        <h5 class="card-header bg-info" style="color:white;">No.'.$k.'</h5>
        <img src="../images/'.$query['foto'].'" class="card-img-top" alt="...">
        <h6 class="card-footer bg-success" style="text-align:center;color:white">'.$query['nama'].'</h6>
      </div>

</div>';

}
?>
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
<?php
}else{
echo '<script type ="text/JavaScript">';  
      echo 'alert("KAMU HARUS LOGIN !")';  
      echo '</script>';  
}
?>

<script src="js/sticky.js"></script>
<script>
  for(let i=1; i<100; i++){
    
    const button = document.getElementById("btnView"+i+"");

    button.addEventListener('click', function() {
      var k=button.value;

    var visi = document.getElementById("visi"+k+"");
    var misi = document.getElementById("misi"+k+"");
     if (visi.style.display === "none") {
    visi.style.display = "inline";
    button.innerHTML = "View More <i class='bi bi-chevron-compact-down'></i>"; 
    misi.style.display = "none";
      } else{
    visi.style.display = "none";
    button.innerHTML = "Close <i class='bi bi-chevron-compact-up'></i>"; 
    misi.style.display = "inline";
      }

});
  }
</script>