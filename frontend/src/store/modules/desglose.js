import axios from "axios";

const state = {
    expedientesPadre: [],

    expedientePadreSeleccionado:[],
    expedientesHijos: [],
};

const getters = {
    getExpedientesHijos: state => state.expedientesHijos,
    getExpedientesPadres: state => state.expedientesPadre,
    getExpedientesPadresSeleccionados: state => state.expedientePadreSeleccionado
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

};

const mutations = {
    set_exp_hijos: (state, expedientesHijos) => state.expedientesHijos = expedientesHijos,
    set_exp_padres: (state, expedientesPadre) => state.expedientesPadre = expedientesPadre,
    set_exp_padres_seleccionado: (state, expedientePadreSeleccionado) => state.expedientePadreSeleccionado = expedientePadreSeleccionado,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
