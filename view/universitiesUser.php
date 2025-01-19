<?php
require_once('../model/uniModel.php');

$universities = getAllUniversities();

if ($universities === false) {
    echo "Error: Data not found.";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Universities - User View</title>
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
        <h1 style="text-align: center;">Search Universities</h1>

        <div class="form-container">
            <form method="POST" action="../controller/searchUni.php" class="search-form">
                <input type="text" id="name" name="name" placeholder="Enter university name">
                <button type="submit" name="search" id="btnSearch">Search</button>
                <button type="button" onclick="location.href='../controller/filter.php'">Filter</button>
            </form>
        </div>

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
                <?php if (!empty($universities)) : ?>
                    <?php foreach ($universities as $university) : ?>
                        <tr>
                            <td><?= htmlspecialchars($university['id']); ?></td>
                            <td><?= htmlspecialchars($university['name']); ?></td>
                            <td><?= htmlspecialchars($university['location']); ?></td>
                            <td><?= htmlspecialchars($university['major']); ?></td>
                            <td>
                                <a href="<?= htmlspecialchars($university['website']); ?>" target="_blank">Visit Website</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="5" style="text-align: center;">No universities found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="btn-container" style="text-align: center; margin-top: 20px;">
        <button onclick="window.location.href='userDashboard.php'" id="btnBack">Back</button>
    </div>
</body>

</html>
