<?php
include("../config/database.php");

$users = mysqli_query($conn,"SELECT * FROM users");
?>

<!DOCTYPE html>
<html>
<head>
<title>Users</title>
<link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>

<div class="container">

<h1>All Users</h1>

<table>

<tr>
<th>ID</th>
<th>Name</th>
<th>Email</th>
</tr>

<?php while($row=mysqli_fetch_assoc($users)){ ?>

<tr>
<td><?php echo $row['id']; ?></td>
<td><?php echo $row['name']; ?></td>
<td><?php echo $row['email']; ?></td>
</tr>

<?php } ?>

</table>

</div>

</body>
</html>