<template>
  <div>

    <h4 class="text-muted" v-if="results">Resultados para <strong>{{ results.query }}</strong> </h4>
    <hr>
    <base-loader v-if="!results"></base-loader>
    <div v-else>
      <h6  class="text-warning">Clientes <span class="badge badge-light">{{ results.clientes.length}}</span> </h6>
      <table class="table table-borderless table-sm table-hover" v-if="results.clientes.length>0">
        <thead> <tr> <th>ID</th> <th>Cliente</th> <th>Alquileres</th> <th>DNI</th> <th>Email</th> <th class="d-print-none"></th> </tr> </thead>
        <tbody>
          <tr v-for="cliente in results.clientes" :key="cliente.id">
            <td> <id-badge :number-id="cliente.id"></id-badge> </td>
            <td>
              <cliente-badge size="sm" :id="cliente.id" :nombre="cliente.apellido + ', ' + cliente.nombre"></cliente-badge>
              <router-link v-if="cliente.empresa" :to="'/empresas/'+cliente.empresa_id" class="btn btn-sm btn-outline-warning border-0" >{{ cliente.empresa.nombre }}</router-link>
            </td>
            <td> <span class="badge badge-light text-muted px-2">{{ cliente.cantidad}}</span> </td>
            <td>{{ cliente.dni }}</td>
            <td> <a :href="'mailto:' + cliente.email" class="btn btn-sm btn-outline-primary border-0" >{{ cliente.email }}</a> </td>
            <td class="text-right d-print-none"> <base-go model="clientes" :id="cliente.id"></base-go> </td>
          </tr>
        </tbody>
      </table>

      <h6  class="mt-3 text-warning">Alquileres <span class="badge badge-light">{{ results.alquileres.length}}</span> </h6>
      <table class="table table-borderless table-sm table-hover" v-if="results.alquileres.length>0">
        <thead> <tr> <th>Número</th> <th>Estado</th> <th>Itinerario</th> <th>Cliente</th> <th>Vehículo</th> <th></th> </tr> </thead>
        <tbody>
          <tr v-for="alquiler in results.alquileres" :key="alquiler.id" :class="{'o-75 bg-light':moment(alquiler.fecha_devolucion).isSameOrBefore(moment())}" >
            <td> <id-badge :number-id="alquiler.id"></id-badge> </td>
            <td v-html="estado(moment(alquiler.fecha_entrega),moment(alquiler.fecha_devolucion))"></td>
            <td> <alquiler-fechas size="sm" :desde="alquiler.fecha_entrega" :hasta="alquiler.fecha_devolucion"></alquiler-fechas> </td>
            <td> <cliente-badge size="sm" :id="alquiler.cliente.id" :nombre="alquiler.cliente.apellido + ', ' + alquiler.cliente.nombre" ></cliente-badge> </td>
            <td> <vehiculo-badge size="sm" :vehiculo="alquiler.vehiculo"></vehiculo-badge> </td>
            <td class="text-right d-print-none"> <base-go model="alquileres" :id="alquiler.id"></base-go> </td>
          </tr>
        </tbody>
      </table>

      <h6  class="mt-3 text-warning">Empresas <span class="badge badge-light">{{ results.empresas.length}}</span> </h6>
      <table class="table table-borderless table-sm table-hover" v-if="results.empresas.length>0">
        <thead> <tr> <th>ID</th> <th>Empresa</th> <th>cuit</th> <th>Email</th> <th></th> </tr> </thead>
        <tbody>
          <tr v-for="empresa in results.empresas" :key="empresa.id">
            <td><id-badge :number-id="empresa.id"></id-badge></td>
            <td> <router-link :to="'/empresas/'+empresa.id"  class="btn btn-sm btn-outline-dark border-0"><i class="fa fa-briefcase mr-2"></i>  {{ empresa.nombre }} </router-link></td>
            <td>{{ empresa.cuit }}</td>
            <td><a :href="'mailto:' + empresa.email" class="btn btn-sm btn-outline-primary border-0">{{ empresa.email }}</a></td>
            <td class="text-right"><base-go model="empresas" :id="empresa.id"></base-go></td>
          </tr>
        </tbody>
      </table>

      <h6  class="mt-3 text-warning">Vehiculos <span class="badge badge-light">{{ results.vehiculos.length}}</span> </h6>
      <table class="table table-borderless table-sm table-hover" v-if="results.vehiculos.length>0">
      <thead> <tr> <th></th> <th>Patente</th>  <th>Modelo</th> <th>Ciudad</th> <th>Año</th> <th>Clase</th> <th class="d-print-none"></th> </tr> </thead>
      <tbody>
        <tr v-for="vehiculo in results.vehiculos" :key="vehiculo.id">
					<td><img :src="'uploads/vehiculos/' + vehiculo.foto" class="rounded img-fluid " width="110px"></td>
					<td> <vehiculo-patente size="sm" v-if="vehiculo" :patente="vehiculo.patente"></vehiculo-patente> </td>
          <td><strong>{{ vehiculo.modelo }}</strong></td>
          <td>{{ vehiculo.ciudad }}</td>
          <td>{{ vehiculo.anio }}</td>
          <td>{{ vehiculo.clase }}</td>
          <td  class="d-print-none text-right"><base-go model="vehiculos" :id="vehiculo.id"></base-go></td>
        </tr>
      </tbody>
      </table>

      <h6  class="mt-3 text-warning">Services <span class="badge badge-light">{{ results.services.length}}</span> </h6>
      <table class="table table-borderless table-sm table-hover" v-if="results.services.length>0">
      <thead> <tr> <th> Taller / Detalle </th> <th>Vehiculo</th> <th>Fecha / Vigencia</th> <th>Importe</th> <th class="d-print-none"></th> </tr> </thead>
      <tbody>
        <tr v-for="service in results.services" :key="service.id">
          <td width="40%"> {{ service.titulo }} <br> <small class="text-muted">{{ service.detalle }}</small> </td>
          <td> <vehiculo-badge size="sm" :vehiculo="service.vehiculo"></vehiculo-badge> </td>
          <td> {{ service.fecha }} <br> {{ service.vigencia }} </td>
          <td class="text-right"> <strong>${{ service.importe }}</strong> </td>
          <td class="text-right d-print-none"> <base-go model="services" :id="service.id"></base-go> </td>
        </tr>
      </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import ClienteBadge from "../Clientes/Badge";
import VehiculoBadge from "../Vehiculos/Badge";
import EmpresaBadge from "../Empresas/Badge";
import moment from 'moment';

export default {
  components: {
    ClienteBadge,
    VehiculoBadge,
    EmpresaBadge
  },
    data(){
        return {
          moment : moment,
          results: null
        }
    },
    
    created() {
      this.getResults(this.$route.params.query)
      this.$root.$on('newSearch',(val) => {
          this.getResults(val)
      })
    },
    methods: {
      getResults(val){
        console.log('trying to get new results... ')
        axios.get(this._appApi+'search/'+val)
            .then( response => {
              console.log('trying response... ' ,  response)
                this.results = response.data                
            })
            .catch(e=>{ console.log(e) })
      },
      estado(start, end) {
        if (moment().isBetween(start, end.add(1, "day"))) {
          return '<span class="badge badge-warning">ACTUAL</span>';
        } else if (start.isSameOrAfter()) {
          return '<span class="badge badge-success">PROXIMO</span>';
        } else if (end.isSameOrBefore()) {
          return '<span class="badge bg-white">TERMINADO</span>';
        }
      },
      
    },
};
</script>

<style>
</style>
