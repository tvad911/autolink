<template>
    <div class="col-md-6 col-sm-6">
	    <ul class="pagination pagination-sm no-margin pull-right">
	        <li v-bind:class="{ disable : isFirst() }">
	        	<span v-if="isFirst()">First</span>
	        	<a href="#" v-if="isFirst() == false" @click.prevent="changePage(1)" rel="first" aria-label="First">First</a>
        	</li>
	        <li v-bind:class="{ disable : isPrev() }">
	        	<span v-if="isPrev() == false">«</span>
	        	<a href="#" v-if="isPrev()" @click.prevent="changePage(pagination.currentPage - 1)" rel="prev" aria-label="Prev">«</a>
        	</li>
	        <li v-for="page in pagesNumber" v-bind:class="[ page == isActived() ? 'active' : '']">
	        	<span v-if="isActived == page" aria-hidden="true">{{ page }}</span>
	        	<a href="#" v-if="isActived != page" @click.prevent="changePage(page)">{{ page }}</a>
        	</li>
	        <li v-bind:class="{ disable : isNext() }">
	        	<span v-if="isNext() == false">»</span>
	        	<a href="#" v-if="isNext()" @click.prevent="changePage(pagination.currentPage + 1)" rel="next" aria-label="Next">»</a>
        	</li>
	        <li v-bind:class="{ disable : isLast() }">
	        	<span v-if="isLast()">Last</span>
	        	<a href="#" v-if="isLast() == false" @click.prevent="changePage(pagination.lastPage)" rel="last" aria-label="Last">Last</a>
        	</li>
	    </ul>
	</div>
</template>
<script>
    export default {
       	props:{
       		pagination:{
            	type: Object,
                required: true
            },
            offset:{
                type: Number,
                required: true
            }
       	},

       	computed:{
            pagesNumber(){

                if(!this.pagination.to){
                    return [];
                }

                var from = this.pagination.currentPage - this.offset;

                if(from < 1) {
                    from = 1;
                }

                var to = from + (this.offset * 2);

                if(to >= this.pagination.lastPage){
                    to = this.pagination.lastPage;
                }

                var pagesArray = [];

                for(from = 1; from <= to; from++){
                    pagesArray.push(from);
                }

                return pagesArray;
            }
        },

        methods:{
            changePage(page){
                this.pagination.currentPage = page;
            },

            isActived(){
                return this.pagination.currentPage;
            },

            isFirst(){
                return this.pagination.currentPage <= 1;
            },

            isLast(){
                return this.pagination.currentPage == this.pagination.lastPage;
            },

            isNext(){
                return this.pagination.currentPage < this.pagination.lastPage;
            },

            isPrev(){
                return this.pagination.currentPage > 1;
            },
        }
    }
</script>