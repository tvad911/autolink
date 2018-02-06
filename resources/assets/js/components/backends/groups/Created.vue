<template>
	<div class="modal fade in" role="dialog" aria-labelledby="createdItem" tabindex="-1" id="createdItem" style="display: block;">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" data-dismiss="modal" aria-label="Close" class="close" @click="closeModal()">
                		<span aria-hidden="true">×</span>
                	</button>
	                <h4 class="modal-title">Add Group</h4>
	            </div>
	            <div class="modal-body">
	                <form method="POST" action="" accept-charset="UTF-8" role="form" abineguid="" @submit.prevent="onSubmit">
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('name')? 'has-error' : ''">
	                        	<label for="name">Name</label>
	                        	<input placeholder="name" name="name" type="text" id="name" class="form-control" v-model="form.name" @change="getSlug">
	                        	<span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('slug')? 'has-error' : ''">
	                        	<label for="slug">Slug</label>
	                        	<input placeholder="slug" name="slug" type="text" id="slug" class="form-control" v-model="form.slug">
	                        	<span class="help-block" v-if="form.errors.has('slug')" v-text="form.errors.get('slug')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('description')? 'has-error' : ''">
	                        	<label for="description">Description</label>
	                        	<input placeholder="description" name="description" type="text" id="description" class="form-control" v-model="form.description">
	                        	<span class="help-block" v-if="form.errors.has('description')" v-text="form.errors.get('description')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('status')? 'has-error' : ''">
	                            <label for="status">Status</label>
	                            <select id="status" name="status" class="form-control input-sm" v-model="form.status">
	                                <option value="1">Active</option>
	                                <option value="0" selected="selected">Unactive</option>
	                            </select>
	                            <span class="help-block" v-if="form.errors.has('status')" v-text="form.errors.get('status')"></span>
	                        </div>
	                    </div>
	                </form>
	            </div>
	            <div class="modal-footer">
	                <button type="button" data-dismiss="modal" class="btn btn-default pull-left" @click="closeModal()">Hủy</button>
	                <button type="button" data-method="store" @click="submitAndClose()">
	                    Save
	                </button>
	            </div>
	        </div>
	    </div>
	</div>
</template>
<script>
    export default {

        data(){
        	return {
        		form: new Form({
        			name: '',
        			slug: '',
        			description: '',
        			status: 0,
        		})
        	};
        },

        methods: {
            closeModal() {
                this.$emit('closeCreated');
            },

            submitAndClose() {
                this.form.post(site_url + 'api/group')
                	.then((res) => {
            			this.$emit('submitCreated', res);
                	})
                	.catch((err) => {
                		console.error(err);
                	});
            },

            getSlug(){
            	axios.get(site_url + 'api/slug', {
	    				params: {
							slug: this.form.name,
					    }
					}).then((res) => {
	                    this.form.slug = res.data;
	                }).catch((err) => console.error(err));
            }
	    },
    }
</script>