<div class="container bg-folha">
	<h2><?= $titulo ?></h2>
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content">
					<?php 
						echo anchor('prof/', 'Voltar', array("class"=>'btn btn-danger','style'=>'margin-top:25px;'));
					?>
					<?php 
						echo 	form_open();
					?>
						<div class="form-group">
					<?php
						echo 	'<br><b>'.form_label('Disciplinas Disponíveis:', 'disciplinas').'</b><br>';
						if (isset($disciplinas) && sizeof($disciplinas) > 0) {
							foreach ($disciplinas as $row) {
								?>
								<label class="radio-inline">
									<?php
										echo 	form_radio('disciplina', $row->id, set_radio('disciplina', $row->id, FALSE));
										echo 	$row->nome;
									?>
								</label>
								<?php
							}
						} else {
							set_msg("Nenhuma disciplina adicionada ainda! Faça uma requisição ao administrador de seu sistema.");
							redirect('prof','refresh');
						}
					?>
						</div>
						<div class="form-group">
							<b><label for="turno">Turno:</label></b>
							<select name="turno" class="form-control" id="turno">
								<option>Manhã</option>
								<option>Tarde</option>
								<option>Noite</option>
							</select>
						</div>
					<?php
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