<template>
    <!-- REUSABLE COMPONENT FOR Kemitraan -->
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
                    <!-- Untuk validasi akun -->
                    <template v-slot:cell(aksiKelolaMitra)="row">
                        <button class="btn btn-danger btn-xs" @click="deleteMitra(row)">Hapus</button>
                    </template>
                    <template v-slot:cell(aksiTambahMitra)="row">
                        <a href="#" class="btn btn-success btn-xs" @click="tambahMitra(row)">
                            <i class="fas fa-plus-square white"></i>
                            Tambah
                        </a>
                    </template>
                    <template v-slot:cell(role)="row">
                        <div v-if="row.item.role == 2"> Produsen </div>
                        <div v-else-if="row.item.role == 3"> Pengepul </div>
                        <div v-else-if="row.item.role == 4"> Grosir </div>
                        <div v-else-if="row.item.role == 5"> Pengecer </div>
                        <div v-else> Konsumen </div>
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
        deleteMitra(row){
            this.$emit('deleteMitraKu', row.item.id)
        },
        tambahMitra(row){
            this.$emit('tambahMitraKu', row.item.id)
        }

    }
}
</script>