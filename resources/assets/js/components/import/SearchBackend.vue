<template>
	<form method="GET" action="" accept-charset="UTF-8" role="form" @submit.prevent="searchData">
        <label>
        Search:
        </label>
        <input aria-controls="searchBy" placeholder="" type="search" name="search" v-model="search" class="form-control input-sm">
        <select aria-controls="searchBy" name="searchFields" class="form-control input-sm" v-model="searchFields">
            <option value="id;username;email">Search by All</option>
            <option value="id">Search by ID</option>
            <option value="username">Search by Username</option>
            <option value="email">Search by Email</option>
        </select>
        <button type="button" class="btn btn-sm btn-info" @click.prevent="searchData">Apply</button>
    </form>
</template>
<script>
    export default {
        data(){
            return {
                searchFields: 'id;username;email',
                search: '',
            }
        },
        methods: {
            searchData(){
                this.$emit('searchData', this.search, this.searchFields);
            },
        }
    }
</script>