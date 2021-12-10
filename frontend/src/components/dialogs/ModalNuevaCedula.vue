<template>
  <v-dialog v-model="show" width="1320" content-class="round">
    <div>
      <v-card class="px-7 pt-1 pb-6">
        <!-- {{ datos }} -->
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify ">
              Agregar Cedula al Expediente N°{{ this.datos.nro_expediente }}
            </h2>
          </v-col>
          <v-col cols="2" align="right">
            <v-btn @click="close" icon elevation="0" color="grey lighten-2">
              <v-icon left large color="#393B44"> mdi-close-thick </v-icon>
            </v-btn>
          </v-col>
        </v-row>

        <v-divider color="#393B44" class="mt-2"></v-divider>

        <v-row no-gutters class="py-5">
          <v-col cols="12" sm="12" lg="12">
            <div class="fontSmall Montserrat-SemiBold mr-3">Extracto:</div>
          </v-col>
          <v-col cols="12" sm="12" lg="12" align="center">
            <div class="fontSmall Montserrat-Regular text-justify">
              {{ this.datos.extracto }}
            </div>
          </v-col>
        </v-row>

        <form>
          <div>
            <div class="Montserrat-SemiBold mt-4 mb-1 py-2">
              Ingrese el nuevo número de cedula para el expediente:
            </div>
            <text-field v-model="valorCedula" />

            <v-row no-gutters justify="center" class="py-2">
              <v-col cols="12" lg="6" class="px-sm-2 py-3">
                <v-btn
                  @click="save()"
                  class="pa-5 color Montserrat-SemiBold"
                  height="55"
                  color="#FACD89"
                  block
                >
                  <v-icon class="pr-4"> mdi-content-save </v-icon>
                  Guardar
                </v-btn>
              </v-col>
            </v-row>
          </div>
        </form>
      </v-card>
    </div>
  </v-dialog>
</template>

<script>
import TextField from "../TextField";
import { mapActions, mapGetters } from "vuex";

export default {
  name: "ModalNuevaCedula",
  components: { TextField },
  props: {
    show: { type: Boolean, default: false },
    datos: Object,
  },

  data() {
    return {
      valorCedula: "",
    };
  },

  computed: mapGetters(["todos_expp", "get_finalizado", "getCedula"]),

  methods: {
    ...mapActions(["getExpedientes", "storeCedula"]),

    save() {
      let exp = {
        expediente_id: this.datos.id,
        descripcion: this.valorCedula,
      };
      this.storeCedula(exp);
    },

    close() {
      this.$emit("close");
    },
  },
};
</script>

<style>
.textRadio {
  font-family: Montserrat-Bold, serif;
  font-size: 15px !important;
}

.sizeNroExp {
  font-size: 20px !important;
}
</style>
