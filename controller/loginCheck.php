<?php
session_start();
require_once('../model/authModel.php');

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and Password cannot be empty!";
        header('location: ../view/login.php');
        exit();
    } else {
        $admin = getAdmin($username);
        $user = getUser($username);

        if ($admin && $password === $admin['password']) {
            $_SESSION['admin'] = $username;
            setcookie('admin', 'true', time() + 10000, '/');
            header('location: ../view/adminDashboard.php');
            exit();
        } elseif ($user && $password === $user['password']) {
            $_SESSION['user'] = $username;
            setcookie('user', 'true', time() + 10000, '/');
            header('location: ../view/userDashboard.php');
            exit();
        } else {
            echo "Invalid Username or Password!";
            header("Refresh: 2; URL=../view/login.php");
            exit();
    
        }
    }
} else {
    header('location: ../view/login.php');
    exit();
}
