<div class="container bg-folha">
	<div class="row h-100 border">

		<div class="col-sm-6 respH">
			<div class="folha">
				<div class="folha-content">
					<?php 
						echo 	form_open();
						?>
							<div class="form-group">
						<?php
						echo 	form_label('Nome:', 'nome');
						echo 	form_input('nome',set_value('nome'),array(
									'id' => 'nome',
									'class' => 'form-control'
								));
						?>
							</div>
							<div class="form-group">
						<?php
						echo 	form_label('Email:', 'email');
						echo 	form_input('email',set_value('email'),array(
									'id' => 'email',
									'class' => 'form-control'
								));
						?>
							</div>
							<div class="form-group">
						<?php
						echo 	form_label('Assunto:', 'assunto');
						echo 	form_input('assunto',set_value('assunto'),array(
									'id' => 'assunto',
									'class' => 'form-control'
								));
						?>
							</div>
							<div class="form-group">
						<?php
						echo 	form_label('Mensagem:', 'mensagem');
						echo 	form_textarea( array(
									'name' => 'mensagem',
									'id' => 'msg',
									'value' => set_value('mensagem'),
									'class' => 'form-control',
									'rows' => '3'
								));
						?>
							</div>
						<?php
						echo 	form_reset('reset','Limpar Campos', array(
									'id' => 'limpaCampos',
									'class' => 'btn btn-info float-left'
								));
						echo 	form_submit('enviar','Enviar', array(
									'class' => 'btn btn-info float-right'
								));
						echo 	form_close();
					?>
				</div>
			</div>
		</div>

		<div class="col-sm-6 respH">
			<div class="folha">
				<div class="folha-content">
					<?php 
						if (isset($formerror) && $formerror !="")
							echo '<div class="alert alert-danger alert-dismissable fade show">'.$formerror.'</div>';
						if (isset($formsuccess))
							echo '<div class="alert alert-success alert-dismissable fade show">'.$formsuccess.'</div>';
					?>
				</div>
			</div>
		</div>

	</div>
</div>