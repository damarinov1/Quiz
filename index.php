<?php
ini_set('display_errors', 1);
session_start();

require_once "database.php";
require_once "session.php";
require_once "is_correct_tf.php";
require_once "answer_highlight.php";

$mode = 'tf';
$connection = dbconnect();

$currentQuestion = $_SESSION['questions'][$_SESSION['answeredQuestionsCount']];

$answers = getAnswers($connection);
$rand_answer = mt_rand(0, (count($answers) - 1));

function getPreviousAnswer() {
	if (isAnsweredQuestion()) {
		$previousAnswer = $_SESSION['questions']
			[($_SESSION['answeredQuestionsCount'] - 1)]['answer']['answer'];
	} else {
		$previousAnswer = null;
	}

	return $previousAnswer;
}

function isAnsweredQuestion() {
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
                            <p>Answer to previous question was <?php previousAns($isCorrect, getPreviousAnswer());?></p>
                            <?php endif;?>
                            <h4>Who said it?</h4>
                        </div>
                        <div class="panel-body">
                            <div class="question-box">
                                "<?=$currentQuestion['question']?>"
                            </div>
                            <div class="answer-box">
                                <?=$answers[$rand_answer]['answer']?>?<br>
                                <form action="index.php" method="post">
                                    <input type="hidden" name="question" value="<?=$currentQuestion['id']?>">
                                    <input type="hidden" name="answer" value="<?=$rand_answer?>">

                                    <button class="tf-btn btn btn-success" type="submit" name="answer_input" value="yes">Yes</button>
                                    <button class="tf-btn btn btn-danger" type="submit" name="answer_input" value="no">No</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "inc/settings.php";?>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php";?>
