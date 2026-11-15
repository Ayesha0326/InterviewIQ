<?php
session_start();

if(!isset($_SESSION['user_id'])){
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");

$user_id = $_SESSION['user_id'];

$interviews = mysqli_query($conn,"
    SELECT * FROM interviews
    WHERE user_id='$user_id'
");

$total_interviews = mysqli_num_rows($interviews);

$total_score = 0;
$highest_score = 0;

$total_confidence = 0;
$total_communication = 0;
$total_technical = 0;

while($row = mysqli_fetch_assoc($interviews))
{
    $total_score += $row['score'];

    $total_confidence += $row['confidence'];
    $total_communication += $row['communication'];
    $total_technical += $row['technical_skill'];

    if($row['score'] > $highest_score){
        $highest_score = $row['score'];
    }
}

$avg_score = $total_interviews > 0 ? $total_score / $total_interviews : 0;

$avg_confidence = $total_interviews > 0 ? $total_confidence / $total_interviews : 0;
$avg_communication = $total_interviews > 0 ? $total_communication / $total_interviews : 0;
$avg_technical = $total_interviews > 0 ? $total_technical / $total_interviews : 0;

$resumes = mysqli_query($conn,"
    SELECT * FROM resumes
    WHERE user_id='$user_id'
");

$total_resumes = mysqli_num_rows($resumes);

// score already 0–100 so no *10
$progress = $avg_score;

if($progress > 100){
    $progress = 100;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Analytics Dashboard</title>

    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/analytics.css">
</head>

<body>

<div class="container">

    <h1>📊 Your Performance Analytics</h1>

    <div class="cards">

        <div class="card">
            <h2><?php echo $total_interviews; ?></h2>
            <p>Total Interviews</p>
        </div>

        <div class="card">
            <h2><?php echo round($avg_score,1); ?>%</h2>
            <p>Average Score</p>
        </div>

        <div class="card">
            <h2><?php echo $highest_score; ?>%</h2>
            <p>Highest Score</p>
        </div>

        <div class="card">
            <h2><?php echo $total_resumes; ?></h2>
            <p>Resume Uploads</p>
        </div>

    </div>

    <!-- PROGRESS -->
    <div class="progress-box">

        <h3>Performance Progress</h3>

        <div class="bar">
            <div class="fill" style="width:<?php echo $progress; ?>%"></div>
        </div>

        <p><?php echo round($progress); ?>% Improvement Level</p>

    </div>

    <!-- SKILLS -->
    <div class="skills-section">

        <h3>Detailed Skill Analysis</h3>

        <div class="skill-box">
            <p>Confidence</p>
            <div class="bar">
                <div class="fill" style="width:<?php echo $avg_confidence; ?>%"></div>
            </div>
            <span><?php echo round($avg_confidence,1); ?>%</span>
        </div>

        <div class="skill-box">
            <p>Communication</p>
            <div class="bar">
                <div class="fill" style="width:<?php echo $avg_communication; ?>%"></div>
            </div>
            <span><?php echo round($avg_communication,1); ?>%</span>
        </div>

        <div class="skill-box">
            <p>Technical</p>
            <div class="bar">
                <div class="fill" style="width:<?php echo $avg_technical; ?>%"></div>
            </div>
            <span><?php echo round($avg_technical,1); ?>%</span>
        </div>

    </div>

    <!-- CARDS -->
    <div class="card">
        <h2><?php echo round($avg_confidence); ?>%</h2>
        <p>Confidence</p>
    </div>

    <div class="card">
        <h2><?php echo round($avg_communication); ?>%</h2>
        <p>Communication</p>
    </div>

    <div class="card">
        <h2><?php echo round($avg_technical); ?>%</h2>
        <p>Technical Skills</p>
    </div>

    <!-- FEEDBACK -->
    <div class="progress-box">

        <h3>AI Career Feedback</h3>

        <?php
        if($avg_score >= 80){
            echo "<p>Excellent performance. You are job ready.</p>";
        }
        elseif($avg_score >= 60){
            echo "<p>Good progress. Improve communication and confidence.</p>";
        }
        else{
            echo "<p>You need more practice in technical and communication skills.</p>";
        }
        ?>

    </div>

</div>

</body>
</html>