<?php
require_once('../model/eventModel.php');

// Check if the user is logged in as admin
if (!isset($_COOKIE['admin'])) {
    header('Location: ../view/login.php');
}


$adminId=$_REQUEST['adminId'];
$eventName=$_REQUEST['eventName'];
$eventVenue=$_REQUEST['eventVenue'];
$eventDate=$_REQUEST['eventDate'];
$eventTime=$_REQUEST['eventTime'];
$eventOrganizer=$_REQUEST['eventOrganizer'];

//echo $adminId. $eventName.$eventVenue.$eventDate.$eventTime.$eventOrganizer;
    // Validate data (though this can also be handled by JavaScript)
    // if ($name == "" || $contact_no == "" || $username == "" || $password == "") {
    //     echo "All fields are required";
    //     exit();
    // }

    if (eventUpdate($adminId, $eventName,$eventVenue,$eventDate,$eventTime,$eventOrganizer))
    {
       header("location: ../view/manageEvents.php");
    }
    else {
        echo "Error updating events.";
    }
?>
