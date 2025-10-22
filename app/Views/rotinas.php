<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>
<!-- Main content -->
<section class="content">



  <div class="row">
    <div class="col-md-12">
      <div class="card card-primary">
        <div class="card-header">
          <h3 Style="font-size:20px;font-weight:bold" class="card-title">ROTINAS GENÉRICAS</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <div class="card-body">

        <div class="row">
            <div class="col-sm-4">
              <button type="button" class="btn btn-lg btn-primary" onclick="diferencaEsquema()" title="Diferença Esquema"> <i class="fas fa-file-import"></i> Diferença Esquema</button>
            </div>
          </div>


        </div>
      </div>
    </div>

  </div>



</section>

<div id="lookupEspecialistasModal" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-center p-3">
        <h4 class="modal-title text-white" id="info-header-modalLabel">Desativação de Colaborador</h4>
        <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
        </a>
      </div>
      <div class="modal-body">

        <form id="confirmacaoDesativacaoForm" class="pl-3 pr-3">
          <input type="hidden" id="<?php echo csrf_token() ?>confirmacaoDesativacaoForm" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

          <button type="button" onclick="desativado_salvarLink()" class="btn btn-xs btn-success" id="add-form-colaborador-btn">Salvar</button>

          <div id="lookupEspecialistasForm"></div>

          <button type="button" onclick="desativado_salvarLink()" class="btn btn-xs btn-success" id="add-form-colaborador-btn">Salvar</button>
        </form>



      </div>
    </div>
  </div>
</div>



<div id="diferencaEsquemaModal" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-center p-3">
        <h4 class="modal-title text-white" id="info-header-modalLabel">Desativação de Colaborador</h4>
        <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
        </a>
      </div>
      <div class="modal-body">
        <div id="alteracoesNoEsquema"></div>
      </div>
    </div>
  </div>
</div>



<div id="federacoesModal" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-center p-3">
        <h4 class="modal-title text-white" id="info-header-modalLabel">Federações</h4>
        <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
        </a>
      </div>
      <div class="modal-body">
        <table id="data_tablefederacoes" class="table table-striped table-hover table-sm">
          <thead>
            <tr>
              <th>Código</th>
              <th>Decrição</th>
              <th>Servidor</th>
              <th>Banco</th>
              <th>Login</th>
              <th>Senha</th>
              <th></th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
  </div>
</div>





<div id="ajustarLookupsModal" class="modal fade" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-primary text-center p-3">
        <h4 class="modal-title text-white" id="info-header-modalLabel">Ajustar tabelas de Lookups</h4>
        <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span style="font-size:3rem; color:#fff" aria-hidden="true">×</span>
        </a>
      </div>
      <div class="modal-body">
        <div class="col-12 col-sm-12">
          <div class="card card-primary card-tabs">
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-tabs-one-home-tab" data-toggle="pill" href="#custom-tabs-one-home" role="tab" aria-controls="custom-tabs-one-home" aria-selected="true">Especialidades</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-tabs-one-profile-tab" data-toggle="pill" href="#custom-tabs-one-profile" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Colaboradores</a>
                </li>
              </ul>
            </div>
            <div class="card-body">
              <div class="tab-content" id="custom-tabs-one-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                  <form id="especialidadeLookupForm" class="pl-3 pr-3">
                    <input type="hidden" id="<?php echo csrf_token() ?>especialidadeLookupForm" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

                    <div class="row">
                      <div>
                        <button type="button" class="btn btn-primary" onclick="gravaEspecialidadesLoockup()" title="Salvar">Salvar</button>
                      </div>
                    </div>

                    <table id="data_tableespecialidades" class="table table-striped table-hover table-sm">
                      <thead>
                        <tr>
                          <th>ID SIGH</th>
                          <th>Especialidade SIGH</th>
                          <th>Especialidade CDS SAÚDE</th>
                        </tr>
                      </thead>
                    </table>

                    <div class="row">
                      <div>
                        <button type="button" class="btn btn-primary" onclick="gravaEspecialidadesLoockup()" title="Salvar">Salvar</button>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="tab-pane fade" id="custom-tabs-one-profile" role="tabpanel" aria-labelledby="custom-tabs-one-profile-tab">

                  <form id="colaboradoresLookupForm" class="pl-3 pr-3">
                    <input type="hidden" id="<?php echo csrf_token() ?>colaboradoresLookupForm" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

                    <div class="row">
                      <div>
                        <button type="button" class="btn btn-primary" onclick="gravaColaboradoresLoockup()" title="Salvar">Salvar</button>
                      </div>
                    </div>
                    <table id="data_tablepesoas" class="table table-striped table-hover table-sm">
                      <thead>
                        <tr>
                          <th>ID COLABORADOR</th>
                          <th>Colaborador SIGH</th>
                          <th>Colaborador CDS SAÚDE</th>
                        </tr>
                      </thead>
                    </table>

                    <div class="row">
                      <div>
                        <button type="button" class="btn btn-primary" onclick="gravaColaboradoresLoockup()" title="Salvar">Salvar</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>

      </div>
    </div>
  </div>
