<div class="container bg-folha">
	<div class="row h-100 border">
						<?php
							echo 	form_open('instalar',array('class' => 'w-100' ));
						?>
		<div class="col-sm-6 respH float-left">
			<div class="folha w-100">
				<div class="folha-content">
						<h3>Crie uma conta de Administrador</h3>
							<div class="form-group">
						<?php
							echo 	form_label( 'Nome','nome',array(
										'class' => '',
										'name' => 'nome'
									));
							echo 	form_input( 'nome', set_value('nome'), array(
										'class' => 'form-control',
										'id' => 'nome',
										'placeholder' => '',
										'type' => 'text'
									));
						?>
							</div> 
							<div class="form-group">
						<?php
							echo 	form_label( 'Data de Nasicimento','nasc', array(
										'class' => '',
										'name' => 'nasc'
									));
						?>
							<input type="date" name="nasc" value="<?= set_value('nasc')?>" class="form-control" id="nasc">
							</div> 
							<div class="form-group">
						<?php
							echo 	form_label( 'Telefone','tel',array(
										'class' => '',
										'name' => 'tel'
									));
							echo 	form_input( 'tel', set_value('tel'), array(
										'class' => 'form-control',
										'id' => 'tel',
										'placeholder' => '000000000',
										'type' => 'tel'
									));
						?>
							</div> 
							<div class="form-group">
						<?php
							echo 	form_label( 'Email','email',array(
										'class' => '',
										'name' => 'email'
									));
							echo 	form_input( 'email', set_value('email'), array(
										'class' => 'form-control',
										'id' => 'email',
										'placeholder' => 'exemplo@mail.com',
										'type' => 'email'
									));
						?>
							</div> 
				</div> 
			</div> 
		</div> 
		<div class="col-sm-6 respH float-left">
			<div class="folha w-100">
				<div class="folha-content">
							<div class="form-group">
						<?php
							echo 	form_label( 'Login','login-cad',array(
										'class' => '',
										'name' => 'login-cad'
									));
							echo 	form_input( 'login-cad', set_value('login-cad'), array(
										'class' => 'form-control',
										'id' => 'login-cad',
										'placeholder' => 'Username',
										'type' => 'text'
									));
						?>
							</div> 
							<div class="form-group">
						<?php
							echo 	form_label( 'Senha','psw-cad', array(
										'class' => '',
										'name' => 'psw-cad'
									));
							echo 	form_password( 'psw-cad', set_value('psw-cad'), array(
										'class' => 'form-control psw',
										'id' => 'psw-cad',
										'placeholder' => 'Password'
									));
						?>
							</div>
							<div class="form-group">
						<?php
							echo 	form_label( 'Repita a senha','psw2', array(
										'class' => '',
										'name' => 'psw2'
									));
							echo 	form_password( 'psw2', set_value('psw2'), array(
										'class' => 'form-control psw',
										'id' => 'psw2',
										'placeholder' => 'Password'
									));
						?>
							</div>
							<div class="col text-right">
						<?php
							echo 	form_submit('enviar','Enviar', array(
										'class' => 'btn btn-info',
										'type' => 'submit'
									));
						?>
								<button class="btn btn-info" id="changePsw">Mostrar Senha</button>
							</div>
				</div>
			</div>
		</div>
						<?php
							echo 	form_close();
						?>
	</div>
</div>