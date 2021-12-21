<template>
    <v-dialog v-model="show" max-width="1200px" content-class="round" persistent justify="center">
    <v-card elevation="0" class="mb-5 py-8 px-5" width="1700" color="grey lighten-4">
      <div class="fontBig Montserrat-SemiBold pt">
        DETALLE DE Cedula
      </div>
      <v-divider class="my-3"/>

      <div v-for="item in datos" :key="item.id">
        {{ item.nro_cedula }}
      </div>

    </v-card>
    </v-dialog>
</template>

<script>

export default {
  name: 'ModalIniciador',
  components: { },
  props: {
    show: Boolean,
    datos: Array,
  },


}
</script>
<style>
.detalle{
  font-size: 25px;
  color: #FACD89;
}

.fontBig{
  font-size: 25px;
  color: #393B44;
}

.fontSmall{
  font-size: 24px;
  color: #393B44;
}
</style>