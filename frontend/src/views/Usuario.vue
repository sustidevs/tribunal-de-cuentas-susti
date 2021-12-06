<template>
    <div>
        <v-row no-gutters justify="start" class="py-6">
            <v-col cols="12" sm="12" lg="6" class="pb-6">
                <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Cambiar contraseña </h1>
                <v-divider color="#393B44" class="mt-2"></v-divider>
                <alert-sucess texto="La contraseña se actualizo con éxito" :condicion="this.error1" />
                <label-input  class="pt-10" texto="Ingrese su contraseña actual"/>
                <v-row cols="6" no-gutters justify="start" class="pb-6">
                    <v-col cols="12">
                        <v-text-field
                            color="amber accent-4"
                            :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                            :type="show1 ? 'text' : 'password'"
                            @click:append="show1 = !show1"
                            background-color="white"
                            outlined
                        ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-btn type="submit" @click="mostrar = !mostrar" class="pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                            <v-icon class="pr-5">  mdi-check-bold </v-icon>
                            <div> Aceptar </div>
                        </v-btn>
                    </v-col>
                </v-row>
                <div v-if="this.mostrar == true">
                    <v-row no-gutters justify="start" class="pb-2">
                        <v-col cols="12" class="pb-3">
                            <label-input class="mt-8" texto="Ingrese una nueva contraseña"/>
                            <v-alert
                                icon="mdi-alert-outline"
                                dense
                                text
                                type="warning"
                                class="alert Montserrat-Regular pa-4"
                            >
                                Su contraseña debe tener al menos 8 caracteres, un número y una letra.
                            </v-alert>
                            <alert type="error" texto="Las constrañas no coinciden" :condicion="this.error2" />                            
                        </v-col>
                        <v-col cols="12">
                            <v-text-field
                                color="amber accent-4"
                                :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="show2 ? 'text' : 'password'"
                                @click:append="show2 = !show2"
                                background-color="white"
                                outlined
                                v-model="user.password"
                            ></v-text-field>
                        </v-col>
                    </v-row>
                    <label-input texto="Repita la nueva contraseña"/>
                    <v-row no-gutters justify="start" class="pb-16">
                        <v-col cols="12">
                            <alert type="error" texto="Las constrañas no coinciden" :condicion="this.error2" />

                            <v-text-field
                                color="amber accent-4"
                                :append-icon="show3 ? 'mdi-eye' : 'mdi-eye-off'"
                                :type="show3 ? 'text' : 'password'"
                                @click:append="show3 = !show3"
                                background-color="white"
                                outlined
                                v-model="repetirPass"
                            ></v-text-field>
                        </v-col>
                        <v-col cols="12">
                            <v-btn @click="nuevoPassword()" type="submit" class="pa-5 Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                                <v-icon class="pr-5">  mdi-content-save </v-icon>
                                <div> Guardar </div>
                            </v-btn>
                        </v-col>
                    </v-row>
                </div>
            </v-col>

            <v-col cols="12" sm="12" lg="6" class="pl-lg-6 pb-16">
                <h1 class="d-flex justify-start Montserrat-Bold pb-3 mt-6"> Usuario </h1>
                <v-divider color="#393B44" class="mt-2"></v-divider>
                <v-row class="ma-5">
                    <v-col cols="12" sm="12" lg="4">
                        <v-img max-height="170" width="170" src='/img/usuario.png'></v-img>
                    </v-col>
                    <v-col cols="12" sm="12" lg="8">
                        <v-flex class="textHereBig Montserrat-SemiBold pb-2 text-uppercase">{{this.$store.getters.getNombreApellido}} </v-flex>
                        <v-flex class="textHereSmall Montserrat-SemiBold pt-2">ÁREA: <span class="Montserrat-Regular">{{this.$store.getters.getArea}}</span> </v-flex>
                        <v-flex class="textHereSmall Montserrat-SemiBold pt-2">CUIL: <span class="Montserrat-Regular">{{this.$store.getters.getCuil}}</span> </v-flex>
                    </v-col>
                </v-row>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import LabelInput from "../components/LabelInput";
import AlertSucess from "../components/AlertSucess"
import Alert from "../components/Alert"
import {mapGetters, mapActions} from "vuex";

export default {
  name: 'Usuario',
  components: {LabelInput, AlertSucess, Alert},
    data() {
        return {
            user:{
                id:  this.$store.getters.getIdUser, 
                password: '',
            },
            repetirPass:'',
            show1: false,
            show2: false,
            show3: false,
            error1: false,
            error2: false,
            mostrar: false,
            mostrar2: false,
        }
    },
  computed: mapGetters('getIdUser', 'getNewPass', 'cambiado'),

  methods:{
    ...mapActions(['getApellido', 'getNombre','editPassword', 'nuevaContrasena']),

  nuevoPassword() {
      if (this.user.password == this.repetirPass){
          this.nuevaContrasena(this.user)
          this.error1 = true;
          this.error2 = false;
      }
      else{ 
          this.error2 = true;
      }
  }
    },
  

}
</script>

<style>
.textHereBig{
    font-size: 26px;
    color: #393B44;
}

.textHereSmall{
    font-size: 18px;
    color: #393B44;
}
</style>