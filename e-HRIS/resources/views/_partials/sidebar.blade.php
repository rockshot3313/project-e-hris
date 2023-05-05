<nav class="side-nav">
<a href="/" class="intro-x flex items-center pl-5 pt-4">
{{--        <img alt="logo" class="w-10" src="{{ asset('dist/images/logo.png') }}">--}}
{{--        <img alt="logo" class="w-10" src="{{ asset('dist/images/qrdts_logo_1.png') }}">--}}

        @if (system_settings())
        @php
            $system_title = system_settings()->where('key','system_title')->first();
            $system_logo = system_settings()->where('key','agency_logo')->first();
        @endphp

        @if ($system_logo)
        <div class="w-10 h-10 rounded-full overflow-hidden shadow-lg image-fit zoom-in ml-5"><img alt="logo" src=" {{ asset('uploads/settings/'.$system_logo->image.'') }}"></div>

        @else
        <img alt="logo" class="w-10" src="">
        @endif

        @if ($system_title)
            <span class="text-white text-lg ml-3"> {{ $system_title->value }}</span>
        @else
            <span class="text-white text-lg ml-3"> N/A </span>
        @endif

        @else
        <img alt="logo" class="w-10" src="">
        <span class="text-white text-lg ml-3"> N/A </span>
        @endif


