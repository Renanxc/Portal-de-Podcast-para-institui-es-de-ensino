<div class="container bg-folha">
	<h2><?= $titulo ?></h2>
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content">
					<?php 
						echo anchor('prof/', 'Voltar', array("class"=>'btn btn-danger','style'=>'margin-top:25px;'));
						echo '<br><br>';
						if (isset($turmas) && sizeof($turmas) > 0) {
							?>
							<table class="table table-primary table-stripped table-hover table-bordered">
								<thead class="thead-dark">
									<th align="center">Turmas</th>
									<th align="center">Ações</th>
								</thead>
								<tbody>
									<?php
										foreach ($turmas as $turma) {
											?>
											<tr>
												<td>
													<?php
														echo $turma->nome.'<br>'.$turma->status;
													?>
												</td>
												<td class="text-right">
													<?php
														echo anchor('prof/ver_turma/'.$turma->id, 'Ver', array('class' => 'btn btn-info') );
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
							set_msg("Nenhuma turma adicionada ainda!");
							redirect('prof/adiciona_turma','refresh');
						}
					?>

					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>