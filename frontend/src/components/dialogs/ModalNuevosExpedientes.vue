<template>
  <v-dialog v-model="show" max-width="1200px" content-class="round">
    <v-card class="px-7 pt-1">

      <div class="py-8 Montserrat-Bold  tituloModal">
        Se registró con éxito el expediente
      </div>
      <v-divider color="#393B44"></v-divider>

      <div class="Montserrat-Bold mb-2 mt-8 sizeTM"> Fecha:</div>
      <div class="Montserrat-Regular mb-6 ml-1 sizeDM"> {{ dato[0] }}</div>

      <div class="Montserrat-Bold mr-1 mb-2 sizeTM"> Iniciador:</div>
      <div class="Montserrat-Regular mb-6 text-justify sizeDM">{{ dato[1] }}</div>

      <div class="Montserrat-Bold mb-2 sizeTM"> Extracto:</div>
      <div class="Montserrat-Regular mb-6 text-justify sizeDM">{{ dato[2] }}</div>

      <div class=" Montserrat-Bold mb-2 sizeTM"> Se derivo al Area:</div>
      <div class="Montserrat-Regular mb-6 text-justify sizeDM">{{ dato[3].descripcion }}</div>

      <v-row no-gutters justify="center" class="py-4">

        <v-col cols="12" lg="6" class="px-sm-2 py-5">
          <v-btn target="_blank" to="/caratula" type="submit" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
            <v-icon class="px-5">
              mdi-check-bold
            </v-icon>
            <div class="">
              Imprimir caratula
            </div>
          </v-btn>
        </v-col>

        <v-col cols="12" lg="6" class="px-sm-2 py-5">
          <Button link="/nuevo-expediente" texto="Nuevo expediente" icono="mdi-text-box-plus"/>
        </v-col>

        <!-- <v-col cols="12" lg="6" class="px-sm-2 py-2" justify-center>
             <secondary-button texto="Imprimir Carátula" icono="mdi-printer"/>
         </v-col>-->
      </v-row>
    </v-card>
  </v-dialog>
</template>
<script>
import Button from "../Button";
import {mapGetters} from "vuex";

export default {
  name: 'ModalInvitacionesEnviadas',
  components: {Button},
  props: {
    show: Boolean,
    dato: Array,
  },

  computed: {
    ...mapGetters(['areas', 'fecha'])
  },

  methods: {
    close() {
      this.$emit("close")
    },
  }
}
</script>
<style>
.round {
  border-radius: 30px;
}

.sizeTM {
  font-size: 24px !important;
}

.sizeDM{
  font-size: 24px !important;
}

.tituloModal{
  font-size: 30px !important ;
  color: #FB8C00;
}
</style>