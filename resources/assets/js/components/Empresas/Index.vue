<template>
  <div >
    <base-header v-if="empresas" model="empresas" :total="filteredEmpresas.length">
      <input type="text" v-model="query" class="w-25 form-control border-warning " placeholder="Buscar...">
	</base-header>
	<empresas-create-modal></empresas-create-modal>
    
    <base-loader v-if="!empresas"></base-loader>
    <table class="table table-borderless table-sm table-hover "  v-else>
      <thead>
        <tr>
          <th>ID</th>
          <th>Empresa</th>
          <th>cuit</th>
          <th>Email</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="empresa in filteredEmpresas" :key="empresa.id">
          <td><id-badge :number-id="empresa.id"></id-badge></td>
          <td>
            <router-link :to="'/empresas/'+empresa.id"  class="btn btn-sm btn-outline-dark border-0"><i class="fa fa-briefcase mr-2"></i>  {{ empresa.nombre }} </router-link></td>
          <td>{{ empresa.cuit }}</td>
          <td><a :href="'mailto:' + empresa.email" class="btn btn-sm btn-outline-primary border-0">{{ empresa.email }}</a></td>
          <td class="text-right"><base-go model="empresas" :id="empresa.id"></base-go></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import EmpresasCreateModal from './Create'

export default {
	components :{EmpresasCreateModal},
	data() {
		return {
			query: '',
			empresas: null
		}
	},
	computed: {
		filteredEmpresas() {
			return this.empresas.filter(empresa => {
				return empresa.nombre
					.toLowerCase()
					.includes(this.query.toLowerCase())
			})
		}
	},
	created() {
		this.getEmpresas()
		this.$root.$on("empresasUpdate",()=>{
			this.getEmpresas()
		});

	},
	methods: {
		getEmpresas(){
			this.empresas = null
			axios.get(this._appApi+'empresas/')
			.then(response => {
				this.empresas = response.data
			})
			.catch(e=>console.log(e))
		}
	}
}
</script>
