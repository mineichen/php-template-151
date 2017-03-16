<?php

namespace mineichen\Controller;

use mineichen\SimpleTemplateEngine;

class LoginController 
{
  /**
   * @var ihrname\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @var PDO
   */
  private $pdo;
  
  /**
   * @param ihrname\SimpleTemplateEngine
   * @param PDO
   */
  public function __construct(SimpleTemplateEngine $template, \PDO $pdo)
  {
     $this->template = $template;
     $this->pdo = $pdo;
  }
  
  public function showLogin()
  {
  	 echo $this->template->render("login.html.php");
  }
  public function login(array $data)
  {
  	if(!array_key_exists("email", $data) OR !array_key_exists("password", $data)) {
  		$this->showLogin();
  		return;
  	}
  	
  	$stmt = $this->pdo->prepare("SELECT * FROM user WHERE email=? AND password=?");
  	$stmt->bindValue(1, $data["email"]);
  	$stmt->bindValue(2, $data["password"]);
  	$stmt->execute();
  	
  	if($stmt->rowCount() === 1) {
  		$_SESSION["email"] = $data["email"];
  		header('Location: /');
  	} else {
  		echo $this->template->render("login.html.php", ["email" => $data["email"]]);
  	}
  	
  }
}
