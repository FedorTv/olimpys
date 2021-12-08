<?php 
include("connect.php");
// переменная выбранной айди новости
$id_news = $_POST['id_new'];
// вывод 3 свежих новостей
function SelectFreshNews($connect){
	$select_fresh_new = $connect->query("SELECT * FROM news ORDER BY data_publisher LIMIT 3")->fetchAll();
	return $select_fresh_new;
}
// вывод всех новостей
function SelectAllNews($connect){
	$select_all_new = $connect->query("SELECT * FROM news ORDER BY data_publisher")->fetchAll();
	return $select_all_new;
}
// вывод определенной новости
function SelectNewFromId($connect,$id){
	$select_new_from_id = $connect->query("SELECT * FROM news WHERE id_new=".$id)->fetchAll();
	return $select_new_from_id;
}
// если не пустая переменная выбранной новости вывести ее и отправить данные для вставки на страницу
if(!empty($id_news)){
	foreach (SelectNewFromId($connect,$id_news) as $row) {
	echo json_encode(array('result'=>'success','title'=>$row['title'],'img'=>$row['image'],'text'=>$row['text'],'data_publisher'=>$row['data_publisher']));
	}
}
