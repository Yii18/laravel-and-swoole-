<template>
    <div>
        <div class="post-title">
            <span class="title">{{ post.title }}</span>
            <span class="info">发表于 {{ post.time }} 已浏览 {{ post.click }} 次</span>

            <router-link :to="closePath" class="close">
                <span><i class="fa fa-times" aria-hidden="true"></i></span>
            </router-link>

            <div v-if="!infoLoad" class="content-blurred">
                <div class="content-blurred-layout" :style="blurredStyle">
                    <article>
                        <main v-html="compiledMarkdown"></main>
                    </article>
                </div>
            </div>
        </div>
        <loading v-if="infoLoad"></loading>

        <div v-else @scroll="contentBlurred" class="post-layout">
            <article><main v-html="compiledMarkdown"></main></article>
            <div class="comment">
                <comment-component
                        :comment-load="commentLoad"
                        :comment="comment"
                ></comment-component>
            </div>
        </div>
    </div>
</template>
<script>
    import Marked from 'marked'
    import commentComponent from './comment.vue'

    export default {
        props: {
            // post
            post: Object,
            infoLoad: Boolean,
            closePath: String,
            // comment
            commentLoad: Boolean,
            comment: Array
        },
        data () {
            return {
                blurredStyle: {
                    transform: 'translate3d(0, 0, 0)'
                }
            }
        },
        created () {
            this.resetBlurredStyle()
        },
        watch: {
            '$route': 'resetBlurredStyle'
        },
        components: {
            commentComponent
        },
        computed: {
            compiledMarkdown: function () {
                this.$nextTick(function(){
                    prettyPrint()
                });
                let text = Marked(this.post.content, { sanitize: true });
                return text ? this.addClass(text) : '';
            }
        },
        methods: {
            resetBlurredStyle: function () {
                this.blurredStyle = {
                    transform: 'translate3d(0, 0, 0)'
                };
            },
            contentBlurred: function (event) {
                this.blurredStyle = {
                    transform: 'translate3d(0,' + (-event.target.scrollTop + 'px') + ',0)'
                };
            },
            addClass: function (text) {
                return text.replace(/<pre>/ig, '<pre class="prettyprint linenums">');
            }
        }
    }
</script>

<style lang="sass" scoped>
    .content-blurred {
        position:absolute;
        top:0;
        left:0;
        right:0;
        filter: blur(10px);
        opacity:.35;
        z-index: 1;
    }

    .content-blurred-layout {
        position: absolute;
        left: 0;
        right: 0;
        top: 61px;
        padding: 0 20px;
        font-size: 1.1rem;
        line-height: 150%;
    }

    .post-layout {
        position: absolute;
        left: 0;
        top: 61px;
        right: 0;
        bottom: 0;
        overflow: auto;
        -webkit-overflow-scrolling: touch;
        padding: 0 20px;
        font-size: 1.1rem;
        line-height: 150%;
    }

    .post-title {
        position: absolute;
        left: 0;
        top: 0;
        right: 0;
        padding: 0 20px;
        height: 60px;
        z-index: 2;
        overflow: hidden;
        box-shadow: 0 1px 0 rgba(0,0,0,.1), 0 1px 2px rgba(0,0,0,.1);
        span {
            box-sizing: border-box;
            display: block;
        }
        .title {
            margin-top: 15px;
            height: 24px;
            width: 94%;
            white-space: nowrap;
            text-overflow: ellipsis;
            overflow: hidden;
            font-size: 1.7rem;
            line-height: 100%;
            color: #444;
        }
        .info {
            text-transform: uppercase;
            font-size: 10px;
            line-height: 100%;
            color: #999;
        }
    }

    .close {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        width: 50px;
        text-align: center;
        cursor: pointer;
        z-index: 2;
        span {
            font-size: 30px;
            line-height: 55px;
            display: block;
        }
    }
</style>