</div>


<?= $this->endSection() ?>
<!-- /.content -->


<!-- page script -->
<?= $this->section("pageScript") ?>

<script>
  function gravaEspecialidadesLoockup() {


    var form = $('#especialidadeLookupForm');

    $.ajax({
      url: '<?php echo base_url('rotinas/salvarEspecialidadeLookup') ?>',
      type: 'post',
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success: function(salvarEspecialidadeLookpup) {

        if (salvarEspecialidadeLookpup.success === true) {

          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: salvarEspecialidadeLookpup.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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

  }

  function gravaColaboradoresLoockup() {


    var form = $('#colaboradoresLookupForm');

    $.ajax({
      url: '<?php echo base_url('rotinas/salvarColaboradorLookup') ?>',
      type: 'post',
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success: function(salvarColaboradorLookup) {

        if (salvarColaboradorLookup.success === true) {

          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: salvarColaboradorLookup.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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

  }

  function salvarLink() {


    var form = $('#confirmacaoDesativacaoForm');

    $.ajax({
      url: '<?php echo base_url('rotinas/salvarReferenciaLookup') ?>',
      type: 'post',
      data: form.serialize(), // /converting the form data into array and sending it to server
      dataType: 'json',
      success: function(salvarLink) {

        if (salvarLink.success === true) {

          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: salvarLink.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })

        }

      }
    })

  }

  function importarClientes() {


    Swal.fire({
      title: 'Deseja importar dados de clientes do sistema anterior?',
      text: "Esta ação irá trazer dados de clientes para o sistema atual locais",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {




        //EXECUTA JSON DE IMPORTAÇÃO
        $.ajax({
          url: '<?php echo base_url('clientes/importarClientes/') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function(response) {
            if (response.success === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                html: response.messages,
                showConfirmButton: true,
                confirmButtonText: 'Ok',

              }).then(function() {

                // $('#data_tablecliente').DataTable().ajax.reload(null, false).draw(false);
                //$('#editClienteLogada').modal('hide');
              })


            }

            if (response.erro === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 5000
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


      } else {
        Swal.fire({
          title: 'Cancelado!',
          text: "Tenha certeza da operação a ser realizada",
          icon: 'info',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Fechar',
          timer: 3000,
        })
      }
    })

  }

  function ajustarLookups() {


    $('#ajustarLookupsModal').modal('show');


    $('#data_tableespecialidades').DataTable({
      "bDestroy": true,
      "paging": false,
      "deferRender": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "ajax": {
        "url": '<?php echo base_url('rotinas/ajustarLookupsEspecialidades') ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
        data: {
          csrf_Principal: $("#csrf_Principal").val(),
        },
      }
    });


    $('#data_tablepesoas').DataTable({
      "bDestroy": true,
      "paging": false,
      "deferRender": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "ajax": {
        "url": '<?php echo base_url('rotinas/ajustarLookupsColaboradores') ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
        data: {
          csrf_Principal: $("#csrf_Principal").val(),
        },
      }
    });
  }


  function importarClientesSIGH() {


    Swal.fire({
      title: 'Deseja importar dados de clientes do sistema anterior?',
      text: "Esta ação irá trazer dados de clientes para o sistema atual locais",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {




        //EXECUTA JSON DE IMPORTAÇÃO
        $.ajax({
          url: '<?php echo base_url('clientes/importarClientesSIGH/') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function(response) {
            if (response.success === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                html: response.messages,
                showConfirmButton: true,
                confirmButtonText: 'Ok',

              }).then(function() {

                // $('#data_tablecliente').DataTable().ajax.reload(null, false).draw(false);
                //$('#editClienteLogada').modal('hide');
              })


            }

            if (response.erro === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 5000
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


      } else {
        Swal.fire({
          title: 'Cancelado!',
          text: "Tenha certeza da operação a ser realizada",
          icon: 'info',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Fechar',
          timer: 3000,
        })
      }
    })

  }

  function importarColaboradores() {


    Swal.fire({
      title: 'Deseja importar dados de colaboradores colaboradoras do sistema anterior?',
      text: "Esta ação irá trazer dados de colaboradores para o sistema atual locais",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {




        //EXECUTA JSON DE IMPORTAÇÃO
        $.ajax({
          url: '<?php echo base_url('rotinas/importarColaboradoresSIGH/') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function(response) {
            if (response.success === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                html: response.messages,
                showConfirmButton: true,
                confirmButtonText: 'Ok',

              }).then(function() {

                // $('#data_tablecliente').DataTable().ajax.reload(null, false).draw(false);
                //$('#editClienteLogada').modal('hide');
              })


            }

            if (response.erro === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 5000
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


      } else {
        Swal.fire({
          title: 'Cancelado!',
          text: "Tenha certeza da operação a ser realizada",
          icon: 'info',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Fechar',
          timer: 3000,
        })
      }
    })

  }

  function atualizaPrecClientes() {

    /*
        Swal.fire({
          title: 'Deseja importar dados de clientes do sistema anterior?',
          text: "Esta ação irá trazer dados de clientes para o sistema atual locais",
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {




            //EXECUTA JSON DE IMPORTAÇÃO
            $.ajax({
              url: '<?php echo base_url('clientes/atualizaPrecClientes/') ?>',
    type: 'post',
      dataType: 'json',
        data: {
      csrf_Principal: $("#csrf_Principal").val(),
              },
    success: function(response) {
      if (response.success === true) {

        Swal.fire({
          position: 'bottom-end',
          icon: 'success',
          html: response.messages,
          showConfirmButton: true,
          confirmButtonText: 'Ok',

        }).then(function () {

          // $('#data_tablecliente').DataTable().ajax.reload(null, false).draw(false);
          //$('#editClienteLogada').modal('hide');
        })


      }

      if (response.erro === true) {

        Swal.fire({
          position: 'bottom-end',
          icon: 'error',
          title: response.messages,
          showConfirmButton: false,
          timer: 5000
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


          } else {
    Swal.fire({
      title: 'Cancelado!',
      text: "Tenha certeza da operação a ser realizada",
      icon: 'info',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Fechar',
      timer: 3000,
    })
  }
        })
    * /
  }


  function importarContatos() {


    Swal.fire({
      title: 'Deseja importar dados de contatos dos clientes do sistema anterior?',
      text: "Esta ação irá trazer dados de clientes para o sistema atual locais",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {




        //EXECUTA JSON DE IMPORTAÇÃO
        $.ajax({
          url: '<?php echo base_url('clientes/importarContatos/') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function (response) {
            if (response.success === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                html: response.messages,
                showConfirmButton: true,
                confirmButtonText: 'Ok',

              }).then(function () {

                $('#data_tablecliente').DataTable().ajax.reload(null, false).draw(false);
                //$('#editClienteLogada').modal('hide');
              })


            }

            if (response.erro === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 5000
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


      } else {
        Swal.fire({
          title: 'Cancelado!',
          text: "Tenha certeza da operação a ser realizada",
          icon: 'info',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Fechar',
          timer: 3000,
        })
      }
    })

  }



  function importarEspecialidades() {


    Swal.fire({
      title: 'Deseja importar dados de especialidades do sistema anterior?',
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {




        //EXECUTA JSON DE IMPORTAÇÃO
        $.ajax({
          url: '<?php echo base_url('especialidades/importarEspecialidades/') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function (response) {
            if (response.success === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                html: response.messages,
                showConfirmButton: true,
                confirmButtonText: 'Ok',

              })


            }

            if (response.erro === true) {

              Swal.fire({
                position: 'bottom-end',
                icon: 'error',
                title: response.messages,
                showConfirmButton: false,
                timer: 5000
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


      } else {
        Swal.fire({
          title: 'Cancelado!',
          text: "Tenha certeza da operação a ser realizada",
          icon: 'info',
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Fechar',
          timer: 3000,
        })
      }
    })

  }


  function importarColaboradoresApolo() {

    Swal.fire({
      position: 'bottom-end',
      icon: 'warning',
      title: 'Funcionalidade desativada porque já cumpriu sua finalidade',
      html: 'Novas colaboradores devem ser adicionadas manualmente no sistema',
      showConfirmButton: false,
      timer: 4000
    })

    /*
        Swal.fire({
          title: 'Deseja importar as colaboradores/funcionários do sistema anterior?',
          icon: 'info',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Confirmar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.value) {




            //EXECUTA JSON DE IMPORTAÇÃO
            $.ajax({
              url: '<?php echo base_url('colaboradores/importarColaboradoresApolo/') ?>',
    type: 'post',
      dataType: 'json',
        success: function(response) {
          if (response.success === true) {

            Swal.fire({
              position: 'bottom-end',
              icon: 'success',
              html: response.messages,
              showConfirmButton: true,
              confirmButtonText: 'Ok',

            })


          }

          if (response.erro === true) {

            Swal.fire({
              position: 'bottom-end',
              icon: 'error',
              title: response.messages,
              showConfirmButton: false,
              timer: 5000
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


          } else {
    Swal.fire({
      title: 'Cancelado!',
      text: "Tenha certeza da operação a ser realizada",
      icon: 'info',
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Fechar',
      timer: 3000,
    })
  }
        })

        * /

  }


  function lookupEspecialistasApolo() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/lookupEspecialistasApolo') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function (responselookupEspecialistasApolo) {

        if (responselookupEspecialistasApolo.success === true) {
          $('#lookupEspecialistasModal').modal('show');
          Swal.close();
          document.getElementById('lookupEspecialistasForm').innerHTML = responselookupEspecialistasApolo.form;


        }

        $.ajax({
          url: '<?php echo base_url('colaboradores/listaTodasColaboradoresAteDesativados') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function (colaboradores) {


            $("select[id*='colaborador']").select2({
              data: colaboradores,
            })

          }
        })

      }
    }).always(
      Swal.fire({
        title: 'Estamos processando sua requisição',
        html: 'Aguarde....',
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()


        }
      })

    )

  }


  function importarAtendimentosAmbulatorios() {

    Swal.fire({
      position: 'bottom-end',
      icon: 'warning',
      title: 'Funcionalidade desativada',
      html: 'Não é possível remover clientes do sistema.',
      showConfirmButton: false,
      timer: 4000
    })


    //EXECUTA JSON DE IMPORTAÇÃO

    /*
    $.ajax({
      url: '<php echo base_url('rotinas/importarAtendimentosAmbulatorios') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarAtendimentosAmbulatorios) {

        if (importarAtendimentosAmbulatorios.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarAtendimentosAmbulatorios.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })


        }


      }
    }).always(
      Swal.fire({
        title: 'Estamos importando os atendimentos ambulatóriais',
        html: 'Aguarde....',
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()


        }
      })

    )

    */

  }


  function importarItensHospitalares_old() {


    Swal.fire({
      position: 'bottom-end',
      icon: 'warning',
      title: 'Funcionalidade desativada',
      showConfirmButton: false,
      timer: 4000
    })


    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarItensHospitalares') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarItensFarmacia) {

        if (importarItensFarmacia.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarItensFarmacia.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })


        }


      }
    }).always(
      Swal.fire({
        title: 'Estamos importando os Itens de Farmácia',
        html: 'Aguarde....',
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()


        }
      })

    )


  }


  function diferencaEsquema() {


    $('#federacoesModal').modal('show');

    $('#data_tablefederacoes').DataTable({
      "paging": true,
      "bDestroy": true,
      "deferRender": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
      "ajax": {
        "url": '<?php echo base_url('federacoes/verificarEsquema') ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
        data: {
          csrf_Principal: $("#csrf_Principal").val(),
        },
      }
    });


  }

  function diferencaEsquemaAgora(codFederacao) {

    $('#federacoesModal').modal('hide');
    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/diferencaEsquema') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        codFederacao: codFederacao,
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(responseDiferencaEsquema) {

        if (responseDiferencaEsquema.success === true) {
          $('#diferencaEsquemaModal').modal('show');



          Swal.close();
          document.getElementById('alteracoesNoEsquema').innerHTML = responseDiferencaEsquema.alteracoes;


        }

        if (responseDiferencaEsquema.erro === true) {

          Swal.fire({
            position: 'bottom-end',
            icon: 'error',
            title: responseDiferencaEsquema.messages,
            showConfirmButton: false,
            timer: 5000
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
      })

    )

  }


  function importarPrescricoesEPrescricoes_old() {


    Swal.fire({
      position: 'bottom-end',
      icon: 'warning',
      title: 'Funcionalidade desativada',
      showConfirmButton: false,
      timer: 4000
    })

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarPrescricoesEPrescricoes') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarPrescricoesEPrescricoes) {

        if (importarPrescricoesEPrescricoes.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarPrescricoesEPrescricoes.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })

        }


      }
    }).always(
      Swal.fire({
        title: 'Estamos Importando as prescrições e Evoluçõs',
        html: 'Aguarde....',
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()


        }
      })

    )



  }

  function sincronizaKits_old() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/sincronizaKits') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(sincronizaKits) {

        if (sincronizaKits.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: sincronizaKits.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })


        }


      }
    }).always(
      Swal.fire({
        title: 'Estamos Sincronizando os Kits',
        html: 'Aguarde....',
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading()


        }
      })

    )

  }

  function redefineSenhaTodos() {


    Swal.fire({
      title: 'Deseja Redefinir a senha de todos os usuários para o PREC?',
      text: "NÃO REALIZE ESTA AÇÃO SE NÃO TIVER CERTEZA. O SISTEMA REGISTRARÁ AUDITORIA",
      icon: 'info',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Confirmar',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.value) {

        //EXECUTA JSON DE IMPORTAÇÃO
        $.ajax({
          url: '<?php echo base_url('rotinas/redefineSenhaTodos') ?>',
          type: 'post',
          dataType: 'json',
          data: {
            csrf_Principal: $("#csrf_Principal").val(),
          },
          success: function(redefinirSenhasClientes) {

            if (redefinirSenhasClientes.success === true) {


              Swal.fire({
                position: 'bottom-end',
                icon: 'success',
                html: redefinirSenhasClientes.messages,
                showConfirmButton: true,
                confirmButtonText: 'Ok',

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
          })

        )


      }
    })



  }

  function importarAgendas_old() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarAgendas') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarAgendas) {

        if (importarAgendas.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarAgendas.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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
      })

    )

  }

  function importarAgendasSIGH() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarAgendasSIGH') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarAgendas) {

        if (importarAgendas.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarAgendas.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })


        } else {

          Swal.fire({
            position: 'bottom-end',
            icon: 'false',
            html: importarAgendas.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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
      })

    )

  }

  function importarAmbulatorioSIGH() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarAmbulatorioSIGH') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarAmbulatorio) {

        if (importarAmbulatorio.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarAmbulatorio.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })


        } else {

          Swal.fire({
            position: 'bottom-end',
            icon: 'false',
            html: importarAmbulatorio.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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
      })

    )

  }

  function importarBoletinsSIGH() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarBoletinsSIGH') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarBoletins) {

        if (importarBoletins.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarBoletins.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

          })


        } else {

          Swal.fire({
            position: 'bottom-end',
            icon: 'false',
            html: importarAmbulatorio.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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
      })

    )

  }

  function importarRequisicoes_old() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarRequisicoes') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarFornecedores) {

        if (importarFornecedores.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarFornecedores.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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
      })

    )

  }

  function importarFornecedores_old() {

    //EXECUTA JSON DE IMPORTAÇÃO
    $.ajax({
      url: '<?php echo base_url('rotinas/importarFornecedores') ?>',
      type: 'post',
      dataType: 'json',
      data: {
        csrf_Principal: $("#csrf_Principal").val(),
      },
      success: function(importarFornecedores) {

        if (importarFornecedores.success === true) {


          Swal.fire({
            position: 'bottom-end',
            icon: 'success',
            html: importarFornecedores.messages,
            showConfirmButton: true,
            confirmButtonText: 'Ok',

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
      })

    )

  }
</script>


<?= $this->endSection() ?>