<template>
    <!-- REUSABLE COMPONENT -->
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
                    <template v-slot:cell(created_at)="row">
                        {{ row.item.created_at | dateFilter}}
                    </template>
                    <template v-slot:cell(jumlah_pengeluaran)="row">
                        {{ row.item.jumlah_pengeluaran | convertToRupiah}}
                    </template>
                    <template v-slot:cell(action)="row">
                        <a href="#" @click="editPengeluaran(row)">
                            <i class="fas fa-edit orange"></i>
                        </a>
                        /
                        <a href="#" @click="deletePengeluaran(row)">
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
        editPengeluaran(row){
            this.$emit('editPengeluaran', row.item)
        },
        deletePengeluaran(row){
            this.$emit('hapusPengeluaran', row.item.id)
        }
    }
}
</script>