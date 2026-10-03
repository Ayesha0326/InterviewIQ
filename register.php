<?php
include("config/database.php");

$message = "";

if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $email = $_POST['email'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    $check = mysqli_query(
        $conn,
        "SELECT * FROM users WHERE email='$email'"
    );

    if(mysqli_num_rows($check)>0)
    {
        $message = "Email already exists";
    }
    else
    {
        mysqli_query(
            $conn,
            "INSERT INTO users(name,email,password)
            VALUES('$name','$email','$password')"
        );

        $message = "Registration Successful";
    }
}

?>

<?php include 'includes/header.php'; ?>
<?php include 'includes/navbar.php'; ?>
<div class="auth-container">
<form method="POST" class="auth-form">

    <h2>Create Account</h2>

    <p class="auth-subtitle">
        Join InterviewIQ and start your career journey
    </p>
  <?php if($message != ""): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>
    <input type="text" name="name" placeholder="Full Name" required>

    <input type="email" name="email" placeholder="Email Address" required>

    <input type="password" name="password" placeholder="Password" required>

    <button type="submit" name="register">
        Create Account
    </button>

    <p>
        Already have an account?
        <a href="login.php">Login</a>
    </p>

</form>
</div>

<?php include 'includes/footer.php'; ?>