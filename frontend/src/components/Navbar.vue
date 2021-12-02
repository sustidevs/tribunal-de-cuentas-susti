<template>
  <div v-if="$vuetify.breakpoint.mdOnly || $vuetify.breakpoint.lgOnly || $vuetify.breakpoint.xlOnly" >
    <div class="Montserrat-SemiBold" >
      <v-app-bar class="px-12" height="64" color="#393b44">
        <a href="/"><LogoNavbar/></a>
         <v-row justify="space-between">
        <DropdownMenu titulo="Expedientes" :data-item="expedientes"/>

        <!--<DropdownMenu titulo="Documentos" :data-item="documentos"/>
        <DropdownMenu titulo="Comunicaciones" :data-item="comunicaciones"/>-->
          <!--<MensajeriaNotificacion/>-->
          <DropdownMenuPerfil :nombre="this.$store.getters.getNombreApellido" :cuil="this.$store.getters.getCuil" :area="this.$store.getters.getArea" />
        </v-row>
      </v-app-bar>
    </div>
  </div>
</template>

<script>
import LogoNavbar from './LogoNavbar'
import DropdownMenu from "./DropdownMenu";
import DropdownMenuPerfil from "./DropdownMenuPerfil";
import {mapActions} from "vuex";

export default {
  name: 'Navbar',

  components: {LogoNavbar,DropdownMenu,DropdownMenuPerfil},

  data: () => ({
    expedientes:[ {titulo:'Nuevo', link:'/nuevo-expediente'},{titulo: 'Todos', link:'/expedientes'},{titulo: 'Enviados',link:'/enviados'},{titulo: 'Seguimientos'},{titulo: 'Archivados'}],
    documentos:[ {titulo: 'Normativas'},{titulo: 'Generar'}],
    comunicaciones:[  {titulo: 'Reuniones'},{titulo: 'Novedades'}],
  }),

  methods:{
    ...mapActions(['getApellido', 'getNombre']),
  },

};

</script>
