import VueRouter from 'vue-router'


// Pages
import Register from './pages/Register'
import Login from './pages/Login'
import UnverifiedDashboard from './pages/UnverifiedDashboard'
import FailedValidation from './pages/UserGagalValidasi'
import NotfoundLoggedUser from './pages/NotFoundLoggedUser'
import NotFoundNonLoggedUser from './pages/NotFoundNonLoggedUser'
import Chat from './components/chat/Chat'

// Pages - SCM
import AdminMaster from './pages/admin/Master'
import DashboardAdmin from './pages/admin/Dashboard'
import UserValidation from './pages/admin/UserValidation'
import UserManagement from './pages/admin/UserManagement'
import TargetRecap from './pages/admin/TargetRecap'

import MasterProd from './pages/scm/produsen/Master' // prod == produsen
import DashboardProd from './pages/scm/produsen/Dashboard' 
import ManajemenLahan from './pages/scm/produsen/ManajemenLahan'
import RiwayatPengeluaran from './pages/scm/produsen/RiwayatPengeluaran'
import DaftarMitraProd from './pages/scm/produsen/DaftarMitra'
import PermintaanMitraProd from './pages/scm/produsen/PermintaanMitra'
import TransaksiCabai from './pages/scm/produsen/TransaksiCabai'
import MitraSayaProd from './pages/scm/produsen/MitraSaya'
import InventarisProdusen from "./pages/scm/produsen/Inventaris"
import HasilPanenProd from './pages/scm/produsen/HasilPanen'
import RiwayatTransaksiProd from './pages/scm/produsen/RiwayatTransaksi'

import MasterPengepul from './pages/scm/pengepul/Master' // pengepul
import DashboardPengepul from './pages/scm/pengepul/Dashboard'
import DaftarMitraPengepul from './pages/scm/pengepul/DaftarMitra'
import PermintaanMitraPengepul from './pages/scm/pengepul/PermintaanMitra'
import TransaksiCabaiPengepul from './pages/scm/pengepul/TransaksiCabai'
import InventarisPengepul from './pages/scm/pengepul/Inventaris'
import MitraSayaPengepul from './pages/scm/pengepul/MitraSaya'
import RiwayatTransaksiPengepul from './pages/scm/pengepul/RiwayatTransaksi'

import MasterGrosir from './pages/scm/grosir/Master' // grosir
import DashboardGrosir from './pages/scm/grosir/Dashboard'
import DaftarMitraGrosir from './pages/scm/grosir/DaftarMitra'
import PermintaanMitraGrosir from './pages/scm/grosir/PermintaanMitra'
import TransaksiCabaiGrosir from './pages/scm/grosir/TransaksiCabai'
import InventarisGrosir from './pages/scm/grosir/Inventaris'
import MitraSayaGrosir from './pages/scm/grosir/MitraSaya'
import RiwayatTransaksiGrosir from './pages/scm/grosir/RiwayatTransaksi'


import MasterPengecer from './pages/scm/pengecer/Master' // pengecer
import DashboardPengecer from './pages/scm/pengecer/Dashboard'
import DaftarMitraPengecer from './pages/scm/pengecer/DaftarMitra'
import PermintaanMitraPengecer from './pages/scm/pengecer/PermintaanMitra'
import TransaksiCabaiPengecer from './pages/scm/pengecer/TransaksiCabai'
import InventarisPengecer from './pages/scm/pengecer/Inventaris'
import MitraSayaPengecer from './pages/scm/pengecer/MitraSaya'
import RiwayatTransaksiPengecer from './pages/scm/pengecer/RiwayatTransaksi'


import MasterKonsumen from './pages/scm/konsumen/Master' // Konsumen
import DashboardKonsumen from './pages/scm/konsumen/Dashboard'
import DaftarMitraKonsumen from './pages/scm/konsumen/DaftarMitra'
import PermintaanMitraKonsumen from './pages/scm/konsumen/PermintaanMitra'
// import TransaksiPelangganKonsumen from './pages/scm/konsumen/TransaksiPelanggan'
// import TransaksiPemasokKonsumen from './pages/scm/konsumen/TransaksiPemasok'
// import InventarisKonsumen from './pages/scm/konsumen/Inventaris'
import TransaksiCabaiKonsumen from './pages/scm/konsumen/TransaksiCabai'
import MitraSayaKonsumen from './pages/scm/konsumen/MitraSaya'
import RiwayatTransaksiKonsumen from './pages/scm/konsumen/RiwayatTransaksi'

