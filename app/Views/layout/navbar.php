<!--  <nav class="main-header navbar navbar-expand navbar-dark"> !-->
<nav class="main-header navbar navbar-expand navbar-light">
  <div class="container-fluid">
    <!-- Start navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar-full" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-md-block">
        <a href="home" class="nav-link">Home</a>
      </li>
    </ul>

    <!-- End navbar links -->
    <ul class="navbar-nav ms-auto">
      

      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <span class="d-none d-md-inline"><?php echo session()->nomeExibicao?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
          <!-- User image -->
          <li class="user-header bg-primary">

            <p>
              <?php echo session()->nomeExibicao?>
            </p>
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <!--<a href="#" class="btn btn-default btn-flat"><?= lang("App.profile") ?></a>-->
            <a href="./login/logout" class="btn btn-default btn-flat float-end"><?= lang("App.signOut") ?></a>
          </li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
