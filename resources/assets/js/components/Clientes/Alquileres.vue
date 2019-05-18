<template>
  <div>
    <base-loader v-if="alquileres.length==0 && !marcas"></base-loader>
    <table class="table table-borderless table-hover" v-else>
      <thead>
          <tr>
            <th>Número</th>
            <th>Estado</th>
            <th>Itinerario</th>
            <th>Vehiculo</th>
            <th class="d-print-none"></th>
          </tr>
        </thead>
      <tbody>
        <tr  v-for="alquiler in alquileres" :key="alquiler.id" :class="{'o-75 bg-light':moment(alquiler.fecha_devolucion).isSameOrBefore(moment())}">
					<td><id-badge :number-id="alquiler.id"></id-badge></td>
					<td v-html="estado(moment(alquiler.fecha_entrega),moment(alquiler.fecha_devolucion))"></td>
          <td><alquiler-fechas :desde="alquiler.fecha_entrega" :hasta="alquiler.fecha_devolucion"></alquiler-fechas> </td>
					<td><vehiculo-badge size="sm" :vehiculo="alquiler.vehiculo" > </vehiculo-badge> </td>
          <td class="text-right d-print-none"><base-go model="alquileres" :id="alquiler.id"></base-go></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import apis from "../../apis.ts";
import VehiculoBadge from '../Vehiculos/Badge'

export default {
  props: {
      "clienteId":{
        type: Number
      }, 
    },
  components : {VehiculoBadge},
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
    apis.getMarcas().then(response => 
      {
    this.getVehiculos()

        this.marcas = response.data
      }
      );
  },
  methods: {
    getVehiculos(){
      apis.getAlquileres(1, this.clienteId, null).then(response => {
        this.alquileres = response.data.data;
      });
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
    vehiculo(id) {
      return this.vehiculos.find(vehiculo => {
        return vehiculo.id == id;
      });
    }
  }
};
</script>
