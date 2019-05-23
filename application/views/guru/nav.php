<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <div class="navbar-nav ml-auto">
      <a href="<?php echo base_url() ?>guru/data-profil" class="btn btn-default mr-2">Profil</a>
      <a href="<?php echo base_url('auth/logout'); ?>" class="btn btn-default">Logout</a>
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
        <i class="fa fa-th-large"></i>
      </a>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo base_url('admin') ?>" class="brand-link">
      <img src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Ujian Online</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="<?php echo base_url('guru') ?>" class="nav-link <?php echo empty( $this->uri->segment(2) ) ? 'active' : null ?>">
              <i class="nav-icon fa fa-dashboard"></i>
              <p>
                Beranda
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url() ?>guru/data-profil" class="nav-link <?php echo ($this->uri->segment(2) == 'data-profil' ) ? 'active' : null ?>">
              <i class="nav-icon fa fa-user-circle-o"></i>
              <p>
                Profil
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url() ?>guru/data-grup-soal" class="nav-link <?php echo ($this->uri->segment(2) == 'data-grup-soal' ) ? 'active' : null ?>">
              <i class="nav-icon fa fa-archive"></i>
              <p>
                Grup Soal
              </p>
            </a>
          </li>
          <li class="nav-item ">
            <a href="<?php echo base_url() ?>guru/data-soal" class="nav-link <?php echo ($this->uri->segment(2) == 'data-soal' ) ? 'active' : null ?>">
              <i class="nav-icon fa fa-tasks"></i>
              <p>
                Soal
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>