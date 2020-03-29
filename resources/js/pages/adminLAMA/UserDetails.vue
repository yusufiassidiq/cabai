<template>
<div class="container">
    <div class="card card-default">
        <div class="card-header">Admin Dashboard</div>            
        <div class="card-body">
            <div>Id user ini (dari params) = {{id}}</div>
            <!-- <div>nama dari params nya = {{user.name}}</div>  -->
            <div >id dari api = {{userAPI.user.id}}</div>
            <div >status dari api = {{userAPI.user.status}}</div>
            <button class="btn btn-success" v-on:click="terima(userAPI.user.id)">Terima</button>
            </div>        
    </div>
</div>
    
</template>

<script>
export default {
    data(){
        return{
            // user : this.$route.params.userObj,
            userAPI : [],
            id : this.$route.params.userId
        }
    },
    mounted(){
        // this.id=this.$route.params.userId
        //     axios.get("/users/"+this.id).then(response => {
        //     this.userAPI = response.data;
        //     });
        this.getData()
    },
    methods: {
        getData(){
            this.id=this.$route.params.userId
            axios.get("/users/"+this.id).then(response => {
            this.userAPI = response.data;
            });
        },
        terima(id){
            axios.post("/terima/"+id).then(response => {
            this.getData()
            }).catch((error) => {
            console.log(error);
          })
        },
    },
}
</script>