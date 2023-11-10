<?php 

/**
* Library of the views functions
* Библиотека функций отображения
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
   
/** 
* Function of processing of data for a conclusion in a stream 
* Функция обработки данных для вывода в поток  
*/                                                     
    function htmlChars($data)    
    {    
        if(is_array($data))             
            $data = array_map("htmlChars", $data);  
        elseif(!is_null($data))               
            $data = htmlspecialchars($data); // Преобразует специальные символы в HTML-сущности 
        return $data; 
    }
/**
* Function of reading of templates
* Функция чтения шаблонов
*/  
    function getTpl($tpl)
    {
        if(file_exists(BBR_ROOT .'/skins/tpl/'. $tpl .'.tpl'))
			/* file_get_contents — Читает содержимое файла в строку */
            return file_get_contents(BBR_ROOT .'/skins/tpl/'. $tpl .'.tpl');
        else
			/* Шаблон <b>'. $tpl .'.tpl</b> отсутствует в спецификации */
            die('The template <b>'. $tpl .'.tpl</b> is absent in the specification');
    }       
    
/**
* Function of analysis of a template
* Функция разбора шаблона
*/     
    function parseTpl($cont, $data = '')
    {
        
        if(is_array($data))
        {                
            /* extract() — Импортирует переменные из массива в текущую таблицу символов */       
            extract($data, EXTR_PREFIX_ALL, 'tpl');

                ob_start();
				/* eval — Выполняет код PHP, содержащейся в строке */
                eval('?>'. $cont .'<?php ');
                $cont = ob_get_contents();  
                ob_end_clean();  
    
        }
       return $cont;
    }	
	 
/**
* Function of formation of meta-tags
* Функция формирования мета-тегов
*/
    function getMeta($tag, $page)
    {

        static $meta; 
      
        if(empty($meta) && file_exists(BBR_ROOT .'/setup/meta.txt'))
            $meta = unserialize(file_get_contents (BBR_ROOT .'/setup/meta.txt'));

        if(defined('BBR_ADMIN'))
		    return BBR_META_ADMIN;
		elseif(!empty($meta[$page][$tag]))
            return htmlspecialchars($meta[$page][$tag]);
        else
            return NULL;
    }
	
   $title       = getMeta('title', $GET['page']);  
   $keywords    = getMeta('keywords', $GET['page']);
   $description = getMeta('description', $GET['page']);
   