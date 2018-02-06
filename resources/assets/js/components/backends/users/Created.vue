<template>
	<div class="modal fade in" role="dialog" aria-labelledby="createdItem" tabindex="-1" id="createdItem" style="display: block;">
	    <div class="modal-dialog">
	        <div class="modal-content">
	            <div class="modal-header">
	                <button type="button" data-dismiss="modal" aria-label="Close" class="close" @click="closeModal()">
                		<span aria-hidden="true">×</span>
                	</button>
	                <h4 class="modal-title">Add User</h4>
	            </div>
	            <div class="modal-body">
	                <form method="POST" action="" accept-charset="UTF-8" role="form" abineguid="" @submit.prevent="onSubmit">
	                	<div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('email')? 'has-error' : ''">
	                        	<label for="email">Email</label>
	                        	<input placeholder="Email" name="email" type="text" id="email" class="form-control" v-model="form.email">
	                        	<span class="help-block" v-if="form.errors.has('email')" v-text="form.errors.get('email')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('username')? 'has-error' : ''">
	                        	<label for="username">Username</label>
	                        	<input placeholder="Username" name="username" type="text" id="username" class="form-control" v-model="form.username">
	                        	<span class="help-block" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('password')? 'has-error' : ''">
	                        	<label for="password">Password</label>
	                        	<input placeholder="Password" name="password" type="password" id="password" class="form-control" v-model="form.password">
	                        	<span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group">
	                        	<label for="password_confirmation">Confirm Password</label>
	                        	<input placeholder="Confirm Password" name="password_confirmation" type="password" id="password_confirmation" class="form-control" v-model="form.password_confirmation">
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('name')? 'has-error' : ''">
	                        	<label for="name">Name</label>
	                        	<input placeholder="Chanel name" name="name" type="text" id="name" class="form-control" v-model="form.name">
	                        	<span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
	                        </div>
	                    </div>
	                    <div class="box-body">
	                        <div class="form-group" v-bind:class="form.errors.has('group_id')? 'has-error' : ''">
	                            <label for="group_id">Group</label>
	                            <select id="group_id" name="group_id" class="form-control input-sm" v-model="form.group_id">
	                                <option v-for="group in groupID" v-bind:value="group.id">{{ group.name }}</option>
	                            </select>
	                            <span class="help-block" v-if="form.errors.has('group_id')" v-text="form.errors.get('group_id')"></span>
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
        			email: '',
        			username: '',
        			name: '',
        			password: '',
        			password_confirmation: '',
        			group_id: 3,
        			status: 0,
        		}),
        		groupID: []
        	};
        },

        mounted() {
            this.getGroup();
        },

        methods: {
            closeModal() {
                this.$emit('closeCreated');
            },

            submitAndClose() {
                this.form.post(site_url + 'api/user')
                	.then((res) => {
            			this.$emit('submitCreated', res);
                	})
                	.catch((err) => {
                		console.error(err);
                	});
            },

            getGroup(){
                axios.get(site_url + 'api/group', {
                    params: {
                        all: 0,
                        status: 1,
                        inTrash: 0,
                        offset: 50,
                        orderBy: 'id',
                        sortBy: 'desc'
                    }
                }).then((res) => {
                    this.groupID = res.data.data.data;
                }).catch((err) => console.error(err));
            },
	    },
    }
</script>