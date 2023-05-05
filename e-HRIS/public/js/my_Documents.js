var  _token = $('meta[name="csrf-token"]').attr('content');
var tbl_data_createdDocs;
var tbl_data_emplList;
var tbl_data_groupList;
var tbl_data_rcList;
var values = [];
var is_sortable;
var pondFiles;
var array_rcID = [];
var array_groupID = [];
var track_number = "";
var rc_modal_docs_type;
var rc_modal_docs_type1;
var checked_Box_Value;
var markEndTrail_Value;
var sendDocs_modal_user_list;
var sendDocs_modal_user_list2;
var sendDocs_modal_group_list;
var sendDocs_modal_rc_list;
var checkedBox_ShowAuthorName;
var error_counter;
var is_markEndTrail = document.getElementById("btn__modalEndTrail");
var is_sendToAll = document.getElementById("btn_sendToAll")
var is_showAuthor = document.getElementById("checkBox_shoAuthor");
var checkbox_sendToAll = document.querySelector("input[name=btn_sendToAll]");
var ul = document.getElementById("track_table");
var timeout = null;

$(document).ready(function (){

    bpath = __basepath + "/";

    //Insert New Document Function
    insert_newDocuments();

    //Initialize all My Documents DataTables
    load_createdDocsDataTable();

    //Populate Created Documents DataTables
    load_createdDocs();

    //Update function for created documents
    update_createDocs();

    //Delete function for created documents
    softDelete_CreatedDocs();

    //Populate Employee List DataTables
    load_empList();

    //Populate Group List DataTables
    //load_groupList();

    //Populate RC List DataTables
    load_rcList();

    //Fast Send Documents
    FastSend_Documents();

    //Trail Send Documents
    TrailSend_Documents();

    //Delete Temporary uploaded Files if canceled
    deleteIfCanceled();

    //Select2 Input Validator
    select2_input_validator();

    //Select2 On Change Handler
    select2_on_change_handler();

});

$('.groupList li[data-name]').click(function (){
    $('#btn_userORgroup').show();
    $('#input_holder').text($(this).data('name'));
    switchButtonLabel();
});

function switchButtonLabel() {
    var label = $('#input_holder').text();

    if (label === 'Group/s')
    {
        $('#btn_Group').show();
        $('#btn_User').hide();
    }else if (label === 'Employee/s'){
        $('#btn_User').show();
        $('#btn_Group').hide();
    }
}

//Set Document Type value after each clicked
$('#document_type_submitted').change(function() {

    if ($(this).val() === '1') {
       $('#documentAttachment').show();
        $(this).val("1");

    }else if($(this).val() === '2')
    {
        $('#documentAttachment').hide();
        $(this).val("2");

    }else if($(this).val() === '3')
    {
        $('#documentAttachment').show();
        $(this).val("3");
        // document.getElementById("add_documents_btn").disabled = true;
    }
});

//Initialize all My Documents DataTables
function load_createdDocsDataTable(){
    try{
        /***/
        tbl_data_createdDocs = $('#dt__createdDocs').DataTable({
            dom:
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-6 text_left_1'l><'intro-y col-span-6 text_left_1'f>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'tr>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'<'datatable_paging_1'p>>>",
            renderer: 'bootstrap',
            "info": false,
            "bInfo":true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bPaginate" : true,
            "aLengthMenu": [[10,25,50,100,150,200,250,300,-1], [10,25,50,100,150,200,250,300,"All"]],
            "iDisplayLength": 10,
            "aaSorting": [],

            columnDefs:
                [
                    { className: "dt-head-center", targets: [ 3, 7 ] },
                ],
        });

        tbl_data_emplList = $('#dt__employeeList').DataTable({
            dom:
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-6 text_left_1'l><'intro-y col-span-6 text_left_1'f>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'tr>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'<'datatable_paging_1'p>>>",
            renderer: 'bootstrap',
            "info": false,
            "bInfo":true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bPaginate" : true,
            "aLengthMenu": [[5,25,50,100,150,200,250,300,-1], [5,25,50,100,150,200,250,300,"All"]],
            "iDisplayLength": 5,
            "aaSorting": [],

            columnDefs:
                [
                    { className: "dt-head-center", targets: [ 2 ] },
                ],
        });

        tbl_data_groupList = $('#dt__groupList').DataTable({
            dom:
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-6 text_left_1'l><'intro-y col-span-6 text_left_1'f>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'tr>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'<'datatable_paging_1'p>>>",
            renderer: 'bootstrap',
            "info": false,
            "bInfo":true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bPaginate" : true,
            "aLengthMenu": [[5,25,50,100,150,200,250,300,-1], [5,25,50,100,150,200,250,300,"All"]],
            "iDisplayLength": 5,
            "aaSorting": [],

            columnDefs:
                [
                    { className: "dt-head-center", targets: [ 2 ] },
                ],
        });

        tbl_data_rcList = $('#dt__rcList').DataTable({
            dom:
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-6 text_left_1'l><'intro-y col-span-6 text_left_1'f>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'tr>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'<'datatable_paging_1'p>>>",
            renderer: 'bootstrap',
            "info": false,
            "bInfo":true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bPaginate" : true,
            "aLengthMenu": [[5,25,50,100,150,200,250,300,-1], [5,25,50,100,150,200,250,300,"All"]],
            "iDisplayLength": 5,
            "aaSorting": [],

            columnDefs:
                [
                    { className: "dt-head-center", targets: [ 4 ] },
                ],
        });

         sendDocs_modal_group_list = $('.select2-multiple').select2({
             placeholder: "",
             allowClear: true,
             closeOnSelect: false,});

         sendDocs_modal_rc_list = $('.select2-multiple').select2({
             placeholder: "",
             allowClear: true,
             closeOnSelect: false,});

        sendDocs_modal_user_list = $('.select2-multiple').select2({
            placeholder: "",
            allowClear: true,
            closeOnSelect: false,
        });

        sendDocs_modal_user_list2 = $('.select2-multiple-new').select2({
            placeholder: "",
            allowClear: true,
            closeOnSelect: false,
            width: "100%",
        });

        /***/
    }catch(err){  }
}

