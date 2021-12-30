<template>
  <v-dialog v-model="show" width="1200px" content-class="round" persistent>
    <v-card class="px-7 pt-1">
      <v-row class="mt-5 mb-2">
        <v-col cols="12" xl="10" lg="6" sm="10" xs="12">
          <h2 class="Montserrat-Bold text-justify">
            Expediente N° {{ datos.nro_expediente }}
          </h2>
        </v-col>
        <v-col cols="12" xl="2" lg="6" sm="2" xs="12" align="right">
          <v-btn @click="close" icon elevation="0" color="grey lighten-2">
            <v-icon color="#393B44" large>mdi-file-document</v-icon>
          </v-btn>
        </v-col>
      </v-row>

      <v-card rounded class="pa-4" color="#EEEEEE">
        <v-row no-gutters align="start">
          <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
            <div
                class="textHereSmall d-flex flex-column Montserrat-Bold mb-2 mr-2"
            >
              Extracto:
            </div>
            <div
                class="textHereSmall d-flex flex-column Montserrat-Regular text-justify"
            >
              {{datos.extracto }}
            </div>
          </v-col>
        </v-row>

        <v-row no-gutters align="start">
          <v-col lg="7" sm="12" xs="12">
            <div class="d-flex pt-6">
              <div class="textHereSmall Montserrat-Bold mr-1">Iniciador:</div>
              <div class="textHereSmall Montserrat-Regular ml-1">
                {{ datos.iniciador }}
              </div>
            </div>
          </v-col>
          <v-col lg="5" sm="12" xs="12">
            <div class="d-flex pt-6">
              <div class="textHereSmall Montserrat-Bold mr-1">
                Fecha de creación:
              </div>
              <div class="textHereSmall Montserrat-Regular ml-1">
                {{ datos.fecha_creacion }}
              </div>
            </div>
          </v-col>
        </v-row>


        <v-row no-gutters align="start" class="mt-5">
            <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2 mr-2" >
              Observaciones:
            </div>
            <div
                class="textHereSmall d-flex flex-column Montserrat-Regular text-justify"
            >
              {{ datos.observacion }}
            </div>
        </v-row>
      </v-card>


      <v-row no-gutters align="start" class="mt-5">

        <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2 mr-2">
          A efectos de:
        </div>

        <div v-if="datos.observacion_pase === null">
          <div class="textHereSmall d-flex flex-column Montserrat-Regular text-justify">
            No se agregaron comentarios
          </div>
        </div>

        <div class="textHereSmall d-flex flex-column Montserrat-Regular text-justify" v-else>
            {{ datos.observacion_pase }}
        </div>
      </v-row>


      <v-row no-gutters align="start" class="mt-5">
        <v-col>
          <div class="d-flex">
            <div class="textHereSmall Montserrat-Bold mr-2">
              Archivos adjuntos:
            </div>
            <div v-if="datos.archivo !== null">
              <v-chip
                class="textHereSmall Montserrat-Regular"
                @click="getArchiv()"
              >
                Descargar</v-chip
              >
            </div>
            <div
              v-else
              class="textHereSmall d-flex flex-column Montserrat-Regular text-justify"
            >
              No se han cargado archivos
            </div>
          </div>
        </v-col>
      </v-row>

      <v-row no-gutters justify="center" class="mt-8">
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
            @click="close"
            class="pa-5 color Montserrat-SemiBold"
            height="55"
            elevation="0"
            color="#FACD89"
            block
          >
            <v-icon class="px-5"> mdi-close </v-icon>
            Cerrar
          </v-btn>
        </v-col>
      </v-row>
    </v-card>
  </v-dialog>
</template>
<script>
import { mapActions, mapGetters } from "vuex";
export default {
  name: "ModalVerDetalleExp",
  props: {
    show: { type: Boolean, default: false },
    datos: Object,
  },

  computed: mapGetters(['get_user']),

  methods: {
    ...mapActions(['getArchivos']),

    getArchiv() {
      let files = {
        id: this.datos.expediente_id,
        download: true,
        nro_expediente: this.datos.nro_expediente,
      };
      this.getArchivos(files);
    },
    close() {
      this.$emit("close");
    },
  },
};
</script>
