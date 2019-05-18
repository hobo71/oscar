<template>
    <div>
    	<base-loader v-if="!empresa"></base-loader>
      <div class="d-flex justify-content-between" v-else>
        <empresa-edit :empresa-data="empresa"></empresa-edit>
        <div class=" w-25 mt-3">
        	<base-back></base-back>
            <div   class="p-1 text-left btn  btn-outline-dark border-0 btn-lg">
		        <i class="fa fa-briefcase fa-fw mr-2"></i>{{ empresa.nombre }}
		    </div>
            <hr>
             <dl class=" ">
                <dt>Cuit</dt>
                <dd>{{ empresa.cuit || '' }}</dd>
                <dt>Telefono</dt>
                <dd>{{ empresa.celular || empresa.telefono || '' }}</dd>
                <dt>Email</dt>
                <dd>{{ empresa.email || '' }}</dd>
                <dt>Domicilio</dt>
                <dd>{{ empresa.domicilio ||  '' }}</dd>
            </dl>

            <hr>         
            <h6>Empleados: </h6 >


            <div class="d-flex justify-content-around  flex-wrap">
              <!-- <div v-for="cliente in empresa.cliente" :key="cliente.id">
                <cliente-badge :id="cliente.id" :nombre="cliente.apellido + ', ' + cliente.nombre"></cliente-badge> 
              </div> -->
              <router-link :to="'/clientes/' + cliente.id" class="btn-cliente text-center btn btn-sm btn-outline-default border-0 mx-1 my-2 " v-for="cliente in empresa.cliente" :key="cliente.id" style="width:40%;">
              <i class="m-2 fa fa-user-circle fa-fw mr-2 fa-2x text-warning" ></i><br>{{ cliente.nombre  + ' ' + cliente.apellido}}
              </router-link>
                  
          </div>

           <div class="alert alert-warning mt-4" v-if="empresa.observaciones">
            <h6>Observaciones</h6>
            <p class="text-muted white-space-pre">{{ empresa.observaciones || 'Sin observaciones.'}}</p>
          </div>

          <a href="#" class="btn btn-sm btn-outline-warning border-0 mt-2 d-print-none " data-toggle="modal" data-target="#empresaEditModal">Editar </a>

        </div>
        <div class="card w-75 ml-3">
          <div class="card-body px-0">
            <h4 class="card-title px-3">Alquileres</h4>
            <base-loader v-if="!alquileres"></base-loader>
            <table class="table table-borderless table-hover"  v-else >
              <thead>
                <tr>
                  <th>Número</th>
                  <th>Estado</th>
                  <th>Itinerario</th>
                  <th>Vehiculo</th>
                  <th>Cliente</th>
                  <th class="d-print-none"></th>
                </tr>
              </thead>
		      <tbody>
		        <tr v-for="alquiler in alquileres" :key="alquiler.id" :class="{'o-75 bg-light':moment(alquiler.fecha_devolucion).isSameOrBefore(moment())}">
					<td><id-badge :number-id="alquiler.id"></id-badge></td>
					<td v-html="estado(moment(alquiler.fecha_entrega),moment(alquiler.fecha_devolucion))"></td>
	      			<td><alquiler-fechas :desde="alquiler.fecha_entrega" :hasta="alquiler.fecha_devolucion"></alquiler-fechas> </td>
             <td> <vehiculo-badge size="sm" :vehiculo="alquiler.vehiculo" > </vehiculo-badge> </td>
            <td><cliente-badge size="sm" :id="alquiler.cliente.id" :nombre="alquiler.cliente.apellido + ', ' + alquiler.cliente.nombre"></cliente-badge> </td>
					  
		          <td class="text-right d-print-none"><base-go model="alquileres" :id="alquiler.id"></base-go></td>
		        </tr>
		      </tbody>
		    </table>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import VehiculoBadge from '../Vehiculos/Badge'
import ClienteBadge from '../Clientes/Badge'
import BaseBack from '../Base/Back'
import EmpresaEdit from './Edit'

import moment from 'moment'

export default {
 	components : {VehiculoBadge,ClienteBadge, EmpresaEdit, BaseBack} ,
  data() {
    return {
    	moment:moment,
      empresa: null,
      alquileres: null,
    };
  },
  created() {
   this.getEmpresa()
   this.$root.$on('empresaUpdate', ()=>{
     this.empresa = null
     this.getEmpresa();
   })
  },
  methods: {
  	getEmpresa() {
  		 axios.get(this._appApi+'empresas/' + this.$route.params.id)
	      .then(response => {
	        console.log(response.data)
	        this.empresa = response.data.empresa;
	        this.alquileres = response.data.alquileres;
	      })
	      .catch(e=>console.log(e))
  	},
  	estado(start, end) {
      if (moment().isBetween(start, end.add(1,'day'))) {
        return '<span class="badge badge-warning">ACTUAL</span>';
      } else if (start.isSameOrAfter()) {
        return '<span class="badge badge-success">PROXIMO</span>';
      } else if (end.isSameOrBefore()) {
        return '<span class="badge bg-white">TERMINADO</span>';
      }
    },
  }
};
</script>

<style lang="scss" scoped>
  .btn-cliente:hover {
    background-color: #f3f3f3;
  }


</style>
