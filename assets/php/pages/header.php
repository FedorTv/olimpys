
	<link rel="stylesheet" href="assets/css/header.css">	
	<div class="nav">
			<div class="logo"><img src="assets/image/icon/logo.jpg" alt=""></div>
			<div class="end_olimp"><p>Прошедшие олимпиады</p></div>
			<div class="record_olimp"><p>Запись на олимпиаду</p></div>
			<div class="user_panel">
				<?
						// проверка на авторизацию для вывода изображения
							$auth_status = $check['status'];
							if($auth_status == "auth"){
						?>	
							<img src="assets/image/photos/<?=$check['image'];?>" alt="">
						<?	
						} 
							else{
						?>	
								<img src="assets/image/icon/user.png" alt="">
						<?
						}
						?>
				
				<div class="model_auth">
					<section class="auth">
						
						<?
						//  проверка на авторизацию для вывода кнопок меню личного кабинета
							$auth_status = $check['status'];
							if($auth_status == "auth"){
						?>	
							<p class="enter_profile">Личный кабинет</p>
							<p class="exit">Выход</p>
						<?	
						} 
							else{
						?>	
								<p class="enter">Вход</p>
						<?
						}
						?>
						
					</section>
				</div>
			</div>
	</div>
