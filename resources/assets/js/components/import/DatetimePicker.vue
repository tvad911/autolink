<template>
	<div class='input-group date' ref="datetimepicker">
        <input type='text' class="form-control" :value="value" @change="update($event)" />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</template>

<script>
export default {
	props:{
		value:{
            type: Object,
            required: true
        },
	},

	mounted(){
        $(this.$refs.datetimepicker).datetimepicker()
    },

	methods: {
        update(event){

            this.$emit('input', event.target.value);
        }
    }
}
</script>