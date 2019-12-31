<?php
	
	include_once "koneksi.php";

	class jadwal{}
	
	$kode_kelas = $_POST["kode_kelas"];

	$query = mysqli_query($con, "SELECT * FROM jadwal WHERE kode_kelas='$kode_kelas'");
	
	$row = mysqli_fetch_array($query);
	
	if (!empty($row)){
			
			$qry = mysqli_query($con, "SELECT * FROM jadwal JOIN kelas ON jadwal.kode_kelas = kelas.kode_kelas JOIN guru ON jadwal.kode_guru = guru.kode_guru JOIN hari ON jadwal.kode_hari = hari.kode_hari JOIN mata_pelajaran ON jadwal.kode_pelajaran = mata_pelajaran.kode_pelajaran WHERE jadwal.kode_kelas='$kode_kelas'");
	
			$json = array();
	
			while($row = mysqli_fetch_assoc($qry)){
				$json[] = $row;
			}

			$response = new jadwal();
			$response->success = 1;
			$response->jadwal = $json;
			die(json_encode($response));
	} else { 
		$response = new jadwal();
		$response->success = 0;
		$response->message = "Data Kosong";
		die(json_encode($response));
	}
	
	mysqli_close($con);

?>
