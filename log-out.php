<?php

session_start();

session_destroy();
echo("create new acount");
header("Location: login.php");
exit();