<template>
    <div>
        <show-component
                :post="post"
                :info-load="!load"
                close-path="/"
                :comment-load="load"
        ></show-component>
    </div>
</template>
<script>
    import showComponent from './components/show.vue';

    export default {
        data () {
            return {
                load: true,
            };
        },
        computed: {
            post () {
                return this.$store.state.post.postsTemplate
            }
        },
        components: {
            showComponent
        }
    }
</script>

