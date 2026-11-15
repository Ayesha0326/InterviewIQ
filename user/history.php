<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");

$user_id = $_SESSION['user_id'];

$data = mysqli_query(
$conn,
"SELECT * FROM interviews
WHERE user_id='$user_id'
ORDER BY id DESC"
);
?>

<!DOCTYPE html>
<html>
<head>

<title>Interview History</title>

<link rel="stylesheet"
href="../assets/css/history.css">

</head>

<body>

<div class="history-container">

<h1>Interview History</h1>

<table>

<tr>
<th>ID</th>
<th>Category</th>
<th>Score</th>
<th>Date</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['category']; ?></td>

<td><?php echo $row['score']; ?>/10</td>

<td><?php echo $row['created_at']; ?></td>

</tr>

<?php } ?>

</table>

</div>

</body>
</html>