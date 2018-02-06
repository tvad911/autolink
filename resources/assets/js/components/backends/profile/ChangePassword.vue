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
						    	<div class="form-group" v-bind:class="form.errors.has('old_password')? 'has-error' : ''">
					                <label for="old_password" class="col-sm-2 control-label">Old Password</label>
					                <div class="col-sm-10">
						                <input placeholder="old_password" name="old_password" type="password" id="old_password" class="form-control" v-model="form.old_password">
						                <span class="help-block" v-if="form.errors.has('old_password')" v-text="form.errors.get('old_password')"></span>
						            </div>
					            </div>
						        <div class="form-group" v-bind:class="form.errors.has('password')? 'has-error' : ''">
					                <label for="password" class="col-sm-2 control-label">Password</label>
					                <div class="col-sm-10">
						                <input placeholder="password" name="password" type="password" id="password" class="form-control" v-model="form.password">
						                <span class="help-block" v-if="form.errors.has('password')" v-text="form.errors.get('password')"></span>
						            </div>
					            </div>
						        <div class="form-group" v-bind:class="form.errors.has('password_confirmation')? 'has-error' : ''">
					                <label for="name" class="col-sm-2 control-label">Confirm password</label>
					                <div class="col-sm-10">
						                <input placeholder="password_confirmation" name="password_confirmation" type="password" id="password_confirmation" class="form-control" v-model="form.password_confirmation">
						                <span class="help-block" v-if="form.errors.has('password_confirmation')" v-text="form.errors.get('password_confirmation')"></span>
						            </div>
					            </div>
						    </div>
						    <!-- /.box-body -->
						    <div class="box-footer">
				                <button type="submit" class="btn btn-default" @click.prevent="submitAndClose">Update</button>
				                <button type="submit" class="btn btn-info pull-right" @click.prevent="cancel">Cancel</button>
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
        			old_password: null,
        			password: null,
        			password_confirmation: null,
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
        },

        methods: {

        	cancel() {
                this.messageCancel();
            },

            submitAndClose() {
                this.form.post(site_url + 'api/profile/updatePassword').then((res) => {
                        this.messageUpdate(res);
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            },

            messageCancel(){
                this.$refs.toastr.Add({
                        title: "Cancel Update Password", // Toast Title
                        msg: 'Hủy việc tạo update password!', // Message
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
                        title: "Update Password", // Toast Title
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
                        title: "Update Password", // Toast Title
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