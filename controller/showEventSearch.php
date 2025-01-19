<?php
if(!isset($_COOKIE['user']))
{
    header("location: ../view/login.php");
}
require_once('../model/eventModel.php');

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $events = searchEvent($keyword);
    
    if (count($events) > 0) {
        echo json_encode($events);
    } else {
        // echo "<tr><td colspan='4'>No Event found.</td></tr>";
        echo null;
    }
}
?>