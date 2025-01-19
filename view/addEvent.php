<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
    <link rel="stylesheet" href="../assets/Dstyle.css">
</head>
<body>
    <div class="form-container">
        <form action="../controller/addEventCheck.php" method="post" onsubmit="return validationForm()">
            <div class="form-title">Add Event</div>
            
            <label for="id">Admin ID:</label>
            <input id="id" type="number" name="adminId" class="form-field">

            <label for="name">Event Name:</label>
            <input id="name" type="text" name="eventName" class="form-field">

            <label for="venue">Event Venue:</label>
            <input id="venue" type="text" name="eventVenue" class="form-field">

            <label for="date">Event Date:</label>
            <input id="date" type="date" name="eventDate" class="form-field">

            <label for="time">Event Time:</label>
            <input id="time" type="time" name="eventTime" class="form-field">

            <label for="organizer">Event Organizer:</label>
            <input id="organizer" type="text" name="eventOrganizer" class="form-field">

            <button type="submit" class="form-submit">Submit</button>
        </form>
        <a href="manageEvents.php" class="form-link">Event List</a>
    </div>

    <script>
        function validationForm() {
            let id = document.getElementById('id').value;
            let name = document.getElementById('name').value;
            let venue = document.getElementById('venue').value;
            let date = document.getElementById('date').value;
            let time = document.getElementById('time').value;
            let organizer = document.getElementById('organizer').value;
            let currentDate = new Date();
            let cdate = currentDate.toISOString().split('T')[0];

            if (date < cdate) {
                alert("Error: The event date cannot be earlier than the current date.");
                return false;
            }
            if (id.trim() === "" || name.trim() === "" || venue.trim() === "" || date.trim() === "" || time.trim() === "" || organizer.trim() === "") {
                alert("Insert all the fields properly");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
