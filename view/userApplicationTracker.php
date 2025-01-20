<?php
session_start();

if (!isset($_SESSION['user'])) {
    header('location: ../view/login.php');
    exit();
}

$username = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Tracker</title>
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

        .result {
            text-align: center;
            margin-top: 1rem;
        }

        .status {
            font-weight: bold;
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
                <li><a href="../view/userDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>
    <h1>Application Tracker</h1>

    <form method="POST" action="../controller/applicationCheck.php">
        <input type="text" name="application_number" placeholder="Enter Application Number" required>
        <button type="submit">Submit</button>
    </form>

    <?php if (isset($_GET['status']) && isset($_GET['response'])): ?>
        <div class="result">
            <p><span class="status">Status:</span> <?php echo htmlspecialchars($_GET['status']); ?></p>
            <p><span class="status">Response:</span> <?php echo htmlspecialchars($_GET['response']); ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['new_application']) && $_GET['new_application'] == 'true'): ?>
        <script>
            alert("New application has been added for tracking.");
        </script>
    <?php endif; ?>

    <div class="back-button">
        <button onclick="location.href='../view/userDashboard.php'">Back</button>
    </div>
</body>

</html>