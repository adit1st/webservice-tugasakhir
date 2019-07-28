
import VueRouter from 'vue-router'
// Pages


import Login from './pages/Login'
import Home from './pages/Home'
import vMahasiswa from './pages/vMahasiswa'
import vDosen from './pages/vDosen'
import vMatakuliah from './pages/vMatakuliah'
import vProdi from './pages/vProdi'
import Dashboard from './pages/user/Dashboard'
import Mahasiswa from './pages/user/Mahasiswa'
import Dosen from './pages/user/Dosen'
import Matakuliah from './pages/user/Matakuliah'
import Prodi from './pages/user/Prodi'

// Routes
const routes = [
{
    path: '/home',
    name: 'home',
    component: Home,
    meta: {
      auth: false
}
},
{
    path: '/vmahasiswa',
    name: 'vmahasiswa',
    component: vMahasiswa,
    meta: {
      auth: false
}
},
{
    path: '/vdosen',
    name: 'vdosen',
    component: vDosen,
    meta: {
      auth: false
}
},
{
    path: '/vmatakuliah',
    name: 'vmatakuliah',
    component: vMatakuliah,
    meta: {
      auth: false
}
},
{
    path: '/vprodi',
    name: 'vprodi',
    component: vProdi,
    meta: {
      auth: false
}
},
{
    path: '/login',
    name: 'login',
    component: Login,
    meta: {
      auth: false
}
},
  // USER ROUTES
  {
    path: '/',
    name: 'dashboard',
    component: Dashboard,
    meta: {
      auth: true
}
},
{
    path: '/mahasiswa',
    name: 'mahasiswa',
    component: Mahasiswa,
    meta: {
      auth: true
}
},
{
    path: '/dosen',
    name: 'dosen',
    component: Dosen,
    meta: {
        auth: true
}
},
{
    path: '/matakuliah',
    name: 'matakuliah',
    component: Matakuliah,
    meta: {
        auth: true
}
},
{
    path: '/prodi',
    name: 'prodi',
    component: Prodi,
    meta: {
          auth: true
  }
},
]
const router = new VueRouter({
  history: true,
  mode: 'history',
  routes,
})
export default router