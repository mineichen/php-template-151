<?php
namespace ihrname\Service\Login;
interface LoginService
{
	public function authenticate($username, $password);
}