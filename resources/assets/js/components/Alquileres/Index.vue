<template>
  <div>
    <base-header model="alquileres" :total="total">
      <alquiler-create></alquiler-create>
      <div class="d-flex w-25 align-items-center d-print-none">
        <label for="status">Filtrar por Estado</label>
        <select v-model="status" class="custom-select w-50 ml-2">
          <option v-for="e in estados" :key="e" :value="e">{{e}}</option>
        </select>
      </div>
      <div class="text-right d-print-none">
        <a
          href="#"
          v-if="page > 1"
          v-on:click.prevent="page--"
          class="btn btn-sm btn-outline-warning border-0 mr-2"
        >
          <i class="fa fa-angle-left"></i>
        </a>
        <strong class="badge text-warning">{{ page }}</strong>
        <a
          href="#"
          v-if="total > 12"
          v-on:click.prevent="page++"
          class="btn btn-sm btn-outline-warning border-0 ml-2"
        >
          <i class="fa fa-angle-right"></i>
        </a>
      </div>
    </base-header>
    <base-loader v-if="alquileres.length==0 && !marcas"></base-loader>
    <table class="table table-borderless table-hover" v-else>
      <thead>
        <tr>
          <th>Número</th>
          <th>Estado</th>
          <th>Itinerario</th>
          <th>Cliente</th>
          <th>Vehículo</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr
          v-for="alquiler in alquileres"
          :key="alquiler.id"
          :class="{'o-75 bg-light':moment(alquiler.fecha_devolucion).isSameOrBefore(moment())}"
        >
          <td>
            <id-badge :number-id="alquiler.id"></id-badge>
          </td>
          <td v-html="estado(moment(alquiler.fecha_entrega),moment(alquiler.fecha_devolucion))"></td>
          <td>
            <alquiler-fechas :desde="alquiler.fecha_entrega" :hasta="alquiler.fecha_devolucion"></alquiler-fechas>
          </td>
          <td>
            <cliente-badge
              :id="alquiler.cliente.id"
              :nombre="alquiler.cliente.apellido + ', ' + alquiler.cliente.nombre"
            ></cliente-badge>
          </td>
          <td v-if="showVehiculo">
            <vehiculo-badge :vehiculo="alquiler.vehiculo"></vehiculo-badge>
          </td>
          <td class="text-right d-print-none">
            <base-go model="alquileres" :id="alquiler.id"></base-go>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import apis from "../../apis.ts";
import ClienteBadge from "../Clientes/Badge";
import VehiculoBadge from "../Vehiculos/Badge";
import AlquilerCreate from "./Create";
export default {
  props: {
    clienteId: {
      type: Number
    },
    vehiculoId: {
      type: Number
    },
    showVehiculo: {
      type: Boolean,
      default: true
    }
  },
  components: { ClienteBadge, VehiculoBadge, AlquilerCreate },
  data() {
    return {
      moment: moment,
      query: "",
      page: 1,
      total: 0,
      alquileres: [],
      marcas: null,
      status: null,
      estados: ["", "proximo", "actual", "terminado"]
    };
  },
  watch: {
    page: function(val) {
      axios
        .get(this._appApi+"alquileres?page=" + this.page + "&estado=" + this.status)
        .then(response => {
          this.alquileres = response.data.data;
          this.total = response.data.total;
        })
        .catch(e => console.log(e));
    },
    status: function(val) {
      this.page = 1;
      axios
        .get(this._appApi+"alquileres?page=" + this.page + "&estado=" + this.status)
        .then(response => {
          this.alquileres = response.data.data;
          this.total = response.data.total;
        })
        .catch(e => console.log(e));
    }
  },
  created() {
    this.$root.$on("alquileresUpdate", () => {
      this.getVehiculos();
    });
    this.getVehiculos();
    apis.getMarcas().then(response => (this.marcas = response.data));
  },
  methods: {
    getVehiculos() {
      if (this.clienteId == undefined || this.vehiculoId == undefined) {
        apis.getAlquileres(1).then(response => {
          this.alquileres = response.data.data;
          this.total = response.data.total;
        });
      }
      if (this.clienteId != undefined) {
        apis.getAlquileres(1, this.clienteId, null).then(response => {
          this.alquileres = response.data.data;
          this.total = response.data.total;
        });
      }
      if (this.vehiculoId != undefined) {
        apis.getAlquileres(1, null, this.vehiculoId).then(response => {
          this.alquileres = response.data.data;
          this.total = response.data.total;
        });
      }
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
    vehiculo(id) {
      return this.vehiculos.find(vehiculo => {
        return vehiculo.id == id;
      });
    }
  }
};
</script>
