<?php
session_start();

if(!isset($_SESSION['user_id']))
{
    header("Location: ../login.php");
    exit();
}

include("../config/database.php");

$score = "";
$feedback = "";

if(isset($_POST['analyze']))
{
    $user_id = $_SESSION['user_id'];

    $fileName = $_FILES['resume']['name'];
    $tmpName  = $_FILES['resume']['tmp_name'];

    $newName = time() . "_" . $fileName;

    $uploadPath =
    "../assets/uploads/resumes/" . $newName;

    move_uploaded_file($tmpName,$uploadPath);

    $score = rand(75,95);

    $feedback = "
    ✓ Add more technical skills <br>
    ✓ Improve professional summary <br>
    ✓ Add certifications <br>
    ✓ Add more projects
    ";

    mysqli_query(
        $conn,
        "INSERT INTO resumes
        (user_id,resume_file,ats_score,feedback)
        VALUES
        (
        '$user_id',
        '$newName',
        '$score',
        '$feedback'
        )"
    );
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Resume Analyzer</title>
<link rel="stylesheet"
href="../assets/css/style.css">
<link rel="stylesheet"
href="../assets/css/resume-analyzer.css">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

</head>

<body>

<div class="resume-container">

    <div class="resume-box">

        <h1>Resume Analyzer</h1>

        <p>
            Upload your resume and get ATS score
        </p>

        <form method="POST"
        enctype="multipart/form-data">

            <input
            type="file"
            name="resume"
            required>

            <button
            type="submit"
            name="analyze">

            Analyze Resume

            </button>

        </form>

        <?php if($score!=""){ ?>

        <div class="result-box">

            <h2>
                ATS Score :
                <?php echo $score; ?>%
            </h2>

            <h3>Suggestions</h3>

            <div class="feedback">
                <?php echo $feedback; ?>
            </div>

        </div>

        <?php } ?>

    </div>

</div>

</body>
</html>