//Populate Created Documents DataTables
function load_createdDocs() {

    $.ajax({
        url: bpath + 'documents/created-docs/load',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(data) {

            tbl_data_createdDocs.clear().draw();
            /***/
            var data = JSON.parse(data);
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/
                    var send_Button = '';
                    var edit_Button = '';
                    var mark_Button = '';
                    var delete_Button = '';
                    var createdDoc_id = data[i]['id'];
                    var track_number = data[i]['track_number'];
                    var name = data[i]['name'];
                    var desc = data[i]['desc'];
                    var type = data[i]['type'];
                    var status = data[i]['status'];
                    var status_class = data[i]['class'];
                    var level = data[i]['level'];
                    var type_submitted = data[i]['type_submitted'];
                    var base_url = window.location.origin;
                    var total_recipients = data[i]['recipients'];

                    var level_class = data[i]['level_class'];

                    var tool_tip_title = '';
                    var message_icon = '';

                    if (type_submitted === "Both")
                    {
                        type_submitted = "Hard Copy, Soft Copy";
                    }

                    if(status === "Completed") {
                        //Forward Button
                        send_Button += "<a id='btn_fowardDocs' href='javascript:;' class='w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip ' data-tw-toggle='modal' data-tw-target='#forward_Docs' title='Forward' data-trk-no='"+track_number+"'> <i class='fa fa-share-square text-success'></i> </a>";

                        //disable Edit
                        // edit_Button += "<a id='btn_updateCreatedDocs' href='javascript:;' data-doc-desc='"+desc+"' data-doc-name='"+name+"' class='dropdown-item' data-trk-no='"+track_number+"'> <i class='fa fa-edit w-4 h-4 mr-2 text-success'></i> Edit </a>";
                        edit_Button = '';

                        //disable Edit
                        delete_Button = '';

                        //Change Status
                        mark_Button += "<a id='btn_markAsComplete' href='javascript:;' data-doc-desc='"+desc+"' data-doc-name='"+name+"' class='dropdown-item' data-trk-no='"+track_number+"'> <i class='fa fa-check-square w-4 h-4 mr-2 text-success'></i> Change Status </a>";


                    }

                    else if(status === "Outgoing") {
                        send_Button += "<a id='btn_fowardDocs' href='javascript:;' class='w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip ' data-tw-toggle='modal' data-tw-target='#forward_Docs' title='Forward' data-trk-no='"+track_number+"'> <i class='fa fa-share-square text-success'></i> </a>";

                        mark_Button += "<a id='btn_markAsComplete' href='javascript:;' data-doc-desc='"+desc+"' data-doc-name='"+name+"' class='dropdown-item' data-trk-no='"+track_number+"'> <i class='fa fa-check-square w-4 h-4 mr-2 text-success'></i> Change Status </a>";

                    }

                    else {
                        //Send Button
                        send_Button += "<a id='btn_sendDocs' href='javascript:;' class='w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip' data-tw-toggle='modal' data-tw-target='#send_CreatedDocs' title='Send' data-trk-no='"+track_number+"'> <i class='fa fa-paper-plane text-success'></i> </a>";

                        //enable Edit
                        edit_Button += "<a id='btn_updateCreatedDocs' href='javascript:;' data-doc-desc='"+desc+"' data-doc-name='"+name+"' class='dropdown-item' data-trk-no='"+track_number+"' data-tw-toggle='modal' data-tw-target='#update_CreatedDocs'> <i class='fa fa-edit w-4 h-4 mr-2 text-success'></i> Edit </a>";

                        //Change Status
                        mark_Button += "<a id='btn_markAsComplete' href='javascript:;' data-doc-desc='"+desc+"' data-doc-name='"+name+"' class='dropdown-item' data-trk-no='"+track_number+"'> <i class='fa fa-check-square w-4 h-4 mr-2 text-success'></i> Change Status </a>";

                        //enable Delete
                        delete_Button += "<a id='btn_deleteDocs' href='javascript:;' data-doc-desc='"+desc+"' data-doc-name='"+name+"' class='dropdown-item' data-trk-no='"+track_number+"'> <i class='fa fa-trash-alt w-4 h-4 mr-2 text-danger'></i> Delete </a>"

                    }

                    if (desc)
                    {
                        message_icon = 'fa-solid fa-circle-info text-primary';
                        tool_tip_title = 'Has a Document Description';

                    }else
                    {
                        message_icon = 'fa-solid fa-circle-info text-secondary';
                        tool_tip_title = 'No Document Description';
                    }

                    var cd = "";
                    /***/

                    cd = '' +
                        '<tr class="intro-x">' +

                                '<td style="display: none" class="createdDoc_id">' +
                                    createdDoc_id+
                                '</td>' +

                                '<td style="display: none" class="track_number">' +
                                    track_number+
                                '</td>' +

                                '<td><a id="track_document" data-track-number="'+track_number+'" href="'+base_url+'/track/doctrack/'+track_number+'" target="_blank" class="underline decoration-dotted whitespace-nowrap">#'+
                                    track_number+'</a>'+
                                '</td>' +

                                '<td class="name swal_name_tbl" data-status-class="'+status_class+'" data-trk-number="'+track_number+'" data-trk-name="'+name+'" data-doc-status="'+status+'" data-total-recipients="'+total_recipients+'">' +
                                '<a data-trk-name="'+name+'" href="javascript:;">'+
                                    name.substr(0, 20)+
                                '</a>'+

                                '</td>' +

                                '<td class="desc flex items-center justify-center">' +
                                    '<a id="btn_open_my_message" href="javascript:;" data-trk-no="'+track_number+'" data-doc-message="'+desc+'" class="tooltip" title="'+tool_tip_title+'"> <div class="flex items-center whitespace-nowrap "><i class="w-5 h-5 pt-3 pb-3 '+message_icon+'"></i></div></a>' +
                                '</td>' +

                                '<td >'+
                                        '<div class="whitespace-nowrap type">'+type+'</div>'+
                                        '<div class="text-slate-500 text-xs whitespace-nowrap text-'+level_class+' mt-0.5 level">'+level+'</div>'+
                                '</td>' +

                                '<td class="status">'+

                                    '<div class="flex items-center whitespace-nowrap text-'+status_class+'"><div class="w-2 h-2 bg-'+status_class+' rounded-full mr-3"></div>'+status+'</div>' +

                                '</td>' +

                                '<td class="type_submitted">' +

                                            '<a id="btn_viewAttachments" href="javascript:;" data-trk-no="'+track_number+'"> <div class="flex items-center whitespace-nowrap "><i class="fa fa-folder w-4 h-4 mr-2 text-'+status_class+'"></i>'+type_submitted+'</div></a>' +
                                '</td>' +

                                '<td>' +
                                    '<div class="flex justify-center items-center">'+
                                        send_Button+
                                        '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">'+
                                            '<a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>'+
                                            '<div class="dropdown-menu w-40">'+
                                                '<div class="dropdown-content">'+
                                                    edit_Button +
                                                    '<a id="btn_showDetails" href="javascript:;" class="dropdown-item" data-trk-no="'+track_number+'"> <i class="fa fa-tasks w-4 h-4 mr-2 text-success"></i> Details </a>'+
                                                    mark_Button +
                                                    delete_Button +
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</td>' +

                        '</tr>' +
                        '';

                    tbl_data_createdDocs.row.add($(cd)).draw();
                    /***/
                }

                // $(".tooltip").tooltips();
            }
        }
    });
}

