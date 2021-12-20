import axios from "axios";

const state = {
    cedula: [],
    cargado: false,
    error_cedula: [],
    cedulas: [],
    cedula_detalle: [],
};

const getters = {
    get_detalle: state => state.cedula_detalle,
    getCedula: state => state.cedula,
    get_cargado: state => state.cargado,
    get_error: state => state.error_cedula,
    get_cedulas: state => state.cedulas
};

const actions = {

    verDetalle({commit},expediente_id) {
        axios
            .post(process.env.VUE_APP_API_URL + '/api/contar-cedula', expediente_id)
            .then((response) => {
                console.log(response.data)
                commit('set_cargado', true)
                commit("set_ceduladetalle", response.data);
            })
            .catch(error => {
                commit('set_error_cedula', error.response.data.errors.descripcion)
            })
    },

    storeCedula({commit}, expediente) {
        axios
            .post(process.env.VUE_APP_API_URL + '/api/store-cedula', expediente)
            .then((response) => {
                commit('set_cargado', true)
                commit("set_cedula", response.data[0]);
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
    set_ceduladetalle: (state, cedula_detalle) => state.cedula_detalle = cedula_detalle,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
};
