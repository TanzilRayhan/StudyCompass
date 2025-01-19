<?php

require_once('../model/database.php');

function adminLogin($username, $password)
{
  $conn = getConnection();
  $sql = "SELECT * FROM admins WHERE username='{$username}' and password='{$password}'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    return true;
  }
  return false;
}
function userLogin($username, $password)
{
  $conn = getConnection();
  $sql = "SELECT * FROM users WHERE username='{$username}' and password='{$password}'";
  $result = mysqli_query($conn, $sql);
  $count = mysqli_num_rows($result);

  if ($count == 1) {
    return true;
  }
  return false;
}

function getAdmin($username)
{
  $conn = getConnection();
  $sql = "SELECT * FROM admins WHERE username='{$username}'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }
  return false;
}

function getAllAdmin()
{
  $con = getConnection();
  $sql = "SELECT * FROM admins";
  $result = mysqli_query($con, $sql);

  $users = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }
  return $users;
}

function getUser($username)
{
  $conn = getConnection();
  $sql = "SELECT * FROM users WHERE username='{$username}'";
  $result = mysqli_query($conn, $sql);

  if ($result && mysqli_num_rows($result) == 1) {
    return mysqli_fetch_assoc($result);
  }
  return false;
}

function getAllUser()
{
  $con = getConnection();
  $sql = "SELECT * FROM users";
  $result = mysqli_query($con, $sql);

  $users = [];
  while ($row = mysqli_fetch_assoc($result)) {
    $users[] = $row;
  }
  return $users;
}

function addAdmin($name, $email, $username, $password)
{
  $conn = getConnection();
  $sql = "INSERT INTO admins (name, email, username, password) 
          VALUES ('{$name}', '{$email}', '{$username}', '{$password}')";
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    error_log("MySQL Error: " . mysqli_error($conn));
    return false;
  }
}

function addUser($name, $email, $username, $password, $age, $dob, $gender, $address)
{
  $conn = getConnection();
  $sql = "INSERT INTO users (name, email, username, password, age, dob, gender, address) 
          VALUES ('{$name}', '{$email}', '{$username}', '{$password}', {$age}, '{$dob}', '{$gender}', '{$address}')";
  if (mysqli_query($conn, $sql)) {
    return true;
  } else {
    error_log("MySQL Error: " . mysqli_error($conn));
    return false;
  }
}

function deleteAdmin($id)
{
    $conn = getConnection();
    $sql = "DELETE FROM admins WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function deleteUser($id)
{
    $conn = getConnection();
    $sql = "DELETE FROM users WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function updateAdmin($id, $name, $email, $username, $password)
{
    $conn = getConnection();
    $sql = "UPDATE admins SET name='{$name}',email='{$email}', username='{$username}', password='{$password}' WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function updateUser($id, $name, $email, $username, $password, $age, $dob, $gender, $address)
{
    $conn = getConnection();
    $sql = "UPDATE users SET name='{$name}',email='{$email}', username='{$username}', password='{$password}',age='{$age}', dob='{$dob}', gender='{$gender}', address='{$address}' WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getTotalUsers() {
  $conn = getConnection();
  $sql = "SELECT COUNT(*) AS total FROM users";
  $result = mysqli_query($conn, $sql);
  $data = mysqli_fetch_assoc($result);
  return $data['total'];
}