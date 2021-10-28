<template>
  <v-menu
      width="10px"
      rounded
      offset-y
  >
    <template v-slot:activator="{ on }">
      <v-hover v-slot="{ hover }" >
        <v-btn v-on="on" width="55" height="64"  elevation="0" tile :color="hover ? '#393b44' : '#393b44'">
          <v-icon :class="hover ? 'amber--text text--lighten-3' : 'white--text'">mdi-account</v-icon>
        </v-btn>
      </v-hover>
    </template>

    <v-card color="#393b44">
      <v-list-item-content class="justify-center">
        <div class="mx-auto text-center white--text">

          <h3>{{ user.fullName }}</h3>
          <span class="text-caption mt-1">
                  {{ user.email }}
                </span>
          <v-divider  class="my-2"></v-divider>

          <div :key="men.titulo" v-for="men in menuAccount">
            <v-hover v-slot="{ hover }" >
              <v-btn
                  block
                  depressed
                  text
                  class="py-4"
              >
                <h5 :class="hover ? 'black--text' : 'white--text' ">{{ men.titulo }}</h5>
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
  data: () => ({
    user: { fullName: 'Juan123', email: 'john.doe@doe.com'},
    menuAccount:[ {titulo:'Bandeja de Entrada'},{titulo: 'Editar Cuenta'},{titulo: 'Salir'}],
  })
}
</script>