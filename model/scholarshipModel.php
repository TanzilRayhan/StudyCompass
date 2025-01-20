<?php

require_once('../model/database.php'); 

function addScholarship($name, $university_name, $scholarship_url, $country, $budget, $course, $deadline, $eligibility, $description)
{
    $conn = getConnection();
    $sql = "INSERT INTO scholarships (name, university_name, scholarship_url, country, budget, course, deadline, eligibility, description)
            VALUES ('{$name}', '{$university_name}', '{$scholarship_url}', '{$country}', {$budget}, '{$course}', '{$deadline}', '{$eligibility}', '{$description}')";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function getScholarship($id)
{
    $conn = getConnection();
    $sql = "SELECT * FROM scholarships WHERE id='{$id}'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function getAllScholarships()
{
    $conn = getConnection();
    $sql = "SELECT * FROM scholarships";
    $result = mysqli_query($conn, $sql);

    $scholarships = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $scholarships[] = $row;
    }
    return $scholarships;
}

function getTotalScholarship()
{
    $conn = getConnection();
    $sql = "SELECT COUNT(*) AS total FROM scholarships";
    $result = mysqli_query($conn, $sql);
    $data = mysqli_fetch_assoc($result);
    return $data['total'];
}

function updateScholarship($id, $name, $university_name, $scholarship_url, $country, $budget, $course, $deadline, $eligibility, $description)
{
    $conn = getConnection();
    $sql = "UPDATE scholarships 
            SET name='{$name}', university_name='{$university_name}', scholarship_url='{$scholarship_url}', country='{$country}', 
                budget={$budget}, course='{$course}', deadline='{$deadline}', eligibility='{$eligibility}', description='{$description}'
            WHERE id='{$id}'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        return false;
    }
}

function deleteScholarship($id)
{
    $conn = getConnection();
    $sql = "DELETE FROM scholarships WHERE id='{$id}'";
    if (mysqli_query($conn, $sql)) {
        return true;
    } else {
        
        return false;
    }
}

function searchScholarships($query) {
    $conn = getConnection(); // Assuming this function gives you a database connection
    $sql = "SELECT * FROM scholarships WHERE name LIKE ? OR university_name LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchTerm = "%$query%";
    $stmt->bind_param('ss', $searchTerm, $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}


function getDistinctValues($con, $column) {
    $values = [];
    $query = "SELECT DISTINCT $column FROM scholarships";
    $result = mysqli_query($con, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $values[] = $row[$column];
        }
    }
    return $values;
}



function filterScholarships($con, $name, $university_name, $country, $budget, $course, $deadline) {
    $query = "SELECT * FROM scholarships WHERE 1=1";
    
    if ($name) {
        $query .= " AND name LIKE '%$name%'";
    }
    if ($university_name) {
        $query .= " AND university_name LIKE '%$university_name%'";
    }
    if ($country) {
        $query .= " AND country LIKE '%$country%'";
    }
    if ($budget) {
        $query .= " AND budget LIKE '%$budget%'";
    }
    if ($course) {
        $query .= " AND course LIKE '%$course%'";
    }
    if ($deadline) {
        $query .= " AND deadline LIKE '%$deadline%'";
    }

    $result = mysqli_query($con, $query);

    if ($result) {
        $scholarships = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $scholarships;
    }
    return false;
}






?>
