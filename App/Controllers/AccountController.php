<?php
namespace App\Controllers;

use App\Views\AccountView;
use App\Views\LoginView;
use App\Models\UsersModel;

Class AccountController
{
	public function show(){
		$view = new AccountView();
      	$view->render();
	}

	public function showLoginForm() {
		$view = new LoginView();
		$view->render();
	}

	public function processLoginForm() {

		// Make sure the email has been provided
		// Make sure the password has been provided
		// It should also be at least 8 chars,
		// no point bugging the database with a password
		// that is obviously wrong

		// Use the Users model
		
		$id = isset($_GET['id']) ? $_GET['id'] : null;
		$user = new UsersModel();
		$result = $user->attemptLogin($id);

		// If bad then generate error messages
		$errors['login-error'] = 'Invalid credentials';

		// Show the view
		$view = new LoginView($errors);
		$view->render();



	}
	
}
