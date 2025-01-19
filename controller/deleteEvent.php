<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once('../model/eventModel.php');

if (isset($_GET['eventName'])) {
    $eventName = $_GET['eventName'];
    
    $status = eventDelete($eventName);
    if ($status) {
        echo "Event Deleted Successfully!";
        header('location: ../view/manageEvents.php'); 
    } else {
        echo "Failed to Delete Event.";
    }
} else {
    echo "Invalid Request!";
    header('location: ../view/manageEvents.php');
}
?>
