<?php
include("../koneksi.php");

$query=mysqli_query($konn,"SELECT * FROM waktu");
if($query){
    
    if(mysqli_num_rows($query)!=0){
        $sql=mysqli_fetch_assoc($query);
        $date =$sql['tanggal'];
        $time =$sql['jam'];
        //00:00:00
        $j = substr($time,0,2);
        $m = substr($time,3,2);
        $d = substr($time,6,2);

        // echo $date;
    }else{
        $date ="";
        $j ="00";
        $m ="00";
        $d ="00";
    }
}
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap.grid.min.css">
    <link rel="stylesheet" href="css/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
</head>
<body>
      
<!-- Modal -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">SETTING TIMER</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="content-wrapper">
    
    <section class="content">
    	<div class="col-md-12">
        <div class="box box-warning box-solid">
            
            
<table class='table table-bordered'>        

	     <tr><td colspan="5">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        
        <form method="post" id="timer" action="control.php">
        <label for="tanggal" class="form-label">TANGGAL BERAKHIR :</label>
        <input type="date" data-date="" class="form-control" data-date-format="yyyy-mm-dd" style="height: 30px;" value="<?php echo $date ?>" name="tanggal" id="tanggal">
        </td></tr>
        <script>
            const tanggal = document.getElementById('tanggal');
            // console.log(tanggal.value);
        </script>
	     
	    <!-- <tr><td>Set Timer </td><td colspan="3"><input type="time" step="1" class="form-control" name="keterangan" id="keterangan" placeholder="Keterangan" value="00:00:00" /></td></tr> -->
	    <tr>
	    	<td width='200' colspan="5">PUKUL :</td></tr>
	    	<td><input type="number" max="23" min="0" style=" width: 100px" class="form-control" name="jam" id="jam" placeholder="Jam" value="<?php echo $j ?>" /></td>
	    	<td>  : </td>
	    	<td><input type="number" max="59" min="0" style=" width: 100px" class="form-control" name="menit" id="menit" placeholder="Menit" value="<?php echo  $m ?>" /></td>
	    	<td>  : </td>
	    	<td><input type="number" max="59" min="0" style=" width: 100px" class="form-control" name="detik" id="detik" placeholder="Detik" value="<?php echo $d ?>" /></td>

	    </tr>
	    <tr>
      <td colspan="7">
        <button onclick="reset()" type="button" id="buton_reset" class="btn btn-danger">RESET</button> 
       
	    </td></tr>
	</table>
        </div>
    </div>
</section>
</div>
</div>
</form>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">BATAL</button>
         <button onclick=submit() id="set" type="submit" class="btn btn-primary" name="set">TETAPKAN</button>


<script src="js/jquery-1.11.2.min.js"></script>
<script>
function submit(){
    var tanggal = document.getElementById('tanggal');
    var jam = document.getElementById('jam');
    var menit = document.getElementById('menit');
    var detik = document.getElementById('detik');

    if(tanggal.value==""){
        alert("HARAP ISI TANGGAL TERLEBIH DAHULU");
    }else if(jam.value==0 && menit.value==0 && detik.value==0){
        alert("HARAP ISI SETTING WAKTU");
    }else if(jam.value>=23 && menit.value>=59 && detik.value>=59){
        alert("ANGKA YANG ANDA MASUKAN SALAH!")
    }else{
        document.getElementById("timer").submit()
    }
}

</script>
      </div>
    </div>
  </div>
</div>
</body>
</html>
