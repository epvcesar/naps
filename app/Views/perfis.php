<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<div class="row">
						<div class="col-md-8 mt-2">
							<h3 style="font-size:30px;font-weight: bold;" class="card-title">Perfis</h3>
						</div>
						<div class="col-md-4">
							<button type="button" class="btn btn-block btn-primary" onclick="add()" title="Adicionar"> <i class="fa fa-plus"></i> Adicionar</button>
						</div>
					</div>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="data_table" class="table table-striped table-hover table-sm">
						<thead>
							<tr>
								<th>Código</th>
								<th>Descrição</th>
								<th>Organização</th>

								<th></th>
							</tr>
						</thead>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- Add modal content -->
<div id="add-modal" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-center p-3">
				<h4 class="modal-title text-white" id="info-header-modalLabel">Adicionar <?php echo $title ?></h4>
				<a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
				</a>
			</div>
			<div class="modal-body">
				<form id="add-form" class="pl-3 pr-3">
					<div class="row">
						<input type="hidden" id="<?php echo csrf_token() ?>add-modal" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

						<input type="hidden" id="codPerfil" name="codPerfil" class="form-control" placeholder="Código" maxlength="11" required>
					</div>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="descricao"> Descrição: <span class="text-danger">*</span> </label>
								<input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descrição" maxlength="60" required>
							</div>
						</div>
						<div class="col-md-4">
							<input hidden type="text" id="codOrganizacao" name="codOrganizacao" value="<?php echo session()->codOrganizacao ?>" class="form-control" placeholder="Descrição" maxlength="60" required>
						</div>
					</div>

					<div class="form-group text-center">
						<div class="btn-group">
							<button type="submit" class="btn btn-xs btn-primary" id="add-form-btn">Adicionar</button>
							<button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Fechar" data-bs-dismiss="modal">Fechar</button>
						</div>
					</div>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="edit-modal" class="modal fade" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-center p-3">
				<h4 class="modal-title text-white" id="info-header-modalLabel">Atualizar <?php echo $title ?></h4>
				<a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
						<span style="margin-top:0px; margin-bottom:0px;font-size:50px" aria-hidden="true">×</span>
					</span> </a>
			</div>
			<div class="modal-body">



				<div class="col-12 col-sm-12">
					<div class="card card-primary">
						<div class="card-header p-0 border-bottom-0">
							<ul class="nav nav-tabs" id="Perfis" role="tablist">
								<li class="nav-item">
									<a class="nav-link active" id="perfil-tab" data-bs-toggle="pill" href="#perfil" role="tab" aria-controls="perfil" aria-selected="true">Perfil</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="previlegios-tab" data-bs-toggle="pill" href="#previlegios" role="tab" aria-controls="previlegios" aria-selected="false">Privilégios</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="atalhos-tab" data-bs-toggle="pill" href="#atalhos" role="tab" aria-controls="atalhos" aria-selected="false">Atalhos na Área de Trabalho</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="colaboradores-tab" data-bs-toggle="pill" href="#colaboradores" role="tab" aria-controls="colaboradores" aria-selected="false">Membros</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" id="grupos-tab" data-bs-toggle="pill" href="#grupos" role="tab" aria-controls="grupos" aria-selected="false">Grupos</a>
								</li>
							</ul>
						</div>
						<div class="card-body">
							<div class="tab-content" id="PerfisContent">
								<div class="tab-pane fade show active" id="perfil" role="tabpanel" aria-labelledby="perfil-tab">
									<form id="edit-form" class="pl-3 pr-3">
										<div class="row">
											<input type="hidden" id="<?php echo csrf_token() ?>edit-modal" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

											<input type="hidden" id="codPerfil" name="codPerfil" class="form-control" placeholder="Código" maxlength="11" required>
										</div>
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="descricao"> Descrição: <span class="text-danger">*</span> </label>
													<input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descrição" maxlength="60" required>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<div class="icheck-primary d-inline">
														<style>
															input[type=checkbox] {
																transform: scale(1.8);
															}
														</style>
														<input style="margin-left:5px;" name='perguntarLocalAtendimento' id='perguntarLocalAtendimento' type="checkbox">
													</div>
													<span style="margin-left:5px"><b>Perguntar local de atendimento no momento do login?</b></span>
												</div>
											</div>
										</div>
										<div class="form-group text-center">
											<div class="btn-group">
												<button type="submit" class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Salvar" id="edit-form-btn">Salvar</button>
												<button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Fechar" data-bs-dismiss="modal">Fechar</button>
											</div>
										</div>
									</form>
								</div>


								<div style="overflow-x: auto;" class="tab-pane fade" id="previlegios" role="tabpanel" aria-labelledby="previlegios-tab">



									<form id="perfisModulos-form" method="post">
										<button onclick="salvarPerfilModulos()" type="button" class="btn btn-xs btn-primary" id="perfisModulos-form-btn">SALVAR</button>
										<input type="hidden" id="<?php echo csrf_token() ?>perfisModulos-form" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

										<input type="hidden" id="codPerfil" name="codPerfil" class="form-control" placeholder="CodPerfil" maxlength="11">
										<input value="<?php echo session()->codOrganizacao ?>" type="hidden" id="codOrganizacao" name="codOrganizacao" class="form-control" placeholder="codOrganizacao" maxlength="11">

										<table id="data_tableperfisModulos" class="table table-striped table-hover table-sm">
											<thead>
												<tr>
													<th style="text-align:center">Módulo</th>
													<th style="text-align:center">
														Listar
														<div style="margin-left:5px" class="icheck-primary d-inline">
															<style>
																input[type=checkbox] {
																	transform: scale(1.8);
																}
															</style>
															<input class="listar" id="listar-all" type="checkbox">
														</div>

													</th>
													<th style="text-align:center">
														Adicionar
														<div style="margin-left:5px" class="icheck-primary d-inline">
															<style>
																input[type=checkbox] {
																	transform: scale(1.8);
																}
															</style>
															<input class="adicionar" id="adicionar-all" type="checkbox">
														</div>

													</th>
													<th style="text-align:center">
														Editar
														<div style="margin-left:5px" class="icheck-primary d-inline">
															<style>
																input[type=checkbox] {
																	transform: scale(1.8);
																}
															</style>
															<input class="editar" id="editar-all" type="checkbox">
														</div>
													</th>
													<th style="text-align:center">
														Deletar
														<div style="margin-left:5px" class="icheck-primary d-inline">
															<style>
																input[type=checkbox] {
																	transform: scale(1.8);
																}
															</style>
															<input class="deletar" id="deletar-all" type="checkbox">
														</div>

													</th>
												</tr>
											</thead>
										</table>
										<button onclick="salvarPerfilModulos()" type="button" class="btn btn-xs btn-primary" id="perfisModulos-form-btn">SALVAR</button>
									</form>
								</div>
								<div style="overflow-x: auto;" class="tab-pane fade" id="atalhos" role="tabpanel" aria-labelledby="atalhos-tab">

									<table id="data_atalhos" class="table table-striped table-hover table-sm">
										<thead>
											<tr>
												<th>Módulo</th>
												<th>Atalho Área de Trabalho</th>

												<th></th>
											</tr>
										</thead>
									</table>

								</div>

								<div class="tab-pane fade" id="colaboradores" role="tabpanel" aria-labelledby="colaboradores-tab">
									<div class="row ">
										<div class="col-12">
											<div class="card">
												<div class="card-header">
													<div class="row">
														<div class="col-md-8 mt-2">
															<h3 style="font-size:30px;font-weight: bold;" class="card-title">Membros do Perfil</h3>
														</div>
														<div class="col-md-4">
															<button type="button" class="btn btn-block btn-primary" onclick="addperfilColaboradoresMembro()" title="Adicionar"> <i class="fa fa-plus"></i> Adicionar</button>
														</div>
													</div>
												</div>
												<!-- /.card-header -->
												<div style="overflow-x: auto;" class="card-body">
													<table id="data_tableperfilColaboradoresMembro" class="table table-striped table-hover table-sm">
														<thead>
															<tr>
																<th>Membro</th>
																<th>Data Início</th>
																<th>Data Encerramento</th>

																<th></th>
															</tr>
														</thead>
													</table>
												</div>
												<!-- /.card-body -->
											</div>
											<!-- /.card -->
										</div>
										<!-- Add modal content -->
										<div id="add-modalperfilColaboradoresMembro" class="modal fade" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-xl">
												<div class="modal-content">
													<div class="modal-header bg-primary text-center p-3">
														<h4 class="modal-title text-white" id="info-header-modalLabel">Adicionar Membros do Perfil</h4>
														<a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
															<span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
														</a>
													</div>
													<div class="modal-body">
														<form id="add-formperfilColaboradoresMembro" class="pl-3 pr-3">
															<div class="row">
																<input type="hidden" id="<?php echo csrf_token() ?>AddformperfilColaboradoresMembro" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

																<input type="hidden" id="codColaboradorMembro" name="codColaboradorMembro" class="form-control" placeholder="Código" maxlength="11" required>
																<input type="hidden" id="codPerfil" name="codPerfil" class="form-control" placeholder="CodPerfil" maxlength="11" number="true" required>

															</div>
															<div class="row">

																<div class="col-md-4">
																	<div class="form-group">

																		<label for="codColaboradorAdd"> Membro: <span class="text-danger">*</span> </label>
																		<select style="width:100%" id="codColaboradorAdd" name="codColaborador" class="form-control select2" tabindex="-1" aria-hidden="true">
																			<option value=""></option>
																		</select>
																	</div>
																</div>

																<div class="col-md-4">
																	<div class="form-group">
																		<label for="dataInicio"> DataInicio: <span class="text-danger">*</span> </label>
																		<input type="date" id="dataInicio" name="dataInicio" class="form-control" dateISO="true" value="<?php echo date('Y-m-d') ?>" required>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="dataEncerramento"> DataEncerramento: </label>
																		<input type="date" id="dataEncerramento" name="dataEncerramento" class="form-control" dateISO="true">
																	</div>
																</div>
															</div>

															<div class="form-group text-center">
																<div class="btn-group">
																	<button type="submit" class="btn btn-xs btn-primary" id="add-formperfilColaboradoresMembro-btn">Adicionar</button>
																	<button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Fechar" data-bs-dismiss="modal">Fechar</button>
																</div>
															</div>
														</form>
													</div>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->

										<!-- Add modal content -->
										<div id="edit-modalperfilColaboradoresMembro" class="modal fade" role="dialog" aria-hidden="true">
											<div class="modal-dialog modal-xl">
												<div class="modal-content">
													<div class="modal-header bg-primary text-center p-3">
														<h4 class="modal-title text-white" id="info-header-modalLabel">Atualizar Membros do Perfil</h4>
														<a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
															<span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
														</a>
													</div>
													<div class="modal-body">
														<form id="edit-formperfilColaboradoresMembro" class="pl-3 pr-3">
															<div class="row">
																<input type="hidden" id="<?php echo csrf_token() ?>edit-modalperfilColaboradoresMembro" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

																<input type="hidden" id="codColaboradorMembro" name="codColaboradorMembro" class="form-control" placeholder="Código" maxlength="11" required>
																<input type="hidden" id="codColaborador" name="codColaborador" class="form-control" placeholder="Código" maxlength="11" required>
																<input type="hidden" id="codPerfil" name="codPerfil" class="form-control" placeholder="CodPerfil" maxlength="11" number="true" required>

															</div>
															<div class="row">

																<div class="col-md-4">
																	<div class="form-group">

																		<label for="codColaboradorLabel"> Membro: <span class="text-danger">*</span> </label>
																		<select style="width:100%" disabled id="codColaboradorLabel" class="form-control select2" tabindex="-1" aria-hidden="true">
																			<option value=""></option>
																		</select>
																	</div>
																</div>

																<div class="col-md-4">
																	<div class="form-group">
																		<label for="dataInicio"> DataInicio: <span class="text-danger">*</span> </label>
																		<input type="date" id="dataInicio" name="dataInicio" class="form-control" dateISO="true" required>
																	</div>
																</div>
																<div class="col-md-4">
																	<div class="form-group">
																		<label for="dataEncerramento"> DataEncerramento: </label>
																		<input type="date" id="dataEncerramento" name="dataEncerramento" class="form-control" dateISO="true">
																	</div>
																</div>
															</div>

															<div class="form-group text-center">
																<div class="btn-group">
																	<button type="submit" class="btn btn-xs btn-primary" id="edit-formperfilColaboradoresMembro-btn">Salvar</button>
																	<button type="button" class="btn btn-xs btn-danger" data-toggle="tooltip" data-placement="top" title="Fechar" data-bs-dismiss="modal">Fechar</button>
																</div>
															</div>
														</form>

													</div>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
									</div>
								</div>

								<div class="tab-pane fade" id="grupos" role="tabpanel" aria-labelledby="grupos-tab">
									Lista de grupos
									<div class="row ">
									</div>
								</div>



							</div>
						</div>
					</div>
				</div>





			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>

