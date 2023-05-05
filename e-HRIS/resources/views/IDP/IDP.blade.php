@extends('layouts.app')
@section('breadcrumb')
    {{ Breadcrumbs::render('Dashboard') }}
@endsection
@section('content')

<div class="mt-10">
        <div class="box p-5 rounded-md">
            <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5">
                <button  id="btn_idp" class="flex items-center ml-auto text-primary" data-tw-toggle="modal" data-tw-target="#create_idp_modal" > <i data-lucide="plus" class="w-4 h-4 mr-2"></i> Create IDP </button>
            </div>
            <div class="overflow-auto lg:overflow-visible -mt-3">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center whitespace-nowrap">Areas for Development</th>
                            <th class="text-center whitespace-nowrap">Development Needs</th>
                            <th class="text-center whitespace-nowrap">Activities that will Contribute to Goal Achievement</th>
                            <th class="text-center whitespace-nowrap">Timeline</th>
                            <th class="text-center whitespace-nowrap">Resources Need</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
</div>
<!-- END: Transaction Details -->
@include('IDP.idp_modal.create_idp')
</div>
@endsection
@section ('scripts')
<script src="{{ asset('js/IDP/idp.js') }}"></script>
@endsection

