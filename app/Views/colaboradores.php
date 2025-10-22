<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>


<!-- Main content -->
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-10 mt-2">
				<h3 class="card-title">colaboradores</h3>
			</div>
			<div class="col-2">
				<button type="button" class="btn float-right btn-success" onclick="save()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i> <?= lang('App.new') ?></button>
			</div>
		</div>
	</div>
	<!-- /.card-header -->
	<div class="card-body">
		<table id="data_tablepessoa" class="table table-striped table-hover table-sm">
			<thead>
				<tr>
					<th>Código</th>
					<th>Conta</th>
					<th>Nome exibição</th>
					<th>Organização</th>
					<th>Ativo</th>
					<th style="text-align:center">Ações</th>
				</tr>
			</thead>
		</table>
	</div>
	<!-- /.card-body -->
</div>
<!-- /.card -->

<!-- /Main content -->

<!-- ADD modal content -->
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
			<div class="modal-header bg-primary text-center p-3" id="model-header">
				<h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
				<span type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
					<span style="margin-top:0px; margin-bottom:0px;font-size:50px">×</span>
				</span>
			</div>
			<div class="modal-body">
				<form id="dataFormColaborador" class="pl-3 pr-3">
					<input type="hidden" id="codColaborador" name="codColaborador" class="form-control" placeholder="Código" maxlength="11" required="">
					<input type="hidden" id="codOrganizacao" name="codOrganizacao" class="form-control" placeholder="CodOrganizacao" maxlength="11" value="10199">
					<div class="row">

					<div class="col-md-2">
							<label for="nomeCompleto">Contao: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="conta" name="conta1" class="form-control" placeholder="Nome Completo" maxlength="100">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<label for="nomeCompleto">Nome Completo: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="nomeCompleto" name="nomeCompleto" class="form-control" placeholder="Nome Completo" maxlength="100">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<label for="nomePrincipal">Nome de Guerra: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="nomePrincipal" name="nomePrincipal" class="form-control" placeholder="Nome de Guerra" maxlength="100">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-user"></span>
									</div>
								</div>
							</div>
						</div>


						<div class="col-md-3">
							<label for="identidade">Identidade: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="identidade" name="identidade" class="form-control" placeholder="Identidade" maxlength="15">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-id-card-alt"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-4">
							<label for="cpf">CPF: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" maxlength="15" inputmode="text">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-id-card-alt"></span>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-8">
							<label for="endereco">Endereço: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="endereco" name="endereco" class="form-control" placeholder="Endereço" maxlength="200">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-map-marker-alt"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">

						<div class="col-md-4">
							<label for="emailPessoal">Email: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="email" id="emailPessoal" name="emailPessoal" class="form-control" placeholder="Email Pessoal" maxlength="40">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-at"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<label for="telefoneTrabalho">Telefone do Trabalho: </label>
							<div class="input-group mb-3">
								<input type="text" id="telefoneTrabalho" name="telefoneTrabalho" class="form-control" placeholder="Telefone do Trabalho" maxlength="16">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-phone-square-alt"></span>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<label for="celular">Celular: <span class="text-danger">*</span></label>
							<div class="input-group mb-3">
								<input required="" type="text" id="celular" name="celular" class="form-control" placeholder="Celular" maxlength="16" inputmode="text">
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-mobile-alt"></span>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<label for="codOrganizacao">Organização: <span class="text-danger">*</span> </label>
							<div class="input-group mb-3">
								<select style="width:100%" id="codOrganizacao" name="codOrganizacao">
								</select>
								<div class="input-group-append">
									<div class="input-group-text">
										<span class="fas fa-address-card"></span>
									</div>
								</div>
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
									<input name="ativo" id="ativo" type="checkbox">
								</div>
								<label style="margin-left:10px;" for="checkboxativo"> A conta está ativa?</label>

							</div>
						</div>

						<div class="col-md-12 mt-2">
							<div class="form-group">
								<div class="icheck-primary d-inline">
									<style>
										input[type=checkbox] {
											transform: scale(1.8);
										}
									</style>
									<input required="" name="aceiteTermos" id="aceiteTermos" type="checkbox">

								</div>
								<label style="margin-left:10px" for="checkboxaceiteTermos"> Eu li e concordo com todos os termos do sistema.: <span class="text-danger">*</span> </label>
							</div>
						</div>

						<div class="row mt-4">
							<div class="col-md-12">
								<label for="informacoesComplementares">Informacoes Complementares: </label>
								<textarea class="form-control" id="informacoesComplementares" name="informacoesComplementares" rows="4" cols="50"></textarea>


							</div>
						</div>
					</div>

					<div class="form-group text-center">
						<div class="btn-group">
							<button type="submit" class="btn btn-success mr-2" id="form-btn"><?= lang("App.save") ?></button>
							<button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= lang("App.cancel") ?></button>
						</div>
					</div>

				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div>
