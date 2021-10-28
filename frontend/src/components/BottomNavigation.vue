<template>
    <v-bottom-navigation background-color="#393b44" color="#FACD89" fixed height="70">
      <div class="Montserrat-SemiBold d-flex flex-row">
          <BottomSheets titulo="Expedientes" icono="mdi-file-document-multiple-outline" :listDesplegable="expedientes"/>
          <BottomSheets titulo="Documentos" icono="mdi-book-outline" :listDesplegable="documentos"/>
        <BottomSheets titulo="Novedades" icono="mdi-chat-alert-outline" :listDesplegable="comunicaciones"/>
      </div>
    </v-bottom-navigation>
</template>

<script>
import BottomSheets from "./BottomSheets";
export default {

  components: {BottomSheets},

  data: () => ({
    expedientes:[{titulo:'Nuevo Expediente', icono:'mdi-file-plus-outline'}, {titulo: 'Todos',icono:'mdi-file-document-multiple-outline'},{titulo: 'Enviados',icono:'mdi-file-upload-outline'},{titulo: 'Seguimientos',icono:'mdi-file-search-outline'},{titulo: 'Archivados',icono:'mdi-file-document-outline'}],
    documentos:[ {titulo: 'Normativas',icono:'mdi-text-box-multiple-outline'},{titulo: 'Generar', icono:'mdi-text-box-plus-outline'}],
    comunicaciones:[  {titulo: 'Reuniones',icono:'mdi-account-supervisor-outline'},{titulo: 'Novedades',icono:'mdi-book-open-blank-variant'}],
  }),
}
</script>
