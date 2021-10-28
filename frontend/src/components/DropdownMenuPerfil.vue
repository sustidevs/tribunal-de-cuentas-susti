<template>
  <v-menu
      min-width="20px"
      rounded
      offset-y
  >
    <template v-slot:activator="{ on }">
      <v-hover v-slot="{ hover }" >
        <v-btn v-on="on" width="178" height="64"  elevation="0" tile :color="hover ? '#393b44' : '#393b44'">
          <v-icon :class="hover ? 'amber--text text--lighten-3' : 'white--text'">mdi-account</v-icon>
          <h5 class="white--text"> {{ nombre }}</h5>
        </v-btn>
      </v-hover>
    </template>

    <v-card color="#393b44">
      <v-list-item-content class="justify-center">
        <div class="mx-auto text-center white--text">
                <span class="text-caption mt-1">
                  {{ this.correo }}
                </span>
          <v-divider  class="my-2"></v-divider>

          <div>
            <v-hover v-slot="{ hover }" >
              <v-btn
                  block
                  depressed
                  text
                  class="py-4"
                  @click="logout()"
              >
                <h5 :class="hover ? 'black--text' : 'white--text' "> Salir </h5>
              </v-btn>
            </v-hover>
            <v-divider class="my-1"></v-divider>
          </div>
        </div>
      </v-list-item-content>
    </v-card>
  </v-menu>
</template>

<script>
export default {

  props: {
    nombre: String,
    apellido: String,
    correo: String
  },

  methods: {
    logout () {
      this.$store.dispatch('logout').then( () => {
        this.$router.push({ name: "LoginGeneral"});
      })
    }
  }
}
</script>