<template>
	<div class="profile__wrapper">
		<div class="request__top">
            <div class="request__top-left">
                <div class="request__title">
                    <h2>{{$root.__('ПРОФИЛЬ')}}</h2>
                </div>
                <div class="info__box">
                    <span class="profile__info-text">{{$root.__('последнее обновление данных')}} <b>{{dataprofit.update_at | dateFilter}}</b></span>
                </div>
            </div>
        </div>
        <div class="profile">
            <div class="profile__info profile__info--mob">
                <span class="profile__circle">{{dataprofit.fullname[0]}}</span>
                <span class="data">{{dataprofit.create_at | dateFilter}}</span>
                <span class="name">{{dataprofit.fullname}}</span>
                <span class="login">{{dataprofit.name}}</span>
                <span class="phone">{{dataprofit.phone}}</span>
                <span class="e-mail">{{dataprofit.email}}</span>
                <button type="button" class="new-order__btn"
                    :disable="activeBtn" 
                    v-on:click="updateUser" 
                >
                    <span>{{$root.__('Обновить данные')}}</span>
                    <div class="loader-btn">
                        <div></div>
                    </div>
                </button>
            </div>
            <div class="profile__form">
                <div class="profile__form-top">
                    <div class="square">
                        <svg fill="#fff" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve">
                            <path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z"/>
                            <path d="M423.966,358.195C387.006,320.667,338.009,300,286,300h-60c-52.008,0-101.006,20.667-137.966,58.195C51.255,395.539,31,444.833,31,497c0,8.284,6.716,15,15,15h420c8.284,0,15-6.716,15-15C481,444.833,460.745,395.539,423.966,358.195z M61.66,482c7.515-85.086,78.351-152,164.34-152h60c85.989,0,156.825,66.914,164.34,152H61.66z"/>
                        </svg>
                    </div>
                    <span class="title">{{$root.__('Редактировать профиль')}}</span>
                </div>
                <div class="new-order__input"
                    :class="{active: form.fullname !== ''}"
                >
                    <input id="name" type="text" name="name"
                        v-model.trim="form.fullname"
                    >
                    <label for="name">{{$root.__('Имя')}}</label>
                </div>
                <div class="new-order__input new-order__input--50"
                    :class="{active: form.email !== ''}"
                >
                    <input id="email" type="email" name="email"
                        v-model.trim="form.email"
                    >
                    <label for="email">E-mail</label>
                </div>
                <div class="new-order__input new-order__input--50"
                    :class="{active: form.phone !== ''}"
                >
                    <masked-input id="phone" type="tel" name="phone"
                        mask="\+\38 (011) 111-11-11"
                        v-model.trim="form.phone"
                    />
                    <label for="phone">{{$root.__('Телефон')}}</label>
                </div>
                <div class="profile__line"></div>
                <div class="new-order__input"
                    :class="{active: form.password !== ''}"
                >
                    <input id="new-password" type="text" name="new-password"
                        v-model.trim="form.password"
                    >
                    <label for="new-password">{{$root.__('Новый пароль')}}</label>
                </div>
                <div class="new-order__input"
                    :class="{active: repeatpassword !== ''}"
                >
                    <input id="again-password" type="text" name="again-password"
                        v-model.trim="repeatpassword"
                    >
                    <label for="again-password">{{$root.__('Пароль еще раз')}}</label>
                </div>
            </div>
            <div class="profile__info profile__info--desktop">
                <span class="profile__circle">{{dataprofit.fullname[0]}}</span>
                <span class="data">{{dataprofit.create_at | dateFilter}}</span>
                <span class="name">{{dataprofit.fullname}}</span>
                <span class="login">{{dataprofit.name}}</span>
                <span class="phone">{{dataprofit.phone}}</span>
                <span class="e-mail">{{dataprofit.email}}</span>
                <button type="button" class="new-order__btn"
                    :disable="activeBtn" 
                    v-on:click="updateUser"
                >
                    <span>{{$root.__('Обновить данные')}}</span>
                    <div class="loader-btn">
                        <div></div>
                    </div>
                </button>
            </div>
        </div>
	</div>
</template>

