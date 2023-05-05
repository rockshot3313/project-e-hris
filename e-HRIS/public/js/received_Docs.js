
$(document).ready(function (){

    bpath = __basepath + "/";

    load_receivedDocsDataTable();
    load_receivedDocs();

});

var  _token = $('meta[name="csrf-token"]').attr('content');
var tbl_data_incomingDocs;


function load_receivedDocsDataTable(){

    try{
        /***/
        tbl_data_incomingDocs = $('#dt__receivedDocs').DataTable({
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
                    { className: "dt-head-center", targets: [ 3, 7, 8 ] },
                ],
        });
        /***/

        add_users_to_trail = $('.select2-multiple').select2({
            placeholder: "",
            allowClear: true,
            closeOnSelect: false,
        });

    }catch(err){  }
}


function load_receivedDocs() {

    $.ajax({
        url: bpath + 'documents/received/received-docs/load',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(data) {

            tbl_data_incomingDocs.clear().draw();
            /***/

            var data = JSON.parse(data);

            console.log(data);
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/

                    console.log();

                    var release_type = data[i]['release_type'];
                    let trail_button = '';
                    let release_button = '';
                    let receive_action = data[i]['action'];

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
                    var tool_tip_title = '';
                    var note = data[i]['note'];
                    var original_note = data[i]['original_note'];
                    var doc__from = data[i]['__from'];

                    var message_icon = '';
                    var level_class = data[i]['level_class'];

                    if (type_submitted === "Both")
                    {
                        type_submitted = "Hard Copy, Soft Copy";
                    }

                    if(release_type == 0) {

                        //Not trail send
                        trail_button += '<a id="btn_no_trail" href="javascript:;" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="No available trail" href="javascript:;" data-trk-no="'+track_number+'"><i class="icofont-foot-print tex-secondary "></i></a>'
                        release_button += '<a id="btn_no_release" disabled="true" href="javascript:;" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="Unable to release" data-trk-no="'+track_number+'"><i class="icofont-upload-alt tex-secondary"></i> </a>'

                    }

                    else if(receive_action == 1){
                        trail_button += '<a id="view_trail" href="javascript:;" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="view trail" href="javascript:;" data-tw-toggle="modal" data-tw-target="#view_track" data-trk-no="'+track_number+'"><i class="icofont-foot-print text-success"></i></a>'
                        release_button += '<a id="btn_cant_release" disabled="true" href="javascript:;" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="Already received the document, Unable to release" data-trk-no="'+track_number+'"><i class="icofont-upload-alt tex-secondary"></i> </a>'

                    }

                    else {
                        trail_button += '<a id="update_trail" href="javascript:;" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="Edit trail" href="javascript:;" data-tw-toggle="modal" data-tw-target="#add_new_track" data-trk-no="'+track_number+'"><i class="icofont-foot-print text-success"></i></a>'
                        release_button += '<a id="btn_releaseDocs_release" href="javascript:;" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="Release" data-trk-no="'+track_number+'"><i class="icofont-upload-alt text-success"></i> </a>'

                    }

                    if (note || original_note)
                    {
                        message_icon = 'fa-solid fa-message text-primary';
                        tool_tip_title = 'Has Message';

                    }else
                    {
                        message_icon = 'fa-regular fa-message text-secondary';
                        tool_tip_title = 'No Message';
                        note = 'no message attached!';
                        original_note = 'no message attached!';
                    }

                    var cd = "";
                    /***/

                    cd = '' +
                        '<tr >' +

                        '<td style="display: none" class="createdDoc_id">' +
                        createdDoc_id+
                        '</td>' +

                        '<td style="display: none" class="track_number">' +
                        track_number+
                        '</td>' +

                        '<td><a href="'+base_url+'/track/doctrack/'+track_number+'" target="_blank" class="underline decoration-dotted whitespace-nowrap">#'+
                        track_number+'</a>'+
                        '</td>' +

                        '<td class="name">' +
                        name+
                        '</td>' +

                        '<td class="desc flex items-center justify-center">' +
                            '<a id="btn_open_message" href="javascript:;" data-doc-from="'+doc__from+'" data-trk-no="'+track_number+'" data-doc-message="'+note+'" data-orig-note="'+original_note+'" class="tooltip" title="'+tool_tip_title+'"> <div class="flex items-center whitespace-nowrap "><i class="w-5 h-5 pt-3 pb-3 '+message_icon+'"></i></div></a>' +
                        '</td>' +

                        // '<td class="desc" <div> <span class="text-toldok">' + desc+ '</span> </div>' +
                        // '</td>' +

                        '<td >'+
                                '<div class="whitespace-nowrap type">'+type+'</div>'+
                                '<div class="text-slate-500 text-xs whitespace-nowrap text-'+level_class+' mt-0.5 level">'+level+'</div>'+
                        '</td>' +

                        '<td class="status">'+

                            '<div class="flex items-center whitespace-nowrap text-'+status_class+'"><div class="w-2 h-2 bg-'+status_class+' rounded-full mr-3"></div>Received</div>' +

                        '</td>' +

                        '<td class="type_submitted">' +

                                '<a id="btn_viewAttachments" href="javascript:;" data-trk-no="'+track_number+'"> <div class="flex items-center whitespace-nowrap "><i class="fa fa-folder w-4 h-4 mr-2 text-'+status_class+'"></i>'+type_submitted+'</div></a>' +
                        '</td>' +

                        '<td class="release">' +

                            '<div class="flex justify-center">'+
                                trail_button+
                            '</div>'+

                        '</td>' +

                        '<td>' +
                            '<div class="flex justify-center items-center">'+
                                    release_button+
                                '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">'+
                                    '<a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>'+
                                    '<div class="dropdown-menu w-40">'+
                                        '<div class="dropdown-content">'+
                                            '<a id="btn_showDetails" href="javascript:;" class="dropdown-item" data-trk-no="'+track_number+'"> <i class="fa fa-tasks w-4 h-4 mr-2 text-success"></i> Details </a>'+
                                            '<a id="btn_return" href="javascript:;" class="dropdown-item" data-trk-no="'+track_number+'"> <i class="fa fa-retweet w-4 h-4 mr-2 text-danger"></i> Return </a>'+
                                            '<a id="btn_hold" href="javascript:;" class="dropdown-item" data-trk-no="'+track_number+'"> <i class="fa fa-ban w-4 h-4 mr-2 text-pending"></i> Hold </a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</td>' +
                        '</tr>' +
                        '';

                        tbl_data_incomingDocs.row.add($(cd)).draw();
                    /***/
                }

            }
        }
    });
}

