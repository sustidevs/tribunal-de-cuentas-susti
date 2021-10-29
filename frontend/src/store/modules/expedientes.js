import axios from "axios";

const state = {
    expedientes: [],
    extracto: '', //para guardar el extracto v-model
    nro_expediente: '000 - 0000000 - 0000',
    bandeja: false,
    expediente_bandeja: [],
    expediente_asignado: [],
    aceptado: false,
    recuperado: false,
    user_id:  JSON.parse(localStorage.getItem('user.id') || "{}" ),
    cantidad_pendientes: 0,
    finalizado: true,

};

const getters = {
    //no cambian el estado pero si formatean para que podamos utilizar esa info de la manera que queramos.
    //propiedad computed
    //te devuelve un nuevo objeto diferente con los datos filtrados que necesita.
    allExpedientes: state => state.expedientes,
    expediente: state => state.expediente,
    extracto: state => state.extracto,
    nro_expediente: state => state.nro_expediente,
    allBandejaEntrada: state => state.expediente_bandeja,
    aceptado: state => state.aceptado,
    get_cantPendientes: state => state.cantidad_pendientes,
    recuperado: state => state.recuperado,
    get_finalizado: state => state.finalizado,
};

const actions = {

    getCantidadPendientes ({ commit }, usuario) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/contarExp', usuario)
            .then(response => {
                console.log(response.data)
                commit('set_cantPendientes', response.data)
            })

    },

    getExpedientes ({ commit }, expediente)  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/ListadoExp', expediente)
            .then(response => {
                commit('set_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    cerrarModal ({ commit }){
        commit('creado',false)
    },

    nroExpedienteAleatorio ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/nroExp', expediente)
            .then(response => {
            commit('saveNewNroExpediente', response.data)
        })
    },

    extracto ({ commit }, extracto) {
        commit('saveExtracto',extracto)
    },

    cerrar ({ commit }){
        commit('aceptado',false)
    },

    recibir({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/update-estado-cuerpo', expediente).
        then(response => {
            console.log(response)
            commit('aceptado', true)
            commit('set_bandejaEntrada', response.data)
        })
    },

    getBandejaEntrada({commit}, bandeja){
        axios.post(process.env.VUE_APP_API_URL+ '/api/ListadoExp', bandeja)
            .then(response => {
                commit('set_bandejaEntrada', response.data)
                commit('set_finalizado', false)
            })
    },

    recuperar({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/update-estado-cuerpo', expediente).
        then(response => {
            console.log(response)
            commit('recuperado', true)
            commit('set_expedientes', response.data)
        })
    },

};

const mutations = {
    //son las unicas funciones que pueden modificar el estado
    //se pueden inicializar en el componente a utilizar a traves de commit o inicializarse a traves de una accion
    set_expedientes: (state, expedientes) => state.expedientes = expedientes,
    saveNewNroExpediente:(state, nro_expediente) => state.nro_expediente = nro_expediente,
    saveExtracto: (state, extracto) => state.extracto = extracto,
    aceptado: (state, aceptado) => state.aceptado = aceptado,
    set_cantPendientes: (state, cantidad_pendientes) => state.cantidad_pendientes = cantidad_pendientes,
    recuperado: (state, recuperado) => state.recuperado = recuperado,
    set_finalizado: (state, finalizado) => state.finalizado = finalizado,
    set_bandejaEntrada: (state,expediente_bandeja) => state.expediente_bandeja = expediente_bandeja,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}



