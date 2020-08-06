<template>
    <!-- REUSABLE COMPONENT FOR Distribusi -->
    <div>
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="form-inline">
                    <label class="mr-2">Menampilkan</label>
                    <select class="form-control" v-model="meta.per_page" @change="loadPerPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <label class="ml-2">data</label>
                </div>
            </div> 
            <div class="col-md-4 offset-md-4">
                <div class="form-inline float-right">
                    <label class="mr-2">Cari</label>
                    <input type="text" class="form-control" @input="search">
                </div>
            </div>
            <div class="col-md-12">
                <b-table responsive striped hover :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty>
                    <template v-slot:cell(jumlah_cabai)="row">
                        <div v-if="row"> {{ row.item.jumlah_cabai | filterAngkaRibuan}} Kg</div>
                    </template>
                    <template v-slot:cell(harga)="row">
                        <div v-if="row"> {{ row.item.harga | convertToRupiah }} </div>
                    </template>
                    <template v-slot:cell(tanggal_diterima)="row">
                        <div v-if="row"> {{ row.item.tanggal_diterima | dateFilter }} </div>
                    </template>
                    <template v-slot:cell(tanggal_pengiriman)="row">
                        <div v-if="row.item.tanggal_pengiriman!==null">{{ row.item.tanggal_pengiriman | dateFilter }}</div>
                        <div v-else>Belum ditetapkan</div>
                    </template>
                    <template v-slot:cell(AksiPelanggan)="row">
                        <div v-if="row.item.status_permintaan === 2">
                            <button type="button" class="btn btn-success btn-xs" @click="requestUlang(row)">
                                Permintaan ulang
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" @click="deleteDistribusi(row)">
                                Hapus
                            </button>
                        </div>
                        <div v-else-if="row.item.status_permintaan === 1">
                            <button type="button" class="btn btn-success btn-xs" @click="terimaPenawaranPemasok(row)">
                                Terima
                            </button>
                            <button type="button" class="btn btn-danger btn-xs" @click="tolakPenawaranPemasok(row)">
                                Tolak
                            </button>
                        </div>
                        <div v-else-if="row.item.status_permintaan === 3 && row.item.status_pengiriman === 1">
                            <button type="button" class="btn btn-success btn-xs" @click="cabaidiTerima(row)">
                                Sudah diterima?
                            </button>
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
                <p>Menampilkan {{ meta.form }} dari {{ meta.to }} dari keseluruhan {{ meta.total }} data</p>
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
        }
    },
    data(){
        return {
            sortBy: null,
            sortDesc: false,
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
        }
        
    }
}
</script>