<?php

use App\Models\ModulosModel;
use App\Models\PortalOrganizacaoModel;

$this->ModulosModel = new ModulosModel();
$this->PortalOrganizacaoModel = new PortalOrganizacaoModel();
$Modulos_raiz = $this->ModulosModel->pegaModulosRaiz();
$Modulos_filho = $this->ModulosModel->pegaModulosFilho();
$multiSiteLoginAtivado = $this->PortalOrganizacaoModel->multiSiteLoginAtivado();

?>


<!-- Main Sidebar Container -->
<!--<aside class="main-sidebar sidebar-bg-dark sidebar-color-primary shadow">-->
<aside class="main-sidebar sidebar-bg-light sidebar-color-primary shadow">
  <div class="brand-container mt-5">
    <a href="javascript:;" class="brand-link">
      <img src="<?php echo base_url() ?>imagens/logo-om.png" alt="7RM" class="brand-image opacity-80 shadow">
      <span class="brand-text fw-light">Cmdo 7ª RM</span>
    </a>
    <a class="pushmenu mx-1" data-lte-toggle="sidebar-mini" href="javascript:;" role="button"><i class="fas fa-angle-double-left"></i></a>
  </div>
  <!-- Sidebar -->
  <div>
    <?php
    if (isset(session()->logo)) {
      $url_logo = base_url() . "/imagens/organizacoes/" . session()->logo;
    } else {
      $url_logo = null;
    }
    ?>

  </div>


  <div class="sidebar">
    <nav class="mt-2">
      <!-- Sidebar Menu -->
      <ul class="nav nav-pills nav-sidebar flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

        <li class="nav-item mb-2">
          <div style="text-align:center">
            <select required class="form-control" id="codOrganizacaoMenuPrincipal" name="codOrganizacao">
            </select>

          </div>
        </li>

        <li class="nav-item mb-2">
          <div style="text-align:center">
            <select required class="form-control" id="codPerfilMenuPrincipal" name="codOrganizacao">
            </select>

          </div>
        </li>

        <div id="menuDinamico"></div>

      </ul>
    </nav>
  </div>

</aside>


<script>


  </script>