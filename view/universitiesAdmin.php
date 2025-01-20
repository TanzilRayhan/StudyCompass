 <?php
    session_start();
    if (!isset($_SESSION['admin'])) {
        header('location: ../view/login.php');
        exit();
    }
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
     <title>Admin - Manage Universities</title>
     <link rel="stylesheet" href="../assets/manageUniversities.css">
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
     <div class="btn-container">
         <a href="../view/addUniversity.php">Add University</a>
         <button onclick="window.location.href='adminDashboard.php'">Back</button>
     </div>

     <table>
         <thead>
             <tr>
                 <th>ID</th>
                 <th>Name</th>
                 <th>Location</th>
                 <th>Major</th>
                 <th>Website</th>
                 <th>Actions</th>
             </tr>
         </thead>
         <tbody>
             <?php if (!empty($universities)): ?>
                 <?php foreach ($universities as $university): ?>
                     <tr>
                         <td><?= htmlspecialchars($university['id']); ?></td>
                         <td><?= htmlspecialchars($university['name']); ?></td>
                         <td><?= htmlspecialchars($university['location']); ?></td>
                         <td><?= htmlspecialchars($university['major']); ?></td>
                         <td>
                             <a href="<?= htmlspecialchars($university['website']); ?>" target="_blank">Visit Website</a>
                         </td>
                         <td>
                             <a href="../view/editUni.php?id=<?= htmlspecialchars($university['id']); ?>">Edit</a>
                             <a href="../controller/deleteUni.php?id=<?= htmlspecialchars($university['id']); ?>">Delete</a>
                         </td>
                     </tr>
                 <?php endforeach; ?>
             <?php else: ?>
                 <tr>
                     <td colspan="6">No universities found.</td>
                 </tr>
             <?php endif; ?>
         </tbody>
     </table>
     </div>
 </body>

 </html>