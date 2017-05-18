<?php
namespace snoozebaumer\Service\Login;
interface LoginService
{
	public function authenticate($username, $password);
}