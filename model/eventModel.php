<?php
function getConn()
{
    $conn = mysqli_connect('127.0.0.1', 'root', '', 'study_compass');
    return $conn;
}


function eventAdd($adminId, $eventName,$eventVenue,$eventDate,$eventTime,$eventOrganizer)
{
    $conn = getConn();
    $sql = "INSERT INTO events (adminId, eventName,eventVenue,eventDate,eventTime,eventOrganizer) VALUES ('{$adminId}', '{$eventName}','{$eventVenue}','{$eventDate}','{$eventTime}','{$eventOrganizer}')";
    if (mysqli_query($conn, $sql))
        return true;
    else
        return mysqli_error($conn);
}

function eventDelete($eventName)
{
    $conn=getconn();
    $sql="DELETE from events WHERE eventName='{$eventName}'";
    if(mysqli_query($conn,$sql))
        return true;
    else 
        return false;
}

function eventUpdate($adminId, $eventName,$eventVenue,$eventDate,$eventTime,$eventOrganizer)
{
    $conn=getconn();
    $sql="UPDATE events 
            SET adminId = '$adminId',eventVenue = '$eventVenue', eventDate = '$eventDate', eventTime = '$eventTime', eventOrganizer = '$eventOrganizer' 
            WHERE eventName = '$eventName'";
    if(mysqli_query($conn,$sql))
        return true;
    else 
        return false;
}


function alleventGet()
{
    $conn = getconn();
    $sql = "SELECT * FROM events"; // Query to fetch all users
    $result = mysqli_query($conn, $sql);
    $events = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $events[] = $row; // Add each user to the users array
        }
        return $events;
    }

    // Return the list of users
}

function eventGet($eventName)
{
    $conn = getConn();
    $sql = "SELECT * FROM events WHERE eventName='{$eventName}'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}

function searchEvent($keyword)
{
    $conn = getConn();
    $sql = "SELECT * FROM events WHERE eventName LIKE '%$keyword%' OR eventVenue LIKE '%$keyword%' OR eventOrganizer LIKE '%$keyword%'";
    $result = $conn->query($sql);
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>
