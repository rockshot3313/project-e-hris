<div id="update_profile_picture_mdl" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="form_profile_picture" method="post" enctype="multipart/form-data">
            @csrf
            <div class="modal-header">
                <h2 class="font-medium text-base mr-auto">Update your profile picture</h2>
            </div>

            <div class="modal-body p-0">
                <div class="intro-y col-span-12 sm:col-span-6 2xl:col-span-4">
                    <div class="box">

                        <input id="current_profile_picture_value" name="current_profile_picture_value" class="hidden">

                        <div class="p-5">
                            <div id="update_profile_holder" class="h-40 2xl:h-56 image-fit rounded-md overflow-hidden before:block before:absolute before:w-full before:h-full before:top-0 before:left-0 before:z-10 before:bg-gradient-to-t before:from-black before:to-black/10">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="p-5">
                        <label for="validation-form-2" class="form-label w-full flex flex-col sm:flex-row"> Upload profile picture <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-slate-500">Maximum of 5 MB</span> </label>
                        <input id="up_profile_pic"
                               type="file"
                               class="filepond mt-1"
                               name="up_profile_pic[]"
                        >
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                <button id="btn_save_profile_pic" type="submit" class="btn btn-primary w-20">Update</button>
            </div>
        </form>
    </div>
</div>
