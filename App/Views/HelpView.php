<?php
namespace App\Views;

Class HelpView extends View 
{
	public function render(){
		$page="help";
		$title = " Change Password";
		include "templates/master.inc.php";
	}

	public function content(){
		include "templates/help.inc.php";
	}
}