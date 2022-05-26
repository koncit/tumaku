<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("location: login.php");
	}
	
	include("konek.php");
	
	if(isSet($_GET['id'])){
		$sql = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id='".$_GET['id']."';");
		$tugas = mysqli_fetch_array($sql);
		
		// untuk mencetak jenis tugas
		($tugas['jenis'] == 1) ? $jenis = "Individu" :	$jenis = "Kelompok";
		
	
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<title>Detail Tugas</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link href='aset/css/bootstrap.css' rel='stylesheet' type='text/css' />
</head>

<body>

<div class="container">
	
	<div class="row">
		<div class="col-md-2">
		<!-- kiri -->
		</div>
		<div class="col-md-8">
			<div class="page-header"><h2>Tugas <?php echo $jenis ?>: <small><?php echo $tugas['matakul']; ?></small></h2></div>
			
			<div class="panel panel-default">
  				<div class="panel-heading"><h4><?php echo $tugas['judul']; ?></h4></div>
  				<div class="panel-body">
   				 <?php echo $tugas['deskripsi']; ?>
  				</div>
  				<div class="panel-body">
  				<b class="label label-danger"><span class="glyphicon glyphicon-time"></span> Deadline: <?php echo date("j M Y", strtotime($tugas['deadline'])); ?></b>
  				</div>
  				<div class="panel-footer">
  					<form action="" method="POST">
  					<table width="100%">
  						<tr>
  							<td> 
  								<?php if($tugas['selesai'] == 1){ ?>
  									<label><input type="checkbox" name="status" value="1" checked="checked"/> sudah dikerjakan</label>
  								<?php } else { ?>
  									<label><input type="checkbox" name="status" value="1"/> sudah dikerjakan</label>
  								<?php } ?>
  							</td>
  							<td style="text-align:right"><input type="submit" class="btn btn-primary" value="Simpan & Kembali" name="update" title="Simpan perubahan status tugas dan kembali ke manu utama"/></td>
  						</tr>
  					</table>
  					</form>
  				</div>
			</div>
			
		</div>
		<div class="col-md-2">
		<!-- kanan -->
		</div>
	</div> <!-- end row -->
</div>
    
<?php 
// proses update status tugas

if(isSet($_POST['update'])){
	$sql = "UPDATE tugas SET selesai='".$_POST['status']."' WHERE id='".$_GET['id']."'";
	mysqli_query($koneksi, $sql);
	header("location: index.php");
}
?>

<script src="aset/js/jquery.min.js"></script>
<script src="aset/js/bootstrap.js"></script>

</body>
</html>
<?php } ?>
