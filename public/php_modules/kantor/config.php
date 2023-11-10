<?php

/**
 * Configuration file
 * Конфигурационный файл
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
	exit(file_get_contents('./404.html'));
}

///////////////////////////////////////////////////////////////
//                THE GENERAL OPTIONS
//                  ОбЩИЕ НАСТРОЙКИ
///////////////////////////////////////////////////////////////
/**
 * Logins and passwords for an input in the administrator-panel
 * Логины и пароли для входа в админ-панель
 */
$admins = array('root'   => 'e10adc3949ba59abbe56e057f20f883e'); // 'root' => md5('123456');                    
/**
 * include_onces mod rewrite
 * Включает модуль перенаправления 

при этом в .htaccess - строки
...
RewriteEngine    on
...
 */
define('BBR_REWRITE', 'on');
/** 
 * Choice of language of a site 
 * Выбор языка сайта 
 */
define('BBR_LANGUAGE', 'ru');

/**     
 * Quantity of posts on page  
 * Количество постов на странице   
 */
define('BBR_NUM_POSTS', 5);

///////////////////////////////////////////////////////////////
//                OPTIONS OF CONNECTION WITH A DB
//                  НАСТРОЙКИ СОЕДИНЕНИЯ С БД
///////////////////////////////////////////////////////////////	

/**
 * Database prefix.
 * Префикс таблиц БД.
 */
define('BBR_DBPREFIX', 'irbis_');

/**
 * Database server.
 * Сервер БД.
 */
define('BBR_DBSERVER', 'localhost');

/**
 * Database user.
 * Пользователь БД
 */
define('BBR_DBUSER', 'root');

/**
 * Database password.
 * Пароль БД
 */
define('BBR_DBPASSWORD', '');

/**
 * Database name.
 * Название базы
 */
//define('BBR_DATABASE', 'homesystem'); 	
define('BBR_DATABASE', 'hs2');

///////////////////////////////////////////////////////////////
//                       NOT TO CHANGE
//                        НЕ ИЗМЕНЯТЬ
///////////////////////////////////////////////////////////////  


/**
 * Establishes a path to a script root for HTTP
 * Устанавливает путь до корневой директории скрипта
 * по протоколу HTTP
 */
define('BBR_HOST', 'http://' . $_SERVER['HTTP_HOST'] . '/');

/**
 * Establishes a physical path to a root directory of a script
 * Устанавливает физический путь до корневой директории скрипта
 */
define('BBR_ROOT', str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/');
/**
 * Salt 
 * Соль пароля 
 */
define('BBR_SALT', 'HAS3#GHBX@HJI5');

/**     
 * The Support E-mail  
 * E-mail техподдержки  
 */
define('BBR_SUPPORT_EMAIL', 'oxxi.work@gmail.com');

/** 
 * 
 * Включение нового интерфейса входа/регистрации 
 */
define('BBR_NEW_REGISTER', 'on');

define("BBR_NO_CONNECT", "В настоящий момент сервер базы данных не доступен, поэтому корректное отображение страницы невозможно.");
define("BBR_NO_DB_SELECT", "В настоящий момент база данных не доступна, поэтому корректное отображение страницы невозможно.");

define('BBR_WRITE', '');
define('BBR_NO_TEXT', '');
define('BBR_LANG_INVLID_CODE', '');
