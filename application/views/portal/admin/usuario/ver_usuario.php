<div class="container bg-folha">
	<h2><?= $titulo ?></h2>
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content container">
					<br>
					<?php 
						echo anchor('admin/lista_usuarios', 'Voltar', 'class="btn btn-danger"');;
					?>
					<br>
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2><?php echo $usuario->nome.' '.$usuario->sobrenome ?></h2>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 bg-light">
							<table class="table table-stripped table-hover">
								<thead align="center">
									<th>
										Informações
									</th>
								</thead>
								<tbody>
									<tr>
										<td class="small">
											<label class="text-left">
												<?php 
													if (isset($usuario->data_nasc)) {
														$idade = mdate('%Y-%m-%d') - $usuario->data_nasc;
														if ($idade > 120 or $idade < 1) 
															$idade = 'Idade não especificada';
														else
															$idade = $idade.' anos';
													}
													echo $idade;
												?>
											</label><br>
											<label>
												Telefone: <?= $usuario->telefone ?>
											</label><br>
											<label>
												E-mail: <?= $usuario->email ?>
											</label><br>
											<label>
												Login: <?= $usuario->login ?>
											</label><br>
											<label>
												Cargo: <?= $usuario->privilegio ?>
											</label><br>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-8 bg-light">
							<table class="table table-stripped table-hover" style="justify-content:center">
								<thead align="center">
									<th>
										Grades
									</th>
								</thead>
								<tbody>
									<tr class="text-center">
										<td>
										<?php
											if (isset($grades) && sizeof($grades) > 0) {
												?> 
												<div class="table-sm w-100 text-center">
													<table>
														<thead class="small">
															<th>
																Código de Grade
															</th>
															<th>
																Curso
															</th>
															<th>
																Período
															</th>
															<th>
																Turmas
															</th>
															<th>
																Renovável
															</th>
														</thead>
														<tbody class="small">
													<?php
														foreach ($grades as $grade) {
															?>
															<tr>
																<td>
																	<p>
																	<?= $grade->cod_grade ?>
																	</p>
																</td>													
																<td>
																	<p>
																	<?= $grade->fk_curso->nome ?>
																	</p>
																</td>
																<td>
																	<p>
																	<?= $grade->fk_per->ano.' - '.$grade->fk_per->semestre.'º semestre' ?>
																	</p>
																</td>
																<td>
																	<?php
																		if (isset($turmas[$grade->id]) && sizeof($turmas) > 0) {
																			foreach ($turmas[$grade->id] as $row) {
																				?>
																				<small>
																				<?= $row->nome.' - '.$row->turno ?>
																				</small><br>
																				<?php
																			}
																		} else {
																			echo '<p>Nenhuma turma nesta grade</p>';
																		}
																	?>
																</td>
																<td>
																	<?php
																		$semestre = (mdate('%m')>6)?2:1;
																		if ($grade->fk_per->ano == mdate('%Y') && $grade->fk_per->semestre == $semestre ) {
																			$checked = FALSE; 
																			if ($grade->renovavel == 1) {
																				$checked = TRUE;
																			}
																			echo form_open('admin/edita_grade_renovavel');
																				echo form_checkbox('renovavel', $grade->renovavel, set_checkbox('renovavel', $grade->renovavel, $checked), array(
																						'onchange' => "this.form.submit();"
																					));
																				echo form_hidden('grade_id', $grade->id);
																				echo form_hidden('usuario_id', $usuario->id);
																			echo form_close();
																		?>
																</td>
																<td>
																		<?php
																			echo form_open('admin/deleta_grade');
																				echo 	form_submit('deletar','Deletar Grade',array(
																							'class' => 'btn btn-outline-danger btn-sm'
																						));
																				echo 	form_hidden('grade_id', $grade->id);
																				echo 	form_hidden('usuario_id', $usuario->id);
																			echo form_close();
																		}
																	?>
																</td>
															</tr>
														<?php 
														}
													?>
														</tbody> 
													</table><br>
												</div>
												<?php
											} else {
												echo '<p>Nenhuma grade cadastrada</p>';
											}
											?>
											<button class="btn btn-outline-dark btn-sm p-2 px-3 rounded-circle" onClick="this.style.display='none';document.getElementById('nova_grade').style.display='block'">
													+
											</button>
											<?php
											echo 	form_open('admin/adiciona_grade',array(
														'id' => 'nova_grade',
														'style' => 'display:none'
													));
											echo	'<div class="form-group">';
													if (isset($cursos) && sizeof($cursos) > 0) {
														echo 	form_label('Curso da Grade', 'curso');;
														foreach ($cursos as $row)
															$curso[$row->id] = $row->nome;
														echo 	form_dropdown('curso', $curso, set_value('curso'), array(
																		'class' => 'form-control',
																		'id' => 'curso'
																	));
													}
											echo 	form_hidden('usuario_id', $usuario->id);;
											echo 	'<br>';
											echo 	form_submit('enviar', 'Enviar',array(
														'class' => 'btn btn-outline-dark'
													));
											echo	
												'</div>';
											echo 	form_close();;
										?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-4 bg-light">
							<table class="table table-stripped table-hover">
								<thead align="center">
									<th>
										Histórico de Acessos
									</th>
								</thead>
								<tbody>
									<tr>
										<td>
										<?php
											if (isset($historicos) && sizeof($historicos) > 0) {
												foreach ($historicos as $h) {
													echo '<small>'.$h->data.' ('.$h->hora.')</small><br/>';
												}
											} else {
												echo '<p> Não acessou o Portal ainda! </p>';
											}
										?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<br>
					<div class="row float-right">
					<?php
						echo form_open('admin/deleta_usuario');
							echo form_submit('deletar','Deletar',array(
									'class' => 'btn btn-danger',
								));
							echo form_hidden('id', $usuario->id);
						echo form_close();
					?>
					</div>
					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>