<?php 

$query = mysqli_query($koneksi, "SELECT * FROM tugas;") or die("<b>Error: </b>" . mysqli_error($koneksi));
	
if(isset($_GET['sortir'])){
	if($_GET['sortir'] == "selesai"){
		$query = mysqli_query($koneksi, "SELECT * FROM tugas WHERE selesai='1';") or die("<b>Error: </b>" . mysqli_error($koneksi));
	}
	elseif($_GET['sortir'] == "belum"){
		$query = mysqli_query($koneksi, "SELECT * FROM tugas WHERE selesai='0';") or die("<b>Error: </b>" . mysqli_error($koneksi));
	}
	elseif($_GET['sortir'] == "h-1"){}
	elseif($_GET['sortir'] == "tidakdikerjakan"){
		
	}
	else{}
}


while($tugas=mysqli_fetch_array($query)){
	
	// hitung sisa hari
	$sekarang = time(); // or your date as well
    $deadline = strtotime($tugas['deadline']);
    $beda = $deadline - $sekarang;
    $sisa_hari = floor($beda/(60*60*24));

	if(($sisa_hari <= 0) && ($tugas['selesai'] == 0)){
		$bg = "alert alert-danger";
	} elseif ($tugas['selesai'] == 1) {
		$bg = "alert alert-success";
		if($sisa_hari < 0) $sisa_hari = 0;
	} elseif($sisa_hari == 1){
		$bg = "alert alert-warning";
	} else {
		$bg = "";
	}
	$no=1;
	echo "<tr class='$bg'>";
	
	
	echo "<td>".$tugas['matakul']."</td>";
	echo "<td>".$tugas['judul']."</td>";
	echo "<td>".date("j M Y", strtotime($tugas['deadline']))."</td>";    
	echo "<td>$sisa_hari Hari</td>"; // gunakan fungsi di sini
	echo "<td>
		<a href='detail.php?id=".$tugas['id']."' class='btn btn-xs btn-info' title='Lihat detail'><span class='glyphicon glyphicon-search'></span></a>
		<a href='edit.php?id=".$tugas['id']."' class='btn btn-xs btn-warning' title='Edit data'><span class='glyphicon glyphicon-edit'></span></a>
		<a href='hapus.php?id=".$tugas['id']."' class='btn btn-xs btn-danger' title='Hapus data'><span class='glyphicon glyphicon-trash'></span></a>
		</td>";
	echo "</tr>";

}
	
?>
