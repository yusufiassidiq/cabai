<template>
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
            <b-table responsive striped hover :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty >
                <template v-slot:cell(actions)="row">
                    <!-- <a :href="editUrl" v-if="editUrl" class="btn btn-warning btn-sm">Edit</a>
                    <button class="btn btn-danger btn-sm" @click="openDeleteModal(row)">Delete</button> -->
                    <a href="#">
                        <i class="fas fa-edit blue" v-on:click="openEditModal(row)"></i>
                    </a>
                    /
                    <a href="#" v-on:click="deleteUser(row)">
                        <i class="fas fa-trash red"></i>
                    </a>
                </template>
                <template v-slot:cell(siup)="row">
                    <button class="btn btn-info btn-xs" @click="openSiupModal(row)">
                        <i class="fas fa-eye"></i>&nbsp; Lihat
                    </button>
                </template>
                <!-- <template v-slot:cell(filteredRole)="row">
                    <div v-if="row.item.role == 2"> Produsen </div>
                    <div v-else>
                        HAHA
                    </div>
                </template> -->
            </b-table>   
        </div>
        <div class="col-md-6">
            <p>Showing {{ meta.from }} to {{ meta.to }} of {{ meta.total }} items</p>
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
        
        <b-modal v-model="siupModal" hide-footer>
            <template v-slot:modal-title>
                Gambar SIUP
            </template>
            <img :src="getphoto()" class="img-responsive" />
        </b-modal>

        <b-modal v-model="editModal" hide-footer>
            <template v-slot:modal-title>
                Edit user
            </template>
            <form @submit.prevent="updateUser()">
            <div class="modal-body">
              <div class="form-group">
                <select class="form-control" placeholder="status">
                  <option value disabled selected>Select status</option>
                  <option value="1">Aktif</option>
                  <option value="0">Non-aktif</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
          </form>
        </b-modal>
    </div>
</template>
<style scoped>
img {
  width: 100%;
  height: 100%;
  object-fit: contain;
}
</style>
<script>
import _ from 'lodash'
export default {
    props: {
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
        title: {
            type: String,
            default: "Delete Modal"
        },
        editUrl: {
            type: String,
            default: null
        },
    },
    data() {
        return {
            sortBy: null,
            sortDesc: false,
            deleteModal: false,
            siupModal:false,
            selected: null,
            editModal: false,
            selectedUser: null
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
    methods: {
        loadPerPage(val) {
            this.$emit('per_page', this.meta.per_page)
        },
        changePage(val) {
            this.$emit('pagination', val)
        },
        search: _.debounce(function (e) {
            this.$emit('search', e.target.value)
        }, 500),
        openSiupModal(row){
            this.siupModal = true
            this.selected = row.item.fotosk
        },
        getphoto() {
            return "/images/" + this.selected;
        },
        deleteUser(row) {
            swal.fire({
                title: "Apakah kamu yakin?",
                text: "User dihapus tidak dapat dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, hapus!"
            })
            .then(result => {
            if (result.value) {
                this.$Progress.start();
                axios.delete("/user/delete/" + row.item.id).then(() => {
                    swal.fire("Terhapus!", "User berhasil dihapus", "success");
                    UpdateData.$emit("UserManagement");
                    this.$Progress.finish();
                })
                .catch(() => {
                    swal.fire( "Gagal!", "Terdapat masalah ketika menghapus", "waning");
                    this.$Progress.fail();
                });
            }
            });
        },
        openEditModal(row){
            this.editModal = true
            this.selectedUser = row.item.id
            console.log(this.selectedUser)
        },
        updateUser(row){
            console.log("user with id " + this.selectedUser + " updated")
        }
    }
}
</script>