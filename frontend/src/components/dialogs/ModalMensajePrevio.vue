<template>
<!-- Falta conexion a la hora de poder crear un expedinte -->
  <v-dialog v-model="show" width="1200px" content-class="round" persistent>
    <v-card class="px-7 pt-1 text-center">
      <titulo texto="Por favor revise sus datos antes de continuar." />

      <div class="textHereSmall text-center Montserrat-Regular my-4 mr-2">
        <v-card rounded class="pa-4 text-responsive" color="#EEEEEE">
          <v-row no-gutters align="start">
            <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
              <div class="d-flex flex-column pb-6">
                <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                  Iniciador:
                </div>
                <div class="textHereSmall Montserrat-Regular ml-1">
                  {{ iniciador().nombre }}
                </div>
              </div>
            </v-col>

            <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
              <div class="d-flex flex-column pb-6">
                <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                  Motivo:
                </div>
                <div class="textHereSmall Montserrat-Regular ml-1">
                  {{ motivo().descripcion }}
                </div>
              </div>
            </v-col>

            <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
              <div class="d-flex flex-column pb-6">
                <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                  Extracto:
                </div>
                <div class="textHereSmall Montserrat-Regular ml-1">
                  {{ extracto }}
                </div>
              </div>
            </v-col>

            <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
              <div class="d-flex flex-column pb-6">
                <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                  Cantidad de Fojas:
                </div>
                <div class="textHereSmall Montserrat-Regular ml-1">
                  {{ dato.nro_fojas }}
                </div>
              </div>
            </v-col>

            <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
              <div class="d-flex flex-column pb-6">
                <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                  Observaciones:
                </div>
                <div
                  class="textHereSmall text-uppercase Montserrat-Regular ml-1"
                >
                  {{ dato.observacion }}
                </div>
              </div>
            </v-col>

            <v-col cols="12" xl="12" lg="12" sm="12" xs="12">
              <div class="d-flex flex-column pb-6">
                <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                  Pase a:
                </div>
                <div class="textHereSmall Montserrat-Regular ml-1">
                  {{ pasea().nombre }}
                </div>
              </div>
            </v-col>
          </v-row>
        </v-card>
      </div>

      <v-row no-gutters justify="center" class="mt-6">
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
            @click="close"
            class="pa-5 color Montserrat-SemiBold"
            height="55"
            elevation="0"
            color="#FACD89"
            block
          >
            Aceptar
          </v-btn>
        </v-col>
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
            @click="close"
            class="pa-5 color Montserrat-SemiBold"
            height="55"
            elevation="0"
            color="#FACD89"
            block
          >
            <v-icon class="px-5"> mdi-close-thick </v-icon>
            Modificar
          </v-btn>
        </v-col>
      </v-row>
    </v-card>
  </v-dialog>
</template>

<script>
import Titulo from "../../components/Titulo";
import { mapActions, mapGetters } from "vuex";

export default {
  name: "ModalMensajePrevio",
  components: { Titulo },
  props: {
    show: Boolean,
    dato: Object,
  },

  computed: {
    ...mapGetters([
      "get_user",
      "allIniciadores",
      "get_iniciadorSelected",
      "extracto",
      "motivoSinExtracto",
      "get_areas_all",
      "get_motivo_selected",
      "get_motivo_selected"
    ]),
    
    iniciador: function () {
      return this.allIniciadores.find(
        (item) => item.id === this.get_motivo_selected
      );
    },

    motivo: function () {
      return this.motivoSinExtracto.find(
        (item) => item.id === this.get_motivo_selected
      );
    },
    pasea: function () {
      return this.get_areas_all.find((item) => item.id === this.dato.area_id);
    },
  },

  methods: {
    ...mapActions(["getArchivos"]),

    close() {
      this.$emit("close");
    },
  },

  extracto: {
    get() {
      return this.$store.getters.extracto;
    },
  },
};
</script>
