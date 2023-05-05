@extends('layouts.app')
@section('breadcrumb')
    {{ Breadcrumbs::render('Dashboard') }}
@endsection

@section('content')
    <div class="mt-4">
        <div> <label for="modal-form-1" class="form-label font-medium">Filter Status</label>
            <div >
                <select id="filter" class="w-40 h-9 font-extrabold">
                    <option></option>
                    <option value="10">Waiting</option>
                    <option value="11">Approved</option>
                </select>
            </div>
        </div>
    </div>

<div class="intro-y box p-5 mt-5">
    <div id = "short_listed_table" class="overflow-x-auto scrollbar-hidden pb-10">

    </div>
</div>


@include('applicant_short_listed.modal.applicant_info')
@endsection

@section('scripts')
<script src="{{ asset('js/short_listed/short_listed.js') }}"></script>
@endsection
