<template>
  <div class="full">
      <v-container fill-height fluid>
          <v-row justify="start">
              <v-card color="rgb(255, 255, 255, 0.7)" class="py-5 px-5 ml-lg-16" height="w-full" width="30rem" style="border-radius: 20px" elevation="20" align="center" >
                  <v-card-text>
                      <v-img
                          src="/img/tribunal-login.png"
                          class="pb-2"
                      />

                    <form @submit.prevent="onLogin">
                      <div class="size Montserrat-Bold text-justify pb-2 pt-4 black--text">
                        <v-icon color="#000000">mdi-account</v-icon>
                        CUIL:
                      </div>
                      <v-text-field
                          :color="this.$store.getters.errorC ? 'red lighten-1' : 'amber accent-4'"
                          :background-color="this.$store.getters.errorC ? 'red lighten-4' : 'white'"
                          outlined
                          v-model="credentials.cuil"
                          name="user.cuil"
                      ></v-text-field>

                      <div class="size Montserrat-Bold text-justify pb-2 black--text">
                        <v-icon color="#000000">mdi-key-variant</v-icon>
                        Contraseña:
                      </div>
                      <v-text-field
                          :color="this.$store.getters.errorP ? 'red lighten-1' : 'amber accent-4'"
                          :background-color="this.$store.getters.errorP ? 'red lighten-4' : 'white'"
                          :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                          :type="show1 ? 'text' : 'password'"
                          @click:append="show1 = !show1"
                          outlined
                          v-model="credentials.password"
                          name="user.password"
                      ></v-text-field>

                        <v-alert v-if="this.$store.getters.errorC || this.$store.getters.errorP || this.$store.getters.errorAmbos" outlined  color="red" close-text="Close Alert">
                          <div class="Montserrat-Bold red--text fontError text-start py-2 pt-6">
                            <div class="pb-2"><v-icon color="red">mdi-exclamation-thick</v-icon>No pudimos loguearte</div>
                            <div :key="x.id" v-for="x in erroresCuil">
                              <label-error :texto="x"/>
                            </div>

                            <div :key="x.id" v-for="x in erroresPass">
                              <label-error :texto="x"/>
                            </div>

                            <label-error :texto="this.$store.getters.errorAmbos"/>
                          </div>
                        </v-alert>
                      <Button class="mt-6" type="submit" texto="ingresar" icono="mdi-arrow-right-thin-circle-outline"/>
                    </form>

                  </v-card-text>
              </v-card>
          </v-row>
      </v-container>
  </div>
</template>

<script>
import Button from "../Button";
import LabelError from "../LabelError";

import {mapActions, mapGetters} from "vuex";

export default {
  components: {Button, LabelError},
  name: 'App',

  data() {
    return {
      alert: false,
      error: true,
      show1: false,
      errorPassword: false,
      errorCuil: false,
      credentials: {
        cuil: null,
        password: null,
      },
    }
  },

  computed: {
    ...mapGetters({
      isAuthenticated: 'authenticated',
    }),

    erroresCuil: {
      get() {return this.$store.getters.getErrorCuil}
    },

    erroresPass: {
      get() {return this.$store.getters.getErrorPassword}
    }
  },

  watch: {
    isAuthenticated(value) {
      if(value) this.$router.push("/")
    }
  },

  methods: {
    ...mapActions({
      login: 'login',
    }),
    onLogin() {
      this.login(this.credentials)
    },
  }
};
</script>
<style>
.full {
  background: url(/img/tribunal-desktop.jpg) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  width: 100%;
  height:100vh;
}

.size{
  font-size: 15px;
  color: #000000;
}

</style>