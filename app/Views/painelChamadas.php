<?php

$tituloPainel = "FILA DE ESPERA";


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta http-equiv="refresh" content="300">

	<title>Sandra </title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="shortcut icon" href="<?php echo base_url('/imagens/favicon.ico') ?>" type="image/x-icon" />


	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/fontawesome-free/css/all.min.css">
	<!-- SweetAlert2 -->
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/datatables/datatables.css">
	<!-- Theme style -->
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<script>
		var csrfName = '<?php echo csrf_token() ?>';
		var csrfHash = '<?php echo csrf_hash() ?>';
	</script>
	<input type="hidden" id="csrf_sandraPrincipal" name="csrf_sandraPrincipal" value="<?php echo csrf_hash() ?>">

</head>

<body>


	<audio hidden id="anuncio" controls>
		<source controls="true" autoplay="autoplay" loop="true" muted defaultmuted playsinline src="<?php echo base_url('/imagens/anuncio.mp3') ?>" type="audio/mpeg">
	</audio>



	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
				</div>
				<div style="padding-left:0; padding-right:0;padding-top:0;padding-bottom:0" class="card-body">

					<div class="col-md-12">
						<div class="card" style="transition: all 0.15s ease 0s; height: inherit; width: inherit;">

							<div class="col-md-12">
								<div style="padding-left:0; padding-right:0;padding-top:0;padding-bottom:0" class="card-body">
									<style>
										.carousel .carousel-item {
											transition-duration: 3s;
										}
									</style>
									<div id="slideShow" class="carousel slide" data-ride="carousel" data-interval="5000" data-pause="hover">

										<div class="carousel-inner">
											<div class="carousel-item active">

												<div style=" padding-left:0; padding-right:0;padding-top:0;padding-bottom:0" class="card-body">

													<div class="row">
														<div class="col-md-2">
														</div>
														<div class="col-md-8">
															<div style="margin-bottom:30px;height:40px; font-size:40px" class="align-middle font-weight-bold text-center">
																<span><img style="height:50px;" src="<?php echo base_url() . '/imagens/naps.jpeg' ?>"></span><?php echo $tituloPainel ?>
															</div>
														</div>


													</div>



													<div class="row">
														<div class="col-lg-6">
															<div class="card">
																<div class="card-header border-0">
																	<div class="d-flex justify-content-between">
																		<h1>Próximas Chamadas</h1>
																	</div>
																</div>
																<div class="card-body">
																	<table style="font-size:25px !important" id="data_tablePacientes" class="table table-striped table-hover table-sm">
																		<thead>
																			<tr>
																				<th>Paciente</th>
																				<th>Especialidade</th>
																				<th>Chegada</th>
																				<th>Espera</th>
																			</tr>
																		</thead>
																	</table>
																</div>
															</div>

														</div>

														<div class="col-lg-6">
															<div style="background:red; color:#fff" class="card">
																<div class="card-header border-0">
																	<div class="d-flex justify-content-between">
																		<h1>Últimas Chamadas</h1>
																	</div>
																</div>
																<div class="card-body">
																	<table style="color:#fff important; font-size:25px !important" id="data_tableUltimasChamadas" class="table table-striped table-hover table-sm">
																		<thead>
																			<tr style="color:#fff important;">
																				<th>Paciente</th>
																				<th>Chamadas</th>
																				<th>Especialista</th>
																			</tr>
																		</thead>
																	</table>
																</div>
															</div>

														</div>
													</div>





												</div>
											</div>

										</div>

									</div>

								</div>

							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

	</section>

	<style>
		.modal-backdrop {
			opacity: 0.8 !important;
		}
	</style>
	<div id="pacienteChamadoModal" style="position: fixed; top: 50%;  transform: translateY(-50%);" class="modal fade" role="dialog" aria-hidden="true">
		<div class="modal-dialog modal-xl">
			<div style="height: 600px;opacity: 0.8 !important;background:red;color:#fff" class="modal-content">

				<div class="modal-body ">
					<div style="font-size:40px;  position: relative; top: 50%;  transform: translateY(-50%);" class="text-center" id="pacienteChamado">
					</div>
				</div>
			</div>
		</div>
	</div>




</body>


<!-- jQuery -->
<script src="<?php echo base_url() ?>/asset/adminlte/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/bootstrap/js/bootstrap.min.js"></script>



<!-- DATATABLES -->
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/datatables/datatables.js"></script>

<script>
	$(function() {


		$.fn.dataTable.ext.errMode = 'none';

		$('#data_tablePacientes').DataTable({

			"bDestroy": true,
			"paging": false,
			"deferRender": true,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url('painelChamadas/painelChamadas') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true",
				data: {
					csrf_sandra: $("#csrf_sandraPrincipal").val(),
				}
			}
		})


		$('#data_tableUltimasChamadas').DataTable({

			"bDestroy": true,
			"paging": false,
			"deferRender": true,
			"lengthChange": false,
			"searching": false,
			"ordering": false,
			"info": false,
			"autoWidth": false,
			"responsive": true,
			"ajax": {
				"url": '<?php echo base_url('painelChamadas/pacientesUltimasChamadas') ?>',
				"type": "POST",
				"dataType": "json",
				async: "true",
				data: {
					csrf_sandra: $("#csrf_sandraPrincipal").val(),
				}
			}
		})





	});





	function atualizaTela() {
		$('#data_tablePacientes').DataTable().ajax.reload(null, false).draw(false);
		$('#data_tableUltimasChamadas').DataTable().ajax.reload(null, false).draw(false);



	}





	function verificaChamadas() {

		/*
		button.addEventListener('click', () => {
			if ('speechSynthesis' in window) {
				const to_speak = new SpeechSynthesisUtterance('');
				speechSynthesis.cancel();
				speechSynthesis.speak(to_speak);
			}
		});
*/


		$.ajax({
			url: '<?php echo base_url('painelChamadas/verificaChamadas') ?>',
			type: 'post',
			dataType: 'json',
			data: {
				csrf_sandra: $("#csrf_sandraPrincipal").val(),
			},
			success: function(verificaChamadas) {

				if (verificaChamadas.success === true) {


					$('#pacienteChamadoModal').modal('show');

					document.getElementById('pacienteChamado').innerHTML = verificaChamadas.pacienteModal;


					var x = document.getElementById("anuncio");
					x.play();

					textToSpeach(verificaChamadas.textoLeitura);

				} else {

					$('#pacienteChamadoModal').modal('hide');

				}


			}
		})
	}

	verificaChamadas();


	function textToSpeach(message) {
		const speach = new SpeechSynthesisUtterance(message);
		speach.volume = 1;
		speach.rate = 1;
		speach.lang = 'pt-BR';
		[speach.voice] = speechSynthesis.getVoices();

		speechSynthesis.speak(speach);
	}




	setInterval(function() {
		atualizaTela();
		verificaChamadas();
	}, 10000);
</script>