<div class="container bg-folha">
	<h2><?= $titulo ?></h2>
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content container">
					<br>
					<?php 
						echo anchor('admin/lista_disciplina', 'Voltar', 'class="btn btn-danger"');;
					?>
					<br>
					<?php 
						echo 	form_open();
					?>
						<div class="form-group">
					<?php
						echo 	form_label('Nome:', 'nome');
						echo 	form_input('nome',set_value('nome',$disciplina->nome),array(
									'id' => 'nome',
									'class' => 'form-control'
								));
					?>
						</div>
						<div class="form-group">
					<?php
						echo 	form_label('Descrição (Aceita-se classes Bootstrap e edição JQuery):', 'descricao');
						echo 	form_textarea( array(
									'name' => 'descricao',
									'id' => 'descricao',
									'value' => to_html(set_value('descricao',to_html($disciplina->descricao))),
									'class' => 'form-control editorhtml',
									'rows' => '3'
								));
					?>
						</div>
						<div class="form-group">
						<?php
						if (isset($cursos) && sizeof($cursos) > 0) {
							foreach ($cursos as $row) {
								$checked = FALSE;
								// Caso optasse por fazer com multiselct
								// $curso[$row->id] = $row->nome;
								?>
								<div class="form-check form-check-inline">
									<label class="form-check-label">
										<?php
										if (isset($cursos_atuais) && sizeof($cursos_atuais) > 0) {
											foreach ($cursos_atuais as $atual) {
												if ($row->id == $atual->id_curso) {
													$checked = TRUE;
												}
											}
										}
											echo 	form_checkbox('cursos[]', $row->id, set_checkbox('cursos[]', $row->id, $checked), array(
														'class' => 'form-check-input'
													));
											echo 	$row->nome;
										?>
									</label>
								</div>
								<?php
							}
							// echo 	form_multiselect('cursos', $curso);
						} else {
							set_msg("Nenhum curso adicionado ainda!");
							redirect('admin','refresh');
						}
						?>
						</div>
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