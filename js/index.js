window.Vue        = require('vue');
window.axios      = require('axios');
window.dateFormat = require('dateformat');

require('./helper/custom.js');
require('./helper/polyfill.js');

import MaskedInput from 'vue-masked-input'; 

Vue.component('order-alm',        require('./components/order-alm.vue').default);
Vue.component('navbar-alm',       require('./components/navbar-alm.vue').default);
Vue.component('applications-aml', require('./components/applications-alm.vue').default);
Vue.component('profile-aml',      require('./components/profile-aml.vue').default);
Vue.component('order-info',       require('./components/order-info.vue').default);
Vue.component('confirm-item',     require('./components/confirm-item.vue').default);
Vue.component('masked-input',     MaskedInput);

new Vue({
	el: '#app',
	data:{
		data: window.data,
		user: window.user,
        current: window.data.divide ? window.data.divide : 'applications',
        menu: false,
		order: {
			show: false,
			edit: '',
            info: false
		},
		lang: {
            selected: localStorage.getItem('lang') ? localStorage.getItem('lang') : 'ru',
            items: ['ru', 'en']
        }
	},
	watch:{
        'data.orders': {
            handler: function () {
                var use = 0;

                this.data.orders.forEach(item => {
                    use += item.price;
                });

                this.data.use = use;
            },
            deep: true
        },
		'lang.selected': function() {
            localStorage.setItem('lang', this.lang.selected);
        },
	},
	computed:{ 
        currentTabComponent: function() { 
            return this.current.toLowerCase() + "-aml";
        },
		account: function() {
			var data = this.data,
				delta = data.score - data.use,
				percent = data.use ? Math.round(100 - ((data.use / data.score) * 100)) : 100;

			return {
				score: String( Math.round(data.score * 100) / 100 ).number_format(),
				use: String( Math.round(data.use * 100) / 100 ).number_format(),
				delta: String( Math.round(delta * 100) / 100 ).number_format(),
				percent: String(percent).number_format()
			}
		}
	},
	methods:{
		__: function(str) {
            var data = window.glossary;

            if ( this.lang.selected != 'ru' ) {
                for (var i = 0; i < data.length; i++) {
                    if ( data[i].indexOf(str + ' |') != -1 ) {
                        var _str = data[i].split(' | '),
                            index = this.lang.items.indexOf( this.lang.selected );

                        return _str[index];
                    }
                }
                return str + '(no translation)'
            }else{
                return str;
            }
        },
		editOrder: function(e, index){
        	let data = '';
            this.data.orders.forEach(item =>{
                if(item.id === index){
                    data = item;
                }
            })
 
        	let	form = {
                    id: index,
        			fullname: data.fullname,
					wallet: data.wallet,
					comment: data.comment,
					check: {
						one: Boolean(data.check.one),
						two: Boolean(data.check.two),
						three: Boolean(data.check.three)
        			}
        		}
        	this.order.show = e;
        	this.order.edit = form;
		},
		confirmAction: function(e, data) {
            this.$refs.confirm.action({
                target: e,
                type: data.type,
                confirm: () => {
                    data.action(data.input);
                    this.$refs.confirm.open = false;
                },
                revoke: () => {
                    this.$refs.confirm.open = false;
                }
            })
        },
        logout: function(){
        	document.getElementById('logout-form').submit();
        },
        cycleComponent: function(component){
            window.history.replaceState(null, null, window.location.pathname +'?divide='+ component.toLowerCase());
            this.current = component;
            this.order.show = this.order.edit = this.order.info = this.menu = false
        }
	}
});