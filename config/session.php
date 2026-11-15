<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "interviewiq"
);

if(!$conn){
    die("Database Connection Failed");
}
?>