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
						        	<i class="fa fa-plus-square" aria-hidden="true"></i> Api config
						        </h3>
						    </div>
		                    <!-- .box-body -->
						    <div class="box-body">
						        <div class="form-group" v-bind:class="form.errors.has('api_123link')? 'has-error' : ''">
					                <label for="api_123link" class="col-sm-2 control-label">Api 123link</label>
					                <div class="col-sm-10">
						                <input placeholder="api_123link" name="api_123link" type="text" id="api_123link" class="form-control" v-model="form.api_123link">
						                <span class="help-block" v-if="form.errors.has('api_123link')" v-text="form.errors.get('api_123link')"></span>
						            </div>
					            </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_123link')? 'has-error' : ''">
                                    <label for="api_shortes" class="col-sm-2 control-label">Api shortest</label>
                                    <div class="col-sm-10">
                                        <input placeholder="api_shortes" name="api_shortes" type="text" id="api_shortes" class="form-control" v-model="form.api_shortes">
                                        <span class="help-block" v-if="form.errors.has('api_shortes')" v-text="form.errors.get('api_shortes')"></span>
                                    </div>
                                </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_megaurl')? 'has-error' : ''">
                                    <label for="api_megaurl" class="col-sm-2 control-label">Api Megaurl</label>
                                    <div class="col-sm-10">
                                        <input placeholder="api_megaurl" name="api_megaurl" type="text" id="api_megaurl" class="form-control" v-model="form.api_megaurl">
                                        <span class="help-block" v-if="form.errors.has('api_megaurl')" v-text="form.errors.get('api_megaurl')"></span>
                                    </div>
                                </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_bitly')? 'has-error' : ''">
                                    <label for="api_bitly" class="col-sm-2 control-label">Api Bitly</label>
                                    <div class="col-sm-10">
                                        <input placeholder="api_bitly" name="api_bitly" type="text" id="api_bitly" class="form-control" v-model="form.api_bitly">
                                        <span class="help-block" v-if="form.errors.has('api_bitly')" v-text="form.errors.get('api_bitly')"></span>
                                    </div>
                                </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_googl')? 'has-error' : ''">
                                    <label for="api_googl" class="col-sm-2 control-label">Api Googl</label>
                                    <div class="col-sm-10">
                                        <input placeholder="api_googl" name="api_googl" type="text" id="api_googl" class="form-control" v-model="form.api_googl">
                                        <span class="help-block" v-if="form.errors.has('api_googl')" v-text="form.errors.get('api_googl')"></span>
                                    </div>
                                </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_anotedpad')? 'has-error' : ''">
                                    <label for="api_anotedpad" class="col-sm-2 control-label">Api Notedpad</label>
                                    <div class="col-sm-10">
                                        <input placeholder="api_anotedpad" name="api_anotedpad" type="text" id="api_123link" class="form-control" v-model="form.api_anotedpad">
                                        <span class="help-block" v-if="form.errors.has('api_anotedpad')" v-text="form.errors.get('api_anotedpad')"></span>
                                    </div>
                                </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_tiny')? 'has-error' : ''">
                                    <label for="api_tiny" class="col-sm-2 control-label">Api Tiny</label>
                                    <div class="col-sm-10">
                                        <input placeholder="api_tiny" name="api_tiny" type="text" id="api_123link" class="form-control" v-model="form.api_tiny">
                                        <span class="help-block" v-if="form.errors.has('api_tiny')" v-text="form.errors.get('api_tiny')"></span>
                                    </div>
                                </div>
                                <div class="form-group" v-bind:class="form.errors.has('api_default')? 'has-error' : ''">
                                    <label for="api_default" class="col-sm-2 control-label">Api Default</label>
                                    <div class="col-sm-10">
                                        <select id="api_default" name="api_default" class="form-control input-sm" v-model="form.api_default">
                                            <option v-for="apiDefault in apiDefaults" v-bind:value="apiDefault.value">{{ apiDefault.name }}</option>
                                        </select>
                                        <span class="help-block" v-if="form.errors.has('api_default')" v-text="form.errors.get('api_default')"></span>
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
                    api_123link: '',
                    api_shortes: '',
                    api_megaurl: '',
                    api_bitly: '',
                    api_googl: '',
                    api_anotedpad: '',
                    api_tiny: '',
                    api_default: 0,
        		}),
                apiDefaults:[
                    { value: '0', name: '123Link.top'},
                    { value: '1', name: 'Shorte.st'},
                    { value: '2', name: 'Megaurl.com'},
                ],
        		title: 'API Shortest Url'
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
        		axios.get(site_url + 'api/profile/showApiShortestUrl').then((res) => {
	                    this.form.api_123link = res.data.item.api_123link;
                        this.form.api_shortes = res.data.item.api_shortes;
                        this.form.api_megaurl = res.data.item.api_megaurl;
                        this.form.api_bitly = res.data.item.api_bitly;
                        this.form.api_googl = res.data.item.api_googl;
                        this.form.api_anotedpad = res.data.item.api_anotedpad;
                        this.form.api_tiny = res.data.item.api_tiny;
                        this.form.api_default = res.data.item.api_default;
	                }).catch((err) => console.error(err));
        	},

        	cancel() {
                this.messageCancel();
            },

            submitAndClose() {
                this.form.post(site_url + 'api/profile/updateApiShortestUrl').then((res) => {
                        this.messageUpdate(res);
                        this.setValue();
                    })
                    .catch((err) => {
                        console.error(err);
                    });
            },

            messageCancel(){
                this.$refs.toastr.Add({
                        title: "Cancel Update ApiShortestUrl", // Toast Title
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
                        title: "Update ApiShortestUrl", // Toast Title
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
                        title: "Update ApiShortestUrl", // Toast Title
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