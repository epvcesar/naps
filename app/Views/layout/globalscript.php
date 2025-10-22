<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('asset/adminlte/js/jquery-3.7.1.min.js') ?>"></script>
<!-- Bootstrap 5 with Popper.js-->
<script src="<?= base_url('asset/adminlte/js/bootstrap.bundle.min.js') ?>"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('asset/adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') ?>"></script>
<!-- AdminLTE App -->
<script src=" <?= base_url('asset/adminlte/js/adminlte.min.js') ?>"></script>

<!-- Page Global Script -->
<!-- Toggle Button -->
<script src="<?= base_url('asset/adminlte/js/bootstrap4-toggle.min.js') ?>"></script>

<!-- SweetAlert2 -->
<script src="<?= base_url('asset/adminlte/js/sweetalert2.all.min.js') ?>"></script>
<!-- jquery-validation -->
<script src="<?= base_url('asset/adminlte/js/jquery.validate.min.js') ?>"></script>

<!-- DataTables Full Function -->
<script src="<?= base_url("asset/adminlte/plugins/datatables/DataTables-1.11.3/js/jquery.dataTables.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/DataTables-1.11.3/js/dataTables.bootstrap5.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/Buttons-2.0.1/js/dataTables.buttons.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/JSZip-2.5.0/jszip.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/Buttons-2.0.1/js/buttons.print.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/Buttons-2.0.1/js/buttons.html5.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/Responsive-2.2.9/js/dataTables.responsive.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/datatables/Responsive-2.2.9/js/responsive.bootstrap5.min.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/inputmask/jquery.inputmask.js"); ?>" type="text/javascript"></script>
<script src="<?= base_url("asset/adminlte/plugins/select2/dist/select2.min.js"); ?>" type="text/javascript"></script>


<script src="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/js/star-rating.min.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/themes/krajee-svg/theme.js"></script>
<script src="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/js/locales/LANG.js"></script>

