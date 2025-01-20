<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}
$username = $_SESSION['user'];

require_once('../model/scholarshipModel.php');

$scholarships = getAllScholarships();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scholarships</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 1rem;
            color: #023e8a;
        }

        form {
            display: flex;
            justify-content: center;
            margin: 1rem auto;
            gap: 0.5rem;
        }

        input[type="text"],
        button {
            padding: 0.5rem;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        button {
            background-color: #023e8a;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #27374d;
        }

        table {
            width: 90%;
            margin: 1rem auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th,
        td {
            padding: 0.8rem;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #023e8a;
            color: white;
            text-transform: uppercase;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover td {
            background-color: #f1f5ff;
        }

        a {
            color: #023e8a;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .back-button {
            display: flex;
            justify-content: center;
            margin: 1rem auto;
        }

        .back-button button {
            padding: 0.5rem 1rem;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
            </ul>
        </div>
    </nav>
    <h1>Scholarships</h1>

    <form id="searchForm" onsubmit="return false;">
        <input type="text" id="search" name="query" placeholder="Search for scholarships">
        <button type="button" onclick="searchScholarship()">Search</button>
        <button type="button" onclick="location.href='../view/filterScholarships.php'">Filter</button>
    </form>

    <table id="scholarshipTable">
        <tr>
            <th>Name</th>
            <th>University</th>
            <th>Country</th>
            <th>Budget</th>
            <th>Course</th>
            <th>Deadline</th>
            <th>Website</th>
            <th>Action</th>
        </tr>
        <?php if (!empty($scholarships)): ?>
            <?php foreach ($scholarships as $scholarship): ?>
                <tr>
                    <td><?php echo htmlspecialchars($scholarship['name']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['university_name']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['country']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['budget']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['course']); ?></td>
                    <td><?php echo htmlspecialchars($scholarship['deadline']); ?></td>
                    <td><a href="<?php echo htmlspecialchars($scholarship['scholarship_url']); ?>" target="_blank">Visit</a></td>
                    <td>
                        <form action="../controller/bookmarkCheck.php" method="POST" style="margin: 0;">
                            <input type="hidden" name="scholarship_id" value="<?php echo $scholarship['id']; ?>">
                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                            <button type="submit">Bookmark</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="8">No scholarships available.</td>
            </tr>
        <?php endif; ?>
    </table>

    <div class="back-button">
        <button onclick="location.href='../view/userDashboard.php'">Back</button>
    </div>

    <script>
        function searchScholarship() {
            const query = document.getElementById('search').value.trim();
            if (query === '') {
                alert('Please enter a scholarship name.');
                return;
            }

            const xhr = new XMLHttpRequest();
            xhr.open('POST', '../controller/searchScholarship.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (this.status === 200) {
                    const scholarships = JSON.parse(this.responseText);
                    const table = document.getElementById('scholarshipTable');
                    table.innerHTML = ` 
                        <tr>
                            <th>Name</th>
                            <th>University</th>
                            <th>Country</th>
                            <th>Budget</th>
                            <th>Course</th>
                            <th>Deadline</th>
                            <th>Website</th>
                            <th>Action</th>
                        </tr>
                    `;
                    if (scholarships.length > 0) {
                        scholarships.forEach(scholarship => {
                            const row = `
                                <tr>
                                    <td>${scholarship.name}</td>
                                    <td>${scholarship.university_name}</td>
                                    <td>${scholarship.country}</td>
                                    <td>${scholarship.budget}</td>
                                    <td>${scholarship.course}</td>
                                    <td>${scholarship.deadline}</td>
                                    <td><a href="${scholarship.scholarship_url}" target="_blank">Visit</a></td>
                                    <td>
                                        <form action="../controller/bookmarkCheck.php" method="POST" style="margin: 0;">
                                            <input type="hidden" name="scholarship_id" value="${scholarship.id}">
                                            <input type="hidden" name="username" value="<?php echo $username; ?>">
                                            <button type="submit">Bookmark</button>
                                        </form>
                                    </td>
                                </tr>
                            `;
                            table.innerHTML += row;
                        });
                    } else {
                        alert("No scholarships found");
                        window.location.href = '../view/userScholarships.php';
                    }
                }
            };
            xhr.send('query=' + encodeURIComponent(query));
        }
    </script>
</body>

</html>
