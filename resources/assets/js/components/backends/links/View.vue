<template>
    <form method="POST" action="" accept-charset="UTF-8" role="form" abineguid="">
    	<div class="box-header">
	        <h3 class="box-title">
	        	<i class="fa fa-plus-square" aria-hidden="true"></i> Tạo link thành công
	        </h3>
	    </div>

		<div class="box-body">
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
    </form>
</template>

<script>
    export default {
        props: {
            viewObject:{
                type: Object,
                default: null
            }
        },

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
        	};
        },

        methods: {
            cancel() {
                this.$emit('cancelView');
            },

            setValue(){
                this.form.id = viewObject.id;
                this.form.url = viewObject.url;
                this.form.a123link = viewObject.a123link;
                this.form.shorte = viewObject.shorte;
                this.form.megaurl = viewObject.megaurl;
                this.form.googl_url = viewObject.googl_url;
                this.form.bitly_url = viewObject.bitly_url;
                this.form.anotedpad_url = viewObject.anotedpad_url;
                this.form.tiny_url = viewObject.tiny_url;
                this.form.source = viewObject.source;
                this.form.destination = viewObject.destination;
                this.form.user_id = viewObject.user_id;
                this.form.status = viewObject.status;
            },
	    },
    }
</script>