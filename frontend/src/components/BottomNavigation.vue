<template>
    <v-bottom-navigation background-color="#393b44" color="#FACD89" fixed height="70">
      <div class="Montserrat-SemiBold d-flex flex-row">
          <BottomSheets titulo="BANDEJAS" icono="mdi-inbox-full" :listDesplegable="bandejas"/>
          <BottomSheets titulo="EXPEDIENTES" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientes"/>
        <BottomSheets titulo="INICIADORES" icono="mdi-account-group" :listDesplegable="iniciadores"/>
      </div>
    </v-bottom-navigation>
</template>

<script>
import BottomSheets from "./BottomSheets";
export default {

  components: {BottomSheets},

  data: () => ({
    bandejas:[{titulo:'Pendientes', icono:'mdi-bell-outline', link:"/expedientes-pendientes"}, {titulo: 'Expedientes', icono:'mdi-file-document-multiple-outline', link:"/expedientes"},{titulo: 'Historial Enviados', icono:'mdi-file-send-outline', link:"/historial-enviados"}],
    expedientes:[ {titulo: 'Nuevo', icono:'mdi-text-box-plus-outline', link:"/nuevo-expediente"},{titulo: 'Pase', icono:'mdi-file-send-outline', link:"/mis-expedientes"},{titulo: 'Recuperar', icono:'mdi-arrow-u-left-top', link:"/recuperar"},{titulo: 'Añadir Cédula', icono:'mdi-card-account-details-outline', link:"/cedula"}],
    iniciadores:[  {titulo: 'Nuevo', icono:'mdi-account-plus-outline', link:"/nuevo-iniciador"},{titulo: 'Ver Todos', icono:'mdi-account-group', link:"/iniciadores"}],
  }),
}
</script>