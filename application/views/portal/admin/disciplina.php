<div class="container bg-folha">
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content text-center">
					<?php 
						echo anchor('admin', 'Voltar', 'class="btn btn-danger"');;
					?>
					<div class="btn-group-vertical">
					<?php
						echo anchor('admin/adiciona_disciplina', 'Adiciona Disciplina', 'class="btn btn-info"');
						echo anchor('admin/lista_disciplina', 'Lista Disciplina', 'class="btn btn-info"');
					?>
					</div>
				</div> 
			</div> 
		</div> 
	</div>
</div>