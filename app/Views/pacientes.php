<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<!-- Main content -->
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-10 mt-2">
        <h3>pacientes</h3>
      </div>
      <div class="col-2">
        <button type="button" class="btn float-right btn-success" onclick="savePacientes()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i> <?= lang('App.new') ?></button>
      </div>
    </div>
  </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="data_tablePacientes" class="table table-bordered table-striped table-hover table-sm display compact">
      <thead>
        <tr>
          <th>CodPaciente</th>
          <th>Nome</th>
          <th>CPF</th>
          <th>PRECCP</th>
          <th>Posto/Grad</th>

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
<div id="dataModalPacientes" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="text-center bg-primary p-3" id="model-header">
        <h4 class="modal-title text-white" id="modalLabelPacientes"></h4>
      </div>
      <div class="modal-body">
        <form id="dataFormPacientes" class="pl-3 pr-3">
          <input type="hidden" id="<?php echo csrf_token() ?>Pacientes" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

          <div class="row">
            <input type="hidden" id="codPaciente" name="codPaciente" class="form-control" placeholder="CodPaciente" maxlength="11" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="nomeCompleto" class="col-form-label"> Nome: </label>
                <input type="text" id="nomeCompleto" name="nomeCompleto" class="form-control" placeholder="Nome" minlength="0" maxlength="150">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="cpf" class="col-form-label"> CPF: <span class="text-danger">*</span> </label>
                <input type="text" id="cpf" name="cpf" class="form-control" placeholder="CPF" minlength="0" maxlength="14" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="preccp" class="col-form-label"> PRECCP: <span class="text-danger">*</span> </label>
                <input type="text" id="preccp" name="preccp" class="form-control" placeholder="PRECCP" minlength="0" maxlength="14" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="postoGraduacao" class="col-form-label"> Posto/Grad: </label>

                <select style="width:100%" id="postoGraduacao" name="postoGraduacao" class="form-select">
                </select>

              </div>
            </div>
          </div>

          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="formBtnPacientes"><?= lang("App.save") ?></button>
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

  $('#data_tablePacientes').removeAttr('width').DataTable({
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
      "url": '<?php echo base_url("Pacientes/getAll") ?>',
      "type": "POST",
      "dataType": "json",
      async: "true",
      data: {
        csrf_principal: $("#csrf_principal").val(),
      },
    }
  });



  function savePacientes(codPaciente) {
    // reset the form 
    $("#dataFormPacientes")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof codPaciente === 'undefined' || codPaciente < 1) { //add
      urlController = '<?= base_url("Pacientes/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-primary').addClass('bg-success');
      $("#modalLabelPacientes").text('<?= lang("App.add") ?>');
      $("#formBtnPacientes").text(submitText);
      $('#dataModalPacientes').modal('show');

      $.ajax({
        url: "<?php echo base_url("Pacientes/listaDropDownPostoGraduacao") ?>",
        type: "post",
        dataType: "json",
        data: {
          csrf_principal: $("#csrf_principal").val(),
        },
        success: function(result) {

          $("#dataFormPacientes #postoGraduacao").select2({
            data: result,
          })
          $("#dataFormPacientes #postoGraduacao").val(null);
          $("#dataFormPacientes #postoGraduacao").trigger("change");
          $(document).on("select2:open", () => {
            document.querySelector(".select2-search__field").focus();
          });
          $("#dataFormPacientes #postoGraduacao").select2({
            dropdownParent: $("#dataModalPacientes")
          });

        }
      });



    } else { //edit
      urlController = '<?= base_url("Pacientes/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url("Pacientes/getOne") ?>',
        type: 'post',
        data: {
          csrf_principal: $("#csrf_principal").val(),
          codPaciente: codPaciente
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-primary');
          $("#modalLabelPacientes").text('<?= lang("App.edit") ?>');
          $("#formBtnPacientes").text(submitText);
          $('#dataModalPacientes').modal('show');
          //insert data to form
          $("#dataFormPacientes #codPaciente").val(response.codPaciente);
          $("#dataFormPacientes #nomeCompleto").val(response.nomeCompleto);
          $("#dataFormPacientes #cpf").val(response.cpf);
          $("#dataFormPacientes #preccp").val(response.preccp);


          $.ajax({
            url: "<?php echo base_url("Pacientes/listaDropDownPostoGraduacao") ?>",
            type: "post",
            dataType: "json",
            data: {
              csrf_principal: $("#csrf_principal").val(),
            },
            success: function(result) {

              $("#dataFormPacientes #postoGraduacao").select2({
                data: result,
              })
              $("#dataFormPacientes #postoGraduacao").val(response.postoGraduacao);
              $("#dataFormPacientes #postoGraduacao").trigger("change");
              $(document).on("select2:open", () => {
                document.querySelector(".select2-search__field").focus();
              });
              $("#dataFormPacientes #postoGraduacao").select2({
                dropdownParent: $("#dataModalPacientes")
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
        var form = $('#dataFormPacientes');
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
                $('#data_tablePacientes').DataTable().ajax.reload(null, false).draw(false);
                $('#dataModalPacientes').modal('hide');
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
            $('#formBtnPacientes').html(submitText);
          }
        });
        return false;
      }
    });

    $('#dataFormPacientes').validate({


    });
  }



  function removePacientes(codPaciente) {
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
          url: '<?php echo base_url("Pacientes/remove") ?>',
          type: 'post',
          data: {
            csrf_principal: $("#csrf_principal").val(),
            codPaciente: codPaciente
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
                $('#data_tablePacientes').DataTable().ajax.reload(null, false).draw(false);
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