<template>
<span class="badge badge-light">
    <strong >{{fecha_parsed}} </strong>
    <span :class="'text-'+clase">{{ estado }}</span>
</span>
</template>

<script>
export default {
    props:{
        fecha : {
            type: String
        },
        size : {
            type : String,
            default : ''
        }
    },
    data(){
        return {
          moment: moment,
        }
    },
    computed: {
        fecha_parsed () {
            return moment(this.fecha).format('l')
        },
        clase() {
            if (moment(this.fecha).isBefore()) return 'danger'
            if (moment(this.fecha).isAfter()) return 'success'
        }, 
        estado() {
            if (moment(this.fecha).isBefore()) return 'VENCIDO'
            if (moment(this.fecha).isAfter()) return 'VIGENTE'
        }, 
    }
}
</script>

<style>

</style>
