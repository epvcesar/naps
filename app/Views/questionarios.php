<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<!-- Main content -->
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-10 mt-2">
        <h3>Questionários</h3>
      </div>
      <div class="col-2">
        <button type="button" class="btn float-right btn-success" onclick="saveQuestionarios()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i> <?= lang('App.new') ?></button>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="data_tableQuestionarios" class="table table-bordered table-striped table-hover table-sm display compact">
      <thead>
        <tr>
          <th>Código</th>
          <th>Titulo</th>
          <th>Resumo</th>
          <th>CodOrganizacao</th>
          <th>DataCriacao</th>
          <th>DataAtualizacao</th>
          <th>DataInicio</th>
          <th>DataEncerramento</th>
          <th>TermoAceite</th>
          <th>Instrucoes</th>
          <th>CodAutor</th>
          <th>Ativo</th>
          <th>Visibilidade</th>

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
<div id="dataModalQuestionarios" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="text-center bg-primary p-3" id="model-header">
        <h4 class="modal-title text-white" id="modalLabelQuestionarios"></h4>
      </div>
      <div class="modal-body">
        <form id="dataFormQuestionarios" class="pl-3 pr-3">
          <input type="hidden" id="<?php echo csrf_token() ?>Questionarios" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

          <div class="row">
            <input type="hidden" id="codQuestionario" name="codQuestionario" class="form-control" placeholder="Código" maxlength="11" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="titulo" class="col-form-label"> Titulo: <span class="text-danger">*</span> </label>
                <input type="text" id="titulo" name="titulo" class="form-control" placeholder="Titulo" minlength="0" maxlength="150" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="resumo" class="col-form-label"> Resumo: </label>
                <textarea cols="40" rows="5" id="resumo" name="resumo" class="form-control" placeholder="Resumo" minlength="0"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="codOrganizacao" class="col-form-label"> CodOrganizacao: <span class="text-danger">*</span> </label>
                <input type="number" id="codOrganizacao" name="codOrganizacao" class="form-control" placeholder="CodOrganizacao" minlength="0" maxlength="11" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="dataCriacao" class="col-form-label"> DataCriacao: </label>
                <input type="date" id="dataCriacao" name="dataCriacao" class="form-control" dateISO="true">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="dataAtualizacao" class="col-form-label"> DataAtualizacao: </label>
                <input type="date" id="dataAtualizacao" name="dataAtualizacao" class="form-control" dateISO="true">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="dataInicio" class="col-form-label"> DataInicio: </label>
                <input type="date" id="dataInicio" name="dataInicio" class="form-control" dateISO="true">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="dataEncerramento" class="col-form-label"> DataEncerramento: </label>
                <input type="date" id="dataEncerramento" name="dataEncerramento" class="form-control" dateISO="true">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="termoAceite" class="col-form-label"> TermoAceite: </label>
                <textarea cols="40" rows="5" id="termoAceite" name="termoAceite" class="form-control" placeholder="TermoAceite" minlength="0"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="instrucoes" class="col-form-label"> Instrucoes: </label>
                <textarea cols="40" rows="5" id="instrucoes" name="instrucoes" class="form-control" placeholder="Instrucoes" minlength="0"></textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="codAutor" class="col-form-label"> CodAutor: </label>
                <input type="number" id="codAutor" name="codAutor" class="form-control" placeholder="CodAutor" minlength="0" maxlength="11">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="ativo" class="col-form-label"> Ativo: </label>

                <select style="width:100%" id="ativo" name="ativo" class="form-select">
                </select>

              </div>
            </div>


            <fieldset class="row mb-3">
              <legend class="col-form-label col-sm-2 pt-0">Visibilidade: </legend>
              <div class="col-sm-10">
                <div class="form-check"> <input class="form-check-input" type="radio" name="codVisibilidade" id="codVisibilidade1" value="1"> <label class="form-check-label" for="codVisibilidade1">
                    Sim
                  </label> </div>
                <div class="form-check"> <input class="form-check-input" type="radio" name="codVisibilidade" id="codVisibilidade2" value="2"> <label class="form-check-label" for="codVisibilidade2">
                    Não
                  </label> </div>
              </div>
            </fieldset>
          </div>

          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="formBtnQuestionarios"><?= lang("App.save") ?></button>
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

  $('#data_tableQuestionarios').removeAttr('width').DataTable({
    "bDestroy": true,
    "paging": true,
    "lengthChange": false,
    "searching": true,
    "ordering": true,
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
      "url": '<?php echo base_url("Questionarios/getAll") ?>',
      "type": "POST",
      "dataType": "json",
      async: "true",
      data: {
        csrf_principal: $("#csrf_principal").val(),
      },
    }
  });



  function saveQuestionarios(codQuestionario) {
    // reset the form 
    $("#dataFormQuestionarios")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof codQuestionario === 'undefined' || codQuestionario < 1) { //add
      urlController = '<?= base_url("Questionarios/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-primary').addClass('bg-success');
      $("#modalLabelQuestionarios").text('<?= lang("App.add") ?>');
      $("#formBtnQuestionarios").text(submitText);
      $('#dataModalQuestionarios').modal('show');

      $.ajax({
        url: "<?php echo base_url("Organizacoes/listaDropDownOrganizacoes") ?>",
        type: "post",
        dataType: "json",
        data: {
          csrf_principal: $("#csrf_principal").val(),
        },
        success: function(result) {

          $("#dataFormQuestionarios #ativo").select2({
            data: result,
          })
          $("#dataFormQuestionarios #ativo").val(null);
          $("#dataFormQuestionarios #ativo").trigger("change");
          $(document).on("select2:open", () => {
            document.querySelector(".select2-search__field").focus();
          });
          $("#dataFormQuestionarios #ativo").select2({
            dropdownParent: $("#dataModalQuestionarios")
          });

        }
      });



    } else { //edit
      urlController = '<?= base_url("Questionarios/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url("Questionarios/getOne") ?>',
        type: 'post',
        data: {
          csrf_principal: $("#csrf_principal").val(),
          codQuestionario: codQuestionario
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-primary');
          $("#modalLabelQuestionarios").text('<?= lang("App.edit") ?>');
          $("#formBtnQuestionarios").text(submitText);
          $('#dataModalQuestionarios').modal('show');
          //insert data to form
          $("#dataFormQuestionarios #codQuestionario").val(response.codQuestionario);
          $("#dataFormQuestionarios #titulo").val(response.titulo);
          $("#dataFormQuestionarios #resumo").val(response.resumo);
          $("#dataFormQuestionarios #codOrganizacao").val(response.codOrganizacao);
          $("#dataFormQuestionarios #dataCriacao").val(response.dataCriacao);
          $("#dataFormQuestionarios #dataAtualizacao").val(response.dataAtualizacao);
          $("#dataFormQuestionarios #dataInicio").val(response.dataInicio);
          $("#dataFormQuestionarios #dataEncerramento").val(response.dataEncerramento);
          $("#dataFormQuestionarios #termoAceite").val(response.termoAceite);
          $("#dataFormQuestionarios #instrucoes").val(response.instrucoes);
          $("#dataFormQuestionarios #codAutor").val(response.codAutor);
          $("#dataFormQuestionarios #codVisibilidade").val(response.codVisibilidade);


          $.ajax({
            url: "<?php echo base_url("Organizacoes/listaDropDownOrganizacoes") ?>",
            type: "post",
            dataType: "json",
            data: {
              csrf_principal: $("#csrf_principal").val(),
            },
            success: function(result) {

              $("#dataFormQuestionarios #ativo").select2({
                data: result,
              })
              $("#dataFormQuestionarios #ativo").val(response.ativo);
              $("#dataFormQuestionarios #ativo").trigger("change");
              $(document).on("select2:open", () => {
                document.querySelector(".select2-search__field").focus();
              });
              $("#dataFormQuestionarios #ativo").select2({
                dropdownParent: $("#dataModalQuestionarios")
              });

            }
          });



          if (response.codVisibilidade == 1) {
            $("#codVisibilidade1").prop("checked", true);
          }
          if (response.codVisibilidade == 2) {
            $("#codVisibilidade2").prop("checked", true);
          }

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
        var form = $('#dataFormQuestionarios');
        $(".text-danger").remove();
        $.ajax({
          // fixBug get url from global function only
          // get global variable is bug!
          url: urlController,
          type: 'post',
          data: form.serialize(),
          cache: false,
          dataType: 'json',
          beforeSend: function() {

            Swal.fire({
              title: 'Estamos processando sua requisição',
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
                toast: false,
                position: 'bottom-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_tableQuestionarios').DataTable().ajax.reload(null, false).draw(false);
                $('#dataModalQuestionarios').modal('hide');
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
                  position: 'bottom-end',
                  icon: 'error',
                  title: response.messages,
                  showConfirmButton: false,
                  timer: 3000
                })

              }
            }
            $('#formBtnQuestionarios').html(submitText);
          }
        });
        return false;
      }
    });

    $('#dataFormQuestionarios').validate({


    });
  }



  function removeQuestionarios(codQuestionario) {
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
          url: '<?php echo base_url("Questionarios/remove") ?>',
          type: 'post',
          data: {
            csrf_principal: $("#csrf_principal").val(),
            codQuestionario: codQuestionario
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
                $('#data_tableQuestionarios').DataTable().ajax.reload(null, false).draw(false);
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