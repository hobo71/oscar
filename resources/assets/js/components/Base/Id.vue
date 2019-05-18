<template>
    <span class="badge badge-light">#{{ number(numberId) }}</span>
</template>

<script>
export default {
    props: {
        numberId : {
            type: Number,
            default : 0
        }
    },
    methods : {
        number (n) {
            if (n<=99999) { 
                n = ("0000"+n).slice(-5); 
            }
            return n;
        }
    }
}
</script>

<style scoped>
.badge {
    font-family: 'Courier New', Courier, monospace;
    font-size: .8em;
    letter-spacing: 0.04em;
    /* border:1px solid lightgrey; */
}

</style>
