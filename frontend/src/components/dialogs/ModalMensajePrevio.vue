<template>
<!-- Falta conexion a la hora de poder crear un expedinte -->
  <v-dialog v-model="show" width="1200px" content-class="round" persistent>
    <v-card class="px-7 pt-1 text-center">
      <titulo texto="Por favor revise sus datos antes de continuar." />

      <div class="textHereSmall text-center Montserrat-Regular my-4 mr-2">
            <v-card height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
              <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                Iniciador:
              </div>
              <div class="textHereSmall Montserrat-Regular ml-1">
                {{ dato.iniciador }}
              </div>
            </v-card>

            <v-card height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
              <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                Motivo:
              </div>
              <div class="textHereSmall Montserrat-Regular ml-1">
                {{ dato.motivo }}
              </div>
            </v-card>

            <v-card height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
              <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                Extracto:
              </div>
              <div class="textExtracto Montserrat-Regular ml-1">
                {{ get_extracto }}
              </div>
            </v-card>

            <v-card v-if="!(expe.nro_expediente_ext === '')" height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
              <div class="textHereSmall flex-column Montserrat-Bold mr-1">
                Numero SIIF
              </div>
              <div class="textHereSmall Montserrat-Regular ml-1">
                {{ expe.nro_expediente_ext }}
              </div>
            </v-card>

          <v-card height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
            <div class="textHereSmall flex-column Montserrat-Bold mr-1">
              Cantidad de Fojas:
            </div>
            <div class="textHereSmall Montserrat-Regular ml-1">
              {{ expe.nro_fojas }}
            </div>
          </v-card>

          <v-card height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
            <div class="textHereSmall flex-column Montserrat-Bold mr-1">
              Observaciones:
            </div>

            <div v-if="expe.observacion === ''">
              <div class="textHereSmall text-uppercase Montserrat-Regular ml-1" >
                No se ha adjuntado observaciones
              </div>
            </div>

            <div v-else>
              <div class="textHereSmall text-uppercase Montserrat-Regular ml-1">
                {{ expe.observacion }}
              </div>
            </div>
          </v-card>

          <v-card height="full" rounded class="pa-4 text-responsive my-6" color="#FACD89" style="background-color:rgba(250, 205, 137, 0.6)">
            <div class="textHereSmall flex-column Montserrat-Bold mr-1">
              Pase a:
            </div>
            <div class="textHereSmall Montserrat-Regular ml-1">
              {{ dato.pasea}}
            </div>
          </v-card>
      </div>


      <v-row no-gutters justify="center" class="mt-6">
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn
            @click="storeExpe"
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
            outlined
            @click="close"
            class="pa-5 Montserrat-SemiBold"
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
    dato: {
      type: Object,
      default: () => ({
        iniciador: 'no hay dato',
        motivo: 'no hay dato',
        pasea: 'no hay dato'
      })
    },
    expe: {
      type: Object,
      default: () => ({})
    }
  },

  computed: {
    ...mapGetters([
        'get_error_modal_preview',
        'get_extracto'
    ]),
  },

  methods: {
    ...mapActions(["getArchivos", 'storeExpediente','extracto']),

    storeExpe() {
      let formData = new FormData();
      for (var i = 0; i < this.dato.files_length; i++) {
        let file = this.files[i];

        formData.append("archivo" + i + "", file);
      }
      let cantidad = this.dato.files_length
      formData.append("iniciador_id", this.expe.iniciador_id);
      formData.append("nro_fojas", this.expe.nro_fojas);
      formData.append("nro_expediente_ext", this.expe.nro_expediente_ext);
      formData.append("observacion", this.expe.observacion);
      formData.append("prioridad_id", this.expe.prioridad);
      formData.append("tipo_exp_id", this.expe.tipo_exp_id);
      formData.append("descripcion_extracto", this.get_extracto);
      formData.append("area_id", this.expe.area_id);
      formData.append("archivos_length", cantidad);

      this.storeExpediente(formData);
    },

    close() {
      this.$emit("close_mensaje_previo");
    },
  },

  extracto: {
    get() {
      return this.$store.getters.extracto;
    },
  },
};
</script>

<style>
.textExtracto {
  font-size: 28px !important;
}
</style>
