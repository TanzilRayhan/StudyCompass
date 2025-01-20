<?php
session_start();
require_once('../model/bookmarkModel.php');

// Check if the user is logged in and has a 'username' set in the session
if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}

// Retrieve username from the session
$username = $_SESSION['user'];

// Fetch all bookmarks for the user
$bookmarks = getBookmarksByUsername($username);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookmarks</title>
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

        table {
            width: 90%;
            margin: 1rem auto;
            border-collapse: collapse;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
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

        .back-button {
            display: flex;
            justify-content: center;
            margin: 1rem auto;
        }

        .back-button button {
            padding: 0.5rem 1rem;
            background-color: #023e8a;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button button:hover {
            background-color: #27374d;
        }

        .delete-button {
            background-color: #e74c3c;
            color: white;
            padding: 0.3rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .delete-button:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="../view/userScholarships.php">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
            </ul>
        </div>
    </nav>

    <h1>My Bookmarks</h1>

    <table>
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
    <?php if (!empty($bookmarks)): ?>
        <?php foreach ($bookmarks as $bookmark): ?>
            <tr>
                <td><?php echo htmlspecialchars($bookmark['name']); ?></td>
                <td><?php echo htmlspecialchars($bookmark['university_name']); ?></td>
                <td><?php echo htmlspecialchars($bookmark['country']); ?></td>
                <td><?php echo htmlspecialchars($bookmark['budget']); ?></td>
                <td><?php echo htmlspecialchars($bookmark['course']); ?></td>
                <td><?php echo htmlspecialchars($bookmark['deadline']); ?></td>
                <td><a href="<?php echo htmlspecialchars($bookmark['scholarship_url']); ?>" target="_blank">Visit</a></td>
                <td>
                    <a href="../controller/deleteBookmarkCheck.php?delete=<?php echo $bookmark['id']; ?>" class="delete-button" onclick="return confirm('Are you sure you want to delete this bookmark?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="8">No bookmarks found.</td>
        </tr>
    <?php endif; ?>
    </table>

    <div class="back-button">
        <button onclick="location.href='../view/userDashboard.php'">Back</button>
    </div>
</body>
</html>
