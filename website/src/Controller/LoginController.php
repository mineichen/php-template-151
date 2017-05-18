<?php

namespace mineichen\Controller;

use mineichen\SimpleTemplateEngine;
use mineichen\Service\Login\LoginServiceInterface;

class LoginController 
{
  /**
   * @var ihrname\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @var \PDO Database connection
   */
  private $pdo;
 
  private $loginService;
 
  /**
   * @param ihrname\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template, \PDO $pdo, LoginServiceInterface $loginService)
  {
     $this->template = $template;
     $this->pdo = $pdo;
     $this->loginService = $loginService;  
  }
  
  public function showLogin()
  {
  	echo $this->template->render("login.html.php");
  }
  
  public function login(array $data)
  {
  	if(!array_key_exists("email", $data) OR !array_key_exists("password", $data)) {
  		echo $this->template->render("login.html.php");
  	} else {
  		$stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
  		$stmt->bindValue(1, $data["email"]);
  		$stmt->bindValue(2, $data["password"]);
  		$stmt->execute();
  		
  		if($stmt->rowCount() == 1) {
  			$_SESSION["email"] = $data["email"];
  			header('Location: /');
  		} else {
  			echo $this->template->render("login.html.php");
  		}
  	}
  }
}
