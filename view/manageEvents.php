<?php
require_once('../model/eventModel.php');

if (!isset($_COOKIE['admin'])) {
    header('Location: login.php');
    exit();
}

$events = alleventGet();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manage</title>
    <link rel="stylesheet" href="../assets/styles.css">

    <script>
        function ajaxSearch() {
            const keyword = document.getElementById('searchInput').value;
            const xhttp = new XMLHttpRequest();

            xhttp.open('GET', '../controller/eventSearch.php?keyword=' + keyword, true);
            xhttp.send();

            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById('searchResults').innerHTML = this.responseText;
                }
            }
        }
    </script>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="../view/universitiesUser.php">Universities</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/showEvents.php">Events</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/adminDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <div style="width: 80%; margin:auto ; padding: 20px">
        <h2>Search Events</h2>

        <input type="text" id="searchInput" placeholder="Search Events..." oninput="ajaxSearch()" />
        <a href="addEvent.php">Add New Event</a>

        <h2>Events List</h2>
        <table border="1" id="eventsTable">
            <thead>
                <tr>
                    <th>Admin Id</th>
                    <th>Event Name</th>
                    <th>Event Venue</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event Organizer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="searchResults">
                <?php
                foreach ($events as $event) {
                    echo "<tr>
                        <td>" . htmlspecialchars($event['adminId']) . "</td>
                        <td>" . htmlspecialchars($event['eventName']) . "</td>
                        <td>" . htmlspecialchars($event['eventVenue']) . "</td>
                        <td>" . htmlspecialchars($event['eventDate']) . "</td>
                        <td>" . htmlspecialchars($event['eventTime']) . "</td>
                        <td>" . htmlspecialchars($event['eventOrganizer']) . "</td>
                        <td>
                            <a href='editEvent.php?eventName=" . htmlspecialchars($event['eventName']) . "'>Edit</a> | 
                            <a href='../controller/deleteEvent.php?eventName=" . htmlspecialchars($event['eventName']) . "'>Delete</a>
                        </td>
                      </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>