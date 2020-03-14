<div class="modal fade bd-example-modal-lg" id="modalCadastrar" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h5 class="text-center">Cadastrar novo Cliente</h5>
			</div>
			<br>
			<form method="POST" action="<?php echo BASE_URL_PAINEL; ?>clientes/action">
				<div class="col-md-12">
					<div class="card">
						
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="dados">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Nome </label>
												<input type="text" class="form-control" name="cli_nome" id="cli_nome" >
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Email </label>
												<input type="text" class="form-control" name="cli_email" id="cli_email" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label>Telefone </label>
												<input type="text" class="form-control" name="cli_telefone" id="cli_telefone">
											</div>
										</div>
										<div class="col-sm-3"></div>
										
									</div>

								</div>

								
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">Salvar</button>
				</div>
			</form>
		</div>
	</div>
</div>