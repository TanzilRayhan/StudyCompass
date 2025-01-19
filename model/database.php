<?php

function getConnection()
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'study_compass');
    if (!$conn) {
        die("Connection Failed!");
    }
    return $conn;
}
