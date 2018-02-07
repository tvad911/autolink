<template>
    <form method="POST" action="" accept-charset="UTF-8" role="form" abineguid="">
    	<div class="box-header">
	        <h3 class="box-title">
	        	<i class="fa fa-plus-square" aria-hidden="true"></i> Add Link
	        </h3>
	    </div>

		<div class="box-body">
            <div class="form-group" v-bind:class="form.errors.has('url')? 'has-error' : ''">
            	<label for="url">Url</label>
            	<input placeholder="url" name="url" type="text" id="url" class="form-control" v-model="form.url">
            	<span class="help-block" v-if="form.errors.has('url')" v-text="form.errors.get('url')"></span>
            </div>

            <div class="form-group">
            	<div class="row">
            		<div class="col-md-6">
            			<div class="form-group" v-bind:class="form.errors.has('source')? 'has-error' : ''">
	            			<label for="url">Source</label>
			            	<input placeholder="source" name="source" type="text" id="url" class="form-control" v-model="form.source">
			            	<span class="help-block" v-if="form.errors.has('source')" v-text="form.errors.get('source')"></span>
		            	</div>
            		</div>
            		<div class="col-md-6">
            			<div class="form-group" v-bind:class="form.errors.has('destination')? 'has-error' : ''">
			            	<label for="url">Destination</label>
			            	<input placeholder="destination" name="destination" type="text" id="url" class="form-control" v-model="form.destination">
			            	<span class="help-block" v-if="form.errors.has('destination')" v-text="form.errors.get('destination')"></span>
			            </div>
            		</div>
            	</div>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('shortLink')? 'has-error' : ''">
                <label for="shortLink"></label>
                <span class="form-control">
                    <input type="checkbox" id="shortLink" name="shortLink" v-model="form.shortLink" checked=""> Tạo link rút gọn
                </span>
                <span class="help-block" v-if="form.errors.has('shortLink')" v-text="form.errors.get('shortLink')"></span>
            </div>
        </div>

        <div class="box-footer">
            <input class="btn btn-primary" type="submit" value="Tạo link" @click.prevent="submitAndClose">
            <a class="btn btn-primary" href="#" @click="cancel">
                Hủy
            </a>
        </div>
        <viewed v-if="viewItem" @viewObject="viewObject"></viewed>
    </form>
</template>

<script>
	import viewed from './View.vue';
    export default {
    	components: { viewed },

        data(){
        	return {
        		form: new Form({
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
        		}),
                viewItem: false,
                viewObject: null,

        	};
        },

        methods: {
            cancel() {
                this.$emit('cancelAdd');
            },

            submitAndClose() {
                this.form.post(site_url + 'api/link')
                	.then((res) => {
                        viewObject = res.created;
            			this.$emit('submitCreated', res);
                	})
                	.catch((err) => {
                		console.error(err);
                	});
            },
	    },
    }
</script>