<template>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Timeline</div>

                <div class="panel-body">
                    <post-form></post-form>
                    <hr>
                    <post v-for="post in posts" :post="post" ></post>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import eventHub from '../event';
import Post from './Post.vue';
import PostForm from './PostForm.vue';
export default {
    data() {
        return {
            posts: []
        }
    },

    components: [
        Post, PostForm
    ],

    mounted() {
        eventHub.$on('post-added', this.addPost);
        eventHub.$on('post-liked', this.likePost);
        this.listen();
        axios.get('/posts').then(res => {
            this.posts = res.data;
        });
    },

    methods: {
        addPost(post){
            this.posts.unshift(post);  
        },
        likePost(postId){

            _.each(this.posts, (post)=>{
                if(post.id == postId){
                    post.likeCount++;
                    post.likedByCurrentUser = true;
                    post.CanBelikedByCurrentUser = false;
                    return false;
                }
            })
        },
        listen(){
            Echo.private('posts').listen('PostWasCreated', (e) =>{
                this.posts.unshift(JSON.parse(e.post));   
                console.log(JSON.parse(e.post));
            });
        }
    }
}
</script>
