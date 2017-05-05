<?php

/**
 * 
 * @param type $corrAnsIndex
 * @param type $answer
 * @param type $answerInput
 * @return boolean
 */
function answerCheck($corrAnsIndex, $answer, $answerInput)
{
    $isCorrect = false;

    if ($corrAnsIndex == $answer) {
        if ($answerInput == 'yes') {
            $_SESSION['correctAnswersCount'] ++;
            $isCorrect = true;
        }
    }
    if ($corrAnsIndex != $answer) {
        if ($answerInput == 'no') {
            $_SESSION['correctAnswersCount'] ++;
            $isCorrect = true;
        }
    }

    $_SESSION['answeredQuestionsCount'] ++;
    return $isCorrect;
}

/**
 * 
 * @return type
 */
function isFinished()
{
    if ($_SESSION['answeredQuestionsCount'] == $_SESSION['totalQuestionsCount']) {
        $_SESSION['finishedAt'] = time();
        header("Location: results.php");
    }
}
$correctAnswerIndex = $_SESSION['questions']
    [$_SESSION['answeredQuestionsCount']]['answer']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $isCorrect = answerCheck($correctAnswerIndex, $_POST['answer'], $_POST['answer_input']);
}

isFinished();
