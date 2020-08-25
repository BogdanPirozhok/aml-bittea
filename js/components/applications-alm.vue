<template>
	<div class="request__wrapper">
		<search-alm
			:orders="$root.data.orders"
			:sort.sync="sort" 
			:showButton.sync="allButton"
			:lang="lang"
		></search-alm>

        <list-alm 
        	:orders="$root.data.orders"
        	:sort="sort" 
        	v-on:edit="showBtn"
        	:lang="lang"
        ></list-alm>
    </div>
</template>

<script>
	import SearchAlm from './search-alm';
	import ListAlm from './list-alm';

	export default{
		props: ['data', 'lang'],
		data: function(){
			return{
				allButton: null,
				sort: {
                    key: 'id',
                    direct: false
                }
			}
		},
		components:{
			SearchAlm, ListAlm
		},
		methods:{
			showBtn: function(val){
				this.allButton = val;
			}
		}
	}
</script>