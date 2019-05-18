<template>
  <div class="modal fade" tabindex="-1" role="dialog" id="servicesCreateModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Nuevo Service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>

      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="w-20 " >
            <label for="service.vehiculo_id">Vehiculo</label> <br>
            <select v-model="service.vehiculo_id" class="form-control" v-if="vehiculos">
              <option v-for="vehiculo in vehiculos" :value="vehiculo.id">{{ vehiculo.modelo + ' ' + vehiculo.patente  }}</option>
            </select>
            <base-loader  v-else></base-loader>
          </div>
          <div class="w-20 ml-2">
            <label for="service.titulo">Taller</label>
            <input type="text" v-model="service.titulo" class="form-control" placeholder="Nombre del Taller" >
          </div>
          
          <div class="w-20 ml-2">
            <label for="service.importe">Importe</label> <br>
            <input type="text" v-model="service.importe" class="form-control" placeholder="0" >
          </div>

           <div class="w-20 ml-2">
            <label for="service.fecha">Fecha de service</label>
            <input type="date" v-model="service.fecha" class="form-control" >
          </div>
          <div class="w-20 ml-2">
            <label for="service.vigencia">Vigente hasta</label>
            <input type="date" v-model="service.vigencia" class="form-control"  >
          </div>
          
        </div>
        <div class="mt-3">
          <label for="service.detalle">Detalle</label> <br>
          <textarea v-model="service.detalle" class="form-control">
            
          </textarea>
        </div>
      </div>
        <div class="modal-footer border-0 bg-warning">
          <button type="button" class="btn btn-outline-dark border-0 btn-lg mr-auto" data-dismiss="modal" >Cancelar</button>
          <button type="button" class="btn btn-outline-light btn-lg" v-on:click="store" >Generar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import moment from 'moment'

export default {
	data() {
		return {
      vehiculos: null,
			service: {
        vehiculo_id: null,
        fecha: moment().format('Y-MM-DD'),
        titulo: '',
        detalle: '',
        importe: 0,
        vigencia: moment().add(1,'year').format('Y-MM-DD'),
       },
		}
	},
	created() {
    this.getVehiculos()
	},
	methods :{
    getVehiculos(){
      axios.get(this._appApi+'vehiculos/')
        .then( response => {
          this.vehiculos = response.data
        })
        .catch( e=> console.log(e))
    },
    store() {
      $("#servicesCreateModal").modal("hide");
      axios
        .post(this._appApi+"services", this.service)
          .then(response => {
            console.log(response.data);
            this.$root.$emit("servicesUpdate");
          })
          .catch(e => console.log(e));
    },
	}
}
</script>