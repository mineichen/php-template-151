<?php

error_reporting(E_ALL);
session_start();


require_once("../vendor/autoload.php");
$factory = mineichen\Factory::createFromIniFile(__DIR__ . "/../config.ini");

switch($_SERVER["REQUEST_URI"]) {
	case "/":
		$factory->getIndexController()->homepage();
		break;
	case "/login":
		$cnt = $factory->getLoginController();
		if($_SERVER["REQUEST_METHOD"] === "GET") {
			$cnt->showLogin();
		} else {
			$cnt->login($_POST);
		}
		break;
	default:
		$matches = [];
		if(preg_match("|^/hello/(.+)$|", $_SERVER["REQUEST_URI"], $matches)) {
			$factory->getIndexController()->greet($matches[1]);
			break;
		}
		echo "Not Found";
}

