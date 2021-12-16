import axios from "axios";

const state = {
  cedula: "",
  cargado: false,
  error_cedula: '',
};

const getters = {
    getCedula: state => state.cedula,
    cargado: state => state.cargado,
    get_error: state => state.error_cedula,
};

const actions = {
  storeCedula({ commit }, expediente) {
    axios
      .post(process.env.VUE_APP_API_URL + '/api/store-cedula', expediente)
      .then((response) => {
        console.log(response);
        commit('cargado', true)
        commit("set_cedula", response.data);
      })
      .catch(error => {
        commit('set_error_cedula', error.response.data.errors.descripcion)
    })
  },

};

const mutations = {
  set_cedula: (state, cedula) => state.cedula = cedula,
  cargado: (state, cargado) => state.cargado = cargado,
  set_error_cedula: (state, error_cedula) => state.error_cedula = error_cedula,
};

export default {
  namespace: true,
  state,
  getters,
  actions,
  mutations,
};
