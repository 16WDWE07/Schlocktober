<?php
namespace App\Controllers;

use App\Views\HelpView;
use App\Models\UsersModel;
use App\Views\PasswordChangeMessageView;

Class HelpController
{
	public function help(){
		$view = new HelpView();
     	$view->render();
	}
	public function sendLink(){
		
		// Prepare a container to hold all the error messages
		$errors = [];
		$email = $_POST['email'];

		// Validate the form
		// Each field has been filled out

		// Email pattern
		$emailPattern = '/^[a-zA-Z0-9_\-.]{1,100}@[a-zA-Z0-9_\-.]{1,100}\.[a-zA-Z.]{1,100}$/';


		if( preg_match($emailPattern, $email) ) {
			// Check database
			// die('Email good, check database');

			// Look the email in database
			$user = new UsersModel();

			$result = $user->doesThisEmailExist( $email );

			// If the result is true
			if( $result == true ) {
				// Provide the user a message
				header("Location:./?page=passwordChangeMessage");

				$view = new PasswordChangeEmailView(compact('email'));
      			$view->render();
			} else {
				// Generate error message
				$errors['email'] = 'Please register for an account.';
			}


		} else {
			// Generate error message
			$errors['email'] = 'Please enter a valid E-Mail address';
			
		}
		// If validation failed
		if( count($errors) > 0 ) {
			// Oh dear, errors.
			$view = new HelpView($errors);
      		$view->render();
      		return;
		}
	}

	public function generateMessage(){
		$view = new PasswordChangeMessageView();
		$view->render();
	}
}