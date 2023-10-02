<?php
	session_start();
	include 'includes/conn.php';

	//recaptcha
	$captcha = $_POST['g-recaptcha-response'];
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LcdTW4oAAAAAAhhAo2Fbn5yYBqkrXBMtyBLApoP&response=".$captcha);
	$decoded_response = json_decode($response, true);
	if(!$decoded_response['success']){
		$_SESSION['error'] = 'Invalid captcha. Please try again.';
		header('location: index.php');//if captcha not validate again ridirect to index page
		exit;
	}//end of recaptcha

	if(isset($_POST['login'])){
		$voter = $_POST['voter'];
		$password = $_POST['password'];

		$sql = "SELECT * FROM voters WHERE voters_id = '$voter'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'Invalid Credentials';
		}
		else{
			$row = $query->fetch_assoc();
			if(password_verify($password, $row['password'])){
				$_SESSION['voter'] = $row['id'];
			}
			else{
				$_SESSION['error'] = 'Invalid Credentials';
			}
		}
		
	}
	else{
		$_SESSION['error'] = 'Input voter credentials first';
	}

	header('location: index.php');

?>