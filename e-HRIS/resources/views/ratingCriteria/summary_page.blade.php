@extends('layouts.app')
@section('breadcrumb')
    {{ Breadcrumbs::render('Dashboard') }}
@endsection
@section('content')

<div class="intro-y flex flex-col sm:flex-row items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Applicant Rating Summary
    </h2>
    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
        <a  target="_blank" href="/rating/print-summary" class="btn btn-primary shadow-md mr-2">Print</a>

    </div>
</div>

<form id="saveRate_form" enctype="multipart/form-data">
    @csrf


    <div class="intro-y flex flex-col sm:flex-row items-center mt-4">
        <div class="w-full mr-2">
            <label for="position">Position Category:</label>
            <select id="pos_cat" name="pos_cat" class="select2 form-control ">
                <option selected></option>
                <option value="all" selected>All</option>
                @foreach (get_position_type() as $post_type)

                    <option value="{{ $post_type->id }}">{{ $post_type->positiontype }}</option>

                @endforeach

            </select>

        </div>
        <div id="positionApplied_div" class="w-full ml-2">


        </div>


    </div>


    <div class="intro-y box p-5 mt-5 form-control">

        <div id="summary_div">
            {{-- <table id="summary_table" class="table table-report -mt-2 table-bordered">
                <thead>
                <tr>
                    <th>
                        Applicant Name:
                    </th>
                    @foreach ( $ratedApplicant as $ratedApplicants)
                        @foreach ( $ratedApplicants->get_applicant as $ratedApplicantname)
                            <th class="text-center whitespace-nowrap">{{ $ratedApplicantname->lastname }}, {{$ratedApplicantname->firstname}} {{ $ratedApplicantname->mi }}</th>
                        @endforeach
                    @endforeach
                </tr>
                <tr>
                    <th>
                        Applied Position:
                    </th>
                    @foreach ( $ratedApplicant as $ratedApplicants)
                        @foreach ( $ratedApplicants->get_position as $ratedApplicant_position)
                            <th class="text-center whitespace-nowrap">{{ $ratedApplicant_position->emp_position }}</th>
                        @endforeach
                    @endforeach
                </tr>
                </thead>
                <tbody>

                        @foreach ( $criteria as $criterias)

                                <tr>
                                    <td> {{ $criterias->creteria }}</td>

                                    <td></td>
                                </tr>


                        @endforeach



                </tbody>
            </table> --}}
        </div>
        {{-- <div id="remarks_div">
            <label class="tesx-bold">Remarks</label>
            <textarea class="form-control preserveLines" name="remarks" id="remarks" cols="70%" rows="3" required></textarea>
            <div class="intro-y flex flex-col sm:flex-row items-center mt-3">

                <div class="mr-auto">

                </div>
                    <button id="saveRate_btn" type="submit" class="btn btn-primary w-20 mr-1">Save</button>
            </div>

        </div> --}}


        </div>

    </div>

</form>
@include('ratingCriteria.rating_modal.summary_modal_detail')
@include('ratingCriteria.rating_modal.raterStatus')
{{--
    @include('ratingCriteria.rating_modal.addCriteria_modal')
    @include('ratingCriteria.rating_modal.editCriteria_modal') --}}
@endsection
@section('scripts')
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> --}}
<script  src="{{ asset('/js/rating/summary.js') }}"></script>

@endsection
