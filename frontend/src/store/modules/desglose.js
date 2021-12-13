import axios from "axios";

const state = {
    expedientesPadre: [],
    expedientesHijos: [],
};

const getters = {
    getExpedientesHijos: state => state.expedientesHijos,
    getExpedientePadre: state => state.expedientesPadre,
};

const actions = {
    desglosarVer ({ commit } , expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/createDesgloceExp', expediente)
            .then(response => {
                console.log(response.data[1])
                commit('set_exp_padres', response.data[0])
                commit('set_exp_hijos', response.data[1])
            })
    },
};

const mutations = {
    set_exp_hijos: (state, expedientesHijos) => state.expedientesHijos = expedientesHijos,
    set_exp_padres: (state, expedientesPadre) => state.expedientesPadre = expedientesPadre,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
