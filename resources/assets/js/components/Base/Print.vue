<template>
    <a href="#" v-on:click.prevent="print()" class="btn btn-sm btn-outline-warning border-0 ml-2 d-print-none "><i class="fa fa-print"></i></a>
</template>

<script>
export default {
    methods: {
        print() {
            console.log('print')
            window.print()
        }
    }
}
</script>

<style>

</style>