<?= $this->endSection() ?>
<!-- /.content -->


<!-- page script -->
<?= $this->section("pageScript") ?>


<script>
	var codPerfilTmp;


	$(function() {


		$('#data_table').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"pageLength": 100,
			"autoWidth": false,
			"height": '30px',
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url($controller . '/getAll') ?>',
				"type": "get",
				"dataType": "json",
				async: "true",
				data: {
					csrf_Principal: $("#csrf_Principal").val(),
				},
			}
		});
	});



	function salvarPerfilModulos() {


		var form = $('#perfisModulos-form');

		$.ajax({
			url: '<?php echo base_url($controller . '/salvaPermissoes') ?>',
			type: 'post',
			data: form.serialize(), // /converting the form data into array and sending it to server
			dataType: 'json',
			success: function(response) {

				if (response.success === true) {

					Swal.fire({
						position: 'bottom-end',
						icon: 'success',
						title: response.messages,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {
						$('#data_atalhos').DataTable().ajax.reload(null, false).draw(false);
					})

				}
			}
		}).always(
			Swal.fire({
				title: 'Estamos processando sua requisição',
				html: 'Aguarde....',
				timerProgressBar: true,
				didOpen: () => {
					Swal.showLoading()


				}

			}))
	};


	function addperfilColaboradoresMembro() {
		// reset the form 
		$("#add-formperfilColaboradoresMembro")[0].reset();
		$(".form-control").removeClass('is-invalid').removeClass('is-valid');
		$('#add-modalperfilColaboradoresMembro').modal('show');
		$("#add-modalperfilColaboradoresMembro #codPerfil").val(codPerfilTmp);




		$.ajax({
			url: '<?php echo base_url('colaboradores/listaDropDownColaboradores') ?>',
			type: 'post',
			dataType: 'json',
			data: {
				csrf_Principal: $("#csrf_Principal").val(),
			},
			success: function(colaboradoresAdd) {

				$("#codColaboradorAdd").select2({
					data: colaboradoresAdd,
					dropdownParent: $('#add-modalperfilColaboradoresMembro .modal-content'),
				})

				$('#codColaboradorAdd').val(null); // Select the option with a value of '1'
				$('#codColaboradorAdd').trigger('change');
				$(document).on('select2:open', () => {
					document.querySelector('.select2-search__field').focus();
				});

			}
		})


		// submit the add from 
		$.validator.setDefaults({
			highlight: function(element) {
				$(element).addClass('is-invalid').removeClass('is-valid');
			},
			unhighlight: function(element) {
				$(element).removeClass('is-invalid').addClass('is-valid');
			},
			errorElement: 'div ',
			errorClass: 'invalid-feedback',
			errorPlacement: function(error, element) {
				if (element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				} else if ($(element).is('.select')) {
					element.next().after(error);
				} else if (element.hasClass('select2')) {
					//error.insertAfter(element);
					error.insertAfter(element.next());
				} else if (element.hasClass('selectpicker')) {
					error.insertAfter(element.next());
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function(form) {

				var form = $('#add-formperfilColaboradoresMembro');
				// remove the text-danger
				$(".text-danger").remove();

				$.ajax({
					url: '<?php echo base_url($controller . '/addPerfilMembroColaborador') ?>',
					type: 'post',
					data: form.serialize(), // /converting the form data into array and sending it to server
					dataType: 'json',
					beforeSend: function() {
						//$('#add-formperfilColaboradoresMembro-btn').html('<i class="fa fa-spinner fa-spin"></i>');
					},
					success: function(response) {

						if (response.success === true) {

							Swal.fire({
								position: 'bottom-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_tableperfilColaboradoresMembro').DataTable().ajax.reload(null, false).draw(false);
								$('#add-modalperfilColaboradoresMembro').modal('hide');
							})

						} else {

							if (response.messages instanceof Object) {
								$.each(response.messages, function(index, value) {
									var id = $("#" + index);

									id.closest('.form-control')
										.removeClass('is-invalid')
										.removeClass('is-valid')
										.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

									id.after(value);

								});
							} else {
								Swal.fire({
									position: 'bottom-end',
									icon: 'error',
									title: response.messages,
									showConfirmButton: false,
									timer: 1500
								})

							}
						}
						$('#add-formperfilColaboradoresMembro-btn').html('Adicionar');
					}
				});

				return false;
			}
		});
		$('#add-formperfilColaboradoresMembro').validate();
	}




	function editperfilColaboradoresMembro(codColaboradorMembro) {
		$.ajax({
			url: '<?php echo base_url($controller . '/getOnePerfilColaboradorMembro') ?>',
			type: 'post',
			data: {
				codColaboradorMembro: codColaboradorMembro,
				csrf_Principal: $("#csrf_Principal").val(),

			},
			dataType: 'json',
			success: function(response) {
				// reset the form 
				$("#edit-formperfilColaboradoresMembro")[0].reset();
				$(".form-control").removeClass('is-invalid').removeClass('is-valid');
				$('#edit-modalperfilColaboradoresMembro').modal('show');
				$("#edit-formperfilColaboradoresMembro #codColaboradorMembro").val(response.codColaboradorMembro);
				$("#edit-formperfilColaboradoresMembro #codColaborador").val(response.codColaborador);
				$("#edit-formperfilColaboradoresMembro #codPerfil").val(response.codPerfil);
				$("#edit-formperfilColaboradoresMembro #dataInicio").val(response.dataInicio);
				$("#edit-formperfilColaboradoresMembro #dataEncerramento").val(response.dataEncerramento);



				$.ajax({
					url: '<?php echo base_url('colaboradores/listaDropDownColaboradores') ?>',
					type: 'post',
					dataType: 'json',
					data: {
						csrf_Principal: $("#csrf_Principal").val(),
					},
					success: function(colaboradoresLabel) {

						$("#codColaboradorLabel").select2({
							data: colaboradoresLabel,
						})

						$('#codColaboradorLabel').val(response.codColaborador); // Select the option with a value of '1'
						$('#codColaboradorLabel').trigger('change');
						$(document).on('select2:open', () => {
							document.querySelector('.select2-search__field').focus();
						});

					}
				})


				// submit the edit from 
				$.validator.setDefaults({
					highlight: function(element) {
						$(element).addClass('is-invalid').removeClass('is-valid');
					},
					unhighlight: function(element) {
						$(element).removeClass('is-invalid').addClass('is-valid');
					},
					errorElement: 'div ',
					errorClass: 'invalid-feedback',
					errorPlacement: function(error, element) {
						if (element.parent('.input-group').length) {
							error.insertAfter(element.parent());
						} else if ($(element).is('.select')) {
							element.next().after(error);
						} else if (element.hasClass('select2')) {
							//error.insertAfter(element);
							error.insertAfter(element.next());
						} else if (element.hasClass('selectpicker')) {
							error.insertAfter(element.next());
						} else {
							error.insertAfter(element);
						}
					},

					submitHandler: function(form) {
						var form = $('#edit-formperfilColaboradoresMembro');
						$(".text-danger").remove();
						$.ajax({
							url: '<?php echo base_url($controller . '/editPerfilMembroColaborador') ?>',
							type: 'post',
							data: form.serialize(),
							dataType: 'json',
							beforeSend: function() {
								//$('#edit-formperfilColaboradoresMembro-btn').html('<i class="fa fa-spinner fa-spin"></i>');
							},
							success: function(response) {

								if (response.success === true) {

									Swal.fire({
										position: 'bottom-end',
										icon: 'success',
										title: response.messages,
										showConfirmButton: false,
										timer: 1500
									}).then(function() {
										$('#data_tableperfilColaboradoresMembro').DataTable().ajax.reload(null, false).draw(false);
										$('#edit-modalperfilColaboradoresMembro').modal('hide');
									})

								} else {

									if (response.messages instanceof Object) {
										$.each(response.messages, function(index, value) {
											var id = $("#" + index);

											id.closest('.form-control')
												.removeClass('is-invalid')
												.removeClass('is-valid')
												.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

											id.after(value);

										});
									} else {
										Swal.fire({
											position: 'bottom-end',
											icon: 'error',
											title: response.messages,
											showConfirmButton: false,
											timer: 1500
										})

									}
								}
								$('#edit-formperfilColaboradoresMembro-btn').html('Salvar');
							}
						});

						return false;
					}
				});
				$('#edit-formperfilColaboradoresMembro').validate();

			}
		});
	}


	function add() {
		// reset the form 
		$("#add-form")[0].reset();
		$(".form-control").removeClass('is-invalid').removeClass('is-valid');
		$('#add-modal').modal('show');
		// submit the add from 
		$.validator.setDefaults({
			highlight: function(element) {
				$(element).addClass('is-invalid').removeClass('is-valid');
			},
			unhighlight: function(element) {
				$(element).removeClass('is-invalid').addClass('is-valid');
			},
			errorElement: 'div ',
			errorClass: 'invalid-feedback',
			errorPlacement: function(error, element) {
				if (element.parent('.input-group').length) {
					error.insertAfter(element.parent());
				} else if ($(element).is('.select')) {
					element.next().after(error);
				} else if (element.hasClass('select2')) {
					//error.insertAfter(element);
					error.insertAfter(element.next());
				} else if (element.hasClass('selectpicker')) {
					error.insertAfter(element.next());
				} else {
					error.insertAfter(element);
				}
			},

			submitHandler: function(form) {

				var form = $('#add-form');
				// remove the text-danger
				$(".text-danger").remove();

				$.ajax({
					url: '<?php echo base_url($controller . '/add') ?>',
					type: 'post',
					data: form.serialize(), // /converting the form data into array and sending it to server
					dataType: 'json',
					beforeSend: function() {
						//$('#add-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
					},
					success: function(response) {

						if (response.success === true) {

							Swal.fire({
								position: 'bottom-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_table').DataTable().ajax.reload(null, false).draw(false);
								$('#add-modal').modal('hide');
							})

						} else {

							if (response.messages instanceof Object) {
								$.each(response.messages, function(index, value) {
									var id = $("#" + index);

									id.closest('.form-control')
										.removeClass('is-invalid')
										.removeClass('is-valid')
										.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

									id.after(value);

								});
							} else {
								Swal.fire({
									position: 'bottom-end',
									icon: 'error',
									title: response.messages,
									showConfirmButton: false,
									timer: 1500
								})

							}
						}
						$('#add-form-btn').html('Adicionar');
					}
				});

				return false;
			}
		});
		$('#add-form').validate();
	}

	$('#listar-all').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			$('.listar').each(function() {
				this.checked = true;
			});
		} else {
			$('.listar').each(function() {
				this.checked = false;
			});
		}
	});

	$('#adicionar-all').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			$('.adicionar').each(function() {
				this.checked = true;
			});
		} else {
			$('.adicionar').each(function() {
				this.checked = false;
			});
		}
	});

	$('#editar-all').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			$('.editar').each(function() {
				this.checked = true;
			});
		} else {
			$('.editar').each(function() {
				this.checked = false;
			});
		}
	});

	$('#deletar-all').click(function(event) {
		if (this.checked) {
			// Iterate each checkbox
			$('.deletar').each(function() {
				this.checked = true;
			});
		} else {
			$('.deletar').each(function() {
				this.checked = false;
			});
		}
	});


	function edit(codPerfil) {
		codPerfilTmp = codPerfil;
		$('#data_tableperfisModulos').DataTable({
			"bDestroy": true,
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url($controller . '/getAllPerfisModulos') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true",
				data: {
					codPerfil: codPerfil,
					csrf_Principal: $("#csrf_Principal").val(),
				},
			}
		});





		codPerfilTmp = codPerfil;
		$('#data_atalhos').DataTable({
			"bDestroy": true,
			"paging": false,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": false,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url($controller . '/atalhosPerfil') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true",
				data: {
					codPerfil: codPerfil,
					csrf_Principal: $("#csrf_Principal").val(),
				},
			}
		});



		$('#data_tableperfilColaboradoresMembro').DataTable({
			"bDestroy": true,
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": false,
			"info": true,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url($controller . '/getMembros') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true",
				data: {
					codPerfil: codPerfil,
					csrf_Principal: $("#csrf_Principal").val(),
				},
			}
		});


		$.ajax({
			url: '<?php echo base_url($controller . '/getOne') ?>',
			type: 'post',
			data: {
				codPerfil: codPerfil,
				csrf_Principal: $("#csrf_Principal").val(),
			},
			dataType: 'json',
			success: function(response) {
				// reset the form 
				$("#edit-form")[0].reset();
				$(".form-control").removeClass('is-invalid').removeClass('is-valid');
				$('#edit-modal').modal('show');

				$("#edit-form #codPerfil").val(response.codPerfil);
				$("#edit-form #descricao").val(response.descricao);

				$('.modal-title').text(response.descricao);


				if (response.perguntarLocalAtendimento == 1) {
					document.getElementById("perguntarLocalAtendimento").checked = true;
				} else {
					document.getElementById("perguntarLocalAtendimento").checked = false;
				}



				$("#perfisModulos-form #codPerfil").val(response.codPerfil);
				document.getElementById("listar-all").checked = false;
				document.getElementById("adicionar-all").checked = false;
				document.getElementById("editar-all").checked = false;
				document.getElementById("deletar-all").checked = false;

				// submit the edit from 
				$.validator.setDefaults({
					highlight: function(element) {
						$(element).addClass('is-invalid').removeClass('is-valid');
					},
					unhighlight: function(element) {
						$(element).removeClass('is-invalid').addClass('is-valid');
					},
					errorElement: 'div ',
					errorClass: 'invalid-feedback',
					errorPlacement: function(error, element) {
						if (element.parent('.input-group').length) {
							error.insertAfter(element.parent());
						} else if ($(element).is('.select')) {
							element.next().after(error);
						} else if (element.hasClass('select2')) {
							//error.insertAfter(element);
							error.insertAfter(element.next());
						} else if (element.hasClass('selectpicker')) {
							error.insertAfter(element.next());
						} else {
							error.insertAfter(element);
						}
					},

					submitHandler: function(form) {
						var form = $('#edit-form');
						$(".text-danger").remove();
						$.ajax({
							url: '<?php echo base_url($controller . '/edit') ?>',
							type: 'post',
							data: form.serialize(),
							dataType: 'json',
							beforeSend: function() {
								//$('#edit-form-btn').html('<i class="fa fa-spinner fa-spin"></i>');
							},
							success: function(response) {

								if (response.success === true) {

									Swal.fire({
										position: 'bottom-end',
										icon: 'success',
										title: response.messages,
										showConfirmButton: false,
										timer: 1500
									}).then(function() {
										$('#data_table').DataTable().ajax.reload(null, false).draw(false);
										$('#edit-modal').modal('hide');
									})

								} else {

									if (response.messages instanceof Object) {
										$.each(response.messages, function(index, value) {
											var id = $("#" + index);

											id.closest('.form-control')
												.removeClass('is-invalid')
												.removeClass('is-valid')
												.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');

											id.after(value);

										});
									} else {
										Swal.fire({
											position: 'bottom-end',
											icon: 'error',
											title: response.messages,
											showConfirmButton: false,
											timer: 1500
										})

									}
								}
								$('#edit-form-btn').html('Salvar');
							}
						});

						return false;
					}
				});
				$('#edit-form').validate();

			}
		});
	}


	function removeperfilColaboradoresMembro(codColaboradorMembro) {
		Swal.fire({
			title: 'Você tem certeza que deseja remover?',
			text: "Você não poderá reverter após a confirmação",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Confirmar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {

			if (result.value) {
				$.ajax({
					url: '<?php echo base_url($controller . '/removeColaboradorMembro') ?>',
					type: 'post',
					data: {
						codColaboradorMembro: codColaboradorMembro,
						csrf_Principal: $("#csrf_Principal").val(),
					},
					dataType: 'json',
					success: function(response) {

						if (response.success === true) {
							Swal.fire({
								position: 'bottom-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_tableperfilColaboradoresMembro').DataTable().ajax.reload(null, false).draw(false);
							})
						} else {
							Swal.fire({
								position: 'bottom-end',
								icon: 'error',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							})


						}
					}
				});
			}
		})
	}

	function remove(codPerfil) {
		Swal.fire({
			title: 'Você tem certeza que deseja remover?',
			text: "Você não poderá reverter após a confirmação",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Confirmar',
			cancelButtonText: 'Cancelar'
		}).then((result) => {

			if (result.value) {
				$.ajax({
					url: '<?php echo base_url($controller . '/remove') ?>',
					type: 'post',
					data: {
						codPerfil: codPerfil,
						csrf_Principal: $("#csrf_Principal").val(),
					},
					dataType: 'json',
					success: function(response) {

						if (response.success === true) {
							Swal.fire({
								position: 'bottom-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_table').DataTable().ajax.reload(null, false).draw(false);
							})
						} else {
							Swal.fire({
								position: 'bottom-end',
								icon: 'error',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							})


						}
					}
				});
			}
		})
	}

	function atualizaPerfilAtalho(codPerfil, codAtalho, codModulo, cmdo) {

		$.ajax({
			url: '<?php echo base_url($controller . '/atualizaPerfilAtalho') ?>',
			type: 'post',
			data: {
				codPerfil: codPerfil,
				codAtalho: codAtalho,
				codModulo: codModulo,
				cmdo: cmdo,
				csrf_Principal: $("#csrf_Principal").val(),
			},
			dataType: 'json',
			success: function(response) {

				if (response.success === true) {
					Swal.fire({
						position: 'bottom-end',
						icon: 'success',
						title: response.messages,
						showConfirmButton: false,
						timer: 1500
					}).then(function() {
						$('#data_atalhos').DataTable().ajax.reload(null, false).draw(false);
					})
				} else {
					Swal.fire({
						position: 'bottom-end',
						icon: 'error',
						title: response.messages,
						showConfirmButton: false,
						timer: 1500
					})


				}
			}
		});
	}
</script>


<?= $this->endSection() ?>