//Select2 On Change Handler
function select2_on_change_handler() {

    $('#document_type').on('select2:select', function (e) {
        // Do something
        $('#document_type').select2({
            theme: "default"
        });
    });

    $('#document_level').on('select2:select', function (e) {
        // Do something
        $('#document_level').select2({
            theme: "default"
        });
    });

    $('#document_pub_pri_file').on('select2:select', function (e) {
        // Do something
        $('#document_pub_pri_file').select2({
            theme: "default"
        });
    });
}

//Select2 Validator
function select2_input_validator() {

    let validation;

    let get_document_copy_type = $('#document_type_submitted').val();
    let get_document_type = $('#document_type').val();
    let get_document_level = $('#document_level').val();
    let private_public_file = $('#document_pub_pri_file').val();

    if (get_document_copy_type.trim() == "")
    {
        validation = false;
    }else
    {
        validation = true;
    }

    if (get_document_type.trim() == "")
    {
        validation = false;
        $('#document_type').select2({
            theme: "error",
            placeholder: "Document Type is required",
        });

    }else
    {
        validation = true;
        $('#document_type').select2({
            theme: "default"
        });
    }

    if (get_document_level.trim() == "")
    {
        validation = false;
        $('#document_level').select2({
            theme: "error",
            placeholder: "Document Level is required",
        });
    }else
    {
        validation = true;
        $('#document_level').select2({
            theme: "default"
        });
    }

    if (private_public_file.trim() == "")
    {
        validation = false;
        $('#document_pub_pri_file').select2({
            theme: "error",
            placeholder: "Document Display Type is required",
        });

    }else
    {
        validation = true;
        $('#document_pub_pri_file').select2({
            theme: "default"
        });
    }

    return validation;
}

// Step 1.) Insert New Document Function
function insert_newDocuments() {

    $('#form_createDocs').submit(function (event){
        event.preventDefault();

        let form = $(this);
        let size = 0;

        var files = pond.getFiles();
        let fileLength = files.length;
        var document_file_name = [];
        var document_folder = [];
        var _default_folder = '';
        var folder_name = '';
        var folder = '';
        var file_name = '';
        var form_data = {};

        //Loop Uploaded Document Attachments
        $.each(files, function (i, val) {
            _default_folder = val.serverId
            file_name = val.filename

            folder = _default_folder.split("<");
            folder_name = folder[0];

            document_file_name.push(file_name);
            document_folder.push(folder_name);
        });

        form_data = {
            _token:_token,
            document_type_submitted : $('#document_type_submitted').val(),
            document_title: $('#document_title').val(),
            message: $('#message').val(),
            document_type: $('#document_type').val(),
            document_level: $('#document_level').val(),
            document_pub_pri_file: $('#document_pub_pri_file').val(),
            document_file_name, document_folder,
        }

        let getDocCopyType = $('#document_type_submitted').val();

        // if (getDocCopyType == 1) {
        //
        //     //if Document was Soft Copy
        //     validate_File_Uploaded(size, files, fileLength, form_data);
        //
        // }else if (getDocCopyType == 3){
        //
        //     //if Document was Both Soft Copy and Hard Copy
        //     validate_File_Uploaded(size, files, fileLength, form_data);
        //
        // }
        // else{
        //
        //     //if Document was Hard Copy
        //     uploadFilesToDB(form_data);
        //
        // }

       if(select2_input_validator())
       {
           if (getDocCopyType == 1) {

               //if Document was Soft Copy
               validate_File_Uploaded(size, files, fileLength, form_data);

           }else if (getDocCopyType == 3){

               //if Document was Both Soft Copy and Hard Copy
               validate_File_Uploaded(size, files, fileLength, form_data);

           }
           else{

               //if Document was Hard Copy
               uploadFilesToDB(form_data);

           }
           // console.log('validation passed');
           // __notif_show(1, 'Success', 'validation passed');
       }else
       {
           console.log('validation failed');
           __notif_show(-1, 'Warning', 'Please fill-up all input fields provided.');
           // console.log(files);
       }

    });
}

