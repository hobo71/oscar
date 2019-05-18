<template>
  <div class="modal fade" tabindex="-1" role="dialog" id="vehiculosCreateModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Nuevo Vehiculo</h5>
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
                <label for="vehiculo.clase">clase</label>
                <select class="custom-select " v-model="vehiculo.clase" >
                  <option v-for="(key, value) in data.vehiculo_clases" :key="key" :value="value" >{{ key }}</option>
                </select>
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.puertas">puertas</label> <br>
                <input type="number" v-model="vehiculo.puertas" class="form-control" placeholder="5" >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.cubiertas">cubiertas</label> <br>
                <input type="text" v-model="vehiculo.cubiertas" class="form-control" placeholder="cubiertas"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.kilometros">kilometros</label> <br>
                <input type="text" v-model="vehiculo.kilometros" class="form-control" placeholder="kilometros"  >
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              
              <div class="w-25">
                <label for="vehiculo.vto_seguro">Vto seguro</label> <br>
                <input type="date" v-model="vehiculo.vto_seguro" class="form-control"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.vto_rto">Vto rto</label> <br>
                <input type="date" v-model="vehiculo.vto_rto" class="form-control"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.vto_habilitacion">Vto habilitacion</label> <br>
                <input type="date" v-model="vehiculo.vto_habilitacion" class="form-control"  >
              </div>
              <div class="w-25 ml-2">
                <label for="vehiculo.ciudad">ciudad</label> <br>
                <select class="custom-select " v-model="vehiculo.ciudad" >
                  <option v-for="(key, value) in data.ciudades" :key="key" :value="value" >{{ key }}</option>
                </select>
              </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="w-50 ">
                <label for="vehiculo.foto">foto</label>
                <input type="file" id="foto" ref="foto" class="form-control" v-on:change="handleInput()">
              </div>
              <div class="w-50 ml-2">
                <label >Observaciones</label>
                <textarea v-model="vehiculo.observaciones" class="form-control mb-2" rows="2"></textarea>
              </div>
            </div>
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
import moment from "moment";
export default {
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
      vehiculo: {ciudad : 0, clase : 0, kilometros : 0, marca_id : 0, puertas: 5},
      file:null,
      form : new FormData()
    };
  },
  mounted() {
    this.vehiculo.vto_rto = this.moment().add(1,'month').format('YYYY-MM-DD')
    this.vehiculo.vto_seguro = this.moment().add(1,'month').format('YYYY-MM-DD')
    this.vehiculo.vto_habilitacion = this.moment().add(1,'month').format('YYYY-MM-DD')
    this.vehiculo.anio = this.moment().year()

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
    handleInput() {
          this.file = this.$refs.foto.files[0];
          console.log('this.file ',this.file)
    },
    store() {
      let configHeader = { headers: { 'Content-Type': 'multipart/form-data' } }
      Object.keys(this.vehiculo).forEach(function(field) {
        this.form.append(field,this.vehiculo[field])
      }.bind(this));
      this.form.append('foto',this.file)
      console.log("form ",this. form);
      axios
        .post(this._appApi+"vehiculos", this.form, configHeader)
          .then(response => {
            console.log(response.data);
            this.$root.$emit("vehiculosUpdate");
            $("#vehiculosCreateModal").modal("hide");
          })
          .catch(e => console.log(e));
    },
    getMarcas() { return axios.get(this._appApi+"marcas"); },
    getData() { return axios.get(this._appApi+"data"); },
    getOptions() { return axios.get(this._appApi+"options"); }
  }
};
</script>
