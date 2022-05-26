<!-- membuat session untuk berada dalam satu file di browser -->
<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Login Manajemen Tugas Kuliah</title>

    <!-- Bootstrap core CSS -->
    <link href="aset/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="aset/css/signin.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="aset/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="aset/js/ie10-viewport-bug-workaround.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <div class="container">

      <form action="" class="form-signin" role="form" method="POST">
        <!-- <h2 class="form-signin-heading" style="text-align:center"><strong>LOGIN KE MATUKU</strong></h2><br/> -->

        <div class="panel panel-primary">
  <div class="panel-heading"><strong><center><h3><strong> Login ke matuku </strong></h3></center></strong></div>
  <br/>
  <div class="panel-body">
        <input type="text" class="form-control" name="username" placeholder="Username" required autofocus>
<br/>
        <input type="password" class="form-control" name="password" placeholder="Password" required autofocus>   
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
        
        <?php
		if(isset($_POST['login'])){
		include("konek.php");
		// kalimat sql untuk cek user apakah sudah terdaftar atau belum
		$query_user = mysqli_query($koneksi, "SELECT * FROM pemakai WHERE username='".$_POST['username']."';") or die(mysqli_error($koneksi));
		$pemakai = mysqli_fetch_array($query_user);
		
			// cek username dan password dengan yang ada di database
			if(md5($_POST['password']) == $pemakai['password'] && $_POST['username'] == $pemakai['username']){
				// bikin session
				$_SESSION['login'] = $_POST['username'];
				header("location: index.php");
				echo "session telah dibuat";
			} else { ?>
				<div class="alert alert-info alert-dismissible" role="alert">
				<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<strong>Maaf:</strong> Kombinasi username dan password salah.
				</div>
			<?php
			}
		
		}
		?>
        
        <button class="btn btn-lg btn-primary btn-block"  type="submit" name="login">Login </span></button>
        </div>
        </div>

      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="aset/js/jquery.min.js"></script>
	<script src="aset/js/bootstrap.min.js"></script>
	<script src="aset/js/docs.min.js"></script>

    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
