import VueRouter from 'vue-router'


// Pages
import Home from './pages/Home'
import Register from './pages/Register'
import Login from './pages/Login'
import Dashboard from './pages/user/Dashboard'
import AdminDashboard from './pages/admin/Dashboard'
import UserDetails from './pages/admin/userDetails'
import UnverifiedDashboard from './pages/user/UnverifiedDashboard'

// Pages - SCM
import AdminMaster from './pages/scm/admin/Master'
import DashboardAdmin from './pages/scm/admin/Dashboard'
import UserManagement from './pages/scm/admin/UserManagement'
import UserValidation from './pages/scm/admin/UserValidation'
import UserMaster from './pages/scm/user/Master'
import DashboardUser from './pages/scm/user/Dashboard'
import ManajemenLahan from './pages/scm/user/ManajemenLahan'
import RiwayatPengeluaran from './pages/scm/user/RiwayatPengeluaran'
import DaftarMitra from './pages/scm/user/DaftarMitra'
import PermintaanMitra from './pages/scm/user/PermintaanMitra'
import PengajuanMitra from './pages/scm/user/PengajuanMitra'
import TransaksiPemasok from './pages/scm/user/TransaksiPemasok'
import TransaksiPelanggan from './pages/scm/user/TransaksiPelanggan'

// Pages - Bisnis Analitik
import BAMaster from './pages/ba/Master'

// Routes
const routes = [
    // SCM
    {
        path: '/admin',
        component: AdminMaster,
        meta: {
            auth: {
                roles: 1,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [{
                path: '',
                component: DashboardAdmin,
                name: "DashboardAdmin"
            },
            {
                path: 'usermanagement',
                component: UserManagement,
                name: "UserManagement"
            },
            {
                path: 'uservalidation',
                component: UserValidation,
                name: "UserValidation"
            },
        ]
    },
    {
        path: '/user',
        component: UserMaster,
        children: [{
                path: '',
                component: DashboardUser,
                name: "DashboardUser"
            },
            {
                path: 'manajemenlahan',
                component: ManajemenLahan,
                name: "ManajemenLahan"
            },
            {
                path: 'riwayatpengeluaran',
                component: RiwayatPengeluaran,
                name: "RiwayatPengeluaran"
            },
            {
                path: 'daftarmitra',
                component: DaftarMitra,
                name: "DaftarMitra"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitra,
                name: "PermintaanMitra"

            },
            {
                path: 'pengajuanmitra',
                component: PengajuanMitra,
                name: "PengajuanMitra"
            },
            {
                path: 'transaksipemasok',
                component: TransaksiPemasok,
                name: "TransaksiPemasok"
            },
            {
                path: 'transaksipelanggan',
                component: TransaksiPelanggan,
                name: "TransaksiPelanggan"
            },
        ]
    },
    {
        path: '/',
        name: 'bisnisanalitik',
        component: BAMaster
    },
    // {
    //   path: '/',
    //   name: 'home',
    //   component: {
    //     navbar: navbarscm,
    //     wrapper: wrapperscm
    //   }
    // },
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
            if (to.meta.requiresVerified) {
                console.log("dirouterjs")

                // custom payloads
                var datatoken = []
                const url = "/user/getcustompayloads"
                const axiosTest = axios.get
                axiosTest(url).then(function (axiosTestResult) {
                    datatoken = axiosTestResult.data
                    var status = (datatoken.confirmed)
                    if (status === 0) {
                        next('unverified')
                    } else {
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
            if (to.meta.requiresVerified) {
                var datatoken = []
                const url = "/user/getcustompayloads"
                const axiosTest = axios.get
                axiosTest(url).then(function (axiosTestResult) {
                    datatoken = axiosTestResult.data
                    var status = (datatoken.confirmed)
                    if (status === 1) {
                        next('dashboard')
                    } else {
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
            auth: {
                roles: 1,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        }
    },
    {
        path: '/:userId/details',
        name: 'userDetails',
        component: UserDetails,
        meta: {
            auth: {
                roles: 1,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        }
    }
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router
