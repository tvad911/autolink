<template>
    <form method="POST" action="" accept-charset="UTF-8" role="form" abineguid="">
    	<div class="box-header">
	        <h3 class="box-title">
	        	<i class="fa fa-plus-square" aria-hidden="true"></i> Show Link
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

            <div class="form-group" v-bind:class="form.errors.has('a123link')? 'has-error' : ''">
                <label for="a123link">123Link</label>
                <input placeholder="a123link" name="url" type="text" id="a123link" class="form-control" v-model="form.a123link">
                <span class="help-block" v-if="form.errors.has('a123link')" v-text="form.errors.get('a123link')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('shorte')? 'has-error' : ''">
                <label for="shorte">Shortest</label>
                <input placeholder="shorte" name="url" type="text" id="shorte" class="form-control" v-model="form.shorte">
                <span class="help-block" v-if="form.errors.has('shorte')" v-text="form.errors.get('shorte')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('megaurl')? 'has-error' : ''">
                <label for="megaurl">Megaurl</label>
                <input placeholder="megaurl" name="url" type="text" id="megaurl" class="form-control" v-model="form.megaurl">
                <span class="help-block" v-if="form.errors.has('megaurl')" v-text="form.errors.get('megaurl')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('googl_url')? 'has-error' : ''">
                <label for="googl_url">Googl</label>
                <input placeholder="googl_url" name="url" type="text" id="googl_url" class="form-control" v-model="form.googl_url">
                <span class="help-block" v-if="form.errors.has('googl_url')" v-text="form.errors.get('googl_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('bitly_url')? 'has-error' : ''">
                <label for="bitly_url">Bit.ly</label>
                <input placeholder="bitly_url" name="url" type="text" id="bitly_url" class="form-control" v-model="form.bitly_url">
                <span class="help-block" v-if="form.errors.has('bitly_url')" v-text="form.errors.get('bitly_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('anotedpad_url')? 'has-error' : ''">
                <label for="anotedpad_url">Anotedpad</label>
                <input placeholder="anotedpad_url" name="url" type="text" id="anotedpad_url" class="form-control" v-model="form.anotedpad_url">
                <span class="help-block" v-if="form.errors.has('anotedpad_url')" v-text="form.errors.get('anotedpad_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('googl_url')? 'has-error' : ''">
                <label for="googl_url">Googl</label>
                <input placeholder="googl_url" name="url" type="text" id="googl_url" class="form-control" v-model="form.googl_url">
                <span class="help-block" v-if="form.errors.has('googl_url')" v-text="form.errors.get('googl_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('tiny_url')? 'has-error' : ''">
                <label for="tiny_url">Tiny Url</label>
                <input placeholder="tiny_url" name="url" type="text" id="tiny_url" class="form-control" v-model="form.tiny_url">
                <span class="help-block" v-if="form.errors.has('tiny_url')" v-text="form.errors.get('tiny_url')"></span>
            </div>
        </div>

        <div class="box-footer">
            <a class="btn btn-primary" href="#" @click="cancel">
                Hủy
            </a>
        </div>
    </form>
</template>
<script>
    export default {
        props: {
            id:{
                type: Number,
                default: 0
            }
        },

        data() {
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
        	};
        },

        created(){
        	this.setValue();
        },

        methods: {
            cancel() {
                this.$emit('cancelShow');
            },

            setValue(){
            	axios.get(site_url + 'api/link/' + this.id, {}).then((res) => {
	                    this.form.id = res.data.item.id;
	                    this.form.email = res.data.item.email;
	                    this.form.username = res.data.item.username;
	                    this.form.name = res.data.item.name;
	                    this.form.group_id = res.data.item.group_id;
	                    this.form.status = res.data.item.status;
	                    this.form.created_at = res.data.item.created_at;
	                    this.form.updated_at = res.data.item.updated_at;
	                    this.form.deleted_at = res.data.item.deleted_at;
	                }).catch((err) => console.error(err));
            },
	    },
    }
</script>