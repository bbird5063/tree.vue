<?php

/**
* Library of functions for work from DB MySQL
* Библиотека функций для работы с БД MySQL
* @author IT studio IRBIS-team
* @copyright © 2009 IRBIS-team
*/
/////////////////////////////////////////////////////////
/**
* Generation of page of an error at access out of system
* Генерация страницы ошибки при доступе вне системы
*/
    if(!defined('BBR_KEY'))
    {
       header("HTTP/1.1 404 Not Found");      
       exit(file_get_contents('../404.html'));
    }        
/////////////////////////////////////////////////////////
/**  
* Function of processing of literal constants for SQL
* Функция обработки литеральных констант для SQL 
*/   
  function escapeString($data)   
  {
       
    if(is_array($data))
      $data = array_map("escapeString", $data); /* применяет фукцию "escapeString" ко всем элементам массива */
    else              
      $data = mysqli_real_escape_string($_SESSION['db_connect'], $data); /* mysql_real_escape_string (mysqli_real_escape_string) — Экранирует специальные символы в строках для использования в выражениях SQL */
          
    return $data;
  }
/** 
* Function for inquiry to DB MySQL. $_SESSION['db_connect']->close();
* Функция для запроса к БД MySQL. 
*/ 
    function mysqlQuery($sql, $print = false) 
    { 
        $result = mysqli_query($_SESSION['db_connect'], $sql); 

        if($result === false || $print) 
        { 
         
            $error =  mysqli_error($_SESSION['db_connect']); 
            $trace =  debug_backtrace(); 
            
            $head = $error ?'<b style="color:red">MySQL error: </b><br> 
            <b style="color:green">'. $error .'</b><br><br>':NULL;     
             
            $error_log = date("Y-m-d h:i:s") .' '. $head .' 
            <b>Query: </b><br> 
            <pre><span style="color:#CC0000">'. $trace[0]['args'][0] .'</pre></span><br><br>  
            <b>File: </b><b style="color:#660099">'. $trace[0]['file'] .'</b><br> 
            <b>Line: </b><b style="color:#660099">'. $trace[0]['line'] .'</b>'; 
             
/** 
* @TODO To clean in release 
*/ 
//----------------------------- 
           die($error_log); 
//----------------------------- 

            file_put_contents(BBR_ROOT .'log/mysql.log', strip_tags($error_log) ."\n\n", FILE_APPEND); 
            header("HTTP/1.1 404 Not Found"); 
            die(file_get_contents(BBR_ROOT .'/404.html')); 
        } 
        else 
            return $result; 
    } 





/**   
* Connection and installation of chaeset of connection 
* Подключение и установка кодировок соединения  
*/     
    /* Нужна глобальная переменная, я не константа. Потому что myaql это ссылка, в myaqli это объект: 
    $_SESSION[db_connect] => mysqli Object
        (
            [affected_rows] => 2
            [client_info] => mysqlnd 8.1.2
			...
	*/
	
    //define('BBR_CONNECT', $db_irbis);  
	
	$_SESSION['db_connect'] = mysqli_connect( BBR_DBSERVER, BBR_DBUSER, BBR_DBPASSWORD ) or die(BBR_NO_CONNECT);  

  
    mysqli_select_db( $_SESSION['db_connect'], BBR_DATABASE)or die(BBR_NO_DB_SELECT);  
      
    mysqlQuery('SET NAMES utf8');          
    mysqlQuery('SET CHARACTER SET utf8');  
    mysqlQuery('SET COLLATION_CONNECTION="utf8_general_ci"');
