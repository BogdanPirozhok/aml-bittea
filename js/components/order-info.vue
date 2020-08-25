<template>
    <transition name="fade-right">
    	<div class="order-info" v-if="info">
            <div class="order-info__top">
                <div class="close"
                	v-on:click="$root.order.info = false"
                >
                    <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                        <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
                    </svg>
                </div>
                <div class="order-info__top-text">
                    <span class="title">{{ data.fullname }}</span>
                    <span class="subtitle">{{ data.wallet }}</span>
                </div>
            </div>
            <div class="order-info__middle">
                <div class="chat__box chat__box--left">
                    <div class="chat__face">
                        <div class="chat__circle">
                            <span class="chat__circle-text">{{ user[0] }}</span>
                        </div>
                        <span class="chat__time">{{ data.statuses[0].timestamp | dataMinut }}</span>
                    </div>
                    <div class="chat__you">
                        <p class="chat__title"><b>{{$root.__('Процедуры проверки:')}}</b> {{ data.check | amlCheck }}</p>
                        <p class="chat__title" style="margin-top: 5px;"
                        	v-show="data.comment" 
                            v-html="getComment"
                        ></p>

                        <svg viewBox="0 0 299 281" xmlns="http://www.w3.org/2000/svg" class="chat__trig">
                            <path d="M299 0L299 280.5C208.427 137.943 143.722 75.5669 0 0L299 0Z"></path>
                        </svg>
                    </div>
                </div>
                <div class="order-step__box">
                    <div class="order-step order-gray" 
                    	v-if="data.statuses[0].timestamp"
                    >
                        <div class="order-step__info">
                            <span class="order-step__data">{{data.statuses[0].timestamp | dataDay}}</span>
                            <span class="order-step__time">{{data.statuses[0].timestamp | dataMinut}}</span>
                        </div>
                        <div class="order-step__circle">
                            <svg class="order-step__circle-svg" viewBox="-66 0 569 569.286" xmlns="http://www.w3.org/2000/svg"><path d="m.109375 66.382812v493.132813c0 5.238281 4.246094 9.484375 9.484375 9.484375h360.367188c5.234374 0 9.480468-4.246094 9.480468-9.484375v-398.296875c0-.210938-.101562-.390625-.121094-.597656-.046874-.832032-.210937-1.652344-.484374-2.4375-.105469-.304688-.179688-.597656-.3125-.894532-.460938-1.03125-1.101563-1.972656-1.898438-2.777343l-94.832031-94.832031c-.804688-.800782-1.75-1.441407-2.789063-1.898438-.285156-.121094-.574218-.222656-.871094-.3125-.792968-.273438-1.617187-.4375-2.457031-.492188-.160156.027344-.347656-.074218-.546875-.074218h-265.535156c-5.238281 0-9.484375 4.242187-9.484375 9.480468zm346.957031 85.351563h-62.457031v-62.457031zm-327.992187-75.867187h246.570312v85.351562c0 5.234375 4.246094 9.480469 9.480469 9.480469h85.351562v379.335937h-341.402343zm0 0"/><path d="m398.410156 493.132812v18.964844h28.449219c5.238281 0 9.484375-4.242187 9.484375-9.480468v-493.132813c0-5.238281-4.246094-9.484375-9.484375-9.484375h-360.367187c-5.238282 0-9.484376 4.246094-9.484376 9.484375v28.449219h18.96875v-18.96875h341.398438v474.167968zm0 0"/><path d="m75.976562 189.667969h227.597657v18.964843h-227.597657zm0 0"/><path d="m75.976562 132.765625h75.867188v18.96875h-75.867188zm0 0"/><path d="m75.976562 246.566406h151.734376v18.96875h-151.734376zm0 0"/><path d="m246.675781 246.566406h56.898438v18.96875h-56.898438zm0 0"/><path d="m75.976562 303.464844h227.597657v18.96875h-227.597657zm0 0"/><path d="m75.976562 417.265625h227.597657v18.96875h-227.597657zm0 0"/><path d="m161.324219 360.367188h142.25v18.964843h-142.25zm0 0"/><path d="m75.976562 360.367188h66.382813v18.964843h-66.382813zm0 0"/><path d="m75.976562 474.167969h37.933594v18.964843h-37.933594zm0 0"/><path d="m132.875 474.167969h170.699219v18.964843h-170.699219zm0 0"/></svg>
                        </div>
                        <span class="order-step__title"><b>{{$root.__('Создана')}}</b> {{$root.__('новая заявка')}}</span>
                    </div>
                    <div class="order-step order-blue"
                    	v-if="data.statuses[1].timestamp"
                    >
                        <div class="order-step__info">
                            <span class="order-step__data">{{data.statuses[1].timestamp | dataDay}}</span>
                            <span class="order-step__time">{{data.statuses[1].timestamp | dataMinut}}</span>
                        </div>
                        <div class="order-step__circle">
                            <svg class="order-step__circle-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 482.9 482.9" xml:space="preserve"><path d="M239.7,260.2c0.5,0,1,0,1.6,0c0.2,0,0.4,0,0.6,0c0.3,0,0.7,0,1,0c29.3-0.5,53-10.8,70.5-30.5    c38.5-43.4,32.1-117.8,31.4-124.9c-2.5-53.3-27.7-78.8-48.5-90.7C280.8,5.2,262.7,0.4,242.5,0h-0.7c-0.1,0-0.3,0-0.4,0h-0.6    c-11.1,0-32.9,1.8-53.8,13.7c-21,11.9-46.6,37.4-49.1,91.1c-0.7,7.1-7.1,81.5,31.4,124.9C186.7,249.4,210.4,259.7,239.7,260.2z     M164.6,107.3c0-0.3,0.1-0.6,0.1-0.8c3.3-71.7,54.2-79.4,76-79.4h0.4c0.2,0,0.5,0,0.8,0c27,0.6,72.9,11.6,76,79.4    c0,0.3,0,0.6,0.1,0.8c0.1,0.7,7.1,68.7-24.7,104.5c-12.6,14.2-29.4,21.2-51.5,21.4c-0.2,0-0.3,0-0.5,0l0,0c-0.2,0-0.3,0-0.5,0    c-22-0.2-38.9-7.2-51.4-21.4C157.7,176.2,164.5,107.9,164.6,107.3z"/><path d="M446.8,383.6c0-0.1,0-0.2,0-0.3c0-0.8-0.1-1.6-0.1-2.5c-0.6-19.8-1.9-66.1-45.3-80.9c-0.3-0.1-0.7-0.2-1-0.3    c-45.1-11.5-82.6-37.5-83-37.8c-6.1-4.3-14.5-2.8-18.8,3.3c-4.3,6.1-2.8,14.5,3.3,18.8c1.7,1.2,41.5,28.9,91.3,41.7    c23.3,8.3,25.9,33.2,26.6,56c0,0.9,0,1.7,0.1,2.5c0.1,9-0.5,22.9-2.1,30.9c-16.2,9.2-79.7,41-176.3,41    c-96.2,0-160.1-31.9-176.4-41.1c-1.6-8-2.3-21.9-2.1-30.9c0-0.8,0.1-1.6,0.1-2.5c0.7-22.8,3.3-47.7,26.6-56    c49.8-12.8,89.6-40.6,91.3-41.7c6.1-4.3,7.6-12.7,3.3-18.8c-4.3-6.1-12.7-7.6-18.8-3.3c-0.4,0.3-37.7,26.3-83,37.8    c-0.4,0.1-0.7,0.2-1,0.3c-43.4,14.9-44.7,61.2-45.3,80.9c0,0.9,0,1.7-0.1,2.5c0,0.1,0,0.2,0,0.3c-0.1,5.2-0.2,31.9,5.1,45.3    c1,2.6,2.8,4.8,5.2,6.3c3,2,74.9,47.8,195.2,47.8s192.2-45.9,195.2-47.8c2.3-1.5,4.2-3.7,5.2-6.3    C447,415.5,446.9,388.8,446.8,383.6z"/></svg>
                        </div>
                        <span class="order-step__title">{{$root.__('Менеджер')}} <b>{{ data.manager | managerName }}</b> {{$root.__('принял(a) заявку')}}</span>
                    </div>
                    <div class="order-step order-orange"
                    	v-if="data.statuses[2].timestamp"
                    >
                        <div class="order-step__info">
                            <span class="order-step__data">{{data.statuses[2].timestamp | dataDay}}</span>
                            <span class="order-step__time">{{data.statuses[2].timestamp | dataMinut}}</span>
                        </div>
                        <div class="order-step__circle">
                            <svg class="order-step__circle-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.998 415.998" xml:space="preserve"><circle cx="208.239" cy="48" r="12"/><path d="M367.998,95.999c0-17.673-14.326-32-31.999-32h-44.424c-5.926-6.583-13.538-11.62-22.284-14.136    c-7.367-2.118-13.037-7.788-15.156-15.155C248.37,14.663,229.897,0,207.998,0c-21.898,0-40.37,14.663-46.134,34.706    c-2.122,7.376-7.806,13.039-15.182,15.164c-8.736,2.518-16.341,7.55-22.262,14.129H79.999c-17.674,0-32,14.327-32,32v287.999    c0,17.673,14.326,32,32,32c73.466,0,163.758,0,256,0c17.674,0,32-14.327,32-32C367.999,293.119,367.998,206.096,367.998,95.999z     M128,95.742c0.11-14.066,9.614-26.606,23.112-30.496c12.71-3.662,22.477-13.426,26.127-26.116    C181.157,25.51,193.805,16,207.998,16c14.194,0,26.842,9.51,30.758,23.13c3.652,12.698,13.413,22.459,26.111,26.11    c13.618,3.917,23.13,16.566,23.13,30.758v16H128V95.742z M335.999,399.998c-85.455,0-170.77,0-256,0c-8.823,0-16-7.178-16-16    V95.999c0-8.822,7.177-16,16-16h34.742c-1.73,4.892-2.698,10.143-2.74,15.617v32.383h191.998v-32c0-5.615-0.992-10.991-2.764-16    h34.764c8.822,0,15.999,7.178,15.999,16c0,45.743-0.001,260.254,0.002,287.999C351.999,392.82,344.822,399.998,335.999,399.998z"/><polygon points="274.51,194.508 178.343,290.674 135.955,248.286 124.642,259.6 178.343,313.302 285.823,205.822   "/></svg>
                        </div>
                        <span class="order-step__title">{{$root.__('проведена')}} <b>{{$root.__('проверка')}} #1</b></span>
                    </div>
                    <div class="order-step order-orange"
                    	v-if="data.statuses[3].timestamp"
                    >
                        <div class="order-step__info">
                            <span class="order-step__data">{{data.statuses[3].timestamp | dataDay}}</span>
                            <span class="order-step__time">{{data.statuses[3].timestamp | dataMinut}}</span>
                        </div>
                        <div class="order-step__circle">
                            <svg class="order-step__circle-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.998 415.998" xml:space="preserve"><circle cx="208.239" cy="48" r="12"/><path d="M367.998,95.999c0-17.673-14.326-32-31.999-32h-44.424c-5.926-6.583-13.538-11.62-22.284-14.136    c-7.367-2.118-13.037-7.788-15.156-15.155C248.37,14.663,229.897,0,207.998,0c-21.898,0-40.37,14.663-46.134,34.706    c-2.122,7.376-7.806,13.039-15.182,15.164c-8.736,2.518-16.341,7.55-22.262,14.129H79.999c-17.674,0-32,14.327-32,32v287.999    c0,17.673,14.326,32,32,32c73.466,0,163.758,0,256,0c17.674,0,32-14.327,32-32C367.999,293.119,367.998,206.096,367.998,95.999z     M128,95.742c0.11-14.066,9.614-26.606,23.112-30.496c12.71-3.662,22.477-13.426,26.127-26.116    C181.157,25.51,193.805,16,207.998,16c14.194,0,26.842,9.51,30.758,23.13c3.652,12.698,13.413,22.459,26.111,26.11    c13.618,3.917,23.13,16.566,23.13,30.758v16H128V95.742z M335.999,399.998c-85.455,0-170.77,0-256,0c-8.823,0-16-7.178-16-16    V95.999c0-8.822,7.177-16,16-16h34.742c-1.73,4.892-2.698,10.143-2.74,15.617v32.383h191.998v-32c0-5.615-0.992-10.991-2.764-16    h34.764c8.822,0,15.999,7.178,15.999,16c0,45.743-0.001,260.254,0.002,287.999C351.999,392.82,344.822,399.998,335.999,399.998z"/><polygon points="274.51,194.508 178.343,290.674 135.955,248.286 124.642,259.6 178.343,313.302 285.823,205.822   "/></svg>
                        </div>
                        <span class="order-step__title">{{$root.__('проведена')}} <b>{{$root.__('проверка')}} #2</b></span>
                    </div>
                    <div class="order-step order-orange"
                    	v-if="data.statuses[4].timestamp"
                    >
                        <div class="order-step__info">
                            <span class="order-step__data">{{data.statuses[4].timestamp | dataDay}}</span>
                            <span class="order-step__time">{{data.statuses[4].timestamp | dataMinut}}</span>
                        </div>
                        <div class="order-step__circle">
                            <svg class="order-step__circle-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 415.998 415.998" xml:space="preserve"><circle cx="208.239" cy="48" r="12"/><path d="M367.998,95.999c0-17.673-14.326-32-31.999-32h-44.424c-5.926-6.583-13.538-11.62-22.284-14.136    c-7.367-2.118-13.037-7.788-15.156-15.155C248.37,14.663,229.897,0,207.998,0c-21.898,0-40.37,14.663-46.134,34.706    c-2.122,7.376-7.806,13.039-15.182,15.164c-8.736,2.518-16.341,7.55-22.262,14.129H79.999c-17.674,0-32,14.327-32,32v287.999    c0,17.673,14.326,32,32,32c73.466,0,163.758,0,256,0c17.674,0,32-14.327,32-32C367.999,293.119,367.998,206.096,367.998,95.999z     M128,95.742c0.11-14.066,9.614-26.606,23.112-30.496c12.71-3.662,22.477-13.426,26.127-26.116    C181.157,25.51,193.805,16,207.998,16c14.194,0,26.842,9.51,30.758,23.13c3.652,12.698,13.413,22.459,26.111,26.11    c13.618,3.917,23.13,16.566,23.13,30.758v16H128V95.742z M335.999,399.998c-85.455,0-170.77,0-256,0c-8.823,0-16-7.178-16-16    V95.999c0-8.822,7.177-16,16-16h34.742c-1.73,4.892-2.698,10.143-2.74,15.617v32.383h191.998v-32c0-5.615-0.992-10.991-2.764-16    h34.764c8.822,0,15.999,7.178,15.999,16c0,45.743-0.001,260.254,0.002,287.999C351.999,392.82,344.822,399.998,335.999,399.998z"/><polygon points="274.51,194.508 178.343,290.674 135.955,248.286 124.642,259.6 178.343,313.302 285.823,205.822   "/></svg>
                        </div>
                        <span class="order-step__title">{{$root.__('проведена')}} <b>{{$root.__('проверка')}} #3</b></span>
                    </div>
                    <div class="order-step order-green"
                    	v-if="data.statuses[5].timestamp"
                    >
                        <div class="order-step__info">
                            <span class="order-step__data">{{data.statuses[5].timestamp | dataDay}}</span>
                            <span class="order-step__time">{{data.statuses[5].timestamp | dataMinut}}</span>
                        </div>
                        <div class="order-step__circle">
                            <svg class="order-step__circle-svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 495.787 495.787" xml:space="preserve"><rect x="-9.583" y="294.975" transform="matrix(-0.7071 -0.7071 0.7071 -0.7071 -96.2081 592.7892)" width="168.499" height="42.69"/><polygon points="375.147,134.987 344.96,104.8 209.707,240.16 239.893,270.347    "/><polygon points="465.707,104.8 239.787,330.613 150.827,241.653 120.64,271.84 239.787,390.987 495.787,134.987    "/></svg>
                        </div>
                        <span class="order-step__title">{{$root.__('Проверка')}} <b>{{$root.__('завершена')}}</b></span>
                    </div>
                </div>
                <template v-if="data.statuses[5].timestamp">
                    <div class="chat__box chat__box--right"
                        v-if="data.desc" 
                    >
                        <div class="chat__me">
                            <span class="chat__forwarded">{{ data.manager }}</span>
                            <p class="chat__title" v-html="data.desc"></p>

                            <svg viewBox="0 0 299 281" xmlns="http://www.w3.org/2000/svg" class="chat__trig">
                                <path d="M299 0L299 280.5C208.427 137.943 143.722 75.5669 0 0L299 0Z"></path>
                            </svg>
                        </div>
                        <div class="chat__face">
                            <div class="chat__logo">
                                <svg viewBox="0 0 293 329" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M198.911 277.72V200.225L164.029 165.344L198.911 130.477V51.6839L145.954 0.0112305L94.2812 51.6839V275.152L148.536 328.109L198.911 277.72ZM132.902 67.6288L146.363 54.1674L160.474 67.8827V112.373L138.052 134.795L132.902 139.917V67.6288ZM132.902 259.122V190.743L138.01 195.851L160.431 218.273V261.803L148.183 274.051L132.902 259.122Z"></path>
                                    <path d="M252.206 96.9504L292.985 51.6839H217.649V266.389L252.206 228.968V96.9504Z"></path>
                                    <path d="M41.0987 96.9504V228.968L75.6694 266.389V51.6839H0.319336L41.0987 96.9504Z"></path>
                                </svg>
                            </div>
                            <span class="chat__time">{{ status.timestamp | dataMinut }}</span>
                        </div>
                    </div>

                    <div class="chat__box chat__box--right"
                        v-if="data.attach"
                    >
                        <div class="chat__me">
                            <a :href="'https://bittea.in/order_aml/'+ data.attach.hash" target="_blank" class="chat__file">
                                <div class="chat__file-group">
                                    <img src="library/img/file.svg" alt="">
                                </div>
                                <div class="chat__file-text">
                                    <span class="chat__file-name">{{ data.attach.name | fileName }}.{{ data.attach.exep }}</span>
                                    <span class="chat__file-weight">{{ data.attach.size | sizeFormat }}</span>
                                </div>
                            </a>
                            <svg viewBox="0 0 299 281" fill="none" xmlns="http://www.w3.org/2000/svg" class="chat__trig">
                                <path d="M299 0L299 280.5C208.427 137.943 143.722 75.5669 0 0L299 0Z"></path>
                            </svg>
                        </div>

                        <div class="chat__face">
                            <div class="chat__logo">
                                <svg viewBox="0 0 293 329" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M198.911 277.72V200.225L164.029 165.344L198.911 130.477V51.6839L145.954 0.0112305L94.2812 51.6839V275.152L148.536 328.109L198.911 277.72ZM132.902 67.6288L146.363 54.1674L160.474 67.8827V112.373L138.052 134.795L132.902 139.917V67.6288ZM132.902 259.122V190.743L138.01 195.851L160.431 218.273V261.803L148.183 274.051L132.902 259.122Z"></path>
                                    <path d="M252.206 96.9504L292.985 51.6839H217.649V266.389L252.206 228.968V96.9504Z"></path>
                                    <path d="M41.0987 96.9504V228.968L75.6694 266.389V51.6839H0.319336L41.0987 96.9504Z"></path>
                                </svg>
                            </div>
                            <span class="chat__time">{{ status.timestamp | dataMinut }}</span>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </transition>
