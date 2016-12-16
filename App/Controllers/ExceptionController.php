<?php
namespace App\Controllers;

use App\Views\Error404View;

Class ExceptionController
{
	public function error404(){
		$view = new Error404View();
     	$view->render();
	}
}