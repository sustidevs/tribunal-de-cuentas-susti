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
      <Button class="mt-4" @click="login" texto="ingresar" icono="mdi-arrow-right-thin-circle-outline"/>
    </v-flex>
  </div>
</template>

<script>
import Button from "../Button";
export default {
  components: { Button},
  name: 'App',

  data() {
    return {
      show1: false,
      email: '',
      password: '',
    }
  },

  methods: {
    login() {
      console.log(this.email);
      console.log(this.password);

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