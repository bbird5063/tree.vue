 <?php

	/**
	 * The module of registration (functions)
	 * Модуль регистрации (функции)
	 * @author IT studio IRBIS-team
	 * @copyright © 2009 IRBIS-team
	 */
	/////////////////////////////////////////////////////////

	/**
	 * Generation of page of an error at access out of system
	 * Генерация страницы ошибки при доступе вне системы
	 */
	if (!defined('BBR_KEY')) {
		header("HTTP/1.1 404 Not Found");
		exit(file_get_contents('404.html'));
	}
	//////////////////////////////////////////////////////////

	/**  
	 * Function of generation of a casual line 
	 * Функция генерации случайной строки
	 * @param integr
	 * return string
	 */
	function randStr($num = 10)
	{
		$a = range('!', '@');
		$b = range('a', 'z');
		$c = range('A', 'Z');

		$arr = array_merge($a, $b);
		$arr = array_merge($arr, $a);
		$arr = array_merge($arr, $c);

		$key = '';
		$rand = microtime(true);

		for ($i = 0; $i < $num; $i++) {
			shuffle($a);
			$key .= $arr[(round(($rand * 1000 - floor($rand * 1000)), 2) * 100)];
			$rand = microtime(true);
		}

		return $key;
	}

	/**  
	 * Function of installation of an autologin  
	 * Функция установки автологина (когда-то при правильном вход юзер не поставил птичку "запомнить" и у него нет $_COOKIE['hash']. Но сейчас поставил птичку "запомнить")
	 * @param integr  
	 * return void  
	 */
	function setAutologin($id) /* получаем user.id, получаем новый hash, устанавливаем новые cookie, в таблице user меняем hash на новый 
	Я добавил изменение hash в $_SESSION['user_data']*/
	{
		$hash = md5(randStr() . $id);

		setcookie('hash', $hash, time() + 3600 * 24 * 30, '/');

		if (isset($_SESSION['user_data'])) // @I_CH
			$_SESSION['user_data']['hash'] = $hash;

		$res = mysqlQuery(
			"UPDATE `" . BBR_DBPREFIX . "user` 
                            SET  `hash` = '" . $hash . "'
                            WHERE `id` = " . (int)$id
		);
	}

	/**  
	 * Function of an autologin  
	 * Функция автологина (когда-то при правильном входе, юзер поставил птичку "запомнить" и у него есть $_COOKIE['hash'])
	 * @param integr  
	 * return void  
	 */
	function getLogin($hash, $activate = false)
	{
		$and = '';
		if (!$activate)
			$and = 'AND `activate` = 1';

		$res = mysqlQuery("SELECT * 
                            FROM `" . BBR_DBPREFIX . "user` 
                            WHERE `hash` = '" . escapeString($hash) . "'
                            " . $and);

		if (mysqli_num_rows($res) > 0)
			return mysqli_fetch_assoc($res);
		else
			return false;
	}
