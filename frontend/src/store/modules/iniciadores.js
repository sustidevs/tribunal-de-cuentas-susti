import axios from "axios";

const state = {
    tipoEntidad: [],
    iniciador: [],
    finalizado: true,
};

const getters = {
    iniciador: state => state.iniciador,
    allTipoEntidad: state => state.tipoEntidad,
    get_tipoSelected: state => state.tipoSelected,
    get_finalizado: state => state.finalizado,
};

const actions = {
    createTipoEntidad ({ commit }) {
        axios.get(process.env.VUE_APP_API_URL+ '/api/createTipoEntidad')
            .then(response => {
                console.log(response)
                commit('set_tipoSelected', response.data)
            })
    },

    storeIniciador ({ commit }, iniciador)  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/storeIniciador', iniciador)
            .then(response => {
                console.log(response)
                commit('set_iniciador', response.data)
            })
    },

    getIniciador ({ commit }, idIniciador)  {
    axios.post(process.env.VUE_APP_API_URL+ '/api/edit-iniciador', idIniciador)
            .then(response => {
                console.log(response)
                commit('set_iniciador', response.data)
            })
    },

    updateIniciador ({ commit }, inic)  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/update-iniciador', inic)
            .then(response => {
                console.log(response)
                commit('set_iniciador', response.data)
            })
    },
};

const mutations = {
    set_tipoSelected: (state, tipoEntidad) => state.tipoEntidad = tipoEntidad,
    set_iniciador: (state, iniciador) => state.iniciador = iniciador,
    set_finalizado: (state, finalizado) => state.finalizado = finalizado,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}