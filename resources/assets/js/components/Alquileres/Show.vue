<template>
  <div>
    <base-loader v-if="!alquiler && !marcas"></base-loader>
    <div v-else id="printable">
      <alquiler-edit :alquiler-data="alquiler"></alquiler-edit>
        <div class="py-4 d-flex justify-content-between align-items-center ">
          
            <h4 class="card-title mb-0">
              <base-back></base-back> 
              Voucher <id-badge :number-id="alquiler.id"></id-badge>
              <base-print></base-print>
            </h4>
            <address class="m-0 p-0 text-right text-muted small">
              Fecha de creación: {{ alquiler.created_at}}<br>
              Fecha de modificacion: {{ alquiler.updated_at}}
              </address>
        </div>
      <div class="row">
        <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
          <div class="card mb-3" >
            <div class="card-body">
              <h5 class="text-warning card-title">Itinerario</h5>
                <alquiler-fechas class="lead bg-warning my-3 p-3" :desde="alquiler.fecha_entrega" :hasta="alquiler.fecha_devolucion"></alquiler-fechas>
                <div class="d-flex justify-content-between align-items-center mb-3">
                  <h6 class="m-0 text-muted"> {{ datas.lugares[alquiler.lugar_entrega] }} - {{alquiler.hora_entrega}} </h6>
                  <h6 class="m-0 text-muted text-right"> {{ datas.lugares[alquiler.lugar_devolucion] }} - {{alquiler.hora_devolucion }} </h6>
                </div>
              <hr>

              <dl class=" row mb-2">
                  <dt class="col-6">Estado</dt>
                  <dd class="col-6 lead" v-html="estado(moment(alquiler.fecha_entrega),moment(alquiler.fecha_devolucion))"></dd>
                  <dt class="col-6">Servicio</dt>
                  <dd class="col-6">{{ alquiler.servicio }}</dd>
                  <dt class="col-6">Forma de Pago</dt>
                  <dd class="col-6">{{ alquiler.forma_pago }}</dd>
                  <dt class="col-6">Días</dt>
                  <dd class="col-6"><h4 class="m-0">{{ dias }}</h4></dd>
                  <dt class="col-6">Descuento</dt>
                  <dd class="col-6"><h4 class="m-0">{{ alquiler.descuento }}%</h4></dd>
                  <dt class="col-6">Cotización <small class="text-muted ml-2"> al momento</small></dt>
                  <dd class="col-6"><h4 class="m-0">${{ alquiler.cotizacion }}</h4></dd>
              </dl>
            </div>
            <div class="card-footer" v-if="alquiler.observaciones">
              <h6>Observaciones</h6>
              <p class="text-muted white-space-pre" >{{ alquiler.observaciones || 'Sin observaciones.'}}</p>
            </div>

          </div>
        </div>

        <div class="col-xl-4 col-lg-6 col-md-7 col-sm-7 col-xs-6 ">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title text-warning">Vehiculo</h5>
              <vehiculo-badge :vehiculo="alquiler.vehiculo" ></vehiculo-badge>
              <hr>
            
                <dl class=" row">
                  <!-- <dt class="col-5">Kilometraje</dt>
                  <dd class="col-7">{{ alquiler.vehiculo.kilometros || ''}}</dd> -->
                  <dt class="col-5">Modelo</dt>
                  <dd class="col-7">{{ alquiler.vehiculo.anio || ''}}</dd>
                  <dt class="col-5">Clase</dt>
                  <dd class="col-7">{{ alquiler.vehiculo.clase || ''}}</dd>
                  <dt class="col-5">Puertas</dt>
                  <dd class="col-7">{{ alquiler.vehiculo.puertas || ''}}</dd>
                  <!-- <dt class="col-5">Cubiertas</dt>
                  <dd class="col-7">{{ alquiler.vehiculo.cubiertas || ''}}</dd> -->
                  <dt class="col-5">Ciudad</dt>
                  <dd class="col-7">{{ datas.ciudades[alquiler.vehiculo.ciudad]}}</dd>
                  <!-- <dt class="col-5">Seguro</dt>
                  <dd class="col-7"><vehiculo-fecha :fecha="alquiler.vehiculo.vto_seguro"></vehiculo-fecha></dd>
                  <dt class="col-5">RTO</dt>
                  <dd class="col-7"><vehiculo-fecha :fecha="alquiler.vehiculo.vto_rto"></vehiculo-fecha></dd>
                  <dt class="col-5">Habilitacion</dt>
                  <dd class="col-7"><vehiculo-fecha :fecha="alquiler.vehiculo.vto_habilitacion"></vehiculo-fecha></dd> -->
              </dl>
            </div>
            <!-- <div class="card-footer" v-if="alquiler.vehiculo.observaciones">
              <h6>Observaciones</h6>
              <p class="text-muted white-space-pre">{{ alquiler.vehiculo.observaciones || 'Sin observaciones.'}}</p>
            </div> -->
          </div>
        </div>

        <div class="col-xl-3 col-lg-6 col-md-5 col-sm-5 col-xs-6 ">
          <div class="card">
            <div class="card-body" v-if="alquiler.cliente">
              <h5 class="card-title text-warning">Cliente</h5>
              <cliente-badge :id="alquiler.cliente.id" :nombre="alquiler.cliente.apellido + ', ' + alquiler.cliente.nombre" size="lg" ></cliente-badge>
              <hr>
              <dl class=" row">
                  <dt class="col-5">DNI</dt>
                  <dd class="col-7">{{ alquiler.cliente.dni || ''}}</dd>
                  <dt class="col-5">Telefono</dt>
                  <dd class="col-7">{{ alquiler.cliente.telefono || ''}}</dd>
                  <dt class="col-5">Email</dt>
                  <dd class="col-7">{{ alquiler.cliente.email || ''}}</dd>
                  <dt class="col-5">Empresa</dt>
                  <dd class="col-7">{{ alquiler.cliente.empresa_id || ''}}</dd>
                  <dt class="col-5">Domicilio</dt>
                  <dd class="col-7">{{ alquiler.cliente.domicilio ||  alquiler.cliente.domicilio_temporal}}</dd>
              </dl>
            </div>
            <!-- <div class="card-footer" v-if="alquiler.cliente.observaciones">
              <h6>Observaciones</h6>
              <p class="text-muted white-space-pre">{{ alquiler.cliente.observaciones || 'Sin observaciones.'}}</p>
            </div> -->
          </div>
        </div>
        
      </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-warning border-0 mt-2 d-print-none" data-toggle="modal" :data-target="'#alquileresEditModal'">Editar </button>
    <button type="button" class="btn btn-sm btn-outline-danger border-0 mt-2 d-print-none" v-on:click.prevent="destroy()" >Eliminar </button>

  </div>
