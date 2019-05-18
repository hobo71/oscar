<template>
    <router-link  :to="'/empresas/'+id"  :class="'p-1 text-left btn btn-sm btn-outline-warning border-0 btn-'+size">
        <i class="fa fa-briefcase fa-fw mr-2"></i>{{ nombre }}
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
