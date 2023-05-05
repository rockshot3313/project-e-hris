@extends('layouts.app')

@section('content')


<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 2xl:col-span-9">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">
                     Leave Dashboard
                    </h2>
                    <a href="javascript:;" data-tw-toggle="modal" data-tw-target="#apply_for_leave_modal"  class="ml-auto flex items-center text-primary"> <i class="fa fa-grid" class="w-4 h-4 mr-3"></i>Apply Leave </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="user" class="report-box__icon text-primary"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Employees">View<i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $tblemployee_count }}</div>
                                <div class="text-base text-slate-500 mt-1">Employees</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="message-circle" class="report-box__icon text-pending"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Incoming Leave">View<i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">3.721</div>
                                <div class="text-base text-slate-500 mt-1">Incoming</div>
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
                                <div class="text-3xl font-medium leading-8 mt-6">2.149</div>
                                <div class="text-base text-slate-500 mt-1">Approved</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-lucide="slash" class="report-box__icon text-danger"></i> 
                                    <div class="ml-auto">
                                        <div class="report-box__indicator bg-success tooltip cursor-pointer" title="View Disapproved Leave">View<i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">152.040</div>
                                <div class="text-base text-slate-500 mt-1">Disapproved</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            
 
            <!-- END: General Report -->
     
       
                
            <!-- BEGIN: Boxed Tab -->
                <div class="intro-y box mt-5">
                    <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">
                            Employee Leave Details
                        </h2>
                    </div>
                  
                    <div id="boxed-tab" class="p-5">
                        <div class="preview">
                            <ul class="nav nav-boxed-tabs" role="tablist">
                                <li id="example-3-tab" class="nav-item flex-1" role="presentation">
                                    <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#example-tab-3" type="button" role="tab" aria-controls="example-tab-3" aria-selected="true" >Employee Leave Details </button>
                                </li>
                                <li id="example-4-tab" class="nav-item flex-1" role="presentation">
                                    <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#example-tab-4" type="button" role="tab" aria-controls="example-tab-4" aria-selected="false" >List of Leave Type</button>
                                </li>
                            </ul>
                        
                            <div class="tab-content mt-5">

                    {{-- Employee Leave details Table --}}
    
                                <div id="example-tab-3" class="tab-pane leading-relaxed active" role="tabpanel" aria-labelledby="example-3-tab">        
                                    <i class="fa fa-users"></i> &nbsp LIST OF EMPLOYEES QUALIFIED FOR LEAVE <p style="text-align:right;">
                                    <button href="javascript:;" data-tw-toggle="modal" data-tw-target="#apply_for_leave_modal" class="btn btn-sm btn-primary w-30 mr-1 mb-2 text-right">Set Employee Leave</button>
                                    </p>

                                    <table class="table table-bordered table-striped" id="employee_leave_Details">
                                        <thead>
                                           <tr>
                                              <th>&nbsp &nbsp &nbsp Employee's Name</th>
                                              <th>Gender</th>
                                              <th>Position</th>
                                              <th>Designation</th>
                                              <th>Available Leave</th>
                                              <th>Action</th>
                                           </tr>
                                        </thead>
                                     </table>
                             
                                </div>
                     {{-- End Employee Leave details Table --}}


                    {{-- List of Leave Type Table --}}
                                     
                                <div id="example-tab-4" class="tab-pane leading-relaxed" role="tabpanel" aria-labelledby="example-4-tab">   
                                    <table class="table table-bordered table-striped" id="list_of_leave_type"> 
                                        <thead>
                                           <tr> <button href="javascript:;" data-tw-toggle="modal" data-tw-target="#add_newleave_type_modal" class="btn btn-sm btn-primary w-24 mr-1 mb-2">Add New</button>
                                              <th>Type Name</th>
                                              <th>Category</th>
                                              <th>Qualified Gender</th>
                                              <th>Number of Leave</th>
                                              <th>Leave Category Type</th>
                                              <th>Action</th>
                                           </tr>
                                        </thead>
                                     </table>

                            </div>
                    {{-- End List of Leave Type Table --}}

                        </div>
                        
                    </div>
                </div>
                <!-- END: Boxed Tab -->
           
@include('leave.modal.addnewleavetype')
@include('leave.modal.edit_leave_type_modal')   
@include('leave.modal.apply_for_leave')
@include('leave.modal.set_employee_leave')             
@endsection 

@section('scripts')
    <script src="../js/leave/leave_module.js"></script>
    <script src="../js/leave/submitted_leave.js"></script>
@endsection()

