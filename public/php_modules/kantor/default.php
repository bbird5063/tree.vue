<?php

/**
* Library of the general functions
* Библиотека общих функций
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
* Function of formation of GET-parametres  
* Функция формирования GET-параметров  
*/   
   function href() 
   { 
       global $GET;   
       $tmp = $GET;    
       $href = ''; 
        
       $arg = func_get_args(); /* func_get_args — Возвращает массив, содержащий аргументы функции */
		 		
       if(is_array($arg[0]))
           $arg = $arg[0];     

       if(defined('BBR_ADMIN'))
           $href = '/admin';       
	   
	   if($arg[0] == 'host') 
           return BBR_HOST . $href; 
                     
        foreach($arg as $var)    
        { 
            $param = explode('=', $var);  
             
            if(array_key_exists($param[0], $tmp)) 
                $tmp[$param[0]] = $param[1];   
            else 
                die('The variable <b>'. $param[0] .'</b> is not defined');   
        } 
         
        foreach($tmp as $var => $val)  
           if(BBR_REWRITE == 'on')  
              $href .= '/'. $val;        
           elseif(!empty($val)) 
              $href .= '&'. $var .'='. $val; 
                   
            
       if(BBR_REWRITE == 'on') 
           return BBR_HOST . trim($href, '/'); 
       else 
           return BBR_HOST .'?'. trim($href, '&');        
   }

/**
* Function of Redirections
* Функция перенаправления
*/     
   function reDirect()
   {  
        $arguments = func_get_args(); /* func_get_args — Возвращает массив, содержащий аргументы функции. Хотя они в самой функции не определены, но определены при вызове. Пример: reDirect('reg=register', 'rem=read'). href() делает ссылку из этих параметров. Пример: "http://www.irbis_guest_sqli.bbr/register/read/0/0" */
        
        if(count($arguments))
        {                            
            header('location: '. href($arguments));
            exit();
        }
        else
        {
            header('location: '. str_replace("/index.php", "", $_SERVER['HTTP_REFERER'])); /* str_replace заменяет "/index.php" на "" в $_SERVER['HTTP_REFERER'] (предыдущий адрес) */
            exit();
        }        
   } 


/**
* Information conclusion
* Вывод информации        
*/  
    function getInfo($info, $sep='<br>')
    {
        if(count($info))
            //return $sep . implode($sep, $info);
            return implode($sep, $info);
        else
            return '&nbsp;';
    }    
   
	    
/**
* Active links
* Активные ссылки        
*/    
    function active($page)
    {
       global $GET;
	    if($GET['page'] == $page)
            return 'class="active"';
    }     
   
/**
* Return of checkbocses   
* Возврат чекбоксов
*/
    function returnCheck($id, $return)
    {
       return ($id == $return)?'checked="checked"':NULL;
    }  
   
