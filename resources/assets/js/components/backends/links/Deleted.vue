<template>
	<div class="modal modal-primary fade in" id="deletedItem" tabindex="-1" role="dialog" aria-labelledby="deletedItem" style="display: block;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeModal()">
                    <span aria-hidden="true">×</span></button>
                    <h4 class="modal-title">Link</h4>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn xóa link này không?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline pull-left" data-dismiss="modal" @click="closeModal()">Không</button>
                    <button type="button" class="btn btn-outline action_confirm" data-method="deleted" @click="submitAndClose()">Có</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
</template>

<script>
    export default {
        props: {
            deletedItem:{
                type: Number,
                default: 0
            }
        },

        methods: {
            closeModal() {
                this.$emit('closeDeleted');
            },

            submitAndClose() {
                axios.delete(site_url + 'api/link/' + this.deletedItem).then((res) => {
                    this.$emit('submitDeleted', res.data);
                }).catch((err) => console.error(err));
            },
	    },
    }
</script>