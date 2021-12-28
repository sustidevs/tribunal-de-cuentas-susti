<template>
  <v-dialog persistent v-model="show" width="auto" content-class="round">
    <div v-if="this.get_encontrado == false">
      <v-card class="px-7 pt-1 pb-6">
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify">
              Consultar Expediente por:
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

        <v-form @submit.prevent="validate()"  ref="form" v-model="valid">

          <v-row justify="center" class="my-4 px-4">
            <v-btn-toggle
              rounded
              class="py-3"
              v-model="busqueda.buscar_por"
              group
              @change="showBuscar = true"
            >
              <v-btn value="1" class="px-8 pa-8 textRadio">
                <v-icon large color="#FDBC3F" class="pr-2">
                  mdi-text-box
                </v-icon>
                <p class="pt-4 text-capitalize">
                  N° Expediente
                </p>
              </v-btn>

              <v-divider vertical></v-divider>

              <v-btn value="3" class="px-8 pa-8 textRadio">
                <v-icon class="pr-2" large color="#FDBC3F">
                  mdi-cash
                </v-icon>
                <p class="pt-4 text-capitalize">
                  N° Cheque/Transferencia
                </p>
              </v-btn>

              <v-divider vertical></v-divider>

              <v-btn value="2" class="px-8 pa-8 textRadio">
                <v-icon class="pr-2" large color="#FDBC3F">
                  mdi-account
                </v-icon>
                <p class="pt-4 text-capitalize">
                  CUIL  Iniciador
                </p>
              </v-btn>
              <v-divider vertical></v-divider>
                <v-btn v-if="(get_user.area == 'DPTO. NOTIFICACIONES') || (get_user.area == 'DIRECCIÓN DE REGISTRACIONES')" file value="6" class="px-8 pa-8 textRadio">

                  <v-icon class="pr-2" large color="#FDBC3F">
                    mdi-clipboard-text-search
                  </v-icon>
                  <p class="pt-4 text-capitalize">
                    Norma Legal
                  </p>
                </v-btn>

            </v-btn-toggle>
          </v-row>

          <div v-if="showBuscar" class="pt-2">
              <div class="Montserrat-SemiBold mt-2 mb-1 py-2 textRadio">
                Ingrese el valor:
              </div>

            <v-text-field
                class="Montserrat-Regular text-justify"
                color="amber accent-4"
                v-model="busqueda.valor"
                :rules="nameRules"
                outlined
            ></v-text-field>

            <v-row justify="center" class="pb-6">
              <v-btn
                :disabled="!valid"
                type="submit"
                class="pa-5 color Montserrat-SemiBold"
                height="45"
                color="#FACD89"
              >
                <v-icon class="pr-4"> mdi-magnify </v-icon>
                Buscar
              </v-btn>
            </v-row>
          </div>
        </v-form>
      </v-card>
    </div>

    <div v-if="this.get_encontrado">
      <v-card class="px-7 pt-1 pb-6">
        <v-row class="mt-5">
          <v-col cols="10">
            <h2 class="Montserrat-Bold text-justify">
              Resultados Obtenidos
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

        <div v-if="this.get_resultado.length == 0">
          <div class="descripcion mt-4 py-2">
            No se han encontrado resultados
          </div>
        </div>

        <div v-if="this.get_resultado.length > 0">
          <div class="descripcion mt-4 py-2">
            Haga click en el resultado para más detalles
          </div>

          <v-expansion-panels focusable>
            <v-expansion-panel
              class="my-2"
              v-for="item in get_resultado"
              :key="item.id"
            >
              <v-expansion-panel-header
                color="#FACD89"
                class="Montserrat-SemiBold sizeNroExp"
              >
                {{ item.expediente_id }})
                {{ item.nro_expediente }}

              </v-expansion-panel-header>

              <v-expansion-panel-content>
                <div class="Montserrat-Bold mt-4">Iniciador:</div>
                <div class="Montserrat-Regular">{{ item.iniciador }}</div>

                <div class="Montserrat-Bold mt-4">CUIT:</div>
                <div class="Montserrat-Regular">{{ item.cuit }}</div>

                <div class="Montserrat-Bold mt-4">Extracto:</div>
                <div class="Montserrat-Regular">{{ item.extracto }}</div>

                <div class="Montserrat-Bold mt-4">Área Actual:</div>
                <div class="Montserrat-Regular">{{ item.area_actual }}</div>

                <v-btn class="mt-6" @click="historial_pase(item)" depressed>
                  <v-icon left size="25px"> mdi-magnify </v-icon>
                  Ver Historial
                </v-btn>
              </v-expansion-panel-content>
            </v-expansion-panel>
          </v-expansion-panels>
        </div>
      </v-card>
    </div>
  </v-dialog>
</template>

<script>
//import TextField from "../TextField";
import { mapActions, mapGetters } from "vuex";

export default {
  name: "ModalConsultarNroExp",
  //components: { TextField },

  props: {
    show: Boolean,
  },

  data() {
    return {
      valid: true,
      buscador: null,
      resultados: false,
      showBuscar: false,
      opcion_elegida: '',
      busqueda: {
        buscar_por: "",
        valor: "",
      },
      states: [{ name: "Con resultados" }, { name: "Sin resultados" }],

      nameRules: [
        (v) => !!v || "El campo es Requerido",
        //(v) => (v > 14) || "El máximo de fojas es 1000",
      ],
    };
  },

  computed: mapGetters(["get_resultado", "get_encontrado", 'get_historial','get_user']),

  methods: {
    ...mapActions(['consultarExpediente', 'historial_expediente']),

    close() {
      this.$emit("close");
      this.$router.go(0);
    },

    validate () {
      if(this.$refs.form.validate()){
        this.consultarExpediente(this.busqueda)
      }
    },

    historial_pase: function (item) {
      let id = {
        id: item.expediente_id
      }
      this.historial_expediente(id)
    },

  },
};
</script>

<style>
.textRadio {
  font-family: Montserrat-SemiBold, serif;
  font-size: 22px !important;
  color: #393B44;
}

.sizeNroExp {
  font-size: 20px !important;
}
</style>
