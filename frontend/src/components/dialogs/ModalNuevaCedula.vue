<template>
  <v-dialog v-model="show" width="1320" content-class="round">
    <div>
      <v-card class="px-7 pt-1 pb-6">
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify">Agregar Cedula</h2>
          </v-col>
          <v-col cols="2" align="right">
            <v-btn @click="close" icon elevation="0" color="grey lighten-2">
              <v-icon left large color="#393B44"> mdi-close-thick </v-icon>
            </v-btn>
          </v-col>
        </v-row>

        <v-divider color="#393B44" class="mt-2"></v-divider>

        <form >
          <div class="descripcion mt-4 py-2">
            Ingrese el nuevo número de cedula para el expediente:
          </div>

          <div>
            <div class="Montserrat-SemiBold mt-2 mb-1 py-2">
              Número de Cedula:
            </div>
            <text-field  v-model="cedula.valor"/>
            <v-row justify="center" class="pb-6">
              <v-btn
                type="submit"
                class="pa-5 color Montserrat-SemiBold"
                height="45"
                color="#FACD89"
              >
                <v-icon class="pr-4"> mdi-content-save </v-icon>
                Guardar
              </v-btn>
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
    show: {type: Boolean, default:false}
  },

  data() {
    return {
      cedula: {
        valor: "",
      },
    };
  },

  computed: mapGetters(["todos_expp", "get_finalizado"]),

  methods: {
    ...mapActions(["getExpedientes", ]),

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