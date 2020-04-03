<template>
  <section class="content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Permintaan Mitra</h3>

              <div class="card-tools">
                <div class="input-group input-group-sm" style="width: 150px;">
                  <input
                    type="text"
                    name="table_search"
                    class="form-control float-right"
                    placeholder="Search"
                  />
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-default">
                      <i class="fas fa-search"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>Id</th>
                    <th>Nama</th>
                    <th>Role</th>
                    <th>Lokasi</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  <tr v-for="data in dataMitra" :key="data.id">
                    <td>{{ data.id }}</td>
                    <td>{{ data.name }}</td>
                    <td>{{ data.role }}</td>
                    <td>{{ data.lokasi }}</td>
                    <td>
                      <button
                        type="button"
                        class="btn btn-success"
                        @click="terimaMitra(data.id)"
                      >Terima</button>
                      <button
                        type="button"
                        class="btn btn-danger"
                        @click="tolakMitra(data.id)"
                      >Tolak</button>
                    </td>
                    <!-- end example data -->
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      dataMitra: {},
      // isLoading: false, // vuebutton spinner
      // status: "", // vuebutton spinner
      form: new Form({
        id: "",
        name: "",
        role: "",
        lokasi: ""
      })
    };
  },
  methods: {
    // Mendapatkan data Permintaan Mitra
    getMitra() {
      console.log("data berhasil didapatkan");
      var url =
        "https://5e844114a8fdea00164ac49e.mockapi.io/api/permintaanmitra";
      axios.get(url).then(response => {
        this.dataMitra = response.data;
      });
    },
    // menerima pembentukan mitra
    terimaMitra(id) {
      console.log("data berhasil diterima");
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text: "",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, Terima!"
        })
        .then(result => {
          if (result.value) {
            // send request to the server

            UpdateData.$emit("update");
            swal.fire("Permintaan diterima", "Kemitraan terbentuk", "success");
          }
        });
    },
    // menolak pembentukan mitra
    tolakMitra(id) {
      console.log("data berhasil ditolak");
      var url =
        "https://5e844114a8fdea00164ac49e.mockapi.io/api/permintaanmitra";
      swal
        .fire({
          title: "Apakah kamu yakin?",
          text:
            "Mitra yang ditolak perlu mengajukan permintaan ulang untuk bermitra",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Ya, Tolak!"
        })
        .then(result => {
          if (result.value) {
            // send request to the server
            axios
              .delete(url + "/" + id)
              .then(() => {
                UpdateData.$emit("update");
                swal.fire(
                  "Permintaan ditolak",
                  "Mitra tidak terbentuk",
                  "success"
                );
              })
              .catch(() => {
                swal.fire("Gagal!", "Terdapat masalah", "waning");
              });
          }
        });
    }
  },
  created() {
    this.getMitra();
  },
  mounted() {
    // Custom event on Vue js
    UpdateData.$on("update", () => {
      this.getMitra();
    });
  }
};
</script>