<?php
	session_start();
	if(!isset($_SESSION['login'])){
		header("location: login.php");
	}

	include("konek.php");
	$query_user = mysqli_query($koneksi, "SELECT * FROM pemakai WHERE username='".$_SESSION['login']."';") or die(mysqli_error($koneksi));
	$pemakai = mysqli_fetch_array($query_user);
	
?>
<!DOCTYPE html>
<html lang="id">
<head>
	<title>Manajemen Tugas Kuliah</title>
	<meta name='viewport' content='width=device-width, initial-scale=1'>
	<link href='aset/css/bootstrap.css' rel='stylesheet' type='text/css' />
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"><strong>Kumpulan Kode</strong></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home <span class="sr-only">(current)</span></a></li>
       
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search"> &nbsp;
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form> 
       
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br>
<br>
<br>
<div class="container ">
	<header>
	<h1><strong>Manajemen Tugas Kuliah</strong></h1>
	
	<hr>
	</header>
	
	<div class="row">
		<div class="col-md-8">
			<nav>
			<a href='#tambah' class='btn btn-primary' data-toggle="modal" data-target="#tambah"><span class='glyphicon glyphicon-plus'></span> Tambah Tugas</a>&nbsp;
			
			
			<!-- drop down untuk sortir data -->
			<div class="btn-group">
			<button type="button" class="btn btn-success"><span class="glyphicon glyphicon-search"></span> Tampilkan Tugas</button>
			<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
			<span class="caret"></span>
			<span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul class="dropdown-menu" role="menu">
			
			
			<li role="presentation"><a role="menuitem" tabindex="-1" href="index.php"> <span class="glyphicon glyphicon-info-sign"></span> Semua Tugas</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="?sortir=belum"> <span class="glyphicon glyphicon-remove"></span> Belum Selesai</a></li>
			<li role="presentation"><a role="menuitem" tabindex="-1" href="?sortir=selesai"> <span class="glyphicon glyphicon-ok-sign"></span> Sudah Selesai</a></li>

			
			</ul>
			</div>
			
			&nbsp;
			<a class="btn btn-info" href="logout.php"> Logout (<?php echo $_SESSION['login'] ?>)</a>
			
			</nav>
		</div>
		<div class="col-md-4" style="padding-top: 0px">
		<!-- tombol untuk logout user -->
			<div class="btn-group">
			
				&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <b class="glyphicon glyphicon-calendar"></b> Tanggal sekarang : <?php echo date("j F Y"); ?>
			</div>
		
		</div>

	</div> <!-- end row -->
        <br><br>
	
	<div class="row">
		<div class="col-md-12">
			<table class="table table-striped">
                            <tr class="active"><th>Nama Mata Kuliah</th><th>Judul Tugas</th><th>Deadline</th><th>Waktu Tersisa</th><th>Tindakan</th></tr>	
			<?php include("tampil.php"); ?>
			</table>
		</div>
	</div><!-- end row -->
	
	<div class="row">
	<!-- di sini berisi modal form inputan -->

	<!-- Begin Modal #tambah -->
<div class="modal fade" id="tambah" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    
	  <form action="" method="POST" role="form">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><strong>Tambah Tugas Kuliah</strong></h4>
      </div>
	  
      <div class="modal-body">
        
		  <div class="form-group">
			  <label for="matakul">Mata Kuliah</label>
			  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Nama mata kuliah" name="matakul">
		  </div>
		  <div class="form-group">
			  <label for="judul">Judul</label>
			  <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Judul tugas" name="judul">
		  </div>
		  <div class="form-group">
		  	<label for="deskripsi">Deskripsi</label>
		  	<textarea class="form-control" rows="3" name="deskripsi" placeholder="Deskripsi tugas"></textarea>
		  </div>
		  <div class="form-group">
		  	<fieldset>
		  	<legend>Jenis Tugas</legend>
		  	<label><input type="radio" name="jenis" value="Individu" checked="cheked"/> Individu </label>
		  	<label><input type="radio" name="jenis" value="Kelompok" /> Kelompok</label>
		  	</fieldset>
		  </div>
		  <div class="form-group">
		  	<label for="deadline">Deadline</label>
		  	<input class="form-control" type="date" name="deadline" />
		  </div>      
	  </div>
        
		<div class="modal-footer">
		  <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <input type="submit" class="btn btn-primary" value="Simpan" name="simpan"/>
      </div>
	  </form>
	  
    </div> <!-- end modal content -->
  </div>
</div>
<!-- End Modal #tambah -->
		<div class="col-md-12">
			<?php include("simpan.php"); ?>
		</div>
	</div> <!-- end row -->
        <div class="footer">
            <hr/>
            <div style="text-align: right;"> &copy; 2020 <a href="#">Kumpulan Kode</a></div>
    </div>
</div>
    

<script src="aset/js/jquery.min.js"></script>
<script src="aset/js/bootstrap.js"></script>

</body>
</html>
