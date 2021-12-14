<template>
  <div align="center" justify="center">
    <v-img
        src="/img/tribunal-mobile.png"
        class=""
    />
    <div class="titulo Montserrat-Bold py-3">
      ¡BIENVENIDO/A!
    </div>
    <v-flex class="pt-3 px-6"  align="center">
      <div class="size Montserrat-Bold text-justify pb-2 pt-4 black--text">
        <v-icon color="#000000">mdi-account</v-icon>
        CUIL:
      </div>
      <v-text-field
          background-color="white"
          outlined
          v-model="this.email"
          color="amber accent-4"
      ></v-text-field>
    </v-flex>
    <v-flex class="pb-3 px-6"  align="center">
      <div class="size Montserrat-Bold text-justify pb-2 black--text">
        <v-icon color="#000000">mdi-key-variant</v-icon>
        Contraseña:
      </div>
      <v-text-field
        color="amber accent-4"
        :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
        :type="show1 ? 'text' : 'password'"
        @click:append="show1 = !show1"
        background-color="white"
        outlined
      ></v-text-field>
      <v-btn @click="login" :loading="loading" :disabled="loading" type="submit" class="mt-6 pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
        <v-icon class="pr-5"> mdi-arrow-right-thin-circle-outline </v-icon>
        Ingresar
      </v-btn>
    </v-flex>
  </div>
</template>

<script>
export default {
  name: 'App',

  data() {
    return {
      show1: false,
      email: '',
      password: '',
      loader: null,
      loading: false,
    }
  },

  watch: {
    loader () {
      const l = this.loader
      this[l] = !this[l]

      setTimeout(() => (this[l] = false), 3000)

      this.loader = null
    },
  },

  methods: {
    login() {
      console.log(this.email);
      console.log(this.password);
      this.loader = 'loading';

      /**if (this.email == "juan123@correo.com" && this.password == "12345678") {
        console.log(this.email);
      }**/
    }
  },

};
</script>
<style>
.size{
  font-size: 17px !important;
  color: #000000;
}

.titulo{
  font-size: 21px;
  color: #000000;
}
</style>