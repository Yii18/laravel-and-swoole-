const navbar = require('./components/include/navbar.vue'),
      rside = require('./components/include/rside.vue'),
      postCreate = require('./components/post/create.vue'),
      postCreateShow = require('./components/post/create-show.vue'),
      postInfo = require('./components/post/show.vue'),
      postList = require('./components/post/list.vue'),
      commentList = require('./components/comm/list.vue'),
      aboutMe = require('./components/about/me.vue'),
      user = require('./components/user/post-list.vue'),
      tags = require('./components/tags/list.vue');


export default [
    {
        name: 'postList',
        path: '/',
        components: {
            navbar: navbar,
            main: postList,
            rside: rside,
            post: postInfo
        }
    },
    {
        name: 'postCreate',
        path: '/post/create',
        components: {
            navbar: navbar,
            main: postCreate,
            post: postCreateShow
        }
    },
    {
        name: 'postInfo',
        path: '/post/:pid',
        components: {
            navbar: navbar,
            main: postList,
            rside: rside,
            post: postInfo
        }
    },
    {
        name: 'commentList',
        path: '/comm',
        components: {
            navbar: navbar,
            main: commentList
        }
    },
    {
        name: 'aboutMe',
        path: '/about',
        components: {
            main: aboutMe,
            navbar: navbar
        }
    },
    {
        name: 'user',
        path: '/user/:uid',
        components: {
            navbar: navbar,
            main: user,
            post: postInfo
        }
    },
    {
        name: 'userPostInfo',
        path: '/user/:uid/post/:pid',
        components: {
            navbar: navbar,
            main: user,
            post: postInfo
        }
    },
    {
        name: 'tags',
        path: '/tags/:tid',
        components: {
            navbar: navbar,
            main: tags,
            post: postInfo
        }
    },
    {
        path: '*',
        redirect: { name: 'postList' }
    },
]
