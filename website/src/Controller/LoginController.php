<?php
namespace snoozebaumer\Controller;
use snoozebaumer\SimpleTemplateEngine;
use snoozebaumer\Service\Login\LoginService;
class LoginController
{
	/**
	 * @var snoozebaumer\SimpleTemplateEngine Template engines to render output
	 */
	private $template;

	private $loginService;
	/**
	 * @param snoozebaumer\SimpleTemplateEngine
	 * @param PDO
	 */
	public function __construct(SimpleTemplateEngine $template, LoginService $loginService)
	{
		$this->template = $template;
		$this->loginService = $loginService;
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
		 
		if($this->loginService->authenticate($data["email"], $data["password"])) {
			header('Location: /');
		} else {
			echo $this->template->render("login.html.php", [
					"email" => $data["email"]
			]);
		}
		 
	}
}