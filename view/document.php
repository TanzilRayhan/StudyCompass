<?php
session_start();
if (!isset($_SESSION['user'])) {
   header("location: login.php");
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Necessary Documents</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <link rel="stylesheet" href="../assets/Dstyle.css">
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
    <div class="container">
        <div class="fieldset">
            <h1>All Necessary Documents</h1>
            <div class="section">
                <h2>Academic Documents</h2>
                <p>
                    <b>Certified Copies of Academic Transcripts:</b> High school/college/university transcripts.<br>
                    <b>Degree Certificates/Diplomas:</b> Proof of completed education (e.g., bachelor's degree certificate for master's programs).<br>
                    <b>Statement of Marks:</b> Detailed breakdown of grades, if applicable.<br><br>
                </p>
            </div>
            <div class="section">
                <h2>Test Scores</h2>
                <p>
                    <b>Standardized Test Scores:</b> GRE/GMAT/SAT/ACT (as required by the program).<br>
                    <b>English Proficiency Test Scores:</b> IELTS/TOEFL/PTE/Duolingo (for non-native English speakers).<br><br>
                </p>
            </div>
            <div class="section">
                <h2>Application Documents</h2>
                <p>
                    <b>Application Form:</b> Completed application form for the university.<br>
                    <b>Statement of Purpose (SOP):</b> <a href="../assets/sop.pdf" download="sop.pdf">Download Template</a><br>
                    <b>Letters of Recommendation (LOR):</b> <a href="../assets/lor.pdf" download="lor.pdf">Download Template</a><br>
                    <b>Curriculum Vitae (CV)/Resume:</b> <a href="../assets/CV.pdf" download="CV.pdf">Download Template</a><br>
                    <b>Portfolio:</b> <a href="../assets/portfolio.pdf" download="portfolio.pdf">Download Template</a><br><br>
                </p>
            </div>
            <div class="section">
                <h2>Identification Documents</h2>
                <p>
                    <b>Passport:</b> Valid passport with a sufficient expiration date.<br>
                    <b>Photographs:</b> Passport-sized photographs as per the university's requirements.<br><br>
                </p>
            </div>
            <div class="section">
                <h2>Financial Documents</h2>
                <p>
                    <b>Proof of Funds:</b> Bank statements, sponsorship letters, or scholarship award letters to show financial capability.<br>
                    <b>Affidavit of Support:</b> <a href="../assets/Financial Affidavit.pdf" download="Financial Affidavit.pdf">Download Template</a><br><br>
                </p>
            </div>
            <div class="section">
                <h2>Additional Documents</h2>
                <p>
                    <b>Medical Records:</b> Health and vaccination records, if required.<br>
                    <b>Visa Documents:</b> University acceptance letter, SEVIS receipt (for the U.S.).<br>
                    <b>Application Fee Receipt:</b> Proof of payment for the application fee.<br><br>
                </p>
            </div>
            <div class="section">
                <h2>Optional Documents</h2>
                <p>
                    <b>Experience Letters:</b> For professionals or those applying to programs requiring work experience. <a href="../assets/Experience Letter.pdf" download="Experience Letter.pdf">Download Template</a><br>
                    <b>Research Proposal:</b> For research-oriented programs (Ph.D., MRes, etc.).<br><br>
                </p>
            </div>
            <p class="note"><b>Always check the specific requirements on the university’s website or contact their admissions office for detailed guidance.</b></p>
        </div>
    </div>
</body>
</html>
