<h1>Register new account</h1>

<form action="./?page=register.store" method="post">
	
	<div>
		<label for="email">E-Mail address: </label>

		<?php $email = isset($_POST['email']) ? $_POST['email'] : '' ?>

		<?php

		// SEE ABOVE
			// if( isset($_POST['email']) ) {
			// 	$email = $_POST['email'];
			// } else {
			// 	$email = '';
			// }

		?>
		
		<input type="email" value="<?= $email ?>" name="email" id="email">

		<span class="error">
			<?= isset($this->data['email']) ? $this->data['email'] : '' ?>
		</span>
	</div>

	<div>
		<label for="password">Password (8 characters minimum): </label>
		<input type="password" name="password" id="password">

		<?= isset($this->data['password']) ? $this->data['password'] : '' ?>
	</div>

	<div>
		<label for="password2">Confirm Password: </label>
		<input type="password" name="password2" id="password2">
	</div>

	<div>
		<input type="submit" name="register" value="Register!">
	</div>

</form>