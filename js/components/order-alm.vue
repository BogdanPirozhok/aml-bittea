<template>
	<transition name="fade-order">
		<div class="new-order__wrapper" 
			v-if="show.show" 
			:class="position.cls"
			:style="position.points"
		>
	        <div class="new-order">
	            <form action="#0" method="POST" class="new-order__form"
					v-on:submit.prevent="show.edit ? editForm() : pushForm()"
	            >
	                <div class="new-order__box-input">
	                    <div class="new-order__input" 
							:class="{active: form.fullname !== ''}"
	                    >
	                        <input id="fullname" type="text" name="fullname" 
	                        	v-model.trim="form.fullname"
	                        >
	                        <label for="fullname">{{$root.__('ФИО')}}</label>
	                    </div>
	                    <div class="new-order__input" 
							:class="{active: form.wallet !== ''}"
	                    >
	                        <input id="wallet" type="text" name="wallet" 
	                        	v-model.trim="form.wallet"
	                        >
	                        <label for="coll">{{$root.__('Кошелек')}}</label>
	                    </div>
	                </div>
	                <div class="new-order__box-checked">
	                    <label class="checkbox__label">
	                        <input type="checkbox" name="name" class="checkbox"
	                        	v-model="form.check.one"
	                        >
	                        <span class="checkbox__text">{{$root.__('Проверка')}} #1</span>
	                    </label>
	                    <label class="checkbox__label">
	                        <input type="checkbox" name="name" class="checkbox"
	                        	v-model="form.check.two"
	                        >
	                        <span class="checkbox__text">{{$root.__('Проверка')}} #2</span>
	                    </label>
	                    <label class="checkbox__label">
	                        <input type="checkbox" name="name" class="checkbox"
	                        	v-model="form.check.three"
	                        >
	                        <span class="checkbox__text">{{$root.__('Проверка')}} #3</span>
	                    </label>
	                </div>
	                <div class="new-order__textarea"
						:class="{active: form.comment !== ''}" 
	                >
	                    <textarea id="comment" name="comment" 
	                    	v-model.trim="form.comment"
	                    ></textarea>

	                    <label for="comment">{{$root.__('Комментарий')}}</label>
	                </div>
	                <div class="new-order__group">
	                    <div class="new-order__price">
	                        <span>{{$root.__('Стоимость заявки')}}</span>
	                        <p>{{ cost.format }} $</p>
	                    </div>

	                    
                    	<button type="submit" class="new-order__btn"
	                    	:class="{
	                    		active: louder,
	                    		'new-order__btn--fail': cost.val - cost.editVal > data.score - data.use
	                    	}"
	                    >
	                    	<template v-if="cost.val - cost.editVal > data.score - data.use">
			                    <span>{{$root.__('Недостаточно средств')}}</span>
		                    </template>
			                    <template v-else>
		                        <span v-if="!show.edit">{{$root.__('Создать заявку')}}</span> 
		                        <span v-else>{{$root.__('Редактировать')}}</span>
		                        <div class="loader-btn"><div></div></div>
	                   		</template>
		                </button>
	                </div>
	            </form>
	        </div>
    	</div>
	</transition>
</template>

<script>
	export default{
		props: ['show', 'data', 'lang'],
		data: function(){
			return{
				louder: false,
				form:{
					fullname: '',
					wallet: '',
					comment: '',
					check: {
						one: true,
						two: true,
						three: true
					}
				}
			}
		},
		watch: {
			'show.show': function(){
				this.form = {
					fullname: '',
					wallet: '',
					comment: '',
					check: {
						one: true,
						two: true,
						three: true
					}
				};
			},
			'show.edit': function(){
				if(this.show.edit != ''){
					var edit = this.show.edit;
					this.form.id = edit.id;
					this.form.fullname = edit.fullname;
					this.form.wallet = edit.wallet;
					this.form.comment = edit.comment;
					this.form.check.one = edit.check.one;
					this.form.check.two = edit.check.two;
					this.form.check.three = edit.check.three;
				}
			}
		},
		computed: {
			position: function() {
				var event = this.show.show,
					point = event.target.getBoundingClientRect(),
					wind = window.outerWidth;

				if ( point.left > wind / 2 ) {
					var cls = 'new-order--left',
						points = {
							left: point.left + 'px',
							top: point.top - 71 + 'px'
						};
				}else{
					var cls = 'new-order--right',
						points = {
							left: point.right + 'px',
							top: point.top - (point.height / 2) + 'px'
						};
				}

				return {
					cls: cls,
					points: points
				};
			},
			costEdit: function(){
				if(this.show.edit == ''){
					return 0;
				}
				let costOne = 0,
				costTwo = 0,
				costThree = 0;

				if(this.show.edit.check.one){
					costOne = 99.99;
				}
				if(this.show.edit.check.two){
					costTwo = 199.99;
				}
				if(this.show.edit.check.three){
					costThree = 399.99;
				}

				return costOne + costTwo + costThree;

			},
			cost: function(){
				let costOne = 0,
					costTwo = 0,
					costThree = 0;

				if(this.form.check.one){
					costOne = 99.99;
				}
				if(this.form.check.two){
					costTwo = 199.99;
				}
				if(this.form.check.three){
					costThree = 399.99;
				}

				return {
					val: costOne + costTwo + costThree,
					format: String(costOne + costTwo + costThree).number_format(),
					editVal: this.show.edit == '' ? 0 : this.costEdit
				};
			}
		},
		methods: {
			pushForm: function(){
				let _data = this.form;
					
				if ( !_data.fullname || !_data.wallet || !this.cost.val ) {
					addNotify(this.$root.__('Вы не заполнили обязательные поля'), 'info', 'Внимание!');
					return;
				}

				this.louder = true;

				axios.post('/aml_order/create', {
					input: _data
				}).then(response => {
					this.data.orders.unshift(response.data.data);
					this.$emit('update:data', this.data);
					
					this.$emit('update:show', {
						show: false,
						edit: '' 
					});
				}).catch(error => {
					addNotify(this.$root.__('На сервере произошла ошибка, пожалуйста обновите страницу и попробуйте еще раз'), 'error', 'Ошибка!');
				}).finally(() => {
					this.louder = false;
				})
			},
			editForm: function(){
				this.louder = true;
				let _data = this.form;
				axios.post('/aml_order/edition', {
					input: _data
				}).then(response => {
					this.$root.data.orders.forEach((item, i) =>{
						if(item.id === _data.id){
							this.$root.data.orders[i].fullname  = _data.fullname;
							this.$root.data.orders[i].wallet    = _data.wallet;
							this.$root.data.orders[i].comment   = _data.comment;
							this.$root.data.orders[i].price     = this.cost.val;
							this.$root.data.orders[i].check.one = _data.check.one;
							this.$root.data.orders[i].check.two = _data.check.two;
							this.$root.data.orders[i].check.three = _data.check.three;
						}
					})
					this.$emit('update:show', {
						show: false,
						edit: '' 
					});
				}).catch(error => {
					addNotify(this.$root.__('На сервере произошла ошибка, пожалуйста обновите страницу и попробуйте еще раз'), 'error', 'Ошибка!');
				}).finally(() => {
					this.louder = false;
				})
			}
		}
	}
</script>