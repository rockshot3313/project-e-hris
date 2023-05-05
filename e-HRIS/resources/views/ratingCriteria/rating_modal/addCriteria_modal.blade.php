<!-- BEGIN: Modal Content -->
<div id="addCriteria_modal" class="modal" tabindex="-1" aria-hidden="true" data-tw-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 id="addAndUpdate_header" class="font-bold text-base mr-auto">Add Criteria</h2>
                <div class="dropdown sm:hidden"> <a class="dropdown-toggle w-5 h-5 block" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="more-horizontal" class="w-5 h-5 text-slate-500"></i> </a>
                    <div class="dropdown-menu w-40">
                        <ul class="dropdown-content">
                            <li> <a href="javascript:;" class="dropdown-item"> <i data-lucide="file" class="w-4 h-4 mr-2"></i> Download Docs </a> </li>
                        </ul>
                    </div>
                </div>
            </div> <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->

            

            <form id="addCriteriaForm" action="#" enctype="multipart/form-data">
            <div class="modal-body px-5 py-10">
                <div>


                     <input id="critID" name="critID" type="hidden">
                        <div class="mb-5">
                            <div class="mt-2"> 
                                <label for="applicable_to"> Position </label>
                                <select id="position_cat" name="position_cat" class="select2 w-full">
                                    <option></option>
                                    @foreach ($positionCategories as $positionCategory)
                  
                                    <option value="{{ $positionCategory->id }}">{{ $positionCategory->positiontype }}</option>
                                   
                                    @endforeach
                                </select> 
                            </div>
                            {{-- <input id="applicable" type="text" name="applicable" class="form-control" placeholder="Applicable to"> --}}
                        </div>

                        <div class="mb-5">
                            <label for="criteria"> Rating Criteria </label>
                        <input id="criteria" type="text" name="criteria" class="form-control" placeholder="Type Criteria">
                        </div>

                        <div class="mb-5">
                            <label for="maxrate"> Maximum Rate</label>
                            <input id="maxrate" type="text" name="maxrate" class="form-control" placeholder="Maximum Rate">
                        </div>
                    
                </div>
            </div>
                <!-- END: Modal Body -->

            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer">
                <button type="submit" id="btn_cancel" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button id="add_criteria_btn" type="button" href="javascript:;" class="btn btn-primary w-20">Save</button>
            </div>
            <!-- END: Modal Footer -->
        </form>
        </div>
    </div>
</div>  <!-- END: Modal Content -->


