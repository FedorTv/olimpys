$(document).ready(function(){
	var array_position;
	//Профиль пользователь
	$(".nav .enter_profile").click(function(){  // открытие страницы профиля
		$("div[condition='active']").attr("condition","disabled");
		$("div.content_lk_user").attr("condition","active");
		$("div.content_lk_admin").attr("condition","active");
		$("div[condition='active']").css("display","grid");
		$("div[condition='disabled']").css("display","none");
	});	
	$(".content_lk_user .update_profile").click(function(){  // обновление профиля
		$(".modal_window").css("display","grid");
		$(".modal_window .update_user").css("display","grid");
		$.ajax({  // аджакс запрос
			url: 'assets/php/functions/profile_function.php',  // путь к файлу
			method: 'post',  // метод отправки
			dataType: 'json',  // тип данных
			data: {"function": "user_profile" },  //переменные
			success: function(data){
				if(data.result == "success"){  // вставка в поля полученных данных
					$(".modal_window .update_user").attr("id_user",data.info[0][4]);
					$(".modal_window .update_user .name_user").val(data.info[0][0]);
					$(".modal_window .update_user .surname_user").val(data.info[0][1]);
					$(".modal_window .update_user .patronymic_user").val(data.info[0][2]);
					$(".modal_window .update_user .institution").val(data.info[0][3]);
				}
		}
		});

	});	
	$(".update_user .save").click(function(){  // сохранение изменений
		 // получение вех данных
		var name_user = $(".modal_window .update_user .name_user").val();
		var surname_user = $(".modal_window .update_user .surname_user").val();
		var patronymic_user = $(".modal_window .update_user .patronymic_user").val();
		var institution = $(".modal_window .update_user .institution").val();
		var password = $(".modal_window .update_user .password").val();
		var id_user = $(".modal_window .update_user ").attr("id_user");
		var formData = new FormData();  // создание нового массива формы
		if(name_user != "" && surname_user != "" && patronymic_user != ""){  // проверка полей на пустоту
			formData.append('file', $("#upload_photo")[0].files[0]);  // внесение всех данных в массив формы
			
			formData.append('name_user',name_user);
			formData.append('surname_user',surname_user);
			formData.append('patronymic_user',patronymic_user);
			formData.append('institution',institution);
			formData.append('password',password);
			formData.append('id_user',id_user);
			$.ajax({  // аджакс запрос
				type: "POST",  // метод отправки
				url: 'assets/php/functions/profile_function.php',  // путь к файлу
				cache: false,  // кэш
				contentType: false,  // тип контента
				processData: false,  // данные
				data: formData,  // переменные
				dataType : 'json',  // тип данных
				success: function(data){
					if (data.result == 'success') {  // если все прошло хорошо
						
						alert("Профиль обновлен");
						location.reload();  // обновить страницу
					} else {
						alert(data.error);  // вывод ошибок
					}
				}
			});
		}
	});
	$(".content_lk_user .result_olimp").change(function(){  // результаты олимпиад
		var filter_id = $(this).val();
   		$.ajax({
			url: 'assets/php/functions/olimp_functions.php',
			method: 'post',
			dataType: 'json',
			data: {"filter_user": filter_id },
			success: function(data){
				if(data.result == "success"){
					 $(".content_lk_user .info_olimp .items").empty();  // удаление всех олимпиад
					  $(".content_lk_user .info_olimp .items").html(data.array_info);  // вывод прошедших олимпиад
				}
		}
		});
	});
	
	$(".content_lk_user .items").on("click",".item[staus_olimp='end']",function(){  // вывод модального окна прошедшей олимпиады
		$(".model_end_olimp_info").css("display","grid");
		var id_end_olimp = $(this).attr("id");  // номер олимпиады
		$.ajax({
			url: 'assets/php/functions/olimp_functions.php',
			method: 'post',
			dataType: 'json',
			data: {"id_end_olimp": id_end_olimp },
			success: function(data){
				if(data.result == "success"){
					if(data.position.length == 3){  // если пришло 3 частника вывести их данные в нужные элементы
						$(".position .first .user_name").text(data.position[0]['fio']);
						$(".position .first .institution").text(data.position[0]['institutions']);
						$(".position .two .user_name").text(data.position[1]['fio']);
						$(".position .two .institution").text(data.position[1]['institutions']);
						$(".position .three .user_name").text(data.position[2]['fio']);
						$(".position .three .institution").text(data.position[2]['institutions']);
						$(".model_end_olimp_info .title").text(data.array_info[0][1]);
					} 
					else{ // если участников меньше 3 то не выводить ничего
						$(".position .first .user_name").text("");
						$(".position .first .institution").text("");
						$(".position .two .user_name").text("");
						$(".position .two .institution").text("");
						$(".position .three .user_name").text("");
						$(".position .three .institution").text("");
						$(".model_end_olimp_info .title").text("");
					} 
					 // вывод информации об олимпиаде
					$(".model_end_olimp_info .title").text(data.array_info[0][1]);
					$(".model_end_olimp_info .olimp_photo").attr("src","assets/image/olimp/"+data.array_info[0][2]);
					$(".model_end_olimp_info .about_olimp").text(data.array_info[0][3]);
				}
		}
		});
	});
	$(".content_lk_user .items").on("click",".item[staus_olimp='new']",function(){  // новые олимпиады
		$(".model_new_olimp_info").css("display","grid"); // показать модальное окно
		var id_new_olimp = $(this).attr("id");  // номер олимпиады
		$.ajax({
			url: 'assets/php/functions/olimp_functions.php',  // путь к файлу функций
			method: 'post',  // метод отправки
			dataType: 'json',  // тип данных
			data: {"id_new_olimp": id_new_olimp },  // переменные
			success: function(data){
				if(data.result == "success"){
					 // информация об олимпиаде в которой вы участвуете 
					$(".model_new_olimp_info .content").attr("id_olimp",data.array_info[0][0]);
					$(".model_new_olimp_info .title").text(data.array_info[0][1]);
					$(".model_new_olimp_info .olimp_photo").attr("src","assets/image/olimp/"+data.array_info[0][2]);
					$(".model_new_olimp_info .about_olimp").text(data.array_info[0][3]);
					$(".model_new_olimp_info .date_start").text("Дата начала: "+data.array_info[0][4]);

				}
		}
		});
	});
	//
	// Профиль админ
		$(".add_olimp").click(function(){  //модальное окно на добавление олимпиады
			$(".modal_window").css("display","grid");// показать модальное окно
			$(".modal_window .update_or_add_olimp").css("display","grid"); //сделать окно добавление олимпиад видимым
			$(".update_or_add_olimp .title").text("Добавление олимпиады"); // поменять заголовок на добавление
		});	
		$(".modal_window .close").click(function(){ // закрытие модальноых окон на странице профиля 
			$(".modal_window").css("display","none"); // скрыть модальные окна, очистить поля и изменить заголовки если нужно
			$(".modal_window .update_or_add_olimp").css("display","none");
			$(".modal_window .update_or_add_olimp").attr("id_olimp","");
			$(".modal_window .update_or_add_olimp input").val("");
			$(".modal_window .update_or_add_olimp textarea").val("");
			$(".modal_window .edit_position").css("display","none");
			$(".modal_window .update_user").css("display","none");
			$(".modal_window .edit_position select").find(":not(.no_remove)").remove(); //очистить участников из поля мест

		});
		$(".content_lk_admin .items").on("click",".item_olimp[staus_olimp='end']",function(){ //открыть прошедшую олимпиаду
			$(".modal_window").css("display","grid"); // показать модальное окно
			$(".modal_window .edit_position").css("display","grid"); 
			var id_olimp =$(this).attr("id"); // получить номер олимпиады
			$.ajax({ // аджакс запрос 
				url: 'assets/php/functions/olimp_functions.php', // путь к файлу
				method: 'post',// метод отправки данных
				dataType: 'json', // тип данных
				data: {"id_select_end_olimp": id_olimp }, // переменные
				success: function(data){ // результат запроса 
					if(data.result == "success"){ // если результат положительный
						array_position = data.array_user; // перенос полученных данных в массив
						// console.log(data.array_user);
						$(".modal_window .edit_position").attr("id_olimp",id_olimp); // вставить номер олимпиады для дальнейшего взаимодействия
						$(".modal_window .edit_position select option").after(data.html);// добавить участников

						for (var i = 0; i < array_position.length; i++) { // установка участников по своим местам если есть 
							switch(array_position[i]['position']) {
							  case 'Первое':  
							    $(".modal_window .edit_position #fist").val(array_position[i]['id_user']);
							    break;

							  case 'Второе': 
							   	$(".modal_window .edit_position #two").val(array_position[i]['id_user']);
							    break;

							  case 'Третье':
							    $(".modal_window .edit_position #three").val(array_position[i]['id_user']);
							    break;
							}
						}
						
						
					}
					
					
			}
			});
		});	
		$(".modal_window .edit_position .save").click(function(){ // сохраниение установленных мест
			var first =  $(".modal_window .edit_position #fist").val();// поулчение участников и их мест
			var two =  $(".modal_window .edit_position #two").val();
			var three =  $(".modal_window .edit_position #three").val();
			var id_select_result_olimp = $(".modal_window .edit_position").attr("id_olimp");
			if(first == two || first == three || two == three){ // проверка что участники не могу занимать 2 места
				alert("Победители не могут повторяться");
			}
			else{
				$.ajax({ // отправка аджакс запроса
					url: 'assets/php/functions/olimp_functions.php', // путь к файлу
					method: 'post', // метод отправки
					dataType: 'json', // тип данных
					data: {"id_select_result_olimp": id_select_result_olimp,"first_position":first,"two_position":two,"three_position":three, },
					success: function(data){ // результат запроса
						if(data.result == "success"){ // если все хорошо или ошибка выдать сообщение 
							alert("Победители обновленны");
						}
						else{
							alert("Произошла ошибка");
						}
					}
				});
			}


		});
		$(".content_lk_admin .items").on("click",".item_olimp[staus_olimp='new']",function(){// выбор новой олимпиады для редактирования
			$(".modal_window").css("display","grid");
			$(".modal_window .update_or_add_olimp").css("display","grid");
			$(".update_or_add_olimp .title").text("Редактирование олимпиады"); // установить заголовок
			var id_olimp =$(this).attr("id"); // получить номер олимпиады
			$.ajax({
				url: 'assets/php/functions/olimp_functions.php', // путь к файлу
				method: 'post', // метод отпраки данных
				dataType: 'json', // тип данных
				data: {"id_new_olimp": id_olimp }, // переменные
				success: function(data){ // результат запроса
					if(data.result == "success"){
						// заполнение элементов полученными данными
						$(".update_or_add_olimp").attr("id_olimp",id_olimp);
						$(".update_or_add_olimp .name_olimp").val(data.array_info[0][1]);
						$(".update_or_add_olimp .date_olimp").val(data.array_info[0][4]);
						$(".update_or_add_olimp .category").val(data.array_info[0][5]);
						$(".update_or_add_olimp .about_text").val(data.array_info[0][3]);
					}
			}
			});

		});	
		$(".update_or_add_olimp .save").click(function(){ // сохранение обновленной олимпиады 
			var id_olimp = $(".update_or_add_olimp").attr('id_olimp');// получение всех переменных
			var name = $(".update_or_add_olimp .name_olimp").val();
			var date_olimp = $(".update_or_add_olimp .date_olimp").val();
			var category = $(".update_or_add_olimp .category").val();
			var text = $(".update_or_add_olimp .about_text").val();
			var formData = new FormData();
			if(id_olimp != "" && name != "" && date_olimp != "" && category != "" && text != "" && id_olimp != ""){ //проверка переменных на пустоту
				formData.append('file', $("#upload_photo_olimp")[0].files[0]); // внесение их в массив формы
				formData.append('id_olimp',id_olimp);
				formData.append('name',name);
				formData.append('date_olimp',date_olimp);
				formData.append('category',category);
				formData.append('text',text);
				formData.append('function',"update");
				
				$.ajax({ // аджакс запрос
					type: "POST",//метод отправки
					url: 'assets/php/functions/olimp_functions.php', // путь к файлу
					cache: false, // кэш
					contentType: false, // тип контента
					processData: false,
					data: formData, // переменные
					dataType : 'json', // тип данных
					success: function(data){
						if (data.result == 'success') { // если все без ошибок вывести сообщение и обновить страницу
							alert("Олимпиада обновлена");
							location.reload();
						} else {
							alert(data.error);
						}
					}
				});
			}
			if(id_olimp == "" && name != "" && date_olimp != "" && category != "" && text != ""){ // если нет номера олимпиады выполнить добавление в базу данных
				formData.append('file', $("#upload_photo_olimp")[0].files[0]); // добавление переменных в массив формы
				formData.append('name',name);
				formData.append('date_olimp',date_olimp);
				formData.append('category',category);
				formData.append('text',text);
				formData.append('function',"add"); // отпрака данных что функция будет добавление
				$.ajax({ // аджакс запрос
					type: "POST",  // метод отпракви данных
					url: 'assets/php/functions/olimp_functions.php', //  путь к файлу
					cache: false, // кэш
					contentType: false, // тип контента
					processData: false, 
					data: formData, //  переменная
					dataType : 'json', //  тип данных
					success: function(data){ // результат запроса
						if (data.result == 'success') { //  если все хорошо вывести сообщение и обновить страницу
							alert("Олимпиада добавленна");
							location.reload();
						} else {
							alert(data.error);
						}
					}
				});
			}
			
		});
		$(".content_lk_admin .items").on("click",".item_user",function(){ // модальное окно для редактирования пользователя
			$(".modal_window").css("display","grid");
			$(".modal_window .update_user").css("display","grid");
			
		});	
		
		$(".content_lk_admin .update_profile").click(function(){ //  модальное окно обнавление профиля админа
			$(".modal_window").css("display","grid");
			$(".modal_window .update_user").css("display","grid");
			$.ajax({ //  аджакс запрос на получение данных админа и вставка их в необходимые поля
				url: 'assets/php/functions/profile_function.php',
				method: 'post',
				dataType: 'json',
				data: {"function": "user_profile" },
				success: function(data){
					if(data.result == "success"){
						$(".modal_window .update_user").attr("id_user",data.info[0][4]);
						$(".modal_window .update_user .name_user").val(data.info[0][0]);
						$(".modal_window .update_user .surname_user").val(data.info[0][1]);
						$(".modal_window .update_user .patronymic_user").val(data.info[0][2]);
						$(".modal_window .update_user .institution").val(data.info[0][3]);
					}
			}
			});
		});	
		$(".content_lk_admin .result_olimp").change(function(){ //  вывод еонтетна по фильтру
			var filter_id = $(this).val(); //  номер фильтра
			
	  		 		$.ajax({ //  аджакс запрос
				url: 'assets/php/functions/olimp_functions.php', //  путь к файлу
				method: 'post', //  метод отправки данных
				dataType: 'json', //  тип данных
				data: {"filter_admin": filter_id }, //  переменные
				success: function(data){ //  результат запроса
					if(data.result == "success"){ // если все хорошо очистить все итемы и вставить html код который пришел в ответе
						$(".info_olimp .items").empty();
						$(".info_olimp .items").html(data.array_info);
					}
			}
			});
		});
	//

});