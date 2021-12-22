import axios from "axios";

const state = {
    expedientesPadre: [],

    expedientePadreSeleccionado:[],
    expedientesHijos: [],
    exp_desglose: '',
};

const getters = {
    getExpedientesHijos: state => state.expedientesHijos,
    getExpedientesPadres: state => state.expedientesPadre,
    getExpedientesPadresSeleccionados: state => state.expedientePadreSeleccionado,
    get_desglose: state => state.exp_desglose,
};

const actions = {
    desglosarVerPadres ({ commit } , expediente) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/indexExpPadres', expediente)
            .then(response => {
                commit('set_exp_padres', response.data)
            })
    },

    desglosarVerHijos ({ commit } , expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/createDesgloceExp', expediente)
            .then(response => {
                commit('set_exp_padres_seleccionado', response.data[0])
                commit('set_exp_hijos', response.data[1])
            })
    },

    desglose ({ commit } , expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/desgloceExp', expediente)
            .then(response => {
                console.log(response)
                commit('set_desglose', response)
            })
    },
};

const mutations = {
    set_exp_hijos: (state, expedientesHijos) => state.expedientesHijos = expedientesHijos,
    set_exp_padres: (state, expedientesPadre) => state.expedientesPadre = expedientesPadre,
    set_exp_padres_seleccionado: (state, expedientePadreSeleccionado) => state.expedientePadreSeleccionado = expedientePadreSeleccionado,
    set_desglose: (state, exp_desglose) => state.exp_desglose = exp_desglose,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
