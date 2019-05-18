<template>
    <router-link :to="'/'+model+'/'+id" class="btn btn-sm btn-outline-warning border-0"><i class="fa fa-angle-right"></i></router-link>
</template>

<script>
export default {
	props: ['id', 'model']
}
</script>

<style>
</style>
