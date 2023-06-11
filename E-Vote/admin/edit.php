<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT CALON</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <style>
        p{
            color:white;
            font-size:18pt;
        }
    </style>
</head>
<body >
    <div class="container shadow-sm p-2 bg-info"><h4 style="color:white;text-align:center;"> DATA CALON KETUA & WAKIL KETUA</h4></div>
</body>
</html>
<?php
include("../koneksi.php");
if(isset($_GET['nomor'])){
    $no = $_GET['nomor'];
   
    $sql2=mysqli_query($konn,"SELECT * FROM calon ");
    $row = mysqli_num_rows($sql2);

    $sql=mysqli_query($konn,"SELECT * FROM calon WHERE nomor='$no'");
    $query=mysqli_fetch_assoc($sql);
    $nama=$query['nama'];
    $visi=$query['visi'];
    $misi=$query['misi'];
    $gambar=$query['foto'];

if(isset($_GET['aksi'])){
    $aksi=$_GET['aksi'];
    
    if($aksi=='edit'){
    echo
    '<div class="container shadow-sm bg-light">
    <form method="post" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-2">
    <label for="nomor" class="form-label" >Nomor :</label>
    <input type="text" class="form-control" id="nama" name="nomor" value='.$no.' disabled>
  </div>
  <div class="col-md-12">
    <label for="nama" class="form-label" >Nama Calon Ketua & Wakil Ketua :</label>
    <input type="text" class="form-control" id="nama" name="nama" value=" '.$nama.'">
  </div>
  <div class="col-12">
    <label for="visi" class="form-label">Visi :</label>
    <input type="text" class="form-control" id="visi" name="visi" style="textarea:height:200px;" value="'.$visi.'">
  </div>
  <div class="col-12">
  <label for="Misi :" class="form-label">Misi :</label>
      <textarea class="form-control" id="Misi :" name="misi" rows="5" > '.$misi.'</textarea>
  </div>
  <div class="col-12">
  <label for="foto" class="form-label">Gambar :</label>
  <input type="file" class="form-control" id="foto" type="image" name="foto">
</div>
<div class="col-12">
    <button type="submit" name="cancel" class="btn btn-dark" style="width:100%;margin-top:2%;">batal</button>
  </div>
  <div class="col-12">
    <button type="submit" name ="submit" class="btn btn-primary" style="width:100%;margin-top:2%;">selesai</button>
  </div>
</form>
    </div>';
}elseif($aksi=='hapus' && $no>=$row){


    $sql=mysqli_query($konn,"DELETE FROM calon WHERE nomor='$no'");
    if($sql){
    header("location:index.php");
    }}elseif($aksi=='hapus' && $no<=$row){
      header("location:index.php");
    }
  
  }

}

else{
if(isset($_SESSION['pesan'])){
  $pesan=$_SESSION['pesan'];

  echo '
  <div class="row">
        <div class="col-10 mx-auto">
            <h2 class="bg-primary" style="color:white;text-align:center;">'.$pesan.'</h2>
        </div>
    </div>';
}
    echo
    '<div class="row container mt-3">
    <div class="col-8 mx-auto">
    <div class="btn btn-success">MASUKAN DATA</div>
    </div>
    </div>
    <div class="container shadow-sm bg-light mt-3">
    <form method="post" enctype="multipart/form-data" class="row g-3">
    <div class="col-md-2">
    <label for="nomor" class="form-label" >Nomor :</label>
    <input type="text" class="form-control" id="nomor" name="nomor">
  </div>
  <div class="col-md-12">
    <label for="nama" class="form-label" >Nama Calon Ketua & Wakil Ketua :</label>
    <input type="text" class="form-control" id="nama" name="nama">
  </div>
  <div class="col-12">
    <label for="visi" class="form-label">Visi :</label>
    <input type="text" class="form-control" id="visi" name="visi" >
  </div>
  <div class="col-12">
  <label for="Misi :" class="form-label">Misi :</label>
      <textarea class="form-control" id="Misi :" name="misi" rows="5"></textarea>
  </div>
    

  <div class="col-12">
  <label for="foto" class="form-label">Gambar :</label>
  <input type="file" class="form-control" id="foto" type="image" name="foto">
</div>
<div class="col-12">
    <button type="submit" name="cancel" class="btn btn-dark" style="width:100%;margin-top:2%;">batal</button>
  </div>
  <div class="col-12">
    <button type="submit" name="tambah" class="btn btn-primary" style="width:100%;margin-top:2%;">selesai</button>
  </div>
</form>
    </div>';
}
if(isset($_FILES['foto'])){
    $gambar = $_FILES['foto'];
    if($gambar['error']==false){
        move_uploaded_file(
            $gambar['tmp_name'], //lokasi sementara
            '../images/'.$gambar['name'] //nama foto
        );
    $foto=$gambar['name'];

if(isset($_POST['submit'])){
    if(isset($_GET['nomor'])){
        $no = $_GET['nomor'];
        $nama=$_POST['nama'];
        $visi=$_POST['visi'];
        $misi=$_POST['misi'];

        $sql=mysqli_query($konn,"UPDATE calon SET nama='$nama',visi='$visi',misi='$misi',foto='$foto'  WHERE nomor=$no ");

        if($sql){
            header('location:index.php');
        }else{
          echo 'gagal';
        }
    }
}
if(isset($_POST['tambah'])){
    $nomor=$_POST['nomor'];
    $nama=$_POST['nama'];
    $nama=$_POST['nama'];
    $visi=$_POST['visi'];
    $misi=$_POST['misi'];

    $sql=mysqli_query($konn,"SELECT * FROM calon");
    $jmlh = mysqli_num_rows($sql);
    $row=$jmlh+1;

    if($nomor!=$row){
      $_SESSION['pesan']='HARAP MASUKAN NOMOR URUT YANG BENAR!';
      header('location:edit.php');
    }else{
      $query = "INSERT INTO calon VALUE ('$nomor','$nama','$visi','$misi','$foto',total)";
      $hasil=$konn->query($query);
      if($hasil){
        header('location:index.php');
      }
    }
}
 

}
}
if(isset($_POST['cancel'])){
  header('location:index.php');
  die();
}
?>
