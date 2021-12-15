import axios from "axios";


const state = {
    cantidad_subsidioAporteNR: 0,
    cantidad_pendientes: 0,
};


const getters = {
    get_cantPendientes: state => state.cantidad_pendientes,
    getcantidad_subsidioAporteNR: state => state.cantidad_subsidioAporteNR
};


const actions = {
    cantidad_subsidioAporteNR ({ commit } , id_usuario) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/contarSubsidioAporteNR', id_usuario)
            .then(response => {
                console.log(response.data)
                commit('setcantidad_subsidioAporteNR', response.data)
            })
    },

    cantidadPendientes ({ commit }, usuario) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/contarExp', usuario)
            .then(response => {
                commit('set_cantPendientes', response.data)
            })
    },
};

const mutations = {
    setcantidad_subsidioAporteNR: (state, cantidad_subsidioAporteNR) => state.cantidad_subsidioAporteNR = cantidad_subsidioAporteNR,
    set_cantPendientes: (state, cantidad_pendientes) => state.cantidad_pendientes = cantidad_pendientes,
};


export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
