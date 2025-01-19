<?php
session_start();
require_once('../model/authModel.php');

if (isset($_REQUEST['submit'])) {
    $name = trim($_REQUEST['name']);
    $email = trim($_REQUEST['email']);
    $username = trim($_REQUEST['username']);
    $password = trim($_REQUEST['password']);
    $age = trim($_REQUEST['age']);
    $dob = trim($_REQUEST['dob']);
    $gender = trim($_REQUEST['gender']);
    $address = trim($_REQUEST['address']);

    function validatePassword($password) {
        $hasNumber = false;
        $hasSpecialChar = false;
        $specialChars = '!@#$%^&*()-_=+{};:,<.>';

        if (strlen($password) < 6) {
            return false;
        }
        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];
            
            if ($char >= '0' && $char <= '9') {
                $hasNumber = true;
            }
            
            if (strpos($specialChars, $char) !== false) {
                $hasSpecialChar = true;
            }
        }

        return $hasNumber && $hasSpecialChar;
    }

    if (empty($name) || empty($email) || empty($username) || empty($password) || empty($age) || empty($dob) || empty($gender) || empty($address)) {
        echo "All fields are required!";

    } elseif (!validatePassword($password)) {
        echo "Password must be at least 6 characters long, include at least one special symbol and one number!";
    } else {
        $status = addUser($name, $email, $username, $password, $age, $dob, $gender, $address);

        if ($status) {
            header('location: ../view/login.php');
            exit();
        } else {
            echo "Registration failed. Try again.";
            header('location: ../view/register.php');
            exit();
        }
    } 
} else {
    header('location: ../view/register.php');
    exit();
}
?>
