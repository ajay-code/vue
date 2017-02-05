<template>
	<form action="#" class="form-vertical" @submit.prevent="post">
		<div class="form-group">
			<textarea class="form-control" v-model="body"  cols="30" rows="3" placeholder="write somthin here"></textarea>
		</div>
			
		<button type="submit" class="btn btn-default" >Post it!</button>
		
	</form>
</template>

<script>	
import eventHub from '../event'; 
	export default {
		data(){
			return {
				body: null
			}
		},
		methods: {
			post(){
				axios.post('/posts', {
					body: this.body
				}).then(res => {
					eventHub.$emit('post-added', res.data);	
					this.body = null;
				})
			}
		}
	}
</script>