//Step 2.) Validate uploaded files, Validate file size
function   validate_File_Uploaded(size, files, fileLength, form_data){
    if (fileLength > 0) {

        var getFileTotalSize = files[0].fileSize;

        $.each(files, function (key, file){
            size += getFileTotalSize;
        });

        var finalSizeValue = convertToHumanFileSize(size);

        pond.processFiles().then(() => {

            //if Size is less than or equal to 25mb

            if (size <= 26214400 )
            {
                uploadFilesToDB(form_data);

            }else {
                __notif_show(-3, "File too Large", "File size uploaded: "+finalSizeValue);
            }
        });

    }else {
        __notif_show(-2, "File Missing!!", "Missing Attachments!");
    }
}

//Step 3.) Upload created files to Database if pass for validation
function   uploadFilesToDB(form_data) {

    $.ajax({
        type: "POST",
        url: bpath + 'documents/docs-insert',
        data: form_data,
        success:function (response) {
            if (response.status === 200)
            {
                __notif_load_data(__basepath + "/");
                const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#create_document'));
                mdl.hide();

                load_createdDocs();
                $('#create_document').find('input').val("");
                $('#message').val("");
                removeUploadedFiles();
                $('#documentAttachment').show();

                $('.myDocs_counter').load(location.href+' .myDocs_counter');
                select2_clear_input_fields();
            }else {
                __notif_load_data(__basepath + "/");
            }
        }
    });
}

//Delete Temporary uploaded Files if canceled
function deleteIfCanceled(){
    $("body").on('click', '#cancel_documents_btn', function (){

        let files = pond.getFiles();
        let doc_folder_name = '';
        let trim_folder = '';
        let doc_final_folder_name = '';
        let array_doc_folder = [];

        $.each(files, function (i, val)
        {
            doc_folder_name = val.serverId

            trim_folder = doc_folder_name.split("<");
            doc_final_folder_name = trim_folder[0];

            array_doc_folder.push(doc_final_folder_name);
        });


        $('#documentAttachment').show();

        select2_clear_input_fields();

            // console.log(documentFolder);

        $.ajax({
            url: bpath + 'documents/tmp-delete-canceled',
            type: "POST",
            data: {
                array_doc_folder:array_doc_folder,
                _token:_token
            },
            success: function(data) {
                removeUploadedFiles();
            }
        });

    });
}

//Clear Select-2 Single input fields
function select2_clear_input_fields() {
    $('#document_type').val(null).trigger('change');
    $('#document_level').val(null).trigger('change');
    $('#document_pub_pri_file').val(null).trigger('change');
    // $('#document_type_submitted').val(null).trigger('change');
    $('#document_title').val(null).trigger('change');;
    $('#message').val(null).trigger('change');;
}

//Update function for created documents
function update_createDocs() {
    $("body").on('click', '#btn_updateCreatedDocs', function (e){

        var _this = $(this).closest('tr');
        let docID = $(this).data('trk-no');
        let docName = $(this).data('doc-name');
        let message = $(this).data('doc-desc');

        $('#up_document_ID').val(docID);
        $('#up_document_title').val(docName);
        $('#up_message').val(message);

    });

    $('#form_updateCreatedDocs').submit(function (e){
        e.preventDefault();

        var form = $(this);

        let docID = $('#up_document_ID').val();
        let docName = $('#up_document_title').val();
        let docMessage = $('#up_message').val();
        let docType = $('#up_document_type').val();
        let docTypeSubmitted = $('#up_document_type_submitted').val();
        let docLevel = $('#up_document_level').val();

        $.ajax({
            url: bpath + 'documents/docs-update',
            type: "POST",
            data: {
                _token:_token,
                docID:docID,
                docName:docName,
                docMessage:docMessage,
                docType:docType,
                docTypeSubmitted:docTypeSubmitted,
                docLevel:docLevel,
            },
            success: function(data) {
                __notif_load_data(__basepath + "/");
                const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#update_CreatedDocs'));
                mdl.hide();
                load_createdDocs();
                $('#update_CreatedDocs').find('input').val("");
            }
        });
    });
}

//Delete function for created documents
function softDelete_CreatedDocs(){
    $("body").on('click', '#btn_deleteDocs', function (e) {
        e.preventDefault();

        var docID = $(this).data('trk-no');

        swal({
            container: 'my-swal',
            title: 'Are you sure?',
            text: "File will be deleted, but can be found in trash bin !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value === true) {
                swal("Deleted!", "Document type has been deleted.", "success");

                var tablename = $(this).closest('table').DataTable();
                tablename
                        .row($(this)
                        .parents('tr'))
                        .remove()
                        .draw();

                $.ajax({
                    url: bpath + 'documents/docs-delete',
                    type: "POST",
                    data: {
                        _token: _token,
                        docID: docID,
                    },
                    success:function (data)
                    {
                        __notif_load_data(__basepath + "/");
                        load_createdDocs();
                    },
                    cache: false,
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal("Cancelled", "Your file is safe :)", "error");
            }
        });
    });
}

//Populate Employee List DataTables
function load_empList() {
    $.ajax({
        url: bpath + 'documents/employee-list/load',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(data) {

            tbl_data_emplList.clear().draw();
            /***/
            var data = JSON.parse(data);
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/

                    var agencyid = data[i]['agencyid'];
                    var lastname = data[i]['lastname'];
                    var firstname = data[i]['firstname'];
                    var midname = data[i]['mi'];

                    var mi = midname.substring(0,1);

                    if (mi)
                    {
                        var fullname = lastname+", "+firstname+" "+mi+".";
                    }else {
                        var fullname = lastname+", "+firstname+" "+mi;
                    }


                    var cd = "";
                    /***/

                    cd = '' +
                        '<tr >' +

                        '<td class="agencyid">' + agencyid + '</td>' +

                        '<td class="fullname">' +
                            fullname+
                        '</td>' +

                        '<td class="w-auto">' +
                        '<div class="flex justify-center items-center">'+
                        '<button id="btn_addEmpTracks" type="button" class="flex items-center btn btn-outline-secondary"><i class="fa fa-user-plus text-success"></i></button>'+
                        '</div>'+
                        '</td>' +

                        '</tr>' +
                        '';

                    tbl_data_emplList.row.add($(cd)).draw();
                    /***/
                }
            }
        }
    });
}

