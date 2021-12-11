import axios from "axios";

const state = {
    areas: [],
};

const getters = {

};

const actions = {
    englosar ({ commit } , expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/unionExp', expediente)
            .then(response => {
                console.log(response)
                commit('set_areas', response)
            })
    },
};

const mutations = {
    set_areas: (state, areas) => state.areas = areas,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
