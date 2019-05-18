<template>
  <div>
    <base-loader v-if="loading"></base-loader>
    <table class="table mb-0 " v-if="services">
      <tbody>
        <tr v-for="service in services" :key="service.id">
          <td class="row" >
            <p class="align-middle mb-0 col-xl-12 col-lg-7 col-md-7 col-sm-7 col-xs-7"> <strong>{{ service.titulo }}</strong><br><small class="text-muted">{{ service.detalle }}</small> </p>
            <p class="align-middle mb-0 col-xl-12 col-lg-3 col-md-3 col-sm-3 col-xs-3 text-right small"> Fecha : {{ service.fecha }}<br>Vigencia: {{ service.vigencia }} </p>
            <p class="align-middle mb-0 col-xl-12 col-lg-2 col-md-2 col-sm-2 col-xs-2 text-right"> <strong>${{ service.importe }}</strong> </p>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import apis from "../../apis.ts";
import VehiculoBadge from "../Vehiculos/Badge";

export default {
  props : [ 'vehiculoId'],
  components: { VehiculoBadge },
  data() {
    return {
      services: null,
      marcas: [],
      loading: false
    };
  },
   beforeMount() {
    this.getServices();
    apis.getMarcas().then(response => (this.marcas = response.data));
  },
  methods: {
    getServices() {
      this.loading = true;
			axios.get(this._appApi+"vehiculos/" + this.vehiculoId + '/services')
			.then(response => {
        this.services = response.data;
        this.loading = false;
			})
			.catch( e=> { console.log(e) })
    }
  }
};
</script>
