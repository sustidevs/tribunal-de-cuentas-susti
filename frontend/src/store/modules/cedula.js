import axios from "axios";

const state = {
    cedula: "",
    cargado: false,
    error_cedula: '',
    cedulas: [],
};

const getters = {
    getCedula: state => state.cedula,
    get_cargado: state => state.cargado,
    get_error: state => state.error_cedula,
    get_cedulas: state => state.cedulas
};

const actions = {

    storeCedula({commit}, expediente) {
        axios
            .post(process.env.VUE_APP_API_URL + '/api/store-cedula', expediente)
            .then((response) => {
                console.log(response);
                commit('set_cargado', true)
                commit("set_cedula", response.data);
            })
            .catch(error => {
                commit('set_error_cedula', error.response.data.errors.descripcion)
            })
    },

};

const mutations = {
    set_cedula: (state, cedula) => state.cedula = cedula,
    set_cedulas: (state, cedulas) => state.cedulas = cedulas,
    set_cargado: (state, cargado) => state.cargado = cargado,
    set_error_cedula: (state, error_cedula) => state.error_cedula = error_cedula,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
};
