<link rel="stylesheet" href="assets/css/new_olimp.css">
<div class="content_new_olimp" condition="disabled">
	<p class="title">Ближайшие олимпиады</p>
	<select name="filter_olimp" id="" class="filter">
		<option selected disabled>Категория:</option>
		<?php 
			// вывод категорий
			foreach (SelectCategiries($connect) as $row) {
		?>
		<option value="<?=$row["id_category"];?>"><?=$row["name"];?></option>
		<?
		}
		?>
	</select>
	<section class="items">
		<?php 
			// вывод новых олипиад
			foreach (SelectNewOlimp($connect) as $row) {
		?>
		<section class="item" id="<?=$row["id_olimp"];?>">
			<img src="assets/image/olimp/<?=$row["image"];?>" alt="" class="photo_olimp">
			<p class="name_olimp"><?=$row["title"];?></p>
			<p class="help_text">Подробнее</p>
			<p class="date_olimp"><?=$row["date_start"];?></p>
		</section>
		<?
		}
		?>
	</section>
</div>
<!-- информация о новой олимпиаде и запись на нее -->
<div class="model_new_olimp_info">
	<section class="content" id_olimp="">
		<img src="assets/image/icon/close.png" alt="" class="close">
		<p class="title"></p>
		<img src="" alt="" class="olimp_photo">
		<p class="about_olimp"></p>
		<p class="date_start"></p>
		<p class="enter" status="<?=$check['status'];?>">Записаться</p> 
	</section>
	
</div>