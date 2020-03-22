<template>
<div>
    <h3>List of users</h3>
    <div class="alert alert-danger" v-if="has_error">
        <p>Error, unable to retrieve the list of users.</p>
    </div>    
  
    <table class="table">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Status</th>
            <th scope="col">Registration date</th>
            <th scope="col">Action</th>
        </tr>
        <tr v-for="user in users" v-bind:key="user.id" style="margin-bottom: 5px;">
            <th scope="row">{{ user.id }}</th>
            <td>{{ user.name }}</td>
            <td>{{ user.email }}</td>
            <td>
            <div v-if="user.status===1">Verified</div>
            <div v-else>Unverified</div>
            </td>
            <td>{{ user.created_at}}</td>
            <td><button class="btn btn-danger" v-on:click="deleteUser(user.id)">Tolak</button>
            <router-link :to="{ name: 'userDetails', params: { userId: user.id, userObj: user }}" class="btn btn-primary">
                Detail </router-link>       
            </td>        
        </tr>
    </table>

</div>

</template>

<script>
  // import UserDetails  from './UserDetails.vue';
  export default {
    components:{
      // UserDetails
      },
    data() {
      return {
        userId:'',
        has_error: false,
        users: null,
      }
    },    
    mounted() {
      this.getUsers()
    },    
    
    methods: {
      getUsers() {
        this.$http({
          url: `users`,
          method: 'GET'
        })
            .then((res) => {this.users = res.data.users}, () => {this.has_error = true})
      },
      deleteUser(id) {
        // delete data
        if(confirm('Are you sure?')){
        this.loading = !this.loading
        axios.delete("/user/" + id)
        .then(response => {this.getUsers();})
        .catch((error) => {
          console.log(error);
          })
        }
      },
    }
  }
</script>