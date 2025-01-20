<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}

require_once('../model/applicationModel.php');

// Fetch all applications from the database
$applications = getAllApplications();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Applications</title>
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
            width: 80%;
            margin: 2rem auto;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 0.8rem;
            text-align: center;
        }

        button {
            padding: 0.5rem;
            background-color: #023e8a;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #27374d;
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
                <li><a href="../view/universitiesUser.php">Universities</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/showEvents.php">Events</a></li>
                <li><a href="../view/newsArticles.php">News & Articles</a></li>
                <li><a href="../view/adminDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <h1>Admin - View Applications</h1>

    <table>
        <thead>
            <tr>
                <th>Application Number</th>
                <th>Username</th>
                <th>Status</th>
                <th>Response</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($applications): ?>
                <?php foreach ($applications as $application): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($application['application_number']); ?></td>
                        <td><?php echo htmlspecialchars($application['username']); ?></td>
                        <td><?php echo htmlspecialchars($application['status']); ?></td>
                        <td><?php echo htmlspecialchars($application['response']); ?></td>
                        <td>
                            <a href="updateApplication.php?application_number=<?php echo $application['application_number']; ?>">
                                <button>Update</button>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No applications found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div class="back-button">
        <button onclick="location.href='../view/adminDashboard.php'">Back</button>
    </div>
</body>

</html>