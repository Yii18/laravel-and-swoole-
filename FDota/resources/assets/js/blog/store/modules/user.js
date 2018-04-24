import * as types from '../mutation-types'

// initial state
const state = {
    id: null,
    name: null,
    avatar: '/images/default.jpg',
    info: {
        id: null,
        name: null,
        avatar: '/images/default.jpg',
    },
    list: [],
    userLoad: false
}

// getters
const getters = {

}

// actions
const actions = {
    checkLogin ({ commit }) {
        let url = '/check-login'

        Vue.http.get(url).then((res) => {
            commit(types.CHECK_LOGIN, res.data)
        }, (err) => {

        })
    },
    getUser ({ commit }, uid) {
        let url = '/api/user/' + uid

        commit(types.USER_LOAD, true)
        Vue.http.get(url).then((res) => {
            commit(types.GET_USER_INFO, res.data.user)
            commit(types.GET_USER_POSTS, res.data.list)
            commit(types.USER_LOAD, false)
        }, (err) => {

        })
    }
}

// mutations
const mutations = {
    [types.CHECK_LOGIN] (state, data) {
        state.id = data.id
        state.name = data.name
        if (data.avatar) {
            state.avatar = data.avatar
        }
    },
    [types.GET_USER_INFO] (state, data) {
        state.info.id = data.id
        state.info.name = data.name
        if (data.avatar) {
            state.info.avatar = data.avatar
        }
    },
    [types.GET_USER_POSTS] (state, data) {
        state.list = data
    },
    [types.USER_LOAD] (state, data) {
        state.userLoad = data
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}