<div class="container bg-folha">
	<div class="row h-100 border">
		<div class="col-sm-12 respH">
			<div class="folha w-100">
				<div class="folha-content">
					<?php 
						echo anchor('admin/usuario', 'Voltar', array("class"=>'btn btn-danger','style'=>'margin-top:25px;'));
						echo '<br><br>';
						if (isset($usuarios) && sizeof($usuarios) > 0) {
							?>
							<table class="table table-primary table-stripped table-hover table-bordered">
								<thead class="thead-dark">
									<th align="center">Usuário</th>
									<th align="center">Ações</th>
								</thead>
								<tbody>
									<?php
										foreach ($usuarios as $usuario) {
											?>
											<tr>
												<td>
													<?php
														if (isset($usuario->data_nasc)) {
															$idade = mdate('%Y-%m-%d') - $usuario->data_nasc;
															if ($idade > 120 or $idade < 1) 
																$idade = 'Idade não especificada';
															else
																$idade = $idade.' anos';
														}
														echo 	'<b>'.$usuario->nome.' '.$usuario->sobrenome.
																'</b><br><small>'.$idade.'<br>'.
																$usuario->privilegio.'</small>';
													?>
												</td>
												<td class="text-right">
													<?php
														echo anchor('admin/ver_usuario/'.$usuario->id, 'Ver', array('class' => 'btn btn-info') );
														// echo " ";
														// echo anchor('admin/deleta_usuario/'.$usuario->id, 'Deletar', array('class' => 'btn btn-info') );
													?>
												</td>
											</tr>
											<?php
										}
									?>
								</tbody>
							</table>
							<ul class="pagination pagination-lg" style="justify-content:center;">
							<?php
								if ($pag_atual>1) {
									echo anchor('admin/lista_usuarios/'.($pag_atual-1), '<', array(
										'class' => 'page-link'
									)); 
								}
								for($i=1; $i<=$num_paginas;$i++) {
									?>
										<li class="page-item <?= ($i == $pag_atual)?'disabled':'' ?>">	
											<?php 
												echo anchor('admin/lista_usuarios/'.$i, $i, array(
													'class' => 'page-link'
												)); 
											?>
										</li>
									<?php
								}
								if ($pag_atual<$num_paginas) {
									echo anchor('admin/lista_usuarios/'.($pag_atual+1), '>', array(
										'class' => 'page-link'
									)); 
								}
							?>
							</ul>
							<?php
						} else {
							?>
								<div class="boder"><p>Nenhum usuário encontrado</p></div>
							<?php
						}
					?>

					<br><br>
				</div> 
			</div> 
		</div> 
	</div>
</div>