<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}
require_once('../model/authModel.php');

if (isset($_REQUEST['submit'])) {
    $name = trim($_REQUEST['name']);
    $email = trim($_REQUEST['email']);
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);

    if (empty($name) || empty($email) || empty($username) || empty($password)) {
        echo "All fields are required!";
    } else {
        $status = addAdmin($name, $email, $username, $password);

        if ($status) {
            header('location: ../view/adminDashboard.php');
            exit();
        } else {
            echo "Registration failed. Try again.";
            header('location: ../view/adminRegister.php');
            exit();
        }
    }
} else {
    header('location: ../view/adminRegister.php');
    exit();
}
