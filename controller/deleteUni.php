<?php
session_start();
require_once('../model/uniModel.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $status = deleteUniversity($id);
    if ($status) {
        header('location: ../view/universitiesAdmin.php'); 
        exit();
    } else {
        echo "Failed to delete university.";
    }
} else {
    echo "Invalid Request!";
    header('location: ../view/home.php');
}
?>
