<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit();
}
require_once('../model/eventModel.php');

if (isset($_GET['eventName'])) {
    $eventName= $_GET['eventName'];
    $event = eventGet($eventName);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Event</title>
</head>
<body>
    <h1>Edit Author</h1>

    <form action="../controller/updateEventCheck.php" method="POST" onsubmit="return validateForm()">
        <!-- Hidden field for author ID -->
        <input type="hidden" name="adminId" value="<?php echo htmlspecialchars($event['adminId']); ?>">
        
        <table>
            <tr>
                <td>Event Name:</td>
                <td><input type="text" id="name" name="eventName" value="<?php echo htmlspecialchars($event['eventName']);?>"></td>
            </tr>
            <tr>
                <td>Event Venue:</td>
                <td><input type="text" id="venue" name="eventVenue" value="<?php echo htmlspecialchars($event['eventVenue']);?>"></td>
            </tr>
            <tr>
                <td>Event Date:</td>
                <td><input type="date" id="date" name="eventDate" value="<?php echo htmlspecialchars($event['eventDate']);?>"></td>
            </tr>
            <tr>
                <td>Event Time:</td>
                <td><input type="time" id="time" name="eventTime" value="<?php echo htmlspecialchars($event['eventTime']);?>"></td>
            </tr>
            <tr>
                <td>Event Organizer:</td>
                <td><input type="text" id="organizer" name="eventOrganizer" value="<?php echo htmlspecialchars($event['eventOrganizer']);?>"></td>
            </tr>
            <tr>
                <td colspan="2">
                   <input type="submit" name="submit" value="submit">
                </td>
            </tr>
        </table>
        <a href="manageEvents.php" style="text-decoration: none;">Event List</a>
    </form>
    <script>
        function  validateForm()
        {
            let name= document.getElementById('name').value;
            let venue=document.getElementById('venue').value;
            let date=document.getElementById('date').value;
            let time= document.getElementById('time').value;
            let organizer= document.getElementById('organizer').value;
        //     if(true)
        // {
        //     alert(name+venue+date+time+organizer);
        //     return false;
        // }
            if(name.trim()=="" || venue.trim()==""|| data.trim()=="" || time.trim()==""||organizer.trim()=="")
            {
                alert("Insert all the fields Properly");
                return false;
            }
            else return true;
            
        }
    </script>

</body>
</html>