</template>

<script>
	export default{
		props: ['info', 'user', 'lang'],
		data: function() {
			return {
				location: window.location
			}
		},
		computed: {
			data: function(){
                let data = {};

				if ( this.info != false ) {
					this.$root.data.orders.forEach(item => {
						if (item.id === this.info) {
							data = item;
						}
					});
				}
                return data
			},
            status: function() {
                for (var i = this.data.statuses.length - 1; i >= 0; i--) {
                    var item = this.data.statuses[i];

                    if ( item.timestamp ) {
                        return item;
                    }
                }
            },
            getComment: function() {
                return '<b>'+ this.$root.__('Комментарий:') +'</b> '+ this.data.comment.replace("\n", '<br>');
            }
		},
		filters: {
			dataMinut: function(value){
				return dateFormat(value * 1000, 'HH:MM')
			},
			dataDay: function(value){
				return dateFormat(value * 1000, 'dd.mm.yy')
			},
            managerName: function(value) {
                var fullname = value.split(' ');

                return fullname[0] +' '+ fullname[1][0] +'.'
            },
            amlCheck: function(value) {
                let str = [];

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
            },
            sizeFormat: function(value) {
                let zize = value / 1024,
                    round = 1,
                    symbol = '';

                if( zize >= 1000 ){
                    round = 1000;
                    symbol = ' MB'; 
                }else{
                    symbol = ' KB';
                }

                return String( Math.round(( zize / round ) * 100) / 100 ).number_format() + symbol;
            },
            fileName: function(value) {
                return value.length > 22 ? value.slice(0, 22) + '..' : value;
            } 
		}
	}
</script>