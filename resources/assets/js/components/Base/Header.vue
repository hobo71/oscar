<template>
    <div class="d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 text-capitalize"> 
        	<base-back></base-back>
            {{ model }} <span class="badge badge-light badge-pill text-muted mx-2" v-if="total>0">{{total}}</span>
            <button type="button" class="btn btn-sm btn-outline-warning border-0 ml-2 d-print-none " data-toggle="modal" :data-target="'#'+model+'CreateModal'">AGREGAR NUEVO </button>
            <base-print></base-print>

        </h6>
       
        <slot></slot>
    </div>
</template>

<script>
import BaseBack from '../Base/Back'
import BasePrint from '../Base/Print'

export default {
	components : {BaseBack, BasePrint},
    props: ['model', 'total'],
    methods: {
        print() {
            console.log('print')
            window.print()
        }
    }
}
</script>
