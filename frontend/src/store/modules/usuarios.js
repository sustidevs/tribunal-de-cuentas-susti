import axios from "axios";

const state = {
//
    user: {},
    loading: false,
    status: JSON.parse(localStorage.getItem('status') || "false" ),
    token: JSON.parse(localStorage.getItem('token') || "{}" ),
    btn_login: false,
};

const getters = {
    get_user: state => state.user,
    get_authenticated: state => state.status,
    get_loading: state => state.loading,
    get_btn_login: state => state.btn_login,
    get_token: state => state.token,
};

const actions = {

    //                    localStorage.setItem('status',JSON.stringify(response.data.status))
    //                     localStorage.setItem('token',JSON.stringify(response.data.access_token))

    getUsuario(){
        axios.post(process.env.VUE_APP_API_URL+ '/api/userData')
            .then(response => {
                console.log(response.data)
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
                    commit('set_btn_login', false)
            })
            .catch(error => {
                console.log(error.response.data)

                /**
                 * revisar errores
                commit('setAuthenticated', false)
                if (error.response.data.mensaje !== undefined) {
                    commit('set_noregistrado',error.response.data.mensaje)
                }
                commit('set_errorC', false)
                if (error.response.data.errors.cuil !== undefined) {
                    commit('set_errorCuil', error.response.data.errors.cuil)
                    commit('set_errorC', true)
                }

                commit('set_errorP', false)
                if (error.response.data.errors.password !== undefined) {
                    commit('set_errorPass', error.response.data.errors.password)
                    commit('set_errorP', true)
                }
                commit('set_btn_login', false)**/

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
                commit('set_finalizadoEnviados', false)
            })
    }
};

const mutations = {
    clearUserData: () => {
        localStorage.removeItem('token')
        localStorage.removeItem('status')
    },
    set_user: (state, user) => state.user = user,
    set_authenticated: (state, authenticated) => authenticated,
    set_btn_login:(state,btn_login) =>state.btn_login = btn_login,
};

export default {
    namespace: true,
    state,
    getters,
    actions,
    mutations,
}