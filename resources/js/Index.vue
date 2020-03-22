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
        //
      }
    },
    components: {
    //   navigationMenu
    }
  }
</script>