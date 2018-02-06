<template>
	<div class="col-md-6 col-sm-6">
		<div id="example1_length" class="dataTables_length">
		    <label>
		        <select name="doAction" class="form-control input-sm" v-model="action">
		            <option value="publish" v-if="!inTrash">Publish</option>
		            <option value="draft" v-if="!inTrash">Draft</option>
		            <option value="trash" v-if="!inTrash">Trash</option>
		            <option value="restore" v-if="inTrash">Restore</option>
		            <option value="foreDelete" v-if="inTrash">Force Delete</option>
		        </select>
		    </label>
		    <input type="button" value="Apply" class="btn btn-info btn-sm" @click.prevent="changeAction">
		</div>
		<div id="example1_info" role="status" aria-live="polite" class="dataTables_info">
		    Items {{ pagination.from }} to {{ pagination.to }} of {{ pagination.total }} total
		</div>
	</div>
</template>


<script>
    export default {
       	props:{
       		pagination:{
            	type: Object,
                required: true
            },
            inTrash:{
            	type: Number,
                required: true
            },
            doAction:{
                type: String,
                required: false
            },
       	},
       	data(){
       		return {
                action: 'publish',
       		};
       	},

       	methods: {
       		changeAction(){
       			this.$emit('changeAction', this.action);
       		}
       	},
    }
</script>