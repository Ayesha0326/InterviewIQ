<?php

session_start();

include("config/database.php");

$error = "";

if(isset($_POST['login']))
{
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($query) > 0)
    {
        $user = mysqli_fetch_assoc($query);

        if(password_verify($password, $user['password']))
        {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['name'] = $user['name'];

            header("Location: user/dashboard.php");
            exit();
        }
        else
        {
            $error = "Wrong Password";
        }
    }
    else
    {
        $error = "Email Not Found";
    }
}
?>
    <?php include 'includes/header.php'; ?>
    <?php include 'includes/navbar.php'; ?>
    <div class="auth-container">
    <form method="POST" class="auth-form">

        <h2>Welcome Back</h2>

        <p class="auth-subtitle">
            Login to continue your interview preparation
        </p>

        <input type="email" name="email" placeholder="Email Address" required>

        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="login">
            Login
        </button>

        <p>
            Don't have an account?
            <a href="register.php">Register</a>
        </p>

    </form>
    </div>
    <?php include 'includes/footer.php'; ?>