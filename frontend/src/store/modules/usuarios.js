import axios from "axios";

const state = {
    user: {},
    logueado: false,
    loading: false,
    status: JSON.parse(localStorage.getItem('status') || "false" ),
    token: JSON.parse(localStorage.getItem('token') || "{}" ),
    nro: JSON.parse(localStorage.getItem('nro') || "{}" ),
    btn_login: false,

    //errores login
    errores: false,
    error_logeo: '',
    error_cuil: '',
    error_contra: '',
};

const getters = {
    get_user: state => state.user,
    get_authenticated: state => state.status,
    get_loading: state => state.loading,
    get_btn_login: state => state.btn_login,
    get_token: state => state.token,
    get_logueo: state => state.logueado,

    get_errores: state => state.errores,
    //usario o contraseña incorrecta
    get_error_logeo: state => state.error_logeo,
    get_error_Cuil: state => state.error_cuil,
    //para contraseña vacia o con letras
    get_error_contra: state => state.error_contra,
};

const actions = {

    getUsuario({ commit }){
        commit('set_btn_login', true);
        axios.post(process.env.VUE_APP_API_URL+ '/api/userData')
            .then(response => {
                commit('set_user', response.data)
                commit('set_btn_login', false)
            })
            .catch(error => {
                console.log(error.response.data)
            })
    },

   login ({ commit }, user) {
       commit('set_btn_login', true);
        axios.post(process.env.VUE_APP_API_URL+ '/api/login', user)
            .then(response => {
                    localStorage.setItem('status',JSON.stringify(response.data.status))
                    localStorage.setItem('token',JSON.stringify(response.data.access_token))
                    commit('set_user', response.data)
                    commit('set_logueo', true)
                    commit('set_btn_login', false)
                    commit('set_logueo', true)
            })
            .catch(error => {
                commit('set_btn_login', false)
                commit('set_error_logeo',error.response.data.mensaje)
                commit('set_error_cuil', error.response.data.errors.cuil)
                commit('set_error_contra', error.response.data.errors.password)
                
                /**
                  * revisar errores
                    No se cachea el mensaje de las request de CUIL vacio o contraseña vacia
                **/

            })
    },

    logout ({ commit }) {
        commit('clearUserData')
        commit('set_authenticated', false)
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
                commit('set_finalizadoEnviados', false)
            })
    }
};

const mutations = {
    clearUserData: () => {
        localStorage.removeItem('token')
        localStorage.removeItem('status')
        localStorage.removeItem('nro')
    },
    set_aceptado: (state,aceptado) => state.aceptado = aceptado,
    set_logueo: (state, logueado) => state.logueado = logueado,
    set_user: (state, user) => state.user = user,
    set_authenticated: (state, status) => state.status = status,
    set_btn_login:(state,btn_login) => state.btn_login = btn_login,

    set_errores:(state, errores) => state.errores = errores,
    set_error_logeo:(state, error_logeo) => state.error_logeo = error_logeo,
    set_error_cuil:(state, error_cuil) => state.error_cuil = error_cuil,
    set_error_contra:(state, error_contra) => state.error_contra = error_contra,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
}