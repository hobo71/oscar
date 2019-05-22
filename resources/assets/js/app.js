/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import VueRouter from 'vue-router'
import VueAxios from 'vue-axios'
import axios from 'axios'

import "./bootstrap"


window.Vue = require("vue");

Vue.use(VueRouter)
Vue.use(VueAxios, axios)

axios.defaults.baseURL = '/api/'
axios.defaults.headers = {'Access-Control-Allow-Origin': '*'}

Vue.prototype._appApi =  document.head.querySelector('meta[name="app-api"]').content;

Vue.component("LayoutNavbar", require("./components/Layout/Navbar.vue"));
Vue.component("LayoutSidebar", require("./components/Layout/Sidebar.vue"));


const SearchResults = Vue.component("SearchResults", require("./components/Search/Results.vue"));

const ServicesIndex = Vue.component("ServicesIndex", require("./components/Services/Index.vue"));
const EmpresasIndex = Vue.component("EmpresasIndex", require("./components/Empresas/Index.vue"));
const EmpresasShow = Vue.component("EmpresasShow", require("./components/Empresas/Show.vue"));

const ClientesShow = Vue.component("ClientesShow", require("./components/Clientes/Show.vue"));
const ClientesIndex = Vue.component("ClientesIndex", require("./components/Clientes/Index.vue"));

const VehiculosIndex = Vue.component("VehiculosIndex", require("./components/Vehiculos/Index.vue"));
const VehiculosShow = Vue.component("VehiculosShow", require("./components/Vehiculos/Show.vue"));
Vue.component("VehiculoPatente", require("./components/Vehiculos/Patente.vue"));

const AlquileresIndex = Vue.component("AlquileresIndex", require("./components/Alquileres/Index.vue"));
const AlquileresShow = Vue.component("AlquileresShow", require("./components/Alquileres/Show.vue"));
const AlquileresStats = Vue.component("AlquileresStats", require("./components/Alquileres/Stats.vue"));
const AlquileresAgenda = Vue.component("AlquileresAgenda", require("./components/Alquileres/Agenda.vue"));


Vue.component("AlquilerFechas", require("./components/Alquileres/Fechas.vue"));

Vue.component("BaseHeader", require("./components/Base/Header.vue"));
Vue.component("BaseSingleHeader", require("./components/Base/SingleHeader.vue") );
Vue.component("BaseLoader", require("./components/Base/Loader.vue"));
Vue.component("BaseTable", require("./components/Base/Table.vue"));
Vue.component("BaseSingleTable", require("./components/Base/SingleTable.vue"));
Vue.component("BaseGo", require("./components/Base/Go.vue"));
Vue.component("IdBadge", require("./components/Base/Id.vue"));



const routes = [
  { path: '/vehiculos', component: VehiculosIndex },
  { path: '/vehiculos/:id', component: VehiculosShow },
  { path: '/empresas', component: EmpresasIndex },
  { path: '/empresas/:id', component: EmpresasShow },
  { path: '/clientes', component: ClientesIndex },
  { path: '/clientes/:id', component: ClientesShow },
  { path: '/services', component: ServicesIndex },
  { path: '/alquileres', component: AlquileresIndex },
  { path: '/alquileres/:id', component: AlquileresShow },
  { path: '/stats', component: AlquileresStats },
  { path: '/', component: AlquileresAgenda },
  { path: '/agenda', component: AlquileresAgenda },
  { path: '/search', component: SearchResults , name: 'SearchResults', canReuse: false}
]

const router = new VueRouter({
  routes, // short for `routes: routes`
   canReuse: false
})


const app = new Vue({
  router,
  el: "#app"
});
