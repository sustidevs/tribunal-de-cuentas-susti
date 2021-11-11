<template>
    <div>
        <v-row no-gutters class="justify-center pt-12">
            <v-col cols="12" lg="8">
                <v-card elevation="0" color="grey lighten-5" class="pa-8">
                    <v-card-text>
                        <v-row no-gutters>
                            <v-col cols="12" lg="4">
                                <div class="d-flex justify-start align-start">
                                    <div class="textHereSmall Montserrat-SemiBold mr-1"> Cédula: </div>
                                </div>
                            </v-col>
                            <v-col cols="12" lg="4">
                                <div class="d-flex align-start">
                                    <div class="textHereSmall Montserrat-SemiBold mr-1"> Año: </div>
                                    <div class="textHereBig Montserrat-Bold"> 2021 </div>
                                </div>
                            </v-col>
                            <v-col cols="12" lg="4">
                                <div class="d-flex column justify-start">
                                    <div class="textHereSmall Montserrat-SemiBold mb-2 mr-1"> Disposición: </div>
                                </div>
                            </v-col>
                        </v-row>

                        <v-row no-gutters class="pt-6 pb-16">
                            <v-col cols="12" lg="4">
                                <div class="d-flex justify-center">
                                    <v-img max-height="1100" max-width="90" :src="'./img/escudo-provincial.png'"/>
                                </div>
                            </v-col>
                            <v-col cols="12" lg="6">
                                <v-flex class="d-flex textHereBig Montserrat-SemiBold mr-1 pt-8 justify-center"> Provincia de Corrientes </v-flex>
                                <v-flex class="d-flex textHere Montserrat-SemiBold pt-6 justify-center">TRIBUNAL DE CUENTAS </v-flex>
                            </v-col>
                        </v-row>
        

                        <v-row no-gutters class="pt-6">
                            <v-col cols="12" sm="12" lg="7">
                                <div class="d-flex justify-start align-start">
                                    <div class="textHereBig Montserrat-SemiBold mr-1"> EXPEDIENTE: </div>
                                    <div class="textHereBig Montserrat-Bold"> N° 800 – 28-04 – 1000/2021 </div>
                                </div>
                            </v-col>
                            <v-col cols="12" sm="12" lg="5">
                                <div class="d-flex align-start">
                                    <div class="textHereBig Montserrat-SemiBold mr-1"> FECHA: </div>
                                    <div class="textHereBig Montserrat-Bold"> 24-10-2021 </div>
                                </div>
                            </v-col>
                        </v-row>

                        <v-row no-gutters  align="center" class="pt-8 pb-6">
                            <v-col cols="12" lg="7">
                                <div class="d-flex justify-start align-start">
                                    <div class="textHereSmall Montserrat-SemiBold mr-1"> INICIADOR: </div>
                                    <div class="textHereSmall Montserrat-Bold">Ministerio de Hacienda y Finanzas</div>
                                </div>
                            </v-col>
                            <v-col cols="12" lg="5">
                                <div class="d-flex align-start">
                                    <div class="textHereSmall Montserrat-SemiBold mr-1"> CUIT/DNI:</div>
                                    <div class="textHereSmall Montserrat-Bold">  27-32156227-1 </div>
                                </div>
                            </v-col>
                        </v-row>


                        <v-row no-gutters align="center">
                            <div class="d-flex column justify-start">
                                <div class="textHereSmall Montserrat-SemiBold mb-2 mr-1"> EXTRACTO: </div>
                                <div class="textHereSmall Montserrat-Bold text-justify"> RENDICION DE CUENTAS N° 01/20 FDO.PTE.GTOS.BIENES DE CONSUMO SERVICIOS
                NO PERSONALES. BS. USO Y TRANSF. DCTO N° 2548/20. $1.000.000,00 (MINISTERIO REPARTICION).-……………………………………………………………… </div>
                            </div>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </div>
</template>
<script>
    export default {
        name: 'Carátula',
    }
</script>
<style>
    .textHere{
        font-size: 32px;
    }
    .textHereBig{
        font-size: 22px;
    }
    .textHereSmall{
        font-size: 18px;
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