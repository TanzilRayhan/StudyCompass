<?php

require_once('../model/database.php'); 


function addBookmark($username, $scholarship_id)
{
    $conn = getConnection();
    $sql = "INSERT INTO bookmarks (username, scholarship_id) 
            VALUES ('{$username}', '{$scholarship_id}')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return false;
    }
}


function getBookmarksByUsername($username) {
    $conn = getConnection();  
    
    $sql = "SELECT s.id, s.name, s.university_name, s.country, s.budget, s.course, s.deadline, s.scholarship_url
            FROM bookmarks b
            JOIN scholarships s ON b.scholarship_id = s.id
            WHERE b.username = '{$username}'";  
    
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        $bookmarks = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $bookmarks[] = $row;
        }
        return $bookmarks;
    }
    return false;
}

function removeBookmark($username, $scholarship_id)
{
    $conn = getConnection();
    $sql = "DELETE FROM bookmarks WHERE username='{$username}' AND scholarship_id='{$scholarship_id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
        return false;
    }
}

function isBookmarked($username, $scholarship_id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM bookmarks WHERE username='{$username}' AND scholarship_id='{$scholarship_id}'";
    
    $result = mysqli_query($conn, $sql);
    
    return mysqli_num_rows($result) > 0;
}

?>
