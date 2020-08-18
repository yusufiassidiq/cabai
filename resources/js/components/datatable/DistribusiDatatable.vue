<template>
    <!-- REUSABLE COMPONENT FOR Distribusi -->
    <div>
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="form-inline">
                    <label class="mr-2">Showing</label>
                    <select class="form-control" v-model="meta.per_page" @change="loadPerPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="ml-2">Entries</label>
                </div>
            </div> 
            <div class="col-md-4 offset-md-4">
                <div class="form-inline float-right">
                    <label class="mr-2">Cari</label>
                    <input type="text" class="form-control" @input="search">
                </div> 
                
            </div>
            <br>
            <div class="col-md-4 offset-md-8">
                <div class="form-inline float-right">
                    <label class="mr-2">Satuan cabai</label>
                    <select class="form-control" v-model="satuan" @change="ubahsatuan">
                        <option value="Kg" selected>Kg</option>
                        <option value="Kw">Kwintal</option>
                        <option value="Ton">Ton</option>
                    </select>
                    <label class="ml-2"> </label>
                </div>
            </div>
        </div> 
            <div class="col-md-12">
                <b-table responsive striped hover :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty>
                    <template v-slot:cell(tanggal_diterima)="row">
                        <div v-if="row"> {{ row.item.tanggal_diterima | dateFilter }} </div>
                    </template>
                    <template v-slot:cell(jumlah_cabai)="row">
                        <div v-if="row"> {{ row.item.jumlah_cabai | filterAngkaRibuan}} Kg</div>
                    </template>
                    <template v-slot:cell(tanggal_pengiriman)="row">
                        <div v-if="row.item.tanggal_pengiriman!==null">{{ row.item.tanggal_pengiriman | dateFilter }}</div>
                        <div v-else>Belum ditetapkan</div>
                    </template>
                    <template v-slot:cell(AksiPelanggan)="row">
                        <div v-if="row.item.status_permintaan === 2">
                            <b-button variant="success" size="sm" @click="requestUlang(row)"> Permintaan ulang </b-button>
                            <b-button variant="danger" size="sm" @click="deleteDistribusi(row)"> Hapus </b-button>
                        </div>
                        <div v-else-if="row.item.status_permintaan === 1">
                            <b-button variant="success" size="sm" @click="terimaPenawaranPemasok(row)"> Terima </b-button>
                            <b-button variant="danger" size="sm" @click="tolakPenawaranPemasok(row)"> Tolak </b-button>
                        </div>
                        <div v-else-if="row.item.status_permintaan === 3 && row.item.status_pengiriman === 1">
                            <b-button variant="success" size="sm" @click="cabaidiTerima(row)">  Terima </b-button>
                        </div>
                        <div v-else>-</div>
                    </template>
                    <template v-slot:cell(AksiPemasok)="row">
                        <div v-if="row.item.status_permintaan === 0">
                            <b-button variant="success" size="sm" @click="terimaPermintaanPelanggan(row)"> Terima </b-button>
                            <b-button variant="danger" size="sm" @click="tolakPermintaanPelanggan(row)"> Tolak </b-button>
                        </div>
                        <div v-else-if="row.item.status_permintaan === 3 && row.item.status_pengiriman===0">
                            <b-button variant="success" size="sm" @click="kirimCabai(row)"> Kirim Pesanan </b-button>
                        </div>
                        <div v-else>-</div>
                    </template>
                    <template v-slot:cell(status)="row">
                        <div v-if="row.item.status_permintaan === 0">Menunggu penawaran pemasok</div>
                        <div class="red" v-else-if="row.item.status_permintaan === 2">Permintaan Anda ditolak</div>
                        <div v-else-if="row.item.status_permintaan === 4">Anda menolak penawaran</div>
                        <div v-else-if="row.item.status_permintaan === 3">Menunggu Pengiriman</div>
                        <div v-else-if="row.item.status_permintaan === 1">Menunggu persetujuan Anda</div>
                    </template>
                    <template v-slot:cell(statusPemasok)="row">
                        <div class="orange" v-if="row.item.status_permintaan === 0">Belum ditanggapi</div>
                        <div v-else-if="row.item.status_permintaan === 1">Menunggu persetujuan pelanggan</div>
                        <div class="red" v-else-if="row.item.status_permintaan === 4">Penawaran anda ditolak</div>
                        <div class="green" v-else-if="row.item.status_permintaan === 3 && row.item.status_pengiriman===0">Penawaran anda diterima</div>
                        <div v-else-if="row.item.status_permintaan === 3 && row.item.status_pengiriman===1">Dalam Pengiriman</div>
                        <div class="red" v-else-if="row.item.status_permintaan === 2">Permintaan ditolak</div>
                    </template>
                    <template v-slot:cell(harga)="row">
                        <div v-if="row.item.harga!==null">{{row.item.harga | convertToRupiah }}</div>
                        <div v-else>Belum ditetapkan</div>
                    </template>
                    <template v-slot:cell(role)="row">
                        {{ row.item.role | filterRoleUser}}
                    </template>
                    <template v-slot:cell(keterangan)="row">
                        <div v-if="row.item.status_permintaan === 2">{{ row.item.keterangan }}</div>
                        <div v-else>-</div>
                    </template>
                    <template v-slot:cell(lokasi.kabupaten)="row">
                        {{ row.item.lokasi.kabupaten | filterAlamat}}
                    </template>
                </b-table>
            </div>
            <div class="col-md-6">
                Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} items
            </div>
            <div class="col-md-6">
                <b-pagination
                    v-model="meta.current_page"
                    :total-rows="meta.total"
                    :per-page="meta.per_page"
                    align="right"
                    @change="changePage"
                    aria-controls="dw-datatable"
                ></b-pagination>
            </div>
            <!-- start modal -->
            <!-- end modal -->
        </div>
    </div>
