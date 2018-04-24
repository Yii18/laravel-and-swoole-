<template>
    <div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-body">
                    <h4>撰写新文章</h4>
                    <br>
                    <form @submit.prevent="postArticle">
                        <div class="form-group">
                            <label for="title" >标题 :</label>
                            <input v-model="title" id="title" type="text" placeholder="hello world !" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="tags" >标签 :</label>
                            <input v-model="tagString" id="tags" type="text" placeholder="标签输入用逗号分隔" required="required" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="content" >内容 :</label>
                            <textarea v-model="content" name="content" id="content" rows="4" placeholder="支持 Markdown 语法" required="required" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">发帖</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data () {
            return {
                tag: [],
                tagString: '',
                title: this.$store.state.post.postsTemplate.title,
                content: this.$store.state.post.postsTemplate.content
            }
        },
        watch: {
            tagString () {
                this.tag = this.tagString.split(',');
            },
            title () {
                this.$store.dispatch('updatePostTemplateTitle', this.title)
            },
            content () {
                this.$store.dispatch('updatePostTemplateContent', this.content)
            }
        },
        methods: {
            postArticle () {
                let url = '/' + window.version + '/article/create';
                this.$http.post(url, {
                    title: this.title,
                    content: this.content,
                    tag: this.tag
                }, {
                    emulateJSON: true
                }).then(function (res) {
                    if (res.data == 0) {
                        location.href = '/'
                    }
                }, function (res) {

                });
            }
        }
    }
</script>

<style scoped>
    input, textarea {
        background-color: transparent;
        border: 2px solid #597289;
    }

    input:focus, textarea:focus {
        border: 2px solid #6789ab;
    }

    #content {
        min-height: 210px;
    }
</style>

