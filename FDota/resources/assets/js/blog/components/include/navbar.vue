<template>
    <nav class="navbar navbar-default navbar-fixed-top">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button @click="navbarCollapsed = !navbarCollapsed" :class="navbarCollapsed ? '' : 'active'" type="button" class="navbar-toggle collapsed pull-right">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar top"></span>
                <span class="icon-bar patty"></span>
                <span class="icon-bar bottom"></span>
            </button>
            <button @click="navbarSearchField = !navbarSearchField" :class="navbarSearchField ? '' : 'active'" type="button" class="navbar-toggle collapsed pull-left">
               <span class="search-label">
                   <i class="fa fa-search" aria-hidden="true"></i>
               </span>
            </button>
            <div :class="navbarSearchField ? '' : 'active'" class="navbar-title pull-left">
                <router-link :to="{ name:'postList' }">FDOTA</router-link>

                <form class="search-field" action="" method="get">
                    <input type="text" name="q" placeholder="搜索 BLOG" required="required">
                </form>
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div :class="navbarCollapsed ? '' : 'active'" class="navbar-collapse">
            <ul @click="navbarCollapsed = true" id="nav" class="nav navbar-nav navbar-icon">
                <li>
                    <router-link id="index" title="首页"
                                 :to="{ name:'postList' }" exact>
                        <i class="fa fa-home" aria-hidden="true"></i>首页
                    </router-link>
                </li>
                <li>
                    <router-link id="comm" title="留言"
                                 :to="{ name:'commentList' }">
                        <i class="fa fa-comments" aria-hidden="true"></i>留言
                    </router-link>
                </li>
                <li>
                    <router-link id="about" title="关于我"
                                 :to="{ name:'aboutMe' }">
                        <i class="fa fa-info" aria-hidden="true"></i>关于
                    </router-link>
                </li>
            </ul>

            <ul class="nav navbar-nav navbar-right user-tools">
                <li class="search">
                    <form role="search" method="get" action="" class="navbar-form navbar-right">
                        <input type="text" name="q" placeholder="搜索" required="required" class="form-control">
                    </form>
                </li>
                <li v-if="auth" :class="activeUser ? 'open' : ''" class="dropdown">
                    <button @click="activeUser = !activeUser" :class="activeUser ? 'active' : ''" class="tab user" title="帐户"><i class="fa fa-user" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="popover-header">
                                帐户
                                <a href="/logout" class="logout"
                                   onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                                    退出
                                </a>
                                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                                    <input type="hidden" name="_token" :value="_token">
                                </form>
                            </div>
                        </li>
                        <li><a href="javascript:;"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;设置</a></li>
                    </ul>
                </li>
                <li v-if="auth" @click="navbarCollapsed = true">
                    <router-link :to="{name: 'postCreate'}" class="tab create" title="撰写文章" ><i class="fa fa-pencil" aria-hidden="true"></i></route-link>
                </li>
                <li v-if="!auth">
                    <a class="login" href="/login">登录</a>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</template>

<script>
    export default {
        data () {
            return {
                activeUser: false,
                navbarCollapsed: true,
                navbarSearchField: true
            }
        },
        computed: {
            auth () {
                return this.$store.state.user.id ? true : false;
            },
            user () {
                return this.$store.state.user;
            },
            _token () {
                return document.getElementsByName('csrf-token')[0].content;
            }
        },
        methods: {

        }
    }
</script>

<style lang="sass" scoped>
    @media (min-width: 768px) {
        #navbar.active {
            .navbar-right {
                float: left !important;
            }
        }
    }

    .navbar-icon {
        a {
            i {
                font-size: 18px;
                margin-right: 0.5rem;
                width: 20px;
                text-align: center;
            }
        }
    }

    .search-label {
        position: absolute;
        width: 42px;
        height: 42px;
        line-height: 42px;
        background: transparent;
        font-size: 22px;
        border: none;
        color: hsla(0,0%,100%,.7);
        right: 0;
        top: 0;
        text-align: center;
    }

    .active .search-label {
        color: hsla(0,0%,100%,1);
    }

    .user-tools {
        transition: all .3s cubic-bezier(.4,0,0,1);
        > li {
            padding: 0 16px;
        }
        a:hover,
        a:focus {
            background-color: transparent;
        }
    }

    .popover-header {
        overflow: hidden;
        background: #f2f2f2;
        border-bottom: 1px solid #e7e7e7;
        position: relative;
        z-index: 10;
        text-transform: uppercase;
        font-size: 11px;
        font-weight: 700;
        color: #666;
        height: 26px;
        padding: 0 12px;
        margin: 0;
        line-height: 26px;
    }

    .dropdown-menu {
        margin: 3px 0;
        padding: 0;
        list-style: none;
        li {
            display: block;
            border: 0;
            padding: 0;
            font-size: 14px;
            font-weight: 400;
            color: #444;
            text-overflow: ellipsis;
            white-space: nowrap;
            > a {
                padding: 10px 15px;
                color: #3e5266;
                i {
                    float: left;
                    font-size: 18px;
                    margin-right: 10px;
                    width: 20px;
                    height: 20px;
                    text-align: center;
                }
            }
        }
        li:hover {
            background: #e6eff7;
        }
    }

    .logout {
        float: right;
    }

    .tab {
        margin: 8px 0;
        padding: 0;
        font-size: 24px;
        line-height: 36px;
        display: block;
        height: 36px;
        border: 0;
        background-color: transparent;
        color: hsla(0,0%,100%,.6);
        cursor: pointer;
        outline:none;
        user-select: none;
        i {
            color: rgba(255, 255, 255, 0.6);
        }
    }

    .tab.active {
        color: #fff;
    }

    .navbar-default .navbar-nav > li > a.tab {
        margin: 8px 0;
    }

    .navbar-default .navbar-nav > li > a.tab,
    .navbar-default .navbar-nav > li > a.tab:hover,
    .navbar-default .navbar-nav > li > a.tab:focus {
        color: inherit;
    }

    .navbar-title {
        width: calc(100% - 84px);
        margin: auto;
        font-size: 16px;
        line-height: 42px;
        text-align: center;
        overflow: hidden;
        transition-property: transform;
        transition-duration: .2s;
        transition-timing-function: ease;
        transform: translateY(0);
        a {
            color: #999;
        }
    }

    .navbar-title.active {
        transform: translateY(-44px);
    }

    @media (min-width: 768px) {
        .navbar-title {
            display: none;
        }
    }

    .search-field {
        padding: 0 10px;
        input{
            border: none;
            background: transparent;
            color: #fff;
            font-weight: 500;
            border-radius: 0;
            height: 34px;
            font-size: 17px;
            top: 5px;
            text-align: center;
            border-bottom: 2px solid hsla(0,0%,100%,.3);
            width: 100%;
            position: relative;
            padding: 0 20px;
            transition: border-bottom-color .2s linear;
        }
    }

    .search {
        input {
            color: #fff;
            border: 2px solid #597289;
            background-color: transparent;
        }
    }

    @media (max-width: 768px) {
        .search {
            display: none;
        }
    }
</style>
