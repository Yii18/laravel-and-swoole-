<template>
    <div class="col-md-4 col-md-push-8">
        <loading v-if="loading"></loading>

        <transition name="fade">
            <template v-if="!loading">
                <!--hot-->
                <div class="panel panel-default hot">
                    <div class="panel-heading">热门文章</div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li v-for="hot in hots">
                                <router-link :to="{ name: 'postInfo', params: {pid: hot.id} }">{{ hot.title }} </router-link>
                                &nbsp;{{ hot.commentTotle }}&nbsp;条留言
                            </li>
                        </ul>
                    </div>
                </div>
            </template>
        </transition>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                hots: {},
                loading: false
            }
        },
        computed: {
            user () {
                return this.$store.state.user;
            }
        },
        mounted () {
            this.loading = true;
            this.error = null;
            this.$http.get('/api/rside', {}, {emulateJSON: true}).then((response) => {
                let data = response.body;
                this.loading = false;
                this.hots = data.hots;
            }, (response) => {
                // 响应错误回调
            });
        },
        methods: {

        }
    }

</script>
<style lang="sass" scoped>
    .user {
        .user-avatar, .user-name {
            text-align: center;
        }
        .user-avatar {
            img {
                cursor: pointer;
            }
        }
        .user-name {
            padding-top: 5px;
            a {
                max-width: 114px;
                font-weight: bold;
                text-overflow: ellipsis;
                white-space: nowrap;
                overflow: hidden;
            }
        }
    }
    .hot {
        ul {
            color: #8590a6;
            li+li {
                margin-top: 12px;
            }
        }
    }
</style>