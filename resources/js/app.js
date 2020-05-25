import './bootstrap'
import auth from './auth'
import router from './router'

// import dependecies tambahan
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import axios from 'axios';
import Vue from 'vue';
import 'es6-promise/auto'
import VueAuth from '@websanova/vue-auth'

// Set Vue globally
window.Vue = require('vue');

// import vform library create these global variable
// Doc = https://github.com/cretueusebiu/vform
import {
    Form,
    HasError,
    AlertError
} from 'vform'
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
window.Form = Form;

// import progress bar library
// Doc = https://github.com/hilongjw/vue-progressbar
import VueProgressBar from 'vue-progressbar'
const options = {
    color: '#8BC44A',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'top',
    inverse: false
}
Vue.use(VueProgressBar, options)

// Import Sweet Alert Library
// Doc = https://sweetalert2.github.io/
// import Swal from 'sweetalert2'
import Swal from 'sweetalert2'
window.swal = Swal
const toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    onOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
})
window.toast = toast

// Set Vue router
Vue.router = router
Vue.use(VueRouter)

// filter string supaya char selain firstchar lowercase
Vue.filter('filterAlamat', function (value) {
    if (!value) return ''

    var firstChar = value.charAt(0)
    value = value.toString().toLowerCase()
    return firstChar + value.substring(1, value.length)

})

// filter tanggal supaya DDMMYYYY
Vue.filter('dateFilter', function (value) {
    let m
    m = moment(value, 'YYYY-MM-DD')
    return m.format('DD/MM/YYYY')
})

// filter convert angka ke rupiah
Vue.filter('convertToRupiah', function (angka) {
        var rupiah = "";
        var angkarev = angka.toString().split("").reverse().join("");
        
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) rupiah += angkarev.substr(i, 3) + ".";
        return (
            "Rp " + rupiah.split("", rupiah.length - 1).reverse().join("")
        );
})

// filter mengubah angka menjadi ribuan
Vue.filter('filterAngkaRibuan', function (value) {
    var angka = "";
    var angkarev = value.toString().split("").reverse().join("");
    for (var i = 0; i < angkarev.length; i++)
        if (i % 3 == 0) angka += angkarev.substr(i, 3) + ".";
    return (
        angka.split("", angka.length - 1).reverse().join("")
    );
})

// Vue.filter('classFlag', function (value) {
//     var flag= value;
//     return(flag);
// })

// filter mendapatkan Jenis Role
Vue.filter('filterRoleUser', function(id_role){
    switch (id_role) {
        case 2:
        return "Produsen";
        break;
        case 3:
        return "Pengepul";
        break;
        case 4:
        return "Grosir";
        break;
        case 5:
        return "Pengecer";
        break;
        default:
        return "Konsumen";
    }
})

// filter convert angka ke rupiah
Vue.filter('angkaPersentase', function (angka) {
    if(typeof angka !=='string'){
        var angka = angka;
        if (angka<0) 
            return( angka * -1 + "%");
        else 
            return( angka + "%");
    }
    else
        return(angka);
})

Vue.filter('filterRealisasiTarget', function (value) {
    if(typeof value !=='string'){
        var angka = "";
        var angkarev = value.toString().split("").reverse().join("");
        for (var i = 0; i < angkarev.length; i++)
            if (i % 3 == 0) angka += angkarev.substr(i, 3) + ".";
        return (
            angka.split("", angka.length - 1).reverse().join("") + " Kg"
        );
    }
    else
        return(value);
})

Vue.filter('filterGapTarget', function (value) {
    if(typeof value !=='string'){
        if(value > 0){
            var angka = "";
            var angkarev = value.toString().split("").reverse().join("");
            for (var i = 0; i < angkarev.length; i++)
                if (i % 3 == 0) angka += angkarev.substr(i, 3) + ".";
            return (
                "Kurang " + angka.split("", angka.length - 1).reverse().join("") + " Kg"
            );
        }
        else 
            return "Tercapai"
    }
    else
        return (value);
})


// Set Vue authentication
Vue.use(VueAxios, axios)
if(`${process.env.APP_ENV}` === 'local')
        {
            axios.defaults.baseURL = `${process.env.MIX_APP_URL}/api`
        }
        else{
            axios.defaults.baseURL = `/api`
        }
// console.log(process.env.MIX_APP_URL)
Vue.use(VueAuth, auth)

// Create new vue instance with name Update data, for custom event
let UpdateData = new Vue();
window.UpdateData = UpdateData;

const app = new Vue({
    el: '#app',
    router,
});
