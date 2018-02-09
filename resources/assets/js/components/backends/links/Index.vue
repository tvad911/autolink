<template>
	<div>
		<vue-toastr ref="toastr"></vue-toastr>
		<section class="content">
	        <!-- End Header Button -->
	        <div class="row">
	            <div class="col-xs-12">
	                <!-- /.box -->
	                <div class="box">
	                	<rotate-square2 v-if="loading"></rotate-square2>
	                	<created v-if="createdItem" @cancelAdd="closeCreatedItem" @submitCreated="submitCreatedItem" @dataLoading="dataLoading" @loadingDone="loadingDone"></created>
						<!-- <show v-if="editedItem != 0" :id="editedItem" :item="item" @closeShowed="closeShowedItem" @submitUpdated="submitUpdateItem"></show> -->
						<show v-if="editedItem != 0" :id="editedItem" :item="item" @closeShowed="closeShowedItem" @submitUpdated="submitUpdateItem"></show>
						<boxheader @openCreatedItem="openCreatedItem">
							List Link
						</boxheader>
						<!-- /.box-header -->
						<headermodule :count="count" :all="all" :status="status" :inTrash="inTrash" @changeItemPerpage="changeItemPerpage" @changeStatus="changeStatus" @changeAll="changeAll" @changeTrash="changeTrash" @searchData="searchData" @clearSearch="clearSearch"></headermodule>
	                    <!-- /end .box-body -->
						<form method="POST" action="#" accept-charset="UTF-8">
	                    <!-- .box-body -->
	                    <div class="box-body table-responsive no-padding">
	                        <table class="table table-hover">
	                        	<tbody v-if="items">
	                        		<tr>
		                                <th><input type="checkbox" name="check-all" id="check-all" v-model="selectAll"></th>
		                                <th>
		                                    ID
		                                    <a href="#" @click.prevent="sortListItem('id')"><i class="fa" v-bind:class="sortClass('id')"></i></a>
		                                </th>
		                                <th>
		                                    123Link
		                                    <a href="#" @click.prevent="sortListItem('a123link')"><i class="fa" v-bind:class="sortClass('a123link')"></i></a>
		                                </th>
		                                <th>
		                                	Shortest
		                                	<a href="#" @click.prevent="sortListItem('shorte')"><i class="fa" v-bind:class="sortClass('shorte')"></i></a>
	                                	</th>
		                                <th>
		                                	Bit.ly
		                                	<a href="#" @click.prevent="sortListItem('bitly_url')"><i class="fa" v-bind:class="sortClass('bitly_url')"></i></a>
	                                	</th>
	                                	<th>
		                                	Url Gốc
		                                	<a href="#" @click.prevent="sortListItem('url')"><i class="fa" v-bind:class="sortClass('url')"></i></a>
	                                	</th>
		                                <th>
		                                    Created at
		                                    <a href="#" @click.prevent="sortListItem('created_at')"><i class="fa" v-bind:class="sortClass('created_at')"></i></a>
		                                </th>
		                                <!-- <th>
		                                    Status
		                                    <a href="#" @click.prevent="sortListItem('status')"><i class="fa" v-bind:class="sortClass('status')"></i></a>
		                                </th> -->
		                                <th>Action</th>
		                            </tr>
		                            <tr v-for="item in items">
		                                <td>
		                                    <input name="items[]" v-bind:value="item.id" type="checkbox" id="items[]" v-model="selected">
		                                </td>
		                                <td><span class="label label-success">{{ item.id }}</span></td>
		                                <td>{{ item.a123link }}</td>
		                                <td>{{ item.shorte }}</td>
		                                <td>{{ item.bitly_url }}</td>
		                                <td>{{ item.url }}</td>
		                                <td>{{ item.created_at }}</td>
		                                <!-- <td>
		                                	<span class="label label-danger" v-if="item.status == 0">UnActive</span>
		                                	<span class="label label-success" v-if="item.status == 1">Active</span>
	                                	</td> -->
		                                <td>
		                                    <a href="#" class="btn btn-default" v-if="inTrash != 1" v-bind:data-id="item.id" @click.prevent="openShowedItem(item.id)"><span class="fa fa-edit"></span> View</a>
		                                    <button class="btn btn-default confirm-delete" type="button" v-if="inTrash != 1" v-bind:data-id="item.id" @click.prevent="openDeletedItem(item.id)">
			                                    <span class="fa fa-trash"></span>
			                                    Delete
		                                    </button>

		                                </td>
		                            </tr>
	                        	</tbody>
	                        </table>
	                    </div>
	                    <!-- /.box-body -->
	                    <div class="box-footer clearfix">
						    <div class="row">
								<actionbackend :pagination="pagination" :inTrash="inTrash" @changeAction="action" :doAction="doAction"></actionbackend>

						        <paginate :pagination="pagination" :offset="offset" @click.native="listItem(pagination.currentPage)"></paginate>
						    </div>
						</div>
						<!-- /.box-footer -->
	                    </form>
	                </div>
	                <!-- /.box -->
	                <!-- Action -->
	            </div>
	        </div>
	    </section><!-- /.content -->
		<deleted v-if="deletedItem != 0" :deletedItem="deletedItem" @closeDeleted="closeDeletedItem" @submitDeleted="submitDeletedItem"></deleted>
	</div>
