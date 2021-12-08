$(document).ready(function(){

	$(".content_new_olimp .filter").change(function(){  // филтер новых олимпиад
		var filter_id = $(this).val();  // айди фильтра
   		$.ajax({  // аджакс запрос 
			url: 'assets/php/functions/olimp_functions.php',  // путь к файлу
			method: 'post',  // метод отправки данных
			dataType: 'json',  // тип данных
			data: {"filter_new_id": filter_id },  //переменные
			success: function(data){  // результат запроса
				if(data.result == "success"){
					$(".content_new_olimp .items").empty();  // отчистка олимпиад
					$(".content_new_olimp .items").html(data.array_info);  // вывод по фильтру
				}
		}
		});
	});
	$(".content_end_olimp .filter").change(function(){  // фильтр прошедших олимпиад
		var filter_id = $(this).val();
   		$.ajax({  // аджакс запрос
			url: 'assets/php/functions/olimp_functions.php',  // путь к файлу
			method: 'post', // метод отравки
			dataType: 'json',	 // типо данных
			data: {"filter_end_id": filter_id },  // переменные
			success: function(data){  // результат запроса
				if(data.result == "success"){
					$(".content_end_olimp .items").empty();  // очистка олимпиад
					$(".content_end_olimp .items").html(data.array_info);  // вывод по фильтру
				}
		}
		});
	});
	$(".model_new_olimp_info .enter").click(function(){  // запись на олимпиаду
		var status = $(this).attr("status");  // авторизация пользователя
		if(status == "auth"){  // если пользователь авторизован
			var id_olimp = $(".model_new_olimp_info .content").attr("id_olimp");  // номер олимпиады
			$.ajax({  // аджакс запрос
			url: 'assets/php/functions/olimp_functions.php',  // путь к файлу
			method: 'post',  // метод отправки
			dataType: 'json',  // тип данных
			data: {"id_record_olimp": id_olimp},  // переменные
			success: function(data){  // результат запроса
				if(data.result == "success"){ 
					alert("Вы записанны на олимпиаду");  //все прошло хорошо
				}
				else{
					alert("Вы уже записанны на эту олимпиаду");  // если уже записан
				}
			}
			});
		}
		else{
			alert("Необходима авторизация для записи");  // если не авторизован
		}
		

	});

});