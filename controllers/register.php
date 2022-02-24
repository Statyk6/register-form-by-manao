<?php
// чтение json файла
$res = file_get_contents('../json/db.json');
$data = json_decode($res, true);

$id = 0;
$login = filter_var(trim($_POST['login']), FILTER_SANITIZE_SPECIAL_CHARS);
$password = filter_var(trim(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/", $_POST['password'])));
$password_repeat = filter_var(trim(!preg_match("/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,20}$/", $_POST['password-repeat'])));
$email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
$name = filter_var(trim($_POST['name']), FILTER_SANITIZE_SPECIAL_CHARS);

$salt = 'asdafgdhfgjadsfsg312sfds';
$hashed_pass = md5($salt . $password);

if (mb_strlen($login) < 6 || mb_strlen($login) > 18) {
	echo "<script>alert('Ошибка: Логин не может быть меньше 6 и больше 18 символов!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} elseif ((!preg_match("/^[a-zA-Z0-9]{6,30}$/", $_POST['password']))) {
	echo "<script>alert('Ошибка: Пароль должен состоять минимум из 6 букв и цифр!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} elseif ((!preg_match("/^[a-zA-Z0-9]{6,30}$/", $_POST['password-repeat']))) {
	echo "<script>alert('Ошибка: Пароль должен состоять минимум из 6 букв и цифр!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} elseif ($_POST['password'] != $_POST['password-repeat']) {
	echo "<script>alert('Ошибка: Пароли не совпадают!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} elseif ((!preg_match("/.+@.+\..+/i", $_POST['email']))) {
	echo "<script>alert('Ошибка: Указанный e-mail имеет недопустимый формат!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} else if (mb_strlen($name) < 2 || mb_strlen($name) > 29) {
	echo "<script>alert('Ошибка: Имя не может быть меньше 2 и больше 29 символов!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} else if ($login == $data[0]['login']) {
	echo "<script>alert('Ошибка: Пользователь с таким логином уже существует!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} else if ($email == $data[0]['email']) {
	echo "<script>alert('Ошибка: Пользователь с таким email уже существует!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} else if (!preg_match("/^[a-zA-Z0-9]+$/", $_POST['login'])) {
	echo "<script>alert('Ошибка: Логин должен быть без пробелов и состоять из букв английского алфавита и цифр!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} else if (!preg_match("/^(([a-zA-Z]{2,29})|([а-яА-ЯЁёІіЇїҐґЄє]{2,29}))$/u", $_POST['name'])) {
	echo "<script>alert('Ошибка: Имя должно состоять из букв русского или английского алфавита и не содержать пробелов и символов!');</script>";
	header('Refresh: 0; ../index.php');
	exit();
} else {
	// запись в json файл
	for ($i = 0; $i < count($data); $i++) {
		$data[$i]['id'] = $id++;
		$data[$i]['login'] = $login;
		$data[$i]['password'] = $hashed_pass;
		$data[$i]['password-repeat'] = $hashed_pass;
		$data[$i]['email'] = $email;
		$data[$i]['name'] = $name;
	}
	$res = json_encode($data);
	file_put_contents('../json/db.json', $res);
	require("../views/register-ok.html");
	exit();
}
