<template>
	<div class="box-body">
        <div id="example1_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
		    <div class="row">
		        <div class="col-xs-6">
		            <div class="form-group"><label for="">
		            	<a href="#" @click.prevent="changeAll" v-bind:class="classStyle('all')">All ( {{ count.all }} )</a> |
		                <a href="#" @click.prevent="changeStatus(1)" v-bind:class="classStyle('publish')">Publish ( {{ count.publish }} )</a> |
		                <a href="#" @click.prevent="changeStatus(0)" v-bind:class="classStyle('draft')">Draft ( {{ count.draft }} )</a> |
		                <a href="#" @click.prevent="changeTrash" v-bind:class="classStyle('inTrash')">Trash ( {{ count.inTrash }} )</a></label>
		            </div>
		        </div>
		        <div class="col-md-6">
		            <div class="sbox-tools pull-right"><a data-original-title="Clear Search" href="#" title="" class="btn btn-xs btn-white tips" @click.prevent="clearSearch"><i class="fa fa-trash-o"></i> Clear Search </a></div>
		        </div>
		    </div>
		    <div class="row">
		        <div class="col-sm-6">
		            <div id="example1_length" class="dataTables_length">
		                <showbackend @changeItemPerpage="changeItemPerpage"></showbackend>
		            </div>
		        </div>
		        <div class="col-sm-6">
		            <div id="example1_filter" class="dataTables_filter pull-right">
						<searchbackend @searchData="searchData"></searchbackend>
		            </div>
		        </div>
		    </div>
		</div>
    </div>
</template>

<script>
	import showbackend from '../../import/ShowBackend.vue';
	import searchbackend from './SearchBackend.vue';
    export default {
        components: { showbackend, searchbackend },
        props: {
        	count:{
            	type: Object,
                required: true
            },
            all:{
            	type: Number,
                required: true
            },
            status:{
            	type: Number,
                required: true
            },
            inTrash:{
            	type: Number,
                required: true
            },
        },

        computed: {
        },

        methods: {
        	changeItemPerpage(perPage){
        		this.$emit('changeItemPerpage', perPage);
        	},

        	changeStatus(status){
        		this.$emit('changeStatus', status);
        	},

        	changeAll(){
        		this.$emit('changeAll');
        	},

        	changeTrash(){
        		this.$emit('changeTrash');
        	},

        	searchData(keyword, searchBy){
        		this.$emit('searchData', keyword, searchBy);
        	},

        	clearSearch(){
        		this.$emit('clearSearch');
        	},

            classStyle(field){
                if(this.inTrash == 1){
                    if(field == 'inTrash')
                        return 'color-red';
                }
                else
                {
                    if(this.all == 1){
                        if(field == 'all')
                        {
                            return 'color-red';
                        }
                    }
                    else{
                        if(this.status == 1)
                        {
                            if(field == 'public')
                            {
                                return 'color-red';
                            }
                        }
                        else
                        {
                            if(field == 'draft')
                            {
                                return 'color-red';
                            }
                        }
                    }
                }
            },
        }
    }
</script>
<style>
	.color-red{
		color: red;
	}
</style>