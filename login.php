<?php
	
	include_once "koneksi.php";

	class usr{}
	
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	
	if ((empty($username)) || (empty($password))) { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Kolom tidak boleh kosong"; 
		die(json_encode($response));
	}
	
	$query = mysqli_query($con, "SELECT * FROM user WHERE username='$username' AND password='$password'");
	
	$row = mysqli_fetch_array($query);
	
	if (!empty($row)){
		if ($row['level']=="siswa") {

			$qry = mysqli_query($con, "SELECT * FROM siswa JOIN kelas ON siswa.kode_kelas = kelas.kode_kelas WHERE siswa.nis='$username'");
	
			$json = array();
	
			while($row = mysqli_fetch_assoc($qry)){
				$json[] = $row;
			}

			$response = new usr();
			$response->success = 1;
			$response->message = "Selamat datang ".$json[0]['nama_siswa'];
			$response->data = $json;
			die(json_encode($response));
		}
		
	} else { 
		$response = new usr();
		$response->success = 0;
		$response->message = "Username atau password salah";
		die(json_encode($response));
	}
	
	mysqli_close($con);

?>