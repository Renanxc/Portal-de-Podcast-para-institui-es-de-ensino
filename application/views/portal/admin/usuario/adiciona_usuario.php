<div class="container bg-folha">
	<h2><?= $titulo ?></h2>
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content">
					<?php 
						echo anchor('admin/usuario', 'Voltar', array("class"=>'btn btn-danger','style'=>'margin-top:25px;'));
					?>
					<br><br>
					<?php 
						echo 	form_open();
					?>
					<div class="form-group">
					<?php
						echo 	form_label( 'Nome*','nome',array(
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
						echo 	form_label( 'Sobrenome*','sobrenome',array(
									'class' => '',
									'name' => 'sobrenome'
								));
						echo 	form_input( 'sobrenome', set_value('sobrenome'), array(
									'class' => 'form-control',
									'id' => 'sobrenome',
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
					<div class="form-group">
					<?php
						echo 	form_label( 'Login*','login-cad',array(
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
						echo 	form_label( 'Senha*','psw-cad', array(
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
						echo 	form_label( 'Repita a senha*','psw2', array(
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
					<div class="form-group">
					<?php
					if (isset($cursos) && sizeof($cursos) > 0) {
						echo form_label('Curso da Grade', 'curso');;
						foreach ($cursos as $row)
							$curso[$row->id] = $row->nome;
						echo 	form_dropdown('curso', $curso, set_value('curso'), array(
										'class' => 'form-control',
										'id' => 'curso'
									));
					}
					
					?>
					</div>
					<div class="row">
						<div class="col">
							<button class="btn btn-info" id="changePsw">Mostrar Senha</button>
						</div>
					</div>
					<br>
					<?php
						echo 	form_reset('reset','Limpar Campos', array(
									'id' => 'limpaCampos',
									'class' => 'btn btn-info float-left'
								));
						echo 	form_submit('enviar','Enviar', array(
									'class' => 'btn btn-info float-right',
								));
						echo 	form_close();
					?>
					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>