<script>
    $("input[id*='cpf']").inputmask({
        mask: ['999.999.999-99'],
        keepStatic: true
    });


    $("input[id*='celular']").inputmask({
        mask: ["(99) 99999-9999"],
        keepStatic: true
    });

    $("input[id*='numeroContato']").inputmask({
        mask: ["(99) 99999-9999"],
        keepStatic: true
    });


    $("input[id*='cep']").inputmask({
        mask: ["99999‑999"],
        keepStatic: true
    });

    $("input[id*='altura']").inputmask({
        mask: ['9,99'],
        keepStatic: true
    });

    var codPerfil;
    var codOrganizacao;

    $.ajax({
        url: '<?php echo base_url('Organizacoes/listaDropDownOrganizacoesMenuPrincipal') ?>',
        crossDomain: true,
        type: 'post',
        dataType: 'json',
        data: {
            csrf_principal: $("#csrf_principal").val(),
        },
        success: function(organizacoes) {


            $("#codOrganizacaoMenuPrincipal").select2({
                data: organizacoes.listaOrganizacoes,
            })
            codOrganizacao = organizacoes.codOrganizacao;
            $("#codOrganizacaoMenuPrincipal").val(organizacoes.codOrganizacao);
            $("#codOrganizacaoMenuPrincipal").trigger("change");


        }
    })

    $.ajax({
        url: '<?php echo base_url('Perfis/listaDropDownPerfisPermitidos') ?>',
        crossDomain: true,
        type: 'post',
        dataType: 'json',
        data: {
            csrf_principal: $("#csrf_principal").val(),
        },
        success: function(perfil) {


            $("#codPerfilMenuPrincipal").select2({
                data: perfil.listaPerfis,
            })
            codPerfil = perfil.codPerfil;
            geraMenus();
            $("#codPerfilMenuPrincipal").val(perfil.codPerfil);
            $("#codPerfilMenuPrincipal").trigger("change");


        }
    })



    $('#codOrganizacaoMenuPrincipal').on('change', function() {

        if (this.value !== undefined && this.value !== null && this.value !== codOrganizacao) {

            $.ajax({
                url: '<?php echo base_url('Organizacoes/mudaOrganizacao') ?>',
                crossDomain: true,
                type: 'post',
                dataType: 'json',
                data: {
                    codOrganizacao: this.value,
                    csrf_principal: $("#csrf_principal").val(),
                },
                success: function(mudaOrganizacao) {

                    codOrganizacao = this.value;

                }
            })

        }
    });



    $('#codPerfilMenuPrincipal').on('change', function() {

        if (this.value !== undefined && this.value !== null && this.value !== codPerfil) {

            $.ajax({
                url: '<?php echo base_url('Perfis/mudaPerfil') ?>',
                crossDomain: true,
                type: 'post',
                dataType: 'json',
                data: {
                    codPerfil: this.value,
                    csrf_principal: $("#csrf_principal").val(),
                },
                success: function(mudaPerfil) {


                    codPerfil = this.value;
                    geraMenus();

                }
            })

        }
    });


    function trocasenha(codColaborador) {


        $("#formTrocaSenha")[0].reset();
        $('#modal-senha').modal('show');
        $("#formTrocaSenha #codColaborador").val(codColaborador);
        $("#senha").attr("onkeyup", "verificaSenha(" + codColaborador + ")");
        $("#confirmacao").attr("onkeyup", "verificaSenha(" + codColaborador + ")");

        $("#verificaMinimoCaracteres").removeClass("fas fa-check");
        $("#verificaMinimoCaracteres").addClass("fas fa-times");
        $("#verificaMinimoCaracteres").css("color", "#FF0004");


        $("#verificaSenhaNaoSimples").removeClass("fas fa-check");
        $("#verificaSenhaNaoSimples").addClass("fas fa-times");
        $("#verificaSenhaNaoSimples").css("color", "#FF0004");

        $("#verificanumeros").removeClass("fas fa-check");
        $("#verificanumeros").addClass("fas fa-times");
        $("#verificanumeros").css("color", "#FF0004");


        $("#verificaletras").removeClass("fas fa-check");
        $("#verificaletras").addClass("fas fa-times");
        $("#verificaletras").css("color", "#FF0004");



        $("#verificamaiusculo").removeClass("fas fa-check");
        $("#verificamaiusculo").addClass("fas fa-times");
        $("#verificamaiusculo").css("color", "#FF0004");


        $("#verificacaracteresEspeciais").removeClass("fas fa-check");
        $("#verificacaracteresEspeciais").addClass("fas fa-times");
        $("#verificacaracteresEspeciais").css("color", "#FF0004");


        $("#pwmatch").removeClass("fas fa-check");
        $("#pwmatch").addClass("fas fa-times");
        $("#pwmatch").css("color", "#FF0004");

    }



    function trocaSenhaAgora() {

        $.ajax({
            url: '<?php echo base_url('Colaboradores/trocaSenha') ?>',
            type: 'post',
            dataType: 'json',
            data: {
                codColaborador: $("#formTrocaSenha #codColaborador").val(),
                senha: $("#formTrocaSenha #senha").val(),
                confirmacao: $("#formTrocaSenha #confirmacao").val(),
                csrf_principal: $("#csrf_principal").val(),
            },
            success: function(trocaSenha) {

                if (trocaSenha.success === true) {
                    $('#modal-senha').modal('hide');
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'success',
                        title: trocaSenha.messages,
                        showConfirmButton: false,
                        timer: 1500
                    })
                } else {
                    Swal.fire({
                        position: 'bottom-end',
                        icon: 'error',
                        title: trocaSenha.messages,
                        showConfirmButton: false,
                        timer: 1500
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


    function geraMenus() {

        $.ajax({
            url: '<?php echo base_url('Perfis/geraMenus') ?>',
            crossDomain: true,
            type: 'post',
            dataType: 'json',
            data: {
                csrf_principal: $("#csrf_principal").val(),
            },
            success: function(geraMenu) {

                if (geraMenu.success === true) {
                    $("#menuDinamico").html(geraMenu.menuDinamico);
                }

            }
        })
    }




    function verificaConta() {
        $.ajax({
            url: '<?php echo base_url('Colaboradores/contas') ?>',
            type: 'post',
            dataType: 'json',
            data: {
                csrf_Principal: $("#csrf_Principal").val(),
            },
            success: function(contas) {

                //var backlist = ["emanuel", "12345678", "87654321", "11111111", "selvabrasil", "brasil1234", "brasil", "selva"];

                var backlist = JSON.parse(contas.jsonContas);



                if (jQuery.inArray($("#contaAdd").val(), backlist) == -1) {
                    $("#contaAdd").removeClass("is-invalid");
                    $("#contaAdd").addClass("is-valid");
                    $("#contaAdd").css("color", "#00A41E");
                    document.getElementById('mensagemConta').style.display = "none";

                } else {


                    document.getElementById('mensagemConta').style.display = "block";
                    $("#contaAdd").removeClass("is-valid");
                    $("#contaAdd").addClass("is-invalid");
                    $("#contaAdd").css("color", "#FF0004");
                }

            }
        })

    }

    function verificaSenhaCliente(codCliente) {

        $.ajax({
            url: '<?php echo base_url('clientes/pegaOrganizacaoCliente') ?>',
            type: 'post',
            data: {
                codCliente: codCliente,
                csrf_Principal: $("#csrf_Principal").val(),
            },
            dataType: 'json',
            success: function(response) {

                var verificaSenhaNaoSimples = 0;
                var verificanumeros = 0;
                var verificaletras = 0;
                var verificamaiusculo = 0;
                var verificacaracteresEspeciais = 0;
                var verificapwmatch = 0;
                var verificaMinimoCaracteres = 0;


                //VERIFICA CUMPRIMENTO DA SENHA
                if (response.minimoCaracteres > 0) {

                    var minimoCaracteres = '<?php echo session()->minimoCaracteres ?>';
                    if ($("#senhaCliente").val().length >= minimoCaracteres) {
                        $("#verificaMinimoCaracteresCliente").removeClass("fas fa-times");
                        $("#verificaMinimoCaracteresCliente").addClass("fas fa-check");
                        $("#verificaMinimoCaracteresCliente").css("color", "#00A41E");
                        verificaMinimoCaracteres = 1;
                    } else {
                        $("#verificaMinimoCaracteresCliente").removeClass("fas fa-check");
                        $("#verificaMinimoCaracteresCliente").addClass("fas fa-times");
                        $("#verificaMinimoCaracteresCliente").css("color", "#FF0004");
                        verificaSenhaNaoSimples = 0;
                    }
                } else {
                    verificaMinimoCaracteres = 1;
                }




                //SENHA TRIVIAL

                if (response.senhaNaoSimples == 1) {

                    var backlist = ["", "12345678", "87654321", "11111111", "selvabrasil", "brasil1234", "brasil", "selva"];

                    if (jQuery.inArray($("#senhaCliente").val(), backlist) == -1) {
                        $("#verificaSenhaNaoSimplesCliente").removeClass("fas fa-times");
                        $("#verificaSenhaNaoSimplesCliente").addClass("fas fa-check");
                        $("#verificaSenhaNaoSimplesCliente").css("color", "#00A41E");
                        verificaSenhaNaoSimples = 1;
                    } else {
                        $("#verificaSenhaNaoSimplesCliente").removeClass("fas fa-check");
                        $("#verificaSenhaNaoSimplesCliente").addClass("fas fa-times");
                        $("#verificaSenhaNaoSimplesCliente").css("color", "#FF0004");
                        verificaSenhaNaoSimples = 0;
                    }
                } else {
                    verificaSenhaNaoSimples = 1;
                }

                //SENHA NÚMERO


                if (response.numeros == 1) {
                    var num = new RegExp("[0-9]+");

                    if (num.test($("#senhaCliente").val())) {
                        $("#verificanumerosCliente").removeClass("fas fa-times");
                        $("#verificanumerosCliente").addClass("fas fa-check");
                        $("#verificanumerosCliente").css("color", "#00A41E");
                        verificanumeros = 1;
                    } else {
                        $("#verificanumerosCliente").removeClass("fas fa-check");
                        $("#verificanumerosCliente").addClass("fas fa-times");
                        $("#verificanumerosCliente").css("color", "#FF0004");
                        verificanumeros = 0;
                    }
                } else {
                    verificanumeros = 1;
                }

                //SENHA LETRAS


                if (response.letras == 1) {
                    var lcase = new RegExp("[A-Za-z]+");

                    if (lcase.test($("#senhaCliente").val())) {
                        $("#verificaletrasCliente").removeClass("fas fa-times");
                        $("#verificaletrasCliente").addClass("fas fa-check");
                        $("#verificaletrasCliente").css("color", "#00A41E");
                        verificaletras = 1;
                    } else {
                        $("#verificaletrasCliente").removeClass("fas fa-check");
                        $("#verificaletrasCliente").addClass("fas fa-times");
                        $("#verificaletrasCliente").css("color", "#FF0004");
                        verificaletras = 0;
                    }
                } else {
                    verificaletras = 1;
                }

                //SENHA LETRAS MAIUSCULA

                if (response.maiusculo == 1) {
                    var ucase = new RegExp("[A-Z]+");

                    if (ucase.test($("#senhaCliente").val())) {
                        $("#verificamaiusculoCliente").removeClass("fas fa-times");
                        $("#verificamaiusculoCliente").addClass("fas fa-check");
                        $("#verificamaiusculoCliente").css("color", "#00A41E");
                        verificamaiusculo = 1;
                    } else {
                        $("#verificamaiusculoCliente").removeClass("fas fa-check");
                        $("#verificamaiusculoCliente").addClass("fas fa-times");
                        $("#verificamaiusculoCliente").css("color", "#FF0004");
                        verificamaiusculo = 0;
                    }
                } else {
                    verificamaiusculo = 1;
                }


                //SENHA CARACTERES ESPECIAIS

                if (response.caracteresEspeciais == 1) {
                    var carespeciallist = /^(?=.*[!@#$%^&*.\£()}{~?><>,|=_+¬-])/;

                    if (carespeciallist.test($("#senhaCliente").val())) {
                        $("#verificacaracteresEspeciaisCliente").removeClass("fas fa-times");
                        $("#verificacaracteresEspeciaisCliente").addClass("fas fa-check");
                        $("#verificacaracteresEspeciaisCliente").css("color", "#00A41E");
                        verificacaracteresEspeciais = 1;
                    } else {
                        $("#verificacaracteresEspeciaisCliente").removeClass("fas fa-check");
                        $("#verificacaracteresEspeciaisCliente").addClass("fas fa-times");
                        $("#verificacaracteresEspeciaisCliente").css("color", "#FF0004");
                        verificacaracteresEspeciais = 0;
                    }
                } else {
                    verificacaracteresEspeciais = 1;
                }


                //CONFIRMAÇÃO DA SENHA

                if ($("#senhaCliente").val() == $("#confirmacaoCliente").val()) {
                    $("#pwmatchCliente").removeClass("fas fa-times");
                    $("#pwmatchCliente").addClass("fas fa-check");
                    $("#pwmatchCliente").css("color", "#00A41E");
                    verificapwmatch = 1;
                } else {
                    $("#pwmatchCliente").removeClass("fas fa-check");
                    $("#pwmatchCliente").addClass("fas fa-times");
                    $("#pwmatchCliente").css("color", "#FF0004");
                    verificapwmatch = 0;
                }


                //ATIVAR BOTÃO SALVAR



                if (verificaMinimoCaracteres == 1 && verificaSenhaNaoSimples == 1 && verificanumeros == 1 && verificaletras == 1 && verificamaiusculo == 1 && verificacaracteresEspeciais == 1 && verificapwmatch == 1) {
                    $('#SalvarTrocaSenhaCliente').prop('disabled', false);
                }
            }
        })

    }


    function verificaSenha(codColaborador) {



        var verificaSenhaNaoSimples = 0;
        var verificanumeros = 0;
        var verificaletras = 0;
        var verificamaiusculo = 0;
        var verificacaracteresEspeciais = 0;
        var verificapwmatch = 0;
        var verificaMinimoCaracteres = 0;



        //VERIFICA CUMPRIMENTO DA SENHA
        if ('<?php echo session()->minimoCaracteres ?>' > 0) {

            if ($("#senha").val().length >= '<?php echo session()->minimoCaracteres ?>') {
                $("#verificaMinimoCaracteres").removeClass("fas fa-times");
                $("#verificaMinimoCaracteres").addClass("fas fa-check");
                $("#verificaMinimoCaracteres").css("color", "#00A41E");
                verificaMinimoCaracteres = 1;
            } else {
                $("#verificaMinimoCaracteres").removeClass("fas fa-check");
                $("#verificaMinimoCaracteres").addClass("fas fa-times");
                $("#verificaMinimoCaracteres").css("color", "#FF0004");
                verificaSenhaNaoSimples = 0;
            }
        } else {
            verificaMinimoCaracteres = 1;
        }




        //SENHA TRIVIAL

        if ('<?php echo session()->senhaNaoSimples ?>' == 1) {

            var backlist = ["", "12345678", "87654321", "11111111", "selvabrasil", "brasil1234", "brasil", "selva"];

            if (jQuery.inArray($("#senha").val(), backlist) == -1) {
                $("#verificaSenhaNaoSimples").removeClass("fas fa-times");
                $("#verificaSenhaNaoSimples").addClass("fas fa-check");
                $("#verificaSenhaNaoSimples").css("color", "#00A41E");
                verificaSenhaNaoSimples = 1;
            } else {
                $("#verificaSenhaNaoSimples").removeClass("fas fa-check");
                $("#verificaSenhaNaoSimples").addClass("fas fa-times");
                $("#verificaSenhaNaoSimples").css("color", "#FF0004");
                verificaSenhaNaoSimples = 0;
            }
        } else {
            verificaSenhaNaoSimples = 1;
        }

        //SENHA NÚMERO


        if ('<?php echo session()->numeros ?>' == 1) {
            var num = new RegExp("[0-9]+");

            if (num.test($("#senha").val())) {
                $("#verificanumeros").removeClass("fas fa-times");
                $("#verificanumeros").addClass("fas fa-check");
                $("#verificanumeros").css("color", "#00A41E");
                verificanumeros = 1;
            } else {
                $("#verificanumeros").removeClass("fas fa-check");
                $("#verificanumeros").addClass("fas fa-times");
                $("#verificanumeros").css("color", "#FF0004");
                verificanumeros = 0;
            }
        } else {
            verificanumeros = 1;
        }

        //SENHA LETRAS


        if ('<?php echo session()->letras ?>' == 1) {
            var lcase = new RegExp("[A-Za-z]+");

            if (lcase.test($("#senha").val())) {
                $("#verificaletras").removeClass("fas fa-times");
                $("#verificaletras").addClass("fas fa-check");
                $("#verificaletras").css("color", "#00A41E");
                verificaletras = 1;
            } else {
                $("#verificaletras").removeClass("fas fa-check");
                $("#verificaletras").addClass("fas fa-times");
                $("#verificaletras").css("color", "#FF0004");
                verificaletras = 0;
            }
        } else {
            verificaletras = 1;
        }

        //SENHA LETRAS MAIUSCULA

        if ('<?php echo session()->maiusculo ?>' == 1) {
            var ucase = new RegExp("[A-Z]+");

            if (ucase.test($("#senha").val())) {
                $("#verificamaiusculo").removeClass("fas fa-times");
                $("#verificamaiusculo").addClass("fas fa-check");
                $("#verificamaiusculo").css("color", "#00A41E");
                verificamaiusculo = 1;
            } else {
                $("#verificamaiusculo").removeClass("fas fa-check");
                $("#verificamaiusculo").addClass("fas fa-times");
                $("#verificamaiusculo").css("color", "#FF0004");
                verificamaiusculo = 0;
            }
        } else {
            verificamaiusculo = 1;
        }


        //SENHA CARACTERES ESPECIAIS

        if ('<?php echo session()->caracteresEspeciais ?>' == 1) {
            var carespeciallist = /^(?=.*[!@#$%^&*.\£()}{~?><>,|=_+¬-])/;

            if (carespeciallist.test($("#senha").val())) {
                $("#verificacaracteresEspeciais").removeClass("fas fa-times");
                $("#verificacaracteresEspeciais").addClass("fas fa-check");
                $("#verificacaracteresEspeciais").css("color", "#00A41E");
                verificacaracteresEspeciais = 1;
            } else {
                $("#verificacaracteresEspeciais").removeClass("fas fa-check");
                $("#verificacaracteresEspeciais").addClass("fas fa-times");
                $("#verificacaracteresEspeciais").css("color", "#FF0004");
                verificacaracteresEspeciais = 0;
            }
        } else {
            verificacaracteresEspeciais = 1;
        }


        //CONFIRMAÇÃO DA SENHA

        if ($("#senha").val() == $("#confirmacao").val()) {
            $("#pwmatch").removeClass("fas fa-times");
            $("#pwmatch").addClass("fas fa-check");
            $("#pwmatch").css("color", "#00A41E");
            verificapwmatch = 1;
        } else {
            $("#pwmatch").removeClass("fas fa-check");
            $("#pwmatch").addClass("fas fa-times");
            $("#pwmatch").css("color", "#FF0004");
            verificapwmatch = 0;
        }


        //ATIVAR BOTÃO SALVAR



        if (verificaMinimoCaracteres == 1 && verificaSenhaNaoSimples == 1 && verificanumeros == 1 && verificaletras == 1 && verificamaiusculo == 1 && verificacaracteresEspeciais == 1 && verificapwmatch == 1) {
            $('#SalvarTrocaSenha').prop('disabled', false);
        }



    }



    function verificaSenhaColaboradorLogada() {


        $.ajax({
            url: '<?php echo base_url('colaboradores/pegaOrganizacaoColaborador') ?>',
            type: 'post',
            data: {
                csrf_Principal: $("#csrf_Principal").val(),
            },
            dataType: 'json',
            success: function(response) {

                var verificaSenhaNaoSimples = 0;
                var verificanumeros = 0;
                var verificaletras = 0;
                var verificamaiusculo = 0;
                var verificacaracteresEspeciais = 0;
                var verificapwmatch = 0;
                var verificaMinimoCaracteres = 0;



                //VERIFICA CUMPRIMENTO DA SENHA
                if (response.minimoCaracteres > 0) {

                    if ($("#senhaColaboradorLogada").val().length >= '<?php echo session()->minimoCaracteres ?>') {
                        $("#verificaMinimoCaracteresColaboradorLogada").removeClass("fas fa-times");
                        $("#verificaMinimoCaracteresColaboradorLogada").addClass("fas fa-check");
                        $("#verificaMinimoCaracteresColaboradorLogada").css("color", "#00A41E");
                        verificaMinimoCaracteres = 1;
                    } else {
                        $("#verificaMinimoCaracteresColaboradorLogada").removeClass("fas fa-check");
                        $("#verificaMinimoCaracteresColaboradorLogada").addClass("fas fa-times");
                        $("#verificaMinimoCaracteresColaboradorLogada").css("color", "#FF0004");
                        verificaSenhaNaoSimples = 0;
                    }
                } else {
                    verificaMinimoCaracteres = 1;
                }




                //SENHA TRIVIAL

                if (response.senhaNaoSimples == 1) {

                    var backlist = ["", "12345678", "87654321", "11111111", "selvabrasil", "brasil1234", "brasil", "selva"];

                    if (jQuery.inArray($("#senhaColaboradorLogada").val(), backlist) == -1) {
                        $("#verificaSenhaNaoSimplesColaboradorLogada").removeClass("fas fa-times");
                        $("#verificaSenhaNaoSimplesColaboradorLogada").addClass("fas fa-check");
                        $("#verificaSenhaNaoSimplesColaboradorLogada").css("color", "#00A41E");
                        verificaSenhaNaoSimples = 1;
                    } else {
                        $("#verificaSenhaNaoSimplesColaboradorLogada").removeClass("fas fa-check");
                        $("#verificaSenhaNaoSimplesColaboradorLogada").addClass("fas fa-times");
                        $("#verificaSenhaNaoSimplesColaboradorLogada").css("color", "#FF0004");
                        verificaSenhaNaoSimples = 0;
                    }
                } else {
                    verificaSenhaNaoSimples = 1;
                }

                //SENHA NÚMERO


                if (response.numeros == 1) {
                    var num = new RegExp("[0-9]+");

                    if (num.test($("#senhaColaboradorLogada").val())) {
                        $("#verificanumerosColaboradorLogada").removeClass("fas fa-times");
                        $("#verificanumerosColaboradorLogada").addClass("fas fa-check");
                        $("#verificanumerosColaboradorLogada").css("color", "#00A41E");
                        verificanumeros = 1;
                    } else {
                        $("#verificanumerosColaboradorLogada").removeClass("fas fa-check");
                        $("#verificanumerosColaboradorLogada").addClass("fas fa-times");
                        $("#verificanumerosColaboradorLogada").css("color", "#FF0004");
                        verificanumeros = 0;
                    }
                } else {
                    verificanumeros = 1;
                }

                //SENHA LETRAS


                if (response.letras == 1) {
                    var lcase = new RegExp("[A-Za-z]+");

                    if (lcase.test($("#senhaColaboradorLogada").val())) {
                        $("#verificaletrasColaboradorLogada").removeClass("fas fa-times");
                        $("#verificaletrasColaboradorLogada").addClass("fas fa-check");
                        $("#verificaletrasColaboradorLogada").css("color", "#00A41E");
                        verificaletras = 1;
                    } else {
                        $("#verificaletrasColaboradorLogada").removeClass("fas fa-check");
                        $("#verificaletrasColaboradorLogada").addClass("fas fa-times");
                        $("#verificaletrasColaboradorLogada").css("color", "#FF0004");
                        verificaletras = 0;
                    }
                } else {
                    verificaletras = 1;
                }

                //SENHA LETRAS MAIUSCULA

                if (response.maiusculo == 1) {
                    var ucase = new RegExp("[A-Z]+");

                    if (ucase.test($("#senhaColaboradorLogada").val())) {
                        $("#verificamaiusculoColaboradorLogada").removeClass("fas fa-times");
                        $("#verificamaiusculoColaboradorLogada").addClass("fas fa-check");
                        $("#verificamaiusculoColaboradorLogada").css("color", "#00A41E");
                        verificamaiusculo = 1;
                    } else {
                        $("#verificamaiusculoColaboradorLogada").removeClass("fas fa-check");
                        $("#verificamaiusculoColaboradorLogada").addClass("fas fa-times");
                        $("#verificamaiusculoColaboradorLogada").css("color", "#FF0004");
                        verificamaiusculo = 0;
                    }
                } else {
                    verificamaiusculo = 1;
                }


                //SENHA CARACTERES ESPECIAIS

                if (response.caracteresEspeciais == 1) {
                    var carespeciallist = /^(?=.*[!@#$%^&*.\£()}{~?><>,|=_+¬-])/;

                    if (carespeciallist.test($("#senhaColaboradorLogada").val())) {
                        $("#verificacaracteresEspeciaisColaboradorLogada").removeClass("fas fa-times");
                        $("#verificacaracteresEspeciaisColaboradorLogada").addClass("fas fa-check");
                        $("#verificacaracteresEspeciaisColaboradorLogada").css("color", "#00A41E");
                        verificacaracteresEspeciais = 1;
                    } else {
                        $("#verificacaracteresEspeciaisColaboradorLogada").removeClass("fas fa-check");
                        $("#verificacaracteresEspeciaisColaboradorLogada").addClass("fas fa-times");
                        $("#verificacaracteresEspeciaisColaboradorLogada").css("color", "#FF0004");
                        verificacaracteresEspeciais = 0;
                    }
                } else {
                    verificacaracteresEspeciais = 1;
                }


                //CONFIRMAÇÃO DA SENHA

                if ($("#senhaColaboradorLogada").val() == $("#confirmacaoColaboradorLogada").val()) {
                    $("#pwmatchColaboradorLogada").removeClass("fas fa-times");
                    $("#pwmatchColaboradorLogada").addClass("fas fa-check");
                    $("#pwmatchColaboradorLogada").css("color", "#00A41E");
                    verificapwmatch = 1;
                } else {
                    $("#pwmatchColaboradorLogada").removeClass("fas fa-check");
                    $("#pwmatchColaboradorLogada").addClass("fas fa-times");
                    $("#pwmatchColaboradorLogada").css("color", "#FF0004");
                    verificapwmatch = 0;
                }


                //ATIVAR BOTÃO SALVAR



                if (verificaMinimoCaracteres == 1 && verificaSenhaNaoSimples == 1 && verificanumeros == 1 && verificaletras == 1 && verificamaiusculo == 1 && verificacaracteresEspeciais == 1 && verificapwmatch == 1) {
                    $('#SalvarTrocaSenhaColaboradorLogada').prop('disabled', false);
                }
            }
        })

    }
</script>