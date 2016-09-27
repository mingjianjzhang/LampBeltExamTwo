<?php
defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title></title>
	<!-- Google Icons -->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!-- Jquery Theme -->
	<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/hot-sneaks/jquery-ui.css">
	<!-- <link rel="stylesheet" href="/assets/css/timepicker.css"> -->

	<!-- Materialize CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	<!-- Personal CSS -->
	<link rel="stylesheet" href="/assets/css/style.css">


	<!-- Less -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.min.js"></script>


	<!-- Jquery --> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>



    <!-- Materialize JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>


	<script>
		$(document).ready(function(){
			$('#dob').datepicker({
				changeMonth: true,
				changeYear: true,
				yearRange: "-100: +0"
			});
		})		
	</script>

	<style>
		select {
			display: inline-block;
		}
	</style>
</head>
<body>
<div class="container">
	<h2> Welcome! </h2>
	<?= $this->session->flashdata('success') ?>
	<div class="row">
		<div class="col s6">
<?php 
	$errors = $this->session->flashdata('errors');
	if ($errors) {
		foreach ($errors as $error) { 
?>

				<p><?= $error ?></p>
<?php 
		}; 
	}; 
?>		
			<form class="loginreg" action="/welcome/register" method="POST">
				<div class="input-field">
					<input type="text" name="name" id="name">
					<label for="name">Name</label>
				</div>
				<div class="input-field">
					<input type="text" name="email" id="email">
					<label for="email">Email</label>
				</div>
				<div class="input-field">
					<input type="password" name="password" id="password">
					<label for="password">Password</label>
				</div>
				<div class="input-field">
					<input type="password" name="confirm_password" id="confirm_password">
					<label for="confirm_password">Confirm Password</label>
				</div>
				<div class="input-field">
					<input type="text" name="dob" id="dob">
					<label for="dob">Date of Birth</label>
				</div>
				<button class="btn waves-effect waves-light center-align" type="submit">Register</button>

			</form>
		</div>
		<div class = "col s6">
			<form class="loginreg" action="/welcome/login" method="POST">
				<div class="input-field">
					<input type="text" name="email" id="email">
					<label for="email">Email</label>
				</div>
				<div class="input-field">
					<input type="password" name="password" id="password">
					<label for="password">Password</label>
				</div>
				<button class="btn waves-effect waves-light center-align" type="submit">Login</button>
				<?= $this->session->flashdata('loginErrors'); ?>
				<?= $this->session->flashdata('noUsername'); ?>
				<?= $this->session->flashdata('badPassword'); ?>

			</form>
		</div>
	</div>

</body>
</html>