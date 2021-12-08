<link rel="stylesheet" href="assets/css/lk_user.css">
<div class="content_lk_user" condition="disabled">
	<p class="title_page">Личный кабинет</p>
	<section class="info_profile">
		<img class="photo_profile" src="assets/image/photos/<?=$check['image'];?>" alt="">
		<p class="update_profile">Изменить профиль</p>
		<p class="title">Информация</p>
		<p class="fio">ФИО:<br><?=$check['name_user']." ".$check['surname']." ".$check['patronymic'];?></p>
		<p class="institution">Учереждение:<br><?=$check['institution'];?></p>
	</section>
	<section class="info_olimp">
		<p class="title">Олимпиады</p>
		 <select name="result_olimp" id="" class="result_olimp">
			<option value="end" selected>Результаты олимпиад</option>
			<option value="new">Ближайшие олимпиады</option>
		</select>
   		<section class="items">
   			 <?
   			 	// вывод олимпиад которые закончились
				foreach (SelectOlimpUsers($connect,$check['id_user'],"end") as $row) {
			?>
				<section class="item" staus_olimp="<?=$row['status'];?>" id="<?=$row['id_olimp'];?>">
   				<img src="assets/image/olimp/<?=$row['image'];?>" alt="" class="photo_olimp">
   				<p class="name_olimp"><?=$row['title'];?></p>
   				<p class="position">Место: <?=$row['position'];?><br>Дата: <?=$row['date_start'];?></p>
   				</section>
			<?
			}
			?>
   			
   		</section>
	</section>
</div>
<!-- модальное окно для редактирования пользователя -->
<div class="modal_window">
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