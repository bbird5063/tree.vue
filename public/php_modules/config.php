<?php
///////////////////////////////////////////////////////////////
//                OPTIONS OF CONNECTION WITH A DB
//                  НАСТРОЙКИ СОЕДИНЕНИЯ С БД
///////////////////////////////////////////////////////////////	

/**
 * Database prefix.
 * Префикс таблиц БД.
 */
define('BBR_DBPREFIX', '');

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
define('BBR_DATABASE', 'hs');

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



define('BBR_WRITE', '');
define('BBR_NO_TEXT', '');
define('BBR_LANG_INVLID_CODE', '');
