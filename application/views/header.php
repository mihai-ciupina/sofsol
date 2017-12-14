<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php if(isset($composed_title)) {echo $composed_title.' - How To Code Solutions';} else {echo "How To Code Solutions - analytical solutions for programmer's daily questions";} ?></title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css" />

	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

	<script type="text/javascript" src="<?php echo base_url('js/main.js'); ?>" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url('css/style.css'); ?>">
</head>
<body>
<?php include_once("analyticstracking.php") ?>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="/"><img src="/images/logo.png" height="36" /></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
				<li><a href="/welcome">How To Code Solutions</a></li>
        <li><a href="/">search</a></li>
				<li><a href="/welcome/contact">contact</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
		<?php
			if ((isset($this->session->userdata['logged_in']))&&($this->session->userdata['logged_in'])) {
		?>
			<?php if("admin" === $this->session->userdata['user_category']) { ?>
				<li><a href="/question/index">question list</a></li>
				<li><a href="/seo/sitemap">~ sitemap</a></li>
				<li><a href="/sitemap/sitemap.xml">@ sitemap</a></li>
			<?php } ?>

			<li><a href="/question/show_question_form">+</a></li>
			<li>
				<a href="#"><span class="glyphicon glyphicon-user"></span> <strong><?=$this->session->userdata['username']?></strong></a>
			</li>
			<li>
				<a href="<?php echo site_url('user_authentication/logout');?>"><span class="glyphicon glyphicon-log-out"></span><strong> Logout</strong> </a>
			</li>
		<?php
			} else {
		?>
			<li>
				<a href="<?php echo site_url('user_authentication/user_login_show');?>"><span class="glyphicon glyphicon-log-in"></span><strong> Login</strong></a>
			</li>
			<li>
				<a href="<?php echo site_url('user_authentication/user_registration_show');?>"><span class="glyphicon glyphicon-user"></span><strong> Register</strong></a>
			</li>
		<?php
			}
		?>
      </ul>
    </div>
  </div>
</nav>

<div class="container-fluid text-center">
	<div class="row content">

		<div class="col-sm-6 text-left">
