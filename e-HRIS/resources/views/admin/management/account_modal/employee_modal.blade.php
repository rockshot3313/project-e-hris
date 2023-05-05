<!-- Add Documents Modal -->
<div id="employee_modal" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-content">
                <!-- BEGIN: Modal Header -->
                <div class="modal-header">
                    <h2 class="font-medium text-base mr-auto">Employee</h2>
                </div>
                <!-- END: Modal Header -->

                <!-- BEGIN: Modal Body -->

                <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                    <input hidden id="modal_update_emp_id" type="text" class="form-control" placeholder="id">

                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-1" class="form-label">Employee ID</label>
                        <select class="w-full"id="modal_employee_id">
                            <option data-ass-type="user" value="{{ generate_agancy_id() }}">{{ generate_agancy_id() }}</option>
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-2" class="form-label">Employment Type</label>
                        <input id="modal_employment_type" type="text" class="form-control" value="<?php echo ('yyyy-MM-dd')?>">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-1" class="form-label">Start Date</label>
                        <input id="modal_start_date" type="date" class="form-control" placeholder="Start Date">
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-2" class="form-label">End Date</label>
                        <input id="modal_end_date" type="date" class="form-control" placeholder="End Date">
                    </div>

                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-1" class="form-label">Designation</label>
                        <select class="w-full" id="modal_designation_id">
                            @forelse (load_designation('') as $designation)
                            <option value="{{ $designation->id }}">{{ $designation->userauthority }}</option>

                            @empty

                            @endforelse
                        </select>
                    </div>
                    <div class="col-span-12 sm:col-span-6">
                        <label for="modal-form-2" class="form-label">Posistion</label>
                        <select class="w-full"id="modal_position_id">
                            @forelse (load_position('') as $posistion)
                            <option value="{{ $posistion->id }}">{{ $posistion->emp_position }}</option>

                            @empty

                            @endforelse
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row">Office</label>
                        <select class="w-full"id="modal_rc_id">
                            @forelse (load_responsibility_center('') as $rc)
                            <option value="{{ $rc->responid }}">{{ $rc->centername }}</option>

                            @empty

                            @endforelse
                        </select>
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row">Salary</label>
                        <input id="modal_salary" type="number" class="form-control" placeholder="Salary" value="0000">
                        {{-- document.body.innerHTML = number.toLocaleString(); --}}
                    </div>

                    <div class="col-span-12 sm:col-span-12">
                        <label for="validation-form-6" class="form-label w-full flex flex-col sm:flex-row">Status</label>
                        <select class="w-full"id="modal_employee_status">
                            @forelse (load_status_codes('') as $sc)

                            <option value="{{ $sc->code }}">{{ $sc->name }}</option>

                            @empty

                            @endforelse
                        </select>
                    </div>


                </div>

                <!-- END: Modal Body -->

                <!-- BEGIN: Modal Footer -->
                <div class="modal-footer">
                    <button id="cancel_documents_btn" type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                    <a href="javascript:;" id="load_employee_save" class="btn btn-primary w-20 load_employee_save"> Save </a>

                </div>
                <!-- END: Modal Footer -->
            </div>
        </form>
    </div>
</div>
<!-- END: Modal Content -->
