<div class="container bg-folha">
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content">
					<?php 
						echo anchor('admin/disciplina', 'Voltar', array("class"=>'btn btn-danger','style'=>'margin-top:25px;'));
						echo '<br><br>';
						if (isset($disciplinas) && sizeof($disciplinas) > 0) {
							?>
							<table class="table table-primary table-stripped table-hover table-bordered">
								<thead class="thead-dark">
									<th align="center">Disciplina</th>
									<th align="center">Ações</th>
								</thead>
								<tbody>
									<?php
										foreach ($disciplinas as $disciplina) {
											?>
											<tr>
												<td>
													<?php
														echo $disciplina->nome;
													?>
												</td>
												<td>
													<?php
														echo anchor('admin/edita_disciplina/'.$disciplina->id, 'Editar', array('class' => 'btn btn-info') );
														echo " ";
														echo anchor('admin/deleta_disciplina/'.$disciplina->id, 'Deletar', array('class' => 'btn btn-info') );
													?>
												</td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
							<?php
						} else {
							set_msg("Nenhuma disciplina adicionada ainda!");
							redirect('admin/adiciona_disciplina','refresh');
						}
					?>

					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>