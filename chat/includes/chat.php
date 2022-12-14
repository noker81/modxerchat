<?php

session_start();//Подключение должно быть на первой строчке в коде, иначе появится ошибка
require_once '../../config.php';

session_start();
ini_set('memory_limit', '1024M');

define("BASE_PATH", $_SERVER['DOCUMENT_ROOT']);
define("BASE_URL", "https://".((substr_count($_SERVER['HTTP_HOST'], "www.")==1)?"":"www.").$_SERVER['HTTP_HOST']);

date_default_timezone_set('UTC');

try {
    $pdo = new PDO('mysql:host=localhost;dbname=modmaster;charset=utf8', $user, $pass);
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

if (isset($_POST['name']) && !empty($_POST['name'])) {
	$name = mb_strtolower($_POST['name']);
	$stmt = $pdo->prepare("SELECT * FROM `modx_users` WHERE synonyms LIKE :name LIMIT 1");
	$stmt->execute(["name"=>"%".$name."%"]);
	$user = $stmt->fetch();
	if (!empty($user['work'])) {
		
		if (isset($_POST['code']) && md5($_POST['code']) == $user['pass']) {
			
			$temperature = str_replace([",", " "], [".", ""], $_POST['temperature']);
			$now = floor(time() / 86400) * 86400;
			
			$stmt2 = $pdo->prepare("SELECT * FROM `modx_temperature` WHERE insert_date=:insert_date AND user_id=:user_id LIMIT 1");
			$stmt2->execute(["insert_date" => $now, "user_id" => $user['id']]);
			$temp = $stmt2->fetch();
			
			if (isset($temp['user_id'])) {
				echo 'Я уже фиксировал Ваша температура сегодня. Оставим это дело на завтра.';
			}
			else {
				echo 'Показания зафиксированы.';
				
				$sql = "INSERT INTO modx_temperature (insert_date, 	user_id, temperature) VALUES (:insert_date, :user_id, :temperature)";
				$query = $pdo->prepare($sql);
				$query->execute( ['insert_date'=>$now, 'user_id'=>$user['id'], 'temperature'=>$temperature] );
				
				foreach (glob(BASE_PATH."/db_cache/*") as $filename) {
					unlink ($filename);
				}
				
			}
		
		}
		elseif (isset($_POST['code'])) echo 'Домофон, что-то не работает, обратитесь к дежурному врачу.';
		else echo $user['work'];
		
	}
	elseif (isset($_POST['code'])) echo 'Не нашел вас в базе, сейчас пробъю по IP и выдвинусь на встречу.';
	else echo 'человек';
}