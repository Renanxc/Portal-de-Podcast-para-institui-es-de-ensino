<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Portal Podcast para instituições de ensino</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/style.css') ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

</head>
<body>
	<nav class="navbar navbar-expand-xs bg-info navbar-info	">
		<div class="container-fluid">
			<div class="navbar-header col-sm-3 col-xs-12">
				<a class="navbar-brand titulo" href="#">POrtal D'Learning</a>
			</div>
			<div class="navbar-right col-sm-9 col-xs-12">
			<form class="form-inline">
				<div class="input-group">
					<label class="input-group-addon">@</label>
					<input type="text" class="form-control" placeholder="Username" required="">
				</div> 
				<div class="input-group">
					<label class="input-group-addon">#</label>
					<input type="password" class="form-control" placeholder="Password" required="">
				</div>
				<div class="col text-right">
					<button type="submit" class="btn btn-light">Enviar</button>
				</div>
			</form>
			</div>
		</div>
	</nav>