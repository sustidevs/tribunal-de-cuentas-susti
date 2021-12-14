import axios from "axios";

const state = {
    areas: [],
    exp_englose: '',
};

const getters = {
    get_englose: state => state.exp_englose,
};

const actions = {
    englosar ({ commit } , expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/unionExp', expediente)
            .then(response => {
                commit('set_areas', response)
                commit('set_englose', response)
            })
    },
};

const mutations = {
    set_areas: (state, areas) => state.areas = areas,
    set_englose: (state, exp_englose) => state.exp_englose = exp_englose,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}
