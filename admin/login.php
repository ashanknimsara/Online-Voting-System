<?php
	
	include 'includes/conn.php';

	if(isset($_POST['login'])){

		//recaptcha
		// $captcha = $_POST['g-recaptcha-response'];
		// $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcdTW4oAAAAAAhhAo2Fbn5yYBqkrXBMtyBLApoP&response=".$captcha);
		// $decoded_response = json_decode($response, true);
		// if(!$decoded_response['success']){
		// 	$_SESSION['error'] = 'Invalid captcha. Please try again.';
		// 	header('location: index.php');
		// 	exit;
		// }
		//end of recaptcha
		
		$username = $_POST['username'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM admin WHERE username = '$username'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Invalid Credentials';
		}
		else{
			session_start();
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['admin'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Invalid Credentials';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input admin credentials first';
	}

	header('location: index.php');

?>