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
          <a href="" class="btn btn-block btn-danger btn-sm" @click.prevent="$auth.logout();clearLocalStorage()">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            Logout
          </a>
        </li>
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
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="/dist/img/userprofile.png" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="#" class="">{{ userlogin }}</a>
          </div>
        </div>
        <nav class="mt-2">
          <ul
            class="nav nav-pills nav-sidebar flex-column"
            data-widget="treeview"
            role="menu"
            data-accordion="false"
          >
            <li class="nav-item">
              <router-link to="/produsen/" class="nav-link">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>Dashboard</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/chat" class="nav-link">
                <i class="nav-icon fas fa-envelope"></i>
                <p>Pesan</p>
              </router-link>
            </li>
            <li class="nav-header">Produksi</li>
            <li class="nav-item">
              <router-link to="/produsen/manajemenlahan" class="nav-link">
                <i class="fas fa-seedling nav-icon"></i>
                <p>Manajemen Lahan</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/riwayatpengeluaran" class="nav-link">
                <i class="fas fa-history nav-icon"></i>
                <p>Riwayat Pengeluaran</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/hasilpanen" class="nav-link">
                <i class="nav-icon far fa-clipboard"></i>
                <p>Hasil Panen</p>
              </router-link>
            </li>
            <li class="nav-header">Inventaris</li>
            <li class="nav-item">
              <router-link to="/produsen/inventaris" class="nav-link">
                <i class="nav-icon fas fa-tasks"></i>
                <p>Inventaris</p>
              </router-link>
            </li>
            <li class="nav-header">Kemitraan</li>
            <li class="nav-item">
              <router-link to="/produsen/daftarmitra" class="nav-link">
                <i class="fas fa-user-plus nav-icon"></i>
                <p>Tambah Mitra</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/mitrasaya" class="nav-link">
                <i class="fas fa-user-friends nav-icon"></i>
                <p>Mitra Saya</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/permintaanmitra" class="nav-link">
                <i class="fas fa-user-clock nav-icon"></i>
                <p>Permintaan Mitra</p>
              </router-link>
            </li>
            <li class="nav-header">Distribusi</li>
            <li class="nav-item">
              <router-link to="/produsen/distribusicabai" class="nav-link">
                <i class="fas fa-receipt nav-icon"></i>
                <p>Distribusi Cabai</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/riwayatdistribusi" class="nav-link">
                <i class="fas fa-receipt nav-icon"></i>
                <p>Riwayat Distribusi</p>
              </router-link>
            </li>
            <li class="nav-header">MANAJEMEN BISNIS</li>
            <li class="nav-item">
              <router-link to="/produsen/target" class="nav-link">
                <i class="fas fa-bullseye nav-icon"></i>
                <p>Rekap Target</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/penjualan" class="nav-link">
                <i class="fas fa-chart-line nav-icon"></i>
                <p>Rekap Penjualan</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/pengeluaran" class="nav-link">
                <i class="fas fa-hand-holding-usd nav-icon"></i>
                <p>Rekap Pengeluaran</p>
              </router-link>
            </li>
            <li class="nav-item">
              <router-link to="/produsen/harga" class="nav-link">
                <i class="fas fa-money-bill-wave nav-icon"></i>
                <p>Rekap Harga Cabai</p>
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
  data(){
    return{
      userlogin:"",
      role:""
    }
  },
  mounted() {
    this.userlogin = localStorage.getItem("namauser")
  },
  methods: {
    clearLocalStorage() {
      localStorage.clear();
    },
  },
}
</script>