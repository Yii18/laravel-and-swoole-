import * as types from '../mutation-types'

// initial state
const state = {
    tag: {},
    list: [],
    postLoad: false
}

// getters
const getters = {

}

// actions
const actions = {
    getTag ({ commit }, tid) {
        let url = '/api/tags/' + tid

        commit(types.TAGS_LOAD, true)
        Vue.http.get(url).then((res) => {
            commit(types.GET_TAGS_INFO, res.data.tag)
            commit(types.GET_TAGS_POSTS, res.data.list)
            commit(types.TAGS_LOAD, false)
        }, (err) => {

        })
    }
}

// mutations
const mutations = {
    [types.GET_TAGS_INFO] (state, data) {
        state.tag = data
    },
    [types.GET_TAGS_POSTS] (state, data) {
        state.list = data
    },
    [types.TAGS_LOAD] (state, data) {
        state.postLoad = data
    }
}

export default {
    state,
    getters,
    actions,
    mutations
}