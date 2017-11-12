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
					<div class="row">
						<div class="col-sm-12 text-center">
							<h2><?php echo $disciplina->nome ?></h2>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 border bg-light">
						<?php
							echo to_html($disciplina->descricao);
						?>
						</div>
					</div>
					<br>
					<div class="row">
						<div class="col-sm-12">
						<?php
						if (isset($cursos) && sizeof($cursos) > 0) {
						?>
							<ul>
								<?php
									foreach ($cursos as $row) {
										?>
											<li>
												<?php echo $row->nome?>
											</li>
										<?php
									}	
								?>
							</ul>
						<?php
						} else {
							echo 'Não existe em nenhum curso';
						}
						?>
						</div>
					</div>
					<br>
					<div class="row float-right">
					<?php
						echo form_open();
						echo form_submit('deletar','Deletar',array(
								'class' => 'btn btn-danger',
							));
						echo form_close();
					?>
					</div>
					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>