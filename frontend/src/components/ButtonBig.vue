<template>
  <div>
    <v-hover v-slot="{ hover }" >
      <v-btn
          rounded
          width="190"
          height="190"
          :class="hover ? 'orange accent-1' : 'grey lighten-2'"
          class="pa-8 Montserrat-Bold grey--text text--darken-3"
          :href="link"
          :target="target"
      >
        <div class="d-flex flex-column justify-center">
          <div>
            <v-img class="py-2" max-height="130" width="130" :src="imagen"></v-img>
          </div>
          <div class="sizeBig pt-4">
            {{texto}}
          </div>
        </div>
      </v-btn>
    </v-hover>
  </div>
</template>
<script>
export default {
  name: 'BotonHorizontal',
  props: {
    imagen: String,
    texto: String,
    link: String,
    target: null,
  },
}
</script>

<style>
.sizeBig{
  font-size: 15px;
}
</style>