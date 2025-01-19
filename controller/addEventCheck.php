<?php
session_start();
require_once('../model/eventModel.php');
if(!isset($_SESSION['admin']))
{
    header("location: login.php");
}

$adminId = $_REQUEST['adminId'];
$eventName = $_REQUEST['eventName'];
$eventVenue = $_REQUEST['eventVenue'];
$eventDate = $_REQUEST['eventDate'];
$eventTime = $_REQUEST['eventTime'];
$eventOrganizer = $_REQUEST['eventOrganizer'];

if (eventAdd($adminId, $eventName, $eventVenue, $eventDate, $eventTime, $eventOrganizer)) {
    header("location: ../view/addEvent.php");
} else {
    echo "Error: Unable to add event.";
}
?>