//Populate Group List DataTables
function load_groupList() {
    $.ajax({
        url: bpath + 'documents/group-list/load',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(data) {

            tbl_data_groupList.clear().draw();
            /***/
            var data = JSON.parse(data);
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/

                    var groupID = data[i]['id'];
                    var group_name = data[i]['group_name'];
                    var lastname = data[i]['lastname'];
                    var firstname = data[i]['firstname'];

                    var midname = data[i]['midname'];

                    var mi = midname.substring(0,1);

                    if (mi)
                    {
                        var fullname = lastname+", "+firstname+" "+mi+".";
                    }else {
                        var fullname = lastname+", "+firstname+" "+mi;
                    }


                    var cd = "";
                    /***/

                    cd = '' +
                        '<tr >' +

                        '<td class="groupID hidden">' + groupID + '</td>' +

                        '<td class="group_name">' + group_name + '</td>' +

                        '<td class="fullname">' +
                        fullname+
                        '</td>' +

                        '<td class="w-auto">' +
                        '<div class="flex justify-center items-center">'+
                        '<button id="btn_addGroupTracks" type="button" class="flex items-center btn btn-outline-secondary"><i class="fa fa-user-plus text-success"></i></button>'+
                        '</div>'+
                        '</td>' +

                        '</tr>' +
                        '';

                    tbl_data_groupList.row.add($(cd)).draw();
                    /***/
                }
            }
        }
    });
}

//Populate RC List DataTables
function load_rcList() {
    $.ajax({
        url: bpath + 'documents/rc-list/load',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(data) {

            tbl_data_rcList.clear().draw();
            /***/
            var data = JSON.parse(data);

            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/
                    var responid = data[i]['responid'];
                    var centername = data[i]['centername'];
                    var department = data[i]['department'];
                    var descriptions = data[i]['descriptions'];
                    var head = data[i]['head'];
                    var head_name = data[i]['head_name'];

                    var cd = "";
                    /***/

                    cd = '' +
                        '<tr >' +

                        '<td style="display: none" class="rc_id">' +
                        responid+
                        '</td>' +

                        '<td>' +
                        centername+
                        '</td>' +

                        '<td>' +
                        descriptions+
                        '</td>' +

                        '<td>' +
                        department+
                        '</td>' +

                        '<td>' +
                        head_name+
                        '</td>' +

                        '<td class="w-auto">' +
                        '<div class="flex justify-center items-center">'+
                        '<button id="btn_addRCTracks" type="button" class="flex items-center btn btn-outline-secondary" data-rc-name="'+centername+'" data-rc-id="'+responid+'"><i class="fa fa-user-plus text-success"></i></button>'+
                        '</div>'+
                        '</td>' +

                        '</tr>' +
                        '';

                    tbl_data_rcList.row.add($(cd)).draw();

                    /***/
                }
            }
        }
    });
}

//Open Message
$("body").on('click', '#btn_open_my_message', function (){

    let document_message = $(this).data('doc-message');

    if (document_message != null)
    {
        swal({
            type: 'info',
            title: 'Document Description',
            // text: document_message,
            html:
                '<div class="intro-y p-5">'+
                    '<div class="flex text-slate-500 border-t border-slate-200/60 dark:border-darkmode-400 pb-3 mb-3"></div>'+
                        '<div class="text-justify mb-4">'+document_message+'</div>'+
                '<div class="flex text-slate-500 border-t border-slate-200/60 dark:border-darkmode-400 pb-3 mb-3"></div>'+
                '</div>',
        });
    }else
    {
        swal({
            type: 'warning',
            title: 'Document Message',
            html:
                '<div class="intro-y p-5">'+
                    '<div class="flex text-slate-500 border-t border-slate-200/60 dark:border-darkmode-400 pb-3 mb-3"></div>'+
                    '<div class="text-justify  mb-4">Document has no message attached!</div>'+
                    '<div class="flex text-slate-500 border-t border-slate-200/60 dark:border-darkmode-400 pb-3 mb-3"></div>'+
                '</div>',
        });
    }
});

//Send Button click
$("body").on('click', '#btn_sendDocs', function (){

    let docID = $(this).data('trk-no');
    $('#send_DocCode').val(docID);

});

//Button Create Documents On-CLick
$("body").on('click', '#create_documents', function (){

    $('#document_type').select2({
        placeholder: "Select Document Type"
    });

    $('#document_level').select2({
        placeholder: "Select Document Level"
    });

    $('#document_pub_pri_file').select2({
        placeholder: "Select Document Display Type"
    });

    $('#document_type_submitted').select2({
        // placeholder: "Select Document Copy Type"
    });

});

