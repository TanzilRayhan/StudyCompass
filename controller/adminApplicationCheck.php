<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}

require_once('../model/applicationModel.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['application_number'])) {
    $application_number = $_POST['application_number'];
    $status = $_POST['status'];
    $response = $_POST['response'];

    // Update the application details in the database
    $conn = getConnection();
    $sql = "UPDATE user_applications SET status='{$status}', response='{$response}' WHERE application_number='{$application_number}'";

    if (mysqli_query($conn, $sql)) {
        // Redirect to the applications page with a success message
        header("Location: ../view/adminApplicationUpdate.php?status=success");
    } else {
        // Redirect with an error message
        header("Location: ../view/updateApplication.php?application_number={$application_number}&status=error");
    }
    exit();
}
?>
