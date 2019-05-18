<template>
    <strong :class="['rounded shadow-sm patente text-uppercase',  { ' nueva ' : patente.length >= 7 },  { ' vieja ' : patente.length == 6 }]">
        {{patente.replace(/ /g,'')}}
    </strong> 
</template>

<script>
export default {
    props: {
        patente :{
            type: String,
            default : ''
        }
    }
}
</script>

<style lang="scss" scoped>
    .patente {
        text-align: center;
        letter-spacing: 0.04em;
        // font-family: monospace;
        font-size: .75em;
        height: 32px;
        width: 68px;
        display: inline-block;
    }
        .nueva {
            background: #f9f9f9;
            padding : 5px 1px;
            color : #000;
            border-top: 6px solid #007bff;
        }
        .vieja {
            background: #000;
            color : #fff;
            padding: 3px 1px 0px 1px;
            border-top: 6px solid #f3f3f3;
            border-bottom:4px solid #f3f3f3;

        }

</style>
