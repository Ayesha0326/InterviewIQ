
<?php
include("config/database.php");

$message = "";

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email = ?");
    mysqli_stmt_bind_param($check, "s", $email);
    mysqli_stmt_execute($check);
    $result = mysqli_stmt_get_result($check);

    if (mysqli_num_rows($result) > 0) {
        $message = "Email already exists";
    } else {
        $stmt = mysqli_prepare(
            $conn,
            "INSERT INTO users (name, email, password) VALUES (?, ?, ?)"
        );

        mysqli_stmt_bind_param($stmt, "sss", $name, $email, $password);

        if (mysqli_stmt_execute($stmt)) {
            $message = "Registration Successful";
        } else {
            $message = "Registration failed. Please try again.";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_stmt_close($check);
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

        <?php if ($message != ""): ?>
            <p class="message"><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email Address" required>
        <input type="password" name="password" placeholder="Password" required>

        <button type="submit" name="register">Create Account</button>

        <p>
            Already have an account?
            <a href="login.php">Login</a>
        </p>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
