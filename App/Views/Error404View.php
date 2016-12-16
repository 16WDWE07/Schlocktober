<?php
namespace App\Views;

Class Error404View extends View 
{
	public function render(){
		$page="Error404";
		$title = "404 - Page Not Found";
		include "templates/master.inc.php";
	}

	public function content(){
		include "templates/error404.inc.php";
	}
}