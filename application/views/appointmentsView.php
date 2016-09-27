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
				<li><a href="/welcome/logout">Logout</a></li>
			</ul>
		</div>
	</div>
</nav>
<div class="container">


	<h2> Hello, <?= $this->session->name ?> </h2>
	<h5> Here are your appointments for today, <?= date("F d, Y") ?>:</h5>

	<table>
		<tr>
			<th>Tasks</th>
			<th>Time</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
<?php 
	foreach ($todaysAppts as $appt) {
?>
		<tr>
			<td><?= $appt['task'] ?></td>
			<td><?= $appt['time'] ?></td>
			<td><?= $appt['status'] ?></td>
<?php
	if ($appt['status'] != "Done") {
?>
			<td>
				<ul>
					<li><a href="/appointments/edit/<?= $appt['id'] ?>">Edit</a></li>
					<li><a href="/appointments/delete/<?= $appt['id'] ?>">Delete</a></li>
				</ul>
			</td>

<?php
}
?>
		</tr>

<?php
}
?>
	</table>

	<h5> Your Other appointments </h5>
	<table>
		<tr>
			<th>Tasks</th>
			<th>Date</th>
			<th>Time</th>
		</tr>
<?php foreach ($otherAppts as $appt) { ?>
		<tr>
			<td><?= $appt['task'] ?></td>
			<td><?= $appt['date'] ?></td>
			<td><?= $appt['time'] ?></td>
		</tr>
<?php } ?>
	</table>
	</table>


	<h5> Add Appointment </h5>
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
	<!-- <form action="/appointments/test" method="POST"> -->
	<form action="/appointments/addAppointment" method="POST">
		<div class="input-field">
			<input type="text" name="date" id="date">
			<label for="date">Date</label>
		</div>
		<div class="input-field">
			<input type="text" name="time" id="time">
			<label for="time">Time</label>
		</div>
		<div class="input-field">
			<input type="text" name="task" id="task">
			<label for="task">Task</label>
		</div>
		<input type="hidden" name="user_id" value=<?= $this->session->id ?>>
		<button class="btn waves-effect waves-light center-align" type="submit">Add</button>
	</form>


</div>
</body>
</html>




