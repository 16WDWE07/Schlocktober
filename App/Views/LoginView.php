<?php

namespace App\Views;

Class LoginView extends View 
{
	public function render(){
		$page="login";
		$title = " Log in to your account";
		include "templates/master.inc.php";
	}

	public function content(){
		extract($this->data);
		include "templates/login.inc.php";
	}
}
