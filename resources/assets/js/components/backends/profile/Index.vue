<template>
	<div>
		<vue-toastr ref="toastr"></vue-toastr>
		<section class="content">
	        <!-- End Header Button -->
	        <div class="row">
	            <div class="col-xs-12">
					<div class="box">
		                <form method="POST" action="#" accept-charset="UTF-8" class="form-horizontal">
		                	<div class="box-header">
						        <h3 class="box-title">
						        	<i class="fa fa-plus-square" aria-hidden="true"></i> Profile Information
						        </h3>
						    </div>
		                    <!-- .box-body -->
						    <div class="box-body">
						    	<div class="form-group">
						            <label for="name" class="col-sm-2 control-label">Name</label>
						            <div class="col-sm-10">
						                <span class="form-control">{{ item.name }}</span>
						            </div>
						        </div>
						        <div class="form-group">
						            <label for="email" class="col-sm-2 control-label">Email</label>
						            <div class="col-sm-10">
						                <span class="form-control">{{ item.email }}</span>
						            </div>
						        </div>
						        <div class="form-group">
						            <label for="username" class="col-sm-2 control-label">Username</label>
						            <div class="col-sm-10">
						                <span class="form-control">{{ item.username }}</span>
						            </div>
						        </div>
						        <div class="form-group">
						            <label for="username" class="col-sm-2 control-label">Group</label>
						            <div class="col-sm-10">
						                <select id="input_type" name="input_type" class="form-control input-sm" v-model="item.group_id" disabled="disabled">
						                    <option v-for="group in groupID" :value="group.id">{{ group.name }}</option>
						                </select>
						            </div>
						        </div>
						        <div class="form-group">
						            <label for="username" class="col-sm-2 control-label">Token</label>
						            <div class="col-sm-10">
						                <span class="form-control">{{ item.api_token }}</span>
						            </div>
						        </div>
						        <div class="form-group">
						            <label for="username" class="col-sm-2 control-label">Status</label>
						            <div class="col-sm-10">
						                <span class="form-control" v-if="item.status == 1">Active</span>
						                <span class="form-control" v-if="item.status == 0">Inactive</span>
						            </div>
						        </div>
						    </div>
						    <!-- /.box-body -->
						    <div class="box-footer clearfix">
						        <a href="#" title="Edit Profile" class="btn btn-default" v-bind:href="editProfile()">Edit Profile</a>
						        <a href="#" title="Change Password" class="btn btn-default pullright" v-bind:href="editPassword()">Change Password</a>
						    </div>
						    <!-- /.box-footer -->
	                    </form>
		            </div>
		            <!-- /.box -->
	                <!-- Action -->
	            </div>
	        </div>
	    </section><!-- /.content -->
	</div>
</template>

<script>
	// import Toastr
	import Toastr from 'vue-toastr';
	// import toastr less file: need webpack less-loader
	require('vue-toastr/src/vue-toastr.less');
	// Register vue component
	Vue.component('vue-toastr',Toastr);

    export default {
        components: { 'vue-toastr': Toastr },

        data() {
        	return {
        		item: {
        			id: null,
        			name: null,
        			email: null,
        			username: null,
        			password: null,
        			status: null,
        			user_id: '',
        			group_id: '',
        			created_at: '',
        			updated_at: '',
        		},
        		title: 'User Profile',
        		groupID: []
        	};
        },

        created(){
	        document.title = this.title;

	        this.$on('changeTitle', function(title){
	        	document.title = title;
	        });
	    },

        mounted() {
        	this.setValue();
        	this.getGroup();
        },

        methods: {
        	setValue(){
        		axios.get(site_url + 'api/profile/showProfile').then((res) => {
	                    this.item = res.data.item;
	                }).catch((err) => console.error(err));
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
        	editProfile(){
        		return site_url + 'admin/profile/editProfile';
        	},

        	editPassword(){
        		return site_url + 'admin/profile/editPassword';
        	},
	    }
    }
</script>