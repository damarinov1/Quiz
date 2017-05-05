<?php
session_start();
include "inc/header.php";

?>
<div class="container">
    <div class="content">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Your results</h4>
            </div>
            <div class="panel-body">
                Total questions: <?= $_SESSION['totalQuestionsCount'] ?><br>
                Correct answers: <?= $_SESSION['correctAnswersCount'] ?><br>
                Wrong answers: <?= ($_SESSION['totalQuestionsCount'] - $_SESSION['correctAnswersCount']) ?><br>
                Time: <?= ($_SESSION['finishedAt'] - $_SESSION['startedAt']) ?> sec<br>
                <a href="destroy.php"><button class="btn btn-primary">Start again</button></a>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
