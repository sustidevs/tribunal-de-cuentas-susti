<template>
  <div v-if="$vuetify.breakpoint.mdOnly || $vuetify.breakpoint.lgOnly || $vuetify.breakpoint.xlOnly" >
    <div class="Montserrat-SemiBold" >
      <v-app-bar class="px-12" height="74" color="#393b44">
        <v-row no-gutters>
          <v-col cols="12" lg="3" align="start" align-self="center">
            <a href="/"><LogoNavbar/></a>
          </v-col>

            <v-col cols="12" lg="6" align="center" align-self="center">
              <div v-if="getArea === 'DPTO. MESA DE ENTRADAS Y SALIDAS'">
                <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
                <DropdownMenu titulo="Expedientes" :data-item="expedientesMesaEntrada"/>
                <DropdownMenu titulo="Iniciadores" :data-item="iniciadores"/>
              </div>

              <div v-if="(getArea === 'VOCALIA A') || (getArea === 'VOCALIA B') || (getArea === 'VOCALIA C') || (getArea === 'VOCALIA D') || (getArea === 'RELATORIA A') || (getArea === 'RELATORIA B') || (getArea === 'RELATORIA C') || (getArea === 'RELATORIA D')" cols="12" lg="6" align="center" align-self="center">
                <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
                <DropdownMenu titulo="Expedientes" :data-item="expedientesRelatoriasyVocalias"/>
              </div>

              <div v-if="getArea === 'DIRECCIÓN DE REGISTRACIONES'" cols="12" lg="6" align="center" align-self="center">
                <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
                <DropdownMenu titulo="Expedientes" :data-item="expedientesMesaEntrada"/>
                <DropdownMenu titulo="Iniciadores" :data-item="iniciadores"/>
              </div>

              <div v-if="getArea === 'DIRECCIÓN DE INFORMATICA'" cols="12" lg="6" align="center" align-self="center">
                <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
                <DropdownMenu titulo="Expedientes" :data-item="expedientes"/>
                <DropdownMenu titulo="Iniciadores" :data-item="iniciadores"/>
              </div>

              <div v-if="(getArea === 'SECRETARIA GENERAL TECNICA') || (getArea === 'SECRETARIA GENERAL ADMINISTRATIVA') || (getArea === 'ASESORIA LEGAL') || (getArea === 'DIRECCIÓN DE PERSONAL') || (getArea === 'DPTO. DE ADMINISTRACIÓN') || (getArea === 'DEPARTAMENTO FALLOS') || (getArea === 'ARCHIVO') || (getArea === 'DPTO. NOTIFICACIONES') || (getArea === 'DPTO. DE ADMINISTRACIÓN') || (getArea === 'AUDITORIA A') || (getArea === 'AUDITORIA B') || (getArea === 'AUDITORIA C') || (getArea === 'AUDITORIA D') || (getArea === 'PRESIDENCIA') || (getArea === 'MAESTRANZA') " cols="12" lg="6" align="center" align-self="center">
                <DropdownMenu titulo="Bandejas" :data-item="bandejas"/>
                <DropdownMenu titulo="Expedientes" :data-item="expedientes"/>
              </div>
            </v-col>

          <v-col cols="12" lg="3" align="end" align-self="center">
            <DropdownMenuPerfil :nombre="this.$store.getters.getNombreApellido" :cuil="this.$store.getters.getCuil" :area="this.$store.getters.getArea" />
          </v-col>
        </v-row>
      </v-app-bar>


    </div>
  </div>
</template>

<script>
import LogoNavbar from './LogoNavbar'
import DropdownMenu from "./DropdownMenu";
import DropdownMenuPerfil from "./DropdownMenuPerfil";
import {mapGetters} from "vuex";

export default {
  name: 'Navbar',

  components: {LogoNavbar,DropdownMenu,DropdownMenuPerfil},

  data: () => ({
    bandejas:[ {titulo:'Pendientes', link:'/expedientes-pendientes'},{titulo: 'Expedientes', link:'/expedientes'},{titulo: 'Enviados',link:'/mis-enviados'}],
    expedientes:[ {titulo: 'Nuevo Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}],
    expedientesMesaEntrada:[ {titulo: 'Nuevo', link:'/nuevo-expediente'},{titulo: 'Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}, {titulo: 'Añadir cedula', link:'/cedula'}],
    expedientesRelatoriasyVocalias:[ {titulo: 'Nuevo Pase', link:'/mis-expedientes'}, {titulo: 'Recuperar', link:'/recuperar'}, {titulo: 'Desglose', link:'/desglose'}, {titulo: 'Englose', link:'/englose'}],
    iniciadores:[  {titulo: 'Nuevo', link:'/nuevo-iniciador'} , {titulo: 'Ver todos', link:'/iniciadores'}],
  }),


  computed: mapGetters(['getArea']),

};

</script>
