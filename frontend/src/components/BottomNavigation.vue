<template>
    <v-bottom-navigation background-color="#393b44" color="#FACD89" fixed height="70">
      <div v-if="get_user.area === 'DPTO. MESA DE ENTRADAS Y SALIDAS'" class="Montserrat-SemiBold d-flex flex-row">
        <BottomSheets titulo="BANDEJAS" icono="mdi-inbox-full" :listDesplegable="bandejas"/>
        <BottomSheets titulo="EXPEDIENTES" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientesMesaEntrada"/>
        <BottomSheets titulo="INICIADORES" icono="mdi-account-group-outline" :listDesplegable="iniciadores"/>
      </div>

      <div v-if="(get_user.area === 'VOCALIA A') || (get_user.area === 'VOCALIA B') || (get_user.area === 'VOCALIA C') || (get_user.area === 'VOCALIA D') || (get_user.area === 'RELATORIA A') || (get_user.area === 'RELATORIA B') || (get_user.area === 'RELATORIA C') || (get_user.area === 'RELATORIA D')" class="Montserrat-SemiBold d-flex flex-row">
        <BottomSheets titulo="BANDEJAS" icono="mdi-inbox-full" :listDesplegable="bandejas"/>
        <BottomSheets titulo="EXPEDIENTES" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientesRelatoriasyVocalias"/>
      </div>

      <div v-if="get_user.area === 'DIRECCIÓN DE REGISTRACIONES'" class="Montserrat-SemiBold d-flex flex-row">
        <BottomSheets titulo="BANDEJAS" icono="mdi-inbox-full" :listDesplegable="bandejas"/>
        <BottomSheets titulo="EXPEDIENTES" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientesMesaEntrada"/>
        <BottomSheets titulo="INICIADORES" icono="mdi-account-group-outline" :listDesplegable="iniciadores"/>
      </div>

      <div v-if="get_user.area === 'DIRECCIÓN DE INFORMATICA'" class="Montserrat-SemiBold d-flex flex-row">
        <BottomSheets titulo="BANDEJAS" icono="mdi-inbox-full" :listDesplegable="bandejas"/>
        <BottomSheets titulo="EXPEDIENTES" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientes"/>
        <BottomSheets titulo="INICIADORES" icono="mdi-account-group-outline" :listDesplegable="iniciadores"/>
      </div>

      <div v-if="(get_user.area === 'SECRETARIA GENERAL TECNICA') || (get_user.area === 'SECRETARIA GENERAL ADMINISTRATIVA') || (get_user.area === 'ASESORIA LEGAL') || (get_user.area === 'DIRECCIÓN DE PERSONAL') || (get_user.area === 'DPTO. DE ADMINISTRACIÓN') || (get_user.area === 'DEPARTAMENTO FALLOS') || (get_user.area === 'ARCHIVO') || (get_user.area === 'DPTO. NOTIFICACIONES') || (get_user.area === 'AUDITORIA A') || (get_user.area === 'AUDITORIA B') || (get_user.area === 'AUDITORIA C') || (get_user.area === 'AUDITORIA D') || (get_user.area === 'PRESIDENCIA') || (get_user.area === 'MAESTRANZA')" class="Montserrat-SemiBold d-flex flex-row">
        <BottomSheets titulo="BANDEJAS" icono="mdi-inbox-full" :listDesplegable="bandejas"/>
        <BottomSheets titulo="EXPEDIENTES" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientes"/>
      </div>
    </v-bottom-navigation>
</template>

<script>
import BottomSheets from "./BottomSheets";
import {mapGetters} from "vuex";
export default {

  components: {BottomSheets},

  data: () => ({
    bandejas:[{titulo:'Pendientes', icono:'mdi-bell-outline', link:"/expedientes-pendientes"}, {titulo: 'Expedientes', icono:'mdi-file-document-multiple-outline', link:"/expedientes"},{titulo: 'Historial Enviados', icono:'mdi-file-send-outline', link:"/historial-enviados"}],
    expedientes:[ {titulo: 'Nuevo', icono:'mdi-text-box-plus-outline', link:"/nuevo-expediente"},{titulo: 'Pase', icono:'mdi-file-send-outline', link:"/mis-expedientes"},{titulo: 'Recuperar', icono:'mdi-arrow-u-left-top', link:"/recuperar"},{titulo: 'Añadir Cédula', icono:'mdi-card-account-details-outline', link:"/cedula"}],
    iniciadores:[  {titulo: 'Nuevo', icono:'mdi-account-plus-outline', link:"/nuevo-iniciador"},{titulo: 'Ver Todos', icono:'mdi-account-group-outline', link:"/iniciadores"}],

    expedientesMesaEntrada:[ {titulo: 'Nuevo', icono:'mdi-text-box-plus-outline', link:'/nuevo-expediente'},{titulo: 'Pase', icono:'mdi-file-send-outline', link:'/mis-expedientes'}, {titulo: 'Recuperar', icono:'mdi-arrow-u-left-top', link:'/recuperar'}, {titulo: 'Añadir cédula', icono:'mdi-card-account-details-outline', link:'/cedula'}],
    expedientesRelatoriasyVocalias:[ {titulo: 'Pase', icono:'mdi-file-send-outline', link:'/mis-expedientes'}, {titulo: 'Recuperar', icono:'mdi-arrow-u-left-top', link:'/recuperar'}, {titulo: 'Desglose', icono:'mdi-file-percent-outline', link:'/desglose'}, {titulo: 'Englose', icono:'mdi-text-box-plus-outline', link:'/englose'}],
  }),

  computed: mapGetters(['get_user']),
}
</script>