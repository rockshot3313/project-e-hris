// Register the plugin
FilePond.registerPlugin(
    // validates the size of the file

    // FilePondPluginImagePreview,
    FilePondPluginFileValidateSize,
    FilePondPluginFileValidateType,

);

const update_profile_pic_inputElement = document.querySelector('input[id="up_profile_pic"]');

const update_profile_pic_pond = FilePond.create((update_profile_pic_inputElement),
    {
        credits: false,
        allowMultiple: false,
        allowFileTypeValidation: true,
        acceptedFileTypes: ['image/*'],

});

update_profile_pic_pond.setOptions({
    server: {
        process: "/my/temp/profile/upload",
        revert: "/my/temp/profile/delete",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
    },
});

function remove_Update_UploadedProfile_pic() {
    if (update_profile_pic_pond) {
        var files = update_profile_pic_pond.getFiles();
        if (files.length > 0) {
            update_profile_pic_pond.processFiles().then(() => {
                update_profile_pic_pond.removeFiles();
                // console.log('Removed');
            });
        }
    }
}

function save_profile_picture(){

    $('#form_profile_picture').submit(function (event){
        event.preventDefault();

        var form = $(this);

        $.ajax({
            type: "POST",
            url: bpath + 'my/save/profile/picture',
            data: form.serialize(),
            success: function (response) {

                if(response.status == 200)
                {
                    __notif_show(1, "Success", "Profile picture updated successfully!");

                    load_profile_picture();
                    remove_Update_UploadedProfile_pic();

                    const modal = tailwind.Modal.getOrCreateInstance(document.querySelector('#update_profile_picture_mdl'));
                    modal.hide();

                } else {

                    __notif_show(-1, "Warning", "OOps! Something went wrong!");
                }
            }
        });
    });

}
