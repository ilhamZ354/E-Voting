<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-VOTING</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <style>
      
       input[type=text]{
        border-color:blue;
      }
    </style>
</head>
<body>

<div class="card container shadow-lg" style="width:25rem;margin-top:5%;margin-bottom:5%;">
  <div class="row justify-content-center">
      <div class="col-8">
        <img src="images/company_logo.png" alt="gambar" style="width:100%;height:auto;" class="gambar1">
        <P class="text-center">Company/Organization Logo</P>
      </div>
      <div class="blkg col-12">
        <div class="row">
          <div class="col-12 mt-2">
            <p class="judul text-center" style="font-size:32px;">E-VOTING</p>
          </div>
          <div class="col-12"></div>
            <p class="subjudul text-center" style="font-size:20px;" >CALON KETUA & WAKIL KETUA ......................................</p>
          </div>
          <div class="container col-11 align-items-center;">
            <form method="post" class="row g-3" action="cek-login.php">
              <div class="col-12">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text bg-info" id="basic-addon1"><i class="bi bi-person" style="color:white;font-size:15px;"></i></span>
                  </div>
                      <input type="text" style="border-color:#B9E0FF" class="form-control" id="username" name="username" placeholder="username">
                </div>
              </div>
          </div>
          <div class="container col-11 align-items-center;">
            <div class="row g-3">
            <div class="col-12">
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text bg-info" id="basic-addon1"><i class="bi bi-shield-lock" style="color:white;font-size:15px;"></i></span>
                </div>
                  <input type="password" style="border-color:#B9E0FF" class="form-control" id="pass" name="password" placeholder="password">
            </div>
          </div>
          </div>
          <div class="container coll-12">
            <?php
              if(isset($_GET['pesan'])){
              $pesan=$_GET['pesan'];?>
              <div class="warning" style="color:orange;font-size:12px;">DATA TIDAK DITEMUKAN!</div>
              <?php
                      }
              ?>
          </div>
          <div class="row mt-3 mb-3">
          <div class="col-12 align-items-center">
              <button type="submit" name ="login" class="btn btn-info" style="width:100%;margin-top:2%;">Login</button>
          </div>
          </div>

        </div>
      </div>
  </div>

</div>
    <!-- <div class="row">
    <div class="card container col-6 mx-auto mt-3" style="width:25rem">
      <div class="col-12 mx-auto" style="">      
        <img src="images/hmps_listrik.png" alt="gambar" style="width:100%;height:auto;" class="gambar1">
      </div>

      <div class="blkg">
      <div class="col-12 mx-auto mt-1" style="text-align: center; color:white; width:100%;">
        <h2>E-VOTING</h2>
      </div>
      <div class="col-12" style="text-align: center">
        <p style="font-weight:bold">CALON KETUA & WAKIL KETUA <br> HMPS TEKNIK LISTRIK 2023/2024</p>
      </div>
      <div class="col-12 mx-auto" style="margin-top:5%;margin-bottom:10%;">

<?php
if(isset($_GET['pesan'])){
    $pesan=$_GET['pesan'];?>
    <div class="warning" style="color:gray;font-size:1vw; text-align:center;">DATA TIDAK DITEMUKAN!</div>
<?php
  }
?>
  <form method="post" class="row g-3" action="cek-login.php">
  <div class="col-12">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
    <span class="input-group-text bg-success" id="basic-addon1"><i class="bi bi-person" style="color:white;font-size:15px;"></i></span>
        </div>
    <input type="text" style="border-color:#B9E0FF" class="form-control" id="username" name="username" placeholder="username">
  </div>
</div>

  <div class="col-12">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
    <span class="input-group-text bg-success" id="basic-addon1"><i class="bi bi-shield-lock" style="color:white;"></i></span>
        </div>
    <input type="password" style="border-color:#B9E0FF" class="form-control" id="pass" name="password" placeholder="password">
  </div>
</div>
  <div class="col-12">
    <button type="submit" name ="login" class="btn btn-success" style="width:100%;margin-top:2%;">Login</button>
  </div>
</div>
</form>

  </div>
</div>
</div>
</div> -->
</body>
</html>