$("body").on('click', '#update_trail', function (){

    let docID = $(this).data('trk-no');
    $('#send_DocCode').val(docID)
    load_trails(docID);
});


$("body").on('click', '#view_trail', function (){

    let docID = $(this).data('trk-no');
    $('#view_DocCode').val(docID);
    load_trails(docID);
});


function load_trails(docID){
    $.ajax({
        url: bpath + 'documents/received/load/trail',
        type: "POST",
        data: {
            _token: _token,
            docID:docID,
        },
        success: function(response) {
            var data = JSON.parse(response);
            console.log(data);
            $("#load_trail_record").html(data.release_to);
            $("#view_loaded_trail_record").html(data.release_to);
            //__notif_load_data(__basepath + "/");
        }
    });
}


$("body").on('click', '#add_track_modal_button', function (){

    let docID = $('#send_DocCode').val();
    var new_trail = [];

    $('#receive_modal_add_trail :selected').each(function(i, selected) {
        new_trail[i] = $(selected).val();
    });
    console.log(new_trail);

    $.ajax({
        url: bpath + 'documents/received/add/trail',
        type: "POST",
        data: {
            _token: _token,
            docID:docID,
            new_trail:new_trail,
        },
        success: function(response) {
            var data = JSON.parse(response);
            console.log(data);

        }
    });
});


$("body").on('click', '#btn_no_trail', function (){
    swal({
        type: 'info',
        title: 'Trail Information',
        text: "There is no trail for this tracking number!",
    });
});


$("body").on('click', '#btn_cant_release', function (){
    swal({
        type: 'info',
        title: 'Action Information',
        text: "Already received the document, Unable to release!",
    });
});


$("body").on('click', '#btn_no_release', function (){
    swal({
        type: 'info',
        title: 'Action Information',
        text: "Already received the document, Unable to release!",
    });
});


$("body").on('click', '#btn_open_message', function (){

    let your_message = $(this).data('doc-message');
    let sender_message = $(this).data('orig-note');
    let doc_from = $(this).data('doc-from');

    document_message(your_message, sender_message, doc_from);

});







