<?php

require_once('../model/database.php');

function getApplicationByNumber($application_number)
{
    $conn = getConnection();
    $sql = "SELECT * FROM user_applications WHERE application_number='{$application_number}' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function addNewApplication($username, $application_number)
{
    $conn = getConnection();
    $status = 'Pending';
    $response = 'Your application is under review.';
    $sql = "INSERT INTO user_applications (username, application_number, status, response) 
            VALUES ('{$username}', '{$application_number}', '{$status}', '{$response}')";
    
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return false;
    }
}

function getApplicationStatus($application_number)
{
    $conn = getConnection();
    $sql = "SELECT status, response FROM user_applications WHERE application_number='{$application_number}' LIMIT 1";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}



function getAllApplications()
{
    // Create a connection to the database
    $conn = getConnection();

    // SQL query to select all applications
    $sql = "SELECT * FROM user_applications";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if there are any rows
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch all rows as an associative array
        return mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

    // Return false if no records are found
    return false;
}


?>
