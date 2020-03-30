<template>
  <div>
    <div class="masterscm">
      <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#">
              <i class="fas fa-bars"></i>
            </a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- SEARCH FORM -->
          <li class="nac-item">
            <form class="form-inline ml-3">
              <div class="input-group input-group-sm">
                <input
                  class="form-control form-control-navbar"
                  type="search"
                  placeholder="Search"
                  aria-label="Search"
                />
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                </div>
              </div>
            </form>
          </li>
        </ul>
      </nav>
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <!-- <img
            src="dist/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: .8"
          /> -->
          <span class="brand-text font-weight-light">SCM Cabai</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul
              class="nav nav-pills nav-sidebar flex-column"
              data-widget="treeview"
              role="menu"
              data-accordion="false"
            >
              <li class="nav-item">
                <router-link to="/pengepul/" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </router-link>
              </li>
              <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link disable">
                  <i class="nav-icon fas fa-address-book"></i>
                  <p>
                    Mitra
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <router-link to="/pengepul/daftarmitra" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daftar Mitra</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/pengepul/permintaanmitra" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Permintaan Mitra</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/pengepul/pengajuanmitra" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pengajuan Mitra</p>
                    </router-link>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <router-link to="#" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>Inventaris</p>
                </router-link>
              </li>
              <li class="nav-item has-treeview menu-closed">
                <a href="#" class="nav-link disable">
                  <i class="nav-icon fas fa-shopping-cart"></i>
                  <p>
                    Transaksi
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <router-link to="/pengepul/transaksipemasok" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pemasok</p>
                    </router-link>
                  </li>
                  <li class="nav-item">
                    <router-link to="/pengepul/transaksipelanggan" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Pelanggan</p>
                    </router-link>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <router-link to="/pengepul/analitik" class="nav-link">
                  <i class="nav-icon fas fa-chart-bar"></i>
                  <p>Bisnis Analitik</p>
                </router-link>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
    </div>
    <router-view></router-view>
    <footer class="main-footer">
      <strong>
        Copyright &copy; 2014-2019
        <a href="http://adminlte.io">AdminLTE.io</a>.
      </strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.0.2
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
  </div>
</template>
