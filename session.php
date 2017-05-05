<?php

function session_init()
{
    $connection = dbconnect();
    if (!isset($_SESSION['isStarted'])) {
        $_SESSION['totalQuestionsCount'] = 10;
        $_SESSION['answeredQuestionsCount'] = 0;
        $_SESSION['correctAnswersCount'] = 0;
        $_SESSION['isStarted'] = true;
        $_SESSION['startedAt'] = time();

        $questions = getQuestions($connection);
        shuffle($questions);
        $_SESSION['questions'] = $questions;
    }
}
session_init();
