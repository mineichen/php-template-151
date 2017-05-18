<?php

namespace mineichen\Service\Login;

interface LoginServiceInterface 
{
    public function authenticate($username, $password);
}
