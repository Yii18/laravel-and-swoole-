import * as config from '../../config/app'
import * as types from '../mutation-types'

// initial state
const state = {
    list: [],
    listLoad: false,

    info: {
        title: '',
        time: '',
        click: '',
        content: ''
    },
    infoLoad: false,

    comment: [],
    commentLoad: false,

    postsTemplate: {
        title: '',
        time: '',
        click: '',
        content: ''
    }
}

// getters
const getters = {

}

// actions
const actions = {
    refreshPosts ({ commit }) {
        let url = '/api/post'

        commit(types.POSTS_LOAD, true)
        Vue.http.get(url).then((res) => {
            commit(types.REFRESH_POSTS, res.data.list)
            commit(types.POSTS_LOAD, false)
        }, (err) => {

        })
    },
    getPost ({ commit }, pid) {
        let url = '/api/post/' + pid

        commit(types.POST_LOAD, true)
        Vue.http.get(url).then((res) => {
            commit(types.GET_POST, res.data.post)
            commit(types.POST_LOAD, false)
        }, (err) => {

        })
    },
    getPostComments ({ commit }, pid) {
        let url = '/api/post/comment/' + pid

        commit(types.POST_COMMENTS_LOAD, true)
        Vue.http.get(url).then((res) => {
            commit(types.GET_POST_COMMENTS, res.data.comment)
            commit(types.POST_COMMENTS_LOAD, false)
        }, (err) => {

        })
    },
    submitComment ({ commit }, data) {
        let url = '/' + config.version + '/post/' + data.pid;

        Vue.http.post(url, { content: data.content }).then((res) => {
            commit(types.UNSHIFT_POST_COMMENT, res.data.comment)
        }, (err) => {

        })
    },
    updatePostTemplateTitle ({ commit }, title) {
        commit(types.UPDATE_POST_TEMPLATE_TITLE, title)
    },
    updatePostTemplateContent ({ commit }, content) {
        commit(types.UPDATE_POST_TEMPLATE_CONTENT, content)
    },
}

// mutations
const mutations = {
    [types.REFRESH_POSTS] (state, data) {
        state.list = data
    },
    [types.POSTS_LOAD] (state, data) {
        state.listLoad = data
    },
    [types.GET_POST] (state, data) {
        state.info = data
    },
    [types.POST_LOAD] (state, data) {
        state.infoLoad = data
    },
    [types.GET_POST_COMMENTS] (state, data) {
        state.comment = data
    },
    [types.POST_COMMENTS_LOAD] (state, data) {
        state.commentLoad = data
    },
    [types.UNSHIFT_POST_COMMENT] (state, data) {
        state.comment.unshift(data)
    },
    [types.UPDATE_POST_TEMPLATE_TITLE] (state, data) {
        state.postsTemplate.title = data
    },
    [types.UPDATE_POST_TEMPLATE_CONTENT] (state, data) {
        state.postsTemplate.content = data
    },
}

export default {
    state,
    getters,
    actions,
    mutations
}