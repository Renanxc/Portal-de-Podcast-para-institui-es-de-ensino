<div class="container bg-folha">
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content">
					<?php 
						echo anchor('admin/curso', 'Voltar', array("class"=>'btn btn-danger','style'=>'margin-top:25px;'));
						echo '<br><br>';
						if (isset($cursos) && sizeof($cursos) > 0) {
							?>
							<table class="table table-primary table-stripped table-hover table-bordered">
								<thead class="thead-dark">
									<th align="center">Curso</th>
									<th align="center">Ações</th>
								</thead>
								<tbody>
									<?php
										foreach ($cursos as $curso) {
											?>
											<tr>
												<td>
													<?php
														echo $curso->nome;
													?>
												</td>
												<td>
													<?php
														echo anchor('admin/edita_curso/'.$curso->id, 'Editar', array('class' => 'btn btn-info') );
														echo " ";
														echo anchor('admin/deleta_curso/'.$curso->id, 'Deletar', array('class' => 'btn btn-info') );
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
							set_msg("Nenhum curso adicionado ainda!");
							redirect('admin/adiciona_curso','refresh');
						}
					?>

					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>