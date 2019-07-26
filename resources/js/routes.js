import VueRouter from 'vue-router'

let routes=[
{
        path:'/',
        components:require('./components/dashboard')
},
{
        path:'/mahasiswa',
        components:require('./components/mahasiswa')
},
{
        path:'/dosen',
        components:require('./components/dosen')
},
{
        path:'/matakuliah',
        components:require('./components/matakuliah')
},
{
        path:'/prodi',
        components:require('./components/prodi')
}
]

export default new VueRouter({
        routes,
        mode: 'history'
})