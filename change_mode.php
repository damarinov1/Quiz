<?php
session_start();

/**
 * 
 * @param type $mode
 * @return type
 */
function changeMode($mode)
{
    if ($mode == 'tf') {
        if ($_SESSION['answeredQuestionsCount'] != 0) {
            $_SESSION['answeredQuestionsCount'] = 0;
            $_SESSION['correctAnswersCount'] = 0;
        }
        $redirect = "Location: index.php";
    } else if ($mode == 'mc') {
        if ($_SESSION['answeredQuestionsCount'] != 0) {
            $_SESSION['answeredQuestionsCount'] = 0;
            $_SESSION['correctAnswersCount'] = 0;
        }
        $redirect = "Location: multiple_choice.php";
    }
    header($redirect);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    changeMode($_POST['mode']);
}

