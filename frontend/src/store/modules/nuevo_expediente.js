import axios from "axios";

const state = {
    iniciadores: [],
    fecha: '',
    motivoSinExtracto: [],
    motivoConExtracto: [],
    areas_nuevo: [],
    prioridad: [],
    iniciadorSelected: 0,
    creado: false,
    expediente: [],

    descripcion_extractoerror: '',
    iniciador_iderror: '',
    nro_fojaserror: '',
    prioridaderror: '',
};

const getters = {
    expediente_new: state => state.expediente,
    allIniciadores: state => state.iniciadores,
    fecha: state => state.fecha,
    motivoSinExtracto: state => state.motivoSinExtracto,
    motivoConExtracto: state => state.motivoConExtracto,
    prioridad: state => state.prioridad,
    get_iniciadorSelected: state => state.iniciadorSelected,
    get_areas_all: state => state.areas_nuevo,
    creado: state => state.creado,

    descripcion_extracto_error: state => state.descripcion_extractoerror,
    iniciador_id_error: state => state.iniciador_iderror,
    nro_fojas_error:  state => state.nro_fojaserror,
    prioridad_error:  state => state.prioridaderror,
};

const actions = {

    capturarIniciador ({ commit }, iniciador) {
        commit ('set_iniciadorSelected', iniciador)
    },

    getCreate ({ commit })  {
        axios.get(process.env.VUE_APP_API_URL+ '/api/createExp')
            .then(response => {
                console.log(response)
                let fec= response.data[0];
                commit('set_fecha', fec)

                let inici = response.data[1];
                commit('set_iniciadores', inici)

                let motivosin = response.data[2];
                commit('set_motivoSinExt', motivosin)

                let motivocon = response.data[3];
                commit('set_motivoConExt', motivocon)

                let priori = response.data[4];
                commit('set_prioridad', priori)

                let are = response.data[5];
                commit('set_area', are)
            })
    },

    storeExpediente ({ commit }, expediente) {
        axios.post(process.env.VUE_APP_API_URL+ '/api/storeExp', expediente).
        then(response => {
            console.log (response.data)
                commit('saveNewExp', response.data)
                commit('set_creado', true)
        })
        .catch(error => {
            console.log (error.response.data.errors)
                commit('set_descripcion_extracto_error', error.response.data.errors.descripcion_extracto[0])
                commit('set_iniciador_id_error', error.response.data.errors.iniciador_id[0])
                commit('set_nro_fojas_error', error.response.data.errors.nro_fojas[0])
                commit('set_prioridad_error', error.response.data.errors.prioridad_id[0])
            })
    },
};

const mutations = {
    set_fecha: (state, fecha) => state.fecha = fecha,
    set_iniciadores: (state, iniciadores) => state.iniciadores = iniciadores,
    set_motivoSinExt: (state, motivoSinExtracto) => state.motivoSinExtracto = motivoSinExtracto,
    set_motivoConExt: (state, motivoConExtracto) => state.motivoConExtracto = motivoConExtracto,
    set_prioridad: (state, prioridad) => state.prioridad = prioridad,
    set_iniciadorSelected: (state, iniciadorSelected) => state.iniciadorSelected = iniciadorSelected,
    set_area: (state, areas_nuevo) => state.areas_nuevo = areas_nuevo,
    saveNewExp: (state, expediente) => state.expediente = expediente,
    set_creado: (state, creado) => state.creado = creado,

    set_descripcion_extracto_error: (state,descripcion_extractoerror)  =>  state.descripcion_extractoerror = descripcion_extractoerror,
    set_iniciador_id_error: (state,iniciador_iderror ) => state.iniciador_iderror = iniciador_iderror,
    set_nro_fojas_error:  (state,nro_fojaserror ) => state.nro_fojaserror = nro_fojaserror,
    set_prioridad_error:  (state,prioridaderror ) => state.prioridaderror = prioridaderror,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations
}




