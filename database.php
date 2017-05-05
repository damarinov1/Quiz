<?php

/**
 *
 * @return \PDO
 */
function dbconnect() {
	$DB_HOST = "192.168.1.212";
	$DB_USER = "vagrant";
	$DB_PASS = "local";
	$DB_NAME = "quiz";
	$DB_CHARSET = 'utf8';

	$dsn = "mysql:host=$DB_HOST;dbname=$DB_NAME;charset=$DB_CHARSET";
	$opt = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];
	$pdo = new PDO($dsn, $DB_USER, $DB_PASS, $opt);

	return $pdo;
}

/**
 *
 * @return array
 */
function getQuestions(PDO $connect) {
	$q_stmt = $connect->query("SELECT * FROM questions");
	$questions = [];

	$a_stmt = $connect->prepare("SELECT * FROM answers WHERE id=? LIMIT 1");

	while ($question = $q_stmt->fetch()) {
		$a_stmt->execute([$question['a_id']]);
		$answer = $a_stmt->fetch();

		$questions[] = [
			"id" => $question["id"],
			"question" => $question["question"],
			"answer" => $answer,
		];
	}

	return $questions;
}

/**
 *
 * @return array
 */
function getAnswers(PDO $connect) {
	$a_stmt = $connect->query("SELECT * FROM answers");
	$answers = [];

	while ($answer = $a_stmt->fetch()) {
		$answers[] = [
			"id" => $answer["id"],
			"answer" => $answer["answer"],
		];
	}

	return $answers;
}
