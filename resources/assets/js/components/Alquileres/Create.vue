<template>
  <div class="modal fade" tabindex="-1" role="dialog" id="alquileresCreateModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Nuevo Alquiler</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="px-3" v-if="!vehiculos && !data && !clientes">
          <base-loader></base-loader>
        </div>
        <div v-else>
          <div class="modal-body">
            <div class="d-flex align-items-center mb-2">
              <label for="cliente" class="w-25 d-inline-block">Cliente</label>
              <select
                class="custom-select w-25"
                v-model="alquiler.cliente_id"
                :disabled="alquiler.cliente_nuevo.nombre!='' || alquiler.cliente_nuevo.apellido!=''"
              >
                <option value="nuevo">Nuevo</option>
                <option
                  v-for="cliente in clientes"
                  :key="cliente.id"
                  :value="cliente.id"
                >{{ cliente.nombre }}</option>
              </select>
              
              <input
                type="text"
                :disabled="alquiler.cliente_id!='nuevo'"
                v-model="alquiler.cliente_nuevo.nombre"
                class="w-25 form-control ml-2"
                placeholder="Nombre"
              >
              <input
                type="text"
                :disabled="alquiler.cliente_id!='nuevo'"
                v-model="alquiler.cliente_nuevo.apellido"
                class="w-25 form-control ml-2"
                placeholder="Apellido"
              >
            </div>

            <div class="d-flex align-items-center mb-2">
              <label :for="alquiler.vehiculo_id" class="w-25 d-inline-block">Vehiculo</label>
              <select class="custom-select" v-model="alquiler.vehiculo_id">
                <option
                  v-for="vehiculo in vehiculos"
                  :value="vehiculo.id"
                  :key="vehiculo.id"
                >{{ vehiculo.modelo}} {{ vehiculo.patente}}</option>
              </select>
            </div>

            <div class="d-flex align-items-center mb-2">
              <label class="w-25 d-inline-block">Entrega</label>
              <input type="date" class="w-25 form-control ml-2" v-model="alquiler.fecha_entrega">
              <input
                type="time"
                class="w-25 form-control ml-2"
                v-model="alquiler.hora_entrega"
                placeholder="10:00"
              >
              <select
                class="w-25 custom-select ml-2"
                v-model="alquiler.lugar_entrega"
                v-if="data.lugares"
              >
                <option v-for="(lugar,index) in data.lugares" :value="index" :key="index">{{ lugar}}</option>
              </select>
            </div>
            <div class="d-flex align-items-center mb-2">
              <label class="w-25 d-inline-block">Devolucion</label>
              <input type="date" class="w-25 form-control ml-2" v-model="alquiler.fecha_devolucion">
              <input
                type="time"
                class="w-25 form-control ml-2"
                v-model="alquiler.hora_devolucion"
                placeholder="10:00"
              >
              <select
                class="w-25 custom-select ml-2"
                v-model="alquiler.lugar_devolucion"
                v-if="data.lugares"
              >
                <option v-for="(lugar,index) in data.lugares" :value="index" :key="index">{{ lugar}}</option>
              </select>
            </div>

            <div class="d-flex align-items-center mb-2">
              <div class="w-25"></div>
              <select class="custom-select w-25" v-model="alquiler.servicio">
                <option value disabled selected>Servicio</option>
                <option
                  v-for="(servicio,index) in data.servicios"
                  :value="index"
                  :key="index"
                >{{ servicio}}</option>
              </select>
              <select class="custom-select w-25 ml-2" v-model="alquiler.forma_pago">
                <option value disabled selected>Forma de Pago</option>
                <option
                  v-for="(forma_pago,index) in data.formas_pago"
                  :value="index"
                  :key="index"
                >{{ forma_pago}}</option>
              </select>
              <div class="w-25 ml-2">
                <label for="alquiler.descuento">Descuento</label>
                <input
                  type="number"
                  min="0"
                  max="50"
                  step="5"
                  class="form-control d-inline w-50"
                  v-model="alquiler.descuento"
                >
              </div>
            </div>

            <label class="w-25 d-inline-block">Observaciones</label>
            <textarea v-model="alquiler.observaciones" class="form-control mb-2" rows="2"></textarea>
          </div>
          <div class="card-footer bg-warning text-dark rounded-0 border-dotted-top">
            <div class="d-flex justify-content-between align-items-center">
              <h2 class="m-0">
                <small class="text-light">Días</small>
                <br>
                {{dias}}
              </h2>
              <h2 class="m-0">
                <small class="text-light">Valor por día</small>
                <br>
                ${{ valores[vehiculoSelected['clase']] }}
              </h2>
              <h2 class="m-0">
                <small class="text-light">Descuento</small>
                <br>
                {{ alquiler.descuento }}%
              </h2>
              <div class="text-right">
                <h2 class="m-0 text-light">
                  <small class>Total</small>
                </h2>
                <transition name="fade">
                  <h3 v-if="alquiler.descuento > 0">
                    ${{ total }}
                    <br>
                    <span class="badge badge-light">- ${{ subtotal }}</span>
                  </h3>
                </transition>
                <h1 class="m-0">
                  <strong>${{computedCotizacion}}</strong>
                </h1>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 bg-warning">
          <button
            type="button"
            class="btn btn-outline-dark border-0 btn-lg mr-auto"
            data-dismiss="modal"
          >Cancelar</button>
          <button
            type="button"
            class="btn btn-outline-light btn-lg"
            v-on:click="store"
            v-if="alquiler.cliente_id && alquiler.vehiculo_id"
          >Generar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  computed: {
    vehiculoSelected() {
      return this.vehiculos.find(vehiculo => {
        return vehiculo.id == this.alquiler.vehiculo_id;
      });
    },
    dias() {
      return moment(this.alquiler.fecha_devolucion, "YYYY-MM-DD").diff(
        moment(this.alquiler.fecha_entrega, "YYYY-MM-DD"),
        "days"
      );
    },
    total() {
      return this.dias * this.valores[this.vehiculoSelected["clase"]];
    },
    subtotal() {
      return (this.total * this.alquiler.descuento) / 100;
    },
    computedCotizacion() {
      return this.total - this.subtotal;
    }
  },
  data() {
    return {
      moment: moment,
      clientes:   null,
      vehiculos:  null,
      data:       null,
      options:    null,
      valores: [],
      alquiler: {
        cliente_id: null,
        cliente_nuevo: {
          nombre: "",
          apellido: ""
        },
        vehiculo_id: 995,
        fecha_entrega: moment().format("YYYY-MM-DD"),
        fecha_devolucion: moment() .add(1, "day") .format("YYYY-MM-DD"),
        hora_entrega: "10:00",
        hora_devolucion: "23:00",
        lugar_entrega: 0,
        lugar_devolucion: 0,
        servicio: 0,
        forma_pago: 0,
        descuento: 0,
        observaciones: "",
      }
    };
  },
  mounted() {
    console.log("fecha ", moment().format("YYYY-MM-DD"));

    axios
      .all([
        this.getClientes(),
        this.getVehiculos(),
        this.getData(),
        this.getOptions()
      ])
      .then(
        axios.spread((clientes, vehiculos, data, options) => {
          this.clientes = clientes.data;
          this.vehiculos = vehiculos.data;
          this.data = data.data;
          this.options = options.data;
          this.valores[0] = this.options.valor_auto_chico;
          this.valores[1] = this.options.valor_auto_grande;
          this.valores[2] = this.options.valor_camioneta;
        })
      )
      .catch(e => console.log(e));
  },
  methods: {
    store() {
      this.alquiler.cotizacion = this.computedCotizacion
      axios
        .post(this._appApi+"alquileres", this.alquiler)
        .then(response => {
          this.$root.$emit("alquileresUpdate");
          $("#alquileresCreateModal").modal("hide");
        })
        .catch(e => console.log(e));
    },
    getClientes() {
      return axios.get(this._appApi+"clientes/min");
    },
    getVehiculos() {
      return axios.get(this._appApi+"vehiculos");
    },
    getData() {
      return axios.get(this._appApi+"data");
    },
    getOptions() {
      return axios.get(this._appApi+"options");
    }
  }
};
</script>
