<template>
  <v-dialog v-model="show" width="1320" content-class="round">
    <div>
        <v-card class="px-7 pt-1 pb-6">
          <v-row class="mt-5">
            <v-col cols="10">
              <h2 class="Montserrat-Bold text-justify ">
                Agregar Cédula al Expediente N°{{ this.datos.nro_expediente }}
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
              <div class="Montserrat-SemiBold sizeCedula mt-4 mb-1 py-2">
                Ingrese el nuevo número de cédula para el expediente:
              </div>
              <label-error :texto="this.get_error" />
              <text-field class="py-2" v-model="valorCedula" tipo="number"/>

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

    <!--
      <div v-else>
        <v-card class="px-7 pt-1 pb-6">
          <v-row class="mt-5">
            <v-col cols="10">
              <h2 class="Montserrat-Bold text-justify">
                Agregar Cédula al Expediente N°{{ this.datos.nro_expediente }}
              </h2>
            </v-col>
            <v-col cols="2" align="right">
              <v-btn @click="close" icon elevation="0" color="grey lighten-2">
                <v-icon left large color="#393B44">
                  mdi-close-thick
                </v-icon>
              </v-btn>
            </v-col>
          </v-row>

          <v-divider color="#393B44" class="mt-2"></v-divider>

          <div class="Montserrat-Regular sizeCedula mt-4 mb-1 py-2">
              Se ha guardado con éxito
          </div>
        </v-card>
      </div>
    </div>-->
  </v-dialog>
</template>

<script>
import TextField from "../TextField";
import { mapActions, mapGetters } from "vuex";
import LabelError from "../../components/LabelError";

export default {
  name: "ModalNuevaCedula",
  components: { TextField, LabelError },
  props: {
    show: { type: Boolean, default: false },
    datos: Object,
  },

  data() {
    return {
      valorCedula: "",
    };
  },

  computed: mapGetters(["todos_expp",  "getCedula", "get_error"]),

  methods: {
    ...mapActions(["getExpedientes", "storeCedula"]),

    save() {
      let exp = {
        expediente_id: this.datos.id,
        descripcion: this.valorCedula,
        user_id: this.$store.getters.getIdUser,
      };
      this.storeCedula(exp);
    },


    close() {
      this.$emit("close");
      this.$router.go(0);
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

.sizeCedula {
  font-size: 20px !important;
}
</style>
