<?php
include("../config/database.php");

$data = mysqli_query($conn,"
SELECT * FROM interviews
ORDER BY id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
<title>Reports</title>
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container">

<h1>Interview Reports</h1>

<table>

<tr>
<th>User ID</th>
<th>Category</th>
<th>Score</th>
<th>Feedback</th>
</tr>

<?php while($row=mysqli_fetch_assoc($data)){ ?>

<tr>
<td><?php echo $row['user_id']; ?></td>
<td><?php echo $row['category']; ?></td>
<td><?php echo $row['score']; ?></td>
<td><?php echo $row['feedback']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>