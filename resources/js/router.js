import VueRouter from 'vue-router'


// Pages
import Register from './pages/Register'
import Login from './pages/Login'
import UnverifiedDashboard from './pages/UnverifiedDashboard'
import NotfoundLoggedUser from './pages/NotFoundLoggedUser'
import NotFoundNonLoggedUser from './pages/NotFoundNonLoggedUser'

// Pages - SCM
import AdminMaster from './pages/admin/Master'
import DashboardAdmin from './pages/admin/Dashboard'
import UserValidation from './pages/admin/UserValidation'
import UserManagement from './pages/admin/UserManagement'

import MasterProd from './pages/scm/produsen/Master' // prod == produsen
import DashboardProd from './pages/scm/produsen/Dashboard' 
import ManajemenLahan from './pages/scm/produsen/ManajemenLahan'
import RiwayatPengeluaran from './pages/scm/produsen/RiwayatPengeluaran'
import DaftarMitraProd from './pages/scm/produsen/DaftarMitra'
import PengajuanMitraProd from './pages/scm/produsen/PengajuanMitra'
import PermintaanMitraProd from './pages/scm/produsen/PermintaanMitra'
import TransaksiPelangganProd from './pages/scm/produsen/TransaksiPelanggan'

import MasterPengepul from './pages/scm/pengepul/Master' // pengepul
import DashboardPengepul from './pages/scm/pengepul/Dashboard'
import DaftarMitraPengepul from './pages/scm/pengepul/DaftarMitra'
import PengajuanMitraPengepul from './pages/scm/pengepul/PengajuanMitra'
import PermintaanMitraPengepul from './pages/scm/pengepul/PermintaanMitra'
import TransaksiPelangganPengepul from './pages/scm/pengepul/TransaksiPelanggan'
import TransaksiPemasokPengepul from './pages/scm/pengepul/TransaksiPemasok'

import MasterGrosir from './pages/scm/grosir/Master' // grosir
import DashboardGrosir from './pages/scm/grosir/Dashboard'
import DaftarMitraGrosir from './pages/scm/grosir/DaftarMitra'
import PengajuanMitraGrosir from './pages/scm/grosir/PengajuanMitra'
import PermintaanMitraGrosir from './pages/scm/grosir/PermintaanMitra'
import TransaksiPelangganGrosir from './pages/scm/grosir/TransaksiPelanggan'
import TransaksiPemasokGrosir from './pages/scm/grosir/TransaksiPemasok'

import MasterPengecer from './pages/scm/pengecer/Master' // pengecer
import DashboardPengecer from './pages/scm/pengecer/Dashboard'
import DaftarMitraPengecer from './pages/scm/pengecer/DaftarMitra'
import PengajuanMitraPengecer from './pages/scm/pengecer/PengajuanMitra'
import PermintaanMitraPengecer from './pages/scm/pengecer/PermintaanMitra'
import TransaksiPelangganPengecer from './pages/scm/pengecer/TransaksiPelanggan'
import TransaksiPemasokPengecer from './pages/scm/pengecer/TransaksiPemasok'

