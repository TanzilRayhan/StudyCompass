<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['application_number'])) {
    $application_number = $_GET['application_number'];

    require_once('../model/applicationModel.php');
    $application = getApplicationByNumber($application_number);

    if ($application) {
        $status = $application['status'];
        $response = $application['response'];
    } else {
        $error = 'Application not found';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Update Application Status</title>
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
            flex-direction: column;
            width: 300px;
            gap: 0.5rem;
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        textarea,
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

        .error {
            color: red;
            text-align: center;
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

        .back-button button:hover {
            background-color: #27374d;
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
    <h1>Update Application Status</h1>

    <?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST" action="../controller/adminApplicationCheck.php">
        <label for="application_number">Application Number</label>
        <input type="text" name="application_number" id="application_number" value="<?php echo htmlspecialchars($application_number); ?>" readonly>

        <label for="status">Status</label>
        <input type="text" name="status" id="status" value="<?php echo htmlspecialchars($status); ?>" required>

        <label for="response">Response</label>
        <textarea name="response" id="response" rows="4" required><?php echo htmlspecialchars($response); ?></textarea>

        <button type="submit">Update Application</button>
    </form>

    <div class="back-button">
        <button onclick="location.href='../view/adminApplicationUpdate.php'">Back </button>
    </div>
</body>

</html>
