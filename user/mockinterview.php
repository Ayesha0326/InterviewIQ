<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");

// =========================
// INIT SESSION
// =========================
if (!isset($_SESSION['q_index'])) {
    $_SESSION['q_index'] = 1;
    $_SESSION['score_total'] = 0;
    $_SESSION['asked_questions'] = [];
    $_SESSION['current_question'] = "What is JavaScript Closure?";
}

$question = $_SESSION['current_question'];


// =========================
// AI QUESTION GENERATOR
// =========================
function generateAIQuestion($category, $asked, $level)
{
    $easy = [
        "What is HTML?",
        "What is CSS?",
        "What is JavaScript?",
        "What is variable in programming?"
    ];

    $medium = [
        "What is REST API?",
        "What is DOM in JavaScript?",
        "Explain OOP concept?",
        "What is SQL JOIN?"
    ];

    $hard = [
        "Explain JWT authentication flow?",
        "What is closure and lexical scope in JS?",
        "How does caching work in web applications?",
        "Explain database indexing?"
    ];

    $pool = $easy;

    if ($level > 3 && $level <= 6) {
        $pool = $medium;
    } elseif ($level > 6) {
        $pool = $hard;
    }

    // avoid repeat questions
    do {
        $q = $pool[array_rand($pool)];
    } while (in_array($q, $asked));

    return $q;
}



$result = "";

if (isset($_POST['submit_answer'])) {

    $category = $_POST['category'] ?? '';
    $answer   = $_POST['answer'] ?? '';

    if (!empty($answer)) {

       $score = rand(7,10);

$confidence = rand(55,95);

$communication = rand(50,95);

$technical_skill = rand(60,95);

$preparation_needed = 100 - $score;

if($confidence >= 80)
{
    $behavior = "Excellent";
}
elseif($confidence >= 60)
{
    $behavior = "Good";
}
else
{
    $behavior = "Needs Improvement";
}

$feedback =
"Good answer! Improve with real-world examples.";
        $user_id = $_SESSION['user_id'];

        // SAVE DB
     $stmt = $conn->prepare("
INSERT INTO interviews
(
user_id,
category,
question,
answer,
score,
feedback,
confidence,
communication,
technical_skill,
behavior_rating,
preparation_needed
)
VALUES
(
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)
");

     $stmt->bind_param(
"isssisiiisi",
$user_id,
$category,
$question,
$answer,
$score,
$feedback,
$confidence,
$communication,
$technical_skill,
$behavior,
$preparation_needed
);

        $stmt->execute();

        // update score
        $_SESSION['score_total'] += $score;
        $_SESSION['asked_questions'][] = $question;

        $_SESSION['q_index']++;

        // =========================
        // END AFTER 10 QUESTIONS
        // =========================
        if ($_SESSION['q_index'] > 10) {

            header("Location: result.php");
            exit();
        }

        // =========================
        // GENERATE NEXT QUESTION
        // =========================
        $level = $_SESSION['q_index'];

        $nextQ = generateAIQuestion(
            $category,
            $_SESSION['asked_questions'],
            $level
        );

        $_SESSION['current_question'] = $nextQ;
        $question = $nextQ;

        $result = "
            Score: $score / 10 <br><br>
            Feedback: $feedback
        ";

    } else {
        $result = "⚠ Please write your answer first.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>AI Mock Interview System</title>
    <link rel="stylesheet" href="../assets/css/mockinterview.css">
</head>

<body>

<div class="interview-container">
    <div class="interview-box">

        <h1>AI Mock Interview</h1>

        <form method="POST">

            <select name="category">
                <option>Frontend Developer</option>
                <option>Backend Developer</option>
                <option>Full Stack Developer</option>
            </select>

            <h3><?php echo $question; ?></h3>

            <textarea name="answer" placeholder="Type your answer..." required></textarea>

            <button type="submit" name="submit_answer">
                Submit Answer
            </button>

        </form>

        <?php if ($result != "") { ?>
            <div class="result">
                <?php echo $result; ?>
            </div>
        <?php } ?>

        <p>Question: <?php echo $_SESSION['q_index']; ?> / 10</p>

    </div>
</div>

</body>
</html>