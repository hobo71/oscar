<template>
    <nav class="navbar navbar-dark sticky-top bg-warning flex-md-nowrap p-0 shadow-sm">
        <router-link class="navbar-brand col-sm-3 col-md-2 mr-0" to="/"><img src="img/logo.png" ></router-link>

        <input class="form-control form-control-dark w-100" type="text" placeholder="Buscar" aria-label="Search"
        v-on:keyup.enter="search()" v-model="query">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
                <router-link class="nav-link" to="/signout">Salir</router-link>
            </li>
        </ul>

    </nav>
</template>

<script>
export default {
    name:'Navbar',
    data(){
        return {
            query: null
        }
    },
    
    methods: {
        search(){
            this.$root.$emit('newSearch',this.query)
            this.$router.replace({ name: 'SearchResults', params : {query : this.query} })
            this.query = null
        }
    }

}
</script>

<style>

</style>
