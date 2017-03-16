<?php

error_reporting(E_ALL);

require_once("../vendor/autoload.php");
$tmpl = new mineichen\SimpleTemplateEngine(__DIR__ . "/../templates/");

switch($_SERVER["REQUEST_URI"]) {
	case "/":
		(new mineichen\Controller\IndexController($tmpl))->homepage();
		break;
	case "/login":
		$ctr = new mineichen\Controller\LoginController($tmpl);
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$ctr->showLogin();
		} else {
			$ctr->login();
		}
		break;
	default:
		$matches = [];
		if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			(new mineichen\Controller\IndexController($tmpl))->greet($matches[1]);
			break;
		}
		echo "Not Found";
}

