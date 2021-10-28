<template>
    <v-dialog v-model="show" max-width="810px" content-class="round">
      <v-card class="px-7 pt-1">
        <titulo texto="Agregar Iniciador" icono="mdi-plus"/>

        <v-row no-gutters class="mt-6" justify="center">
          <v-col cols="12" class="px-sm-2">
            <LabelInput texto="Nombre Entidad"/>
            <v-autocomplete
                class="Montserrat-Regular text-justify"
                color="amber accent-4"
                outlined
                item-value="id"
                item-text="nombre"
                return-object
                single-line
            >
            </v-autocomplete>
          </v-col>

          <v-col cols="12" class="px-sm-2">
            <LabelInput texto="Nombre"/>
            <TextField/>
          </v-col>

          <v-col cols="12" class="px-sm-2">
            <LabelInput texto="CUIT"/>
            <TextField/>
          </v-col>

          <v-col cols="12" class="px-sm-2">
            <LabelInput texto="Área de Repartición"/>
            <TextField/>
          </v-col>

          <v-col cols="12" class="px-sm-2">
            <LabelInput texto="Prefijo"/>
            <TextField/>
          </v-col>
        </v-row>

        <v-card-actions class="pb-6 justify-center">
          <v-col cols="12" sm="12" lg="6">
              <Button texto="Agregar" icono="mdi-plus"/>
          </v-col>
        </v-card-actions>
      </v-card>
    </v-dialog>
</template>
<script>
import Titulo from "../Titulo"
import LabelInput from "../LabelInput";
import TextField from "../TextField";
import Button from "../Button"
export default {
  name: 'ModalIniciador',
   components: {Titulo, LabelInput, TextField, Button},
  props: {
    show: Boolean,
  },
  methods: {
    close() {
      this.$emit("close")
    },
  }
}
</script>
<style>
.round {
  border-radius: 30px;
}
.boton{
  font-family: "Montserrat-Semibold";
  color: #393b44;
}
</style>