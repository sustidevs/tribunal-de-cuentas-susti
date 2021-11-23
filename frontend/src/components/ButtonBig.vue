<template>
  <div>
    <v-hover v-slot="{ hover }" >
      <v-btn
          rounded
          width="190"
          height="190"
          :class="hover ? 'orange lighten-5' : 'grey lighten-2'"
          class="pa-8 Montserrat-Bold grey--text text--darken-3"
          :href="link"
          :target="target"
      >
        <div class="d-flex flex-column center">
          <div>
            <v-icon size="110" color="#FDBC3F" class="py-2"> {{icon}} </v-icon>
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
    icon: String,
    texto: String,
    link: String,
    target: null,
  },
}
</script>

<style>
.center{
  font-size: 15px;
  text-align: center;
}

.sizeBig{
  font-size: 15px;
  text-align: center;
}
</style>