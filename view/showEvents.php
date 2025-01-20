<?php
require_once('../model/eventModel.php');

$events = alleventGet();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Manage</title>
    <link rel="stylesheet" href="../assets/styles.css">
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
            </ul>
        </div>
    </nav>
    <main style="width: 80%; margin:auto ; padding: 20px">
        <h2>Search Events</h2>
        <input type="text" id="searchInput" placeholder="Search Events..." oninput="ajaxSearch()" />
        <h2>Events List</h2>
        <table border="1" id="eventsTable">
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Event Venue</th>
                    <th>Event Date</th>
                    <th>Event Time</th>
                    <th>Event Organizer</th>
                </tr>
            </thead>
            <tbody id="searchResults">

            </tbody>
        </table>

        <br>
        <script>
            function ajaxSearch() {
                const keyword = document.getElementById('searchInput').value;
                const xhttp = new XMLHttpRequest();

                xhttp.open('GET', '../controller/showEventSearch.php?keyword=' + keyword, true);
                xhttp.send();

                xhttp.onreadystatechange = function() {
                    if (this.readyState === 4 && this.status === 200) {
                        if (this.responseText) {
                            let data = JSON.parse(this.responseText);
                            const tbody = document.getElementById('searchResults');
                            tbody.innerHTML = "";

                            data.forEach(event => {
                                const row = document.createElement('tr'); // <tr></tr>

                                row.innerHTML = `
                                <td>${event.eventName}</td>
                                <td>${event.eventVenue}</td>
                                <td>${event.eventDate}</td>
                                <td>${event.eventTime}</td>
                                <td>${event.eventOrganizer}</td>
                            `;

                                tbody.appendChild(row);
                            });
                        }
                    }
                }
            }
            ajaxSearch();
        </script>

    </main>

</body>

</html>