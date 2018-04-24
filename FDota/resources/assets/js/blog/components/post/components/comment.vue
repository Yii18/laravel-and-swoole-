<template>
    <div id="comment">
        <div v-if="!commentLoad">
            <div v-if="user.id" class="media">
                <a class="media-left" href="javascript:;">
                    <img v-lazy="user.avatar" class="img-rounded" width="45" height="45">
                </a>

                <div class="media-body">
                    <form @submit.prevent="postComment" id="msg" method="POST" action="" accept-charset="UTF-8">
                        <div class="form-group">
                            <textarea v-model="content" class="form-control" rows="3" required name="content"></textarea>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary form-control" type="submit" value="发表回复">
                        </div>
                    </form>
                </div>
            </div>
            <div v-else class="form-group">
                <a href="/login" class="btn btn-success form-control">登录参与评论</a>
            </div>

            <div class="media" v-for="m in comment" :key="m.id">
                <a class="media-left" href="javascript:;">
                    <img v-lazy="m.avatar" class="img-rounded" width="45" height="45">
                </a>
                <div class="media-body box">
                    <div class="heading">
                        <a href="javascript:;" style="color: #00adb5;" v-text="m.name"></a>
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <time :datetime="m.created_at" v-text="m.created_at"></time>
                    </div>
                    <article class="comment-body">
                        <main v-html="compiledMarkdown(m.content)"></main>
                    </article>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Marked from 'marked'

    export default{
        props: {
            comment: Array,
            commentLoad: Boolean,
        },
        data(){
            return {
                content: ''
            }
        },
        computed: {
            user () {
                return this.$store.state.user
            }
        },
        methods: {
            postComment () {
                let data = {
                    pid: this.$route.params.pid,
                    content: this.content
                }
                this.$store.dispatch('submitComment', data)
                this.content = ''
            },
            compiledMarkdown (text) {
                this.$nextTick(function(){
                    prettyPrint()
                });

                text = Marked(text, { sanitize: true });

                return this.addPreClass(text);
            },
            addPreClass: function (text) {
                return text.replace(/<pre>/ig, '<pre class="prettyprint linenums">');
            }
        }
    }
</script>

<style lang="sass" scoped>
    #comment {
        margin: 40px 0;
        .box {
            border: 1px solid #ECF0F1;
            border-radius: 5px;
            background-color: #fff;
            color: #7F8C8D;
        }
        .heading {
            padding: 10px 20px;
            background: #ECF0F1;
        }
        .comment-body {
            padding: 10px;
        }
    }
</style>
