@extends('layouts.app')

@section('content')

<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                    My Leave
                    </h2>
                    <a href="" class="ml-auto flex items-center text-primary"> <i data-lucide="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="check-circle" class="report-box__icon text-success"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Employees">View<i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6"> 14.560 days</div>
                                <div class="text-base text-slate-500 mt-1">Vacation</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="check-circle" class="report-box__icon text-success"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Incoming Leave">View<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6"> 34.837 days</div>
                                <div class="text-base text-slate-500 mt-1">Sick</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="check-circle" class="report-box__icon text-success"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Approved Leave">View<i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">3.000 days</div>
                                <div class="text-base text-slate-500 mt-1">Special Privilege Leave</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="check-circle" class="report-box__icon text-success"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Disapproved Leave">View<i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">4.000 days</div>
                                <div class="text-base text-slate-500 mt-1">Forced</div>
                            </div>
                        </div>
                    </div>
                </div>
 
            <!-- END: General Report -->



            
                
            <!-- BEGIN: Boxed Tab -->
            <div class="intro-y box mt-5">
                <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                    <h2 class="font-medium text-base mr-auto">
                    
                        <button href="javascript:;" data-tw-toggle="modal" data-tw-target="#apply_for_leave_modal" class="btn btn-sm btn-warning w-50 mr-1 mb-2 btn-right"><i class="fa fa-eye"></i>&nbsp VIEW FULL DETAILS OF MY LEAVE</button>
                    
                    </h2>

                    <button href="javascript:;" data-tw-toggle="modal" data-tw-target="#apply_for_leave_modal" class="btn btn-sm btn-primary w-24 mr-1 mb-2 btn-right">Apply leave</button>
                </div>
              
                <div id="boxed-tab" class="p-5">
                    <div class="preview">
                        <ul class="nav nav-boxed-tabs" role="tablist">
                           
                            <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3" aria-selected="true" >Submitted Leave Application</button>
                            </li>
                           
                            <li id="example-4-tab" class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4" type="button" role="tab" aria-controls="example-tab-4" aria-selected="false" >Supervisee Submitted Leave</button>
                            </li>

                            <li id="example-5-tab" class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-5" type="button" role="tab" aria-controls="example-tab-5" aria-selected="false" >My Trainings/Seminars Applied LC</button>
                            </li>

                            <li id="example-6-tab" class="nav-item flex-1" role="presentation">
                                <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-6" type="button" role="tab" aria-controls="example-tab-6" aria-selected="false" >Submitted Trainings/Seminar App.LC</button>
                            </li>


                        </ul>
                    
                        <div class="tab-content mt-5">

    {{--Start Submitted Leave Application table --}}

                            <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">        
                                <table class="table table-bordered table-striped" id="submitted_leave_application">
                                    <thead>
                                       <tr>
                                          <th>Type</th>
                                          <th>Where</th>
                                          <th>No. of Days</th>
                                          <th>Status</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                 </table>
                         
                            </div>
    {{--End  Submitted Leave Application table --}}


    {{-- Start Supervisee Submitted Leave Application--}}
                                 
                            <div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">   
                                <table class="table table-bordered table-striped" id="supervisee_submitted_leave_application"> 
                                    <thead>
                                       <tr>
                                          <th>Applied By</th>
                                          <th>Type</th>
                                          <th>Where</th>
                                          <th>No. of Days</th>
                                          <th>Date</th>
                                          <th>Action</th>
                                       </tr>
                                    </thead>
                                 </table>

                        </div>
    {{--End Supervisee Submitted Leave Application --}}

    {{-- Start Trainings/Seminar Application for Leave Credit table--}}
                                 
                   <div id="example-tab-5" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-5-tab">   
                    <table class="table table-bordered table-striped" id="mytraining_seminars_applied_for_credit"> 
                        <thead>
                           <tr> 
                              <th>Title</th>
                              <th>Date</th>
                              <th>No. of Hours</th>
                              <th>Status</th>
                              <th>Service Credit Added</th>
                              <th>HR Status</th>
                              <th>President Status</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                     </table>

            </div>
    {{-- End Trainings/Seminar Application for Leave Credit table --}}


    {{-- Start Submitted Trainings/Seminar Application for Leave Credit Table --}}

    <div id="example-tab-6" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-6-tab">   
        <table class="table table-bordered table-striped" id="mytraining_seminars_applied_for_credit"> 
            <thead>
               <tr> 
                  <th>Applied By</th>
                  <th>Title</th>
                  <th>Type</th>
                  <th>Date</th>
                  <th>No. of Hours</th>
                  <th>Action</th>
               </tr>
            </thead>
         </table>
    </div>

    {{--End Submitted Trainings/Seminar Application for Leave Credit --}}
    </div>
@include('leave.modal.apply_for_leave')    

@endsection

@section('scripts')
    <script src="../js/leave/submitted_leave.js"></script>
@endsection()