<template>
  <div id="notfound">
    <div class="notfound-bg"></div>
    <div class="notfound">
      <div class="notfound-404">
        <h1>BELUM DIVALIDASI</h1>
      </div>
      <h2>Akun Anda belum divalidasi</h2>
      <h3>Mohon tunggu beberapa hari untuk proses validasi oleh admin</h3>
      <div class="row">
        <div class="col">
          <a href="#">Back To Homepage</a>
        </div>
        <div class="col">
          <a href @click.prevent="$auth.logout();clearLocalStorage()">Logout</a>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
* {
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

body {
  padding: 0;
  margin: 0;
}

#notfound {
  position: relative;
  height: 100vh;
}

#notfound .notfound-bg {
  position: absolute;
  width: 100%;
  height: 100%;
  background-image: url("/dist/img/cabai.jpg");
  background-size: cover;
}

#notfound .notfound-bg:after {
  content: "";
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.25);
}

#notfound .notfound {
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}

#notfound .notfound:after {
  content: "";
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  width: 100%;
  height: 600px;
  background-color: rgba(255, 255, 255, 0.7);
  -webkit-box-shadow: 0px 0px 0px 30px rgba(255, 255, 255, 0.7) inset;
  box-shadow: 0px 0px 0px 30px rgba(255, 255, 255, 0.7) inset;
  z-index: -1;
}

.notfound {
  max-width: 600px;
  width: 100%;
  text-align: center;
  padding: 30px;
  line-height: 1.4;
}

.notfound .notfound-404 {
  position: relative;
  height: 200px;
}

.notfound .notfound-404 h1 {
  font-family: "Muli", sans-serif;
  position: absolute;
  left: 50%;
  top: 50%;
  -webkit-transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
  font-size: 50px;
  margin: 0px;
  color: #222225;
  text-transform: uppercase;
}

.notfound h2 {
  font-family: "Muli", sans-serif;
  font-size: 26px;
  font-weight: 400;
  /* text-transform: uppercase; */
  color: #222225;
  margin-top: 26px;
  margin-bottom: 20px;
}

.notfound h3 {
  font-family: "Muli", sans-serif;
  font-size: 15px;
  font-weight: 400;
  /* text-transform: uppercase; */
  color: #222225;
  margin-top: 26px;
  margin-bottom: 20px;
}

.notfound a {
  font-family: "Muli", sans-serif;
  display: inline-block;
  font-weight: 400;
  text-decoration: none;
  background-color: transparent;
  color: #222225;
  text-transform: uppercase;
  font-size: 14px;
}

@media only screen and (max-width: 480px) {
  .notfound .notfound-404 {
    height: 146px;
  }

  .notfound .notfound-404 h1 {
    font-size: 146px;
  }

  .notfound h2 {
    font-size: 22px;
  }
}
</style>
<script>
export default {
  methods: {
    clearLocalStorage() {
      localStorage.clear();
    }
  }
};
</script>