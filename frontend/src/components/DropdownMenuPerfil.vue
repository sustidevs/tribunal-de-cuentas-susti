<template>
  <v-menu min-width="20px" rounded offset-y transition="scale-transition">
    <template v-slot:activator="{ on }">
      <v-hover v-slot="{ hover }">
        <v-btn
          class="pl-1"
          v-on="on"
          width="225"
          height="64"
          elevation="0"
          tile
          :color="hover ? '#393b44' : '#393b44'"
        >
          <h5 class="white--text px-2">{{ nombre }}</h5>
          <v-icon :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >mdi-account-circle</v-icon
          >
          <v-icon :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >mdi-chevron-down</v-icon
          >
        </v-btn>
      </v-hover>
    </template>

    <v-card color="#393b44">
      <v-list-item>
        <v-list-item-content>
          <v-list-item-subtitle class="d-flex justify-end white--text text-h7">
            {{ area }}
          </v-list-item-subtitle>
          <v-list-item-subtitle class=" white--text d-flex justify-end">{{
            cuil
          }}</v-list-item-subtitle>
        </v-list-item-content>
      </v-list-item>

      <v-divider class="my-1"></v-divider>

      <div>
        <v-hover v-slot="{ hover }" class="d-flex justify-end py-2">
          <v-btn block x-large depressed text>
            <h5
              class="px-2 Montserrat-Regular"
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >
              Editar Peril
            </h5>
            <v-icon
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
              >mdi-account</v-icon
            >
          </v-btn>
        </v-hover>
        <v-divider class="my-1"></v-divider>
      </div>

      <div>
        <v-hover v-slot="{ hover }" class="d-flex justify-end py-2 ">
          <v-btn block x-large depressed text @click="logout()">
            <h5
              class="px-2 Montserrat-Regular"
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
            >
              Salir
            </h5>
            <v-icon
              :class="hover ? 'amber--text text--lighten-3' : 'white--text'"
              >mdi-logout</v-icon
            >
          </v-btn>
        </v-hover>
      </div>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  props: {
    nombre: String,
    apellido: String,
    cuil: String,
    area: String,
  },
  
  methods: {
    logout() {
      this.$store.dispatch("logout").then(() => {
        this.$router.push({ name: "LoginGeneral" });
      });
    },
  },
};
</script>
