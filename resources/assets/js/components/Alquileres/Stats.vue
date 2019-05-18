<template>
    <div>
        <base-single-header model="Estadisticas">
            
		</base-single-header>
        <base-loader v-if="!stats"></base-loader>
        <div v-else>
            <div class="card-deck">
                <div class="card">
                    <div class="card-body">

                        
                        <h4 class="card-title">Anual</h4>
                        <div class="bars d-flex justify-content-around align-items-end">
                            <div v-for="stat in stats.anual" :key="stat.anio" class="bar text-light bg-success rounded small text-center p-1" :style="'height:'+(stat.count/3)+'px;width:'+90/stats.anual.length+'%;'">
                                {{stat.count}}
                            </div>
                        </div>
                        <div class="bars d-flex justify-content-around ">
                            <div v-for="stat in stats.anual" :key="stat.anio" class="text-muted  small text-center p-1" :style="'width:'+90/stats.anual.length+'%;'">
                                {{stat.anio}}
                            </div>
                        </div>
                        
                        <hr>
                        <h4 class="card-title">Mensual <small class="text-muted">A lo largo de los años</small></h4>
                        <div class="bars d-flex justify-content-around align-items-end">
                            <div v-for="stat in stats.mensual" :key="stat.mes" class="bar text-light bg-success rounded small text-center p-1" :style="'height:'+(stat.count*1.5)+'px;width:'+90/stats.mensual.length+'%;'">
                                {{stat.count}}
                            </div>
                        </div>
                        <div class="bars d-flex justify-content-around ">
                            <div v-for="stat in stats.mensual" :key="stat.mes" class="text-muted  small text-center p-1" :style="'width:'+90/stats.mensual.length+'%;'">
                                {{stat.mes}}
                            </div>
                        </div>

                        <hr>
                        <h4 class="card-title">Diario</h4>

                        <div class="bars d-flex justify-content-around align-items-end">
                            <div v-for="stat in stats.diario" :key="stat.dia" class="bar text-light bg-success rounded small text-center p-1" :style="'height:'+(stat.count*2)+'px;width:'+60/stats.diario.length+'%;'">
                            </div>
                        </div>
                        <div class="bars d-flex justify-content-around ">
                            <div v-for="stat in stats.diario" :key="stat.dia" class="text-muted  small text-center " :style="'width:'+90/stats.diario.length+'%;'">
                                {{stat.dia}}
                            </div>
                        </div>

                        <hr>

                        <h4>Por lugares </h4>
                        <h6 class="text-muted">de Devolucion</h6>
                        <div class="progress" >
                            <div 
                            v-for="(stat, index) in stats.lugar_devolucion" 
                            :key="index" 
                            :title="stat.lugar_devolucion + ' ' +stat.count"
                            :class="'progress-bar bg-' + clases[index]" role="progressbar" 
                            :style="'width:' + (stat.count*100)/stats.lugar_devolucion.length+ '%;'" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-around" >
                            <div 
                            v-for="(stat, index) in stats.lugar_devolucion" 
                            :key="index" 
                            class="text-muted text-truncate small text-center "
                            :style="'width:' + (stat.count*100)/stats.lugar_devolucion.length+ '%;'" >{{lugares[stat.lugar_devolucion] }}</div>
                        </div>
                        <h6 class="text-muted">de Entrega</h6>

                        <div class="progress" >
                            <div 
                            v-for="(stat, index) in stats.lugar_entrega" 
                            :key="index" 
                            :title="stat.lugar_entrega + ' ' +stat.count"
                            :class="'progress-bar bg-' + clases[index]" role="progressbar" 
                            :style="'width:' + (stat.count*100)/stats.lugar_entrega.length+ '%;'" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-around" >
                            <div 
                            v-for="(stat, index) in stats.lugar_entrega" 
                            :key="index" 
                            class="text-muted text-truncate small text-center "
                            :style="'width:' + (stat.count*100)/stats.lugar_entrega.length+ '%;'" >{{lugares[stat.lugar_entrega] }}</div>
                        </div>

                        <hr>

                        <h6 class="text-muted">Por formas de pago </h6>
                        <div class="progress" >
                            <div 
                            v-for="(stat, index) in stats.forma_pago" 
                            :key="index" 
                            :title="stat.forma_pago + ' ' +stat.count"
                            :class="'progress-bar bg-' + clases[index]" role="progressbar" 
                            :style="'width:' + (stat.count*100)/stats.forma_pago.length+ '%;'" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-around" >
                            <div 
                            v-for="(stat, index) in stats.forma_pago" 
                            :key="index" 
                            class="text-muted text-truncate small text-center "
                            :style="'width:' + (stat.count*100)/stats.forma_pago.length+ '%;'" >{{forma_pago[stat.forma_pago] }}</div>
                        </div>
                        <hr>

                        <h6 class="text-muted">Por servicios </h6>
                        <div class="progress" >
                            <div 
                            v-for="(stat, index) in stats.servicio" 
                            :key="index" 
                            :title="stat.servicio + ' ' +stat.count"
                            :class="'progress-bar bg-' + clases[index]" role="progressbar" 
                            :style="'width:' + (stat.count*100)/stats.servicio.length+ '%;'" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <div class="d-flex justify-content-around" >
                            <div 
                            v-for="(stat, index) in stats.servicio" 
                            :key="index" 
                            class="text-muted text-truncate small text-center "
                            :style="'width:' + (stat.count*100)/stats.servicio.length+ '%;'" >{{servicios[stat.servicio] }}</div>
                        </div>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Clientes</h4>
                        <table class="table table-sm table-borderless" >
                            <tbody>
                                <tr v-for="stat in stats.clientes" :key="stat.cliente">
                                    <td> <cliente-badge :id="stat.cliente_id" :nombre="stat.cliente"></cliente-badge> </td>
                                    <td > {{ stat.count }} </td> 
                                </tr>
                            </tbody>
                        </table>
                        <hr>
                        <h4 class="card-title">Vehiculos</h4>
                        <table class="table table-sm table-borderless" v-if="stats.vehiculos">
                            <tbody>
                                <tr v-for="stat in stats.vehiculos" :key="stat.vehiculo" >
                                    <td> <vehiculo-patente :patente="stat.patente"></vehiculo-patente> </td>
                                    <td class="text-capitalize">{{ stat.marca_nombre}} <strong>{{ stat.modelo }}</strong></td>
                                    <td > {{ stat.count }} </td> 
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ClienteBadge from '../Clientes/Badge'
import VehiculoBadge from '../Vehiculos/Badge'

export default {
    components : {ClienteBadge, VehiculoBadge},
    data() {
        return {
            stats: null,
            clases : ['danger','success','info','warning','primary','light','dark'],
            lugares : ['Aeropuerto RG' , 'Aeropuerto USH', 'Vicente Lopez 225', 'RGA Parking','Senda Renting','Centro Rio Grande','Centro Ushuaia','Terminal RG','Terminal USH'],
            servicios: ['Senda','Despegar','Otro'],
            forma_pago : ['Efectivo','Tarjeta','Cheque', 'Transferencia','Deposito','A Credito']
        }
    },
    mounted() {
        this.getStats();
    },
    methods: {
        getStats(){
            axios.get(this._appApi+'alquileres/stats')
                .then( response=> {
                    this.stats = response.data
                    console.log(this.stats)
                })
                .catch(e=>console.log(e))
        }
    }
}
</script>

<style>

</style>
