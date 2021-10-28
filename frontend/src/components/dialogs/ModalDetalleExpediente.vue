<template>
    <v-dialog
            transition="dialog-bottom-transition"
            max-width="800"
    >
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                v-bind="attrs"
                v-on="on"
                class="pa-5 color Montserrat-SemiBold" height="55" elevation="0" color="#FACD89" block
            ><v-icon class="px-5">mdi-check-bold</v-icon> Confirmar</v-btn>
        </template>
        <template v-slot:default="dialog">
            <v-card width="800">
                <v-row no-gutters  class="pa-5">
                    <v-col cols="10">
                        <div class="textHere Montserrat-SemiBold">Se registro con éxito el expediente</div>
                        <div class="textHere Montserrat-SemiBold">N° 800 - 28-04 - 1000/2021</div>
                    </v-col>
                    <v-col cols="2" align="center" class="pa-5">
                        <v-icon color="green" size="46px">mdi-check-all</v-icon>
                    </v-col>
                    <v-divider class="px-6" inset></v-divider>
                </v-row>

                <v-card-text>
                    <v-row no-gutters align="center">
                        <v-col>
                            <div class="d-flex justify-start">
                                <div class="textHereSmall Montserrat-Bold mr-1"> Fecha: </div>
                                <div class="textHereSmall Montserrat-SemiBold ml-1"> 28/04/2021 </div>
                            </div>
                        </v-col>
                        <v-col>
                            <div class="d-flex justify-end">
                                <div class="textHereSmall Montserrat-Bold mr-1"> Iniciador: </div>
                                <div class="textHereSmall Montserrat-SemiBold ml-1"> Responsable</div>
                            </div>
                        </v-col>
                    </v-row>
                    <v-row no-gutters align="center" class="mt-5">
                        <div class="textHereSmall d-flex flex-column Montserrat-Bold mb-2"> Extracto: </div>
                        <div class="textHereSmall d-flex flex-column Montserrat-SemiBold">RENDICIÓN DE CUENTAS N° 01/20 FDO.PTE.GTOS.BIENES DE CONSUMO
                        SERVICIOS NO RESPONSABLE. BS. USO Y TRANF. DCTO M° 2548/20. $1.000.000.00 (MINISTERIO REPARTICIÓN).
                        </div>
                    </v-row>

                </v-card-text>
                <v-card-actions class="justify-center">
                    <v-btn
                        @click="dialog.value = false"
                        class="mr-2 textHereSmall"
                        color="#FACD89"
                    ><v-icon>mdi-note-plus</v-icon> Nuevo expediente</v-btn>
                    <v-btn
                        @click="dialog.value = false"
                        class="ml-2 textHereSmall"
                        color=#FFF5E9
                    ><v-icon>mdi-printer</v-icon> Imprimir Caratula</v-btn>
                </v-card-actions>
            </v-card>
        </template>
    </v-dialog>
</template>
<script>
    export default {
        name: 'modal-detalle-expediente',
        data: () => ({
            dialog: false,
        })
    }
</script>
<style>
    .textHere{
        font-size: 25px;
    }
    .textHereSmall{
        font-size: 16px;
    }
    @media (max-width: 768px) {
        .textHere {
            font-size: 11px;
        }
        .textHereSmall {
            font-size: 11px;
        }
    }
</style>