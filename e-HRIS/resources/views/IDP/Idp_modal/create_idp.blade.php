
<!-- BEGIN: Modal Content -->
<div id="create_idp_modal" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <!-- BEGIN: Modal Header -->
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Select Employee</h2>
            </div> <!-- END: Modal Header -->
            <!-- BEGIN: Modal Body -->
            <div id="faq-accordion-2" class="w-auto accordion accordion-boxed">
                <div class="accordion-item">
                    <div id="faq-accordion-content-6" class="accordion-header"> <button class="accordion-button collapsed" type="button" data-tw-toggle="collapse" data-tw-target="#faq-accordion-collapse-6" aria-expanded="false" aria-controls="faq-accordion-collapse-6"> Employee Information </button> </div>
                    <div id="faq-accordion-collapse-6" class="accordion-collapse collapse" aria-labelledby="faq-accordion-content-6" data-tw-parent="#faq-accordion-2">
                        <div class=" grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6"> <label for="modal-form-1" class="font-semibold ">Employee Name:</label>
                                <div class="mt-2">
                                      <select id="emp_name" class="select2 " style="width: 100%" >
                                        @forelse(get_employee_idp(' ') as $get_employee)
                                        <option></option>
                                          <option value="{{ $get_employee->agencyid }}">{{ $get_employee->firstname.' ' .$get_employee->mi.' '.$get_employee->lastname }}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-6"> <label for="modal-form-2" class="font-semibold">Current Position</label>
                                <input id="modal-form-2" type="text" class="form-control mt-2" placeholder="example@gmail.com">
                            </div>
                            <div class="col-span-12 sm:col-span-6"> <label for="modal-form-3" class="font-semibold">Designation</label>
                                 <input id="modal-form-3" type="text" class="form-control mt-2" placeholder="Important Meeting">
                                </div>
                            <div class="col-span-12 sm:col-span-6"> <label for="modal-form-4" class="font-semibold">Year/s in the Agency</label>
                                <input id="modal-form-4" type="text" class="form-control mt-2" placeholder="Job, Work, Documentation">
                            </div>
                            <div class="col-span-12 sm:col-span-6"> <label for="modal-form-5" class="font-semibold">Department</label>
                                <input id="modal-form-5" type="text" class="form-control mt-2" placeholder="Job, Work, Documentation">
                            </div>
                            <div class="col-span-12 sm:col-span-6"> <label for="modal-form-6" class="font-semibold">Department Head</label>
                                <select id="modal-form-6" class="form-select mt-2">
                                    <option>10</option>
                                    <option>25</option>
                                    <option>35</option>
                                    <option>50</option>
                                </select> </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer"> <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button> <button type="button" class="btn btn-primary w-20">Send</button> </div> <!-- END: Modal Footer -->
        </div>
    </div>
</div> <!-- END: Modal Content -->