</template>

<script>
	import actionbackend from '../../import/ActionBackend.vue';
	import paginate from '../../import/Paginate.vue';
	import headermodule from './HeaderModule.vue';
	import boxheader from '../../import/BoxHeader.vue';
	import deleted from './Deleted.vue';
	import created from './Created.vue';
	import show from './Show.vue';
	// import Toastr
	import Toastr from 'vue-toastr';
	import {RotateSquare2} from 'vue-loading-spinner';
	// import toastr less file: need webpack less-loader
	require('vue-toastr/src/vue-toastr.less');
	// Register vue component
	Vue.component('vue-toastr',Toastr);

    export default {
        components: { actionbackend, paginate, headermodule, boxheader, deleted, 'vue-toastr': Toastr, created, show, RotateSquare2 },

        data() {
        	return {
        		selected: [],
        		title: 'Admin LTE | Homepage',
        		items: [],
        		item: {
					id: 0,
					url: '',
					a123link: '',
					shorte: '',
					megaurl: '',
					googl_url: '',
					bitly_url: '',
					anotedpad_url: '',
					tiny_url: '',
					source: '',
					destination: '',
					user_id: '',
					status: 0,
					created_at: '',
					updated_at: ''
        		},
        		pagination: {
					total: 0,
					perPage: 25,
					from: 0,
					to: 0,
					currentPage: 1,
					lastPage: 0,
		        },
        		offset: 25,
        		search: {
        			keyword: '',
        			searchBy: 'id',
        		},
        		count: {
        			all: 0,
	        		publish: 0,
	        		draft: 0,
	        		inTrash: 0,
        		},
        		all: 1,
        		status: 1,
        		inTrash: 0,
        		sort: {
        			orderBy: 'id',
        			sortBy: 'desc',
        		},
        		showModal: false,
        		deletedItem: 0,
        		createdItem: false,
        		editedItem: 0,
        		doAction: 'publish',
        		loading: false,
        	};
        },

        created(){
	        document.title = this.title;

	        this.$on('changeTitle', function(title){
	        	document.title = title;
	        });
	    },

        mounted() {
        	this.listItem(this.pagination.currentPage);
        	this.countAll();
        },

        computed:{
        	selectAll: {
	            get: function () {
	                return this.items ? this.selected.length == this.items.length : false;
	            },
	            set: function (value) {
	                var selected = [];

	                if (value) {
	                    this.items.forEach(function (item) {
	                        selected.push(item.id);
	                    });
	                }

	                this.selected = selected;
	            }
	        },
        },

        methods: {
        	listItem: _.debounce(
        		function(page){
    				let pageTitle = 'Admin LTE | List Link - Page '+ page;
        			axios.get(site_url + 'api/link', {
	    				params: {
							keyword: this.search.keyword,
							searchBy: this.search.searchBy,
							all: this.all,
							status: this.status,
							inTrash: this.inTrash,
							offset: this.offset,
							page: page,
							orderBy: this.sort.orderBy,
							sortBy: this.sort.sortBy,
					    }
					}).then((res) => {
	                    this.items = res.data.data.data;
	                    this.pagination = res.data.pagination;
	                    this.$emit('changeTitle', pageTitle);
	                }).catch((err) => console.error(err));
        		}
        		, 500
    		),

    		countAll(){
    			axios.get(site_url + 'api/link/count', {
    				params: {
    					all: this.all,
    					status: this.status,
    					inTrash: this.inTrash,
    					keyword: this.search.keyword,
						searchBy: this.search.searchBy,
				    }
    			}).then((res) => {
                    this.count = res.data;
                }).catch((err) => console.error(err));
    		},

    		changeItemPerpage(perPage){
    			this.offset = perPage;
    			this.pagination.currentPage = 1;
    			this.listItem(this.pagination.currentPage);
    		},

    		changeStatus(status){
    			this.all = 0;
    			this.inTrash = 0;
    			this.status = status;
    			this.pagination.currentPage = 1;
    			this.listItem(this.pagination.currentPage);
    		},

    		changeAll(){
    			this.all = 1;
    			this.inTrash = 0;
    			this.pagination.currentPage = 1;
    			this.listItem(this.pagination.currentPage);
    		},

    		changeTrash(){
    			this.inTrash = 1;
    			this.pagination.currentPage = 1;
    			this.listItem(this.pagination.currentPage);
    		},

    		sortClass(field){
    			if(field == this.sort.orderBy)
    			{
    				if(this.sort.sortBy == 'desc')
    					return 'fa-sort-desc';
    				else
    					return 'fa-sort-asc';
    			}
    			else
    				return 'fa-sort';
    		},

    		sortListItem(field){
    			if(field == this.sort.orderBy)
    			{
    				if(this.sort.sortBy == 'desc')
    				{
    					this.sort.sortBy = 'asc';
    				}
    				else{
    					this.sort.sortBy = 'desc';
    				}
    			}
    			else{
    				this.sort.orderBy = field;
    				this.sort.sortBy = 'desc';
    			}
    			this.listItem(this.pagination.currentPage);
    		},

    		searchData(keyword, searchBy){
    			this.search.keyword = keyword;
    			this.search.searchBy = searchBy;

    			this.all = 1;
    			this.inTrash = 0;
    			this.pagination.currentPage = 1;
    			this.listItem(this.pagination.currentPage);
    		},

    		clearSearch(){
    			this.search.keyword = '';
    			this.search.searchBy = 'id';
    			this.all = 1;
    			this.inTrash = 0;
    			this.pagination.currentPage = 1;
    			this.listItem(this.pagination.currentPage);
    		},

    		openDeletedItem(id) {
    			this.deletedItem = id;
            },

            closeDeletedItem(){
            	this.deletedItem = 0;
            },

            submitDeletedItem(data){

            	if(data.deleted != 0)
            	{
            		this.$refs.toastr.Add({
	                    title: "Deleted Link", // Toast Title
	                    msg: data.message, // Message
	                    clickClose: true, // Click Close Disable
	                    timeout: 6000, // Remember defaultTimeout is 5 sec..
	                    progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
	                    position: "toast-top-right", // Toast Position.
	                    type: "success" // Toast type
	                });
            	}
            	else{
            		this.$refs.toastr.Add({
	                    title: "Deleted Link", // Toast Title
	                    msg: 'Có lỗi xảy ra khi xóa! Vui lòng kiểm tra lại!', // Message
	                    clickClose: true, // Click Close Disable
	                    timeout: 6000, // Remember defaultTimeout is 5 sec..
	                    progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
	                    position: "toast-top-right", // Toast Position.
	                    type: "error" // Toast type
	                });
            	}

                this.deletedItem = 0;
                this.listItem(this.pagination.currentPage);
            },

            openCreatedItem() {
    			this.createdItem = true;
            },

            closeCreatedItem(){
            	this.createdItem = false;
            },

            submitCreatedItem(data){
            	if(data.created)
        		{
        			this.$refs.toastr.Add({
					    title: "Created Link", // Toast Title
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
					    title: "Created Link", // Toast Title
					    msg: 'Có lỗi xảy ra khi tạo! Vui lòng kiểm tra lại!', // Message
					    clickClose: true, // Click Close Disable
					    timeout: 6000, // Remember defaultTimeout is 5 sec..
					    progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
					    position: "toast-top-right", // Toast Position.
					    type: "error" // Toast type
					});
        		}

        		//this.createdItem = false;
				this.listItem(this.pagination.currentPage);
            },

            openShowedItem(id){
            	this.editedItem = id;
            },

            closeShowedItem(){
            	this.editedItem = 0;
            },

            submitUpdateItem(data){
            	if(data.updated)
        		{
        			this.$refs.toastr.Add({
					    title: "Update Link", // Toast Title
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
					    title: "Update Link", // Toast Title
					    msg: 'Có lỗi xảy ra khi cập nhật! Vui lòng kiểm tra lại!', // Message
					    clickClose: true, // Click Close Disable
					    timeout: 6000, // Remember defaultTimeout is 5 sec..
					    progressBarValue: 0, // Manually update progress bar value later; null (not 0) is default
					    position: "toast-top-right", // Toast Position.
					    type: "error" // Toast type
					});
        		}

        		this.editedItem = 0;
				this.listItem(this.pagination.currentPage);
            },

            action(data){
            	this.doAction = data;
            	this.updateMulti();
            	this.selected = [];
            	this.pagination.currentPage = 1;
            	this.listItem(this.pagination.currentPage);
            },

            updateMulti(){
            	axios.post(site_url + 'api/link/updatemulti', {
					items: this.selected,
					doAction: this.doAction,
    			}).then((res) => {
                    this.countAll();
                }).catch((err) => console.error(err));
            },

            dataLoading(){
            	this.loading = true;
            },

            loadingDone(){
            	this.loading = false;
            }
	    }
    }
</script>