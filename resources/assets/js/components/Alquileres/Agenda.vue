<template>
    <div>
        <full-calendar :events="events" :config="config"></full-calendar>
    </div>
</template>

<style lang="scss" >
    .fc {
        font-size:.82em;
        .btn-primary {
            border :0;
            background : #ffc107!important;
        }
        .fc-event{ 
            border: 0;
            box-shadow : 0px 1px 3px rgba(0,0,0,.2);
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
         }
    }
</style>

<script>
    import "fullcalendar-scheduler";
    import "fullcalendar/dist/fullcalendar.min.css";
    import "fullcalendar-scheduler/dist/scheduler.min.css";

    import { FullCalendar } from 'vue-full-calendar'
    import apis from './../../apis.ts'

    export default {
        components: { FullCalendar, },
        data() {
            return {
                config: {
                     header: {
                        left: 'prev,next today ',
                        center: 'title',
                        right: 'timelineMonth, timelineWeek, list'
                    },
                    titleFormat:'DD MMMM YYYY',
                        themeSystem: 'bootstrap4',
                    defaultView: 'timelineMonth',
                    buttonText: {
                      today:    'Hoy',
                      month:    'Mes',
                      week:     'Semana',
                      day:      'Día',
                      list:     'Lista'
                    },
                    timezone: 'America/Argentina/Ushuaia',
                    locale : 'es',
                    nowIndicator:true,
                    slotWidth: '15px',
                    slotDuration:'24:00:00',
                    height: 900,
                    editable: false,
                    eventLimit: false,
                    resourceGroupField: 'ciudad',
                    schedulerLicenseKey: 'CC-Attribution-NonCommercial-NoDerivatives',
                    resourceAreaWidth : '15%',
                    resources: {url: this._appApi+'vehiculos', type: 'GET'},
                    eventRender: function(eventObj, $el) {
                      $el.popover({
                        title: 'Alquiler ' + eventObj.title,
                        content: eventObj.description,
                        trigger: 'hover',
                        placement: 'top',
                        container: 'body'
                      });
                    },
                    resourceColumns: [
                        {
                            labelText: 'Vehiculo',
                            field: 'modelo'
                        },
                        {
                            labelText: 'Patente',
                            field: 'patente'
                        }
                    ],
                },
            events: [ ]
            }
        },
        mounted(){
            this.getData();
            console.log(' _appApi ' , this._appApi);
        },
        methods : {
            getData() {
                apis.getAlquileresDataForAgenda()
                    .then( response => {
                        this.events = response.data
                    })
                    .catch(e => console.log(e))
            }

        }
    }
</script>
