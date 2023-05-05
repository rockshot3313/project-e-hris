@extends('layouts.app')



@section('content')
    <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">
            My Travel Order
        </h2>
        <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
            <button id="make_travel_order" class="btn btn-primary shadow-md mr-2" href="javascript:;" data-tw-toggle="modal" data-tw-target="#make_travel_order_modal">Make Travel Order</button>
            <a class='btn btn-info' href='{{url("travel/order/travelorder-export")}}'>Export Excel</a>
        </div>
    </div>
    <div class="intro-y box p-5 mt-5">

        <div class="overflow-x-auto scrollbar-hidden pb-10">
            <table id="dt__created_travel_order" class="table table-report -mt-2 table-hover">
                <thead>
                <tr>
                    <th style="display: none" class="text-center whitespace-nowrap ">#ID</th>
                    <th class="text-center whitespace-nowrap ">User</th>
                    <th class="text-center whitespace-nowrap ">Purpose</th>
                    <th class="text-center whitespace-nowrap ">Day(s)</th>
                    <th class="text-center whitespace-nowrap ">Departure Date</th>
                    <th class="text-center whitespace-nowrap ">Return Date</th>
                    <th class="text-center whitespace-nowrap ">Station</th>
                    <th class="text-center whitespace-nowrap ">Destination</th>
                    <th class="text-center whitespace-nowrap ">Action</th>
                </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
    @include('travelorder.modal.make_travel_order')
@endsection
@section('scripts')
<script src="{{ asset('/js/travelorder/travel_order.js') }}"></script>
@endsection

