<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<!-- Main content -->
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-10 mt-2">
        <h3 class="card-title">respostas</h3>
      </div>
      <div class="col-2">
        <button type="button" class="btn float-right btn-success" onclick="save()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i> <?= lang('App.new') ?></button>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="data_table" class="table table-bordered table-striped table-hover table-sm display compact">
      <thead>
        <tr>
          <th>Código</th>
          <th>Organização</th>
          <th>Meio</th>
          <th>Data</th>
          <th>Email</th>
          <th>Servico</th>
          <th>Atendimento</th>
          <th>Qualidade</th>
          <th>Tempo</th>
          <th>Instalações</th>
          <th>QualidadePresencial</th>
          <th>Sugestão</th>

          <th></th>
        </tr>
      </thead>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

<!-- /Main content -->

<!-- ADD modal content -->
<div id="data-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md">
    <div class="modal-content">
      <div class="text-center bg-primary p-3" id="model-header">
        <h4 class="modal-title text-white" id="info-header-modalLabel"></h4>
      </div>
      <div class="modal-body">
        <form id="data-form" class="pl-3 pr-3">
          <input type="hidden" id="<?php echo csrf_token() ?>Respostas" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

          <div class="row">
            <input type="hidden" id="codPesquisa" name="codPesquisa" class="form-control" placeholder="Código" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="codOrganizacao" class="col-form-label"> Organização: </label>

                <select style="width:100%" id="codOrganizacao" name="codOrganizacao" class="form-select">
                </select>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="codMeio" class="col-form-label"> Meio: </label>

                <select style="width:100%" id="codMeio" name="codMeio" class="form-select">
                </select>

              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="data" class="col-form-label"> Data: <span class="text-danger">*</span> </label>
                <input type="date" id="data" name="data" class="form-control" dateISO="true" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="email" class="col-form-label"> Email: </label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" minlength="0">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="servico" class="col-form-label"> Servico: </label>
                <input type="number" id="servico" name="servico" class="form-control" placeholder="Servico" minlength="0">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="atendimento" class="col-form-label"> Atendimento: </label>
                <input type="number" id="atendimento" name="atendimento" class="form-control" placeholder="Atendimento" minlength="0">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="qualidade" class="col-form-label"> Qualidade: </label>
                <input type="number" id="qualidade" name="qualidade" class="form-control" placeholder="Qualidade" minlength="0">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="tempo" class="col-form-label"> Tempo: </label>
                <input type="number" id="tempo" name="tempo" class="form-control" placeholder="Tempo" minlength="0">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="instalacoes" class="col-form-label"> Instalações: </label>
                <input type="number" id="instalacoes" name="instalacoes" class="form-control" placeholder="Instalações" minlength="0">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="qualidadePresencial" class="col-form-label"> QualidadePresencial: </label>
                <input type="number" id="qualidadePresencial" name="qualidadePresencial" class="form-control" placeholder="QualidadePresencial" minlength="0">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="sugestao" class="col-form-label"> Sugestão: </label>
                <textarea cols="40" rows="5" id="sugestao" name="sugestao" class="form-control" placeholder="Sugestão" minlength="0"></textarea>
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
    var table = $('#data_table').removeAttr('width').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": false,
      "pageLength": 100,
      "info": true,
      "autoWidth": false,
      //"scrollY": '45vh',
      //"scrollX": true,
      "scrollCollapse": true,
      "responsive": true,
      "columnDefs": [{
        "className": "dt-center",
        "targets": "_all"
      }],
      "ajax": {
        "url": '<?php echo base_url($controller . "/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",
        data: {
          csrf_principal: $("#csrf_principal").val(),
        },
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

  function save(codPesquisa) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof codPesquisa === 'undefined' || codPesquisa < 1) { //add
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
        success: function(result) {

          $("#data-form #codOrganizacao").select2({
            data: result,
          })
          $("#data-form #codOrganizacao").val(null);
          $("#data-form #codOrganizacao").trigger("change");
          $(document).on("select2:open", () => {
            document.querySelector(".select2-search__field").focus();
          });
          $("#data-form #codOrganizacao").select2({
            dropdownParent: $("#data-modal")
          });

        }
      });
      $.ajax({
        url: "<?php echo base_url("Organizacoes/listaDropDownOrganizacoes") ?>",
        type: "post",
        dataType: "json",
        data: {
          csrf_principal: $("#csrf_principal").val(),
        },
        success: function(result) {

          $("#data-form #codMeio").select2({
            data: result,
          })
          $("#data-form #codMeio").val(null);
          $("#data-form #codMeio").trigger("change");
          $(document).on("select2:open", () => {
            document.querySelector(".select2-search__field").focus();
          });
          $("#data-form #codMeio").select2({
            dropdownParent: $("#data-modal")
          });

        }
      });



    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          csrf_principal: $("#csrf_principal").val(),
          codPesquisa: codPesquisa
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-primary');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #codPesquisa").val(response.codPesquisa);
          $("#data-form #data").val(response.data);
          $("#data-form #email").val(response.email);
          $("#data-form #servico").val(response.servico);
          $("#data-form #atendimento").val(response.atendimento);
          $("#data-form #qualidade").val(response.qualidade);
          $("#data-form #tempo").val(response.tempo);
          $("#data-form #instalacoes").val(response.instalacoes);
          $("#data-form #qualidadePresencial").val(response.qualidadePresencial);
          $("#data-form #sugestao").val(response.sugestao);


          $.ajax({
            url: "<?php echo base_url("Organizacoes/listaDropDownOrganizacoes") ?>",
            type: "post",
            dataType: "json",
            data: {
              csrf_principal: $("#csrf_principal").val(),
            },
            success: function(result) {

              $("#data-form #codOrganizacao").select2({
                data: result,
              })
              $("#data-form #codOrganizacao").val(response.codOrganizacao);
              $("#data-form #codOrganizacao").trigger("change");
              $(document).on("select2:open", () => {
                document.querySelector(".select2-search__field").focus();
              });
              $("#data-form #codOrganizacao").select2({
                dropdownParent: $("#data-modal")
              });

            }
          });
          $.ajax({
            url: "<?php echo base_url("Organizacoes/listaDropDownOrganizacoes") ?>",
            type: "post",
            dataType: "json",
            data: {
              csrf_principal: $("#csrf_principal").val(),
            },
            success: function(result) {

              $("#data-form #codMeio").select2({
                data: result,
              })
              $("#data-form #codMeio").val(response.codMeio);
              $("#data-form #codMeio").trigger("change");
              $(document).on("select2:open", () => {
                document.querySelector(".select2-search__field").focus();
              });
              $("#data-form #codMeio").select2({
                dropdownParent: $("#data-modal")
              });

            }
          });




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
        var form = $('#data-form');
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
              title: 'Estamos qndo sua requisição',
              html: 'Aguarde....',
              timerProgressBar: true,
              timer: 2000,
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
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
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

    $('#data-form').validate({

      //insert data-form to database

    });
  }



  function remove(codPesquisa) {
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
            csrf_principal: $("#csrf_principal").val(),
            codPesquisa: codPesquisa
          },
          dataType: 'json',
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
                $('#data_table').DataTable().ajax.reload(null, false).draw(false);
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