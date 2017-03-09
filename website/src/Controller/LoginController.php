<?php

namespace mineichen\Controller;

use mineichen\SimpleTemplateEngine;

class LoginController 
{
  /**
   * @var mineichen\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @param mineichen\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template)
  {
     $this->template = $template;
  }
  
  public function showLogin()
  {
  	 echo $this->template->render("login.html.php");
  }
}
