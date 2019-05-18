<template>
    <div class="d-flex justify-content-between align-items-center py-3">
        <h6 class="m-0 text-capitalize"> {{ model }} </h6>
            <base-print></base-print>

        <slot></slot>
    </div>
</template>

<script>
import BasePrint from '../Base/Print'

export default {
    props: ['model'],
    components: {BasePrint}
}
</script>
