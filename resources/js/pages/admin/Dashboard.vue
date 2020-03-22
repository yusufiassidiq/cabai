<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Admin Dashboard</div>            
            <div class="card-body">
                Welcome to your administrator dashboard
            </div>        
        </div>
        <div class="card card-default">
            <div class="card-header">List of Users</div>            
            <div class="card-body">
                <userList></userList>
            </div>
        </div>
    </div>
</template>
<script>
  import userList from '../../pages/admin/user-list.vue'
  export default {
    mounted() {
      //
    },
    components: {
      userList
    }
  }
</script>