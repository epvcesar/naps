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
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2.min.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2-bootstrap-5-theme.rtl.min.css" />

    <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/sweetalert2-dark.min.css') ?>">
</head>

<!--
<script src="https://www.google.com/recaptcha/api.js?onload=CaptchaCallback&render=explicit&hl=en"></script>
<script type="text/javascript">
    var CaptchaCallback = function() {
        $('.g-recaptcha').each(function() {
            grecaptcha.render(this, {
                'sitekey': '6Lc7f-kpAAAAADCALEQBKHELb-iBuB20QewHlbX7'
            });
        })
    };
</script>
-->

<?php

if (session()->mensagem_sucesso !== NULL) {
    alerta(session()->mensagem_sucesso, 'success');
}
if (session()->mensagem_erro !== NULL) {
    alerta(session()->mensagem_erro, 'error');
}
if (session()->mensagem_informacao !== NULL) {
    alerta(session()->mensagem_informacao, 'info');
}
if (session()->mensagem_alerta !== NULL) {
    alerta(session()->mensagem_alerta, 'warning');
}
?>

<section id="login" class="login">

    <div class="section-title text-center col-12 col-lg-8 mx-auto" data-aos="fade-top">
        <div class="row justify-content-center">
            <div class="col-sm-12 mt-2">
                <img src="<?php echo base_url() ?>imagens/logo-om.png">
            </div>
            <div class="col-sm-12">
                <h2>COMANDO DA 7ª REGIÃO MILITAR</h2>
            </div>
            <div class="col-sm-12">
                <h4>Região Matias de Albuquerque</h34>
            </div>

        </div>
    </div>

    <div style="text-align:center" class="container col-sm-12 d-flex justify-content-center">

        <div class="section-title" data-aos="fade-up">

            <div class="col-sm-12">
                <div class="card card-primary">

                    <div class="card-body">
                        <div class="login-box col-12 col-sm-12">
                            <div style="margin-bottom:20px;color:red; font-weight:bold">
                                <img style="width:200px" src="<?php echo base_url() ?>imagens/naps.jpeg">
                            </div>
                            <div>
                                <form id="colaboradorForm" class="pl-3 pr-3">

                                    <input type="hidden" id="<?php echo csrf_token() ?>colaboradorForm" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

                                    <input type="hidden" name="perfilLogin" value="2">


                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group mb-3">
                                                <input id="login" name="login" type="text" placeholder="Login" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span class="fas fa-user"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group mb-3">
                                                <input id="senha" name="senha" type="password" placeholder="Senha" class="form-control">
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <span onclick="verSenha()" class="fas fa-lock"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="row mb-3">
                                                <label for="codOrganizacao" class="col-sm-12 col-form-label">Selecione a unidade: <span class="text-danger">*</span></label>
                                                <div class="col-md-12">
                                                    <select style="width:100%" class="form-control" id="codOrganizacao" name="codOrganizacao">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div style="margin-bottom:10px;margin-top:10px" class="row justify-content-center">
                                        <div class="g-recaptcha" id="g-recaptchaLogin"></div>

                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-lg-12">
                                            <button style="width:100%" type="button" onclick="loginColaborador()" class="btn btn-primary btn-block">Entrar</button>
                                        </div>
                                        <div class="col-lg-12 mt-2">
                                            <button style="width:100%" type="button" onclick="recuperaSenhaSaude()" class="btn btn-danger btn-block">Esqueci a senha</button>
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


</section>

</html>

<script src="<?php echo base_url() ?>/asset/adminlte/js/jquery-3.7.1.min.js"></script>

<script src="<?php echo base_url() ?>/asset/adminlte/js/adminlte.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2.min.js"></script>

<script src="<?= base_url('asset/adminlte/js/sweetalert2.all.min.js') ?>"></script>


<script>
    $.ajax({
        url: '<?php echo base_url('Satisfacao/listaDropDownOrganizacoes') ?>',
        type: 'post',
        dataType: 'json',
        data: {
            csrf_principal: $("#csrf_principal").val(),
        },
        success: function(unidade) {

            $("#colaboradorForm #codOrganizacao").select2({
                data: unidade,
            })


            $('#colaboradorForm #codOrganizacao').val(null);
            $('#colaboradorForm #codOrganizacao').trigger('change');
            $(document).on('select2:open', () => {
                document.querySelector('.select2-search__field').focus();
            });


        }
    })


    function verSenha() {
        var passField = $('input[type=password]');
        passField.attr('type', 'text');
    }

    function recuperaSenhaSaude() {
        var Toast = Swal.mixin({
            toast: true,
            position: 'center-end',
            showConfirmButton: false,
            timer: 4000
        });
        Toast.fire({
            icon: 'info',
            title: 'Ainda não implementado'
        })
        return false;
    }

    function loginColaborador() {


        if ($('#colaboradorForm #codOrganizacao').val() == '' || $('#colaboradorForm #codOrganizacao').val() == null || $('#colaboradorForm #codOrganizacao').val() == undefined) {

            var Toast = Swal.mixin({
                toast: true,
                position: 'center-end',
                showConfirmButton: false,
                timer: 4000
            });
            Toast.fire({
                icon: 'warning',
                title: 'Você deve selecionar a unidade'
            })
            return false;

        }


        var form = $('#colaboradorForm');

        var recaptcha = '<?php echo session()->recaptcha ?>'
        if (recaptcha == 1) {
            var rcres = grecaptcha.getResponse();
            if (rcres.length > 0) {
                //grecaptcha.reset();

            } else {
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 4000
                });
                Toast.fire({
                    icon: 'warning',
                    title: 'Você precisa verificar que não é um robô'
                })
                return false;
            }
        }

        $.ajax({
            url: 'verificalogin/verificaCredenciais',
            type: 'post',
            data: form.serialize(), // /converting the form data into array and sending it to server
            dataType: 'json',
            success: function(response) {

                if (response.success === true) {
                    location.href = '<?php echo base_url() ?>' + 'home';

                } else {
                    var Toast = Swal.mixin({
                        toast: true,
                        position: 'bottom-end',
                        showConfirmButton: false,
                        timer: 3000
                    });
                    Toast.fire({
                        icon: 'error',
                        title: response.messages
                    })

                }
            },
        }).always(
            Swal.fire({
                title: 'Verificando suas credenciais',
                html: 'Aguarde....',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                }
            }))


    }
</script>