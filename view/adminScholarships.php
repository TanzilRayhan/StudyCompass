<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('location: ../view/login.php');
    exit();
}
require_once('../model/scholarshipModel.php');
$scholarships = getAllScholarships();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Scholarships</title>
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
        a {
            color: #023e8a;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
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
        button {
            background-color: #023e8a;
            color: white;
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        button:hover {
            background-color: #27374d;
        }
        .actions {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        form {
            display: inline;
        }
        .add-new {
            display: flex;
            justify-content: center;
            margin: 1rem auto;
        }
        .add-new a {
            background-color: #023e8a;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            text-decoration: none;
        }
        .add-new a:hover {
            background-color: #27374d;
        }
    </style>
    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this scholarship?");
        }
    </script>
</head>
<body>
    <h1>Manage Scholarships</h1>
    
    <div class="add-new">
        <a href="../view/addScholarship.php">Add New Scholarship</a>
    </div>
    
    <table>
        <tr>
            <th>Name</th>
            <th>University</th>
            <th>Country</th>
            <th>Budget</th>
            <th>Course</th>
            <th>Deadline</th>
            <th>Website</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($scholarships as $scholarship): ?>
        <tr>
            <td><?php echo htmlspecialchars($scholarship['name']); ?></td>
            <td><?php echo htmlspecialchars($scholarship['university_name']); ?></td>
            <td><?php echo htmlspecialchars($scholarship['country']); ?></td>
            <td><?php echo htmlspecialchars($scholarship['budget']); ?></td>
            <td><?php echo htmlspecialchars($scholarship['course']); ?></td>
            <td><?php echo htmlspecialchars($scholarship['deadline']); ?></td>
            <td><a href="<?php echo htmlspecialchars($scholarship['scholarship_url']); ?>" target="_blank">Visit</a></td>
            <td class="actions">
                <form action="editScholarship.php" method="get">
                    <input type="hidden" name="id" value="<?php echo $scholarship['id']; ?>">
                    <button type="submit">Edit</button>
                </form>
                <form action="../controller/deleteScholarshipCheck.php" method="post" onsubmit="return confirmDelete()">
                    <input type="hidden" name="id" value="<?php echo $scholarship['id']; ?>">
                    <button type="submit">Delete</button>
                </form>

            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <div style="text-align: center; margin: 1rem;">
        <button onclick="window.location.href='adminDashboard.php'">Back</button>
    </div>
</body>
</html>
