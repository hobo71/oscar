<template>
  <div>
    <base-loader v-if="alquileres.length==0 && !marcas"></base-loader>
    <table class="table table-borderless table-hover mb-0" v-else>
      <thead>
        <tr>
          <th>Número</th>
          <th>Estado</th>
          <th>Itinerario</th>
          <th>Cliente</th>
          <th class="d-print-none "></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="alquiler in alquileres" :key="alquiler.id"  :class="{'o-75 bg-light':moment(alquiler.fecha_devolucion).isSameOrBefore(moment())}">
					<td><id-badge :number-id="alquiler.id"></id-badge></td>
					<td v-html="estado(moment(alquiler.fecha_entrega),moment(alquiler.fecha_devolucion))"></td>
          <td><alquiler-fechas size="sm" :desde="alquiler.fecha_entrega" :hasta="alquiler.fecha_devolucion"></alquiler-fechas> </td>
					<td><cliente-badge size="sm" :id="alquiler.cliente.id" :nombre="alquiler.cliente.apellido + ', ' + alquiler.cliente.nombre"></cliente-badge> </td>
          <td class="d-print-none text-right"><base-go model="alquileres" :id="alquiler.id"></base-go></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import apis from "../../apis.ts";
import ClienteBadge from '../Clientes/Badge'

export default {
  components :{ClienteBadge},
  props: {
      "vehiculoId":{
        type: Number
      }, 
    },
  data() {
    return {
      moment: moment,
      alquileres: [],
      marcas: null,
      estados : [
        '','proximo','actual','terminado'
      ]
    };
  },

  created() {
     apis.getAlquileres(1, null, this.vehiculoId).then(response => {
        this.alquileres = response.data.data;
      });
    apis.getMarcas().then(response => (this.marcas = response.data));
  },
  methods: {
     
    estado(start, end) {
      if (moment().isBetween(start, end.add(1,'day'))) {
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