</template>

<script>
import _ from 'lodash'
export default {
    props:{
        items: {
            type: Array,
            required: true
        },
        fields: {
            type: Array,
            required: true
        },
        meta: {
            required: true
        },
    },
    data(){
        return {
            sortBy: null,
            sortDesc: false,
            satuan: 'Kg'
        }
    },
    watch: {
        sortBy(val) {
            this.$emit('sort', {
                sortBy: this.sortBy,
                sortDesc: this.sortDesc
            })
        },
        sortDesc(val) {
            this.$emit('sort', {
                sortBy: this.sortBy,
                sortDesc: this.sortDesc
            })
        }
    },
    methods:{
        loadPerPage(val) {
            this.$emit('per_page', this.meta.per_page)
        },
        changePage(val) {
            this.$emit('pagination', val)
        },
        search: _.debounce(function (e) {
            this.$emit('search', e.target.value)
        }, 500),
        terimaPenawaranPemasok(row){
            this.$emit('terimaPenawaranPemasok', row.item)
        },
        tolakPenawaranPemasok(row){
            this.$emit('tolakPenawaranPemasok', row.item)
        },
        cabaidiTerima(row){
            this.$emit('cabaidiTerima', row.item)
        },
        deleteDistribusi(row){
            this.$emit('deleteDistribusi', row.item.id)
        },
        requestUlang(row){
            this.$emit('requestUlang', row.item)
        },
        terimaPermintaanPelanggan(row){
            this.$emit('terimaPermintaanPelanggan', row.item)
        },
        tolakPermintaanPelanggan(row){
            this.$emit('tolakPermintaanPelanggan', row.item)
        },
        kirimCabai(row){
            this.$emit('kirimCabai', row.item)
        },
        ubahsatuan(){
            // belum ada yg terjadi, perlu pengembangan
            // jadi nanti pas ini terjadu, satuan dlm jumlah cabai sama harga cabai dibagi/ dikali sesuai satuan
            this.$emit('ubahsatuan', this.satuan)
        }
    }
}
</script>