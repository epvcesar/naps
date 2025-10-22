<!DOCTYPE html>
<!--<html dir="rtl" lang="ar">-->
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= 'SFPC - ' . esc($title) ?></title>
  <meta name="description" content="SFPC">
  <meta name="keyword" content="SFPCp">
  <meta name="author" content="Emanuel Peixoto">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?= csrf_meta();
  ?>


  <!-- Google Font: Thai Fonts -->
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">-->
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') ?>">
  <!-- Theme style -->

  <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/css/adminlte.min.css">
  <!-- Styles -->
  <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/select2/dist/select2.min.css" />

  <!-- SweetAlert2 Bootstrap or Dark -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/css/sweetalert2-dark.min.css') ?>">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/plugins/datatables/DataTables-1.11.3/css/dataTables.bootstrap5.min.css'); ?>">
  <link rel="stylesheet" href="<?= base_url('asset/adminlte/plugins/datatables/Responsive-2.2.9/css/responsive.bootstrap5.min.css'); ?>">

  <link rel="stylesheet" href="<?= base_url('asset/adminlte/plugins/datatables/StateRestore-1.1.1/css/stateRestore.bootstrap5.min.css') ?>">
  <!-- Dark style -->
  <!--<link rel="stylesheet" href="<?php /* echo base_url('asset/css/dark/adminlte-dark-addon.min.css')*/ ?>">  -->


  <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/css/star-rating.min.css" />


  <link rel="stylesheet" href="<?php echo base_url() ?>/asset/adminlte/plugins/star-rating/themes/krajee-svg/theme.css" />


</head>

<style>
  table.dataTable tbody td {
    vertical-align: middle;
  }

  /* Force all Bootstrap modals to occupy the full viewport without margins */
  /* Ensure backdrop and modal container cover entire viewport */
  .modal,
  .modal-backdrop {
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
  }

  /* Remove default modal paddings and centering so dialog can fill screen */
  .modal {
    padding: 0 !important;
  }

  /* Dialog should be full width/height */
  .modal-dialog,
  .modal-dialog-fullscreen,
  .modal.fullscreen {
    width: 100% !important;
    max-width: 100% !important;
    height: 100vh !important;
    margin: 0 !important;
    transform: none !important;
    padding: 0 !important;
  }

  /* Content must fill dialog; remove rounded corners and shadows */
  .modal-content {
    height: 100vh;
    border: 0;
    border-radius: 0 !important;
    box-shadow: none !important;
    display: flex;
    flex-direction: column;
  }

  /* Header and footer keep their natural size; body fills remaining space and scrolls */
  .modal-header,
  .modal-footer {
    flex: 0 0 auto;
  }

  .modal-body {
    flex: 1 1 auto;
    overflow: auto;
    padding: 1rem;
  }
</style>



<div class="modal fade" id="modal-senha">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h4 class="modal-title">ATUALIZAÇÃO DA SENHA</h4>
        <a type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </a>
      </div>
      <div class="modal-body  bg-light text-dark">
        <form id="formTrocaSenha" method="post">

          <div class="row">
            <input type="hidden" id="<?php echo csrf_token() ?>formTrocaSenha" name="<?php echo csrf_token() ?>" value="<?php echo csrf_hash() ?>">

            <input type="hidden" id="codColaborador" name="codColaborador">
          </div>



          <div class="row">

            <div class="col-md-6">
              <div class="form-group">
                <label for="senha"> Senha: </label>
                <input type="password" id="senha" name="senha" class="form-control" autocomplete="off" placeholder="Senha" maxlength="100">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="confirmacao"> Confirmação: </label>
                <input type="password" id="confirmacao" name="confirmacao" class="form-control" autocomplete="off" placeholder="Confirmação" maxlength="40">
              </div>
            </div>


          </div>

          <?php

          if (session()->politicaSenha == 1) {
          ?>


            <div class="row">

              <?php
              if (isset(session()->minimoCaracteres) and  session()->minimoCaracteres > 0) {
              ?>
                <div class="col-sm-12">
                  <i id="verificaMinimoCaracteres" style="color:#FF0004;" class="fas fa-times"></i> <span> Contém <?php echo session()->minimoCaracteres ?> Caracteres</span>
                </div>
              <?php
              }
              ?>

              <?php
              if (session()->senhaNaoSimples == 1) {
              ?>
                <div class="col-sm-12">
                  <i id="verificaSenhaNaoSimples" style="color:#FF0004;" class="fas fa-times"></i> <span> Senha trivial</span>
                </div>
              <?php
              }
              ?>


              <?php
              if (session()->numeros == 1) {
              ?>
                <div class="col-sm-12">
                  <i id="verificanumeros" style="color:#FF0004;" class="fas fa-times"></i> <span>Contém número</span>
                </div>
              <?php
              }
              ?>

              <?php
              if (session()->letras == 1) {
              ?>
                <div class="col-sm-12">
                  <i id="verificaletras" style="color:#FF0004;" class="fas fa-times"></i> <span>Contém letra</span>
                </div>
              <?php
              }
              ?>


              <?php
              if (session()->maiusculo == 1) {
              ?>
                <div class="col-sm-12">
                  <i id="verificamaiusculo" style="color:#FF0004;" class="fas fa-times"></i> <span>Contém letra Maiúscula</span>
                </div>
              <?php
              }
              ?>


              <?php
              if (session()->caracteresEspeciais == 1) {
              ?>
                <div class="col-sm-12">
                  <i id="verificacaracteresEspeciais" style="color:#FF0004;" class="fas fa-times"></i> <span>Contém caracteres especiais</span>
                </div>
              <?php
              }
              ?>

              <div class="col-sm-12">
                <i id="pwmatch" style="color:#FF0004;" class="fas fa-times"></i> <span>Confirmação da senha</span>
              </div>
            </div>
          <?php
          }
          ?>

          <div class="form-group text-center">
            <div class="btn-group">
              <button disabled="disabled" type="button" onclick="trocaSenhaAgora()" class="btn btn-xs btn-primary" id="SalvarTrocaSenha">TROCAR SENHA</button>
            </div>
          </div>
        </form>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>