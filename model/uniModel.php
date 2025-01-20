<?php
require_once('../model/database.php');

function getUniversity($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM universities WHERE id='{$id}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function getAllUniversities()
{
    $con = getConnection();
    $sql = "SELECT * FROM universities";
    $result = mysqli_query($con, $sql);

    $universities = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $universities[] = $row;
    }
    return $universities;
}

function getTotalUniversities()
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) AS total FROM universities";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

function addUniversity($name, $location, $major,  $website)
{
    $conn = getConnection();
    $sql = "INSERT INTO universities (name, location, major, website)  
            VALUES ('{$name}', '{$location}', '{$major}', '{$website}')";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function deleteUniversity($id)
{
    $conn = getConnection();
    $sql = "DELETE FROM universities WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function updateUniversity($id, $name, $location, $major,  $website)
{
    $conn = getConnection();
    $sql = "UPDATE universities 
            SET name='{$name}', location='{$location}', major='{$major}',  website='{$website}' 
            WHERE id='{$id}'";

    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function searchUniversities($name = '', $location = '') {
    $conn = getConnection();
    $sql = "SELECT * FROM universities WHERE 1=1";

    if (!empty($name)) {
        $sql .= " AND name LIKE '%" . mysqli_real_escape_string($conn, $name) . "%'";
    }
    if (!empty($location)) {
        $sql .= " AND location LIKE '%" . mysqli_real_escape_string($conn, $location) . "%'";
    }

    $result = mysqli_query($conn, $sql);

    $universities = [];
    if ($result) {
        $universities = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    return $universities;
}
function filterUniversities($filters = []) {
    $conn = getConnection();
    $sql = "SELECT * FROM universities WHERE 1=1";

    // Add filters dynamically based on available keys
    if (!empty($filters['name'])) {
        $sql .= " AND name LIKE '%" . mysqli_real_escape_string($conn, $filters['name']) . "%'";
    }
    if (!empty($filters['location'])) {
        $sql .= " AND location LIKE '%" . mysqli_real_escape_string($conn, $filters['location']) . "%'";
    }
    if (!empty($filters['major'])) {
        $sql .= " AND major LIKE '%" . mysqli_real_escape_string($conn, $filters['major']) . "%'";
    }
    if (!empty($filters['budget_min']) && !empty($filters['budget_max'])) {
        $sql .= " AND budget_range BETWEEN '" . mysqli_real_escape_string($conn, $filters['budget_min']) . "' 
                 AND '" . mysqli_real_escape_string($conn, $filters['budget_max']) . "'";
    }

    $result = mysqli_query($conn, $sql);

    $universities = [];
    if ($result) {
        $universities = mysqli_fetch_all($result, MYSQLI_ASSOC);
    } else {
        error_log("MySQL Error: " . mysqli_error($conn));
    }

    mysqli_close($conn);
    return $universities;
}


?>
