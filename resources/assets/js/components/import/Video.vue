<template>
	<video controls="" class="col-md-12" poster="" preload="none">
        <source v-if='url' :src="url" type="video/mp4">
    </video>
</template>
<script>
	export default {
	    props: {
	        url:{
	            type: String,
	            default: ''
	        }
	    }
	}
</script>