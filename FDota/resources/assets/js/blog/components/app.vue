<template>
    <div id="app">
        <router-view name="navbar" id="navbar" :class="active" class="col-md-8 col-md-offset-2"></router-view>
        <div id="main" :class="active" class="col-md-8 col-md-offset-2">
            <router-view name="rside"></router-view>
            <router-view name="main"></router-view>
        </div>
        <router-view name="post" id="post" :class="hidden"></router-view>
    </div>
</template>
<script>
    export default {
        computed: {
            active () {
                let _class = '';
                if (this.$route.name == 'postCreate') {
                    _class += 'create-post ';
                }
                if (this.$route.name == 'postInfo'
                        || this.$route.name == 'postCreate'
                        || this.$route.name == 'userPostInfo') {
                    _class += 'active';
                }
                return _class;
            },
            hidden () {
                let _class = '';
                if (this.$route.name == 'postCreate') {
                    _class += 'create-post ';
                }
                if (this.$route.name == 'postInfo'
                        || this.$route.name == 'postCreate'
                        || this.$route.name == 'userPostInfo') {
                    _class += 'show-post';
                }
                return _class;
            }
        }
    }
</script>

<style lang="sass" scoped>
    #app {
        overflow: hidden;
    }

    #main {
        margin-top: 80px;
    }

    #navbar, #main {
        transition: all .3s cubic-bezier(.4,0,0,1);
    }

    .active {
        transform: translateX(50%);
    }

    #post {
        background: #f9f9fb;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        width: 50%;
        transition: transform .3s cubic-bezier(.4,0,0,1);
        transform: translateX(-100%);
        box-sizing: border-box;
        z-index: 1040;
    }

    #post.show-post {
        transform: translateX(0);
    }

    @media (max-width: 768px)
    {
        #main {
            padding: 0;
        }
        #post {
            width: 100%;
        }
        #post.create-post.show-post {
            z-index: -1;
            opacity: 0;
        }
        .create-post.active {
            transform: none;
        }
    }
</style>
