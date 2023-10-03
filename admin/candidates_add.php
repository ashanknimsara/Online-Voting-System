<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $platform = $_POST['platform'];
    $filename = $_FILES['photo']['name'];
    $filetype = $_FILES['photo']['type'];

    // Define an array of allowed image file types
    $allowedTypes = array('image/jpeg', 'image/png', 'image/gif');

    if (!empty($filename) && in_array($filetype, $allowedTypes) && is_valid_image($_FILES['photo']['tmp_name'])) {
        move_uploaded_file($_FILES['photo']['tmp_name'], '../images/' . $filename);

        $sql = "INSERT INTO candidates (position_id, firstname, lastname, photo, platform) VALUES ('$position', '$firstname', '$lastname', '$filename', '$platform')";
        if ($conn->query($sql)) {
            $_SESSION['success'] = 'Candidate added successfully';
        } else {
            $_SESSION['error'] = $conn->error;
        }
    } else {
        $_SESSION['error'] = 'Invalid file type or not a valid image. Only JPEG, PNG, and GIF images are allowed.';
    }
} else {
    $_SESSION['error'] = 'Fill up the add form first';
}

header('location: candidates.php');

function is_valid_image($file_path)
{
    // Check if the file is a valid image using getimagesize
    $image_info = @getimagesize($file_path);

    return $image_info !== false;
}
?>