<script>
    export default{
        props: ['dataprofit', 'lang'],
        data: function(){
            return{
                form:{
                    fullname: '',
                    email: '',
                    phone: '',
                    password: '',
                },
                repeatpassword: ''
            }
        },
        computed: {
            activeBtn: function(){
                if (this.form.phone != '') {
                    if (this.form.phone.indexOf('_') !== -1) {
                        return true;
                    }
                }
                
                let email = this.form.email.match(/^[0-9a-z-\.]+\@[0-9a-z-]{2,}\.[a-z]{2,}$/i);

                if (this.form.email != '') {
                    if(!email){
                        return true;
                    } 
                    
                }

                if (this.form.password != '' || this.repeatpassword != '') {
                    if (!(this.form.password == this.repeatpassword)) {
                        return true;
                    }
                }
                return !Boolean(this.form.fullname || this.form.email || this.form.phone || this.form.password || this.repeatpassword);
            }
        },
        filters: {
            dateFilter: function(value){
                return dateFormat(value * 1000, 'dd.mm.yyyy');
            }
        },
        methods: {
            inValid: function(target, notify, txt, type, title) {
                this.valid = false;

                $(target)
                    .animate({left: '-8%'}, 60)
                    .animate({left:  '8%'}, 120)
                    .animate({left: '-5%'}, 60)
                    .animate({left:  '5%'}, 80)
                    .animate({left:    '0'}, 60);

                if ( !notify ) {
                    addNotify(txt, type, title);
                }

                setTimeout(() => {
                    this.valid = true;
                }, 750)
            },
            updateUser: function(e) {
                var _data = this.form,
                    pass = this.form.password.trim(),
                    invalid = false,
                    valid = {
                        length: 6,
                        symbol: {
                            all: 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM0123456789',
                            upper: {
                                check: false,
                                data: 'QWERTYUIOPLKJHGFDSAZXCVBNM'
                            },
                            number: {
                                check: false,
                                data: '0123456789'
                            }
                        }
                    };

                if (pass !== this.repeatpassword) {
                    addNotify(this.$root.__('Пароли не совпадают'), 'error', this.$root.__('Ошибка'));
                    return;
                }

                if (pass != '') {
                    if (pass.length < valid.length) {
                        invalid = this.$root.__('Пароль должен содержать не менее 6-ти символов');
                    }else{
                        for (var i = 0; i < pass.length; i++) {
                            if ( valid.symbol.upper.data.indexOf(pass[i]) != -1 ) {
                                valid.symbol.upper.check = true;
                            }
                            if ( valid.symbol.number.data.indexOf(pass[i]) != -1 ) {
                                valid.symbol.number.check = true;
                            }
                            if ( valid.symbol.all.indexOf(pass[i]) == -1 ) {
                                invalid = this.$root.__('Используются недопустимые символы');
                                break;
                            }
                        }

                        if ( !valid.symbol.upper.check || !valid.symbol.number.check ) {
                            invalid = this.$root.__('Пароль должен содержать буквы латинского алфавита, хотя бы одну цифру и букву в верхнем регистре');
                        }
                    }
                }

                if (invalid) {
                    this.inValid(e.target, false, invalid, 'info', this.$root.__('Внимание!'));
                    return
                }

                let data = {}

                for(let key in _data){
                    if(_data[key] != ''){
                        data[key] = _data[key];
                    }
                }

                for(let keys in data){
                    for( let key in this.$root.user){
                        if( key == keys){
                            this.$root.user[key] = data[keys];
                        }
                    }
                }

                this.form = {
                    fullname: '',
                    email: '',
                    phone: '',
                    password: '',
                }
                this.repeatpassword = '';
                
                axios.post('/aml_order/profile', {
                    input: {
                        id: this.dataprofit.id,
                        data: data
                    }
                })
                .then(response => {
                    if ( response.status !== 200 ) {
                        addNotify(this.$root.__('На сервере произошла ошибка, пожалуйста обновите страницу и попробуйте еще раз'), 'error', this.$root.__('Ошибка!'));
                    }else{
                    	addNotify(this.$root.__('Данные успешно изменены'), 'success', this.$root.__('Успешно'));
						this.$root.user.update_at = response.data;
                    }
                    
                }) 
                .catch(error => {
                    addNotify(this.$root.__('На сервере произошла ошибка, пожалуйста обновите страницу и попробуйте еще раз'), 'error', this.$root.__('Ошибка!'));
                });
            }
        }
    }
</script>