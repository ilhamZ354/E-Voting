<?php
session_start();
if(isset($_SESSION['login'])){
$id=$_SESSION['userId'];

include("../koneksi.php");
$query=mysqli_query($konn,"SELECT * FROM calon");
$jmlh=mysqli_num_rows($query);

for($k=1;$k<=$jmlh;$k++){
    $query=mysqli_query($konn,"SELECT * FROM users WHERE pilihan='$k' ");
    $total=mysqli_num_rows($query);

    $query2=mysqli_query($konn,"UPDATE calon SET  total='$total' WHERE nomor='$k' ");

}
$total  = mysqli_query($konn, "SELECT total FROM calon order by nomor asc");
$no = mysqli_query($konn, "SELECT nomor FROM calon order by nomor asc");

//Query data voter
$sql = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user'");
$jmlhVoter = mysqli_num_rows($sql);

$sql2 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' AND pilihan!='0' ");
$telahvoter = mysqli_num_rows($sql2);

$sql5 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' AND pilihan='0' ");
$golput = mysqli_num_rows($sql5);

$sql3 = mysqli_query($konn,"SELECT * FROM calon ");
$jmlhcalon = mysqli_num_rows($sql3);

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

//perhitungan persentase


?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- <meta http-equiv='refresh' content='5'> -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/swipe.js" defer></script>
    <script src="js/sticky.js"></script>
    <style>
      .datalist{
        font-family: "Anek Devanagari", sans-serif;
        font-size: 1.2vw;
        color: #212A3E;
        font-weight:bold;
        display:flex;
      }
      .datalist li{
        margin:5%;
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
  <li ><a  href="/E-Vote/user/index.php">Dashboard</a></li>
  <li><a class="active" href="/E-Vote/user/grafik.php">Grafik</a></li>
  <li style="float:center"><a href="/E-Vote/user/profil.php">Profil</a></li>
  <li style="float:right;"><a class="logout" href="../logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
</ul>
</div>

<script src="js/sticky.js"></script>
<?php
echo '

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Chartjs, PHP dan MySQL Demo Grafik Batang</title>
    <script src="js/Chart.js"></script>
    <style type="text/css">
            .container {
                width: 100%;
                margin:2%;
            }
    </style>
  </head>
  <body>

      <div class="row">
        <div class="col-12">
            <form method="post">
            <input type="text" name="tanggal" id="date" value='.$date.' style="display:none;" >
            <input type="text" name="jam" id="hour" value='.$hour.' style="display:none;" >
            </form>
              <form method="post" id="habis" action="index.php">
                <div class="row">
                  <div class="col-md-9 offset-md-9"><label for="timer" style="color:gray;">Batas Waktu : </label> <input  type="text" name="timer" id="waktu" value="" readonly="true" style="width:20%;text-align:center;color:gray;"></div>
                </div>
        </div>

        
        <div class="col-4 mt-2">
          <div class="container shadow-sm p-3 mb-2 rounded" style="background-color:#FFFFFF;width:100%;">
          <div class="grafik" style="aign-items:center;">
          <h4 style="text-align:center; color:#434242;">Grafik Perhitungan Vote Sementara</h4>
            <canvas id="donutchart" width="50%" height="auto"></canvas>

            <ul class="datalist mt-3">';
            $sql4 = mysqli_query($konn,"SELECT * FROM users WHERE hak_akses='user' AND pilihan>='0' ");
            if($sql4){
              for($k=1;$k<=$jmlh;$k++){
                $query3=mysqli_query($konn, "SELECT * FROM users WHERE hak_akses='user' AND pilihan='$k'");
                $totalvote=mysqli_num_rows($query3);
                // echo $total'<br>';
                //perhitungan persentase
                $persentase = ($totalvote*100)/$jmlhVoter;
                echo '<br><li>Nomor Urut '.$k.' <div style="color:red;font-size:2vw;">'.floor($persentase).'%</div></li>';
                }
            }
              echo'
            </ul>
          </div>
        </div>
        </div>

        <div class="col-8 mt-3">
          <div class="card shadow-sm p-3 mb-2 rounded">
            <div class="card-body">
                
                  <div class="row">

                    <div class="col-6">
                    <div class="container shadow-sm mb-2 rounded">
                      <div class="row">
                        <div class="col-2 container shadow-sm mb-2 rounded" style="background-color:#F7D060">
                              <i class="bi bi-person-check" style="font-size:2.5vw;color:white"></i>
                            </div>
                            <div class="col-6">
                              <h5 class="mt-2" style="color:#F7D060">Total Vote</h5>
                              <h6 style="color:gray">'.$telahvoter.' Suara</h6>
                            </div>
                      </div>
                      </div>
                    </div>

                    
                    <div class="col-6">
                    <div class="container shadow-sm mb-2 rounded">
                      <div class="row">
                        <div class="col-2 container shadow-sm mb-2 rounded" style="background-color:#EC7272">
                              <i class="bi bi-person-dash" style="font-size:2.5vw;color:white"></i>
                            </div>
                            <div class="col-6">
                              <h5 class="mt-2" style="color:#EC7272">Tanpa Vote</h5>
                              <h6 style="color:gray">'.$golput.' Mahasiswa</h6>
                            </div>
                      </div>
                      </div>
                    </div>
              
              
              <div class="col-11 mx-auto">
                <div class="container">
                  <div class="wrapper">
                  <i id="left" class="bi bi-arrow-left-circle-fill" style="color:gray;"></i>
                    <ul class="carousel">';
                      
                      for($k=1;$k<=$jmlhcalon;$k++){
                      $sql = mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$k'");
                      $query=mysqli_fetch_array($sql);
                      
                      echo '
                      <li class="card">
                        <h3 class="card-header" style="background-color:#FFFFFF;border-color:#ffffff;color:#E94560">Nomor '.$k.'</h3>
                          <div class="img"><img src="../images/'.$query['foto'].'" alt="img" draggable="false"></div>
                        <div class="card-footer m-3 bg-info">
                        <h5 style="color:white;text-align:center;">'.$query['nama'].'</h5>
                        </div>
                      </li>';
                      }
                      echo '

                    </ul>
                      <i id="right" class="bi bi-arrow-right-circle-fill" style="color:gray;"></i>
                    </div>
                </div>
              </div>
              
                  </div>
                </div>
            </div>
          </div>
        </div>
        </div>

      </div>';?>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  </body>
</html>

<script  type="text/javascript">
  var ctx = document.getElementById("donutchart").getContext("2d");
  var datavote = {
            labels: [<?php while ($p = mysqli_fetch_array($no )) 
            { 
              echo '"Nomor Urut ' . $p['nomor'] . '",';}?>],
            datasets: [
            {
              label: "Total Vote",
              data: [<?php while ($p = mysqli_fetch_assoc($total)) { echo '"' . $p['total'] . '",';}?>],
              backgroundColor: [
                '#F97B22',
                '#2A2F4F',
                '#29B0D0',
                '#2A516E',],
              borderWitdh:10,
            }
            ]
            };

  var myBarChart = new Chart(ctx, {
            type: 'doughnut',
            data: datavote,
            options: {
              borderWidth:5, borderRadius:5,
              hoverBorderWidth: 0,
              
            legend: {
              display: false
            },
  
          }
        });

//timer

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