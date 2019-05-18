<template>
    <div class="alquileres-fechas d-flex justify-content-between align-items-center" data-toggle="tooltip" data-placement="top"  :title="(moment(hasta).diff(moment(desde),'days') +1 )+ ' días'">
        <span class="desde">{{ moment(desde).format('DD/MM/YY') }}</span> 
        <i class="fa fa-angle-right"></i>
        <span class="hasta">{{ moment(hasta).format('DD/MM/YY') }}</span>
    </div>
</template>

<script>
export default {
    props: ['desde','hasta'],
    data() {
        return {
          moment: moment,
        }
    }
}
</script>

<style lang="scss" scoped>
    .alquileres-fechas {
        font-weight: bold;
        padding : 4px 8px;
        background: #fafafa;
        border-radius: 3px;
        color: #444;
    }
</style>
