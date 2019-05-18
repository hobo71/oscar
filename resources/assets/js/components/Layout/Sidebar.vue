<template>
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky d-flex flex-column justify-content-between shadow-lg">
        <ul class="nav flex-column">
            <li class="nav-item" v-for="(link,index) in links" :key="index"><router-link class="nav-link" :to="link.link"><i :class="'fa fa-btn fa-fw '+link.icon"></i>{{link.name}}</router-link></li>
        </ul>
        <div class="">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Mas Acciones</span>
                <a class="d-flex align-items-center text-muted" href="#">
                    <span data-feather="plus-circle"></span>
                </a>
            </h6>
            <ul class="nav flex-column mb-2">
                <li class="nav-item"><a target="_blank" class="nav-link" href="/vehiculos/slide"><i class="fa fa-btn fa-fw fa-play"></i>Ver Autos</a>                </li>
                <li class="nav-item"><a class="nav-link" href="/options"><i class="fa fa-btn fa-fw fa-cog"></i>Opciones</a></li>
                <!-- <li><a style="color:#444;" class="nav-link" href="/logout"><i class="fa fa-btn fa-fw fa-sign-out"></i>Salir</a></li>
                <li class="nav-item"><a class="nav-link" href="/login">Ingresar</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Registrarse</a></li> -->
            </ul>
        </div>
    </div>
</nav>
</template>

<script>
export default {
    data(){
        return {
            links : [
                {name: 'Agenda',icon:'fa-calendar',link:'/agenda'},
                {name: 'Alquileres',icon:'fa-list-alt',link:'/alquileres'},
                {name: 'Vehiculos',icon:'fa-car',link:'/vehiculos'},
                {name: 'Clientes',icon:'fa-address-book',link:'/clientes'},
                {name: 'Empresas',icon:'fa-suitcase',link:'/empresas'},
                {name: 'Services',icon:'fa-wrench',link:'/services'},
                {name: 'Estadisticas',icon:'fa-bars',link:'/stats'},
            ]
        }
    }

}
</script>

<style>

</style>
