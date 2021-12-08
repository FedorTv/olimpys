$(document).ready(function(){
	//На главную
	$(".nav .logo").click(function(){  // если клик на логин
		$("div[condition='active']").attr("condition","disabled");  // скрыть все окна и показать главный контент
		$("div.main_content").attr("condition","active");
		$("div[condition='active']").css("display","grid");
		$("div[condition='disabled']").css("display","none");
	});

	//
	//Соц сети
	$(".social img").click(function(){  // если клик был на соц сети перевести на нужную соц сеть
		var name_social = $(this).attr("name_social");
		switch(name_social){
			case "vk": window.open("https://vk.com","_blank");
			break;
			case "twitter": window.open("https://twitter.com","_blank");
			break;
			case "fb": window.open("https://www.facebook.com","_blank");
			break;
			case "youtube": window.open("https://www.youtube.com","_blank");
			break;
		}
	});
	//Регистрация и авторизация
	$(".nav .enter").click(function(){  // если надато на вход стрыть все страницы и показать форму авторизации
		$("div[condition='active']").attr("condition","disabled");
		$("div.form").attr("condition","active");
		$("div[condition='active']").css("display","grid");
		$("div[condition='disabled']").css("display","none");
	});
	$("div.form .authorization .back").click(function(){  // переход на регистрацию
		$("div.form .authorization").css("display","none");
		$("div.form .registration").css("display","grid");
	});
	$("div.form .registration .back").click(function(){  // переход на авторизацию
		$("div.form .registration").css("display","none");
		$("div.form .authorization").css("display","grid");
	});
	$("div.form .close").click(function(){  // закрытие формы
		$("div[condition='active']").attr("condition","disabled");  // скрыть все страницы и показать страницу со статусом активная
		$("div.main_content").attr("condition","active");
		$("div[condition='active']").css("display","grid");
		$("div[condition='disabled']").css("display","none");
	});
	// 
	//Выход
	$(".nav .exit").click(function(){  // выход
		$.ajax({  // аджакс запрос
			url: 'assets/php/functions/auth_registration_functions.php',  // путь к файлу
			method: 'post',  //метод отправки данных
			dataType: 'json',  // тип данных
			data: {"function": "exit"},  // функция выхода 
			success: function(data){  // получение результата
				if(data.result == "success"){
					location.reload();  // обновление страницы если все хорошо
				}
			}
			});
	});
	// 
	//Модальное окно новостей
	$(".main_content .read_new").click(function(){  // кнопка читать новость
		var id_new = $(this).parent(".item").attr("id_new");  // получение номера новости
		$(".model_news_info").css("display","grid");  // показать модальное окно
		
		$.ajax({  // аджакс запрос
			url: 'assets/php/functions/news_function.php',  //путь к файлу
			method: 'post',  // метод отправки данных
			dataType: 'json',  // тип данных 
			data: {"id_new": id_new},  // данные
			success: function(data){  // получение результата
				if(data.result == "success"){  // если все хорошо
					$(".model_news_info .title").text(data.title);  //заполнение  всех элементов данными
					$(".model_news_info .news_olimp").attr("src","assets/image/news/"+data.img);
					$(".model_news_info .text_news").text(data.text);
					$(".model_news_info .date_publisher").text("Дата публикации: "+data.data_publisher);
				}
		}
		});
	});
	$(".model_news_info .close").click(function(){  // закрытие модального окна новостей
		$(".model_news_info").css("display","none");
	});
	//
	//Прошедшие олимпиады
	$(".nav .end_olimp").click(function(){  //вкладка прошедших олимпиад
		$("div[condition='active']").attr("condition","disabled");
		$("div.content_end_olimp").attr("condition","active");
		$("div[condition='active']").css("display","grid");
		$("div[condition='disabled']").css("display","none");
	});
	$(".content_end_olimp .items").on("click",".item",function(){  // вывод необходимой олимпиады
		$(".model_end_olimp_info").css("display","grid");
		var id_end_olimp = $(this).attr("id");  // номер олимпиады
		$.ajax({
			url: 'assets/php/functions/olimp_functions.php',  
			method: 'post', 
			dataType: 'json',
			data: {"id_end_olimp": id_end_olimp },
			success: function(data){
				if(data.result == "success"){
					if(data.position.length == 3){  // если пришло 3 участиника вывести данные в необходиммые элементы
						$(".position .first .user_name").text(data.position[0]['fio']);
						$(".position .first .institution").text(data.position[0]['institutions']);
						$(".position .two .user_name").text(data.position[1]['fio']);
						$(".position .two .institution").text(data.position[1]['institutions']);
						$(".position .three .user_name").text(data.position[2]['fio']);
						$(".position .three .institution").text(data.position[2]['institutions']);
						$(".model_end_olimp_info .title").text(data.array_info[0][1]);
					}
					else{  // если меньше 3х участников данные не выводить 
						$(".position .first .user_name").text("");
						$(".position .first .institution").text("");
						$(".position .two .user_name").text("");
						$(".position .two .institution").text("");
						$(".position .three .user_name").text("");
						$(".position .three .institution").text("");
						$(".model_end_olimp_info .title").text("");
					}
					 // заполнение информации об олимпиаде
					$(".model_end_olimp_info .title").text(data.array_info[0][1]);
					$(".model_end_olimp_info .olimp_photo").attr("src","assets/image/olimp/"+data.array_info[0][2]);
					$(".model_end_olimp_info .about_olimp").text(data.array_info[0][3]);
				}
		}
		});
	});
	$(".model_end_olimp_info .close").click(function(){  // закрытие окна прошедших олимпиад
		$(".model_end_olimp_info").css("display","none");
	});

	//Новые олимпиады
	$(".nav .record_olimp").click(function(){  // открытие страницы записи на олимпиаду
		$("div[condition='active']").attr("condition","disabled");
		$("div.content_new_olimp").attr("condition","active");
		$("div[condition='active']").css("display","grid");
		$("div[condition='disabled']").css("display","none");

	});
	$(".content_new_olimp .items").on("click",".item",function(){  //открытие модального окна олимпиады
		$(".model_new_olimp_info").css("display","grid");
		var id_new_olimp = $(this).attr("id");
		$.ajax({ // аджакс запрос для вывода информации об олимпиаде
			url: 'assets/php/functions/olimp_functions.php',
			method: 'post',
			dataType: 'json',
			data: {"id_new_olimp": id_new_olimp },
			success: function(data){
				if(data.result == "success"){
					$(".model_new_olimp_info .content").attr("id_olimp",data.array_info[0][0]);
					$(".model_new_olimp_info .title").text(data.array_info[0][1]);
					$(".model_new_olimp_info .olimp_photo").attr("src","assets/image/olimp/"+data.array_info[0][2]);
					$(".model_new_olimp_info .about_olimp").text(data.array_info[0][3]);
					$(".model_new_olimp_info .date_start").text("Дата начала: "+data.array_info[0][4]);

				}
		}
		});

	});
	$(".model_new_olimp_info .close").click(function(){  // закрытие модального окна олимпиады
		$(".model_new_olimp_info").css("display","none");
	});
	//
	
});