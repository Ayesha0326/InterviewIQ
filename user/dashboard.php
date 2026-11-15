<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");
?>

<!DOCTYPE html>
<html>
<head>

<title>Dashboard - InterviewIQ</title>

<link rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" href="../assets/css/dashboard.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="dashboard-container">

    <div class="dashboard-header">

        <div>
            <h1>
                Welcome,
                <?php echo $_SESSION['name']; ?> 👋
            </h1>

            <p>
                Ready to improve your interview skills today?
            </p>
        </div>

        <a href="../logout.php" class="logout-btn">
            Logout
        </a>

    </div>

    <div class="dashboard-cards">

        <a href="resume-analyzer.php" class="dashboard-card">

            <i class="fa-solid fa-file"></i>

            <h3>Resume Analyzer</h3>

            <p>
                Upload resume and get ATS score
            </p>

        </a>

        <a href="mockinterview.php" class="dashboard-card">

            <i class="fa-solid fa-microphone"></i>

            <h3>Mock Interview</h3>

            <p>
                Practice AI based interviews
            </p>

        </a>

        <a href="roadmap.php" class="dashboard-card">

            <i class="fa-solid fa-road"></i>

            <h3>Career Roadmap</h3>

            <p>
                Personalized learning path
            </p>

        </a>

        <a href="analytics.php" class="dashboard-card">

            <i class="fa-solid fa-chart-line"></i>

            <h3>Analytics</h3>

            <p>
                Track your performance
            </p>

        </a>

<a href="history.php" class="dashboard-card">

    <i class="fa-solid fa-clock-rotate-left"></i>

    <h3>Interview History</h3>

    <p>
        View all previous interviews
    </p>

</a>

<a href="profile.php" class="dashboard-card">

    <i class="fa-solid fa-user"></i>

    <h3>My Profile</h3>

    <p>
        Manage account information
    </p>

</a>
    </div>

</div>  

</body>
</html> 
