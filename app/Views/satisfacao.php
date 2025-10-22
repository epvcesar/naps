<!DOCTYPE html>
<html lang="en"> <!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>SFPC 7ªRM</title><!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="title" content="SFPC 7ªRM">
    <meta name="author" content="ColorlibHQ">
    <meta name="description" content="SFPC 7ªRM"><!--end::Primary Meta Tags--><!--begin::Fonts-->
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/css/adminlte.min.css">
    <!-- Styles -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2-bootstrap-5-theme.rtl.min.css" />


    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/css/star-rating.min.css" />


    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/themes/krajee-svg/theme.css" />

</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary"> <!--begin::App Wrapper-->

    <div class="app-wrapper"> <!--begin::Header-->


        <main class="app-main"> <!--begin::App Content Header-->


            <div class="app-content"> <!--begin::Container-->
                <div class="container-fluid"> <!--begin::Row-->

                    <div class="container">
                        <div class="row flex justify-content-center">

                            <div class="col-12 mt-3 mb-5 text-center">
                                <div class="col-md-12">
                                    <img src="<?php echo base_url() ?>imagens/logo-om.png">
                                </div>
                                <div class="col-sm-12">
                                    <h4>COMANDO DA 7ª REGIÃO MILITAR</h4>
                                </div>
                                <div class="col-sm-12">
                                    <h4>Região Matias de Albuquerque</h4>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            Avalie o Sistema de Fiscalização de Produtos Controlados (SisFPC/7)
                        </div>
                    </div>

                    <form id="pesquisaSatisfacaoForm" class="pl-3 pr-3">
                        <input required type="hidden" id="<?php echo csrf_token() ?>pesquisaSatisfacaoForm" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="email" class="col-sm-12 col-form-label">Email: <span class="text-danger">*</span></label>
                                            <div class="col-sm-5"> <input required type="email" class="form-control" id="email" name='email'> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="codOrganizacao" class="col-sm-12 col-form-label">Selecione a unidade que deseja avaliar: <span class="text-danger">*</span></label>
                                            <div class="col-md-4">
                                                <select required class="form-control" id="codOrganizacao" name="codOrganizacao">
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="servico" class="col-sm-12 col-form-label">De modo geral, como classifica o serviço prestado pela SFPC?<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <input required id="servico" name="servico" type="text" class="rating" data-min="0" data-max="5" data-step="1" data-size="lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="atendimento" class="col-sm-12 col-form-label">Como classifica o atendimento recebido (presencial)? <span class="text-danger">*</span></label>
                                            <div class="row">
                                                <input required id="atendimento" name="atendimento" type="text" class="rating" data-min="0" data-max="5" data-step="1" data-size="lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="qualidade" class="col-sm-12 col-form-label">Como classifica a qualidade das informações recebidas?<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <input required id="qualidade" name="qualidade" type="text" class="rating" data-min="0" data-max="5" data-step="1" data-size="lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="tempo" class="col-sm-12 col-form-label">Como classifica o tempo para a finalização do seu último processo?<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <input required id="tempo" name="tempo" type="text" class="rating" data-min="0" data-max="5" data-step="1" data-size="lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="instalacoes" class="col-sm-12 col-form-label">Como classifica as instalações físicas?<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <input required id="instalacoes" name="instalacoes" type="text" class="rating" data-min="0" data-max="5" data-step="1" data-size="lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="qualidadePresencial" class="col-sm-12 col-form-label">Como classifica a qualidade do atendimento remoto (telefone, e-mail, Fale com a SFPC)?<span class="text-danger">*</span></label>
                                            <div class="row">
                                                <input required id="qualidadePresencial" name="qualidadePresencial" type="text" class="rating" data-min="0" data-max="5" data-step="1" data-size="lg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <label for="codMeio" class="col-sm-12 col-form-label">Por qual meio foi atendido?: <span class="text-danger">*</span></label>
                                            <div class="col-md-4">
                                                <select required class="form-control" id="codMeio" name="codMeio">
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mt-4">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="sugestao" class="form-label">Como podemos melhorar nossos serviços?</label>
                                            <textarea id="sugestao" name="sugestao" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group text-center pt-4">
                            <div class="btn-group mt-4">
                                <button type="submit" class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Enviar">Enviar pesquisa</button>
                            </div>
                        </div>
                    </form>

                </div> <!--end::Container-->
            </div> <!--end::App Content-->
        </main> <!--end::App Main--> <!--begin::Footer-->
        <footer class="app-footer"> <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline">SFPC/7</div><strong>
                Copyright &copy; 2024&nbsp;
                <a href="https://adminlte.io" class="text-decoration-none">COMANDO DA 7ª REGIÃO MILITAR</a>.
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer> <!--end::Footer-->
    </div> <!--end::App Wrapper--> <!--begin::Script--> <!--begin::Third Party Plugin(OverlayScrollbars)-->

</body><!--end::Body-->

</html>
<script src="<?php echo base_url() ?>/asset/adminlte/js/jquery-3.7.1.min.js"></script>

<script src="<?php echo base_url() ?>/asset/adminlte/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/js/star-rating.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/themes/krajee-svg/theme.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/js/locales/LANG.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/js/jquery.validate.min.js"></script>
<script src="<?= base_url('asset/adminlte/js/sweetalert2.all.min.js') ?>"></script>

<script>
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
            var form = $('#pesquisaSatisfacaoForm');

            $(".text-danger").remove();
            $.ajax({
                url: '<?php echo base_url('Satisfacao/add') ?>',
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
                            icon: 'success',
                            title: response.messages,
                            showConfirmButton: true,
                            confirmButtonText: 'Ok',
                        }).then(function() {
                            window.location.href = "https://www.7rm.eb.mil.br/";
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
                            return false;

                        }
                    }
                    $('#pesquisaSatisfacaoForm').html('Enviar');
                }
            });
            return false;
        }
    });

    $('#pesquisaSatisfacaoForm').validate({


    });


    $.ajax({
        url: '<?php echo base_url('Satisfacao/listaDropDownOrganizacoes') ?>',
        crossDomain: true,
        type: 'post',
        dataType: 'json',
        data: {
            csrf_principal: $("#csrf_principal").val(),
        },
        success: function(unidade) {

            $("#pesquisaSatisfacaoForm #codOrganizacao").select2({
                data: unidade,
            })
            $("#pesquisaSatisfacaoForm #codOrganizacao").val(null);
            $("#pesquisaSatisfacaoForm #codOrganizacao").trigger("change");


        }
    })


    $.ajax({
        url: '<?php echo base_url('Satisfacao/listaDropDownMeios') ?>',
        crossDomain: true,
        type: 'post',
        dataType: 'json',
        data: {
            csrf_principal: $("#csrf_principal").val(),
        },
        success: function(meio) {

            $("#pesquisaSatisfacaoForm #codMeio").select2({
                data: meio,
            })

            $("#pesquisaSatisfacaoForm #codMeio").val(null);
            $("#pesquisaSatisfacaoForm #codMeio").trigger("change");

        }

    })
</script>