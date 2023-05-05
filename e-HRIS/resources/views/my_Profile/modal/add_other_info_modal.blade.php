<div id="add_other_info_mdl" data-tw-backdrop="static" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Other Information</h2>
            </div>

            <div class="modal-body p-0">

                <div class="p-5 grid grid-cols-12 gap-6">

                    <div class="input-form col-span-12 lg:col-span-12">
                        <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Special Skills and Hobbies </label>
                        <input id="others_skills" type="text" style="text-transform:uppercase" name="others_skills" class="form-control" placeholder="Special Skills and Hobbies" minlength="2" required autocomplete="off">
                    </div>

                    <div class="input-form col-span-12 lg:col-span-12">
                        <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Non-Academic Distinctions/Recognition <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">(Write in full)</span> </label>
                        <input id="others_distinction" type="text" style="text-transform:uppercase" name="others_distinction" class="form-control" placeholder="Non-Academic Distinctions/Recognition" minlength="2" required autocomplete="off">
                    </div>

                    <div class="input-form col-span-12 lg:col-span-12">
                        <label for="validation-form-1" class="form-label w-full flex flex-col sm:flex-row"> Membership in Association/Organization  </label>
                        <input id="others_membership" type="text" style="text-transform:uppercase" name="others_membership" class="form-control" placeholder="Membership in Association/Organization" minlength="2" required autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button id="save_other_info" type="submit" class="btn btn-primary w-20">Add</button>

            </div>
        </div>
    </div>
</div>
