<link rel="stylesheet" href="assets/css/news.css">
<div class="main_content" condition="active">
	<div class="news">
		<?php 
		// вывод свежих новостей
			foreach (SelectFreshNews($connect) as $row) {
		?>
		<div class="item" id_new="<?=$row["id_new"];?>">
			<p class="theme_new"><?=$row["title"];?></p>
			<img class="photo_new" src="assets/image/news/<?=$row["image"];?>" alt="">
			<p class="text_new"><?=$row["text"];?></p>
			<p class="date_publisher">Дата: <?=substr($row["data_publisher"], 0, -9);?></p>
			<p class="read_new">Читать далее</p>
		</div>
		<?
		}
		?>
	</div>
	<div class="all_news">
		<div class="items">
			<?php 
			//  вывод всех новостей
				foreach (SelectAllNews($connect) as $row) {
			?>
				<div class="item" id_new="<?=$row["id_new"];?>">
					<p class="theme_new"><?=$row["title"];?></p>
					<p class="date_publisher">Дата: <?=substr($row["data_publisher"], 0, -9);?></p>
					<p class="read_new">Читать далее</p>
				</div>
			<?
			}
			?>
		</div>
		
	</div>
</div>
<!-- модальное окно для просмотра новости -->
<div class="model_news_info">
	<section class="content">
		<img src="assets/image/icon/close.png" alt="" class="close">
		<p class="title"></p>
		<img src="" alt="" class="news_olimp">
		<p class="text_news"></p>
		<p class="date_publisher"></p>
	
	</section>
	
</div>