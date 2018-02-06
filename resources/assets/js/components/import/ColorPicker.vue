<template>
	<div class="input-group colorpicker-component" ref="colorpicker">
        <input type="text" class="form-control" :value="value">
        <span class="input-group-addon"><i></i></span>
    </div>
</template>
<script>
	export default {
		props:{
			value:{
	            type: String,
	            required: true
	        },
		},

		 data() {
            return {
            };
        },

		mounted(){
	        var self = this;
			$(this.$el).colorpicker().on('changeColor', function(e) {
	            self.update(e.color.toHex());
	        });;
	    },

	    beforeDestroy: function() {
    		// $(this.$el).colorpicker('hide').colorpicker('destroy');
    		$(this.$el).colorpicker('destroy');
		},

		methods: {
	        update(event){
	            this.$emit('update-color', event);
	        }
	    }
	}
</script>