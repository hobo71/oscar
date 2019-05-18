<template>
  <div class="modal fade" tabindex="-1" role="dialog" id="clientesCreateModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Nuevo Cliente</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="px-3" v-if="!empresas">
          <base-loader></base-loader>
        </div>
        <div v-else>
          <div class="modal-body">
            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="w-25 ml-2">
                <label for="cliente.nombre">Nombre</label> <br>
                <input type="text" v-model="cliente.nombre" class="form-control" placeholder="Nombre" >
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.apellido">apellido</label> <br>
                <input type="text" v-model="cliente.apellido" class="form-control" placeholder="apellido" >
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.dni">dni</label> <br>
                <input type="text" v-model="cliente.dni" class="form-control" placeholder="dni">
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.empresa">empresa</label> <br>
                <select class="custom-select" v-model="cliente.empresa_id">
                  <option value="0" selected>Ninguna</option>
                  <option v-for="empresa in empresas" :key="empresa.id" :value="empresa.id" >{{ empresa.nombre }}</option>
                </select>
              </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="w-25 ml-2">
                <label for="cliente.domicilio">domicilio</label> <br>
                <input type="text" v-model="cliente.domicilio" class="form-control" placeholder="domicilio" >
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.domicilio_temporal">domicilio_temporal</label> <br>
                <input type="text" v-model="cliente.domicilio_temporal" class="form-control" placeholder="domicilio_temporal" >
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.celular">celular</label> <br>
                <input type="text" v-model="cliente.celular" class="form-control" placeholder="celular">
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.telefono">telefono</label> <br>
                <input type="text" v-model="cliente.telefono" class="form-control" placeholder="telefono">
              </div>
              
             
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
              <div class="w-25 ml-2">
                <label for="cliente.email">email</label> <br>
                <input type="email" v-model="cliente.email" class="form-control" placeholder="email">
              </div>
              <div class="w-25 ml-2">
                <label for="cliente.vip">VIP</label> <br>
                <input type="checkbox" v-model="cliente.vip" 
                  true-value="1"
                  false-value="0"
                class="form-control" >
              </div>
              <div class="w-50 ml-2">
                <label>Observaciones</label>
                <textarea v-model="cliente.observaciones" class="form-control mb-2" rows="2"></textarea>
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
          <button type="button" class="btn btn-outline-light btn-lg" v-on:click="store">Generar</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
    return {
      moment: moment,
      empresas: null,
      cliente: {}
    };
  },
  mounted() {
    this.getEmpresas();
  },
  methods: {
    store() {
      axios
        .post(this._appApi+"clientes", this.cliente)
        .then(response => {
          console.log(response.data);
          this.$root.$emit("clientesUpdate");
          $("#clientesCreateModal").modal("hide");
        })
        .catch(e => console.log(e));
    },
    getEmpresas() {
      axios
        .get(this._appApi+"empresas")
        .then(response => {
          this.empresas = response.data;
        })
        .catch(e => console.log(e));
    }
  }
};
</script>
