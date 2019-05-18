<template>
    <router-link :to="'/vehiculos/' + vehiculo.id" :class="'btn  btn-outline-secondary border-0 py-2 d-inline-flex align-items-center btn-'+size">
        <vehiculo-patente :patente="vehiculo.patente"  class="mr-2"></vehiculo-patente>
        <img :src="'uploads/vehiculos/' + vehiculo.foto" class="rounded img-fluid mr-2" width="60px">
        <!-- <img :src="'img/marcas/'+marca(vehiculo.marca_id).nombre + '.png'" > -->
      {{ marca(vehiculo.marca_id)['nombre'] }} <strong class="ml-1"> {{  vehiculo.modelo }}  </strong> </router-link>
</template>

<script>
import apis from '../../apis.ts'
export default {
    props: {
        vehiculo: { 
            type: Object, 
            default : {
                id: 0,
                patente: '',
                foto : '',
                marca_id : 1,
                modelo : ''
            }
        },
        size: { type: String, default:'' },
    },
    computed: {
       
    },
    data(){
        return {
            marcas: this.$parent.marcas
        }
    },
    beforeMount() {
        this.marcas= this.$parent.marcas
    },
     methods: {
         marca: function(id) {
             if( this.marcas) {
                 return this.marcas.find(marca => {
                     return marca.id == id;
                }) || '';
             } else {
                 return false
             }
        }
    }
}
</script>
