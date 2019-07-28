<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="container" v-if="!$auth.check()">
        <div class="navbar-nav">
          <router-link to="/Home" tag="li"> <a class="nav-item nav-link ml-5"><i class="fas fa-home"></i> Home</a></router-link>

          <router-link to="/vMahasiswa" tag="li"> <a class="nav-item nav-link ml-5"><i class="fas fa-user-graduate"></i> Mahasiswa</a></router-link>

         <router-link to="/vDosen" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-chalkboard-teacher"></i> Dosen</a></router-link>

         <router-link to="/vMatakuliah" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-book"></i> Matakuliah</a></router-link>

         <router-link to="/vProdi" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-book"></i> Program Studi</a></router-link>

       </div>

     </div>
       <ul class="navbar-nav ml-auto" v-if="!$auth.check()">
          <li class="nav-item" v-for="(route, key) in routes.unlogged" v-bind:key="route.path">
            <router-link :to="{ name : route.path }" :key="key" class="nav-link"><i class="fas fa-sign-in-alt"></i> {{route.name}}</router-link>
          </li>
      </ul>
     <div class="container" v-if="$auth.check()">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">


          <router-link to="/" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-home"></i> Dashboard</a></router-link>

          <router-link to="/Mahasiswa" tag="li"> <a class="nav-item nav-link ml-5"><i class="fas fa-user-graduate"></i> Mahasiswa</a></router-link>

          <router-link to="/Dosen" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-chalkboard-teacher"></i> Dosen</a></router-link>

          <router-link to="/Matakuliah" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-book"></i> Matakuliah</a></router-link>

          <router-link to="/Prodi" tag="li"><a class="nav-item nav-link ml-5"><i class="fas fa-book"></i> Program Studi</a></router-link>

        </div>
      </div>
    </div>
    <ul class="navbar-nav ml-auto" v-if="$auth.check()">

      <li class="nav-item">
        <a class="nav-link" href="#" @click.prevent="$auth.logout()"><i class="fas fa-sign-out-alt"></i> Logout</a>
      </li>
    </ul>
  </div>
</nav>
</template>
<script>
  export default {
    data() {
      return {
        routes: {
          // UNLOGGED
          unlogged: [

          { name: 'Login', path: 'login'}
          ],
          // LOGGED USER

        }
      }
    },
    mounted() {
      //
    }
  }
</script>
<style>
.navbar {
  margin-bottom: 30px;
}
</style>