<template>
    <div class="container">
        <div class="card card-default">
            <div class="card-header">Connexion</div>            
            
            <div class="card-body">
                <div class="alert alert-danger" v-if="has_error">
                    <p>Erreur, impossible de se connecter avec ces identifiants.</p>
                </div>
                <form autocomplete="off" @submit.prevent="login" method="post">
                    <div class="form-group">
                        <label for="email">E-mail</label>
                        <input type="email" id="email" class="form-control" placeholder="user@example.com" v-model="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" class="form-control" v-model="password" required>
                    </div>
                    <button type="submit" class="btn btn-default">Login</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
  export default {
    data() {
      return {
        email: null,
        password: null,
        has_error: false
      }
    },    
    
    mounted() {
      //
    },    
    
    methods: {
      login() {
        // get the redirect object
        var redirect = this.$auth.redirect()
        var app = this
        this.$auth.login({
          params: {
            email: app.email,
            password: app.password,
          },
          success: function() {
            // handle redirection
            // const redirectTo = redirect ? redirect.from.name : this.$auth.user().role === 2 ? 'admin.dashboard' : 'dashboard'            
            
            let redirectTo;
            if (redirect){
              redirectTo = redirect.from.name
            } else if (this.$auth.user().role === 1){
              redirectTo = 'admin.dashboard'
            } else if (this.$auth.user().role === 2){
              if(this.$auth.user().status === 0){
                redirectTo = 'unverifiedDashboard'
              }else if (this.$auth.user().status === 1){
                redirectTo = 'dashboard'
                }
            }
            // var sts = this.$auth.user()
            // let LS_STAT_KEY = null
            // console.log("aa")
            // console.log(sts)
            // console.log("zz")
            // localStorage.setItem('LS_STAT_KEY', sts)
            this.$router.push({name: redirectTo, params:{usrId: this.$auth.user().id}}).catch(err => {})
          },
          error: function() {
            app.has_error = true
          },
          rememberMe: true,
          fetchUser: true
        })
      }
    }
  }
</script>