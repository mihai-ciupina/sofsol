<?php
	$name_label = array('class' => 'control-label');
	$name = array('type' => 'text', 'id' => 'name', 'name' => 'name', 'value' => '', 'class' => 'form-control');

	$username_label = array('class' => 'control-label');
	$username = array('type' => 'text', 'id' => 'username', 'name' => 'username', 'value' => '', 'class' => 'form-control');

	$email_label = array('class' => 'control-label');
	$email = array('type' => 'email', 'id' => 'email', 'name' => 'email', 'class' => 'form-control');

	$password_label = array('class' => 'control-label');
	$password = array('type' => 'password', 'id' => 'password', 'name' => 'password', 'class' => 'form-control', 'value' => '');

	$password_confirm_label = array('class' => 'control-label');
	$password_confirm = array('type' => 'password', 'id' => 'password_confirm', 'name' => 'password_confirm', 'class' => 'form-control', 'value' => '');
?>

<main role="main">
	<div class="row">
	  <div class="col-md-8 col-md-offset-2">
	    <h1 class="register">Register your account</h1>

			<?php echo form_open('user_authentication/new_user_registration'); ?>

				<?php
					echo "<div class='error_msg'>";
					if(isset($message_display)) {
						echo $message_display;
					}
					echo "</div>";
				?>

				<div class="form-group">
					<?php echo form_label('Name' , 'name', $name_label);
								echo form_input($name); ?>
				</div>

				<div class="form-group">
					<?php	echo form_label('Username' , 'username', $username_label);
								echo form_input($username); ?>
				</div>

				<div class="form-group">
					<?php
						echo form_label('Email' , 'email', $email_label);
						echo form_input($email);
				 ?>
				</div>

			  <div class="form-group">
			  	<div class="row">
			    	<div class="col-md-6">
							<?php echo form_label('Password' , 'password', $password_label);
										echo form_password($password); ?>
						</div>
						<div class="col-md-6">
							<?php echo form_label('Password confirm' , 'password_confirm', $password_confirm_label);
							echo form_password($password_confirm); ?>
						</div>
			    </div>
			  </div>

		  	<div class="form-group"></div>
			<?php
				echo form_submit('submit', 'Register', array('class' => 'btn btn-primary register'));
				echo form_close();
			?>

			<br />

			<p>Hi. If you want to contribute to this project and share your knowledge you can just make an account and start publishing</p>
			<p>We can also talk by email first if you like, I will gladly answer your questions</p>
			<p>ciupinamihai@yahoo.com</p>
			<p>mihai.ciupina@gmail.com</p>
	  </div>

	</div>
</main>
