<template>
  <div>
    <base-header v-if="vehiculos"  model="vehiculos" :total="filteredVehiculos.length">
      <vehiculo-create></vehiculo-create>
	<select v-model="tipo" class="custom-select w-25 d-print-none " v-show="!soloDisponibles">
		<option value="" >Todos</option>
		<option value="0">Chico</option>
		<option value="1">Mediano</option>
		<option value="2">Grande</option>
	</select>
      <input type="text" v-model="query" class="w-25 form-control border-warning d-print-none " placeholder="Buscar..." v-show="!soloDisponibles">
      <div> <input type="checkbox" v-model="soloDisponibles" id="soloDisponibles" class="btn btn-outline-success d-print-none"> <label for="soloDisponibles">Sólo disponibles</label> </div>
		</base-header>

    <base-loader v-if="!vehiculos && !datas"></base-loader>
    <table class="table table-borderless table-hover" v-else>
			<thead>
				<tr>
					<th></th>
					<th>Patente</th>
					<th>Marca</th>
					<th>Modelo</th>
					<th>Ciudad</th>
					<th>Año</th>
					<th>Clase</th>
					<th> Estado </th>
					<th class="d-print-none">Acciones</th>
				</tr>
			</thead>
      <tbody>
        <tr v-for="vehiculo in filteredVehiculos" :key="vehiculo.id"  :class="{'bg-alquilado':queryState(vehiculo.id)}">
					<td><img :src="'uploads/vehiculos/' + vehiculo.foto" class="rounded img-fluid " width="110px"></td>
					<td> <vehiculo-patente v-if="vehiculo" :patente="vehiculo.patente"></vehiculo-patente> </td>
          <td><img v-if="marcas" :src="'img/marcas/'+marca(vehiculo.marca_id).nombre + '.png'" :alt="marca(vehiculo.marca_id).nombre"></td>
          <td><strong>{{ vehiculo.modelo }}</strong></td>
          <td>{{ datas.ciudades[vehiculo.ciudad] }}</td>
          <td>{{ vehiculo.anio }}</td>
          <td>{{ vehiculo.clase }}</td>
          <td v-if="alquilados">
						<span class="badge d-block p-3 badge-danger" v-if="queryState(vehiculo.id)">ALQUILADO</span>
						<span class="badge d-block p-3 badge-success" v-else>DISPONIBLE</span>
						</td>
          <td  class="d-print-none text-right"><base-go model="vehiculos" :id="vehiculo.id"></base-go></td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import apis from '../../apis.ts'
import VehiculoCreate from './Create'

export default {
	components : {VehiculoCreate},
	data() {
		return {
			query: '',
			tipo: '',
			soloDisponibles: false,
			marcas: null,
			vehiculos: null,
			alquilados : null, 
			datas : null,
			groups: {
				chico: [],
				mediano: [],
				grande: [],
				camineta: []
			}
		}
	},
	computed: {
		filteredVehiculos() {
			if( this.soloDisponibles ) {
				return this.vehiculos.filter(vehiculo => {
					return !this.queryState(vehiculo.id)
				})
			} else {
				return this.vehiculos.filter(vehiculo => {
					return (vehiculo.modelo .toLowerCase() .includes(this.query.toLowerCase()) || 
					vehiculo.patente .toLowerCase() .includes(this.query.toLowerCase()) ) && 
					vehiculo.clase .toString().includes(this.tipo)
				})
			}
		}
	},
	mounted() {
		this.getDatas()
		this.getAlquilados()
		this.$root.$on('vehiculosUpdate',()=>{
			this.getVehiculos()
		})
		this.getVehiculos()
		this.getMarcas()
		
	},
	methods: {
		getVehiculos() {
			apis.getVehiculos()
				.then(response => (this.vehiculos = response.data))
				.catch(e=>console.log(e))
		},
		getMarcas(){
			apis.getMarcas()
				.then(response => (this.marcas = response.data))
				.catch(e=>console.log(e))
		},
		queryState(id){
			for (let i = 0; i < this.alquilados.length; i++) {
				const element = this.alquilados[i];
				if (element.id == id ){ 
					return true
				}
			}

		},
		getAlquilados(){
			axios.get(this._appApi+'vehiculos/alquilados')
				.then(response=> this.alquilados = response.data)
				.catch(e=>console.log(e))
		},
		marca(id) {
			return this.marcas.find(marca => {
				return marca.id == id
			})
		},
		getDatas() {
			return axios.get(this._appApi+"data")
				.then( response => {
				this.datas = response.data
				})
				.catch(e=> console.log(e))

			}
	}
}
</script>

<style lang="scss" scoped>
	.bg-alquilado {
		background-color: rgba(#dc3545,.05);
	}
</style>
