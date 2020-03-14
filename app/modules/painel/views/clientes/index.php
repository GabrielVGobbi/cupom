<?php include_once("cadastrar.php"); ?>
<div class="col-12">
	<div class="card">
		<div class="card-header">
			<button class="btn btn-primary btn-sm float-left"  data-toggle="modal" data-target="#modalCadastrar">
				<i class="fas fa-plus"> </i> Novo
			</button>
			<div class="card-tools">
				<div class="input-group input-group-sm" style="width: 150px;margin-top:2px">
					<input type="text" name="table_search" class="form-control float-right" placeholder="Busca Rapida">
					<div class="input-group-append">
						<button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body table-responsive p-0">
			<table class="table table-hover">
				<thead>
					<tr>
						<th style="width: 14%">Ação</th>
						<th>#</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Qnt Cupons Ativos</th>
						<th>Qnt Cupons Usados</th>
						<th>Status</th>
					</tr>
				</thead>
				<tbody>
					<?php if ($tableDados && count($tableDados) > 0) : ?>
						<?php foreach ($tableDados as $cli) : ?>
							
							<?php include("editar.php"); ?>
							<tr>
								<td>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modalInfo<?php echo md5($cli['id_cliente']); ?>">
										<i class="fas fa-pencil-alt"></i>
									</button>
									<a class="btn btn-danger btn-sm" href="#">
										<i class="fas fa-trash"></i>
									</a>
								</td>
								<td><?php echo $cli['id_cliente'] ?></td>
								<td>
									<a>
										<?php echo $cli['cli_nome'] ?>
									</a>
									<br>
									<small>Criado <?php echo $cli['create_date'] ?></small>
								</td>
								<td><?php echo $cli['cli_email'] ?></td>
								<td>1</td>
								<td>1</td>

								<td><span class="tag tag-success">Ativo</span></td>
							</tr>
						<?php endforeach; ?>
					<?php else : ?>
						<tr>
							<td colspan="5" class="text-center">não encontrado</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
