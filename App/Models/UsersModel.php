<?php

namespace App\Models;

use PDO;

Class UsersModel extends DatabaseModel
{
	protected static $tablename = 'users';
	protected static $columns = [
		'email',
		'password',
		'first_name',
		'last_name',
		'profile_image'
	];

	// Return true if E-Mail exists
	// Return false if E-Mail not found
	public function doesThisEmailExist( $email ) {

		$db = $this->getDatabaseConnection();

		$sql = "SELECT email FROM users WHERE email=:email";

		$statement = $db->prepare($sql);

		$statement->bindValue(':email', $email);

		$statement->execute();

		if( $statement->rowCount() == 1) {
			return true;
		} else {
			return false;
		}

	}

	public function saveNewUser() {

		// Get the database connection
		$db = $this->getDatabaseConnection();

		// Prepare the SQL
		$sql = "INSERT INTO users (email, password)
				VALUES (:email, :password)";

		$statement = $db->prepare($sql);

		// Bind the form data to the SQL query
		$statement->bindValue(':email', $_POST['email']);
		$statement->bindValue(':password', $_POST['password']);

		// Run the query
		$result = $statement->execute();

		// Confirm that it worked
		if( $result == true ) {
			// Yay!

			$_SESSION['user_id'] = $db->lastInsertId();
			$_SESSION['privilege'] = 'user';

			header('Location: index.php?page=account');
		} else {
			// Uh oh...

		}

		// If it did, log the user in and redirect to their 
		// new account page!

	}


	// Login functionality
	public function attemptLogin() {

		$db = $this->getDatabaseConnection();

		// Find the password of the user with a matching email
		$sql = "SELECT id, password, privilege FROM users
				WHERE email = :email  ";

		$statement = $db->prepare($sql);

		$statement->bindValue(':email', $_POST['email']);

		$statement->execute();

		$record = $statement->fetch(PDO::FETCH_ASSOC);

		// Did we get an array? (EMAIL FOUND!)
		if( is_array($record) ) {
			// Email found
			$result = password_verify( $_POST['password'] ,$record['password']);

			// If the result is good
			if( $result == true ) {
				// Log the user in and redirect to account page
				$_SESSION['user_id'] = $record['id'];
				$_SESSION['privilege'] = $record['privilege'];

				header('Location: index.php?page=account');
			} else {
				// Bad password, return false so user sees error message
				return false;
			}



		} else {
			// Email not found
			// Tell user bad credentials
			return false;
		}


	}



}


