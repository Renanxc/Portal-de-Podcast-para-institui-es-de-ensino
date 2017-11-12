<div class="container bg-folha">
	<h2><?= $titulo ?></h2>
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content container">
					<br>
					<?php 
						echo anchor('prof/lista_turma', 'Voltar', 'class="btn btn-danger"');;
					?>
					<br>
					<div class="row">
						<div class="col-sm-12 text-center">
							<h5><?php echo $turma->nome.'<br>'.$turma->status ?></h5>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 bg-light">
							<table class="table table-stripped table-hover">
								<thead align="center">
									<th>
										Informações sobre o Professor
									</th>
								</thead>
								<tbody>
									<tr>
										<td class="small">
											<label class="text-left">
											<label>
												Nome: <?= $prof->nome.' '.$prof->sobrenome ?>
											</label><br>
												<?php 
													if (isset($prof->data_nasc)) {
														$idade = mdate('%Y-%m-%d') - $prof->data_nasc;
														if ($idade > 120 or $idade < 1) 
															$idade = 'Idade não especificada';
														else
															$idade = $idade.' anos';
													}
													echo $idade;
												?>
											</label><br>
											<label>
												Telefone: <?= $prof->telefone ?>
											</label><br>
											<label>
												E-mail: <?= $prof->email ?>
											</label><br>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 bg-light">
							<table class="table table-stripped table-hover" style="justify-content:center">
								<thead align="center">
									<th>
										Alunos
									</th>
								</thead>
								<tbody>
									<tr class="text-center">
										<td>
										<?php
											if (isset($alunos) && sizeof($alunos) > 0) {
												?> 
												<div class="table-sm w-100 text-center">
													<table class="w-100">
														<thead class="small">
															<th>
																Nome
															</th>
															<th>
																Curso
															</th>
															<th>
																Adicionado em
															</th>
														</thead>
														<tbody class="small">
													<?php
														foreach ($alunos as $aluno) {
															?>
															<tr>
																<td>
																	<p>
																	<?= $aluno->aluno.' '.$aluno->sobrenome ?>
																	</p>
																</td>													
																<td>
																	<p>
																	<?= $aluno->curso ?>
																	</p>
																</td>
																<td>
																	<p>
																	<?= $aluno->data?>
																	</p>
																</td>
																<td>
																<?php
																	echo anchor('prof/ver_usuario', 'Ver', 'class = "btn btn-outline-info btn-sm float-left"');
																	echo form_open('prof/deleta_inscrito');
																		echo 	form_submit('deletar','Deletar',array(
																					'class' => 'btn btn-outline-danger btn-sm'
																				));
																		echo 	form_hidden('grade_id', $aluno->id_grade);
																		echo 	form_hidden('turma_id', $aluno->id_turma);
																	echo form_close();
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
												echo '<p>Nenhum aluno cadastrado ainda</p>';
											}
											?>
											<button class="btn btn-outline-dark btn-sm p-2 px-3 rounded-circle" onClick="this.style.display='none';document.getElementById('novo_aluno').style.display='block'">
													+
											</button>
											<?php
											echo 	form_open('prof/adiciona_inscrito',array(
														'id' => 'novo_aluno',
														'style' => 'display:none'
													));
											echo	'<div class="form-group">';
													if (isset($candidatos) && sizeof($candidatos) > 0) {
														echo 	form_label('Inscrever aluno', 'candidatos');;
														foreach ($candidatos as $row){
															if (isset($alunos) && sizeof($alunos) > 0) {
																foreach ($alunos as $aluno) {
																	if ($row->id == $aluno->id_grade) {
																		$row->id = NULL;
																	}
																}
															}
															if ($row->id) {
																$candidato[$row->id] = $row->grade.' '.$row->nome;
															}
														}
														if (isset($candidato)) {
															echo 	form_dropdown('candidato', $candidato, set_value('candidato'), array(
																			'class' => 'form-control',
																			'id' => 'curso'
																		));
															echo 	form_hidden('turma_id', $turma->id);;
															echo 	'<br>';
															echo 	form_submit('enviar', 'Enviar',array(
																		'class' => 'btn btn-outline-dark'
																	));
														}
													}
											echo	
												'</div>';
											echo 	form_close();;
										?>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-sm-6 bg-light">
							<table class="table table-stripped table-hover">
								<thead align="center">
									<th>
										Podcasts
									</th>
								</thead>
								<tbody>
									<tr>
										<td>
										<?php
											if (isset($podcasts) && sizeof($podcasts) > 0) {
												foreach ($podcasts as $pod) {
													?> 
													<small>
														<audio preload="metadata" controls>
															<source type="audio/mp3" src="<?php echo base_url('uploads/podcast/'.$pod->arquivo); ?> " />
															<source type="audio/ogg" src="<?php echo base_url('uploads/podcast/'.$pod->arquivo); ?> " />
															<source type="audio/wav" src="<?php echo base_url('uploads/podcast/'.$pod->arquivo); ?> " />
														</audio>
														<?php echo ''.$pod->data.' ('.$pod->hora.')'; ?>
													</small><br/>
													<?php
												}
											} else {
												echo '<p> Nenhuma aula ainda. </p>';
											}
										?>
										</td>
									</tr>
									<tr>
										<td>
											<?php
											echo 	form_open_multipart('prof/adiciona_podcast','id = "file_form"');
											echo	'<div class="form-group">';
											?>
											<!-- <input type="file" name="upload" value="Subir Arquivo" /> -->
											<?php
											echo 	form_upload('podcast','pod',array('id'=>'pod','onchange'=>'this.form.submit()'));
											echo 	form_hidden('turma_id', $turma->id);

											echo 	'<br>';
											echo	
												'</div>';
											echo 	form_close();
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
						echo form_open('prof/deleta_turma');
							echo form_submit('deletar','Deletar',array(
									'class' => 'btn btn-danger',
								));
							echo form_hidden('id', $turma->id);
						echo form_close();
					?>
					</div>
					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>