<?php
	
	include_once "koneksi.php";

	class absensi{}
	
	$kode_siswa = $_POST["kode_siswa"];
	$semester = $_POST["semester"];

	$query = mysqli_query($con, "SELECT * FROM absensi WHERE kode_siswa='$kode_siswa' AND semester='$semester'");
	
	$row = mysqli_fetch_array($query);
	
	if (!empty($row)){
			$qry = mysqli_query($con, "SELECT * FROM absensi WHERE kode_siswa='$kode_siswa' AND semester='$semester'");
	
			$data = mysqli_fetch_assoc($qry);
				

			$response = new absensi();
			$response->success = 1;
			$response->presence = $data['hadir'];
			$response->sick = $data['sakit'];
			$response->permit = $data['izin'];
			$response->absent = $data['tidak_masuk'];
			die(json_encode($response));
	} else { 
		$response = new absensi();
		$response->success = 0;
		$response->message = "Data Kosong";
		die(json_encode($response));
	}
	
	mysqli_close($con);

?>
