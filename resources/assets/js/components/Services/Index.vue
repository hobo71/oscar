<template>
  <div>
    <base-header model="services" :total="services.length"></base-header>
    <services-create-modal></services-create-modal>
    <base-loader v-if="!services"></base-loader>
    <table class="table table-borderless table-hover" v-else>
      <thead>
        <tr>
          <th>
            Taller / Detalle
          </th>
          <th>Vehiculo</th>
          <th>Fecha</th>
          <th>Importe</th>
          <th class="d-print-none"></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="service in services" :key="service.id">
          <td width="40%"> {{ service.titulo }} <br> <small class="text-muted">{{ service.detalle }}</small> </td>
          <td> <vehiculo-badge size="sm" :vehiculo="service.vehiculo"></vehiculo-badge> </td>
          <td> {{ service.fecha }}
           <!-- <br> {{ service.vigencia }}  -->
         </td>
          <td class="text-right"> <strong>${{ service.importe }}</strong> </td>
          <td class="text-right d-print-none"> <base-go model="services" :id="service.id"></base-go> </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import apis from "../../apis.ts";
import VehiculoBadge from "../Vehiculos/Badge";
import ServicesCreateModal from './Create';

export default {
  components: { VehiculoBadge, ServicesCreateModal },
  data() {
    return {
      services: null,
      marcas: [],
    };
  },
   created() {
    this.getServices();
    this.$root.$on("servicesUpdate", () => {
      this.getServices();
    });
    apis.getMarcas().then(response => (this.marcas = response.data));
  },
  methods: {
    getServices() {
      this.services = null
			axios.get(this._appApi+"services")
  			.then(response => {
          this.services = response.data;
  			})
  			.catch( e=> { console.log(e) })
    }
  }
};
</script>
