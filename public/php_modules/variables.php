<?php
	
	/**
		* The block of initialization and processing of entering variables
		* Блок инициализации и обработки входящих переменных
		* @author IT studio IRBIS-team
		* @copyright © 2009 IRBIS-team
	*/
	/////////////////////////////////////////////////////////
	
	/**
		* Generation of page of an error at access out of system
		* Генерация страницы ошибки при доступе вне системы
	*/
	if (!defined('BBR_KEY'))
	header('http://' . $_SERVER['HTTP_HOST']);
	/////////////////////////////////////////////////////////
	
	/** 
		* We kill magic inverted commas 
		* Убиваем магические кавычки 
	*/
	function stripslashesDeep($data)
	{
		if (is_array($data))
		$data = array_map("stripslashesDeep", $data); /* Применяет callback-функцию ко всем элементам указанных массивов */
		else
		$data = stripslashes($data); /* Удаляет экранирование символов. Функцию stripslashes() можно использовать, если экранирование символов не требуется. Например, данные не вставляются в базу данных, а просто выводятся в браузер. */
		return $data;
	}
	
	//if(get_magic_quotes_gpc()) /* Она удалена, потому что удалены сами магические кавычки. Уже давно php не проставляет автоматом слешей перед кавычками/апострафами. */
	//{  
	$_GET = stripslashesDeep($_GET);
	$_POST = stripslashesDeep($_POST);
	$_COOKIE = stripslashesDeep($_COOKIE);
	//} 
	
	
	
	/*
		num=0
		При входе - запись не активирована
		Активация учетной записи
	
		num=1
		При регистрации
		Активация учетной записи
		
		num=2
		Забыл пароль
		Восстановление доступа
		
		num=3
		Уже вошел в аккаунт
		Изменение пароля
	*/
	
	$ok = !empty($_POST)?true:false; 	
	
	/**  
		* Initialization of variables POST  
		* Инициализация переменных POST (? необходимо для тех, кто не входит в $form[])
	*/
	$POST = array(

	'id'             	 =>  0,
	'name'             =>  '',
	'login'            =>  '',
	'email'            =>  '',
	'password'         =>  '',
	'password1'        =>  '',
	'password2'        =>  '',
	'code'             =>  '',
	'remember'         =>  '',
	'name_last'        =>  '',
	'name_first'       =>  '',
	'name_patr'        =>  '',
	'country'          =>  '',
	'city'             =>  '',
	'phone_1'          =>  '',
	'phone_2'          =>  '',
	'new_num'          =>  '',
	'array1'           =>  array(),
	);
	
	if (!empty($_POST['form']))
	$POST = array_merge($_POST['form'], array_diff_key($POST, $_POST['form'])); 
	/*
	array_merge - Сливает элементы одного или большего количества массивов таким образом, что значения одного массива присоединяются к концу предыдущего. Результатом работы функции является новый массив. Если входные массивы имеют одинаковые строковые ключи, тогда каждое последующее значение будет заменять предыдущее. 
	
	array_diff_key - Вычисляет расхождение массивов, сравнивая ключи. Возвращает массив ($POST), содержащий все элементы $POST с ключами, которых нет в $_POST['form'].
	
В итоге (login):
====================
post: array1: []
city: ""
code: ""
country: ""
email: ""
id: 0
login: "bbird" // отправлялся
name: ""
name_first: ""
name_last: ""
name_patr: ""
new_num: "0" // отправлялся вне массива form, приходит даже если убрать из начального $POST (потому что $POST['new_num'] = $_POST['new_num'];!!!)
password: "11111111" // отправлялся
password1: ""
password2: ""
phone_1: ""
phone_2: ""
remember: "false"	

Без начального $POST, только реально отправленные:
====================================================
login: "bbird"
new_num: "0"
password: "11111111"
remember: "false"
	
*/
	
	$POST['new_num'] = $_POST['new_num'];
	
	$url = ((!empty($_SERVER['HTTPS'])) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'];
	
	/**  
		* Other variables  
		* Другие переменные  
	*/
	$title       = '';
	$keywords    = '';
	$description = '';
	$error       = '';
	$dbError = array();
	$info        = array();
	$info_page   = array();
	
	$reg_error       = '';
	$reg_info        = array();
	$reg_info_page   = array();
	$info_in         = '';
	// $info_page_in    = '';
	
	$fail  = '';
	$error = array();
	$enter = '';