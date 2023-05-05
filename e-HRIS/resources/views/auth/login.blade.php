<!DOCTYPE html>

<html lang="en" class="light">
<!-- BEGIN: Head -->
<head>
    @include('_partials.head')
</head>

<body class="login">
    <div class="container sm:px-10">
        <div class="block xl:grid grid-cols-2 gap-4">
            <!-- BEGIN: Login Info -->
            <div class="hidden xl:flex flex-col min-h-screen">
                <a href="" class="-intro-x flex items-center pt-5">
                    {!!GLOBAL_GENERATE_LOGIN_LOGO()!!}
                    {!!GLOBAL_GENERATE_LOGIN_TITLE()!!}
                </a>
                <div class="my-auto">
                    <img alt="picture" class="-intro-x w-1/2 -mt-16" src="{{ asset('dist/images/illustration.png') }}">
                    <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                        Information and
                        <br>
                        Communications
                        <div class="pl-20">
                        Technology Center
                        </div>

                    </div>
                    <div class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-slate-400">Davao del Sur State College</div>
                </div>
            </div>
            <!-- END: Login Info -->
            <!-- BEGIN: Login Form -->
            <form class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0" method="POST" action="{{ route('post-login') }}" id="logForm">
            @csrf
                <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign In
                    </h2>

                    @if(Session::has('message'))
                    <div class="alert alert-outline-danger alert-dismissible show flex items-center bg-danger/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                        <span><i data-lucide="alert-triangle" class="w-6 h-6 mr-3"></i></span>
                        <span class="text-slate-800 dark:text-slate-500">{{ Session::get('message') }}<a class="text-primary font-medium"></a></span>
                        <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                    </div>
                    {{ Session::forget('message') }}
                    @endif

                    {{-- {{ dd( Session::get('message')) }} --}}
                    <div class="intro-x mt-8">

                        <input id="username" type="text" class="intro-x login__input form-control py-3 px-4 block @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="firstname.lastname@dssc.edu.ph">

                        @error('username')
                        <span class="invalid-feedback mt-5" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <input id="password" type="password" class="intro-x login__input form-control py-3 px-4 block mt-4 @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                        @error('password')
                        <span class="invalid-feedback mt-2" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror


                    </div>

                    <div class="intro-x flex text-slate-600 dark:text-slate-500 text-xs sm:text-sm mt-4">
                        <div class="flex items-center mr-auto">
                            <input class="form-check-input border mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            {{ __('Remember Me') }}
                        </div>
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button id="btn_login_onclick_check" class="btn btn-primary py-3 px-4 xl:w-32 xl:mt-0 align-top">
                            Login
                        </button>
                    </div>
                    <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left"> Don't have account yet? <a class="text-primary dark:text-slate-200" href="{{ route('register') }}">Register Here</a> </div>
                </div>
            </form>
        </div>
    </div>
    @include('_partials.scripts')
    <script>
        var __basepath = "{{url('')}}";
    </script>

<script src="../js/account_mngmnt/login.js"></script>

    <script src="{{BASEPATH()}}/js/onelogin.js{{GET_RES_TIMESTAMP(0)}}"></script>
    <script src="{{BASEPATH()}}/js/login.js{{GET_RES_TIMESTAMP(0)}}"></script>


</body>
</html>


