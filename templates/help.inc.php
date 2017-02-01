<form action="./?page=sendLink" method="post">
	
	Enter your Registered Email so that we can send you the link to change password: 
	<br>
	<input type="email" name="email" id="email">

	<button>Submit</button>
	<p class="error">
			<?= isset($this->data['email']) ? $this->data['email'] : '' ?>
	</p>
	

</form>