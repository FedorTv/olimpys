<?php 
include("connect.php");
// переменая функций
$send_function = $_POST['function'];
// функция профиль пользователя
if($send_function == "user_profile"){
	$array_profile = array();
	//добавить информацию о пользователе в массив и отправить ее обратно для вывода
	array_push($array_profile,[$check['name_user'],$check['surname'],$check['patronymic'],$check['id_institution'],$check['id_user']]);
	echo json_encode(array('result'=>'success','info'=>$array_profile));
}


//Обновление профиля
$id_user = $_POST['id_user'];
$name_user = $_POST['name_user'];
$surname_user = $_POST['surname_user'];
$patronymic_user = $_POST['patronymic_user'];
$id_institution = $_POST['institution'];
$password = $_POST['password'];
$send_file = $_FILES['file']; //отправленный файл
$path =$_SERVER['DOCUMENT_ROOT'].'/assets/image/photos/'; // куда сохранить

// Разрешенные расширения файлов.
$allow = array('png','jpg','jpeg');
// Запрещенные расширения файлов.
$deny = array(
	'phtml', 'php', 'php3', 'php4', 'php5', 'php6', 'php7', 'phps', 'cgi', 'pl', 'asp', 
	'aspx', 'shtml', 'shtm', 'htaccess', 'htpasswd', 'ini', 'log', 'sh', 'js', 'html', 
	'htm', 'css', 'sql', 'spl', 'scgi', 'fcgi', 'exe'
);
$error ='';
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
				$update_photo = $connect->query("UPDATE `users` SET `image`='".$name."' WHERE id_user=".$id_user);
			} else {
				$error = 'Не удалось загрузить файл.';
			}
			
		}
		
	}
	
}
 // если поля не пустые
if(isset($name_user) && isset($surname_user) && isset($patronymic_user)){
	 // обновить у пользователя фио
	$update_fio = $connect->query("UPDATE `users` SET `name`='".$name_user."',`surname`='".$surname_user."',`patronymic`='".$patronymic_user."' WHERE id_user=".$id_user);
	if($password != ""){
		 //обновить пароль если не пустой
		$update_pass = $connect->query("UPDATE `users` SET `password`='".$password."' WHERE id_user=".$id_user);
	}
	if (isset($id_institution)) {
		 //обновить учереждение если существует переменная
		$update_institution = $connect->query("UPDATE `users` SET `id_institution`=".$id_institution." WHERE id_user=".$id_user);
	}
	 // заного создать куки обновленного позтзователя
	$select_user = $connect->query("SELECT `id_user`,`type`,users.name as name_user,`surname`,`patronymic`,institutions.name as institution,image,users.id_institution as id_institution FROM users INNER JOIN institutions on users.id_institution=institutions.id_institution WHERE id_user=".$id_user)->fetchAll();
	foreach ($select_user as $row) {
		$arrayData = [
			'id_user' => $row['id_user'],
			'type' => $row['type'],
			'name_user' => $row['name_user'],
			'surname' => $row['surname'],
			'patronymic' => $row['patronymic'],
			'institution' => $row['institution'],
			'image' => $row['image'],
			'id_institution' => $row['id_institution'],
			
			'status' => 'auth'
		 ];
		
	}
	if(!empty($arrayData)){
		setcookie("user",serialize($arrayData), 0, "/");
	
	}
	if($error == ""){
		echo json_encode(array('result'=>'success','info'=>$arrayData,'error'=>$error));
	}
	else{
		echo json_encode(array('result'=>'bad','error'=>$error));
	}
	
}
