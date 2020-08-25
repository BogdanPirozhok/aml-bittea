<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="ru">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, maximum-scale=1">

        <title>Bittea | AML</title>

        <link rel="icon" href="{{ asset('library/img/favicon.ico') }}" type="image/x-icon">
        <link rel="shortcut icon" href="{{ asset('library/img/favicon.ico') }}" type="image/x-icon">
    
        <link href="{{ asset('library/css/confirm.css?v='. $version) }}" rel="stylesheet" />
        <link href="{{ asset('assets/css/alm.css?v='. $version) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('library/css/notify.css?v='. $version) }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/almfonts.css?v='. $version) }}" rel="stylesheet" type="text/css" /> 
    </head>
    <body class="body">
        <div id="app">
            <template>
                <header
                    :class="{active: menu}"
                >
                    <div class="header__wrap">
                        <a href="{{ url('/') }}" class="logo" target="_blank">
                            <div class="logo__img">
                                <img src="library/img/alm.svg" alt="">
                            </div>
                            <span class="logo__title">Bittea AML</span>
                        </a>
                        <button type="button" class="btn" v-on:click.self="order.show = $event">
                            <span disabled>@{{__('Новая заявка')}}</span>
                        </button>
                    </div>
                    <ul class="menu">
                        <li class="menu__items"
                            v-on:click="cycleComponent('applications')" 
                            :class="{active: current == 'applications'}"
                        >
                            <svg class="menu__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 343.5 343.5" xml:space="preserve">
                                <path d="M322.05,161.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10C332.05,166.3,327.65,161.8,322.05,161.8z"/>
                                <path d="M57.95,125.3c-25.7,0-46.5,20.8-46.5,46.5s20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5S83.65,125.3,57.95,125.3zM57.95,198.3c-14.7,0-26.5-11.9-26.5-26.5c0-14.7,11.9-26.5,26.5-26.5c14.6,0,26.5,11.9,26.5,26.5S72.55,198.3,57.95,198.3z"/>
                                <path d="M322.05,36.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10C332.05,41.3,327.65,36.8,322.05,36.8z"/>
                                <path d="M57.95,0c-25.7,0-46.5,20.8-46.5,46.5c0,25.7,20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5C104.45,20.9,83.65,0.1,57.95,0zM57.95,73.1c-14.7,0-26.5-11.9-26.5-26.5c0-14.6,11.9-26.5,26.5-26.5c14.7,0,26.5,11.9,26.5,26.5C84.45,61.2,72.55,73.1,57.95,73.1z"/>
                                <path d="M322.05,286.8h-182.6c-5.5,0-10,4.5-10,10s4.5,10,10,10h182.6c5.5,0,10-4.5,10-10S327.65,286.8,322.05,286.8z"/>
                                <path d="M57.95,250.5c-25.7,0-46.5,20.8-46.5,46.5c0,25.7,20.8,46.5,46.5,46.5s46.5-20.8,46.5-46.5C104.45,271.4,83.65,250.5,57.95,250.5z M57.95,323.6c-14.7,0-26.5-11.9-26.5-26.5c0-14.7,11.9-26.5,26.5-26.5c14.7,0,26.5,11.9,26.5,26.5S72.55,323.6,57.95,323.6z"/>
                            </svg>
                            <span class="menu__name">@{{__('Заявки')}}</span>
                        </li>
                        <li class="menu__items"
                            v-on:click="cycleComponent('profile')"
                            :class="{active: current == 'profile'}"
                        >
                            <svg class="menu__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 482.9 482.9" xml:space="preserve">
                                <path d="M239.7,260.2c0.5,0,1,0,1.6,0c0.2,0,0.4,0,0.6,0c0.3,0,0.7,0,1,0c29.3-0.5,53-10.8,70.5-30.5c38.5-43.4,32.1-117.8,31.4-124.9c-2.5-53.3-27.7-78.8-48.5-90.7C280.8,5.2,262.7,0.4,242.5,0h-0.7c-0.1,0-0.3,0-0.4,0h-0.6c-11.1,0-32.9,1.8-53.8,13.7c-21,11.9-46.6,37.4-49.1,91.1c-0.7,7.1-7.1,81.5,31.4,124.9C186.7,249.4,210.4,259.7,239.7,260.2z M164.6,107.3c0-0.3,0.1-0.6,0.1-0.8c3.3-71.7,54.2-79.4,76-79.4h0.4c0.2,0,0.5,0,0.8,0c27,0.6,72.9,11.6,76,79.4c0,0.3,0,0.6,0.1,0.8c0.1,0.7,7.1,68.7-24.7,104.5c-12.6,14.2-29.4,21.2-51.5,21.4c-0.2,0-0.3,0-0.5,0l0,0c-0.2,0-0.3,0-0.5,0c-22-0.2-38.9-7.2-51.4-21.4C157.7,176.2,164.5,107.9,164.6,107.3z"/>
                                <path d="M446.8,383.6c0-0.1,0-0.2,0-0.3c0-0.8-0.1-1.6-0.1-2.5c-0.6-19.8-1.9-66.1-45.3-80.9c-0.3-0.1-0.7-0.2-1-0.3c-45.1-11.5-82.6-37.5-83-37.8c-6.1-4.3-14.5-2.8-18.8,3.3c-4.3,6.1-2.8,14.5,3.3,18.8c1.7,1.2,41.5,28.9,91.3,41.7c23.3,8.3,25.9,33.2,26.6,56c0,0.9,0,1.7,0.1,2.5c0.1,9-0.5,22.9-2.1,30.9c-16.2,9.2-79.7,41-176.3,41c-96.2,0-160.1-31.9-176.4-41.1c-1.6-8-2.3-21.9-2.1-30.9c0-0.8,0.1-1.6,0.1-2.5c0.7-22.8,3.3-47.7,26.6-56c49.8-12.8,89.6-40.6,91.3-41.7c6.1-4.3,7.6-12.7,3.3-18.8c-4.3-6.1-12.7-7.6-18.8-3.3c-0.4,0.3-37.7,26.3-83,37.8c-0.4,0.1-0.7,0.2-1,0.3c-43.4,14.9-44.7,61.2-45.3,80.9c0,0.9,0,1.7-0.1,2.5c0,0.1,0,0.2,0,0.3c-0.1,5.2-0.2,31.9,5.1,45.3c1,2.6,2.8,4.8,5.2,6.3c3,2,74.9,47.8,195.2,47.8s192.2-45.9,195.2-47.8c2.3-1.5,4.2-3.7,5.2-6.3C447,415.5,446.9,388.8,446.8,383.6z"/>
                            </svg>
                            <span class="menu__name">@{{__('Профиль')}}</span>
                        </li>
                        <li class="menu__items"
                            v-on:click="confirmAction($event, {type:'BVersion'})"
                            :class="{active: current == 'chat'}"
                        >
                            <svg class="menu__svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.001 512.001" xml:space="preserve">
                                <path d="M509.989,463.656L474.84,361.363c16.906-34.174,25.847-72.265,25.907-110.593c0.102-66.002-25.435-128.411-71.909-175.727C382.357,27.718,320.418,1.08,254.433,0.033c-34.571-0.555-68.117,5.815-99.757,18.912c-30.517,12.633-57.884,30.932-81.34,54.388c-23.457,23.456-41.756,50.823-54.388,81.34c-13.097,31.64-19.46,65.203-18.913,99.757c1.045,65.985,27.684,127.924,75.009,174.406c47.224,46.383,109.472,71.912,175.332,71.911c0.129,0,0.265,0,0.394,0c38.328-0.06,76.419-9.001,110.594-25.907l102.293,35.149c3.934,1.352,7.966,2.011,11.954,2.011c9.474,0,18.69-3.722,25.678-10.712C511.218,491.359,514.553,476.939,509.989,463.656z M479.824,479.824c-1.007,1.007-3.163,2.535-6.304,1.457l-108.394-37.246c-1.603-0.55-3.27-0.824-4.932-0.824c-2.45,0-4.889,0.593-7.098,1.762c-31.327,16.573-66.727,25.363-102.374,25.417c-119.55,0.193-218.442-96.91-220.336-216.441C29.433,193.81,52.309,137.289,94.8,94.798c42.491-42.49,98.995-65.362,159.151-64.411c119.53,1.895,216.625,100.738,216.439,220.336c-0.056,35.648-8.845,71.048-25.417,102.373c-1.962,3.708-2.301,8.063-0.938,12.03l37.246,108.394C482.36,476.659,480.832,478.818,479.824,479.824z"/>
                                <path d="M247.91,362.748c-7.939,0-15.545,6.981-15.178,15.178c0.368,8.223,6.669,15.178,15.178,15.178c7.939,0,15.545-6.981,15.178-15.178C262.72,369.702,256.419,362.748,247.91,362.748z"/>
                                <path d="M247.91,127.674c-41.639,0-75.515,33.876-75.515,75.515c0,8.382,6.796,15.178,15.178,15.178s15.178-6.796,15.178-15.178c0-24.9,20.259-45.159,45.159-45.159s45.159,20.259,45.159,45.159s-20.259,45.159-45.159,45.159c-8.382,0-15.178,6.796-15.178,15.178v61.905c0,8.382,6.796,15.178,15.178,15.178c8.382,0,15.178-6.795,15.178-15.179v-48.259c34.389-7.045,60.337-37.54,60.337-73.982C323.425,161.55,289.549,127.674,247.91,127.674z"/>
                            </svg>
                            <span class="menu__name">@{{__('Поддержка')}}</span>
                        </li>
                    </ul>
                    <div class="header__wrap">
                        <template>
                            <div class="balance">
                                <span class="balance__number">@{{ account.delta }} $</span>
                                <span class="balance__title">@{{ user.fullname }}</span>
                                <span class="balance__subtitle">@{{ user.name }}</span>
                                <div class="balance__progress">
                                    <span class="balance__progress-line"
                                        :style="{width: account.percent +'%'}"
                                    ></span>
                                    <span class="balance__progress-text">@{{ account.use }} / @{{ account.score }} $</span>
                                </div>
                            </div>
                            <div class="summary" style="display: none;">
                                <div class="summary__box">
                                    <span class="summary__title">10</span>
                                    <span class="summary__subtitle">@{{__('заявок')}}</span>
                                </div>
                                <div class="summary__box">
                                    <span class="summary__title">6</span>
                                    <span class="summary__subtitle">@{{__('полож.')}}</span>
                                </div>
                                <div class="summary__box">
                                    <span class="summary__title">4</span>
                                    <span class="summary__subtitle">@{{__('отриц.')}}</span>
                                </div>
                            </div>
                        </template>
                    </div>
                    <div class="close"
                        v-on:click="menu = false"
                    >
                        <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                            <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"/>
                        </svg>
                    </div>
                </header>
            </template>
            <main>
                <navbar-alm
                    :lang="lang" 
                    :mob.sync="menu"
                ></navbar-alm>

                <keep-alive>
                    <component 
                        :is="currentTabComponent"
                        :dataprofit="user"
                        :lang="lang"
                    ></component>
                </keep-alive>
            </main>
            
            <transition name="fade">
                <div class="overlay" 
                    v-show="order.show || order.info || menu"
                    v-on:click="order.show = order.edit = order.info = menu = false"
                ></div>
            </transition>

            <div class="overlay-modal" style="display: none;"></div>

            <order-info
                :info="order.info"
                :user="user.fullname"
                :lang="lang"
            ></order-info>

            <div class="overlay-black" style="display: none;">
                <div class="img-modal">
                    <div class="img-modal__arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492 492" xml:space="preserve">
                            <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
                        </svg>
                    </div>
                    <div class="img-modal__img">
                        <img src="library/img/picture-1.jpg" alt="" />
                    </div>
                    <div class="img-modal__arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 492.004 492.004" xml:space="preserve">
                            <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                        </svg>
                    </div>
                    <div class="close">
                        <svg viewBox="0 0 329.26933 329" xmlns="http://www.w3.org/2000/svg">
                            <path d="m194.800781 164.769531 128.210938-128.214843c8.34375-8.339844 8.34375-21.824219 0-30.164063-8.339844-8.339844-21.824219-8.339844-30.164063 0l-128.214844 128.214844-128.210937-128.214844c-8.34375-8.339844-21.824219-8.339844-30.164063 0-8.34375 8.339844-8.34375 21.824219 0 30.164063l128.210938 128.214843-128.210938 128.214844c-8.34375 8.339844-8.34375 21.824219 0 30.164063 4.15625 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921875-2.089844 15.082031-6.25l128.210937-128.214844 128.214844 128.214844c4.160156 4.160156 9.621094 6.25 15.082032 6.25 5.460937 0 10.921874-2.089844 15.082031-6.25 8.34375-8.339844 8.34375-21.824219 0-30.164063zm0 0"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="error-container"></div>

            <order-alm
                :show.sync="order"
                :data.sync="data"
                :lang="lang"
            ></order-alm>

            <confirm-item ref="confirm" :lang="lang"></confirm-item>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>

            <svg xmlns="http://www.w3.org/2000/svg" style="position: absolute;left: -10000px;top: 0;">
                <defs>
                    <filter id="goo">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                        <feBlend in="SourceGraphic" in2="goo" />
                    </filter>
                </defs>
            </svg>
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" style="position: absolute;left: -10000px;top: 0;">
                <defs>
                    <filter id="goo-2">
                        <feGaussianBlur in="SourceGraphic" stdDeviation="15" result="blur"></feGaussianBlur>
                        <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 30 -10" result="goo"></feColorMatrix>
                        <feBlend in="SourceGraphic" in2="goo"></feBlend>
                    </filter>
                </defs>
            </svg>
        </div>
		
		<script>
            var data = <? echo json_encode($data) ?>;
            var user = <? echo json_encode($user) ?>;
            var _token = '<?= csrf_token() ?>';
        </script>

        <script src="{{ asset('library/js/notify.js') }}"></script>
        <script src="{{ asset('assets/js/manifest.js?v='. $version) }}"></script>
        <script src="{{ asset('assets/js/vendor.js?v='. $version) }}"></script>
        <script src="{{ asset('assets/js/index.js?v='. $version) }}"></script>
    </body>
</html>