<template>
    <div>
        <v-card color="grey lighten-3" class="my-6 px-4 pa-5">
            <div class="descripcion text-justify pb-2"> <strong>Búsqueda</strong> </div>
            <v-row>
                <v-col cols="12" xs="12" lg="3">
                <v-text-field
                    append-icon="mdi-magnify"
                    label="N° DE EXPEDIENTE "
                    outlined
                    hide-details
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                />
                </v-col>

                <v-col cols="12" xs="12" lg="3">
                <v-autocomplete
                    append-icon="mdi-magnify"
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    outlined
                    label="USUARIO"
                    item-color="amber accent-4"
                    hide-details
                ></v-autocomplete>
                </v-col>

                <v-col cols="12" xs="12" lg="3">
                <v-autocomplete
                    append-icon="mdi-magnify"
                    class="Montserrat-Regular text-justify"
                    color="amber accent-4"
                    item-text="descripcion"
                    outlined
                    label="TRÁMITE"
                    item-color="amber accent-4"
                    hide-details
                ></v-autocomplete>
                </v-col>

                <v-col cols="12" xs="12" lg="3">
                <v-text-field
                    color="amber accent-4"
                    append-icon="mdi-magnify"
                    label="INICIADOR, FECHA"
                    hide-details
                    outlined
                />
                </v-col>

            </v-row>
        </v-card>

        <v-data-table
            @page-count="pageCount = $event"
            :page.sync="page"
            hide-default-footer
            :headers="headers"
            :items="data"
            :items-per-page="5"
            disable-sort
            mobile-breakpoint="300"
            class="elevation-1 mytable"
            loading-text="Cargando expedientes del área. Por favor, espere."
            :loading="loading"
            no-data-text="No hay expedientes en el área"
        >

            <template v-slot:item.action="{ }">
                <v-btn fab small color="#FACD89" depressed >
                <v-icon>mdi-hand-extended</v-icon>
                </v-btn>
            </template>
        </v-data-table>

        <div v-if="pageCount > 0" class="text-center pt-2">
            <v-pagination
                v-model="page"
                :length="pageCount"
                :total-visible="7"
                color="amber accent-4 pb-2"
            ></v-pagination>
        </div>
    </div>
</template>

<script>
export default {
  props: {
    headers: Array,
    data: Array,
    loading: { type: Boolean, default: false },
  },
  data () {
    return {
      page: 1,
      pageCount: 0,
    }
  },
}
</script>