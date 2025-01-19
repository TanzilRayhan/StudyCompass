<?php
session_start();
require_once('../model/authModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $status = deleteAdmin($id);
    if ($status) {
        echo "Admin Deleted Successfully!";
        header('location: ../view/adminDashboard.php'); 
        exit();
    } else {
        echo "Failed to Delete Admin.";
    }
} else {
    echo "Invalid Request!";
    header('location: ../view/home.php');
}
?>
