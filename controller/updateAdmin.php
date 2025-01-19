<?php
session_start();
require_once('../model/authModel.php');

if (isset($_REQUEST['submit'])) {
    $id = $_REQUEST['id']; 
    $name = trim($_REQUEST['name']);
    $email = trim($_REQUEST['email']);
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);

    if (empty($id) || empty($name) || empty($email) || empty($username) || empty($password)) {
        echo "All fields are required!";
    } else {        
        $status = updateAdmin($id, $name, $email, $username, $password);

        if ($status) {
            $_SESSION['success_message'] = "Admin updated successfully!";
            header('location: ../view/adminDashboard.php');
            exit();
        } else {
            $_SESSION['error_message'] = "Update failed. Try again.";
            header('location: ../view/editAdmin.php?id=' . $id);
            exit();
        }
    }
} else {
    header('location: ../view/home.php');
    exit();
}
