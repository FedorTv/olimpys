<?php
include("connect.php");
//вывод новых олимпиад
function SelectNewOlimp($connect)
{	
		$select_new_olimp = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'new' ")->fetchAll();
		return $select_new_olimp;
}
// вывод проведенных олимпиад
function SelectEndOlimp($connect)
{	
		$select_end_olimp = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'end' ")->fetchAll();
		return $select_end_olimp;
}
// переменная для вывода выбранной олимпиады для записи
$id_new_olimp = $_POST['id_new_olimp'];
// функция вывода из бд выбранной олимпиады
function SelectInfoNewOlimp($connect,$id_new_olimp){
	$select_new_olimp = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'new' AND id_olimp=".$id_new_olimp )->fetchAll();
	return $select_new_olimp;
}
// если существует номер выбранной олимпиады вызвать функцию и вернуть результат для вывода на страницу
if(isset($id_new_olimp)){
	echo json_encode(array('result'=>'success','array_info'=>SelectInfoNewOlimp($connect,$id_new_olimp)));
}
// номер прошедшей олипиады
$id_end_olimp = $_POST['id_end_olimp'];
// функция вывода прошедшей олимпиады
function SelectInfoEndOlimp($connect,$id_end_olimp){
	$select_end_olimp = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start` FROM `olimps` WHERE status= 'end' AND id_olimp=".$id_end_olimp )->fetchAll();
	return $select_end_olimp;
}
// вывод мест и занесение их в массив
function SelectPositionEndOlimp($connect,$id_end_olimp){
	$select_first_postion = $connect->query("SELECT users.name as `name_user`,`surname`,`patronymic`, institutions.name as `name_institutions` from results INNER JOIN users on users.id_user=results.id_user INNER JOIN institutions on institutions.id_institution=users.id_institution WHERE id_olimpus = ".$id_end_olimp." AND position='Первое'")->fetchAll();
	$select_two_postion = $connect->query("SELECT users.name as `name_user`,`surname`,`patronymic`, institutions.name as `name_institutions` from results INNER JOIN users on users.id_user=results.id_user INNER JOIN institutions on institutions.id_institution=users.id_institution WHERE id_olimpus = ".$id_end_olimp." AND position='Второе'")->fetchAll();
	$select_three_postion = $connect->query("SELECT users.name as `name_user`,`surname`,`patronymic`, institutions.name as `name_institutions` from results INNER JOIN users on users.id_user=results.id_user INNER JOIN institutions on institutions.id_institution=users.id_institution WHERE id_olimpus = ".$id_end_olimp." AND position='Третье'")->fetchAll();
	$array_position = array();
	foreach ($select_first_postion as $row) {
		$fio = $row['name_user']." ".mb_substr($row['surname'],0,1).".".mb_substr($row['patronymic'],0,1).".";
		array_push($array_position,["fio"=>$fio,"institutions"=>$row['name_institutions']]);
		 
	}
	foreach ($select_two_postion as $row) {
		$fio = $row['name_user']." ".mb_substr($row['surname'],0,1).".".mb_substr($row['patronymic'],0,1).".";
		array_push($array_position,["fio"=>$fio,"institutions"=>$row['name_institutions']]);
		 
	}
	foreach ($select_three_postion as $row) {
		$fio = $row['name_user']." ".mb_substr($row['surname'],0,1).".".mb_substr($row['patronymic'],0,1).".";
		array_push($array_position,["fio"=>$fio,"institutions"=>$row['name_institutions']]);
		 
	}
	return $array_position;
}
// если существует номер прошедшей олимпиады вызвать функцию и вернуть результат для вывода
if(isset($id_end_olimp)){
	echo json_encode(array('result'=>'success','array_info'=>SelectInfoEndOlimp($connect,$id_end_olimp),'position'=>SelectPositionEndOlimp($connect,$id_end_olimp)));
}
//переменная для фильтрация новых олимпиад
$filter_new_id = $_POST['filter_new_id'];
// поиск олимпиад по фильтру
function SelectNewOlimpFilter($connect,$filter_id){
	$html_text = '';
	if($filter_id != 0){
		$select_new_olimp_filter = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'new' AND id_category=".$filter_id)->fetchAll();
	}
	if($filter_id == 0){
		$select_new_olimp_filter = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'new'")->fetchAll();
	}
	// формирование html кода для вывода неофходимых олимпиад
	foreach ($select_new_olimp_filter as $row){
		$html_text.='<section class="item" id="'.$row["id_olimp"].'">
						<img src="assets/image/olimp/'.$row["image"].'" alt="" class="photo_olimp">
						<p class="name_olimp">'.$row["title"].'</p>
						<p class="help_text">Подробнее</p>
						<p class="date_olimp">'.$row["date_start"].'</p>
					</section>';
	}
	return $html_text;
}
// если существует переменная фильтра вернуть результат с результатами функции
if(isset($filter_new_id)){
	echo json_encode(array('result'=>'success','array_info'=>SelectNewOlimpFilter($connect,$filter_new_id)));
}
// переменная для фильтра прошедших олимпиад
$filter_end_id = $_POST['filter_end_id'];
// поиск прошедших олимпиад по фильтру
function SelectEndOlimpFilter($connect,$filter_id){
	$html_text = '';
	if($filter_id != 0){
		$select_new_olimp_filter = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'end' AND id_category=".$filter_id)->fetchAll();
	}
	if($filter_id == 0){
		$select_new_olimp_filter = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'end'")->fetchAll();
	}
	// формирование html кода для вывода неофходимых олимпиад
	foreach ($select_new_olimp_filter as $row){
		$html_text.='<section class="item" id="'.$row["id_olimp"].'">
						<img src="assets/image/olimp/'.$row["image"].'" alt="" class="photo_olimp">
						<p class="name_olimp">'.$row["title"].'</p>
						<p class="help_text">Подробнее</p>
						<p class="date_olimp">'.$row["date_start"].'</p>
					</section>';
	}
	return $html_text;
}
// если существует переменная фильтра вернуть результат с результатом функции
if(isset($filter_end_id)){
	echo json_encode(array('result'=>'success','array_info'=>SelectEndOlimpFilter($connect,$filter_end_id)));
}
// проверка на окончание олимпиады по сегоднешней дате
function CheckEndOlimp($connect){
	$select_new_olimp = $connect->query("SELECT `id_olimp`, `title`, `image`, `text`, `date_start`,`id_category` FROM `olimps` WHERE status= 'new' ")->fetchAll();
	foreach ($select_new_olimp as $row){
		if($row['date_start'] <= date("Y-m-d")){
			$update_status_olimp = $connect->query("UPDATE `olimps` SET `status`='end' WHERE id_olimp=".$row['id_olimp']);
		}
		
	}
	return "success";
}
// переменная номера новой олимпиады для записи
$id_olimp = $_POST['id_record_olimp'];
// если существет переменная для записи
if (isset($id_olimp)) {
	// поиск нет ли записи у этого пользователя
	$select_record = $connect->query("SELECT`id_olimpus`, `id_user`FROM `results` WHERE id_olimpus=".$id_olimp." AND id_user=".$check['id_user']);
	// если записи нет на олимпиаду то записать, а если уже записанн вернуть результат что записан
	if($select_record->rowCount() == 0){
		$insert_user_olimp = $connect->query("INSERT INTO `results`(`id_olimpus`, `id_user`) VALUES (".$id_olimp.",".$check['id_user'].")");
		echo json_encode(array('result'=>'success'));
	}
	else{
		echo json_encode(array('result'=>'bad'));
	}
}
//переменная для получения статуса олимпиады
$filter_user_olimp_status = $_POST['filter_user'];
// вывод олимпиад пользователя по статусу
function SelectOlimpUsers($connect,$id_user,$status){
	$select_end_olimp_user = $connect->query("SELECT id_olimp,title,image,status,date_start,position from olimps INNER JOIN results on results.id_olimpus=olimps.id_olimp 
		WHERE status='".$status."' AND id_user=".$id_user)->fetchAll();
	return $select_end_olimp_user;
}
// если существует переменная статуса то вывести олимпиады в которых участвовал пользователи или на которые записалмя
if(isset($filter_user_olimp_status)){
	$result = SelectOlimpUsers($connect,$check['id_user'],$filter_user_olimp_status);
	$html_text = '';
	foreach ($result as $row){
		$html_text.='<section class="item" staus_olimp="'.$row["status"].'" id="'.$row["id_olimp"].'">
   				<img src="assets/image/olimp/'.$row["image"].'" alt="" class="photo_olimp">
   				<p class="name_olimp">'.$row["title"].'</p>
   				<p class="position">Место: '.$row["position"].'<br>Дата: '.$row["date_start"].'</p>
   				</section>';
	}
	echo json_encode(array('result'=>'success','array_info'=>$html_text));
}
// переменная для вывода новых олимпиад,прошедших или пользователей
$filter_admin = $_POST['filter_admin'];
// если существует переменная фильтра
if(isset($filter_admin)){
	// вывести необходиммые данные по фильтру
	switch ($filter_admin) {
		case 'result_olimp':
			
			$html_text = '';
			foreach (SelectEndOlimp($connect) as $row){
				$html_text.='
				<section class="item_olimp" staus_olimp="end" id="'.$row["id_olimp"].'">
	   				<img src="assets/image/olimp/'.$row["image"].'" alt="" class="photo_olimp">
	   				<p class="name_olimp">'.$row["title"].'<br>Дата: '.$row["date_start"].'</p>
	   				<p class="position">Редактировать</p>
   				</section>';
			}
			echo json_encode(array('result'=>'success','array_info'=>$html_text));
			break;
		case 'new_olimp':
			
			$html_text = '';
			foreach (SelectNewOlimp($connect) as $row){
				$html_text.='
				<section class="item_olimp" staus_olimp="new" id="'.$row["id_olimp"].'">
	   				<img src="assets/image/olimp/'.$row["image"].'" alt="" class="photo_olimp">
	   				<p class="name_olimp">'.$row["title"].'<br>Дата: '.$row["date_start"].'</p>
	   				<p class="position">Редактировать</p>
   				</section>';
			}
			echo json_encode(array('result'=>'success','array_info'=>$html_text));
			break;
		case 'user':
			$select_end_olimp = $connect->query("SELECT `id_user`, users.name as name_user, `surname`, `patronymic`, `image`, `login`, `password`, `type`, users.id_institution as user_institution,institutions.name as institution FROM `users` INNER JOIN institutions on institutions.id_institution=users.id_institution " )->fetchAll();
			$html_text = '';
			foreach ($select_end_olimp as $row){
				$html_text.='
				<section class="item_user" id_user="'.$row["id_user"].'">
	   				<img src="assets/image/photos/'.$row["image"].'" alt="" class="photo_user">
	   				<p class="fio">'.$row["name_user"]." ".$row["surname"]." ".$row["patronymic"].'</p>
	   				<p class="institution" id_institution="'.$row["user_institution"].'">'.$row["institution"].'</p>
	   				<p class="login">Логин: '.$row["login"].'</p>
	   				<p class="edit">Редактировать</p>
   				</section>';
			}
			echo json_encode(array('result'=>'success','array_info'=>$html_text));
			break;
	}

}
// переменная неободимой функции дял олимпиад
$function_olimp = $_POST['function'];
// если переменная функций существует
if(isset($function_olimp)){
	// получение необходимых данных
	$name = $_POST['name'];
	$id_select_olimp = $_POST['id_olimp'];
	$date_olimp = $_POST['date_olimp'];
	$category = $_POST['category'];
	$text = $_POST['text'];
	// отправленный файл фото
	$send_file = $_FILES['file']; 
	// куда сохранять фото
	$path =$_SERVER['DOCUMENT_ROOT'].'/assets/image/olimp/';
	$error ='';
	// Разрешенные расширения файлов.
	$allow = array('png','jpg','jpeg');
	// Запрещенные расширения файлов.
	$deny = array(
		'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
		'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
		'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
	);
	// функция обновления олимпиады или добавления новой
	if($function_olimp == "update"){
		$update_olimp = $connect->query("UPDATE `olimps` SET `title`='".$name."',`date_start`='".$date_olimp."',`id_category`=".$category.",`text`='".$text."' WHERE id_olimp=".$id_select_olimp);
	}
	elseif($function_olimp == "add"){
		$add_olimp = $connect->query("INSERT INTO `olimps`(`title`, `text`, `id_category`, `date_start`) VALUES ('".$name."','".$text."',".$category.",'".$date_olimp."')");
		$id_select_olimp = $connect->lastInsertId();
	}
	if (isset($send_file)) {
	// Проверим на ошибки загрузки.
		if (!empty($send_file['error']) || empty($send_file['tmp_name'])) {
			$error = 'Не удалось загрузить файл.';
		} elseif ($send_file['tmp_name'] == 'none' || !is_uploaded_file($send_file['tmp_name'])) {
			$error = 'Не удалось загрузить файл.';
		} else {
		// Оставляем в имени файла только буквы, цифры и некоторые символы.
			$pattern = "[^a-zа-яё0-9,~!@#%^-_\$\?\(\)\{\}\[\]\.]";
			$name = mb_eregi_replace($pattern, '-', $send_file['name']);
			$name = mb_ereg_replace('[-]+', '-', $name);
			$parts = pathinfo($name);
	 
			if (empty($name) || empty($parts['extension'])) {
				$error = 'Недопустимый тип файла';
			} elseif (!empty($allow) && !in_array(strtolower($parts['extension']), $allow)) {
				$error = 'Недопустимый тип файла';
			} elseif (!empty($deny) && in_array(strtolower($parts['extension']), $deny)) {
				$error = 'Недопустимый тип файла';
			} else {
				// Перемещаем файл в директорию.
				if (move_uploaded_file($send_file['tmp_name'], $path . $name)) {
					$update_photo = $connect->query("UPDATE `olimps` SET `image`='".$name."' WHERE id_olimp=".$id_select_olimp);
				} else {
					$error = 'Не удалось загрузить файл.';
				}
				
			}
			
		}
	}
	// если ошибок нет отправить все хорошо или отправить ошибки
	if($error == ""){
		echo json_encode(array('result'=>'success'));
	}
	else{
		echo json_encode(array('result'=>'bad','error'=>$error));
	}
}
// номер выбранной прошедшей олимпиады для админа
$id_select_end_olimp = $_POST['id_select_end_olimp'];
// если переменная не пуста
if(isset($id_select_end_olimp)){
	$array_user = array();
	$html="";
	// вывести данные об участниках олимпиады для устаовки мест
	$select_users_olimp = $connect->query('SELECT results.id_user as user,`name`,`surname`,`patronymic`,`position` FROM `results` INNER JOIN users on users.id_user=results.id_user WHERE id_olimpus='.$id_select_end_olimp)->fetchAll();
	foreach ($select_users_olimp as $row) {
		array_push($array_user,[
			'id_user'=>$row['user'],
			'fio'=>$row['name']." ".$row['surname']." ".$row['patronymic'],
			'position'=>$row['position']
		]);
		$html.="<option value='".$row['user']."'>".$row['name']." ".mb_substr($row['surname'],0,1).".".mb_substr($row['patronymic'],0,1).".</option>";
	}
	echo json_encode(array('result'=>'success','array_user'=>$array_user,"html"=>$html));
}
// номер выбранной прошедшей олимпиады
$id_select_result_olimp = $_POST['id_select_result_olimp'];
// если переменная существует
if(isset($id_select_result_olimp)){
	// записать 1,2,3 место, а остальные поставить в участник
	$first = $_POST['first_position'];
	$two = $_POST['two_position'];
	$three = $_POST['three_position'];
	$connect->query("UPDATE `results` SET `position`='Участник' WHERE `id_olimpus` =".$id_select_result_olimp);
	$connect->query("UPDATE `results` SET `position`='Первое' WHERE `id_user`=".$first." AND `id_olimpus` =".$id_select_result_olimp);
	$connect->query("UPDATE `results` SET `position`='Второе' WHERE `id_user`=".$two." AND `id_olimpus` =".$id_select_result_olimp);
	$connect->query("UPDATE `results` SET `position`='Третье' WHERE `id_user`=".$three." AND `id_olimpus` =".$id_select_result_olimp);
	echo json_encode(array('result'=>'success'));

}