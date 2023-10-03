<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    $description = $_POST['description'];
    $max_vote = $_POST['max_vote'];

    // Sanitize and validate user inputs
    $description = htmlspecialchars($description, ENT_QUOTES, 'UTF-8');
    $max_vote = intval($max_vote); // Convert max_vote to an integer, assuming it's a numeric value

    // Validate the input
    if (empty($description) || $max_vote <= 0) {
        $_SESSION['error'] = 'Invalid input. Please fill out the form correctly.';
    } else {
        $sql = "SELECT * FROM positions ORDER BY priority DESC LIMIT 1";
        $query = $conn->query($sql);
        $row = $query->fetch_assoc();

        $priority = $row['priority'] + 1;

        $sql = "INSERT INTO positions (description, max_vote, priority) VALUES ('$description', '$max_vote', '$priority')";

        if ($conn->query($sql)) {
            $_SESSION['success'] = 'Position added successfully';
        } else {
            $_SESSION['error'] = $conn->error;
        }
    }
} else {
    $_SESSION['error'] = 'Fill up the add form first';
}

header('location: positions.php');
?>
