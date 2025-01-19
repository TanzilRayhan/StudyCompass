<?php
session_start();
require_once('../model/uniModel.php');

$con = getConnection();

$filterResults = [];
$errors = [];
$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$budget = isset($_POST['budget']) ? trim($_POST['budget']) : '';

if (isset($_POST['filter'])) {
    if (empty($name) && empty($location) && empty($budget)) {
        $errors[] = "Please provide at least one filter criterion.";
    }

    if (empty($errors)) {
        $sql = "SELECT * FROM universities"; 
        $result = mysqli_query($con, $sql);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                if (!empty($name) && strcasecmp($row['name'], $name) !== 0) {
                    continue; 
                }
                if (!empty($location) && strcasecmp($row['location'], $location) !== 0) {
                    continue; 
                }
                $filterResults[] = $row;
            }

            if (empty($filterResults)) {
                $errors[] = "No universities found for the given criteria.";
            }
        } else {
            $errors[] = "Error fetching data. Please try again.";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filter Universities</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
                <li><a href="../view/userDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <h1 style="text-align: center;">Filter Universities</h1>

        <div class="form-container">
            <form method="POST" action="" class="search-form">
                <input type="text" name="name" placeholder="Enter university name" value="<?= htmlspecialchars($name) ?>" class="search-input">
                <input type="text" name="location" placeholder="Enter location (e.g., UK)" value="<?= htmlspecialchars($location) ?>" class="search-input">
                <button type="submit" name="filter" class="btn btn-primary">Filter</button>
            </form>
        </div>

        <?php if (!empty($errors)) : ?>
            <div style="text-align: center; color: red;">
                <?php foreach ($errors as $error) : ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <table class="user-management">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Location</th>
                    <th>Major</th>
                    <th>Website</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($filterResults)) : ?>
                    <?php foreach ($filterResults as $university) : ?>
                        <tr>
                            <td><?= htmlspecialchars($university['id']); ?></td>
                            <td><?= htmlspecialchars($university['name']); ?></td>
                            <td><?= htmlspecialchars($university['location']); ?></td>
                            <td><?= htmlspecialchars($university['major']); ?></td>
                            <td><a href="<?= htmlspecialchars($university['website']); ?>" target="_blank">Visit Website</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php if (isset($_POST['filter']) && empty($errors)) : ?>
                        <tr>
                            <td colspan="6" style="text-align: center;">No universities found for the selected filters.</td>
                        </tr>
                    <?php endif; ?>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="btn-container" style="text-align: center; margin-top: 20px;">
            <button onclick="window.location.href='../view/userDashboard.php'" class="btn btn-secondary">Back</button>
        </div>
    </div>
</body>

</html>


