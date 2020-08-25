<template>
	<div class="request__top">
        <div class="request__top-left">
            <div class="request__title">
                <h2>{{$root.__('МОИ ПРОВЕРКИ')}}</h2>
            </div>
            <div class="info__box">
                <div class="info">
                    <div class="info__group"
                        v-if="lastUpdate"
                    >
                        <span class="info__blue">{{ lastUpdate | fullTime }}</span>
                        <span class="info__gray">{{$root.__('посл. обнов.')}}</span>
                    </div>
                    <div class="info__group">
                        <span class="info__blue">{{ stat.length }}</span>
                        <span class="info__gray">{{$root.__('заявок')}}</span>
                    </div>
                    <div class="info__group">
                        <span class="info__blue">{{ stat.done }}</span>
                        <span class="info__gray">{{$root.__('выполнено')}}</span>
                    </div>
                    <div class="info__group">
                        <span class="info__blue">{{ stat.work }}</span>
                        <span class="info__gray">{{$root.__('в работе')}}</span>
                    </div>
                </div>
                <transition name="fade-top">
                    <div class="main-button" v-show="showButton != null">
                        <button type="button" class="btn-svg"
                        	v-on:click="$root.order.info = showButton"
                        >
                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="m484.101562 263.835938 4.800782-7.835938-4.800782-7.839844c-.804687-1.308594-20.117187-32.480468-57.636718-63.71875-49.902344-41.542968-108.691406-63.503906-170.015625-63.503906-61.308594 0-120.242188 21.949219-170.429688 63.472656-37.734375 31.222656-57.265625 62.371094-58.078125 63.683594l-4.902344 7.90625 4.902344 7.90625c.8125 1.3125 20.34375 32.460938 58.078125 63.683594 50.1875 41.523437 109.121094 63.472656 170.429688 63.472656 61.324219 0 120.113281-21.960938 170.015625-63.503906 37.519531-31.238282 56.832031-62.410156 57.636718-63.722656zm-77.628906 41.324218c-44.890625 37.09375-95.367187 55.898438-150.023437 55.898438-54.675781 0-105.316407-18.816406-150.511719-55.933594-23.375-19.195312-39.222656-38.632812-46.984375-49.125 7.765625-10.5 23.613281-29.933594 46.984375-49.128906 45.195312-37.113282 95.832031-55.933594 150.511719-55.933594 54.65625 0 105.128906 18.808594 150.023437 55.898438 23.269532 19.226562 38.980469 38.691406 46.636719 49.164062-7.664063 10.476562-23.371094 29.941406-46.636719 49.160156zm0 0"/><path d="m256 165.867188c-49.699219 0-90.132812 40.433593-90.132812 90.132812s40.433593 90.132812 90.132812 90.132812 90.132812-40.433593 90.132812-90.132812-40.433593-90.132812-90.132812-90.132812zm0 150.265624c-33.15625 0-60.132812-26.976562-60.132812-60.132812s26.976562-60.132812 60.132812-60.132812 60.132812 26.976562 60.132812 60.132812-26.976562 60.132812-60.132812 60.132812zm0 0"/><path d="m30 30h62.625v-30h-92.625v91.5h30zm0 0"/><path d="m419.375 0v30h62.625v61.5h30v-91.5zm0 0"/><path d="m30 420.5h-30v91.5h92.625v-30h-62.625zm0 0"/><path d="m482 482h-62.625v30h92.625v-91.5h-30zm0 0"/></svg>
                        </button>
                        <button type="button" class="btn-svg"
                            :disabled="newOrder"
                            v-on:click="$root.editOrder($event, showButton)" 
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 469.336 469.336" xml:space="preserve"><path d="M456.836,76.168l-64-64.054c-16.125-16.139-44.177-16.17-60.365,0.031L45.763,301.682c-1.271,1.282-2.188,2.857-2.688,4.587L0.409,455.73c-1.063,3.722-0.021,7.736,2.719,10.478c2.031,2.033,4.75,3.128,7.542,3.128c0.979,0,1.969-0.136,2.927-0.407l149.333-42.703c1.729-0.5,3.302-1.418,4.583-2.69l289.323-286.983c8.063-8.069,12.5-18.787,12.5-30.192S464.899,84.237,456.836,76.168z M285.989,89.737l39.264,39.264L120.257,333.998l-14.712-29.434c-1.813-3.615-5.5-5.896-9.542-5.896H78.921L285.989,89.737z M26.201,443.137L40.095,394.5l34.742,34.742L26.201,443.137z M149.336,407.96l-51.035,14.579l-51.503-51.503l14.579-51.035h28.031l18.385,36.771c1.031,2.063,2.708,3.74,4.771,4.771l36.771,18.385V407.96z M170.67,390.417v-17.082c0-4.042-2.281-7.729-5.896-9.542l-29.434-14.712l204.996-204.996l39.264,39.264L170.67,390.417z M441.784,121.72l-47.033,46.613l-93.747-93.747l46.582-47.001c8.063-8.063,22.104-8.063,30.167,0l64,64c4.031,4.031,6.25,9.385,6.25,15.083S445.784,117.72,441.784,121.72z"/></svg>
                        </button>
                        <button type="button" class="btn-svg"
                            :disabled="newOrder"
                            v-on:click="$root.confirmAction($event, {type:'deletOrder', input: '', action: deleteOrder})"
                        >
                            <svg viewBox="-40 0 427 427.00131" xmlns="http://www.w3.org/2000/svg"><path d="m232.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m114.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/><path d="m28.398438 127.121094v246.378906c0 14.5625 5.339843 28.238281 14.667968 38.050781 9.285156 9.839844 22.207032 15.425781 35.730469 15.449219h189.203125c13.527344-.023438 26.449219-5.609375 35.730469-15.449219 9.328125-9.8125 14.667969-23.488281 14.667969-38.050781v-246.378906c18.542968-4.921875 30.558593-22.835938 28.078124-41.863282-2.484374-19.023437-18.691406-33.253906-37.878906-33.257812h-51.199218v-12.5c.058593-10.511719-4.097657-20.605469-11.539063-28.03125-7.441406-7.421875-17.550781-11.5546875-28.0625-11.46875h-88.796875c-10.511719-.0859375-20.621094 4.046875-28.0625 11.46875-7.441406 7.425781-11.597656 17.519531-11.539062 28.03125v12.5h-51.199219c-19.1875.003906-35.394531 14.234375-37.878907 33.257812-2.480468 19.027344 9.535157 36.941407 28.078126 41.863282zm239.601562 279.878906h-189.203125c-17.097656 0-30.398437-14.6875-30.398437-33.5v-245.5h250v245.5c0 18.8125-13.300782 33.5-30.398438 33.5zm-158.601562-367.5c-.066407-5.207031 1.980468-10.21875 5.675781-13.894531 3.691406-3.675781 8.714843-5.695313 13.925781-5.605469h88.796875c5.210937-.089844 10.234375 1.929688 13.925781 5.605469 3.695313 3.671875 5.742188 8.6875 5.675782 13.894531v12.5h-128zm-71.199219 32.5h270.398437c9.941406 0 18 8.058594 18 18s-8.058594 18-18 18h-270.398437c-9.941407 0-18-8.058594-18-18s8.058593-18 18-18zm0 0"/><path d="m173.398438 154.703125c-5.523438 0-10 4.476563-10 10v189c0 5.519531 4.476562 10 10 10 5.523437 0 10-4.480469 10-10v-189c0-5.523437-4.476563-10-10-10zm0 0"/></svg>
                        </button>
                    </div>
                </transition>
            </div>
            <div class="sorting sorting--desktop">
                <div class="sorting__box"
                    v-for="(items, i) in sort_items.pc"
                >
                    <template v-if="(i + 1) == sort_items.pc.length">
                        <label class="sorting__arrow"
                            :disabled="items.indexOf(sort.key) == -1"
                        >
                            <input type="checkbox" name="sort_direct" class="sorting__arrow-input" 
                                v-model="sort.direct"
                            />

                            <span class="sorting__arrow-svg sorting__arrow-svg--left">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.757 349.756" xml:space="preserve">
                                    <path d="M298.055,147.199c0,2.787-1.267,9.271-13.036,9.271h-54.037v178.856c0.072,0.48,0.144,1.159,0.144,1.939c0,3.177-1.207,6.106-3.416,8.269c-2.858,2.798-7.224,4.222-12.988,4.222h-83.056c-11.493,0-14.525-8.149-14.525-12.454V160.236H67.606c-13.841,0-15.904-6.594-15.904-10.521c0-6.293,5.996-12.577,7.197-13.775c3.176-4.305,89.036-118.195,101.529-130.718c4.558-4.534,9.131-5.339,12.163-5.209c7.293,0.3,12.268,5.915,12.808,6.56l104.838,126.674C291.75,134.631,298.055,141.068,298.055,147.199z"/>
                                </svg>
                            </span>
                            <span class="sorting__arrow-svg sorting__arrow-svg--right">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.757 349.756" xml:space="preserve">
                                    <path d="M298.055,147.199c0,2.787-1.267,9.271-13.036,9.271h-54.037v178.856c0.072,0.48,0.144,1.159,0.144,1.939c0,3.177-1.207,6.106-3.416,8.269c-2.858,2.798-7.224,4.222-12.988,4.222h-83.056c-11.493,0-14.525-8.149-14.525-12.454V160.236H67.606c-13.841,0-15.904-6.594-15.904-10.521c0-6.293,5.996-12.577,7.197-13.775c3.176-4.305,89.036-118.195,101.529-130.718c4.558-4.534,9.131-5.339,12.163-5.209c7.293,0.3,12.268,5.915,12.808,6.56l104.838,126.674C291.75,134.631,298.055,141.068,298.055,147.199z"/>
                                </svg>
                            </span>
                        </label>
                    </template>
                    <div class="sorting__title">
                        <template v-for="(item, index) in items">
                            <label class="sorting__title-label">
                                <input type="radio" class="sorting__title-input" 
                                	:name="'sort_key-'+ i" 
                                    :value="item" 
                                    v-model="sort.key"
                                />
                                <span class="sorting__title-name">{{ item | nameFilter }}</span>
                            </label>

                            <p class="sorting__title-delimiter"
                                v-if="items.length > 1 && !index"
                            >/</p>
                        </template>
                    </div>
                    <template v-if="(i + 1) < sort_items.pc.length">
                        <label class="sorting__arrow"
                            :disabled="items.indexOf(sort.key) == -1"
                        >
                            <input type="checkbox" name="sort_direct" class="sorting__arrow-input" 
                                v-model="sort.direct"
                            />

                            <span class="sorting__arrow-svg sorting__arrow-svg--left">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.757 349.756" xml:space="preserve">
                                    <path d="M298.055,147.199c0,2.787-1.267,9.271-13.036,9.271h-54.037v178.856c0.072,0.48,0.144,1.159,0.144,1.939c0,3.177-1.207,6.106-3.416,8.269c-2.858,2.798-7.224,4.222-12.988,4.222h-83.056c-11.493,0-14.525-8.149-14.525-12.454V160.236H67.606c-13.841,0-15.904-6.594-15.904-10.521c0-6.293,5.996-12.577,7.197-13.775c3.176-4.305,89.036-118.195,101.529-130.718c4.558-4.534,9.131-5.339,12.163-5.209c7.293,0.3,12.268,5.915,12.808,6.56l104.838,126.674C291.75,134.631,298.055,141.068,298.055,147.199z"/>
                                </svg>
                            </span>
                            <span class="sorting__arrow-svg sorting__arrow-svg--right">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.757 349.756" xml:space="preserve">
                                    <path d="M298.055,147.199c0,2.787-1.267,9.271-13.036,9.271h-54.037v178.856c0.072,0.48,0.144,1.159,0.144,1.939c0,3.177-1.207,6.106-3.416,8.269c-2.858,2.798-7.224,4.222-12.988,4.222h-83.056c-11.493,0-14.525-8.149-14.525-12.454V160.236H67.606c-13.841,0-15.904-6.594-15.904-10.521c0-6.293,5.996-12.577,7.197-13.775c3.176-4.305,89.036-118.195,101.529-130.718c4.558-4.534,9.131-5.339,12.163-5.209c7.293,0.3,12.268,5.915,12.808,6.56l104.838,126.674C291.75,134.631,298.055,141.068,298.055,147.199z"/>
                                </svg>
                            </span>
                        </label>
                    </template>
                </div>
            </div>
            <div class="sorting sorting--mob">
                <div class="sorting__box"
                    v-for="(item, i) in sort_items.mob"
                >
                    <label class="sorting__title-label">
                        <input type="radio" name="sort_key" class="sorting__title-input" 
                            :value="item" 
                            v-model="sort.key"
                        />

                        <span class="sorting__title-name">{{ item | nameFilter }}</span>
                    </label>
                    <label class="sorting__arrow"
                        :disabled="item != sort.key"
                    >
                        <input type="checkbox" name="sort_direct" class="sorting__arrow-input" 
                            v-model="sort.direct"
                        />
                        <span class="sorting__arrow-svg sorting__arrow-svg--left">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.757 349.756" xml:space="preserve">
                                <path d="M298.055,147.199c0,2.787-1.267,9.271-13.036,9.271h-54.037v178.856c0.072,0.48,0.144,1.159,0.144,1.939c0,3.177-1.207,6.106-3.416,8.269c-2.858,2.798-7.224,4.222-12.988,4.222h-83.056c-11.493,0-14.525-8.149-14.525-12.454V160.236H67.606c-13.841,0-15.904-6.594-15.904-10.521c0-6.293,5.996-12.577,7.197-13.775c3.176-4.305,89.036-118.195,101.529-130.718c4.558-4.534,9.131-5.339,12.163-5.209c7.293,0.3,12.268,5.915,12.808,6.56l104.838,126.674C291.75,134.631,298.055,141.068,298.055,147.199z"/>
                            </svg>
                        </span>
                        <span class="sorting__arrow-svg sorting__arrow-svg--right">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 349.757 349.756" xml:space="preserve">
                                <path d="M298.055,147.199c0,2.787-1.267,9.271-13.036,9.271h-54.037v178.856c0.072,0.48,0.144,1.159,0.144,1.939c0,3.177-1.207,6.106-3.416,8.269c-2.858,2.798-7.224,4.222-12.988,4.222h-83.056c-11.493,0-14.525-8.149-14.525-12.454V160.236H67.606c-13.841,0-15.904-6.594-15.904-10.521c0-6.293,5.996-12.577,7.197-13.775c3.176-4.305,89.036-118.195,101.529-130.718c4.558-4.534,9.131-5.339,12.163-5.209c7.293,0.3,12.268,5.915,12.808,6.56l104.838,126.674C291.75,134.631,298.055,141.068,298.055,147.199z"/>
                            </svg>
                        </span>
                    </label>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
	export default{
		props: ['showButton', 'sort', 'orders', 'lang'],
		data: function() {
			return {
                sort_items: {
                    mob: ['id', 'status', 'timestamp'],
                    pc: [
                        ['id'],
                        ['fullname', 'wallet'],
                        ['check', 'status'],
                        ['price', 'timestamp']
                    ]
                }
			}
		}, 
        filters: {
            fullTime: function(value){
                return dateFormat(value * 1000, 'dd.mm.yy | HH:MM')
            },
            nameFilter: function(value){
                switch (value) {
                    case 'id': return __('Номер');
                    case 'fullname': return __('Имя');
                    case 'wallet': return __('Кошелек');
                    case 'check': return __('Вид');
                    case 'status': return __('Статус');
                    case 'price': return __('Цена');
                    case 'timestamp': return __('Дата');
                }
            },
        },
        computed: {
            newOrder: function(){
                if (this.showButton !== null) {
                	let boll;

                	this.orders.forEach(item => {
                		if (item.id === this.showButton) {
                        	boll = item.statuses[1].timestamp == null 
                    	}
                	});

                    return !boll;
                }else{
                	return true;
                }
            },
            lastUpdate: function() {
                var last = 0;

                this.orders.forEach(item => {
                    for (var i = item.statuses.length - 1; i >= 0; i--) {
                        var status = item.statuses[i];

                        if ( status.timestamp && status.timestamp > last ) {
                            last = status.timestamp;
                            break;
                        }
                    }
                });

                return last
            },
            stat: function() {
                var data = {
                        length: this.orders.length,
                        done: 0,
                        work: 0
                    };

                this.orders.forEach(item => {
                    for (var i = item.statuses.length - 1; i >= 0; i--) {
                        var status = item.statuses[i];

                        if ( status.timestamp ) {
                            if ( status.status == 6 ) {
                                data.done++
                                break;
                            }else if ( status.status != 1 ) {
                                data.work++
                                break;
                            }
                        }
                    }
                });

                return data
            },
        },
        methods: {
            translateWord: function(value, lang){
                switch (value) {
                    case 'id': return this.$root.__('Номер', lang);
                    case 'fullname': return this.$root.__('Имя');
                    case 'wallet': return this.$root.__('Кошелек');
                    case 'check': return this.$root.__('Вид');
                    case 'status': return this.$root.__('Статус');
                    case 'price': return this.$root.__('Цена');
                    case 'timestamp': return this.$root.__('Дата');
                }
            },
        	deleteOrder: function(){
        		axios.post('/alm_order/delete', {
        			id: this.showButton
        		}).then(res => {
        			let orders = this.orders;

        			orders.forEach((item, i)=>{
                		if (item.id === this.showButton) {
                			orders.splice(i, 1);
                    	}
                	});

                	this.$emit('update:showButton', null);
                	this.$root.data.orders = orders;
        		})
        	}
        }
	}
</script>