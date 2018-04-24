<template>
    <div class="col-md-8">
        <loading v-if="load"></loading>
        <transition name="fade">
            <template v-if="!load">
                <div class="panel panel-default">
                <div class="panel-body">
                    <div class="user-avatar">
                        <img class="img-circle" width="60"
                             :src="user.avatar"
                             :alt="user.name"
                             :title="user.name"
                        >
                    </div>
                    <div class="user-name">
                        <span>{{ user.name }}</span>
                    </div>
                </div>
            </div>
            </template>
        </transition>
        <transition name="fade">
            <template v-if="!load">
                <div class="panel panel-default list">
                    <div class="panel-heading">个人动态</div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li v-for="l in list">
                                <router-link :to="{ name: 'userPostInfo', params: {uid: $route.params.uid, pid: l.id} }">
                                    {{ l.title }}
                                </router-link>
                                <time>{{ l.created_at }}</time>
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
                uid: null
            }
        },
        computed: {
            user () {
                return this.$store.state.user.info
            },
            list () {
                return this.$store.state.user.list
            },
            load () {
                return this.$store.state.user.userLoad
            }
        },
        created () {
            this.fetchData()
        },
        watch: {
            $route () {
                if (this.$route.params.uid != this.uid) {
                    this.fetchData();
                }
            }
        },
        methods: {
            fetchData () {
                this.uid = this.$route.params.uid

                this.$store.dispatch('getUser', this.uid)
            }
        }
    }
</script>
<style lang="sass" scoped>
    .user-avatar, .user-name {
        text-align: center;
    }
    .user-name {
        padding-top: 5px;
        span {
            max-width: 114px;
            font-weight: bold;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
        }
    }
    .list {
        li + li {
            margin-top: 12px;
        }
        time {
            font-size: 10px;
            line-height: 2;
            text-transform: uppercase;
            text-overflow: ellipsis;
            white-space: nowrap;
            color: #8590a6;
        }
    }
</style>