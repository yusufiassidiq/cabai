<template>
    <!-- REUSABLE COMPONENT for user management and user validation -->
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
                <label class="mr-2">Search</label>
                <input type="text" class="form-control" @input="search">
            </div>
        </div>
        <div class="col-md-12">
            <b-table responsive striped hover :items="items" :fields="fields" :sort-by.sync="sortBy" :sort-desc.sync="sortDesc" show-empty >
                <!-- untuk Manajemen akun -->
                <template v-slot:cell(managementUserAction)="row">
                    <a href="#">
                        <i class="fas fa-edit orange" v-on:click="openEditModal(row)"></i>
                    </a>
                    /
                    <a href="#" v-on:click="deleteUser(row)">
                        <i class="fas fa-trash red"></i>
                    </a>
                </template>

                <!-- Untuk validasi akun -->
                <template v-slot:cell(validatedUserAction)="row">
                    <!-- <button class="btn btn-success btn-xs" v-on:click="terima(row)">Terima</button> -->
                    <b-col lg="6" class="pb-2">
                        <b-button variant="success" size="sm" @click="terima(row)">
                            Terima
                        </b-button>
                        <b-button variant="danger" size="sm" @click="tolak(row)">
                            Tolak
                        </b-button>
                    </b-col>
                    <!-- <b-col lg="3" class="pb-2"></b-col> -->
                    <!-- <button class="btn btn-danger btn-xs" v-on:click="tolak(row)">Tolak</button> -->
                </template>
                
                <!-- untuk SIUP -->
                <template v-slot:cell(siup)="row">
                    <b-col lg="8" class="pb-2"><b-button variant="info" size="sm" @click="openSiupModal(row)">
                        <i class="fas fa-eye"></i>&nbsp; Lihat
                    </b-button></b-col>
                </template>
                
                <!-- untuk Role user -->
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
        },
        // fungsi untuk menolak registrasi akun
        tolak(row) {
            swal
            .fire({
                title: "Apakah kamu yakin?",
                text: "User akan ditolak",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            })
            .then(result => {
                if (result.value) {
                    this.$Progress.start();
                    axios.put("/user/tolak/" + row.item.id)
                    .then(() => {
                        swal.fire("Terhapus!", "User berhasil dihapus", "success");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        swal.fire( "Gagal!", "Terdapat masalah ketika menghapus", "waning");
                        this.$Progress.fail();
                    });
                }
            });
        },
        // fungsi untuk menyetujui registrasi akun
        terima(row) {
            swal
            .fire({
                title: "Apakah kamu yakin?",
                text: "User akan diterima",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes"
            })
            .then(result => {
                if (result.value) {
                    this.$Progress.start();
                    axios.put("/user/terima/" + row.item.id)
                    .then(() => {
                        swal.fire("Diterima!", "User berhasil diterima", "success");
                        this.$Progress.finish();
                    })
                    .catch(() => {
                        swal.fire( "Gagal!", "Terdapat masalah ketika menerima", "waning");
                        this.$Progress.fail();
                    });
                }
            });  
        },
    }
}
</script>