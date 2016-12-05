<?php
namespace App\Controllers;

use App\Views\RegisterView;
use App\Models\UsersModel;

Class RegisterController
{
	public function show(){
		$view = new RegisterView();
      	$view->render();
	}

	public function store() {

		// Prepare a container to hold all the error messages
		$errors = [];

		// Validate the form
		// Each field has been filled out

		// Email pattern
		$emailPattern = '/^[a-zA-Z0-9_\-.]{1,100}@[a-zA-Z0-9_\-.]{1,100}\.[a-zA-Z.]{1,100}$/';


		if( preg_match($emailPattern, $_POST['email']) ) {
			// Check database
			// die('Email good, check database');

			// Look the email in database
			$user = new UsersModel();

			$result = $user->doesThisEmailExist( $_POST['email'] );

			// If the result is true
			if( $result == true ) {
				// Oops, this E-Mail is in use
				$errors['email'] = 'Email in use';
			}


		} else {
			// Generate error message
			$errors['email'] = 'Please enter a valid E-Mail address';
			
		}


		// Passwords match and are at least 8 characters long
		if( strlen($_POST['password']) == 0 ) {
			// Password has not been provided
			$errors['password'] = 'Required';
		} elseif( strlen($_POST['password']) < 8 ) {
			$errors['password'] = 'Must be at least 8 characters';
		} elseif( $_POST['password'] != $_POST['password2'] ) {
			$errors['password'] = 'Passwords do not match';
		}




		// If validation failed
		if( count($errors) > 0 ) {
			// Oh dear, errors.
			$view = new RegisterView($errors);
      		$view->render();
      		return;
		}

		// If everything is good to go:
		// echo '<pre>';
		// print_r($_POST);

		// Hash the password (don't save it plain text)
		$_POST['password'] = password_hash($_POST['password'], PASSWORD_BCRYPT);

		// Insert new user into database
		$newUser = new UsersModel();
		$newUser->saveNewUser();

		// Log them in automatically (because we're nice)

		// Redirect to account page



	}

	 

	
}
