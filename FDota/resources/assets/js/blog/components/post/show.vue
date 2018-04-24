<template>
    <div>
        <show-component
                :post="post"
                :info-load="infoLoad"
                :close-path="closePath"
                :comment-load="commentLoad"
                :comment="comment"
        ></show-component>
    </div>
</template>
<script>
    import showComponent from './components/show.vue';

    export default {
        data () {
            return {};
        },
        computed: {
            closePath () {
                let closePath = '/';
                if (this.$route.params.uid) {
                    closePath = '/user/' + this.$route.params.uid;
                }
                return closePath;
            },
            post () {
                return this.$store.state.post.info;
            },
            infoLoad () {
                return this.$store.state.post.infoLoad;
            },
            comment () {
                return this.$store.state.post.comment;
            },
            commentLoad () {
                return this.$store.state.post.commentLoad;
            },
            user () {
                return this.$store.state.user;
            }
        },
        components: {
            showComponent
        },
        created () {
            this.fetchData()
        },
        watch: {
            '$route': 'fetchData'
        },
        methods: {
            fetchData () {
                if (!this.$route.params.pid) {
                    return false;
                }
                this.$store.dispatch('getPost', this.$route.params.pid)
                this.$store.dispatch('getPostComments', this.$route.params.pid)
            }
        }
    }
</script>

