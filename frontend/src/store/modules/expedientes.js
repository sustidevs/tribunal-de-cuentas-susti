import axios from "axios";
import router from "../../router";

const state = {
    //Arrays
    todos_expedientes: [],
    expedientes: [],
    historial: [],

    //Estado (finalizado)
    finalizado: false,
    aceptado: false,
};

const getters = {
    get_todos_expedientes: state => state.todos_expedientes,
    get_expedientes: state => state.expedientes,
    get_finalizado: state => state.finalizado,
    get_historial: state => state.historial,
    get_aceptado: state => state.aceptado,
}

const actions = {

    //muestra el detalle en la linea del tiempo - seguimiento
    historial_expediente ({commit}, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historialExp', expediente)
            .then(response => {
                commit('set_historial', response.data)
                router.push('/ver-historiales');
            })
    },

    // muestra todos los expedientes
    todosExpedientes ({commit}) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/indexExp')
            .then(response => {
                commit('set_todos_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    //Cambia de acuerdo al nro de bandeja que le pase
    // Bandeja de Entrada: 1
    // Mis expedientes: 3
    // Recuperar / Enviados que todavia no han sido aceptados: 4
    listadoExpedientes ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/ListadoExp', expediente)
            .then(response => {
                commit('set_expedientes', response.data)
                commit('set_finalizado', false)
            })
    },

    cambiarEstado ({commit}, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/update-estado', expediente).
        then(response => {
            commit('set_expedientes', response.data)
            commit('set_aceptado', true)
        })
    },
}

const mutations = {
    set_todos_expedientes: (state, todos_expedientes) => state.todos_expedientes = todos_expedientes,
    set_expedientes: (state, expedientes) => state.expedientes = expedientes,
    set_finalizado: (state, finalizado) => state.finalizado = finalizado,
    set_historial: (state,historial) => state.historial = historial,
    set_aceptado: (state,aceptado) => state.aceptado = aceptado,
}

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
