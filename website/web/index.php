<?php

use mineichen\Service\LoginMysqlService;

error_reporting(E_ALL);
session_start();


require_once("../vendor/autoload.php");
$tmpl = new mineichen\SimpleTemplateEngine(__DIR__ . "/../templates/");
$pdo = new \PDO(
	"mysql:host=mariadb;dbname=app;charset=utf8",
	"root",
	"my-secret-pw",
	[PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);
$loginService = new LoginMysqlService($pdo);

switch($_SERVER["REQUEST_URI"]) {
	case "/":
		(new mineichen\Controller\IndexController($tmpl))->homepage();
		break;
	case "/login":
		$ctr = new mineichen\Controller\LoginController($tmpl, $loginService);
		if($_SERVER["REQUEST_METHOD"] == "GET") {
			$ctr->showLogin();
		} else {
			$ctr->login($_POST);
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

