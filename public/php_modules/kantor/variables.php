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
    if(!defined('BBR_KEY'))
       header('http://'. $_SERVER['HTTP_HOST']);      
/////////////////////////////////////////////////////////
    
/** 
* We kill magic inverted commas 
* Убиваем магические кавычки 
*/         
    function stripslashesDeep($data)     
    {     
        if(is_array($data))      
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
	
/**  
* Array of variables for GET-parametres  
* Массив переменных для GET-параметров  
*/  


/*
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
    $GET = array(  
                  'page' => 'income_expenses',  
                  'rem'  => 'read',  
                  'reg'  => 'off',  
                  'id'   => 0,  
                  'num'  => 0,  
                );  

/**  
* Initialization of variables GET-parametres  
* Инициализация переменных GET-параметров  
*/

//dbg($POST['value1']); 
//dbg($_POST); 
  
  
    if(BBR_REWRITE == 'on' && !empty($_GET['route']))  
    {  
        $get = explode('/', trim($_GET['route'], '/')); /* explode - Возвращает массив строк, полученных разбиением строки string с использованием separator в качестве разделителя. trim — Удаляет пробелы (или другие символы('/')) из начала и конца строки */
        $i = 0;  

        foreach($GET as $var => $val)  
        {  
            if(!empty($get[$i]))  
               $GET[$var] = $get[$i];  

            ++$i;  
        }  
    }  
    elseif(count($_GET))  
    {  
        foreach($GET as $var => $val)  
            if(!empty($_GET[$var]))  
                $GET[$var] = $_GET[$var];      
    }
	  
/**  
* Buttons  
* Кнопки  
*/   
    $ok       = !empty($_POST['ok'])?true:false;  
    $delete   = !empty($_POST['delete'])?true:false;
	       
/**  
* Initialization of variables POST  
* Инициализация переменных POST  
*/   
    $POST = array(  
														
                            'value1'           =>  '',  
                            'value2'           =>  '',        
                            'value3'           =>  '',
							'value4'           =>  '',
                            'name'             =>  '',  
                            'login'            =>  '',        
                            'email'            =>  '',
							'password'         =>  '',
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
                    
    if(!empty($_POST['form']))  
        $POST = array_merge($_POST['form'], array_diff_key($POST, $_POST['form'])); //array_merge - Сливает элементы одного или большего количества массивов таким образом, что значения одного массива присоединяются к концу предыдущего. Результатом работы функции является новый массив.  array_diff_key - Вычисляет расхождение массивов, сравнивая ключи. Возвращает массив (array), содержащий все элементы arrays ($_POST['form']) с ключами, которых нет во всех последующих массивах.

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
	$info_page_in    = '';




	
    $style_display = '';
	/*$style_display = '#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content, #user-modal-content';*/ 		


	/* не надо - будет всегда, т.к. при registr $_SESSION['last_page'] не изменяется */
   //$_SESSION['last_page'] = href('page=main', 'rem=read', 'id=0', 'num=0');



    	$for_contentIn = $style_display_arr = array(  
                  				'login'        => '#login-modal-content',  
                  				'registration' => '#signup-modal-content',  
                  				'restoration'  => '#forgot-password-modal-content',  
                  				'activate'     => '#code-modal-content',  
                  				'new_pw'       => '#password-modal-content',  
                  				'user'         => '#user-modal-content',  
                  				'exit'         => '#exit-modal-content',  
                				);  
								
								
		if (!empty($GET['reg']) && $GET['reg'] !== 'off') {
			//unset($style_display_arr[$GET['reg']]);
		}
			
		$style_display = implode(', ', $style_display_arr);
		
		
		
		/* Последний пункт главного меню (для Ajax) */
		$link_registr_out = '
			<li id="enterModal" class="active"><a href="#">' . 'Вход' . '&nbsp;&nbsp;' . '<i class="glyphicon glyphicon-log-in"></i></a>
			</li>';
			