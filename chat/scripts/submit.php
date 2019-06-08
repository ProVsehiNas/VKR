<?php
	session_start();
	include ('scripts.php');
	if($_POST['call_function'] == 'chat'){
		//проверка есть ли такой пользователь в бд
		include('connect_to_bd.php');
		$test = $dbh -> prepare("SELECT id, login FROM users WHERE login = ?");
		$test -> execute(array($_POST['direction']));
		if ($test -> rowcount() == 0) {
			exit ('Такого пользователя нет.');
		}
		$text = 'Start chat';
		$add = $dbh -> prepare("INSERT INTO chat (maker, direction, text) VALUES (?, ?, ?)");
		$add -> bindParam(1, $_SESSION['login']);
		$add -> bindParam(2, $_POST['direction']);
		$add -> bindParam(3, $text);
		$add -> execute();
		echo "Пользователь добавлен";
	}

	if($_POST['call_function'] == 'send_sms'){
		var_dump($_POST);
		include('connect_to_bd.php');
		$sms = $dbh -> prepare('INSERT INTO chat (maker, direction, text) VALUES (?, ?, ?)');
		$sms -> bindParam(1, $_SESSION['login']);
		$sms -> bindParam(2, $_POST['direction']);
		$sms -> bindParam(3, $_POST['text']);
		$sms -> execute();
		echo "Сообщение отправлено";
	}
?>