<style>
	@import "../css/styles.css";
</style>

<form action="exit.php" method="post">
	<ul class="flex-outer">
		<h1>Добро пожаловать
			<?php
			session_start();
			echo $_SESSION['login'];
			?>
			!</h1>
		<p>Мы рады что у Вас получилось зарегистрироваться на нашем сайте в это непростое время :)<br>
			Время, когда мессенджеры заполонили всю планету, а старые добрые сайты уже не в моде.</p>
		</br>
		<li>
			<a href="https://rabota.by/resume/e5b122d1ff0435d36b0039ed1f745875785931" class="btn" target="_blank">Резюме</a>
		</li>
		<li>
			<a href="https://github.com/Statyk6" class="btn" target="_blank">GitHub</a>
		</li>
		<li>
			<a href="https://www.linkedin.com/in/alexandr-kravets-274974b6/" class="btn" target="_blank">LinkedIn</a>
		</li>
		<li>
			<button type="submit">Выйти</button>
		</li>
	</ul>
</form>