//Button Add Employee's to Trail Send
$("body").on('click', '#btn_addEmpTracks', function (){

    var _this = $(this).closest('tr');
    let agencyid = _this.find('.agencyid').text();
    let fullname = _this.find('.fullname').text();
    $('#send_toUser').show();
    $('#div__track_list').show();

    var addTrack = '<li id="myList" data-position="" data-id="'+agencyid+'">' +
        '<a href="#" class="form-control grid grid-cols-2 mt-2 p-2">'+
        '<div class="flex items-center">'+ fullname +'</div>'+
        '<div class="flex justify-end">' +
        '<button id="removeTracks" type="button" class="flex items-center btn btn-outline-secondary"><i class="fa fa-user-minus text-danger"></i></button>'+
        '</div>'+
        '</li>'+
        '</a>'

    $('#track_table').append(addTrack);

    var tablename = $(this).closest('table').DataTable();
    tablename
            .row($(this)
            .parents('tr'))
            .remove()
            .draw();

    values.push(agencyid);
    console.log(values);
});

//Button Remove Employee's to Trail Send
$("body").on('click', '#removeTracks', function (){
    var userID_index = $(this).closest("li").attr("data-id").split(":");
    var that = this;

    values.splice(userID_index, 1);
    $(that).closest("li").remove();

    if(values.length === 0)
    {
        $('#div__track_list').hide();
    }
    console.log(values);
});

//Button Add Group's to Trail Send
$("body").on('click', '#btn_addGroupTracks', function (){

    var _this = $(this).closest('tr');
    let groupID = _this.find('.groupID').text();
    let groupIndex = groupID+"-groupID";
    let group_name = _this.find('.group_name').text();
    $('#send_toGroup').show();
    $('#div__track_list').show();

    var addTrack = '<li id="mygroupList" data-grp-index="'+groupIndex+'" data-position="" data-grp-id="'+groupID+'">' +
        '<a href="#" class="form-control grid grid-cols-2 mt-2 p-2">'+
        '<div class="flex items-center">'+ group_name +'</div>'+
        '<div class="flex justify-end">' +
        '<button id="removeGroupTracks" type="button" class="flex items-center btn btn-outline-secondary" data-grp-id="'+groupID+'"><i class="fa fa-minus text-danger"></i></button>'+
        '</div>'+
        '</li>'+
        '</a>'

    $('#track_table').append(addTrack);

    var tablename = $(this).closest('table').DataTable();
    tablename
            .row($(this)
            .parents('tr'))
            .remove()
            .draw();

    array_groupID.push(groupIndex);
    console.log(array_groupID);
});

//Button Remove Group's to Trail Send
$("body").on('click', '#removeGroupTracks', function (){

    var groupID_index = $(this).closest("li").attr("data-grp-index").split(":");
    var that = this;

    array_groupID.splice(groupID_index, 1);

    $(that).closest("li").remove();

    if(array_groupID.length === 0)
    {
        $('#div__track_list').hide();
    }
    console.log(array_groupID);
});

//Button Add RC's to Trail Send
$("body").on('click', '#btn_addRCTracks', function (){

    let rcID = $(this).data('rc-id');
    let rcName = $(this).data('rc-name');
    let rcIndex = rcID+"-rcID";

    $('#div__track_list').show();

    var addTrack = '<li id="myrcList" data-rc-index="'+rcIndex+'" data-position="" data-rc-id="'+rcID+'">' +
        '<a href="#" class="form-control grid grid-cols-2 mt-2 p-2">'+
        '<div class="flex items-center">'+ rcName +'</div>'+
        '<div class="flex justify-end">' +
        '<button id="removeRCTracks" type="button" class="flex items-center btn btn-outline-secondary"><i class="fa fa-minus text-danger"></i></button>'+
        '</div>'+
        '</li>'+
        '</a>'

    $('#track_table').append(addTrack);

    var tablename = $(this).closest('table').DataTable();
    tablename
            .row($(this)
            .parents('tr'))
            .remove()
            .draw();

    array_rcID.push(rcIndex);
    console.log(array_rcID);
});

//Button Remove RC's to Trail Send
$("body").on('click', '#removeRCTracks', function (){

    var rcID_index = $(this).closest("li").attr("data-rc-index").split(":");
    var that = this;

    array_rcID.splice(rcID_index, 1);
    $(that).closest("li").remove();

    if(array_rcID.length === 0)
    {
        $('#div__track_list').hide();
        $('#div__modalEndTrail').hide();
    }
    console.log(array_rcID);
});

//Radio Button for Add Employee's Trail Send
$("body").on('click', '#radioBtn_emps', function (){
    $('#btn__openModalEmpList').show();
    $('#btn__openModalGroupList').hide();
    $('#btn__openModalRCList').hide();
    values = [];
    array_rcID = [];
    array_groupID = [];
    $('#track_table').empty();
    $('#div__track_list').hide();
    $('#div__modalEndTrail').hide();
    load_empList();
});

//Radio Button for Add Group's Trail Send
$("body").on('click', '#radioBtn_groups', function (){
    $('#btn__openModalGroupList').show();
    $('#btn__openModalEmpList').hide();
    $('#btn__openModalRCList').hide();
    values = [];
    array_rcID = [];
    array_groupID = [];
    $('#track_table').empty();
    $('#div__track_list').hide();
    $('#div__modalEndTrail').hide();
    load_groupList();
});

//Radio Button for Add RC's Trail Send
$("body").on('click', '#radioBtn_rc', function (){
    $('#btn__openModalRCList').show();
    $('#btn__openModalEmpList').hide();
    $('#btn__openModalGroupList').hide();
    values = [];
    array_rcID = [];
    array_groupID = [];
    $('#track_table').empty();
    $('#div__track_list').hide();
    $('#div__modalEndTrail').hide();
    load_rcList();
});

