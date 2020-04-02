<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Perhatian</div>            
            
            <div class="card-body">
                Akun anda belum terverifikasi, mohon tunggu admin untuk memverifikasinya
                <a href="" @click.prevent="$auth.logout();clearLocalStorage()">Logout</a>
            </div>
            
        </div>
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