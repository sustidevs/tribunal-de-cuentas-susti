import axios from "axios";

const state = {
    expedientes:[] ,
    fecha: '',
    areas: [],
    expediente: '',
    exitopase: false,
};

const getters = {
    expedientePase: state => state.expedientes,
    idExpedientePase: state => state.expedientes.id,
    get_areas: state => state.areas,
    fechaPase: state => state.fecha,
    expediente_exito: state => state.expediente,
    creado_exito:state => state.exitopase
 };

const actions = {

    getNuevoPase ({ commit }, expediente )  {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial', expediente)
            .then(response => {
                console.log(response)
                commit('set_expedientes', response.data[0])
                commit('set_fecha',response.data[2])
                commit('set_areas',response.data[1])
            })
    },

    storePase ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/historial-expediente', expediente).
        then(response => {
            console.log(response)
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
    set_creado: (state, exitopase) => state.exitopase = exitopase,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}




