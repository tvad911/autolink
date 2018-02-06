<template>
	<form method="GET" action="" accept-charset="UTF-8" role="form">
        <label for="show">Show</label>
        <select name="items_per_page" class="form-control input-sm" v-model="perPage">
            <option v-for="option in itemsPerPage" v-bind:value="option" :selected="option == offset">{{ option }}</option>
        </select>
        <input type="button" value="Apply" class="btn btn-info btn-sm" @click.prevent="changeItemPerpage">
    </form>
</template>

<script>
    export default {
        data() {
            return {
                itemsPerPage: [1, 5, 10, 15, 20, 25, 50],
                perPage: this.offset
            }
        },
        props:{
            offset:{
                type: Number,
                default: 25
            }
        },

        methods:{
            changeItemPerpage(){
                this.$emit('changeItemPerpage', this.perPage);
            }
        }
    }
</script>