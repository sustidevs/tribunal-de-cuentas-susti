<template>
  <div class="mb-12">
        <titulo texto="Nuevo Iniciador" icono="mdi-account-plus" class="pb-8"/>
        <v-row no-gutters justify="center" class="mt-2 mb-3">
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                <label-input texto="Nombre entidad / persona"/>
                <v-text-field
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    outlined
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                <label-input texto="Tipo"/>
                <autocomplete-field/>
            </v-col>
        </v-row>

        <v-row no-gutters justify="start" class="mt-2 mb-3">
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                <label-input texto="CUIT"/>
                <v-text-field
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    outlined
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                <label-input texto="CUIL"/>
                <v-text-field
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    outlined
                ></v-text-field>
            </v-col>
        </v-row>

        <v-row no-gutters justify="start" class="mt-2 mb-3">
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                <label-input texto="Área"/>
                <v-text-field
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    outlined
                ></v-text-field>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                <label-input texto="Correo electrónico"/>
                <text-field/>
            </v-col>
        </v-row>

        <v-row no-gutters justify="start" class="mt-2 mb-3">
            <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                <label-input texto="Teléfono"/>
                <text-field/>
            </v-col>
        </v-row>

      <v-row no-gutters justify="center" class="mt-8">
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <SecondaryButton link="/" texto="Volver a inicio" icono="mdi-keyboard-backspace"/>
        </v-col>
        <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
          <v-btn @click="abrirModalExitoNuevoIniciador()" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
            <v-icon class="px-5">
              mdi-check-bold
            </v-icon>
              Confirmar
          </v-btn>
          <modal-exito-nuevo-iniciador :show="showModal" @close="closeModalExitoNuevoIniciador"/>
        </v-col>
      </v-row>
  </div>
</template>

<script>
import Titulo from "../components/Titulo";
import LabelInput from "../components/LabelInput";
import TextField from "../components/TextField";
import AutocompleteField from "../components/AutocompleteField";
import SecondaryButton from "../components/SecondaryButton";
import ModalExitoNuevoIniciador from '../components/dialogs/ModalExitoNuevoIniciador.vue'

export default {
    name: 'NuevoIniciador',
    components: {Titulo, LabelInput, TextField, AutocompleteField, SecondaryButton, ModalExitoNuevoIniciador},

    data () {
        return {
            showModal: false,
        }
    },

    methods: {
        abrirModalExitoNuevoIniciador() {
            this.showModal=!this.showModal
        },
        closeModalExitoNuevoIniciador() {
            this.showModal = false;
        },
    }
}
</script>
