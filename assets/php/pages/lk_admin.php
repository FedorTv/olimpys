<link rel="stylesheet" href="assets/css/lk_admin.css">
<div class="content_lk_admin" condition="disabled">
	<p class="title_page">Личный кабинет</p>
	<section class="info_profile">
		<img class="photo_profile" src="assets/image/photos/<?=$check['image'];?>" alt="">
		<p class="update_profile">Изменить профиль</p>
		<p class="title">Информация</p>
		<p class="fio">ФИО:<br><?=$check['name_user']." ".$check['surname']." ".$check['patronymic'];?></p>
		<p class="institution">Учереждение:<br><?=$check['institution'];?></p>
	</section>
	<section class="info_olimp">
		<p class="title">Разделы</p>
		 <select name="result_olimp" id="" class="result_olimp">
			<option value="result_olimp" selected>Результаты олимпиад</option>
			<option value="new_olimp">Ближайшие олимпиады</option>
			<option value="user">Пользователи</option>

		</select>
		<p class="add_olimp">Добавить олимпиаду</p>
   		<section class="items">
   			<?php 
   			//  вывод оконченных олимпиад
			foreach (SelectEndOlimp($connect) as $row) {
		?>
		<section class="item_olimp" staus_olimp="end" id="<?=$row['id_olimp']?>">
	   				<img src="assets/image/olimp/<?=$row['image']?>" alt="" class="photo_olimp">
	   				<p class="name_olimp"><?=$row['title']?><br>Дата: <?=$row['date_start']?></p>
	   				<p class="position">Редактировать</p>
   				</section>
		<?
		}
		?>
   			
   			
   		</section>
	</section>
</div>
<div class="modal_window">
	<!-- модальное окно для установки мест на олипиаде -->
		<section class="edit_position" id_olimp="">
			<img src="assets/image/icon/close.png" alt="" class="close">
			<p class="title">Установка мест</p>
			<select name="first_position" id="fist">
				<option value="" selected disabled class="no_remove">Первое место</option>
				
			</select>
			<select name="two_position" id="two">
				<option value="" selected disabled class="no_remove">Второе место</option>
				
			</select>
			<select name="three_position" id="three">
				<option value="" selected disabled class="no_remove">Третье место</option>
				
			</select>
			<p class="save">Сохранить</p>
		</section>
		<!-- модальное окно для обновления и добавления олимпиад -->
		<section class="update_or_add_olimp" id_olimp="">
			<img src="assets/image/icon/close.png" alt="" class="close">
			<p class="title">Редактирование олимпиады</p>
			<input type="text" class="name_olimp" placeholder="Название:">
			<input type="date" class="date_olimp" value="2021-11-03">
			<select name="olimp_categiry" id="category" class="category">
					<option value="" selected disabled>Категория</option>
					<?php 
					// вывод категорий
					foreach (SelectCategiries($connect) as $row) {
					?>
					<option value="<?=$row["id_category"];?>"><?=$row["name"];?></option>
					<?
					}
					?>

			</select>
			<p class="about_olimp">Описание олимпиады</p>
			<textarea name="about_text" class="about_text" id=""></textarea>
			<input type="file" multiple="multiple" class="upload_photo" id="upload_photo_olimp" >
			<p class="save">Сохранить</p>
		</section>
		<!-- модальное окно для обновление пользователей и своего профиля -->
		<section class="update_user" id_user="">
			<img src="assets/image/icon/close.png" alt="" class="close">
			<p class="title">Редактирование пользователя</p>
			<input type="text" class="name_user" placeholder="Имя:">
			<input type="text" class="surname_user" placeholder="Фамилия:">
			<input type="text" class="patronymic_user" placeholder="Отчество:">
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
			<input type="text" class="password" placeholder="Новый пароль:">
			<input type="file" multiple="multiple" class="upload_photo" id="upload_photo">
			<p class="save">Сохранить</p>
		</section>
</div>