<!-- /ADD modal content -->



<?= $this->endSection() ?>
<!-- /.content -->


<!-- page script -->
<?= $this->section("pageScript") ?>
<script>
	// dataTables
	$(function() {
		var table = $('#data_tablepessoa').removeAttr('width').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": true,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"scrollY": '45vh',
			"scrollX": true,
			"scrollCollapse": false,
			"responsive": false,
			"ajax": {
				"url": '<?php echo base_url($controller . '/getAll') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true"
			}
		});
	});

	var urlController = '';
	var submitText = '';

	function getUrl() {
		return urlController;
	}

	function getSubmitText() {
		return submitText;
	}




	function save(codColaborador) {

		// reset the form 
		$("#dataFormColaborador")[0].reset();
		$(".form-control").removeClass('is-invalid').removeClass('is-valid');
		if (typeof codColaborador === 'undefined' || codColaborador < 1) { //add
			urlController = '<?= base_url($controller . "/add") ?>';
			submitText = '<?= lang("App.save") ?>';
			$('#model-header').removeClass('bg-primary').addClass('bg-success');
			$("#info-header-modalLabel").text('<?= lang("App.add") ?>');
			$("#form-btn").text(submitText);
			$('#data-modal').modal('show');



			$.ajax({
				url: "<?php echo base_url("Organizacoes/listaDropDownOrganizacoes") ?>",
				type: "post",
				dataType: "json",
				data: {
					csrf_principal: $("#csrf_principal").val(),
				},
				success: function(unidade) {

					$("#dataFormColaborador #codOrganizacao").select2({
						data: unidade,
					})
					$("#dataFormColaborador #codOrganizacao").val(null);
					$("#dataFormColaborador #codOrganizacao").trigger("change");
					$(document).on("select2:open", () => {
						document.querySelector(".select2-search__field").focus();
					});
					$("#dataFormColaborador #codOrganizacao").select2({
						dropdownParent: $("#data-modal")
					});

				}
			})


		} else { //edit

			urlController = '<?= base_url($controller . "/edit") ?>';
			submitText = '<?= lang("App.update") ?>';
			$.ajax({
				url: '<?php echo base_url($controller . "/getOne") ?>',
				type: 'post',
				data: {
					codColaborador: codColaborador
				},
				dataType: 'json',
				success: function(response) {
					$('#model-header').removeClass('bg-success').addClass('bg-primary');
					$("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
					$("#form-btn").text(submitText);
					$('#data-modal').modal('show');
					//insert data to form
					$("#dataFormColaborador #conta").val(response.conta);
					$("#dataFormColaborador #codColaborador").val(response.codColaborador);
					$("#dataFormColaborador #codOrganizacao").val(response.codOrganizacao);
					$("#dataFormColaborador #nomeCompleto").val(response.nomeCompleto);
					$("#dataFormColaborador #nomePrincipal").val(response.nomePrincipal);
					$("#dataFormColaborador #identidade").val(response.identidade);
					$("#dataFormColaborador #cpf").val(response.cpf);
					$("#dataFormColaborador #endereco").val(response.endereco);
					$("#dataFormColaborador #emailPessoal").val(response.emailPessoal);
					$("#dataFormColaborador #telefoneTrabalho").val(response.telefoneTrabalho);
					$("#dataFormColaborador #celular").val(response.celular);
					$("#dataFormColaborador #codOrganizacao").val(response.codOrganizacao);


					if (response.ativo==1) {
						$('#dataFormColaborador #ativo').prop('checked', true);
					} else {
						$('#dataFormColaborador #ativo').prop('checked', false);
					}

					if (response.aceiteTermos==1) {
						$('#dataFormColaborador #aceiteTermos').prop('checked', true);
					} else {
						$('#dataFormColaborador #aceiteTermos').prop('checked', false);
					}


					$.ajax({
						url: '<?php echo base_url('Organizacoes/listaDropDownOrganizacoes') ?>',
						type: 'post',
						dataType: 'json',
						data: {
							csrf_principal: $("#csrf_principal").val(),
						},
						success: function(unidade) {

							$("#dataFormColaborador #codOrganizacao").select2({
								data: unidade,
							})
							$('#dataFormColaborador #codOrganizacao').val(response.codOrganizacao);
							$('#dataFormColaborador #codOrganizacao').trigger('change');
							$(document).on('select2:open', () => {
								document.querySelector('.select2-search__field').focus();
							});
							$('#dataFormColaborador #codOrganizacao').select2({
								dropdownParent: $('#data-modal')
							});

						}
					})



				}
			});
		}
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
				var form = $('#dataFormColaborador');
				$(".text-danger").remove();
				$.ajax({
					// fixBug get url from global function only
					// get global variable is bug!
					url: getUrl(),
					type: 'post',
					data: form.serialize(),
					cache: false,
					dataType: 'json',
					beforeSend: function() {

						Swal.fire({
							title: 'Estamos processando sua requisição',
							html: 'Aguarde....',
							timerProgressBar: true,
							timer: 3000,
							didOpen: () => {
								Swal.showLoading()
							}

						})

					},
					success: function(response) {
						if (response.success === true) {
							Swal.fire({
								toast: true,
								position: 'top-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_tablepessoa').DataTable().ajax.reload(null, false).draw(false);
								$('#data-modal').modal('hide');
							})
						} else {
							if (response.messages instanceof Object) {
								$.each(response.messages, function(index, value) {
									var ele = $("#" + index);
									ele.closest('.form-control')
										.removeClass('is-invalid')
										.removeClass('is-valid')
										.addClass(value.length > 0 ? 'is-invalid' : 'is-valid');
									ele.after('<div class="invalid-feedback">' + response.messages[index] + '</div>');
								});
							} else {
								Swal.fire({
									toast: false,
									icon: 'error',
									title: response.messages,
									showConfirmButton: false,
									timer: 3000
								})

							}
						}
						$('#form-btn').html(getSubmitText());
					}
				});
				return false;
			}
		});

		$('#dataFormColaborador').validate({

			//insert dataFormColaborador to database

		});
	}



	function remove(codColaborador) {
		Swal.fire({
			title: "<?= lang("App.remove-title") ?>",
			text: "<?= lang("App.remove-text") ?>",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: '<?= lang("App.confirm") ?>',
			cancelButtonText: '<?= lang("App.cancel") ?>'
		}).then((result) => {

			if (result.value) {
				$.ajax({
					url: '<?php echo base_url($controller . "/remove") ?>',
					type: 'post',
					data: {
						codColaborador: codColaborador
					},
					dataType: 'json',
					beforeSend: function() {

						Swal.fire({
							title: 'Estamos processando sua requisição',
							html: 'Aguarde....',
							timerProgressBar: true,
							timer: 3000,
							didOpen: () => {
								Swal.showLoading()
							}

						})

					},
					success: function(response) {

						if (response.success === true) {
							Swal.fire({
								toast: true,
								position: 'top-end',
								icon: 'success',
								title: response.messages,
								showConfirmButton: false,
								timer: 1500
							}).then(function() {
								$('#data_tablepessoa').DataTable().ajax.reload(null, false).draw(false);
							})
						} else {
							Swal.fire({
								toast: false,
								icon: 'error',
								title: response.messages,
								showConfirmButton: false,
								timer: 3000
							})
						}
					}
				});
			}
		})
	}
</script>


<?= $this->endSection() ?>