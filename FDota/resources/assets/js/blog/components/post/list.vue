<template>
    <div class="col-md-8 col-md-pull-4">
        <loading v-if="loading"></loading>
        <transition-group name="fade" tag="div">
            <template v-if="!loading">
                <div class="media list" v-for="l in list" :key="l">
                    <div class="media-title">
                        <router-link :to="{ name: 'postInfo', params: {pid: l.id} }">{{ l.title }}</router-link>
                    </div>
                    <div class="media-heading">
                        <div class="media-left">
                            <router-link :to="{ name: 'user', params: {uid: l.user_id} }">
                                <img class="img-rounded media-object" width="38" :src="l.avatar" :alt="l.username" :title="l.username">
                            </router-link>
                        </div>
                        <div class="media-left media-user">
                            <div class="username">
                                <router-link :to="{ name: 'user', params: {uid: l.user_id} }">{{ l.username }}</router-link>
                            </div>
                            <div class="time">{{ l.time }}</div>
                        </div>
                    </div>
                    <div class="media-body">
                        <div @click="issub(l.issub, l.id)" :class="l.issub ? 'issub' : ''" class="media-content">
                            <article>
                                <main v-html="compiledMarkdown(l.content)"></main>
                            </article>
                            <div class="readmore">
                                <router-link v-if="l.issub" :to="{ name: 'postInfo', params: {pid: l.id} }">
                                    Read More
                                </router-link>
                            </div>
                        </div>
                    </div>
                    <div class="media-footer">
                        <ul class="tags list-inline">
                            <li v-for="tag in l.tags">
                                <router-link :to="{ name: 'tags', params: {tid: tag.id} }">
                                    {{ tag.name }}
                                </router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </template>
        </transition-group>
    </div>
</template>
<script>
    import Marked from 'marked'

    export default {
        data () {
            return {}
        },
        mounted () {
            if (this.$store.state.post.list.length === 0) {
                this.$store.dispatch('refreshPosts')
            }
        },
        computed: {
            loading () {
                return this.$store.state.post.listLoad
            },
            list () {
                return this.$store.state.post.list
            }
        },
        methods: {
            issub (is, pid) {
                if (is) {
                    this.$router.push({ name: 'postInfo', params: {pid: pid} })
                }
            },
            compiledMarkdown (content) {
                this.$nextTick(function(){
                    prettyPrint()
                });
                let text = Marked(content, { sanitize: true });
                return text ? this.addClass(text) : '';
            },
            addClass (text) {
                return text.replace(/<pre>/ig, '<pre class="prettyprint linenums">');
            }
        }
    }
</script>
<style lang="sass" scoped>
    .list {
        position: relative;
        background: #fff;
        padding: 20px 20px 0;
        margin-bottom: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        .media-title {
            a {
                font-size: 20px;
                font-weight: 400;
                line-height: 1.6;
            }
        }
        .media-heading {
            margin-top: 10px;
            a {
                display: block;
            }
            .media-user {
                height: 50px;
                .username {
                    a {
                        font-size: 15px;
                        font-weight: 600;
                        line-height: 1.1;
                        color: #4D4D46;
                    }
                    a:hover, a:focus {
                        color: darken(#4D4D46, 6.5%)
                    }
                }
                .time {
                    font-size: 10px;
                    line-height: 2;
                    margin-top: 6px;
                    margin-bottom: 2px;
                    text-transform: uppercase;
                    text-overflow: ellipsis;
                    white-space: nowrap;
                    color: #46585f;
                    overflow: hidden;
                }
            }
        }

        .media-content {
            padding: 1px 0 10px;
            .readmore {
                text-align: center;
            }
        }
        .media-content.issub {
            article {
                cursor: pointer;
                main {
                    pointer-events: none;
                }
            }
        }
        .media-footer {
            margin-left: -20px;
            margin-right: -20px;
            .tags:before {
                content: '';
                height: 2px;
                position: absolute;
                z-index: 0;
                top: 0;
                left: 0;
                width: 100%;
                border-top: dashed 1px #B3A788;
                border-bottom: dashed 1px #F9F3DE;
            }
            .tags {
                position: relative;
                padding: 10px 20px 0;
                li {
                    padding-left: 10px;
                    padding-right: 10px;
                    a {
                        display: inline-block;
                        position: relative;
                        background: #E5E2D5;
                        padding: 0 9px;
                        font-size: 11px;
                        line-height: 20px;
                        border-bottom-right-radius: 3px;
                        border-top-right-radius: 3px;
                        transition: none;
                    }
                    a:before, a:after {
                        content: "";
                        float: left;
                        position: absolute;
                    }
                    a:before {
                        top: 0;
                        left: -9px;
                        width: 0;
                        height: 0;
                        border-style: solid;
                        border-width: 10px 9px 10px 0;
                        border-color: transparent #E5E2D5 transparent transparent;
                    }
                    a:after {
                        top: 8px;
                        left: 0;
                        width: 4px;
                        height: 4px;
                        border-radius: 2px;
                        background-color: #6A4A3C;
                    }
                }
            }
        }
    }
</style>