<?php
ini_set('display_errors', 1);
session_start();

require "database.php";
require "session.php";
require "is_correct_mc.php";
require "answer_highlight.php";

$mode = 'mc';
$currentQuestion = $_SESSION['questions'][$_SESSION['answeredQuestionsCount']];

function getPreviousAnswer()
{
    if (isAnsweredQuestion()) {
        $previousAnswer = $_SESSION['questions']
            [($_SESSION['answeredQuestionsCount'] - 1)]['answer']['answer'];
    } else {
        $previousAnswer = null;
    }

    return $previousAnswer;
}

function isAnsweredQuestion ()
{
    return $_SESSION['answeredQuestionsCount'] > 0;
}

include "inc/header.php";

?>
<div class="container col-xs-12 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
    <div class="row">
        <div class="content ">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#quiz">Quiz</a></li>
                <li><a data-toggle="tab" href="#settings">Settings</a></li>
            </ul>
            <div class="tab-content">
                <div id="quiz" class="tab-pane fade in active">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php if (isAnsweredQuestion()): ?>
                            <p>Answer to previous question was <?php previousAns($isCorrect, getPreviousAnswer()); ?></p>
<?php endif; ?>
                            <h4>Who said it?</h4>                          
                        </div>
                        <div class="panel-body">
                            <div class="question-box">
                                "<?= $currentQuestion['question'] ?>"
                            </div>
                            <div class="answer-box">
                                <form action="multiple_choice.php" method="POST">
                                    <?php foreach (getAnswersList() as $current): ?>
                                        <button class="btn btn-primary" name="answer" value="<?= $current['id'] ?>" type="submit"><?= $current['answer'] ?></button><br>
<?php endforeach; ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
<?php include "inc/settings.php"; ?>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?>
