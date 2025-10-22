<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<!-- Main content -->
<div class="card">
  <div class="card-header">
    <div class="row">
      <div class="col-10 mt-2">
        <h3 class="card-title">teste</h3>
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
          <th>CodTeste</th>
          <th>Descricao</th>
          <th>Tipo</th>

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
          <input type="hidden" id="<?php echo csrf_token() ?>Teste" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

          <div class="row">
            <input type="hidden" id="codTeste" name="codTeste" class="form-control" placeholder="CodTeste" required>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="descricao" class="col-form-label"> Descricao: <span class="text-danger">*</span> </label>
                <input type="text" id="descricao" name="descricao" class="form-control" placeholder="Descricao" minlength="0" maxlength="20" required>
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group mb-3">
                <label for="tipo" class="col-form-label"> Tipo: <span class="text-danger">*</span> </label>
                <input type="number" id="tipo" name="tipo" class="form-control" placeholder="Tipo" minlength="0" required>
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

  function save(codTeste) {
    // reset the form 
    $("#data-form")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof codTeste === 'undefined' || codTeste < 1) { //add
      urlController = '<?= base_url($controller . "/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-primary').addClass('bg-success');
      $("#info-header-modalLabel").text('<?= lang("App.add") ?>');
      $("#form-btn").text(submitText);
      $('#data-modal').modal('show');




    } else { //edit
      urlController = '<?= base_url($controller . "/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url($controller . "/getOne") ?>',
        type: 'post',
        data: {
          csrf_principal: $("#csrf_principal").val(),
          codTeste: codTeste
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-primary');
          $("#info-header-modalLabel").text('<?= lang("App.edit") ?>');
          $("#form-btn").text(submitText);
          $('#data-modal').modal('show');
          //insert data to form
          $("#data-form #codTeste").val(response.codTeste);
          $("#data-form #descricao").val(response.descricao);
          $("#data-form #tipo").val(response.tipo);






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



  function remove(codTeste) {
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
            codTeste: codTeste
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