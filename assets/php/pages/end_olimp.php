<link rel="stylesheet" href="assets/css/end_olimp.css">
<div class="content_end_olimp" condition="disabled">
	<p class="title">Прошедшие олимпиады</p>
	<select name="filter_olimp" id="" class="filter">
		<option selected disabled>Категория:</option>
		<?php 
			// вывод категорий олимпиад
			foreach (SelectCategiries($connect) as $row) {
		?>
		<option value="<?=$row["id_category"];?>"><?=$row["name"];?></option>
		<?
		}
		?>
	</select>
	<section class="items">
		<?php 
			// вывод олипиад
			foreach (SelectEndOlimp($connect) as $row) {
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
<!-- модальное окно для просмотра информации об олимпиаде -->
<div class="model_end_olimp_info">
	<section class="content">
		<img src="assets/image/icon/close.png" alt="" class="close">
		<p class="title"></p>
		<img src="" alt="" class="olimp_photo">
		<p class="about_olimp"></p>
		<section class="position">
			<section class="first">
				<p class="user_name"></p>
				<img src="assets/image/icon/gold.png" alt="" class="medal">
				<p class="institution"></p>
			</section>
			<section class="two">
				<p class="user_name"></p>
				<img src="assets/image/icon/silver.png" alt="" class="medal">
				<p class="institution"></p>
			</section>
			<section class="three">
				<p class="user_name"></p>
				<img src="assets/image/icon/bronze.png" alt="" class="medal">
				<p class="institution"></p>
			</section>
		</section>
	</section>
	
</div>