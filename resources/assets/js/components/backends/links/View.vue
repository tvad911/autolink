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
                <div class="input-group input-group-sm">
                    <input placeholder="a123link" name="url" type="text" id="a123link" class="form-control" v-model="form.a123link">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" v-clipboard="form.a123link">Copy!</button>
                    </span>
                </div>
                <span class="help-block" v-if="form.errors.has('a123link')" v-text="form.errors.get('a123link')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('shorte')? 'has-error' : ''">
                <label for="shorte">Shortest</label>
                <div class="input-group input-group-sm">
                    <input placeholder="shorte" name="url" type="text" id="shorte" class="form-control" v-model="form.shorte">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" v-clipboard="form.shorte">Copy!</button>
                    </span>
                </div>
                <span class="help-block" v-if="form.errors.has('shorte')" v-text="form.errors.get('shorte')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('megaurl')? 'has-error' : ''">
                <label for="megaurl">Megaurl</label>
                <div class="input-group input-group-sm">
                    <input placeholder="megaurl" name="url" type="text" id="megaurl" class="form-control" v-model="form.megaurl">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-info btn-flat" v-clipboard="form.megaurl">Copy!</button>
                    </span>
                </div>
                <span class="help-block" v-if="form.errors.has('megaurl')" v-text="form.errors.get('megaurl')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('bitly_url')? 'has-error' : ''">
                <label for="bitly_url">Bit.ly</label>
                <div class="input-group input-group-sm">
                    <input placeholder="bitly_url" name="url" type="text" id="bitly_url" class="form-control" v-model="form.bitly_url">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" v-clipboard="form.anotedpad_url">Copy!</button>
                    </span>
                </div>
                <span class="help-block" v-if="form.errors.has('bitly_url')" v-text="form.errors.get('bitly_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('anotedpad_url')? 'has-error' : ''">
                <label for="anotedpad_url">Anotedpad</label>
                <div class="input-group input-group-sm">
                    <input placeholder="anotedpad_url" name="url" type="text" id="anotedpad_url" class="form-control" v-model="form.anotedpad_url">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" v-clipboard="form.anotedpad_url">Copy!</button>
                    </span>
                </div>
                <span class="help-block" v-if="form.errors.has('anotedpad_url')" v-text="form.errors.get('anotedpad_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('googl_url')? 'has-error' : ''">
                <label for="googl_url">Googl</label>
                <div class="input-group input-group-sm">
                    <input placeholder="googl_url" name="url" type="text" id="googl_url" class="form-control" v-model="form.googl_url">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" v-clipboard="form.googl_url">Copy!</button>
                    </span>
                </div>
                <span class="help-block" v-if="form.errors.has('googl_url')" v-text="form.errors.get('googl_url')"></span>
            </div>

            <div class="form-group" v-bind:class="form.errors.has('tiny_url')? 'has-error' : ''">
                <label for="tiny_url">Tiny Url</label>
                <div class="input-group input-group-sm">
                    <input placeholder="tiny_url" name="url" type="text" id="tiny_url" class="form-control" v-model="form.tiny_url">
                    <span class="input-group-btn">
                      <button type="button" class="btn btn-info btn-flat" v-clipboard="form.tiny_url">Copy!</button>
                    </span>
                </div>
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
        			//id: 0,
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
                this.$emit('cancelView');
            },

            setValue(){
                //this.form.id = this.viewObject.id;
                this.form.url = this.viewObject.url;
                this.form.a123link = this.viewObject.a123link;
                this.form.shorte = this.viewObject.shorte;
                this.form.megaurl = this.viewObject.megaurl;
                this.form.googl_url = this.viewObject.googl_url;
                this.form.bitly_url = this.viewObject.bitly_url;
                this.form.anotedpad_url = this.viewObject.anotedpad_url;
                this.form.tiny_url = this.viewObject.tiny_url;
                this.form.source = this.viewObject.source;
                this.form.destination = this.viewObject.destination;
                this.form.user_id = this.viewObject.user_id;
                this.form.status = this.viewObject.status;
            },
	    },
    }
</script>