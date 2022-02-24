<?php

$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_var(trim(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/", $_POST['password'])));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

$salt = 'asdafgdhfgjadsfsg312sfds';
$hashed_pass = md5($salt . $password);
// чтение json файла
$res = file_get_contents('../json/db.json');
$data = json_decode($res, true);


if ((!preg_match("/^[a-zA-Z0-9]{6,30}$/", $_POST['password']))) {
	echo "<script>alert('Ошибка: Пароль должен состоять минимум из 6 букв и цифр!');</script>";
	header('Refresh: 0; ../views/login-form.html');
	exit();
}

// проверяю наличие полтьзователя в базе данных JSON
if ($login == $data[0]['login'] && $hashed_pass == $data[0]['password']) {
	session_start();
	$_SESSION["newsession"] = true;
	$_SESSION["login"] = $login;
	header('Refresh: 0; ../controllers/lobby.php');
	exit();
}

if (!isset($_SESSION['newsession'])) {
	session_start();
} else session_destroy();

// Если пользователь не найден
echo "<script>alert('Пользователь не найден - проверьте введенные данные!');</script>";
header('Refresh: 0; ../views/login-form.html');
exit();
