<template>
    <div class="col-md-8">
        <loading v-if="load"></loading>
        <transition name="fade">
            <template v-if="!load">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h1 class="title"><i class="fa fa-tag" aria-hidden="true"></i>{{ tag.name }}</h1>
                    </div>
                </div>
            </template>
        </transition>
        <transition name="fade">
            <template v-if="!load">
                <div class="panel panel-default list">
                    <div class="panel-heading">文章列表</div>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                            <li v-for="l in list">
                                <a href="javascript:;">{{ l.title }}</a>
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
                tid: null
            }
        },
        computed: {
            tag () {
                return this.$store.state.tags.tag
            },
            list () {
                return this.$store.state.tags.list
            },
            load () {
                return this.$store.state.tags.postLoad
            }
        },
        created () {
            this.fetchData()
        },
        watch: {
            $route () {
                if (this.$route.params.tid != this.tid) {
                    this.fetchData();
                }
            }
        },
        methods: {
            fetchData () {
                this.tid = this.$route.params.tid

                this.$store.dispatch('getTag', this.tid)
            }
        }
    }
</script>
<style lang="sass" scoped>
    .title {
        i {
            margin-right: 15px;
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