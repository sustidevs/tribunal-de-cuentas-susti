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
    newPass:{}
};

const getters = {
    getUser: state => state.user,
    incorrecto: state => state.incorrecto,
    getIdUser: state => state.user.user_id,
    getArea: state => state.user.area,
    getNombreApellido: state => state.user.nombre + "  " + state.user.apellido,
    getCorreo: state => state.user.email,
    getErrorCuil: state => state.errorCuil,
    getErrorPassword: state => state.errorPass,
    errorC: state => state.errorC,
    errorP: state => state.errorP,
    errorAmbos: state => state.errorAmbos,
    authenticated: state => state.authenticated,
    getTipoUsuario: state=> state.user.tipo_user,
    getCuil: state => state.user.cuil,
    getNewPass: state => state.newPass
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
                console.log(error)
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
    },
    
    // editPassword({commit}, user) {
    //     axios.get(process.env.VUE_APP_API_URL+ '/api/editUser',user)
    //         .then(response => {
    //             console.log(response)
    //             commit('set_user', response.data)
    //         })
    // }

    nuevaContrasena({commit}, newPass){
        axios.post(process.env.VUE_APP_API_URL+ '/api/updateUser', newPass)
            .then(
                commit('setNewPass', true)
            )
    }
};

const mutations = {
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