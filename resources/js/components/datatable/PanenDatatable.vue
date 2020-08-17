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
            <div class="col-md-12">
                <b-table responsive striped hover :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty>
                    <template v-slot:cell(tanggal_panen)="row">
                        {{ row.item.tanggal_panen | dateFilter}}
                    </template>
                    <template v-slot:cell(jumlah_panen)="row">
                        {{ row.item.jumlah_panen}} Kg
                    </template>
                    <template v-slot:cell(action)="row">
                        <a href="#" @click="editLahan(row)">
                            <i class="fas fa-edit orange text-warning"></i>
                        </a>
                        /
                        <a href="#" @click="deleteLahan(row)">
                            <i class="fas fa-trash red"></i>
                        </a>
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
        }
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
        editLahan(row){
            this.$emit('editPanen', row.item)
        },
        deleteLahan(row){
            this.$emit('hapusPanen', row.item.id)
        },
        ubahsatuan(){
            // belum ada yg terjadi, perlu pengembangan
            // jadi nanti pas ini terjadu, satuan dlm jumlah cabai sama harga cabai dibagi/ dikali sesuai satuan
            this.$emit('ubahsatuan', this.satuan)
        }
    }
}
</script>