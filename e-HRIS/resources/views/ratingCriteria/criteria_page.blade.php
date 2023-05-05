@extends('layouts.app')
@section('breadcrumb')
    {{ Breadcrumbs::render('Dashboard') }}
@endsection
@section('content')

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Manage Criteria
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <button class="btn btn-primary shadow-md mr-2 addCriteria" data-tw-toggle="modal" data-tw-target="#addCriteria_modal">Add Criteria</button>

    </div>
</div>
<div class="intro-y flex flex-col sm:flex-row items-center mt-5">

    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 mr-auto">
        <button id="refresh" class="btn btn-secondary mr-2">Refresh<i class="fa-solid fa-arrows-rotate text-success"></i> </button>

    </div>

    <select class="form-control" id="positioncritPage" name="positioncrit" class="select2 w-full">
        <option selected></option>
        @foreach ($positionCategories as $positionCategory) 
            

            <option value="{{ $positionCategory->id }}">{{ $positionCategory->positiontype }}</option>

           
        @endforeach
    </select>

</div>

<div class="intro-y box p-5 mt-5">
   
    <div id="tbl_criteria_div" class="overflow-x-auto scrollbar-hidden pb-10">
        <h1 class="text-center text-lg text-secondary my-5">Loading...</h1>
    </div>
</div>

    @include('ratingCriteria.rating_modal.addCriteria_modal')
    @include('ratingCriteria.rating_modal.addAreas_modal')
@endsection
@section('scripts')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script  src="{{ asset('/js/rating/rating.js') }}"></script>
    
@endsection