<template>
    <div>
    	<base-loader v-if="!cliente"></base-loader>
      <div class="d-flex justify-content-between" v-else>
      <cliente-edit :cliente-data="cliente"></cliente-edit>

        <div class=" w-25 mt-3">
            <base-back></base-back>
            <cliente-badge :id="cliente.id" :nombre="cliente.apellido + ', ' + cliente.nombre" size="lg" ></cliente-badge>
            <hr>
             <dl>
                <dt>DNI</dt>
                <dd>{{ cliente.dni || ''}}</dd>
                <dt>Telefono</dt>
                <dd>{{ cliente.telefono || ''}}</dd>
                <dt>Email</dt>
                <dd>{{ cliente.email || ''}}</dd>
                <dt>Empresa</dt>
                <dd><empresa-badge v-if="cliente.empresa" :id="cliente.empresa.id" :nombre="cliente.empresa.nombre"></empresa-badge></dd>
                <dt>Domicilio</dt>
                <dd>{{ cliente.domicilio ||  cliente.domicilio_temporal}}</dd>
            </dl>
          <div class="alert alert-warning" v-if="cliente.observaciones">
            <h6>Observaciones</h6>
            <p class="text-muted white-space-pre">{{ cliente.observaciones || 'Sin observaciones.'}}</p>
          </div>

          <div class="btn-group">
            <a href="#" class="btn btn-sm btn-outline-warning border-0 mt-2 d-print-none " data-toggle="modal" data-target="#clienteEditModal">Editar </a>
            <a href="#" class="btn btn-sm btn-outline-danger border-0 mt-2 d-print-none " v-on:click="destroy()">Eliminar </a>
          </div>
        </div>
        <div class="card w-75 ml-3">
          <div class="card-body px-0">
            <h4 class="card-title px-3">Alquileres</h4>
            <cliente-alquileres :cliente-id="cliente.id" ></cliente-alquileres>
          </div>
        </div>
      </div>
    </div>
</template>

<script>
import ClienteAlquileres from './Alquileres';
import ClienteBadge from './Badge';
import ClienteEdit from './Edit'
import EmpresaBadge from '../Empresas/Badge';
import BaseBack from '../Base/Back'

export default {
  components: {ClienteAlquileres, ClienteBadge, BaseBack, EmpresaBadge, ClienteEdit },
  data() {
    return {
      cliente: null,
    };
  },
    mounted() {
      console.log( ' cliente id - > ' , this.$route.params.id )
    this.getCliente()
    this.$root.$on('clienteUpdate',()=> {
      this.getCliente()
    })
  },
  methods: {
    getCliente() {
      axios
      .get(this._appApi+'clientes/' + this.$route.params.id)
        .then(response => {
          console.log(response.data)
          this.cliente = response.data;
        })
        .catch(e=>console.log(e))
    },
    destroy() {
      let c =confirm('Esta seguro que desea eliminar el cliente ?' )
      if(c) {
        axios.delete(this._appApi + 'clientes/'+this.$route.params.id)
        .then(response => {
          console.log(response.data)
            this.$router.push('/clientes')
          })
          .catch(e=>console.log(e))
      }
    }
  }
};
</script>
