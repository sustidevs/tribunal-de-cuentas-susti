import axios from "axios";
axios.defaults.baseURL=process.env.VUE_APP_API_URL
const state = {
//
    user: JSON.parse(localStorage.getItem('user') || "{}" ),
    errorCuil: {},
    errorPass: {},
    errorC: false,
    errorP: false,
    errorAmbos: false,
    incorrecto: false,
    authenticated: false,
    cuil: {},
    newPass:false,
    loading: false,
    misEnviados: [],

    finalizado: true,
    verificarPass: false,
    updatePass: false,


    //errores
    error_passwordOld: '',
    error_password: '',
    error_passwordFail: '',
};

const getters = {

    getErrorPass: state=>state.error_password,
    getUpdatePass: state =>state.updatePass,
    getErrorPassOld: state=>state.error_passwordOld,
    getErrorPassFail: state=>state.error_passwordFail,

    getVerificarPass: state => state.verificarPass,
    getMisEnviados: state => state.misEnviados,
    getLoading: state => state.loading,
    getUser: state => state.user,
    incorrecto: state => state.incorrecto,
    getAreaId: state => state.user.area_id,
    getIdUser: state => state.user.user_id,
    getArea: state => state.user.area,
    getNombreApellido: state => state.user.nombre + "  " + state.user.apellido,
    getCorreo: state => state.user.email,
    getErrorCuil: state => state.errorCuil,
    getErrorPassword: state => state.errorPass,
    errorC: state => state.errorC,
    errorP: state => state.errorP,
    errorAmbos: state => state.errorAmbos,
    authenticated: state => state.user.logueado,
    getTipoUsuario: state=> state.user.tipo_user,
    getCuil: state => state.user.cuil,
    getNewPass: state => state.newPass,
    get_finalizado: state => state.finalizado,
};

const actions = {

   login ({ commit }, user) {
        axios.get('/sanctum/csrf-cookie');
        axios.post(process.env.VUE_APP_API_URL+ '/api/login', user)
            .then(response => {
                if (response.status === 201){
                    commit('set_errorA', response.data)
                }else{
                    commit('set_user', response.data.user)
                    localStorage.setItem('user',JSON.stringify(response.data.user))
                    commit('setAuthenticated', true)
                }
            })
            .catch(error => {
                        commit('setAuthenticated', false)
                        commit('set_errorCuil', error.response.data.errors.cuil)
                        commit('set_errorC', false)
                        if (error.response.data.errors.cuil !== undefined) {
                            commit('set_errorC', true)
                        }
                        commit('set_errorPass', error.response.data.errors.password)
                        commit('set_errorP', false)
                        if (error.response.data.errors.password !== undefined) {
                            commit('set_errorP', true)
                        }
            })
    },

    logout ({ commit }) {
        commit('clearUserData')
        commit('setAuthenticated', false)
    },

    verificarPass({commit}, newPass){
        axios.post(process.env.VUE_APP_API_URL+ '/api/validarPassword', newPass)
            .then(response => {
                if (response.status === 201){
                    commit('set_error_passFail', response.data)
                }else{
                    commit('setVerificarPass', response.data)
                }
            })
            .catch(error => {
                commit('set_error_passOld', error.response.data.errors.password[0])
            })
    },

    // editPassword({commit}, user) {
    //     axios.get(process.env.VUE_APP_API_URL+ '/api/editUser',user)
    //         .then(response => {
    //             console.log(response)
    //             commit('set_user', response.data)
    //         })
    // }

    nuevaContrasena({commit}, newPass){
        axios.post(process.env.VUE_APP_API_URL+ '/api/actualizaPassword', newPass)
            .then(response => {
                commit('setNewPass', response.data)
                commit('set_error_pass', '')
            })
            .catch(error => {
                commit('set_error_pass', error.response.data.errors.password[0])
            })
    },

    mis_enviados({commit}, expediente){
        axios.post(process.env.VUE_APP_API_URL+ '/api/mis-enviados', expediente)
            .then(response => {
                commit('set_expedientesEnviados', response.data),
                commit('set_finalizado', false)
            })
    }
};

const mutations = {


    set_error_passFail: (state, error_passwordFail) => state.error_passwordFail = error_passwordFail,
    set_error_pass: (state, error_password) => state.error_password = error_password,
    set_update_pass: (state, updatePass) => state.updatePass = updatePass,
    set_error_passOld: (state, error_passwordOld) => state.error_passwordOld = error_passwordOld,
    setVerificarPass: (state, verificarPass) => state.verificarPass = verificarPass,
    set_finalizado: (state, finalizado) => state.finalizado = finalizado,
    set_expedientesEnviados: (state, expedientes) => state.misEnviados = expedientes,
    set_user: (state, user) => state.user = user,
    set_errorCuil: (state, errorCuil) => state.errorCuil = errorCuil,
    set_errorC: (state, errorC) => state.errorC = errorC,
    set_errorP: (state, errorP) => state.errorP = errorP,
    set_errorA: (state, errorAmbos) => state.errorAmbos = errorAmbos,
    set_errorPass: (state, errorPass) => state.errorPass = errorPass,
    setIncorrecto: (state, incorrecto) => state.incorrecto = incorrecto,
    setAuthenticated: (state, authenticated) => state.authenticated = authenticated,
    setCuil: (state, cuil) => state.cuil = cuil,
    clearUserData: () => {
        localStorage.removeItem('user')
    },
    setNewPass: (state, newPass) => state.newPass = newPass
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
}