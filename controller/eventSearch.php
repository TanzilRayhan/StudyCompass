<?php
if(!isset($_COOKIE['admin']))
{
    header("location: ../view/login.php");
}
require_once('../model/eventModel.php');

if (isset($_GET['keyword'])) {
    $keyword = $_GET['keyword'];
    $events = searchEvent($keyword);
    
    if (count($events) > 0) {
        foreach ($events as $event) {
            echo "<tr>
                    <td>" . htmlspecialchars($event['adminId']) . "</td>
                        <td>" . htmlspecialchars($event['eventName']) . "</td>
                        <td>" . htmlspecialchars($event['eventVenue']) . "</td>
                        <td>" . htmlspecialchars($event['eventDate']) . "</td>
                        <td>" . htmlspecialchars($event['eventTime']) . "</td>
                        <td>" . htmlspecialchars($event['eventOrganizer']) . "</td>
                        <td>
                             <a href='../view/editEvent.php?id=" . $event['eventName'] . "'>Edit</a> | 
                            <a href='../controller/deleteEvent.php?id=" . $event['eventName'] . "' >Delete</a>
                        </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No Event found.</td></tr>";
    }
}
?>
