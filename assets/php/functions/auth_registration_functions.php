<?php 
// подключение к базе данных
include("connect.php");

// получение функции
$function = $_POST['function'];
// функция авторизации
if($function == "auth"){
	// получение переменных логина и пароля
	$login = $_POST['login'];
	$password = $_POST['password'];
	// поиск пользователя по паролю и логину и вывод его данных
	$select_user = $connect->query("SELECT `id_user`,`type`,users.name as name_user,`surname`,`patronymic`,institutions.name as institution,image,users.id_institution as id_institution FROM users INNER JOIN institutions on users.id_institution=institutions.id_institution WHERE login='{$login}' and password = '{$password}'")->fetchAll();
	// цикл для заполнения массива данных пользователя
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
	// если массив данных не пуст
	if(!empty($arrayData)){
		// создать куки с данными
		setcookie("user",serialize($arrayData), 0, "/");
		// отправить запрос в js что все хорошо
		echo json_encode(array('result'=>'success'));
	}
	else{
		// отправить запрос в js что все плохо и вывести сообщение
		echo json_encode(array('result'=>'bad'));
	}
}
// функция выхода
if($function == "exit"){
	// удалить куки
	unset($_COOKIE['user']);
	setcookie('user', null, -1, '/');
	// отправить запрос что все хорошо
	echo json_encode(array('result'=>'success'));
}
// функция регистрации
if($function == "registration"){
	// получение всех необходиммых переменных
	$login = $_POST['login'];
	$password = $_POST['password'];
	$repassword = $_POST['repassword'];
	$name = $_POST['name'];
	$surname = $_POST['surname'];
	$patronymic = $_POST['patronymic'];
	$institution = $_POST['institution'];
	// переменная для ошибок
	$error = "";
	// проверка на существование логина
	$select_all_user = $connect->query("SELECT `login` FROM users")->fetchAll();
	// если существует переменная и такой логин есть добавить ошибку что логин занят
	if(isset($select_all_user)){
		foreach ($select_all_user as $row) {
			if($row['login']==$login){
				$error = "Такой логин существует";
			}
		}
	}
	// если ошибок нет 
	if($error == ""){
		// добавить пользоватля в базу данных
		$sql = 'INSERT INTO `users`(`name`, `surname`, `patronymic`, `login`, `password`, `id_institution`) VALUES ("'.$name.'","'.$surname.'","'.$patronymic.'","'.$login.'","'.$password.'",'.intval($institution).')';
		$new_user = $connect->query($sql);
		// отправка запроса что все хорошо
		echo json_encode(array('result'=>'success'));
	}
	else{
		// если есть огибки отправить их для вывода
		echo json_encode(array('result'=>'bad','error'=>$error));
	}
	
	
}

