<?php

require_once('../model/applicationModel.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $application_number = $_POST['application_number'];

    $existingApplication = getApplicationByNumber($application_number);

    if ($existingApplication) {
        $status = $existingApplication['status'];
        $response = $existingApplication['response'];
        header("Location: ../view/userApplicationTracker.php?status=" . urlencode($status) . "&response=" . urlencode($response));
    } else {
        $username = $_SESSION['user']; 
        $result = addNewApplication($username, $application_number);
        
        if ($result) {
            
            header("Location: ../view/userApplicationTracker.php?new_application=true&status=Pending&response=" . urlencode('Your application is under review.'));
        } else {
            
            header("Location: ../view/userApplicationTracker.php?status=Error&response=" . urlencode('There was an error adding your application.'));
        }
    }
    exit();
}
?>
