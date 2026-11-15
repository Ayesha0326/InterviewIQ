<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

// default role
$role = $_GET['role'] ?? 'frontend';

$roadmaps = [

    "frontend" => [
        "Learn HTML, CSS, JavaScript Basics",
        "Master Flexbox & Grid",
        "Learn React.js or Vue.js",
        "Understand API Integration",
        "Build Real Projects (Portfolio, Dashboard)",
        "Learn Git & Deployment"
    ],

    "backend" => [
        "Learn PHP / Node.js Basics",
        "Understand REST APIs",
        "Work with MySQL / MongoDB",
        "Authentication (JWT, Sessions)",
        "Build CRUD Projects",
        "Deploy Backend Applications"
    ],

    "fullstack" => [
        "HTML, CSS, JavaScript Mastery",
        "Frontend Framework (React/Vue)",
        "Backend Development (PHP/Node)",
        "Database Management",
        "API Integration",
        "Full Stack Projects Deployment"
    ]
];

$steps = $roadmaps[$role];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Career Roadmap</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/roadmap.css">
    

</head>

<body>

<div class="container">

    <h1>🚀 Career Roadmap</h1>

    <div class="role-buttons">

        <a href="?role=frontend">Frontend</a>
        <a href="?role=backend">Backend</a>
        <a href="?role=fullstack">Full Stack</a>

    </div>

    <div class="roadmap">

        <?php foreach($steps as $i => $step){ ?>

            <div class="step">

                <div class="number">
                    <?php echo $i+1; ?>
                </div>

                <div>
                    <?php echo $step; ?>
                </div>

            </div>

        <?php } ?>

    </div>

</div>

</body>
</html>