</a>
<div class="side-nav__devider my-6"></div>
<ul>
    <li>
        <a href="/home" class="side-menu side-menu--{{ (request()->is('home')) ? 'active' : '' }}">
            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
            <div class="side-menu__title">
                Dashboard
            </div>
        </a>
    </li>

    <div class="side-nav__devider my-6"></div>

    <li>
        <a href="/dashboard" class="side-menu side-menu--{{ (request()->is('dashboard')) ? 'active' : '' }}">
            <div class="side-menu__icon"> <i data-lucide="database"></i> </div>
            <div class="side-menu__title">
                Analytics
            </div>
        </a>
    </li>


    <li>
        <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('application/*')) ? 'active' : '' }}">
            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
            <div class="side-menu__title">
                Application
                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
            </div>
        </a>
        <ul class="side-menu__{{ (request()->is('application/*')) ? 'sub-open' : '' }}">
            <li>
                <a href="{{ route('application') }}" class="side-menu side-menu--{{ (request()->is('application/form')) ? 'active' : '' }}">
                    <i class="fa-solid fa-user-plus -mt-1"></i>
                    <div class="side-menu__title"> Application </div>
                </a>
            </li>
            <li>
                @if(Auth::check())
                <a href="{{ route('applicant_list') }}" class="side-menu side-menu--{{ (request()->is('application/list')) ? 'active' : '' }}">
                    <i class="fa-solid fa-list-ul -mt-1"></i>
{{--                        <i class="fa-solid fa-user-plus -mt-1"></i>--}}
                    <div class="side-menu__title"> Applicant List </div>
                </a>
                @endif
            </li>
        </ul>
    </li>


    @if(Auth::check())

        <!-- BEGIN: Admin -->
        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('admin/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="settings"></i> </div>
                <div class="side-menu__title">
                    Admin
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>

            <ul class="side-menu__{{ (request()->is('admin/*')) ? 'sub-open' : '' }}">
                <li>
                    <a href="/admin/ac" class="side-menu side-menu--{{ (request()->is('admin/ac')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Account Management</div>
                    </a>
                </li>
                <li>
                    <a href="/admin/rc" class="side-menu side-menu--{{ (request()->is('admin/rc')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Responsibility Center </div>
                    </a>
                </li>
                <li>
                    <a href="/admin/group" class="side-menu side-menu--{{ (request()->is('admin/group')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Groups </div>
                    </a>
                </li>
                <li>
                    <a href="/admin/user-privileges" class="side-menu side-menu--{{ (request()->is('admin/user-privileges')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> User Privileges </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('link_lists') }}" class="side-menu side-menu--{{ (request()->is('admin/link-list')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Link List </div>
                    </a>
                </li>

                <li>
                    <a href="{{ route('ss') }}" class="side-menu side-menu--{{ (request()->is('admin/ss')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> System Settings </div>
                    </a>
                </li>

            </ul>
        </li>
        <!-- END: Admin -->

        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('documents/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="files"></i> </div>
                <div class="side-menu__title">
                    Documents
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('documents/*')) ? 'sub-open' : '' }}">
                <li>
                    <a href="{{ route('scanner') }}" class="side-menu side-menu--{{ (request()->is('documents/scanner')) ? 'active' : '' }}">
                        <i class="fa fa-qrcode w-4 h-4"></i>
                        <div class="side-menu__title"> Document Scanner </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('my_documents') }}" class="side-menu side-menu--{{ (request()->is('documents/my-documents')) ? 'active' : '' }}">
                        <i class="icofont-document-folder"></i>
                        <div class="side-menu__title"> My Documents </div>
                        <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium myDocs_counter"></div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('incoming') }}" class="side-menu side-menu--{{ (request()->is('documents/incoming')) ? 'active' : '' }}">
                        <i class="icofont-inbox"></i>
                        <div class="side-menu__title"> Incoming </div>
                        <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium incoming_counter"></div>
                        {{--         @if (!count_incoming_documents()->count() == 0) {{ count_incoming_documents()->count() }} @endif               --}}
                    </a>
                </li>
                <li>
                    <a href="{{ route('received') }}" class="side-menu side-menu--{{ (request()->is('documents/received')) ? 'active' : '' }}">
                        <i class="icofont-archive"></i>
                        <div class="side-menu__title"> Received </div>
                        <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium"></div>
                        {{--         @if (!count_receive_documents()->count() == 0) {{ count_receive_documents()->count() }} @endif               --}}
                    </a>
                </li>
                <li>
                    <a href="{{ route('outgoing') }}" class="side-menu side-menu--{{ (request()->is('documents/outgoing')) ? 'active' : '' }}">
                        <i class="icofont-send-mail"></i>
                        <div class="side-menu__title"> Outgoing </div>
                        <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium"></div>
                        {{--                        @if (!countOutGoingDocuments(Auth::user()->employee)->count() == 0) {{ countOutGoingDocuments(Auth::user()->employee)->count() }} @endif--}}
                    </a>
                </li>
                <li>
                    <a href="{{ route('hold') }}" class="side-menu side-menu--{{ (request()->is('documents/hold')) ? 'active' : '' }}">
                        <i class="icofont-not-allowed"></i>
                        <div class="side-menu__title"> Hold </div>
                        <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium"></div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('returned') }}" class="side-menu side-menu--{{ (request()->is('documents/returned')) ? 'active' : '' }}">
                        <i class="icofont-warning-alt"></i>
                        <div class="side-menu__title"> Returned </div>
                        <div class="py-1 px-2 rounded-full text-xs text-white cursor-pointer font-medium"></div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('trash') }}" class="side-menu side-menu--{{ (request()->is('documents/trashBin')) ? 'active' : '' }}">
                        <i class="icofont-trash"></i>
                        <div class="side-menu__title"> Trash bin </div>
                        <div class="py-1 px-2 rounded-full text-xs text-white cursor-pointer font-medium"></div>
                    </a>
                </li>
            </ul>
        </li>

        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('dtr/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                <div class="side-menu__title">
                    DTR
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('dtr/*')) ? 'sub-open' : '' }}">
                <li>

                    <a href="{{ route('dtr_manage_bio') }}" class="side-menu side-menu--{{ (request()->is('manage/bio')) ? 'active' : '' }}">
                        <i class="fa-solid fa-star"></i>
                        <div class="side-menu__title">Manage Bio</div>
                    </a>

                </li>
            </ul>
        </li>

        <!-- BEGIN: Hiring -->
        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('hiring/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="user"></i></div>
                <div class="side-menu__title">
                    Hiring
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>

            <ul class="side-menu__{{ (request()->is('hiring/*')) ? 'sub-open' : '' }}">
                <li>
                    <a href="{{ route('index') }}" class="side-menu side-menu--{{ (request()->is('hiring/hire-position')) ? 'active' : '' }}">
                        <i data-lucide="book"></i>
                        <div class="side-menu__title"> Position Hiring </div>
                    </a>
                </li>
                <li>
                    <a href="/hiring/position-type" class="side-menu side-menu--{{ (request()->is('hiring/position-type')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Position Type </div>
                    </a>
                </li>
                <li>
                    <a href="{{ route('short_index') }}" class="side-menu side-menu--{{ (request()->is('hiring/applicant-short-listed')) ? 'active' : '' }}">
                        <i class="fa fa-people"></i>
                        <div class="side-menu__title"> Applicant short listed </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- END: Hiring -->


            <!-- START: Interview -->
            <li>
                <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('interview/*')) ? 'active' : '' }}">
                    <div class="side-menu__icon"><i data-lucide="coffee"></i></div>
                    <div class="side-menu__title">
                        Interview
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>

                <ul class="side-menu__{{ (request()->is('interview/*')) ? 'sub-open' : '' }}">
                    <li>
                        <a href="{{ route('criteria') }}" class="side-menu side-menu--{{ (request()->is('interview/criteria/view')) ? 'active' : '' }}">
                            <i data-lucide="percent"></i>
                            <div class="side-menu__title">Criteria</div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END: Interview -->

        <!-- BEGIN: Employment Testing -->
        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('testing/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="user"></i> </div>
                <div class="side-menu__title">
                    Employment Testing
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('testing/*')) ? 'sub-open' : '' }}">
                <li>
                    <a href="/testing/page" class="side-menu side-menu--{{ (request()->is('testing/page')) ? 'active' : '' }}">
                        <i class="fa-brands fa-etsy"></i>
                        <div class="side-menu__title"> Testing Exercise </div>
                    </a>
                </li>
                {{-- <li>
                    <a href="/rating/manage-rating-page" class="side-menu side-menu--{{ (request()->is('rating/manage-rating-page')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Rating </div>
                    </a>
                </li> --}}
            </ul>
        </li>
        <!-- END: Testing -->

        <!-- BEGIN: Rating -->
        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('rating/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="star"></i> </div>
                <div class="side-menu__title">
                    Rating
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('rating/*')) ? 'sub-open' : '' }}">
                <li>
                    <a href="/rating/criteria-page" class="side-menu side-menu--{{ (request()->is('rating/criteria-page')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Criteria </div>
                    </a>
                </li>
                <li>
                    <a href="/rating/manage-rating-page" class="side-menu side-menu--{{ (request()->is('rating/manage-rating-page')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Rating </div>
                    </a>
                </li>
                <li>
                    <a href="/rating/summary" class="side-menu side-menu--{{ (request()->is('rating/summary')) ? 'active' : '' }}">
                        <i data-feather="activity"></i>
                        <div class="side-menu__title"> Summary of Rating </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- END: Rating -->

        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('competency/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                <div class="side-menu__title">
                    Competency
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('competency/*')) ? 'sub-open' : '' }}">
                <li>

                    <a href="{{ route('competency') }}" class="side-menu side-menu--{{ (request()->is('competency/overview')) ? 'active' : '' }}">
                        <i class="fa-solid fa-star"></i>
                        <div class="side-menu__title">Overview</div>
                    </a>

                    <a href="{{ route('competency_dictionary') }}" class="side-menu side-menu--{{ (request()->is('competency/dictionary')) ? 'active' : '' }}">
                        <i class="fa-solid fa-bookmark"></i>
                        <div class="side-menu__title">Dictionary</div>
                    </a>

                    <a href="{{ route('competency_skills') }}" class="side-menu side-menu--{{ (request()->is('competency/skills')) ? 'active' : '' }}">
                        <i class="fa-solid fa-book"></i>
                        <div class="side-menu__title">Skills</div>
                    </a>

                    <a href="{{ route('competency_groups') }}" class="side-menu side-menu--{{ (request()->is('competency/groups')) ? 'active' : '' }}">
                        <i class="fa-solid fa-layer-group"></i>
                        <div class="side-menu__title">Groups</div>
                    </a>

                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('rr/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                <div class="side-menu__title">
                    Rewards
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('rr/*')) ? 'sub-open' : '' }}">
                <li>

                    <a href="{{ route('rr_rewards') }}" class="side-menu side-menu--{{ (request()->is('rr/overview')) ? 'active' : '' }}">
                        <i class="fa-solid fa-star"></i>
                        <div class="side-menu__title">Overview</div>
                    </a>

                    <a href="{{ route('rr_awards') }}" class="side-menu side-menu--{{ (request()->is('rr/awards')) ? 'active' : '' }}">
                        <i class="fa-solid fa-gift"></i>
                        <div class="side-menu__title">Awards</div>
                    </a>

                    <a href="{{ route('rr_events') }}" class="side-menu side-menu--{{ (request()->is('rr/events')) ? 'active' : '' }}">
                        <i class="fa-solid fa-calendar-days"></i>
                        <div class="side-menu__title">Events</div>
                    </a>

                </li>
            </ul>
        </li>


        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('travel/order*')) ? 'active' : '' }}">
                <div class="side-menu__icon"> <i data-lucide="plane"></i> </div>
                <div class="side-menu__title">
                    Travel Order
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>
            <ul class="side-menu__{{ (request()->is('travel/order*')) ? 'sub-open' : '' }}">

                <li>
                    <a href="{{ route('myto') }}" class="side-menu side-menu--{{ (request()->is('travel/order')) ? 'active' : '' }}">
                        <i class="fa fa-atlas"></i>
                        <div class="side-menu__title"> My Travel Order </div>
                        <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium myDocs_counter"></div>
                    </a>
                </li>


            </ul>
        </li>

            <!-- BEGIN: Payroll -->
            <li>
                <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('payroll/*')) ? 'active' : '' }}">
                    <div class="side-menu__icon"><i data-lucide="dollar-sign"></i></div>
                    <div class="side-menu__title">
                        Payroll
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>

                <ul class="side-menu__{{ (request()->is('payroll/*')) ? 'sub-open' : '' }}">

                    {{--Overtime--}}
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <i class="fa-solid fa-stopwatch"></i>
                            <div class="side-menu__title">
                                Overtime
                                <div class="side-menu__sub-icon "></div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{ route('overtime_setup') }}" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title">Setup
                                        <div class="side-menu__sub-icon "> <i data-lucide="settings"></i> </div>
                                    </div>

                                </a>
                            </li>

                            <li>
                                <a href="" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title">Assignment
                                        <div class="side-menu__sub-icon "> <i data-lucide="plus"></i> </div>
                                    </div>

                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--Night Differential--}}
                    <li>
                        <a href="{{ route('nightdiff_setup') }}" class="side-menu">
                            <i class="fa-solid fa-moon"></i>
                            <div class="side-menu__title">

                                Night Differential
                                <div class="side-menu__sub-icon "></div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="side-menu-light-wizard-layout-1.html" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title">Setup
                                        <div class="side-menu__sub-icon "> <i data-lucide="settings"></i> </div>
                                    </div>

                                </a>
                            </li>

                            <li>
                                <a href="side-menu-light-wizard-layout-1.html" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title">Assignment
                                        <div class="side-menu__sub-icon "> <i data-lucide="plus"></i> </div>
                                    </div>

                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--Holiday--}}
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <i class="fa-solid fa-calendar-day"></i>
                            <div class="side-menu__title">
                                Holiday
                                <div class="side-menu__sub-icon "></div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{ route('holiday_setup') }}" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title">Special
                                        <div class="side-menu__sub-icon "> <i data-lucide="heart"></i> </div>
                                    </div>

                                </a>
                            </li>

                            <li>
                                <a href="{{ route('holiday_setup') }}" class="side-menu">
                                    <div class="side-menu__icon"></div>
                                    <div class="side-menu__title">Legal
                                        <div class="side-menu__sub-icon "> <i data-lucide="briefcase"></i> </div>
                                    </div>

                                </a>
                            </li>
                        </ul>
                    </li>

                    {{--Tardiness--}}
                    <li>
                        <a href="" class="side-menu side-menu--{{ (request()->is('payroll/')) ? 'active' : '' }}">
                            <i class="fa-solid fa-thumbs-down"></i>
                            <div class="side-menu__title"> Tardiness </div>
                            <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium myDocs_counter"></div>
                        </a>
                    </li>
                </ul>
            </li>
            <!-- END: Payroll -->


            {{-- Leave Application --}}

            <!-- BEGIN: Payroll -->
            <li>
                <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('Leave*')) ? 'active' : '' }}">
                    <div class="side-menu__icon"><i data-lucide="file-search"></i></div>
                    <div class="side-menu__title">
                        Leave Application
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>


                <ul class="side-menu__{{ (request()->is('Leave/*')) ? 'sub-open' : '' }}">

                    {{--leave Dashboard--}}

                    <li>

                        <a href="{{ route('leave_dashboard') }}" class="side-menu side-menu--{{ (request()->is('Leave/Leave-Dashboard')) ? 'active' : '' }}">
                            <i class="fa-solid fa-gift"></i>
                            <div class="side-menu__title"> Leave Dashboard</div>
                        </a>
                    </li>

                    <li>
                    <a href="{{ route('my_leave_emp') }}" class="side-menu side-menu--{{ (request()->is('Leave/My-Leave-Dashboard')) ? 'active' : '' }}">
                            <i class="fa-solid fa-gift"></i>
                            <div class="side-menu__title">Leave Application</div>
                        </a>

                    </li>



                    {{--Employee Leave Details--}}
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <i class="fa fa-tasks"></i>
                            <div class="side-menu__title">

                            Leave Details

                                <div class="side-menu__sub-icon "></div>
                            </div>
                        </a>

                    </li>
                </ul>
            </li>

            {{-- End Leave Application --}}


            <li>
                <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('saln*')) ? 'active' : '' }}">
                    <div class="side-menu__icon"> <i data-lucide="clipboard"></i> </div>
                    <div class="side-menu__title">
                        SALN
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="side-menu__{{ (request()->is('saln*')) ? 'sub-open' : '' }}">

                    <li>
                        <a href="{{ route('mysaln') }}" class="side-menu side-menu--{{ (request()->is('saln')) ? 'active' : '' }}">
                            <i class="fa fa-atlas"></i>
                            <div class="side-menu__title"> My SALN </div>
                            <div class="py-1 px-2  rounded-full text-xs text-white cursor-pointer font-medium myDocs_counter"></div>
                        </a>
                    </li>


                </ul>
            </li>

            <!-- BEGIN: SCHEDULING -->
            <li>
                <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('schedule/*')) ? 'active' : '' }}">
                    <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                    <div class="side-menu__title">
                        Schedule
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="side-menu__{{ (request()->is('schedule/*')) ? 'sub-open' : '' }}">
                    <li>

                        <a href="{{ route('schedule') }}" class="side-menu side-menu--{{ (request()->is('schedule/')) ? 'active' : '' }}">
                            <i data-lucide="calendar"></i>
                            <div class="side-menu__title">My Schedule</div>
                        </a>

                    </li>
                </ul>
            </li>
            <!-- BEGIN: SCHEDULING -->
            <li>
                <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('payroll/*')) ? 'active' : '' }}">
                    <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                    <div class="side-menu__title">
                        Payroll v2
                        <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                    </div>
                </a>
                <ul class="side-menu__{{ (request()->is('payroll/*')) ? 'sub-open' : '' }}">
                    <li>

                        <a href="{{ route('payroll_mng') }}" class="side-menu side-menu--{{ (request()->is('payroll/')) ? 'active' : '' }}">
                            <i class="fa-solid fa-star"></i>
                            <div class="side-menu__title">Manage Payroll</div>
                        </a>

                    </li>
                    <li>

                        <a href="{{ route('payroll_set') }}" class="side-menu side-menu--{{ (request()->is('payroll/set/payroll')) ? 'active' : '' }}">
                            <i class="fa-solid fa-star"></i>
                            <div class="side-menu__title">Set Payroll</div>
                        </a>

                    </li>
                </ul>
            </li>

            <!-- BEGIN: IDP -->
        <li>
            <a href="javascript:;" class="side-menu side-menu--{{ (request()->is('idp/*')) ? 'active' : '' }}">
                <div class="side-menu__icon"><i data-lucide="user"></i></div>
                <div class="side-menu__title">
                    IDP
                    <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                </div>
            </a>

            <ul class="side-menu__{{ (request()->is('idp/*')) ? 'sub-open' : '' }}">
                <li>
                    <a href="{{ route('idp.view') }}" class="side-menu side-menu--{{ (request()->is('IDP/idp')) ? 'active' : '' }}">
                        <i data-lucide="book"></i>
                        <div class="side-menu__title"> IDP </div>
                    </a>
                </li>
            </ul>
        </li>
        <!-- END: IDP -->

    @endif
</ul>
</nav>
