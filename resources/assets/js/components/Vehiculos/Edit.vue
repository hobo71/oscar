<template>
  <div class="modal fade" tabindex="-1" role="dialog" id="vehiculoEditModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Editar Vehiculo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="px-3" v-if="!marcas && !data"> <base-loader></base-loader> </div>
        <div v-else>
          <div class="modal-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="w-25">
                <label for="vehiculo.marca_id">Marca</label>
                <select class="custom-select " v-model="vehiculo.marca_id" >
                  <option v-for="marca in marcas" :key="marca.id" :value="marca.id" >{{ marca.nombre }}</option>
                </select>
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.modelo">Modelo</label> <br>
                <input type="text" v-model="vehiculo.modelo" class="form-control" placeholder="Modelo" >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.patente">Patente</label> <br>
                <input type="text" v-model="vehiculo.patente" class="form-control" placeholder="patente" pattern="[A-Za-z]{3}" >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.anio">Año</label> <br>
                <input type="text" v-model="vehiculo.anio" class="form-control" placeholder="2018" >
              </div>
            </div>
            <div class="d-flex justify-content-between  mb-2">
              <div class="w-25">
                <label for="vehiculo.clase">Clase</label>
                <select class="custom-select " v-model="vehiculo.clase" >
                  <option v-for="(key, value) in data.vehiculo_clases" :key="key" :value="value" >{{ key }}</option>
                </select>
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.puertas">Puertas</label> <br>
                <input type="number" v-model="vehiculo.puertas" class="form-control" placeholder="5" >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.cubiertas">Cubiertas</label> <br>
                <input type="text" v-model="vehiculo.cubiertas" class="form-control" placeholder="cubiertas"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.kilometros">Kilómetros</label> <br>
                <input type="text" v-model="vehiculo.kilometros" class="form-control" placeholder="kilometros"  >
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              
              <div class="w-25">
                <label for="vehiculo.vto_seguro">Vto Seguro</label> <br>
                <input type="date" v-model="vehiculo.vto_seguro" class="form-control"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.vto_seguro">Vto R.T.O.</label> <br>
                <input type="date" v-model="vehiculo.vto_rto" class="form-control"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.vto_seguro">Vto Habilitación</label> <br>
                <input type="date" v-model="vehiculo.vto_habilitacion" class="form-control"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.ciudad">ciudad</label> <br>
                <select class="custom-select " v-model="vehiculo.ciudad" >
                  <option v-for="(key, value) in data.ciudades" :key="key" :value="value" >{{ key }}</option>
                </select>
              </div>
            </div>
            <div class="mb-2">
              <label >Observaciones</label>
              <textarea v-model="vehiculo.observaciones" class="form-control mb-2" rows="2"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer border-0 bg-warning">
          <button type="button" class="btn btn-outline-dark border-0 btn-lg mr-auto" data-dismiss="modal" >Cancelar</button>
          <button type="button" class="btn btn-outline-light btn-lg" v-on:click="update" >Actualizar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  props : {
    vehiculoData : {
      type: Object,
      required : true
    }
  },
  computed: {
    vehiculoSelected() {
      return this.vehiculos.find(vehiculo => {
        return vehiculo.id == this.vehiculo.vehiculo_id;
      });
    },
  },
  data() {
    return {
      moment: moment,
      clientes: null,
      data: null,
      marcas: null,
      options: null,
      vehiculo: {},
    };
  },
  mounted() {
    this.vehiculo = this.vehiculoData

    axios
      .all([ this.getMarcas(), this.getData(), this.getOptions() ])
      .then(
        axios.spread((marcas, data, options) => {
          this.marcas = marcas.data;
          this.data = data.data;
          this.options = options.data;
        })
      )
      .catch(e => console.log(e));
  },
  methods: {
   
    update() {
      console.log("this.vehiculo ",this.vehiculo);
      axios
        .put(this._appApi+"vehiculos/" + this.vehiculo.id, this.vehiculo)
          .then(response => {
            console.log(response.data);
            this.$root.$emit("vehiculoUpdate");
            $("#vehiculoEditModal").modal("hide");
          })
          .catch(e => console.log(e));
    },
    getMarcas() { return axios.get(this._appApi+"marcas"); },
    getData() { return axios.get(this._appApi+"data"); },
    getOptions() { return axios.get(this._appApi+"options"); }
  }
};
</script>
