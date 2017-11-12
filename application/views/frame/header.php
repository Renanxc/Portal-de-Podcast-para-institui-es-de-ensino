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
	<!-- <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.css') ?>"> -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery-te-1.4.0.css') ?>">


	<script
	  src="https://code.jquery.com/jquery-3.2.1.js"
	  integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
	  crossorigin="anonymous">
	 </script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
	<!-- <script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script> -->



	<link rel="shortcut icon" href="<?= base_url('assets/favicon/pod.ico'); ?>" type="image/x-icon">
	<link rel="icon" href="<?= base_url('assets/favicon/pod.ico'); ?>" type="image/x-icon">
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
								<?php if ($this->session->userdata('logged')) { ?>
								<a class="btn btn-info <?php if($atual=='dashboard') echo 'disabled'; ?>" href="<?= base_url('dashboard');?>">Dashboard</a>
								<?php } ?>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- End Modal-->
			<?php 
				if ($this->session->userdata('logged')) {
					echo '<p class="small text-right text-white">';
					echo 'Logado como: <span class="font-weight-bold">'.$this->session->userdata("user").' '.$this->session->userdata("surname").'</span>';
			?> 
					<a class="btn btn-info" href="<?= base_url('setup/logout'); ?>">Sair</a> 
			<?php
					echo '</p>';
				}
				else{
			?>
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
					echo 	form_input('login', set_value('login'), array(
								'class' => 'form-control',
								'id' => 'login',
								'placeholder' => 'Username',
								'type' => 'text',
							));
				?>
					</div> 
					<div class="input-group">
				<?php
					echo 	form_label( '#','psw', array(
								'class' => 'input-group-addon',
								'name' => 'psw'
							));
					echo 	form_password( array(
								'class' => 'form-control',
								'name' => 'psw',
								'id' => 'psw',
								'placeholder' => 'Password',
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
			<?php
				}
			?>
		</div>
	</nav>
	<?php 	
		if ($msg = get_msg()) {
			?>
			<!-- The Modal -->
			<div class="modal fade" id="myModal2">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">

						<!-- Modal Header -->
						<div class="modal-header">
							<h4 class="modal-title">Msg</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body text-center small">
							<?= $msg ?>
						</div>

					</div>
				</div>
			</div>
			<!-- End Modal-->
			<!-- 
			<script>
				$("#myModal2").modal("show");
			</script>
			-->
			<?php
		}  
	?>