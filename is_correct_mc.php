<?php

function answerCheck($corrAnsIndex, $answer) {
	$isCorrect = false;
	if ($answer == $corrAnsIndex) {
		$_SESSION['correctAnswersCount']++;
		$isCorrect = true;
	}
	$_SESSION['answeredQuestionsCount']++;

	return $isCorrect;
}

function getAnswersList() {
	$correctAnswer = $_SESSION['questions'][$_SESSION['answeredQuestionsCount']]['answer'];
	$connection = dbconnect();
	$answers = getAnswers($connection);
	$rand_key1 = mt_rand(0, (count($answers) - 1));

	if ($rand_key1 == $correctAnswer['id']) {
		$rand_key1 = mt_rand(0, (count($answers) - 1));
	}

	do {
		$rand_key2 = mt_rand(0, (count($answers) - 1));
	} while ($rand_key1 == $rand_key2 || $rand_key2 == $correctAnswer['id']);

	$answersList = [$correctAnswer, $answers[$rand_key1], $answers[$rand_key2]];
	shuffle($answersList);

	return $answersList;
}

/**
 *
 * @return type
 */
function isFinished() {
	if ($_SESSION['answeredQuestionsCount'] == $_SESSION['totalQuestionsCount']) {
		$_SESSION['finishedAt'] = time();
		header("Location: results.php");
		exit();
	}
}
$correctAnswerIndex = $_SESSION['questions']
	[$_SESSION['answeredQuestionsCount']]['answer']['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$isCorrect = answerCheck($correctAnswerIndex, $_POST['answer']);
}

isFinished();
