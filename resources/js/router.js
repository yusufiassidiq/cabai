import VueRouter from 'vue-router'

// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import UserDetails from './pages/admin/userDetails'
import UnverifiedDashboard from './pages/user/UnverifiedDashboard'

// Routes
const routes = [
  {
    path: '/',
    name: 'home',
    component: Home,
    meta: {
      auth: undefined
    }
  },
  {
    path: '/register',
    name: 'register',
    component: Register,
    meta: {
      auth: false
    }
  },
  {
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
    }
  },
  // USER ROUTES
  {
    path: '/dashboard/',
    name: 'dashboard',
    component: Dashboard,
    beforeEnter: (to, from, next) => {
      if(to.meta.requiresVerified) {
        console.log("dirouterjs")

        // custom payloads
        var datatoken = []
        const url = "/user/getcustompayloads"
        const axiosTest = axios.get
        axiosTest(url).then(function(axiosTestResult){
            datatoken = axiosTestResult.data
            var status = (datatoken.confirmed)
            if(status === 0){
              next('unverified')
            }else{
              next();
            }
            // console.log(datatoken.email)
            console.log("kalomuncultandanyasukses")
        });        
      }
    },
    meta: {
      auth: true,
      requiresVerified: true,
    }
  },
  {
    path: '/unverified',
    name: 'unverifiedDashboard',
    component: UnverifiedDashboard,
    beforeEnter: (to, from, next) => {
      if(to.meta.requiresVerified) {
        var datatoken = []
        const url = "/user/getcustompayloads"
        const axiosTest = axios.get
        axiosTest(url).then(function(axiosTestResult){
        datatoken = axiosTestResult.data
        var status = (datatoken.confirmed)
        if(status === 1){
          next('dashboard')
        }else{
          next();
        }
        });
      }
    },
    meta: {
      auth: true,
      requiresVerified: true,
    }
  },
  // ADMIN ROUTES
  {
    path: '/admin',
    name: 'admin.dashboard',
    component: AdminDashboard,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  },
  {
    path: '/:userId/details',
    name: 'userDetails',
    component: UserDetails,
    meta: {
      auth: {roles: 1, redirect: {name: 'login'}, forbiddenRedirect: '/403'}
    }
  }
]

const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})

export default router