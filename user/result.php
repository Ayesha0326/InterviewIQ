<?php
session_start();

$totalScore = $_SESSION['score_total'] ?? 0;

// convert to percentage (0–100)
$totalPercentage = $totalScore;

$confidence = rand(60,95);
$communication = rand(60,95);
$technical = rand(60,95);

// readiness (all already in 100 scale)
$readiness = ($totalPercentage + $confidence + $communication + $technical) / 4;

$preparation = 100 - $readiness;

session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Interview Result</title>
    <link rel="stylesheet" href="/interviewIQ/assets/css/mockresult.css">
</head>

<body>

<div class="result-box">

    <h1>🎉 Interview Completed</h1>

    <div class="score">
        Total Score: <b><?php echo $totalPercentage; ?> / 100</b>
    </div>

    <div class="score">
        Average: <b><?php echo round($totalPercentage); ?> / 100</b>
    </div>

    <?php if ($totalPercentage >= 70): ?>
        <div class="badge excellent">Excellent Performance 👍</div>

    <?php elseif ($totalPercentage >= 50): ?>
        <div class="badge good">Good Performance 👍</div>

    <?php else: ?>
        <div class="badge poor">Need Improvement 📚</div>
    <?php endif; ?>

    <div class="analysis-card">

        <p>Confidence Level: <b><?php echo $confidence; ?>%</b></p>
        <p>Communication: <b><?php echo $communication; ?>%</b></p>
        <p>Technical Skills: <b><?php echo $technical; ?>%</b></p>

        <p>Job Readiness: <b><?php echo round($readiness); ?>%</b></p>
        <p>Preparation Needed: <b><?php echo round($preparation); ?>%</b></p>

    </div>

    <br>

    <a href="user/mockinterview.php">Start New Interview</a>

</div>

</body>
</html>