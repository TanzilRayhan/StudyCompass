<?php
session_start();
if(!isset($_SESSION['admin'])) header("locaton: ../view/login.php");
require_once('../model/messagesModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $status = delete_message($id);
    if ($status) {
        echo "Notification Deleted Successfully!";
        header('location: ../view/contractShow.php'); 
        exit();
    } else {
        echo "Failed to Delete Notification.";
    }
} else {
    echo "Invalid Request!";
    header('location: ../view/home.php');
}
?>