<template>
    <div>
    	<base-loader v-if="!vehiculo && !data"></base-loader>
      <div class="row" v-else>
        <vehiculo-edit  :vehiculo-data="vehiculo"></vehiculo-edit>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-3 ">
          <base-back></base-back>
          <img :src="'uploads/vehiculos/' + vehiculo.foto" class="rounded img-fluid p-3" width="100%">
            <!-- <vehiculo-patente v-if="vehiculo" :patente="vehiculo.patente"></vehiculo-patente> -->
            <vehiculo-badge :vehiculo="vehiculo" ></vehiculo-badge>
            <hr>
             <dl class=" ">
                <!-- <dt>Kilometraje</dt>
                <dd>{{ vehiculo.kilometros || ''}}</dd> -->
                <dt>Modelo</dt>
                <dd>{{ vehiculo.anio || ''}}</dd>
                <dt>Clase</dt>
                <dd>{{ vehiculo.clase || ''}}</dd>
                <dt>Puertas</dt>
                <dd>{{ vehiculo.puertas || ''}}</dd>
                <dt>Cubiertas</dt>
                <dd>{{ vehiculo.cubiertas || ''}}</dd>
                <dt>Ciudad</dt>
                <dd>{{ datas.ciudades[vehiculo.ciudad]}}</dd>
                <dt>Seguro</dt>
                <dd><vehiculo-fecha :fecha="vehiculo.vto_seguro"></vehiculo-fecha></dd>
                <dt>RTO</dt>
                <dd><vehiculo-fecha :fecha="vehiculo.vto_rto"></vehiculo-fecha></dd>
                <dt>Habilitacion</dt>
                <dd><vehiculo-fecha :fecha="vehiculo.vto_habilitacion"></vehiculo-fecha></dd>
            </dl>
            <button type="button" class="btn btn-sm btn-outline-warning border-0 mt-2 d-print-none" data-toggle="modal" :data-target="'#vehiculoEditModal'">Editar </button>
            <!-- <button type="button" class="btn btn-sm btn-outline-danger border-0 mt-2 d-print-none" v-on:click.prevent="destroy()">Eliminar </button> -->
            
        </div>
        <div class=" col-xl-6 col-lg-9 col-md-9 col-sm-9 col-xs-9 mb-2">
          <div class="card mb-2">
            <div class="card-body px-0">
              <h4 class="card-title px-3">Alquileres</h4>
              <vehiculo-alquileres :vehiculo-id="vehiculo.id" ></vehiculo-alquileres>
            </div>
          </div>
         
        </div>
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-xs-12">
           <div class="alert alert-warning mb-3" v-if="vehiculo.observaciones">
            <h5 class="mt-2">Observaciones</h5>
            <hr>
            <p class="text-muted white-space-pre ">{{ vehiculo.observaciones || 'Sin observaciones.'}}</p>
          </div>
          <div class="card">
            <div class="card-body px-0">
              <h4 class="card-title px-3">Services</h4>
              <vehiculo-services :vehiculo-id="vehiculo.id" ></vehiculo-services>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<style lang="scss" scoped>
  .card {
    overflow: hidden;
  }
</style>

<script>
import apis from "../../apis.ts";
import VehiculoFecha from "../Vehiculos/Fecha";
import VehiculoBadge from "../Vehiculos/Badge";
import VehiculoAlquileres from "../Vehiculos/Alquileres";
import VehiculoServices from "../Vehiculos/Services";
import VehiculoEdit from "../Vehiculos/Edit";

import BaseBack from "../Base/Back";

export default {
  components: { VehiculoBadge, VehiculoFecha, VehiculoAlquileres, VehiculoServices , VehiculoEdit, BaseBack},

  data() {
    return {
      vehiculo: null,
      marcas: [],
      datas : null,
    };
  },
  methods: {
    marca(id) {
      return this.marcas.find(marca => {
        return marca.id == id;
      });
    },
    getData() {
      return axios.get(this._appApi+"data")
        .then( response => {
          this.datas = response.data
        })
        .catch(e=> console.log(e))

    },
    destroy() {
      axios.delete(this._appApi + 'vehiculos/' + this.$route.params.id)
      .then( response => {
          this.datas = response.data
          this.$router.push('vehiculos')
        })
        .catch(e=> console.log(e))
    }
  },
  mounted() {
    this.getData()
    apis.getVehiculo(this.$route.params.id).then(response => {
      this.vehiculo = response.data;
    });
    apis.getMarcas().then(response => (this.marcas = response.data));
  }
};
</script>
