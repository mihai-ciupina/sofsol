<html>
<head>
<title>Login Form</title>
</head>
<body>
<?php
if(isset($logout_message)) {
	echo "<div class='message'>";
	echo $logout_message;
	echo "</div>";
}
?>

<?php
if(isset($message_display)) {
	echo "<div class='message'>";
	echo $message_display;
	echo "</div>";
}
?>

<div id="main">
	<div id="login" class="row">
		<div class="col-md-4 col-md-offset-4">
		<h2>Login Form</h2>
		<?php echo form_open('user_authentication/user_login_process'); ?>
		<?php
		echo "<div class='error_msg'>";
		if(isset($error_message)) {
			echo $error_message;
		}
		echo validation_errors();
		echo "</div>";
		?>
		<div class="form-group">
			<label class="control-label" for="username">username</label>
			<input class="form-control" id="name" name="username" type="text" placeholder="username" />
    </div>
		<div class="form-group">
			<label class="control-label" for="password">password</label>
			<input class="form-control" id="password" name="password" type="password" placeholder="********" />
    </div>

		<!-- <label>UserName: </label>
		<input type="text" name="username" id="name" placeholder="username" /> -->
		<!-- <label>Password: </label>
		<input type="password" name="password" id="password" placeholder="********" /> -->
		<button class="btn btn-primary" type="submit" name="sumbit">Login</button>
		<a href="user_reset_password_form">Reset pass</a>
		<?php echo form_close(); ?>
		</div>
	</div>
</div>
</body>
</html>
