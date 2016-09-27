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
	<!-- Materialize CSS -->
	    <link rel='stylesheet prefetch' href='https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/css/materialize.clockpicker.css'>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/css/materialize.min.css">
	<!-- Personal CSS -->
	<link rel="stylesheet" href="/assets/css/style.css">



	<!-- Less -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/less.js/2.7.1/less.min.js"></script>


	<!-- Jquery --> 
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.0/jquery-ui.min.js"></script>

    <!-- timepicker -->


    <!-- Materialize JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.7/js/materialize.min.js"></script>
	<script src='https://cdn.rawgit.com/chingyawhao/materialize-clockpicker/master/dist/js/materialize.clockpicker.js'></script>



	<script>
		$(document).ready(function(){
			$('#date').datepicker();
			$('select').material_select();
			$('#time').pickatime({
    default: 'now',
    twelvehour: false, // change to 12 hour AM/PM clock from 24 hour
    donetext: 'OK',
  autoclose: false,
  vibrate: true // vibrate the device when dragging clock hand
});

		})		
	</script>
</head>
<body>
<nav>
	<div class="container">
		<div class="nav-wrapper">
			<ul id="nav-mobile" class="right">
				<li><a href="/appointments">Dashboard</a></li>
				<li><a href="/welcome/logout">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">
	<h2> Edit Your Appointment </h2>
	<form action="/appointments/updateAppt" method="POST">
		<div class="input-field">
			<input type="text" name="task" id="task" value="<?= $task ?>">
			<label for="task">Task</label>
		</div>
		<div class="input-field">
			<select name="status">
				<option value="Done" <?= ($status == "Done") ? "selected" : null ?>>Done</option>
				<option value="Pending" <?= ($status == "Pending") ? "selected" : null ?>>Pending</option>
				<option value="Missed" <?= ($status == "Missed") ? "selected" : null ?>>Missed</option>
			</select>

		</div>
		<div class="input-field">
			<input type="text" name="date" id="date" value="<?= $date ?>">
			<label for="date">Date</label>
		</div>
		<div class="input-field">
			<input type="text" name="time" id="time" value="<?= $time ?>">
			<label for="time">Time</label>
		</div>
		<input type="hidden" name="id" value=<?= $id ?>>
		<input type="hidden" name="user_id" value=<?= $this->session->id ?>">
		<button class="btn waves-effect waves-light center-align" type="submit">Update</button>
	</form>
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
</div>
</body>
</html>