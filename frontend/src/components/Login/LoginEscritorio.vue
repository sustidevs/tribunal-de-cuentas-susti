<template>
  <div class="full">
      <v-container fill-height fluid>
          <v-row justify="start">
              <v-card color="rgb(255, 255, 255, 0.7)" class="py-5 px-5 ml-lg-16" height="w-full" width="30rem" style="border-radius: 20px" elevation="20" align="center" >
                  <v-card-text>
                    <img class="mt-4 pa-4" :src="('./img/logo-tribunal.svg')">
                    <v-divider color="#393B44" class="mt-2"></v-divider>

                    <form @submit.prevent="onLogin">
                      <div class="size Montserrat-Bold text-justify pb-2 pt-8 black--text">
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
                      <v-btn :loading="loading" :disabled="loading" type="submit" class="mt-6 pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
                        <v-icon class="pr-5"> mdi-arrow-right-thin-circle-outline </v-icon>
                        Ingresar
                      </v-btn>
                    </form>

                  </v-card-text>
              </v-card>
          </v-row>
      </v-container>
  </div>
</template>

<script>
import LabelError from "../LabelError";

import {mapActions, mapGetters} from "vuex";

export default {
  components: {LabelError},
  name: 'App',

  data() {
    return {
      alert: false,
      error: true,
      show1: false,
      errorPassword: false,
      errorCuil: false,
      loader: null,
      loading: false,
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
    },

    loader () {
      const l = this.loader
      this[l] = !this[l]

      setTimeout(() => (this[l] = false), 1000)

      this.loader = null
    },
  },

  methods: {
    ...mapActions({
      login: 'login',
      verificar: 'verificar',
    }),

    onLogin() {
      this.loader = 'loading',
      this.login(this.credentials)
  }
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