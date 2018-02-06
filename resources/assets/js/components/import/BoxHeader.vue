<template>
	<div class="box-header">
        <h3 class="box-title"><i class="fa fa-list" aria-hidden="true"></i>
        	<slot></slot>
        </h3>

        <div class="pull-right">
            <a href="#"><button id="button-shipping" class="btn btn-info" title="Export to CSV"><i class="fa fa-file-text"></i></button></a>
            <a href="#"><button id="button-invoice" class="btn btn-info" title="Export to Pdf"><i class="fa fa-print"></i></button></a>

            <a title="" href="#" class="btn btn-primary" @click.prevent="openCreatedItem"><i class="fa fa-plus"></i></a>
        </div>
    </div>
</template>
<script>
    export default {
        methods:{
            openCreatedItem(){
                this.$emit('openCreatedItem');
            }
        }
    }
</script>