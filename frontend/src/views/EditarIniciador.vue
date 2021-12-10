<template> 
    <div class="mb-16"> 
        <form @submit.prevent="updateIniciador(inic)"> 
            <v-row no-gutters justify="start" class="my-6"> 
                <v-col cols="12" sm="12" lg="6" class="pb-6"> 
                    <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Editar Iniciador </h1> 
                    <v-divider color="#393B44" class="mt-2"></v-divider>
                    <v-row cols="6" no-gutters justify="start" class="pb-6">
                        <label-input class="pt-10" texto="Correo electrónico"/> 
                        <v-col cols="12"> 
                            <text-field v-model="inic.email" icon="mdi-email"/>
                        </v-col> 
                        <label-input texto="Teléfono"/> 
                        <v-col cols="12"> 
                            <text-field v-model="inic.telefono" icon="mdi-phone"/> 
                        </v-col> 
                        <label-input texto="Dirección"/> 
                        <v-col cols="12"> 
                            <text-field v-model="inic.direccion" icon="mdi-map-marker"/> 
                        </v-col> 

                        <v-col cols="12"> 
                            <v-btn type="submit" class="mt-8 pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block> 
                                <v-icon class="pr-5"> mdi-content-save </v-icon> 
                                <div> Guardar </div> 
                            </v-btn> 
                        </v-col> 
                    </v-row> 
                </v-col> 
 
                <v-col cols="12" sm="12" lg="6" class="pl-lg-6 pb-16"> 
                    <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Iniciador </h1> 
                    <v-divider color="#393B44" class="mt-2"></v-divider> 
                    <v-row class="mt-8"> 
                        <v-col cols="12" sm="12" lg="12"> 
                            <v-card class="pa-6" color="#FACD89"> 
                                <v-flex class="sizeTextBig Montserrat-SemiBold pt-2">Nombre:<span class="sizeTextSmall Montserrat-Regular"> {{this.$store.getters.iniciador[0].nombre}}</span> </v-flex> 
                                <v-flex class="sizeTextSmall Montserrat-SemiBold pt-2">Tipo:<span class="sizeTextSmall Montserrat-Regular"> {{this.$store.getters.iniciador[1]}}</span> </v-flex> 
                                <v-flex v-if="this.$store.getters.iniciador[0].cuil !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-2">CUIL:<span class="sizeTextSmall Montserrat-Regular"> {{this.$store.getters.iniciador[0].cuil}} </span> </v-flex> 
                                <v-flex v-if="this.$store.getters.iniciador[0].cuit !== '-'" class="sizeTextSmall Montserrat-SemiBold pt-2">CUIT:<span class="sizeTextSmall Montserrat-Regular"> {{this.$store.getters.iniciador[0].cuit}} </span> </v-flex> 
                            </v-card> 
                        </v-col> 
                    </v-row> 
                </v-col>
            </v-row> 
        </form> 
    </div> 
</template> 
 
<script> 
import LabelInput from "../components/LabelInput"; 
import {mapActions, mapGetters} from "vuex"; 
import TextField from "../components/TextField"; 
 
export default { 
  name: 'EditarIniciador', 
  components: {LabelInput, TextField}, 
    data() { 
        return { 
            inic: { 
                email: '', 
                telefono: '', 
                direccion: '',
            }, 
        } 
    }, 
 
    computed: mapGetters(['iniciador']), 
 
    methods: { 
        ...mapActions([ 'updateIniciador']),
    } 
} 
</script>
 
<style> 
.sizeTextBig{ 
    font-size: 24px; 
    color: #393B44; 
} 
 
.sizeTextSmall{ 
    font-size: 22px; 
    color: #393B44; 
} 
</style>