<?php

namespace App\Views;

Class HomeView extends View 
{
	public function render(){
		$page="home";
		$title = " HOME PAGE AWESOME";
		include "templates/master.inc.php";
	}

	public function content(){
		extract($this->data);
		include "templates/home.inc.php";
	}
}

