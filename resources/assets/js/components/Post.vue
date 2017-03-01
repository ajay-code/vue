<template lang="html">
    <div class="media">
    <like :post="post" v-if="!post.likedByCurrentUser && post.CanBeLikedByCurrentUser"></like>
        <div class="media-left">
			<a href="#">
				<img class="media-object" v-bind:src="post.user.avatar" v-bind:alt="post.user.name + ' avatar' ">
			</a>
        </div>
        <div class="media-body">
            <strong>{{  post.user.name }}</strong>
            <p>{{ post.body }}</p>
            <p>{{ post.likeCount }} {{ pluralize('like', post.likeCount) }}</p>
        </div>
    </div>
</template>

<script>
import pluralize from 'pluralize';
import Like from './LikeButton';
export default {
    props: ['post'],
    components: [
        Like
    ],
    methods: {
        pluralize
    }
}
</script>

<style lang="css" scoped>
	.media{
		position: relative;
		margin: 0;
		padding:10px; 
	}

    .media:hover .like{
        display: block;
    }
</style>
