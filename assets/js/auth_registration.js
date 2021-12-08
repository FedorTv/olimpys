$(document).ready(function(){
	// авторизация
	$(".form .authorization .enter").click(function(){
		// получения данных из полей формы
		var login = $(".form .authorization .login").val();
		var password = $(".form .authorization .password").val();
		if(login != "" && password != ""){  //проверка полей на пустоту
			$.ajax({  //отправка аджкс запроса в файл пхп для выполнения функций
			url: 'assets/php/functions/auth_registration_functions.php',  // путь к файлу
			method: 'post',  // метод отправки данных
			dataType: 'json',  // тип данных
			data: {"login": login , "password" : password, "function": "auth"},  // какие данные отправить 
			success: function(data){  //получение результата из функции
				if(data.result == "success"){  // если все хорошо
					location.reload();  // обновить страницу
				}
				else{
					alert("Пользователь не найден или логин и пароль не верны"); // вывести ошибку авторизации
				}
			}
			});
		}
		else{
			alert("Заполните все поля");  // вывод что не все поля заполнены
		}
	});
	//регистрация 
	$(".form .registration .enter").click(function(){
		// получение полей с данными
		var login = $(".form .registration .login").val();
		var password = $(".form .registration .password").val();
		var repassword = $(".form .registration .repassword").val();
		var name = $(".form .registration .name").val();
		var surname = $(".form .registration .surname").val();
		var patronymic = $(".form .registration .patronymic").val();
		var institution = $(".form .registration .institution").val();
		// если учебное заведение не пустое
		if(institution != null){
				// если пороли совпадают
				if(repassword == password){
					// если поля данных пустые 
					if(login != "" && password != "" && repassword != "" && name != "" && surname != "" && patronymic != ""){
						$.ajax({  // аджакс запрос
						url: 'assets/php/functions/auth_registration_functions.php',  // пусть к файлу
						method: 'post',  // метод отправки данных
						dataType: 'json',  // тип данных
						data: {  // данные которые необходимо отправить
							"login": login ,
							"password" : password,
							"repassword" : repassword,
							"name" : name,
							"surname" : surname,
							"patronymic" : patronymic,
							"institution" : institution,
							"function": "registration"},
						success: function(data){  // получение результата из функции
							if(data.result == "success"){  // если все хорошо
								$("div.form .registration").css("display","none");  // скрыть форму регистрации
								$("div.form .authorization").css("display","grid");  // установить дисплей авторизации на грид
								$("div.form .registration input").val('');  // очитка полей регистрации
							}
							else{
								alert(data.error);  // вывод ошибок регистрации
							}
						}
						});
					}
					else{
						alert("Заполните все поля");  // если поля пустые вывести сообщение
					}
				}
				else{
					alert("Пароли не совпадают");  // если пароли не совпадают
				}
		}
		else{
			alert("Выберите учебное заведение");  // выбор учебного заведения
		}
		
	});
});