// Pages - Bisnis Analitik
// Home
import BAMaster from './pages/ba/Master'
import BADetailHarga from './pages/ba/detail/Harga'
import BADetailProduksi from './pages/ba/detail/Produksi'
import BADetailProduktivitas from './pages/ba/detail/Produktivitas'
import BADetailStok from './pages/ba/detail/Stok'
// Auth
import TargetProd from './pages/ba/produsen/Target'
import PenjualanProd from './pages/ba/produsen/Penjualan'
import PengeluaranProd from './pages/ba/produsen/Pengeluaran'
import HargaProd from './pages/ba/produsen/Harga'


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
            {
                path: 'target',
                component: TargetRecap,
                name: "TargetRecap"
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
                path: 'chat',
                component: Chat,
                name: "Chat-Produsen",
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
                path: 'hasilpanen',
                component: HasilPanenProd,
                name:"HasilPanenProd"
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
                path: 'distribusicabai',
                component: TransaksiCabai,
                name: "transaksicabai"
            },
            {
                path: 'riwayatdistribusi',
                component: RiwayatTransaksiProd,
                name: 'riwayattransaksiProd'
            },
            //BA
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
            {
                path: 'harga',
                component: HargaProd,
                name: "HargaProd"
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
                path: 'chat',
                component: Chat,
                name: "Chat-Grosir",
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
                path: 'distribusicabai',
                component: TransaksiCabaiGrosir,
                name: "transaksicabaiGrosir"
            },
            {
                path: 'inventaris',
                component: InventarisGrosir,
                name: "InventarisGrosir"
            },
            {
                path: 'riwayatdistribusi',
                component: RiwayatTransaksiGrosir,
                name: 'riwayattransaksiGrosir'
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
                path: 'chat',
                component: Chat,
                name: "Chat-Pengecer",
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
                path: 'distribusicabai',
                component: TransaksiCabaiPengecer,
                name: "transaksicabaiPengecer"
            },
            {
                path: 'inventaris',
                component: InventarisPengecer,
                name: "InventarisPengecer"
            },
            {
                path: 'riwayatdistribusi',
                component: RiwayatTransaksiPengecer,
                name: 'riwayattransaksiPengecer'
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
                path: 'chat',
                component: Chat,
                name: "Chat-Pengepul",
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
                path: 'distribusicabai',
                component: TransaksiCabaiPengepul,
                name: "transaksicabaiPengepul"
            },
            {
                path: 'inventaris',
                component: InventarisPengepul,
                name: "InventarisPengepul"
            },
            {
                path: 'riwayatdistribusi',
                component: RiwayatTransaksiPengepul,
                name: 'riwayattransaksiPengepul'
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
                path: 'chat',
                component: Chat,
                name: "Chat-Konsumen",
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
            {
                path: 'distribusicabai',
                component: TransaksiCabaiKonsumen,
                name: "transaksicabaiKonsumen"
            },
            {
                path: 'riwayatdistribusi',
                component: RiwayatTransaksiKonsumen,
                name: 'riwayattransaksiKonsumen'
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
        path: '/harga',
        name: 'detailharga',
        component: BADetailHarga
    },
    {
        path: '/produksi',
        name: 'detailproduksi',
        component: BADetailProduksi
    },
    {
        path: '/produktivitas',
        name: 'detailproduktivitas',
        component: BADetailProduktivitas
    },
    
    {
        path: '/stok',
        name: 'detailstok',
        component: BADetailStok
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
    {
        path: '/gagalvalidasi',
        name: 'gagalvalidasi',
        component: FailedValidation,
        meta: {
            auth: true,
            requiresVerified: true,
        }
    },
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
                    window.localStorage.setItem("namauser", response.data.data.name)
                    window.localStorage.setItem("role", response.data.data.role)
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
