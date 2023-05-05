@extends('layouts.app')

@section('content')
<div class="intro-y flex items-center mt-8">
    <h2 class="text-lg font-medium mr-auto">
        Create Payroll
    </h2>
</div>
<div class="grid grid-cols-12 gap-6 mt-5">
    <div class="intro-y col-span-6 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="intro-y box p-5">
            <div>
                <label for="pr_groupname" class="form-label">Group Name</label>
                <input id="pr_groupname" type="text" class="form-control w-full" placeholder="">
            </div>

            <div class="mt-3">
                <label for="pr_date_desc" class="form-label">Date Description</label>
                <input id="pr_date_desc" type="text" class="form-control w-full" placeholder="">
            </div>


            <div class="mt-3">
                <label class="form-label">Month & Year</label>
                <div class="sm:grid grid-cols-2 gap-2">
                    <div class="input-group mt-2 sm:mt-0">
                        <div id="input-group-4" class="input-group-text">Month</div>
                           <select  class="form-control" aria-describedby="input-group-4" data-placeholder="Select your favorite actors" class="tom-select w-full">
                               <option value="1">January</option>
                               <option value="2">February</option>
                               <option value="3">March</option>
                               <option value="4">April</option>
                               <option value="5">May</option>
                               <option value="6">June</option>
                               <option value="7">July</option>
                               <option value="8">August</option>
                               <option value="9">September</option>
                               <option value="10">October</option>
                               <option value="11">November</option>
                               <option value="12">December</option>
                           </select>

                    </div>
                    <div class="input-group mt-2 sm:mt-0">
                        <div id="input-group-5" class="input-group-text">Year</div>
                        <input type="text" class="form-control" placeholder="20xx" aria-describedby="input-group-5">
                    </div>
                </div>
            </div>



        </div>
        <!-- END: Form Layout -->
    </div>
    <div class="intro-y col-span-6 lg:col-span-6">
        <!-- BEGIN: Form Layout -->
        <div class="report-box-2 intro-y">
            <div class="box sm:flex">
                <div class="px-8 py-12 flex flex-col justify-center flex-1">
                    <i data-lucide="shopping-bag" class="w-10 h-10 text-warning"></i>
                    <div class="relative text-3xl font-medium mt-12 pl-4 ml-0.5"> <span class="absolute text-2xl font-medium top-0 left-0 -ml-0.5">$</span> 54.143 </div>
                    <div class="report-box-2__indicator bg-success tooltip cursor-pointer" title="47% Higher than last month"> 47% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                    <div class="mt-4 text-slate-500">Sales earnings this month after associated author fees, & before taxes.</div>
                    <button class="btn btn-outline-secondary relative justify-start rounded-full mt-12">
                        Download Reports
                        <span class="w-8 h-8 absolute flex justify-center items-center bg-primary text-white rounded-full right-0 top-0 bottom-0 my-auto ml-auto mr-0.5"> <i data-lucide="arrow-right" class="w-4 h-4"></i> </span>
                    </button>
                </div>
                <div class="px-8 py-12 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                    <div class="text-slate-500 text-xs">TOTAL TRANSACTION</div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base">4.501</div>
                        <div class="text-danger flex text-xs font-medium tooltip cursor-pointer ml-2" title="2% Lower than last month"> 2% <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                    </div>
                    <div class="text-slate-500 text-xs mt-5">CANCELATION CASE</div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base">2</div>
                        <div class="text-danger flex text-xs font-medium tooltip cursor-pointer ml-2" title="0.1% Lower than last month"> 0.1% <i data-lucide="chevron-down" class="w-4 h-4 ml-0.5"></i> </div>
                    </div>
                    <div class="text-slate-500 text-xs mt-5">GROSS RENTAL VALUE</div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base">$72.000</div>
                        <div class="text-success flex text-xs font-medium tooltip cursor-pointer ml-2" title="49% Higher than last month"> 49% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                    </div>
                    <div class="text-slate-500 text-xs mt-5">GROSS RENTAL PROFIT</div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base">$54.000</div>
                        <div class="text-success flex text-xs font-medium tooltip cursor-pointer ml-2" title="52% Higher than last month"> 52% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                    </div>
                    <div class="text-slate-500 text-xs mt-5">NEW USERS</div>
                    <div class="mt-1.5 flex items-center">
                        <div class="text-base">2.500</div>
                        <div class="text-success flex text-xs font-medium tooltip cursor-pointer ml-2" title="52% Higher than last month"> 52% <i data-lucide="chevron-up" class="w-4 h-4 ml-0.5"></i> </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Form Layout -->
    </div>
    <div class="cursor-pointer shadow-md fixed bottom-0 right-0 box flex items-center justify-center z-50 mb-10 mr-10">
        <div class="flex items-center px-5 py-8 sm:py-3 border-t border-slate-200/60 dark:border-darkmode-400">
            <a href="javascript:;" id="save_PDS_to_db" class="ml-auto btn btn-primary truncate flex items-center"> <i class="w-4 h-4 mr-2" data-lucide="save"></i> Save </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script src="{{BASEPATH()}}/js/payroll/payroll.js{{GET_RES_TIMESTAMP()}}"></script>
@endsection()
