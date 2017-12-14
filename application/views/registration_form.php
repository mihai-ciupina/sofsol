<?php
	$email = array(		'type' => 'email',		'name' => 'email_value',		'class' => 'form-control'	);
?>

<main role="main">
	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
	    <h1 class="register">Create your demo account</h1>

				<?php echo form_open('user_authentication/new_user_registration'); ?>

					<?php
						echo "<div class='error_msg'>";
						if(isset($message_display)) {
							echo $message_display;
						}
						echo "</div>";
					?>

					<div class="form-group">
						<label class="control-label" for="name">Name</label>
						<input class="form-control" id="name" name="name" type="text">
					</div>

					<div class="form-group">
						<label class="control-label" for="email">Name</label>
						<?php	echo form_input($email); ?>
					</div>

				  <div class="form-group">
				  	<div class="row">
				    	<div class="col-md-6">
								<label class="control-label" for="customer_password">Password</label>            <input class="form-control" id="customer_password" name="customer[password]" placeholder="Password" type="password">
		          </div>
		          <div class="col-md-6">
								<label class="control-label" for="customer_confirm">Confirm</label>            <input class="form-control" id="customer_password_confirmation" name="customer[password_confirmation]" placeholder="Password" type="password">
				      </div>
				    </div>
				  </div>

			  <div class="form-group"></div>

				<button class="btn btn-primary register" type="submit">Register</button>

			<?php echo form_close(); ?>
	  </div>
	</div>
</main>



<div id="main">
	<div id="login">
		<h2>Registration Form</h2>
		<?php
		echo "<div class='error_msg'>";
		echo validation_errors();
		echo "</div>";
		echo form_open('user_authentication/new_user_registration');
		echo form_label('Name: ');
		echo form_input('name');
		echo form_label('Create Username: ');
		echo form_input('username');

		echo "<div class='error_msg'>";
		if(isset($message_display)) {
			echo $message_display;
		}
		echo "</div>";

		echo form_label('Email: ');
		echo form_input($email);

		echo form_label('Password: ');
		echo form_password('password');
		echo form_submit('submit', 'Sign Up');
		echo form_close();
		?>
	</div>
</div>

<?php   ?>
<?php
	echo "<div class='error_msg'>";
	if(isset($message_display)) {
		echo $message_display;
	}
	echo "</div>";
?>
