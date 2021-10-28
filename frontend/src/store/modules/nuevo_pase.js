import axios from "axios";

const state = {
    expedientes:[] ,
    fecha: '',
    areas: [],
};

const getters = {
    expedientePase: state => state.expedientes,
    idExpedientePase: state => state.expedientes.id,
    get_areas: state => state.areas,
    fechaPase: state => state.fecha,
 };

const actions = {

    getNuevoPase ({ commit }, expediente )  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial', expediente)
            .then(response => {
                commit('set_expedientes', response.data[3])
                commit('set_fecha',response.data[0])
                commit('set_areas',response.data[2])
            })
    },

    storePase ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial-expediente', expediente).
        then(response => {
            console.log("ola juan carls")
            commit('save_newPase', response.data)
            commit('set_creado', true)
        })
    },

    cerrarModal ({ commit }){
        commit('creado',false)
    },
};

const mutations = {
    set_expedientes: (state, expedientes) => state.expedientes = expedientes,
    set_fecha: (state, fecha) => state.fecha = fecha,
    set_areas: (state, areas) => state.areas = areas,
    save_newPase: (state, expediente) => state.expediente = expediente,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}




