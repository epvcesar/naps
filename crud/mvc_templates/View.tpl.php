<?= $this->extend("layout/master") ?>

<?= $this->section("content") ?>

<!-- Main content -->
      <div class="card">
        <div class="card-header">
          <div class="row">
            <div class="col-10 mt-2">
              <h3>@@@crudTitle@@@</h3>
            </div>
            <div class="col-2">
              <button type="button" class="btn float-right btn-success" onclick="save@@@uControlerName@@@()" title="<?= lang("App.new") ?>"> <i class="fa fa-plus"></i>   <?= lang('App.new') ?></button>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table id="data_table@@@uControlerName@@@" class="table table-bordered table-striped table-hover table-sm display compact">
            <thead>
              <tr>
              @@@htmlDataTable@@@
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
<div id="dataModal@@@uControlerName@@@" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content">
      <div class="text-center bg-primary p-3" id="model-header">
        <h4 class="modal-title text-white" id="modalLabel@@@uControlerName@@@"></h4>
      </div>
      <div class="modal-body">
        <form id="dataForm@@@uControlerName@@@" class="pl-3 pr-3">
          <input type="hidden" id="<?php echo csrf_token() ?>@@@uControlerName@@@" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

          @@@htmlInputs@@@
          <div class="form-group text-center">
            <div class="btn-group">
              <button type="submit" class="btn btn-success mr-2" id="formBtn@@@uControlerName@@@"><?= lang("App.save") ?></button>
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
  
  $('#data_table@@@uControlerName@@@').removeAttr('width').DataTable({
      "bDestroy":true,
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
      "columnDefs": [
        {"className": "dt-center", "targets": "_all"}
      ],
      "ajax": {
        "url": '<?php echo base_url("@@@uControlerName@@@/getAll") ?>',
        "type": "POST",
        "dataType": "json",
        async: "true",        
				data: {
					csrf_principal: $("#csrf_principal").val(),
				},
      }
    });



  function save@@@uControlerName@@@(@@@primaryKey@@@) {
    // reset the form 
    $("#dataForm@@@uControlerName@@@")[0].reset();
    $(".form-control").removeClass('is-invalid').removeClass('is-valid');
    if (typeof @@@primaryKey@@@ === 'undefined' || @@@primaryKey@@@ < 1) { //add
      urlController = '<?= base_url("@@@uControlerName@@@/add") ?>';
      submitText = '<?= lang("App.save") ?>';
      $('#model-header').removeClass('bg-primary').addClass('bg-success');
      $("#modalLabel@@@uControlerName@@@").text('<?= lang("App.add") ?>');
      $("#formBtn@@@uControlerName@@@").text(submitText);
      $('#dataModal@@@uControlerName@@@').modal('show');

      @@@SelectAdd@@@

      
    } else { //edit
      urlController = '<?= base_url("@@@uControlerName@@@/edit") ?>';
      submitText = '<?= lang("App.update") ?>';
      $.ajax({
        url: '<?php echo base_url("@@@uControlerName@@@/getOne") ?>',
        type: 'post',
        data: {
          csrf_principal: $("#csrf_principal").val(),
          @@@primaryKey@@@: @@@primaryKey@@@
        },
        dataType: 'json',
        success: function(response) {
          $('#model-header').removeClass('bg-success').addClass('bg-primary');
          $("#modalLabel@@@uControlerName@@@").text('<?= lang("App.edit") ?>');
          $("#formBtn@@@uControlerName@@@").text(submitText);
          $('#dataModal@@@uControlerName@@@').modal('show');
          //insert data to form
          @@@htmlEditFields@@@

          @@@SelectEdit@@@
          @@@CheckBoxEdit@@@
          @@@RadioEdit@@@

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
        var form = $('#dataForm@@@uControlerName@@@');
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
                $('#data_table@@@uControlerName@@@').DataTable().ajax.reload(null, false).draw(false);
                $('#dataModal@@@uControlerName@@@').modal('hide');
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
            $('#formBtn@@@uControlerName@@@').html(submitText);
          }
        });
        return false;
      }
    });

    $('#dataForm@@@uControlerName@@@').validate({


    });
  }



  function remove@@@uControlerName@@@(@@@primaryKey@@@) {
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
          url: '<?php echo base_url("@@@uControlerName@@@/remove") ?>',
          type: 'post',
          data: {
            csrf_principal: $("#csrf_principal").val(),
            @@@primaryKey@@@ : @@@primaryKey@@@
          },
          dataType: 'json',
          success: function(response) {

            if (response.success === true) {
              Swal.fire({
                toast:true,
                position: 'top-end',
                icon: 'success',
                title: response.messages,
                showConfirmButton: false,
                timer: 1500
              }).then(function() {
                $('#data_table@@@uControlerName@@@').DataTable().ajax.reload(null, false).draw(false);
              })
            } else {
              Swal.fire({
                toast:false,
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
