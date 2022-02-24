<style>
	@import "../css/styles.css";
</style>
<?php
/*
Author: Alexandr Kravets
Date: 22.02.2022
Project: Test project for MANAO
*/

require 'views/header.html';

// проверяю существует ли сессия и направляю на разные страницы
if (isset($_SESSION['newsession'])) {
	require('controllers/lobby.php');
} else {
	require('views/register-form.html');
}

require 'views/footer.html';
