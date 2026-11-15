<?php

session_start();

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

include("../config/database.php");

$user_id = $_SESSION['user_id'];

$user = mysqli_fetch_assoc(
mysqli_query(
$conn,
"SELECT * FROM users
WHERE id='$user_id'"
)
);

$interviews = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM interviews
WHERE user_id='$user_id'"
)
);

$resumes = mysqli_num_rows(
mysqli_query(
$conn,
"SELECT * FROM resumes
WHERE user_id='$user_id'"
)
);

?>

<!DOCTYPE html>
<html>
<head>

<title>My Profile</title>

<link rel="stylesheet"
href="../assets/css/profile.css">

</head>

<body>

<div class="profile-box">

<h1>My Profile</h1>

<div class="card">

<h3>Name</h3>
<p><?php echo $user['name']; ?></p>

</div>

<div class="card">

<h3>Email</h3>
<p><?php echo $user['email']; ?></p>

</div>

<div class="card">

<h3>Total Interviews</h3>
<p><?php echo $interviews; ?></p>

</div>

<div class="card">

<h3>Total Resume Uploads</h3>
<p><?php echo $resumes; ?></p>

</div>

</div>

</body>
</html>