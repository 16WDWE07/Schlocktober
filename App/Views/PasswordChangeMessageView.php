<?php
namespace App\Views;

Class PasswordChangeMessageView extends View 
{
	public function render(){
		$page="passwordChangeMessage";
		$title = " Password Change";
		include "templates/master.inc.php";
	}

	public function content(){
		include "templates/passwordchangemessage.inc.php";
	}
}