<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['save'])){
		$curr_password = $_POST['curr_password'];
		$username = $_POST['username'];
		$email = $_POST['emsil'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$photo = $_FILES['photo']['name'];

		// Check if the new password meets the strong password policy
		if (strlen($password) < 8 || !preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[!@#$%^&*()\-_=+{};:,<.>]/', $password)) {
			$_SESSION['error'] = 'Password does not meet the strong password policy requirements. It should:';
			$_SESSION['error'] .= '<ul>';
			$_SESSION['error'] .= '<li>Be at least 8 characters long</li>';
			$_SESSION['error'] .= '<li>Contain at least one uppercase letter</li>';
			$_SESSION['error'] .= '<li>Contain at least one lowercase letter</li>';
			$_SESSION['error'] .= '<li>Contain at least one digit</li>';
			$_SESSION['error'] .= '<li>Contain at least one special character (e.g., !@#$%^&*()\-_=+{};:,<.>)</li>';
			$_SESSION['error'] .= '</ul>';
		} else if (password_verify($curr_password, $user['password'])){
			if(!empty($photo)){
				move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$photo);
				$filename = $photo;	
			}
			else{
				$filename = $user['photo'];
			}

			if($password == $user['password']){
				$password = $user['password'];
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
			}

			$sql = "UPDATE admin SET username = '$username', email = '$email', password = '$password', firstname = '$firstname', lastname = '$lastname', photo = '$filename' WHERE id = '".$user['id']."'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Admin profile updated successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
			
		}
		else{
			$_SESSION['error'] = 'Incorrect password';
		}
	}
	else{
		$_SESSION['error'] = 'Fill up required details first';
	}

	header('location:'.$return);

?>
