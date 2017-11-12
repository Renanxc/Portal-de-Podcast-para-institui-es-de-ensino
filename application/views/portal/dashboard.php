<div class="container bg-folha">
	<div class="row h-100 border">

	<?php
		switch ($this->session->userdata('privilegio')) {
			case 'adm':
				?>
					<div class="col-sm-12 respH">
						<div class="folha w-100">
							<div class="folha-content text-center">
								<div class="btn-group-vertical">
								<?php
									echo anchor('admin/iniciar_periodo', 'Iniciar Período', 'class="btn btn-info"');
									echo anchor('admin/curso', 'Cursos', 'class="btn btn-info"');
									echo anchor('admin/disciplina', 'Disciplinas', 'class="btn btn-info"');
									echo anchor('admin/usuario', 'Usuários', 'class="btn btn-info"');
								?>
								</div>
							</div> 
						</div> 
					</div> 
				<?php
				break;

			case 'prof':
				?>
					<div class="col-sm-12 respH">
						<div class="folha w-100">
							<div class="folha-content text-center">
								<div class="btn-group-vertical">
								<?php
									echo anchor('prof/adiciona_turma', 'Adicionar Turma', 'class="btn btn-info"');
									echo anchor('prof/lista_turma', 'Listar Turma', 'class="btn btn-info"');
								?>
								</div>
							</div> 
						</div> 
					</div> 
				<?php
				break;

			case 'aluno':
				?>
					<div class="col-sm-12 respH">
						<div class="folha w-100">
							<div class="folha-content text-center">
								<div class="btn-group-vertical">
								<?php
									echo anchor('main', 'Ver Perfil', 'class="btn btn-info"');
									echo anchor('main', 'Grades', 'class="btn btn-info"');
								?>
								</div>
							</div> 
						</div> 
					</div> 
				<?php
				break;

			default:
				echo 'NOT FOUND';
				break;
		}
	?>		
	</div>
</div>