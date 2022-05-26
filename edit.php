<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("location: login.php");
	}
	
	include("konek.php");
	
	if(isSet($_GET['id'])){
		$id = $_GET['id'];
		$sql = mysqli_query($koneksi, "SELECT * FROM tugas WHERE id='".$_GET['id']."';");
		$data = mysqli_fetch_array($sql);
	
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<title>Edit Tugas</title>
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
		
		 <form action="" method="POST" role="form">
      <div class="modal-header">
          <h4 class="modal-title" id="myModalLabel"><strong>Edit Tugas Kuliah</strong></h4>
      </div>
	  
      <div class="modal-body">
        
		  <div class="form-group">
			  <label for="matakul">Mata Kuliah</label>
			  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama mata kuliah" name="matakul" value="<?php echo $data['matakul']; ?>">
		  </div>
		  <div class="form-group">
			  <label for="judul">Judul</label>
			  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul tugas" name="judul" value="<?php echo $data['judul']; ?>">
		  </div>
		  <div class="form-group">
		  	<label for="deskripsi">Deskripsi</label>
		  	<textarea class="form-control" rows="3" name="deskripsi" placeholder="deskripsi tugas"><?php echo $data['deskripsi']; ?></textarea>
		  </div>
		  <div class="form-group">
		  	<fieldset>
		  	<legend>Jenis Tugas</legend>
		  	<?php if($data['jenis'] == 0){ ?>
			  	<label><input type="radio" name="jenis" value="1" checked="cheked"/> Individu </label>
			  	<label><input type="radio" name="jenis" value="2"/> Kelompok</label>
		  	<?php } else { ?>
			  	<label><input type="radio" name="jenis" value="1"/> Individu </label>
			  	<label><input type="radio" name="jenis" value="2" checked="cheked"/> Kelompok</label>
		  	<?php } ?>
		  	
		  	</fieldset>
		  </div>
		  <div class="form-group">
		  	<label for="deadline">Deadline</label>
		  	<input class="form-control" type="date" name="deadline" value="<?php echo $data['deadline']; ?>"/>
		  	<br />
		  	<?php if($data['selesai'] == 1) { ?>
			  	<label for="status">Status: </label>
			  	<label><input type="checkbox" name="status" value="1" checked="checked"/><span> Sudah dikerjakan</span></label>
			<?php } else { ?>
				<label for="status">Status: </label>
			  	<label><input type="checkbox" name="status" value="1"/><span> Sudah dikerjakan</span></label>
			<?php } ?>
		  </div>      
	  </div>
        
		<div class="modal-footer">
		  <a href="index.php" class="btn btn-default" data-dismiss="modal">Batal</a>
          <input type="submit" class="btn btn-primary" value="Simpan" name="simpan"/>
      </div>
	  </form>
	  
    </div> <!-- end modal content -->
  </div>
</div>
<!-- End Modal #edit -->

		
		</div>
		<div class="col-md-2">
		<!-- kanan -->
		</div>
	</div> <!-- end row -->
</div>
    
<?php
// koding untuk update data di database
if(isSet($_POST['simpan'])){
	
	$sql = "UPDATE tugas SET
		matakul 	= '".$_POST['matakul']."',
		judul 		= '".$_POST['judul']."',
		deskripsi 	= '".$_POST['deskripsi']."',
		jenis 		= '".$_POST['jenis']."',
		deadline 	= '".$_POST['deadline']."',
		selesai 	= '".$_POST['status']."'
		WHERE id = ".$id.";
		" or die("<b>Error: </b>".mysqli_error($koneksi));
	
	$lengkap = !empty($_POST['matakul']) && !empty($_POST['judul']) && !empty($_POST['matakul']) && !empty($_POST['deadline']);
	
	// cek kelengkapan data sebelum menyimpan
	if($lengkap){	
		mysqli_query($koneksi, $sql);
		header("location: index.php");
	} else {
		echo "<div class='alert alert-warning' role='alert'><b><span class='glyphicon glyphicon-exclamation-sign'></span> Gagal Menyimpan:</b> <span >Data tidak lengkap, mohon untuk mengisi semua field dengan benar</span></div>";	
	}

}

?>    


<script src="aset/js/jquery.min.js"></script>
<script src="aset/js/bootstrap.js"></script>

</body>
</html>

<?php } ?>
