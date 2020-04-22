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
import PermintaanMitraProd from './pages/scm/produsen/PermintaanMitra'
import PermintaanCabai from './pages/scm/produsen/PermintaanCabai'
import MitraSayaProd from './pages/scm/produsen/MitraSaya'
import InventarisProdusen from "./pages/scm/produsen/Inventaris"

import MasterPengepul from './pages/scm/pengepul/Master' // pengepul
import DashboardPengepul from './pages/scm/pengepul/Dashboard'
import DaftarMitraPengepul from './pages/scm/pengepul/DaftarMitra'
import PermintaanMitraPengepul from './pages/scm/pengepul/PermintaanMitra'
import PermintaanCabaiPengepul from './pages/scm/pengepul/PermintaanCabai'
import InventarisPengepul from './pages/scm/pengepul/Inventaris'
import MitraSayaPengepul from './pages/scm/pengepul/MitraSaya'

import MasterGrosir from './pages/scm/grosir/Master' // grosir
import DashboardGrosir from './pages/scm/grosir/Dashboard'
import DaftarMitraGrosir from './pages/scm/grosir/DaftarMitra'
import PermintaanMitraGrosir from './pages/scm/grosir/PermintaanMitra'
import PermintaanCabaiGrosir from './pages/scm/grosir/PermintaanCabai'
import InventarisGrosir from './pages/scm/grosir/Inventaris'
import MitraSayaGrosir from './pages/scm/grosir/MitraSaya'


import MasterPengecer from './pages/scm/pengecer/Master' // pengecer
import DashboardPengecer from './pages/scm/pengecer/Dashboard'
import DaftarMitraPengecer from './pages/scm/pengecer/DaftarMitra'
import PermintaanMitraPengecer from './pages/scm/pengecer/PermintaanMitra'
import PermintaanCabaiPengecer from './pages/scm/pengecer/PermintaanCabai'
import InventarisPengecer from './pages/scm/pengecer/Inventaris'
import MitraSayaPengecer from './pages/scm/pengecer/MitraSaya'

import MasterKonsumen from './pages/scm/konsumen/Master' // Konsumen
import DashboardKonsumen from './pages/scm/konsumen/Dashboard'
import DaftarMitraKonsumen from './pages/scm/konsumen/DaftarMitra'
import PermintaanMitraKonsumen from './pages/scm/konsumen/PermintaanMitra'
// import TransaksiPelangganKonsumen from './pages/scm/konsumen/TransaksiPelanggan'
// import TransaksiPemasokKonsumen from './pages/scm/konsumen/TransaksiPemasok'
// import InventarisKonsumen from './pages/scm/konsumen/Inventaris'
import MitraSayaKonsumen from './pages/scm/konsumen/MitraSaya'

// Pages - Bisnis Analitik
import BAMaster from './pages/ba/Master'
import TargetProd from './pages/ba/produsen/Target'
import PenjualanProd from './pages/ba/produsen/Penjualan'
import PengeluaranProd from './pages/ba/produsen/Pengeluaran'
import BisnisAnalitikProd from './pages/ba/produsen/bisnisAnalitik'
import BisnisAnalitikPengepul from './pages/ba/pengepul/BisnisAnalitik'
import BisnisAnalitikGrosir from './pages/ba/grosir/BisnisAnalitik'
import BisnisAnalitikPengecer from './pages/ba/pengecer/BisnisAnalitik'

//test
import BAMaster2 from './pages/ba/Master2'

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
                path: 'inventaris',
                component: InventarisProdusen,
                name: "InventarisProdusen"
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
                path: 'mitrasaya',
                component: MitraSayaProd,
                name: "MitraSayaProd"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraProd,
                name: "PermintaanMitraProd"

            },
            {
                path: 'permintaancabai',
                component: PermintaanCabai,
                name: "PermintaanCabai"
            },
            //BA
            {
                path: 'analitik',
                component: BisnisAnalitikProd,
                name: "BisnisAnalitikProd"
            },
            {
                path: 'target',
                component: TargetProd,
                name: "TargetProd"
            },
            {
                path: 'penjualan',
                component: PenjualanProd,
                name: "PenjualanProd"
            },
            {
                path: 'pengeluaran',
                component: PengeluaranProd,
                name: "PengeluaranProd"
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
                path: 'mitrasaya',
                component: MitraSayaGrosir,
                name: "MitraSayaGrosir"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraGrosir,
                name: "PermintaanMitraGrosir"

            },
            {
                path: 'permintaancabai',
                component: PermintaanCabaiGrosir,
                name: "PermintaanCabaiGrosir"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikGrosir,
                name: "BisnisAnalitikGrosir"
            },
            {
                path: 'inventaris',
                component: InventarisGrosir,
                name: "InventarisGrosir"
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
                path: 'mitrasaya',
                component: MitraSayaPengecer,
                name: "MitraSayaPengecer"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraPengecer,
                name: "PermintaanMitraPengecer"

            },
            {
                path: 'permintaancabai',
                component: PermintaanCabaiPengecer,
                name: "PermintaanCabaiPengecer"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikPengecer,
                name: "BisnisAnalitikPengecer"
            },
            {
                path: 'inventaris',
                component: InventarisPengecer,
                name: "InventarisPengecer"
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
                path: 'mitrasaya',
                component: MitraSayaPengepul,
                name: "MitraSayaPengepul"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraPengepul,
                name: "PermintaanMitraPengepul"

            },
            {
                path: 'permintaancabai',
                component: PermintaanCabaiPengepul,
                name: "PermintaanCabaiPengepul"
            },
            {
                path: 'analitik',
                component: BisnisAnalitikPengepul,
                name: "BisnisAnalitikPengepul"
            },
            {
                path: 'inventaris',
                component: InventarisPengepul,
                name: "InventarisPengepul"
            },
        ]
    },
    {
        path: '/konsumen',
        component: MasterKonsumen,
        meta: {
            checkStatus: true,
            auth: {
                roles: 6,
                redirect: {
                    name: 'login'
                },
                forbiddenRedirect: '/403'
            }
        },
        children: [
            {
                path: '',
                component: DashboardKonsumen,
                name: "DashboardKonsumen"
            },
            {
                path: 'daftarmitra',
                component: DaftarMitraKonsumen,
                name: "DaftarMitraKonsumen"
            },
            {
                path: 'mitrasaya',
                component: MitraSayaKonsumen,
                name: "MitraSayaKonsumen"
            },
            {
                path: 'permintaanmitra',
                component: PermintaanMitraKonsumen,
                name: "PermintaanMitraKonsumen"

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
        path: '/detail',
        name: 'badetail',
        component: BAMaster2
    },
    {
        path: '/register',
        name: 'register',
        component: Register,
        meta: {
            auth: undefined
        }
    },
    {
        path: '/login',
        name: 'login',
        component: Login,
        meta: {
            auth: undefined
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
