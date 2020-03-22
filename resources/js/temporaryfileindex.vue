<template>
    <div id="main">
        <header id="header">
            <h1>
                <!-- <router-link :to="{name: 'home'}">
                    Laravel Vue Cabai
                </router-link> -->
            </h1>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="">
                    <router-link :to="{name: 'home'}">
                        Laravel Vue Cabai
                    </router-link>
                </a>
               

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!--UNLOGGED-->
                        <div v-if="!$auth.check()">
                        <li  v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
                            <router-link  :to="{ name : route.path }" :key="key">
                                {{route.name}}
                            </router-link>
                        </li>
                        </div>
                        <!--LOGGED USER-->
                        <div v-if="$auth.check(2)">
                        <li  v-for="(route, key) in routes.user" v-bind:key="route.path">
                            <router-link  :to="{ name : route.path }" :key="key">
                                {{route.name}}
                            </router-link>
                        </li>
                        </div>
                        <!--LOGGED ADMIN-->
                        <div v-if="$auth.check(1)">
                        <li  v-for="(route, key) in routes.admin" v-bind:key="route.path">
                            <router-link  :to="{ name : route.path }" :key="key">
                                {{route.name}}
                            </router-link>
                        </li>
                        </div>
                        <!--LOGOUT-->
                        <li v-if="$auth.check()">
                            <a href="#" @click.prevent="$auth.logout();clearLocalStorage()">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
            <!-- <navigationMenu></navigationMenu> -->
        </header>
        <br>
        <div id="content">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
//   import navigationMenu from './components/Menu.vue'
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [
            {
              name: 'Register',
              path: 'register'
            },
            {
              name: 'Login',
              path: 'login'
            }
          ],          // LOGGED USER
          user: [
            {
              name: 'Dashboard',
              path: 'dashboard'
            }
          ],
          // LOGGED ADMIN
          admin: [
            {
              name: 'Dashboard',
              path: 'admin.dashboard'
            }
          ]
        }
      }
    },
    components: {
    //   navigationMenu
    },
    methods: {
      clearLocalStorage(){
        localStorage.clear();
      }
    }
  }
</script>