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
                <img alt="logo" class="w-10" src="{{ asset('dist/images/dssc_logo.png') }}">
                <span class="text-white text-lg ml-3"> QR-DTS </span>
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
        <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
            <div class="my-auto mx-auto xl:ml-20 bg-white dark:bg-darkmode-600 xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                        Sign Up
                    </h2>
                    <div class="intro-x mt-2 text-slate-400 dark:text-slate-400 xl:hidden text-center">A few more clicks to sign in to your account. Manage all your e-commerce accounts in one place</div>
                    <div class="intro-x mt-8">

                        <input id="first_name" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="First Name">

                        @error('first_name')
                        <div class="alert alert-outline-warning alert-dismissible show flex items-center bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                            <span><i data-lucide="alert-triangle" class="w-6 h-6 mr-3"></i></span>
                            <span class="text-slate-800 dark:text-slate-500">{{ $message }}<a class="text-primary font-medium"></a></span>
                            <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                        </div>
                        @enderror

                        <input id="last_name" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Last Name">

                        @error('last_name')
                        <div class="alert alert-outline-warning alert-dismissible show flex items-center bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                            <span><i data-lucide="alert-triangle" class="w-6 h-6 mr-3"></i></span>
                            <span class="text-slate-800 dark:text-slate-500">{{ $message }}<a class="text-primary font-medium"></a></span>
                            <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                        </div>
                        @enderror

                        <input id="mid_name" name="mid_name" value="{{ old('mid_name') }}" required autocomplete="mid_name" type="text" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Middle Name">

                        @error('mid_name')
                        <div class="alert alert-outline-warning alert-dismissible show flex items-center bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                            <span><i data-lucide="alert-triangle" class="w-6 h-6 mr-3"></i></span>
                            <span class="text-slate-800 dark:text-slate-500">{{ $message }}<a class="text-primary font-medium"></a></span>
                            <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                        </div>
                        @enderror


                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Email">

                        @error('email')
                        <div class="alert alert-outline-warning alert-dismissible show flex items-center bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                            <span><i data-lucide="alert-triangle" class="w-6 h-6 mr-3"></i></span>
                            <span class="text-slate-800 dark:text-slate-500">{{ $message }}<a class="text-primary font-medium"></a></span>
                            <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                        </div>
                        @enderror

                        <input id="password" type="password" name="password" required autocomplete="new-password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password">
                        <input id="password-confirm" type="password" name="password_confirmation" required autocomplete="new-password" class="intro-x login__input form-control py-3 px-4 block mt-4" placeholder="Password Confirmation">
                        @error('password')
                        <div class="alert alert-outline-warning alert-dismissible show flex items-center bg-warning/20 dark:bg-darkmode-400 dark:border-darkmode-400 mt-5" role="alert">
                            <span><i data-lucide="alert-triangle" class="w-6 h-6 mr-3"></i></span>
                            <span class="text-slate-800 dark:text-slate-500">{{ $message }}<a class="text-primary font-medium"></a></span>
                            <button type="button" class="btn-close dark:text-white" data-tw-dismiss="alert" aria-label="Close"> <i data-lucide="x" class="w-4 h-4"></i> </button>
                        </div>
                        @enderror
                    </div>
                    <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                        <button type="submit" class="btn btn-primary py-3 px-4 w-full xl:w-32 xl:mr-3 align-top">Register</button>
                    </div>
                </form>
                <div class="intro-x mt-10 xl:mt-24 text-slate-600 dark:text-slate-500 text-center xl:text-left">Already have an account? <a class="text-primary dark:text-slate-200" href="/login">Login Here</a> </div>
            </div>
        </div>
    </div>
</div>
@include('_partials.scripts')

<script src="{{BASEPATH()}}/js/onelogin.js{{GET_RES_TIMESTAMP(0)}}"></script>
<script src="{{BASEPATH()}}/js/login.js{{GET_RES_TIMESTAMP(0)}}"></script>

</body>
</html>


