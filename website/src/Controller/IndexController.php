<?php

namespace ihrname\Controller;

use ihrname\SimpleTemplateEngine;

class IndexController 
{
  /**
   * @var ihrname\SimpleTemplateEngine Template engines to render output
   */
  private $template;
  
  /**
   * @param ihrname\SimpleTemplateEngine
   */
  public function __construct(SimpleTemplateEngine $template)
  {
     $this->template = $template;
  }

  public function showForm()
  {
    echo $this->template->render("form.html.php");
  }

  public function processForm(array $data)
  { 

    echo $this->template->render("hello.html.php", [
       'previous' => $data["text"]
    ]);
  }
  public function homepage() {
    echo "INDEX";
  }

  public function greet($name) {
  	echo $this->template->render("hello.html.php", ["name" => $name]);
  }
}