// Pages - Bisnis Analitik
import BAMaster from './pages/ba/Master'
import BisnisAnalitikProd from './pages/ba/produsen/bisnisAnalitik'
import BisnisAnalitikPengepul from './pages/ba/pengepul/BisnisAnalitik'
import BisnisAnalitikGrosir from './pages/ba/grosir/BisnisAnalitik'
import BisnisAnalitikPengecer from './pages/ba/pengecer/BisnisAnalitik'

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
            { path: '*', component: NotfoundLoggedUser },
        ]
    },
    {
        path: '/produsen',
        component: MasterProd,
        meta: {
            checkStatus: true,
            auth: {
                roles: 2,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            },
        },
        children: [
            {
                path: '',
                component: DashboardProd,
                name: "DashboardProd"
            },
            {
                path: 'manajemenlahan',
                component: ManajemenLahan,
                name: "ManajemenLahanProd"
            },
            {
                path: 'riwayatpengeluaran',
                component: RiwayatPengeluaran,
                name: "RiwayatPengeluaran"
            },
            {
                path: 'daftarmitra',
                component: DaftarMitraProd,
                name: "DaftarMitraProd"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraProd,
                name: "PermintaanMitraProd"

            },
            {
                path: 'pengajuanmitra',
                component: PengajuanMitraProd,
                name: "PengajuanMitraProd"
            },
            {
                path: 'transaksipelanggan',
                component: TransaksiPelangganProd,
                name: "TransaksiPelangganProd"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikProd,
                name: "BisnisAnalitikProd"
            },
        ]
    },
    {
        path: '/grosir',
        component: MasterGrosir,
        meta: {
            checkStatus: true,
            auth: {
                roles: 4,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                component: DashboardGrosir,
                name: "DashboardGrosir"
            },
            {
                path: 'daftarmitra',
                component: DaftarMitraGrosir,
                name: "DaftarMitraGrosir"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraGrosir,
                name: "PermintaanMitraGrosir"

            },
            {
                path: 'pengajuanmitra',
                component: PengajuanMitraGrosir,
                name: "PengajuanMitraGrosir"
            },
            {
                path: 'transaksipelanggan',
                component: TransaksiPelangganGrosir,
                name: "TransaksiPelangganGrosir"
            },
            {
                path: 'transaksipemasok',
                component: TransaksiPemasokGrosir,
                name: "TransaksiPemasokGrosir"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikGrosir,
                name: "BisnisAnalitikGrosir"
            },
        ]
    },
    {
        path: '/pengecer',
        component: MasterPengecer,
        meta: {
            checkStatus: true,
            auth: {
                roles: 5,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            },
            
        },
        children: [
            {
                path: '',
                component: DashboardPengecer,
                name: "DashboardPengecer"
            },
            {
                path: 'daftarmitra',
                component: DaftarMitraPengecer,
                name: "DaftarMitraPengecer"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraPengecer,
                name: "PermintaanMitraPengecer"

            },
            {
                path: 'pengajuanmitra',
                component: PengajuanMitraPengecer,
                name: "PengajuanMitraPengecer"
            },
            {
                path: 'transaksipelanggan',
                component: TransaksiPelangganPengecer,
                name: "TransaksiPelangganPengecer"
            },
            {
                path: 'transaksipemasok',
                component: TransaksiPemasokPengecer,
                name: "TransaksiPemasokPengecer"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikPengecer,
                name: "BisnisAnalitikPengecer"
            },
        ]
    },
    {
        path: '/pengepul',
        component: MasterPengepul,
        meta: {
            checkStatus: true,
            auth: {
                roles: 3,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                component: DashboardPengepul,
                name: "DashboardPengepul"
            },
            {
                path: 'daftarmitra',
                component: DaftarMitraPengepul,
                name: "DaftarMitraPengepul"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraPengepul,
                name: "PermintaanMitraPengepul"

            },
            {
                path: 'pengajuanmitra',
                component: PengajuanMitraPengepul,
                name: "PengajuanMitraPengepul"
            },
            {
                path: 'transaksipelanggan',
                component: TransaksiPelangganPengepul,
                name: "TransaksiPelangganPengepul"
            },
            {
                path: 'transaksipemasok',
                component: TransaksiPemasokPengepul,
                name: "TransaksiPemasokPengepul"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikPengepul,
                name: "BisnisAnalitikPengepul"
            },
        ]
    },
    { path: '*', component: NotFoundNonLoggedUser },
    {
        path: '/',
        name: 'bisnisanalitik',
        component: BAMaster
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
    // {
    //     path: '/dashboard/',
    //     name: 'dashboard',
    //     component: Dashboard,
    //     beforeEnter: (to, from, next) => {
    //         if (to.meta.requiresVerified) {
    //             console.log("dirouterjs")

    //             // custom payloads
    //             var datatoken = []
    //             const url = "/user/getcustompayloads"
    //             const axiosTest = axios.get
    //             axiosTest(url).then(function (axiosTestResult) {
    //                 datatoken = axiosTestResult.data
    //                 var status = (datatoken.confirmed)
    //                 if (status === 0) {
    //                     next('unverified')
    //                 } else {
    //                     next();
    //                 }
    //                 // console.log(datatoken.email)
    //                 console.log("kalomuncultandanyasukses")
    //             });
    //         }
    //     },
    //     meta: {
    //         auth: true,
    //         requiresVerified: true,
    //     }
    // },
    {
        path: '/unverified',
        name: 'unverifiedDashboard',
        component: UnverifiedDashboard,
        beforeEnter: (to, from, next) => {
            if (to.meta.requiresVerified) {
                var datauser = []
                const url = "/auth/user"
                const axiosTest = axios.get
                axiosTest(url).then(function (axiosResult) {
                    datauser = axiosResult.data.data
                    // console.log(datauser)
                    var status = (datauser.status)
                    var role = datauser.role
                    console.log(role)
                    if (status === 1) {
                        if(role === 2){next('/produsen') }
                        else if(role === 3){next('/pengepul') }
                        else if(role === 4){next('/grosir') }
                        else if(role === 5){next('/pengecer') }
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
    // {
    //     path: '/:userId/details',
    //     name: 'userDetails',
    //     component: UserDetails,
    //     meta: {
    //         auth: {
    //             roles: 1,
    //             redirect: {
    //                 name: 'login'
    //             },
    //             forbiddenRedirect: '/403'
    //         }
    //     }
    // },
]

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(route => route.meta.checkStatus)) {
//         // (console.log("masuk"))
//         // var datauser = []
//         const authUser = window.localStorage.getItem('isLoggedUser')
//         if (!authUser===true){
//             next({ path: '/login' });
//         } else {
//             axios.get('/auth/user').then(response => {
//                 var datauser = response.data.data
//             //     console.log(datauser)
//                 var status = datauser.status
//             //     console.log(status)
//                 if(status === 0){
//                     // console.log("disini")
//                     next('/unverified');
//                 } else{
//                     next();
//                 }
//             });
//         }
//     }
//     else{
//         next();
//     }
// });

router.beforeEach((to, from, next) => {
    if (to.matched.some(route => route.meta.checkStatus)) {
        function requestAjax(callback){
            axios.get('/auth/user').then(response => {
                if (response.data.status === "success"){
                    callback (response.data.data)
                } else {
                    callback("error")
                }
            })
        }
        function showResult(data){
            const authUser = window.localStorage.getItem('isLoggedUser')
            if (!authUser===true){
                next({ path: '/login' });
            } else {
                if(data != "error"){
                
                    if(data.status === 0){
                        next('/unverified');
                    }else{
                        next();
                    }
                }
            }
        }
        requestAjax(showResult)
        // -------------------------------------------------------
        // const authUser = window.localStorage.getItem('isLoggedUser')
        // if (!authUser===true){
        //     next({ path: '/login' });
        // } else {
        //     axios.get('/auth/user').then(response => {
        //         var datauser = response.data.data
        //     //     console.log(datauser)
        //         var status = datauser.status
        //     //     console.log(status)
        //         if(status === 0){
        //             // console.log("disini")
        //             next('/unverified');
        //         } else{
        //             next();
        //         }
        //     });
        // }
    }
    else{
        next();
    }
});
export default router
