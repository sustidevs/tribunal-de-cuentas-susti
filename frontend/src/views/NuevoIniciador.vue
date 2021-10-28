<template>
    <div class="mb-12">
        <form @submit.prevent="storeIniciador(inicia)" >
            <titulo texto="Nuevo Iniciador" icono="mdi-account-plus-outline" class="pb-8"/>
            <v-row no-gutters justify="center" class="mt-2 mb-3">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                    <label-input texto="Nombre entidad / persona"/>
                    <text-field v-model="inicia.nombre"/>
                </v-col>

                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                    <label-input texto="Tipo"/>
                    <autocomplete-field :data="allTipoEntidad" nombre="descripcion" v-model="inicia.tipo_entidad"/>
                </v-col>
            </v-row>

            <v-row no-gutters justify="start" class="mt-2 mb-3">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                    <label-input texto="CUIT"/>
                    <text-field tipo="number" v-model="inicia.cuit"/>
                </v-col>

                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                    <label-input texto="CUIL"/>
                    <text-field tipo="number" v-model="inicia.cuil"/>
                </v-col>
            </v-row>

            <v-row no-gutters justify="start" class="mt-2 mb-3">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                    <label-input texto="Área"/>
                    <text-field v-model="inicia.area_reparticiones"/>
                </v-col>

                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                    <label-input texto="Prefijo"/>
                    <text-field tipo="number" v-model="inicia.prefijo"/>
                </v-col>
            </v-row>

            <v-row no-gutters justify="start" class="mt-2 mb-3">
                <v-col cols="12" sm="12" lg="6" class="pr-lg-2">
                    <label-input texto="Correo electrónico"/>
                    <text-field v-model="inicia.correo"/>
                </v-col>

                <v-col cols="12" sm="12" lg="6" class="pl-lg-2">
                    <label-input texto="Teléfono"/>
                    <text-field tipo="number" v-model="inicia.telefono"/>
                </v-col>
            </v-row>

            <v-row no-gutters justify="center" class="mt-8">
                <v-col cols="12" sm="6" md="6" lg="6" class="py-6 px-sm-2">
                    <v-btn type="submit" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                        <div class="py-6 pa-5">
                            <v-icon class="px-5">
                            mdi-plus-circle-outline
                            </v-icon>
                            Agregar
                        </div>
                    </v-btn>
                </v-col>
            </v-row>
        </form>
    </div>
</template>

<script>
import Titulo from "../components/Titulo";
import LabelInput from "../components/LabelInput";
import TextField from "../components/TextField";
import AutocompleteField from "../components/AutocompleteField";
import {mapActions, mapGetters} from "vuex";

export default {
    name: 'NuevoIniciador',
    components: {Titulo, LabelInput, TextField, AutocompleteField},

    data: () => ({
        inicia:{
            nombre: '',
            tipo_entidad: '',
            cuit: '',
            cuil: '',
            area_reparticiones: '',
            prefijo: '',
            correo: '',
            telefono: '',
        }
    }),

     mounted() {
      this.createTipoEntidad();
    },

    methods: {
        ...mapActions([
            'storeIniciador', 'createTipoEntidad'
        ]),
    },

    computed: {
        ... mapGetters(['allTipoEntidad',])
    },
}
</script>