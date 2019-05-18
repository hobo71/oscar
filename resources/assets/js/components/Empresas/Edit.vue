<template>
  <div class="modal fade" tabindex="-1" role="dialog" id="empresaEditModal">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">Nueva Empresa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>

      <div class="modal-body">
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="w-25">
            <label for="empresa.nombre">Nombre</label>
            <input type="text" v-model="empresa.nombre" class="form-control" placeholder="Nombre" >
          </div>
          <div class="w-25 ml-2">
            <label for="empresa.domicilio">domicilio</label> <br>
            <input type="text" v-model="empresa.domicilio" class="form-control" placeholder="domicilio" >
          </div>
          <div class="w-25 ml-2">
            <label for="empresa.cuit">cuit</label> <br>
            <input type="text" v-model="empresa.cuit" class="form-control" placeholder="cuit" pattern="[A-Za-z]{3}" >
          </div>
          <div class="w-25 ml-2">
            <label for="empresa.celular">celular</label> <br>
            <input type="tel" v-model="empresa.celular" class="form-control" placeholder="celular" >
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-2">
          <div class="w-50">
            <label for="empresa.telefono">telefono</label>
            <input type="tel" v-model="empresa.telefono" class="form-control" placeholder="telefono" >
          </div>
          <div class="w-50 ml-2">
            <label for="empresa.email">email</label> <br>
            <input type="email" v-model="empresa.email" class="form-control" placeholder="email" >
          </div>
          
        </div>
	      <div class=" ml-2">
	        <label >Observaciones</label>
	        <textarea v-model="empresa.observaciones" class="form-control mb-2" rows="2"></textarea>
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
export default {
  props: {
    empresaData :{
      type:Object,
      required:true
    }
  },
	data() {
		return {
			empresa: {nombre:'', domicilio:'', cuit:'', celular:'', telefono:'', email:'', observaciones:'', },
			file:null,
     		form : new FormData()
		}
	},
	created() {
    this.empresa = this.empresaData
	},
	methods :{
	    update() {
        axios
          .put(this._appApi+"empresas/" + this.empresa.id, this.empresa)
            .then(response => {

              console.log(response.data);
             this.$root.$emit("empresaUpdate");
            $("#empresaEditModal").modal("hide");
             
	          })
	          .catch(e => console.log(e));
	    },

	}
}
</script>