<template>
    <transition-group name="aml-order" class="request__middle" tag="div">
        <template v-if="orders.length">
            <div class="request"
                v-for="(order, index) in items"
                :key="order.id"
                :class="{active: order.id === select}"
            >
                <div class="request__number">
                    <div class="request__circle"
                        :style="{
                            borderColor: returnColor(order.statuses)
                        }"
                    ><span
                        :style="{
                            color: returnColor(order.statuses)
                        }"
                    >{{index + 1}}</span></div>
                    <span class="request__number-title">#{{(order.id + 422020)}}</span>
                </div>
                <div class="request__box">
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('имя')}}</span>
                        <span class="request__box-subtitle">{{order.fullname}}</span>
                    </div>
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('кошелек')}}</span>
                        <span class="request__box-subtitle">{{order.wallet}}</span>
                    </div>
                </div>
                <div class="request__box">
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('вид проверки')}}</span>
                        <span class="request__box-subtitle">{{order.check | amlCheck}}</span>
                    </div>
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('статус')}}</span>
                        <span class="request__box-subtitle">{{order.statuses | getStatusAml | amlStatusName}}</span>
                    </div>
                </div>
                <div class="request__box request__box--right">
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('стоимость')}}</span>
                        <span class="request__box-subtitle">{{order.price | numberFormat}} $</span>
                    </div>
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('посл. обнов.')}}</span>
                        <span class="request__box-subtitle">{{order.statuses | getStatusAml | dateOrder }}</span>
                    </div>
                </div>
                <div class="request__btn"
                    v-on:click="activeOrder(order.id)"
                >
                    <span class="request__btn-cricle"></span>
                    <span class="request__btn-cricle"></span>
                    <span class="request__btn-cricle"></span>
                </div>
            </div>
        </template>
        <template v-else>
            <div class="request request-no" key="null_order">
                <div class="request__number">
                    <div class="request__circle"><span>0</span></div>
                </div>
                <div class="request__box">
                    <div class="request__box-group">
                        <span class="request__box-title">{{$root.__('у вас нет заявок')}}</span>
                        <span class="request__box-subtitle">{{$root.__('Нажмите «Новая заявка», чтобы начать работу и пройти первую процедуру проверки.')}}</span>
                    </div>
                </div>
                <div class="request__btn">
                    <span class="request__btn-cricle"></span>
                    <span class="request__btn-cricle"></span>
                    <span class="request__btn-cricle"></span>
                </div>
            </div>
        </template>
    </transition-group>
</template>

<script>
	export default{
		props:['orders', 'sort', 'lang'],
		data: function(){
			return{
				select: null,
                color:[
                    '#b6c0d0',
                    '#61a6e6',
                    '#e89271',
                    '#e89271',
                    '#e89271',
                    '#23c87b'
                ]
			}
		},
        computed: {
            items: function() {
                var key = this.sort.key, 
                    direct = this.sort.direct ? 1 : -1;

                return this.orders.sort((a, b) => {
                    var status = [
                            a.statuses.filter(item => {
                                return item.timestamp
                            }),
                            b.statuses.filter(item => {
                                return item.timestamp
                            })
                        ],
                        option = {
                            id: [
                                a.id,
                                b.id
                            ],
                            fullname: [
                                [a.fullname, b.fullname].sort().reverse().indexOf(a.fullname),
                                [a.fullname, b.fullname].sort().reverse().indexOf(b.fullname)
                            ],
                            wallet: [
                                [a.wallet, b.wallet].sort().reverse().indexOf(a.wallet),
                                [a.wallet, b.wallet].sort().reverse().indexOf(b.wallet)
                            ],
                            check: [
                                a.check.one + a.check.two + a.check.three,
                                b.check.one + b.check.two + b.check.three
                            ],
                            status: [
                                status[0].length,
                                status[1].length
                            ],
                            price: [
                                a.price,
                                b.price
                            ],
                            timestamp: [
                                status[0].reverse()[0].timestamp,
                                status[1].reverse()[0].timestamp
                            ]
                        };

                    if (option[key][0] > option[key][1]){
                        return direct;
                    }else if (option[key][0] < option[key][1]) {
                        return - direct;
                    }else{
                        return 0;
                    }
                })
            }
        },
		filters: {
            dateOrder: function(value){
                return dateFormat(value.timestamp * 1000, 'dd.mm | HH:MM')
            },
            numberFormat: function(value) {
                return String(value).number_format();
            },
			amlStatusName: function(value) {
                switch (value.status) {
                    case 1: return __('новая заявка');
                    case 2: return __('в работе');
                    case 3: return __('проверка') + ' #1';
                    case 4: return __('проверка') + ' #2';
                    case 5: return __('проверка') + ' #3';
                    case 6: return __('выполнено')
                }
            },
            amlCheck: function(value) {
            	let str = [];

                if (value.one && value.two && value.three) {
                    return __('полная');
                }else{
                    if (value.one) {
                        str.push(__('проверка') + ' #1');
                    }
                    if (value.two) {
                        str.push(__('проверка') + ' #2');
                    }
                    if (value.three) {
                        str.push(__('проверка') + ' #3');
                    }

                    return str.join(', ');
                }
            },
            getStatusAml: function(status) {
                for (var i = status.length - 1; i >= 0; i--) {
                    var item = status[i];

                    if ( item.timestamp ) {
                        return item;
                    }
                }
            }
		},
		methods: {
			activeOrder: function(id){
                this.select = this.select !== id ? id : null;

                this.$emit('edit', this.select);
			},
            returnColor: function(value){
                for (var i = value.length - 1; i >= 0; i--) {
                    var item = value[i];

                    if ( item.timestamp ) {
                        return this.color[i];
                    }
                }
            }
		}
	}
</script>