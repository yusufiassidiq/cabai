<template>
    <div class="wrapper">
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
          <!-- logout -->
          <li v-if="$auth.check()">
            <a href @click.prevent="$auth.logout();clearLocalStorage()">Logout</a>
          </li>
          <!-- SEARCH FORM -->
          <!-- <li class="nac-item"> -->
          <!-- <form class="form-inline ml-3">
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
          </form>-->
          <!-- </li> -->
        </ul>
      </nav>
      <!-- Main Sidebar Container -->
      <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="#" class="brand-link">
          <img
            src="/dist/img/icon_cabai.png"
            class="brand-image img-circle elevation-3"
        />
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
                <router-link to="/admin/" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>Dashboard</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/usermanagement" class="nav-link">
                  <i class="nav-icon fas fa-user-cog"></i>
                  <p>Manajemen akun</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/uservalidation" class="nav-link">
                  <i class="nav-icon fas fa-user-check"></i>
                  <p>Validasi akun</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/target" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i>
                  <p>Rekap Target</p>
                </router-link>
              </li>
              <li class="nav-item">
                <router-link to="/admin/capaian" class="nav-link">
                  <i class="nav-icon fas fa-chart-line"></i>
                  <p>Rekap Pencapaian</p>
                </router-link>
              </li>
            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
      </aside>
      <router-view></router-view>
      <vue-progress-bar></vue-progress-bar>
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
    </div>
</template>

<script>
export default {
  mounted() {
    //
  },
  methods: {
    clearLocalStorage() {
      localStorage.clear();
    }
  }
};
</script>