<?php 
// подключение файлов функций
include_once("assets/php/functions/news_function.php");
include_once("assets/php/functions/data_select.php");
include_once("assets/php/functions/olimp_functions.php");


//проверка олимпиад на окончание по дате
CheckEndOlimp($connect);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Олимпус</title>
	<link rel="stylesheet" href="assets/css/main.css">
	<script src="assets/js/jquery-3.6.0.min.js"></script>
	<script src="assets/js/main.js"></script>
	<script src="assets/js/auth_registration.js"></script>
	<script src="assets/js/olimp.js"></script>
	<script src="assets/js/profile.js"></script>


</head>
<body>
	<div class="blur">
	</div>
	<header>
		<?php 
		// подключение шапки сайта
			include_once("assets/php/pages/header.php");
		 ?>
	</header>
	<article>
		<?php 
		// страница новостей
			include_once("assets/php/pages/news.php");
		// страница с формаой регистрации и авторизации
			include_once("assets/php/pages/registr.php");
		// получение статуса авторизации
			$auth_status = $check['status'];
		// тип пользователя
			$user_type = $check['type'];
		// если пользователь авторизован
			if($auth_status == "auth"){
				// вывод пользователя по типу аккаунта
				if($user_type == "admin"){
					include_once("assets/php/pages/lk_admin.php");
				}
				else{
					include_once("assets/php/pages/lk_user.php");
				}
				
			}
		// страницы для новых олимпиад и оконченных олимпиад
			include_once("assets/php/pages/new_olimp.php");
			include_once("assets/php/pages/end_olimp.php");
		 ?>
	</article>
	<footer>
		<?php 
		// подключение футера к станице
			include_once("assets/php/pages/footer.php");
		 ?>
	</footer>

</body>
</html>