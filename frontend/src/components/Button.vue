<template>
    <v-btn :href="link" class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block>
      <v-icon class="pr-5">
        {{ icono }}
      </v-icon>
          <div class="">
            {{ texto }}
          </div>
    </v-btn>
</template>

<script>
export default {
  props: {
    texto: String,
    icono: String,
    link: String
  }
}
</script>
