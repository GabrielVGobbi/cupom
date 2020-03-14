<div class="modal fade bd-example-modal-lg" id="modalInfo<?php echo md5($cli['id_cliente']); ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header text-center">
				<h5 class="text-center"><?php echo $cli['cli_nome']; ?></h5>
			</div>
			<br>
			<form method="POST" action="<?php echo BASE_URL_PAINEL; ?>clientes/action">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<div class="tab-content">
								<div class="active tab-pane" id="dados">
									<input type="hidden" class="form-control" name="EnVID" id="EnVID" value="<?php echo $cli['id_cliente']; ?>">
									<div class="row">
										<div class="col-sm-6">
											<div class="form-group">
												<label>Nome </label>
												<input type="text" class="form-control" name="cli_nome" id="cli_nome" value="<?php echo $cli['cli_nome']; ?>">
											</div>
										</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label>Email </label>
												<input type="text" class="form-control" name="cli_email" id="cli_email" value="<?php echo $cli['cli_email']; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-3">
											<div class="form-group">
												<label>Telefone </label>
												<input type="text" class="form-control" name="cli_telefone" id="cli_telefone" value="<?php echo $cli['cli_telefone']; ?>">
											</div>
										</div>
										<div class="col-sm-3"></div>
										<div class="col-sm-6">
											<div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success float-left">
												<input type="checkbox" class="custom-control-input" id="customSwitch3">
												<label style="position: relative;top: 45px;" class="custom-control-label" for="customSwitch3">Status</label>
											</div>
										</div>
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

<script>
	$(window).on('load', function() {
		$('.nav-item').click(function() {
			$('.nav-link').removeClass('active');
			$(this).addClass('active');
			$('.tab-pane').hide();
			var id = $(this).attr('data-id');
			console.log(id);
			$('#' + id).css();
		});
	});
</script>