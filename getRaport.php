<?php
	
	include_once "koneksi.php";

	class raport{}
	
	$kode_siswa = $_POST["kode_siswa"];
	$semester = $_POST["semester"];

	$query = mysqli_query($con, "SELECT * FROM raport WHERE kode_siswa='$kode_siswa' AND semester = '$semester'");
	
	$row = mysqli_fetch_array($query);
	
	if (!empty($row)){
			
			$json = array();

			$qry = mysqli_query($con, "SELECT * FROM raport WHERE kode_siswa='$kode_siswa' AND semester = '$semester'");
			while($row = mysqli_fetch_assoc($qry)){
				$json[] = $row;
			}

			$response = new raport();
			$response->success = 1;
			$response->raport = $json;
			die(json_encode($response));
	} else { 
		$response = new raport();
		$response->success = 0;
		$response->message = "Data Kosong";
		die(json_encode($response));
	}
	
	mysqli_close($con);

?>
