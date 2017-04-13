<?php

error_reporting(E_ALL);
session_start();

require_once("../vendor/autoload.php");
$tmpl = new mineichen\SimpleTemplateEngine(__DIR__ . "/../templates/");
$pdo = new \PDO(
	"mysql:host=mariadb;dbname=app;charset=utf8",
	"root",
	"my-secret-pw",
	[\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]
);
$loginService = new mineichen\Service\Login\LoginPdoService($pdo);

switch($_SERVER["REQUEST_URI"]) {
	case "/":
		(new mineichen\Controller\IndexController($tmpl))->homepage();
		break;
	case "/login":
		$cnt = new mineichen\Controller\LoginController($tmpl, $pdo, $loginService);
		if($_SERVER["REQUEST_METHOD"] === "GET") {
			$cnt->showLogin();
		} else {
			$cnt->login($_POST);
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

