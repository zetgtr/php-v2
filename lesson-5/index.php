<?php
spl_autoload_register(function($name){
    $dirs = ["c","m"];
	$file = $name.".php";
	foreach($dirs as $dir){
        $path = $dir."/".$file;
        if(is_file($path)){
            include_once($path);
            return;
        }
    }
    die('Клас не найден');
});

$action = 'action_';
$action .=(isset($_GET['act'])) ? $_GET['act'] : 'index';


switch ($_GET['c'])
{
    case 'sign':
        $controller = new C_User();
        break;
    default:
        $controller = new C_Page();
}


if($_GET['m']){
    switch ($_GET['m'])
    {
        case 'file':
            $controller = new M_File();
            break;
        default:
            $controller = new M_Metod();
    }
}


$controller->Request($action);