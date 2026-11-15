<?php
session_start();
include("../config/database.php");

$users = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM users"));
$resumes = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM resumes"));
$interviews = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM interviews"));
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin Dashboard</title>
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container">

<h1>Admin Dashboard</h1>

<div class="cards">

<div class="card">
<h2><?php echo $users; ?></h2>
<p>Total Users</p>
</div>

<div class="card">
<h2><?php echo $resumes; ?></h2>
<p>Total Resumes</p>
</div>

<div class="card">
<h2><?php echo $interviews; ?></h2>
<p>Total Interviews</p>
</div>

</div>

<div class="links">
<a href="users.php">Manage Users</a>
<a href="reports.php">Reports</a>
</div>

</div>

</body>
</html>