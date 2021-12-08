<link rel="stylesheet" href="assets/css/registr.css">
<div class="form" condition="disabled">
	<section class="registration">
		<img src="assets/image/icon/close.png" alt="" class="close">
		<p class="title">Регистрация</p>
		<input class="name" type="text" name="Name" placeholder="Имя:" value="">
		<input class="surname" type="text" name="Surname" placeholder="Фамилия:" value="">
		<input class="patronymic" type="text" name="Patronymic" placeholder="Отчество:" value="">
		<select class="institution" name="Institution" id="">
			<option disabled selected> Учебное заведение:</option>
			<?
			// вывод учебных заведений
			foreach (SelectInstitution($connect) as $row) { 
			?>
				 <option value="<?=$row['id_institution']?>"><?=$row['name']?></option>
			<?
			}
			?>
	       
		</select>
		<input class="login" type="text" name="Login" placeholder="Логин:" value="">
		<input class="password" type="password" name="Password" placeholder="пароль:" value="">
		<input class="repassword" type="password" name="RePassword" placeholder="Повторите пароль:" value="">
	    <p class="enter">Зарегистрироваться</p>
	    <p class="back" >Уже есть аккаунт?</p>
	</section>
	<section class="authorization">
		<img src="assets/image/icon/close.png" alt="" class="close">
		<p class="title">Авторизация</p>
		<input class="login" type="text" name="Login" placeholder="Логин:" value="">
		<input class="password" type="password" name="Password" placeholder="пароль:" value="">
		<p class="enter">Войти</p>
	    <p class="back" >Зарегистрироваться?</p>
	</section>
</div>