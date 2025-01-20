<?php
// Assume $loans array is fetched from a database in the parent page
// Example array structure:
$loans = [
    [
        'loan_name' => 'Student Loan A',
        'description' => 'A great loan for students pursuing higher education.',
        'interest_rate' => 5,
        'max_tenure' => 10,
    ],
    [
        'loan_name' => 'Student Loan B',
        'description' => 'Low-interest loan for postgraduate courses.',
        'interest_rate' => 4.5,
        'max_tenure' => 7,
    ],
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Aid Advice</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <div class="container">
            <ul class="nav-links">
                <li><a href="../view/home.php" id="logo">StudyCompass</a></li>
                <li><a href="../view/home.php">Home</a></li>
                <li><a href="#">Scholarships</a></li>
                <li><a href="#">Visa Updates</a></li>
                <li><a href="#">Rankings</a></li>
                <li><a href="../view/userDashboard.php" id="btnReg">Dashboard</a></li>
            </ul>
        </div>
    </nav>

    <!-- Financial Aid Advice Section -->
    <section class="financial-aid-advice">
        <h1 style="text-align: center; color: #023e8a;">Financial Aid Advice</h1>
        <div class="financial-aid-container">
            <h2>Available Loans</h2>
            <ul>
                <?php foreach ($loans as $loan): ?>
                    <li>
                        <h3><?= htmlspecialchars($loan['loan_name']) ?></h3>
                        <p><?= htmlspecialchars($loan['description']) ?></p>
                        <p><strong>Interest Rate:</strong> <?= htmlspecialchars($loan['interest_rate']) ?>%</p>
                        <p><strong>Max Tenure:</strong> <?= htmlspecialchars($loan['max_tenure']) ?> years</p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>
</body>

</html>
