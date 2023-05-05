<div class="top-bar">
    <!-- BEGIN: Breadcrumb -->
    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
        <ol class="breadcrumb">

{{--            <li class="breadcrumb-item"><a href="../#">Application</a></li>--}}
{{--            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>--}}

            @yield('breadcrumb')

        </ol>
    </nav>
    <!-- END: Breadcrumb -->
    <!-- BEGIN: Search -->
    <div class="intro-x relative mr-3 sm:mr-6">
        <div class="search hidden sm:block">
            <!--
            <input type="text" class="search__input form-control border-transparent" placeholder="Search...">
            <i data-lucide="search" class="search__icon dark:text-slate-500"></i>
        -->
        </div>
        <!--
        <a class="notification sm:hidden" href="/"> <i data-lucide="search" class="notification__icon dark:text-slate-500"></i> </a>
        <div class="search-result">
            <div class="search-result__content">
                <div class="search-result__content__title">Pages</div>
                <div class="mb-5">
                    <a href="../" class="flex items-center">
                        <div class="w-8 h-8 bg-success/20 dark:bg-success/10 text-success flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="inbox"></i> </div>
                        <div class="ml-3">Mail Settings</div>
                    </a>
                    <a href="../" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-pending/10 text-pending flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="users"></i> </div>
                        <div class="ml-3">Users & Permissions</div>
                    </a>
                    <a href="../" class="flex items-center mt-2">
                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 text-primary/80 flex items-center justify-center rounded-full"> <i class="w-4 h-4" data-lucide="credit-card"></i> </div>
                        <div class="ml-3">Transactions Report</div>
                    </a>
                </div>
                <div class="search-result__content__title">Users</div>
                <div class="mb-5">
                    <a href="../" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/profile-7.jpg">
                        </div>
                        <div class="ml-3">Kevin Spacey</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">kevinspacey@left4code.com</div>
                    </a>
                    <a href="../" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/profile-2.jpg">
                        </div>
                        <div class="ml-3">Johnny Depp</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">johnnydepp@left4code.com</div>
                    </a>
                    <a href="../" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/profile-5.jpg">
                        </div>
                        <div class="ml-3">Johnny Depp</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">johnnydepp@left4code.com</div>
                    </a>
                    <a href="../" class="flex items-center mt-2">
                        <div class="w-8 h-8 image-fit">
                            <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/profile-9.jpg">
                        </div>
                        <div class="ml-3">Morgan Freeman</div>
                        <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">morganfreeman@left4code.com</div>
                    </a>
                </div>
                <div class="search-result__content__title">Products</div>
                <a href="../" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/preview-9.jpg">
                    </div>
                    <div class="ml-3">Oppo Find X2 Pro</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Smartphone &amp; Tablet</div>
                </a>
                <a href="../" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/preview-1.jpg">
                    </div>
                    <div class="ml-3">Nikon Z6</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Photography</div>
                </a>
                <a href="../" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/preview-2.jpg">
                    </div>
                    <div class="ml-3">Sony Master Series A9G</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">Electronic</div>
                </a>
                <a href="../" class="flex items-center mt-2">
                    <div class="w-8 h-8 image-fit">
                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="../dist/images/preview-8.jpg">
                    </div>
                    <div class="ml-3">Dell XPS 13</div>
                    <div class="ml-auto w-48 truncate text-slate-500 text-xs text-right">PC &amp; Laptop</div>
                </a>
            </div>
        </div>
    -->
    </div>
    <!-- END: Search -->
   @if (Auth::check())

            <!-- BEGIN: Notifications -->
            <div class="intro-x dropdown mr-auto sm:mr-6 __notification">
                <div class="__notificationBell dropdown-toggle notification @if(chekNotif()->count() >= 1) notification--bullet @endif cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-bell notification__icon dark:text-slate-500"></i> </div>
                <div class="notification-content pt-2 dropdown-menu">
                    <div class="notification-content__box dropdown-content">
                    <div class="grid grid-cols-2">
                        <div class="notification-content__title">Notifications</div>
                        <a id="clear_all_notif" href="javascript:;" class="ml-auto text-sm text-slate-500 whitespace-nowrap">Clear all</a>
                    </div>

                    @forelse (loadNotification() as $notification )

                            @if ( $notification->subject == 'hiring' )
                            <div class="cursor-pointer relative flex items-center mt-2 ">
                                <div class="w-12 h-12 flex-none image-fit mr-1">
                                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-4.jpg">
                                    <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                </div>
                                <div class="ml-2 overflow-hidden">
                                    <div class="flex items-center">
                                        <a href="javascript:;" class="font-medium truncate mr-5">{{ get_profile_name($notification->target_id) }}</a>
                                        <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</div>
                                    </div>
                                    <div class=" tooltip w-full truncate text-slate-500 mt-0.5" title="{{ $notification->notif_content }}">{{ $notification->notif_content }}</div>
                                </div>
                            </div>
                         @endif

                        @empty
                    <div class="w-full truncate text-slate-500 mt-0.5">No notification yet</div>
                    @endforelse

                        {{-- @forelse (loadNotification() as $notification) --}}
                                {{-- @if($notification->getDocDetails)
                                    <div id="btn_openDocument_Notification"
                                        data-notif-type="{{ $notification->subject }}"
                                        data-notif-id="{{ $notification->id }}"
                                        data-fullname="{{ $notification->getUserDetails->firstname." ".$notification->getUserDetails->lastname }}"
                                        data-notif-title="{{ $notification->getDocDetails->name }}"
                                        data-notif-content="{{ $notification->notif_content }}"
                                        data-date-created="{{ $notification->created_at->diffForHumans() }}"
                                        class="cursor-pointer relative flex items-center mt-5">

                                    <div class="items-center w-12 h-12 image-fit">
                                        <i class="fa fa-bell rounded-full notification__icon dark:text-slate-500"></i>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="font-medium truncate mr-5">{{ $notification->getUserDetails->firstname." ".$notification->getUserDetails->lastname }}</div>
                                        <div class="flex items-center">
                                            <a id="document_id" data-notif-id="{{ $notification->id }}" data-doc-id="{{$notification->getDocDetails->track_number}}" href="javascript:;" class="mr-5">{{ $notification->getDocDetails->name }}</a>
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">{{ $notification->notif_content }}</div>
                                    </div>
                                    </div>
                                @elseif($notification->getGroupDetails)
                                    <div id="btn_openGroup_Notification"
                                        data-notif-type="{{ $notification->subject }}"
                                        data-notif-id="{{ $notification->id }}"
                                        data-fullname="{{ $notification->getUserDetails->firstname." ".$notification->getUserDetails->lastname }}"
                                        data-notif-title="{{ $notification->getGroupDetails->name }}"
                                        data-notif-content="{{ $notification->notif_content }}"
                                        data-date-created="{{ $notification->created_at->diffForHumans() }}"
                                        class="cursor-pointer relative flex items-center mt-5">

                                        <div class="items-center h-12 image-fit">
                                            <i class="fa fa-bell rounded-full notification__icon dark:text-slate-500"></i>
                                        </div>
                                        <div class="ml-6 overflow-hidden">
                                            <div class="font-medium truncate mr-5">{{ $notification->getUserDetails->firstname." ".$notification->getUserDetails->lastname }}</div>
                                            <div class="flex items-center">
                                                <a id="group_id" data-grp-id="{{$notification->getGroupDetails->id}}" href="javascript:;" class="mr-5">{{ $notification->getGroupDetails->name }}</a>
                                                <div class="text-xs text-slate-400 ml-auto whitespace-nowrap" >{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="w-full truncate text-slate-500 mt-0.5"  >{{ $notification->notif_content }}</div>
                                        </div>
                                    </div>

                                @elseif ($notification->subject == 'hiring')
                                <div class="cursor-pointer relative flex items-center mt-2 ">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="dist/images/profile-4.jpg">
                                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">{{ $notification->getUserDetails->firstname." ".$notification->getUserDetails->lastname }}</a>
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                        <div class=" tooltip w-full truncate text-slate-500 mt-0.5" title="{{ $notification->notif_content }}">{{ $notification->notif_content }}</div>
                                    </div>
                                </div>
                                @else --}}
                                    {{-- <div class="cursor-pointer relative flex items-center mt-5">
                                        <div class="items-center h-12 image-fit">
                                            <i class="fa fa-bell rounded-full notification__icon dark:text-slate-500"></i>
                                        </div>
                                        <div class="ml-6 overflow-hidden">
                                            <div class="font-medium truncate mr-5">{{ $notification->getUserDetails->firstname." ".$notification->getUserDetails->lastname }}</div>
                                            <div class="flex items-center">
                                                <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                            <div class="w-full truncate text-slate-500 mt-0.5">{{ $notification->notif_content }}</div>
                                        </div>
                                    </div> --}}
                                {{-- @endif --}}
                                {{-- {{ dd($notification->subject) }} --}}
                        {{-- @empty
                                <div class="w-full truncate text-slate-500 mt-0.5">No notification yet</div>
                        @endforelse --}}
                    </div>
                </div>
            </div>
    @endif
            <!-- END: Notifications -->
   {{-- @else --}}

   {{-- @endif --}}

    <!-- BEGIN: Account Menu -->
    <div class="intro-x dropdown w-8 h-8">
        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
            {!!GLOBAL_GENERATE_TOPBAR()!!}
        </div>
        <div class="dropdown-menu w-56">
            <ul class="dropdown-content bg-primary text-white">

               @if (Auth::check())
               <li class="p-2">
                    <div class="font-medium">@if(getLoggedUserInfo()) {{ getLoggedUserInfo()->firstname." ".getLoggedUserInfo()->lastname }} @else No data @endif</div>
                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500">{{ getLoggedUserPosition() }}</div>
                </li>
                <hr class="dropdown-divider border-white/[0.08]">
                <li>
                    <a href="{{ route('profile') }}" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> My Profile </a>
                </li>
               @else
                <li>
                    <a href="/login" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-left" class="w-4 h-4 mr-2"></i> Login </a>
                </li>
               @endif
                <!--
                <li>
                    <a href="/register" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Register </a>
                </li>


                <li>
                    <a href="{{url('')}}/user/profile?id=" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                </li>
                <li>
                    <a href="../" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                </li>
                <li>
                    <a href="../" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                </li>
                <li>
                    <a href="../" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                </li>
                -->

                @if (Auth::check())
                <li>
                    <hr class="dropdown-divider border-white/[0.08]">
                </li>
                <li>
                    <!--<a  href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>-->
                    <a  href="/logout" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
                @else

                @endif

            </ul>
        </div>
    </div>
    <!-- END: Account Menu -->
</div>