</template>

<script>
import apis from "../../apis.ts";
import ClienteBadge from "../Clientes/Badge";
import VehiculoBadge from "../Vehiculos/Badge";
import VehiculoFecha from "../Vehiculos/Fecha";
import AlquilerEdit from './Edit'
import BaseBack from '../Base/Back'
import BasePrint from '../Base/Print'

export default {
  components: { ClienteBadge, VehiculoBadge, VehiculoFecha , AlquilerEdit, BaseBack, BasePrint},

  data() {
    return {
      marcas: null,
      alquiler: null,
      datas: null,
      moment: moment
    };
  },
  computed:{
    dias() {
      return moment(this.alquiler.fecha_devolucion, "YYYY-MM-DD").diff(
        moment(this.alquiler.fecha_entrega, "YYYY-MM-DD"),
        "days"
      ) ;
    },
  },

  created() {
        this.$nextTick(() => {
          $('.popover').hide()
          console.log('$(".popover") ' ,  $('.popover'));
        });
    axios
      .all([this.getMarcas(), this.getAlquiler(), this.getData()])
      .then(
        axios.spread((marcas, alquiler,data) => {
          this.marcas = marcas.data;
          this.alquiler = alquiler.data[0];
          this.datas = data.data;
        })
      )
      .catch(e => console.log(e));
  },
  mounted(){
    $().tooltip('hide')
    this.$nextTick(() => {
        $().tooltip('hide')
    });
  },
  methods: {
    destroy(){
      axios
        .delete(this._appApi+"alquileres/" + this.$route.params.id)
          .then(response => {
            console.log(response)
            this.$router.push('/alquileres')
          })
          .catch(e=>console.log(e))
    },
    getMarcas() {
      return axios.get(this._appApi+"marcas");
    },
    getData() {
      return axios.get(this._appApi+"data");
    },
    getAlquiler() {
      return axios.get(this._appApi+"alquileres/" + this.$route.params.id);
    },
    estado(start, end) {
      if (moment().isBetween(start, end.add(1, "day"))) {
        return '<span class="badge badge-warning">ACTUAL</span>';
      } else if (start.isSameOrAfter()) {
        return '<span class="badge badge-success">PROXIMO</span>';
      } else if (end.isSameOrBefore()) {
        return '<span class="badge badge-dark">TERMINADO</span>';
      }
    }
  }
};
</script>

<style lang="scss" scoped>
  dl {
    dt,dd {
      min-height: 40px;
      display: flex;
      align-items: center;
      padding : 1em 1em;
    }
    dd {
      display: flex;
      justify-content: flex-end;
      text-align: right;
      align-items: center;
      border-bottom: 1px dashed rgba(#ffc107,.4);
      margin: 0;
    }
  }



</style>
