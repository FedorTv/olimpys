<?php 
include("connect.php");
// вывод всех учебных заведений
function SelectInstitution($connect){
	$SelectInstitution = $connect->query("SELECT * FROM institutions")->fetchAll();
	return $SelectInstitution;
}
// вывод всех категорий
function SelectCategiries($connect){
	$SelectCategiries = $connect->query("SELECT * FROM `categories`")->fetchAll();
	return $SelectCategiries;
}
