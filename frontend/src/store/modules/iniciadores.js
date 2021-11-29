import axios from "axios";

const state = {
    tipoEntidad: [],
    iniciador: '',
};

const getters = {
    iniciador: state => state.iniciador,
    allTipoEntidad: state => state.tipoEntidad,
    get_tipoSelected: state => state.tipoSelected,
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
                commit('saveNewIniciador', response.data)
            })
    },
};

const mutations = {
    saveNewIniciador: (state, iniciador) => state.iniciador = iniciador,
    set_tipoSelected: (state, tipoEntidad) => state.tipoEntidad = tipoEntidad,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}