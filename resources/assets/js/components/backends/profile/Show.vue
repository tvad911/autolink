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
						        <div class="form-group" v-bind:class="form.errors.has('name')? 'has-error' : ''">
					                <label for="name" class="col-sm-2 control-label">Name</label>
					                <div class="col-sm-10">
						                <input placeholder="name" name="name" type="text" id="name" class="form-control" v-model="form.name">
						                <span class="help-block" v-if="form.errors.has('name')" v-text="form.errors.get('name')"></span>
						            </div>
					            </div>
						        <div class="form-group" v-bind:class="form.errors.has('username')? 'has-error' : ''">
					                <label for="name" class="col-sm-2 control-label">Username</label>
					                <div class="col-sm-10">
						                <input placeholder="username" name="username" type="text" id="username" class="form-control" v-model="form.username">
						                <span class="help-block" v-if="form.errors.has('username')" v-text="form.errors.get('username')"></span>
						            </div>
					            </div>
						    </div>
						    <!-- /.box-body -->
						    <div class="box-footer">
				                <button type="button" class="btn btn-default" @click.prevent="submitAndClose">Update</button>
				                <button type="button" class="btn btn-info pull-right" @click="cancel">Cancel</button>
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
        		form: new Form({
        			name: null,
        			username: null,
        		}),
        		title: 'User Profile'
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
        },

        methods: {
        	setValue(){
        		axios.get(site_url + 'api/profile/showProfile').then((res) => {
	                    this.form.name = res.data.item.name;
	                    this.form.username = res.data.item.username;
	                }).catch((err) => console.error(err));
        	},

        	cancel() {
                this.messageCancel();
            },

            submitAndClose() {
                this.form.post(site_url + 'api/profile/updateProfile').then((res) => {
                        this.messageUpdate(res);
                        this.setValue();
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            },

            messageCancel(){
                this.$refs.toastr.Add({
                        title: "Cancel Update Profile", // Toast Title
                        msg: 'Hủy việc tạo update profile!', // Message
                        clickClose: true, // Click Close Disable
                        timeout: 6000, // Remember defaultTimeout is 5 sec..
                        progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
                        position: "toast-top-right", // Toast Position.
                        type: "warning" // Toast type
                    });
            },

            messageUpdate(data){
                if(data.updated)
                {
                    this.$refs.toastr.Add({
                        title: "Update Profile", // Toast Title
                        msg: data.message, // Message
                        clickClose: true, // Click Close Disable
                        timeout: 6000, // Remember defaultTimeout is 5 sec..
                        progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
                        position: "toast-top-right", // Toast Position.
                        type: "success" // Toast type
                    });
                }
                else
                {
                    this.$refs.toastr.Add({
                        title: "Update Profile", // Toast Title
                        msg: 'Có lỗi xảy ra khi tạo! Vui lòng kiểm tra lại!', // Message
                        clickClose: true, // Click Close Disable
                        timeout: 6000, // Remember defaultTimeout is 5 sec..
                        progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
                        position: "toast-top-right", // Toast Position.
                        type: "error" // Toast type
                    });
                }
            },
	    }
    }
</script>