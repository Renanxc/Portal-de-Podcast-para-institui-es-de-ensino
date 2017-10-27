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
			<div class="navbar-header col-sm-3 col-12 text-center">
				<a class="navbar-brand titulo" data-toggle="modal" data-target="#myModal" href="#">POrtal D'Learning <br><span class="badge badge-primary">Menu</span></a>
			</div>

			<!-- The Modal -->
			<div class="modal fade" id="myModal">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Menu</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body text-center">
							<div class="btn-group">
								<a class="btn btn-info <?php if($atual=='main') echo 'disabled'; ?>" href="<?= base_url('main');?>">Home</a>
								<a class="btn btn-info <?php if($atual=='contato') echo 'disabled'; ?>" href="<?= base_url('contato');?>">Contato</a>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End Modal-->

			<div class="navbar-right col-sm-9 col-12">
				<?php
					echo 	form_open('login', array(
								'class' => 'form-inline'
							));
				?>
					<div class="input-group">
				<?php
					echo 	form_label( '@','login',array(
								'class' => 'input-group-addon',
								'name' => 'login'
							));
					echo 	form_input( array(
								'class' => 'form-control',
								'name' => 'login',
								'id' => 'login',
								'placeholder' => 'Username',
								'type' => 'text',
								'required' => ''
							));
				?>
					</div> 
					<div class="input-group">
				<?php
					echo 	form_label( '#','psw', array(
								'class' => 'input-group-addon',
								'name' => 'psw'
							));
					echo 	form_input( array(
								'class' => 'form-control',
								'name' => 'psw',
								'id' => 'psw',
								'placeholder' => 'Password',
								'type' => 'password',
								'required' => ''
							));
				?>
					</div>
					<div class="col text-right">
				<?php
					echo 	form_submit('enviar','Enviar', array(
								'class' => 'btn btn-light',
								'type' => 'submit'
							));
				?>
					</div>
				<?php
					echo 	form_close();
				?>
			</div>
<!-- 				<form class="form-inline">
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
				</form> -->
		</div>
	</nav>