//Button for Opening Modal Employee's List
$("body").on('click', '#btn__openModalEmpList', function (){
    $('#div__modalEndTrail').show();
    $(is_markEndTrail).prop('checked', false);
    is_sortable = false;

});

//Button for Opening Modal Group's List
$("body").on('click', '#btn__openModalGroupList', function (){
    $('#div__modalEndTrail').show();
    $(is_markEndTrail).prop('checked', false);
});

//Button for Opening Modal RC's List
$("body").on('click', '#btn__openModalRCList', function (){
    $('#div__modalEndTrail').show();
    $(is_markEndTrail).prop('checked', false);
});

//Tab for Opening Trail Send
$("body").on('click', '#modal_rd_tab_trail_send', function (){
    $('#btn_TrailRelease').show();
    $('#btn_FastRelease').hide();
    sendDocs_modal_user_list.val(null).trigger('change');
    sendDocs_modal_group_list.val(null).trigger('change');
    sendDocs_modal_rc_list.val(null).trigger('change');
});

//Tab for Opening Fast Send
$("body").on('click', '#modal_rd_tab_fast_send', function (){
    $('#btn_FastRelease').show();
    $('#btn_TrailRelease').hide();
    sendDocs_modal_user_list.val(null).trigger('change');
    sendDocs_modal_group_list.val(null).trigger('change');
    sendDocs_modal_rc_list.val(null).trigger('change');
});

//For Testing Purpose Only!
$("body").on('click', '#btn_Test', function (){
    // docDetails();
    console.log(values, array_rcID, array_groupID);
});

// //Track Documents
// $("body").on('click', '#track_document', function (){
//
//     let track_number = $(this).data('track-number');
//     load_document_recipients(track_number);
// });

//Sortable List for Trail Send
$(function() {
    $( "#track_table" ).sortable({

        update:function (event, ui)
        {
            $(this).children().each(function (index)
            {
                $(this).attr('data-position', (index+1)).addClass('updated');
            });

            if ($('#radioBtn_emps').is(":checked")){
                saveEmpsTrackOrder();
            } else if($('#radioBtn_groups').is(":checked"))
            {
                saveGroupsTrackOrder();
            } else if($('#radioBtn_rc').is(":checked"))
            {
                saveRCTrackOrder();
            }
        }
    });
});

//Save Track Order for Employee's
function saveEmpsTrackOrder() {
    values = [];
    $('.updated').each(function (){
        values.push([$(this).attr('data-id')]);
        $(this).removeClass('updated');
    });
    is_sortable = true;
    console.log(values);
}

//Save Track Order for Group's
function saveGroupsTrackOrder() {
    array_groupID = [];
    $('.updated').each(function (){
        array_groupID.push([$(this).attr("data-grp-index")]);
        $(this).removeClass('updated');
    });
    // console.log(array_groupID);
}

//Save Track Order for RC's
function saveRCTrackOrder() {
    array_rcID = [];
    $('.updated').each(function (){
        array_rcID.push([$(this).attr("data-rc-index")]);
        $(this).removeClass('updated');
    });
    // console.log(array_rcID);
}

//Fast Send Documents
function FastSend_Documents() {
    $('#form_sendCreatedDocs').submit(function (event){
       event.preventDefault();

       $data = [];
       var selectedGroup = document.getElementById("grp_List").selectedIndex;
       var selectedRC = document.getElementById("rc__list").selectedIndex;
       var senderID = $('#doc_sendAs').find(":selected").val();

       is_checkSendToAll();
       is_checkShowAuthorName();

       let docID = $('#send_DocCode').val();
       let release_date = $('#release_date').val();
       let receive_date = $('#receive_date').val();
       let employee = $('#emp_List').val();
       let groups = $('#grp_List').val();
       let RC = $('#rc__list').val();

       var ass_from_type = $('#doc_sendAs').find(":selected").attr('data-ass-type');
       let note = $('#send_doc_note').val();


        $.ajax({
            type: "POST",
            url: bpath + 'documents/docs-fast-send',
            data: {
                _token: _token,
                data:values,
                docID:docID,
                note:note,
                release_date:release_date,
                receive_date:receive_date,
                employee:employee,
                groups:groups,
                RC:RC,
                sendToAll:checked_Box_Value,
                showAuthor:checkedBox_ShowAuthorName,
                senderID:senderID,
                __from:ass_from_type,
            },
            success:function (response) {

                if (response.status === 200)
                {
                    //update Document Status
                    $.ajax({
                        type: "POST",
                        url: bpath + 'documents/docs-updateDocStats',
                        data: {
                            _token: _token,
                            docID:docID,
                        },
                        success:function (response) {

                            __notif_load_data(__basepath + "/");
                            const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#send_CreatedDocs'));
                            mdl.hide();

                            docDetails(docID);
                            $('#send_toUser').hide();

                            $('#btn_sendToAll').prop("checked", false);
                            $('#checkBox_shoAuthor').prop("checked", false);
                            showFastSendDiv();
                            sendDocs_modal_user_list.val(null).trigger('change');
                            sendDocs_modal_group_list.val(null).trigger('change');
                            sendDocs_modal_rc_list.val(null).trigger('change');

                            $('.__notification').load(location.href+' .__notification');
                            $('.incoming_counter').load(location.href+' .incoming_counter');

                            load_createdDocs();
                        }
                    });
                }else {
                    __notif_load_data(__basepath + "/");
                }
            }
        });
    });
}

