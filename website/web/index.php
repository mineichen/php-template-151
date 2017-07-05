<?php

error_reporting(E_ALL);

require_once("../vendor/autoload.php");
$tmpl = new ihrname\SimpleTemplateEngine(__DIR__ . "/../templates/");

switch($_SERVER["REQUEST_URI"]) {
        case "/":
		(new ihrname\Controller\IndexController($tmpl))->homepage();
		break;
        case "/form":
                
                $ctr = (new ihrname\Controller\IndexController($tmpl));
	        $ctr->showForm();
		break;	
       case "/formpost":
                $ctr = (new ihrname\Controller\IndexController($tmpl));
                $ctr->processForm($_POST);
		
                break;
	case "/test/upload":
		if(file_put_contents(__DIR__ . "/../../upload/test.txt", "Mein erster Upload")) {
			echo "It worked";
		} else {
			echo "Error happened";
		}
		break;
	default:
		$matches = [];
		if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			(new ihrname\Controller\IndexController($tmpl))->greet($matches[1]);
			break;
		}
		echo "Not Found";
}

