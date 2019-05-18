<template>
    <router-link  :to="'/clientes/'+id"  :class="'p-1 text-left btn  btn-outline-dark border-0 btn-'+size">
        <i class="fa fa-user-circle fa-fw mr-2"></i>{{ nombre }}
    </router-link>
</template>

<script>
export default {
    props: ['id','nombre','size'],
    props: {
        id: { type: Number },
        nombre: { type: String, default:'' },
        size: { type: String, default:'' },
    }
   
}
</script>

<style>

</style>
