import axios from "axios";

const state = {
  cedula: "",
  cargado: false,
};

const getters = {
    getCedula: (state) => state.cedula,
    cargado: state => state.cargado,
};

const actions = {
  storeCedula({ commit }, expediente) {
    axios
      .post(process.env.VUE_APP_API_URL + '/api/store-cedula', expediente)
      .then((response) => {
        console.log(response);
        commit('cargado', true)
        commit("set_cedula", response.data);
      });
  },

};

const mutations = {
  set_cedula: (state, cedula) => (state.cedula = cedula),
  cargado: (state, cargado) => state.cargado = cargado,
};

export default {
  namespace: true,
  state,
  getters,
  actions,
  mutations,
};