//Trail Send Documents
function TrailSend_Documents(){
    $("body").on('click', '#btn_TrailRelease', function (){

        var senderID = $('#doc_sendAs').find(":selected").val();

        isMarkEndOfTrail();

        let docID = $('#send_DocCode').val();
        let receive_date = $('#receive_date').val();

        var ass_from_type = $('#doc_sendAs').find(":selected").attr('data-ass-type');
        let note = $('#send_note').val();
        let expected_receive_date = $('#expected_receive_date').val();
        let expected_release_date = $('#expected_release_date').val();


        $.ajax({
            type: "POST",
            url: bpath + 'documents/docs-trail-send',
            data: {
                _token: _token,
                docID:docID,
                note:note,
                receive_date:receive_date,
                sendToEmps:values,
                is_sortable:is_sortable,
                sendToGroups:array_groupID,
                sendToRC:array_rcID,
                endTrail:markEndTrail_Value,
                senderID:senderID,
                __from:ass_from_type,
                expected_receive_date:expected_receive_date,
                expected_release_date:expected_release_date,
            },
            success:function (response) {
                var data = JSON.parse(response);
                console.log(data);

                if (data.status == 'success')
                {
                    __notif_load_data(__basepath + "/");
                    const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#send_CreatedDocs'));
                    mdl.hide();
                    load_createdDocs();
                    $('.__notification').load(location.href+' .__notification');
                    $('.incoming_counter').load(location.href+' .incoming_counter');

                }

            }
        });
    });

}

function status200(){
    if (response.status === 200)
    {
        __notif_load_data(__basepath + "/");
        const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#send_CreatedDocs'));
        mdl.hide();

        //docDetails();
        $('#send_toUser').hide();
        $('#btn_sendToAll').prop("checked", false);
        $('#checkBox_shoAuthor').prop("checked", false);
        //showFastSendDiv();
        sendDocs_modal_user_list.val(null).trigger('change');
        sendDocs_modal_group_list.val(null).trigger('change');
        sendDocs_modal_rc_list.val(null).trigger('change');
        $('.__notification').load(location.href+' .__notification');
        //load_createdDocs();
    }else {
        __notif_load_data(__basepath + "/");
    }
}

//Function for Toggling Document Details
function docDetails(docID){

    base_url = window.location.origin;

    swal({
        html:
            '<div class="intro-y col-span-12 md:col-span-6 lg:col-span-4 xl:col-span-3">'+
                '<div>'+
                    '<div class="p-5">'+
                        '<div class="p-5 image-fit zoom-in">'+
                            '<div id="qrcode" class="mt-4 flex justify-center rounded-md"></div>'+
                        '</div>'+
                        '<div class="text-slate-600 dark:text-slate-500 mt-5">'+
                            '<div class="flex items-center"> <i data-lucide="link" class="w-4 h-4 mr-2"></i> Tracking Number: <span class="ml-2">'+docID+'</span> </div>'+
                            '<div class="flex items-center mt-2"> <i data-lucide="layers" class="w-4 h-4 mr-2"></i> Recipient: 40 person(s) </div>'+
                            '<div class="flex items-center mt-2"> <i data-lucide="check-square" class="w-4 h-4 mr-2"></i> Status: Ongoing </div>'+
                        '</div>'+
                    '</div>'+
                    '<div class="flex justify-center lg:justify-end items-center p-5 border-t border-slate-200/60 dark:border-darkmode-400">'+
                        '<a class="flex items-center text-primary mr-auto" href="'+base_url+'/track/doctrack/'+docID+'" target="_blank"> <i class="fa fa-map-marked w-4 h-4 mr-2 text-primary"></i> Track </a>'+
                        '<a id="print_QR" class="flex items-center mr-3" href="'+base_url+'/print-qr/'+docID+'" target="_blank"> <i class="fa fa-print w-4 h-4 mr-2 text-primary"></i> Print </a>'+
                    '</div>'+
                '</div>'+
            '</div>',
    });


    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: docID,
        // text: base_url +'/track/doctrack/'+docID,
        width: 128,
        height: 128,
        colorDark : "#000000",
        colorLight : "#ffffff",
        correctLevel : QRCode.CorrectLevel.H
    });
}

//Check if Button Send To all Clicked
function is_checkSendToAll() {
    if(is_sendToAll.checked === true){
        checked_Box_Value = 1;
        console.log(checked_Box_Value);
    }else {
        checked_Box_Value = 0;
        console.log(checked_Box_Value);
    }
}

//Check if Button show Author Name Clicked
function is_checkShowAuthorName() {
    if(is_showAuthor.checked === true){
        checkedBox_ShowAuthorName = 1;
        console.log(checkedBox_ShowAuthorName);
    }else {
        checkedBox_ShowAuthorName = 0;
        console.log(checkedBox_ShowAuthorName);
    }
}

//Button Send to all Event Listener
checkbox_sendToAll.addEventListener('change', function() {
    if (this.checked) {
        hideFastSendDiv();
        sendDocs_modal_user_list.val(null).trigger('change');
        sendDocs_modal_group_list.val(null).trigger('change');
        sendDocs_modal_rc_list.val(null).trigger('change');
        $('#emp_List').val("");
        $('#grp_List').val("");
        $('#rc__list').val("");
    } else {
       showFastSendDiv();
    }
});

//Show Fast Send Section
function showFastSendDiv() {
    $('.sendToEmployee').show();
    $('.sendToGroups').show();
    $('.sendToRC').show();
}

//Hide Fast Send Section
function hideFastSendDiv() {
    $('.sendToEmployee').hide();
    $('.sendToGroups').hide();
    $('.sendToRC').hide();
}

//Check if Mark End of trail was checked
function isMarkEndOfTrail() {
    if(is_markEndTrail.checked === true){
        markEndTrail_Value = 1;
        // console.log(markEndTrail_Value);
    }else {
        markEndTrail_Value = 0;
        // console.log(markEndTrail_Value);
    }
}









