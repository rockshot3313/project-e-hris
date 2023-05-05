$(document).ready(function() {

    bpath = __basepath + "/";
    list_of_submitted_leave_table();
    load_submitted_leave_application('');


});


var  _token = $('meta[name="csrf-token"]').attr('content');

var tbldata_submitted_leave_application;
var tbldata_supervisee_submitted_leave_application;
var tbldata_mytraining_seminars_applied_for_credit;


function list_of_submitted_leave_table() {

    try{
        /***/
    tbldata_submitted_leave_application = $('#submitted_leave_application').DataTable({
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
                    { className: "dt-head-center", targets: [ 4 ] },
                ],
        });

    tbldata_supervisee_submitted_leave_application = $('#supervisee_submitted_leave_application').DataTable({
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
                    { className: "dt-head-center", targets: [ 5 ] },
                ],
        });


        tbldata_mytraining_seminars_applied_for_credit = $('#mytraining_seminars_applied_for_credit').DataTable({
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
                    { className: "dt-head-center", targets: [ 7 ] },
                ],
        });


        /***/
    }catch(err){  }
}

//Start load submitted of leave application ajax

function load_submitted_leave_application(id) {

    $.ajax({
        url: bpath + 'Leave/load_applied_leave_submitted',
        type: "POST",
        data: {
            _token: _token,
            id: id,
        },
        success: function(data) {
            tbldata_supervisee_submitted_leave_application.clear().draw();
            /***/
            var data = JSON.parse(data);
      
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/
                    var id = data[i]['id'];
                    var firstname = data[i]['firstname'];
                    var mi= data[i]['mi'];
                    var lastname= data[i]['lastname'];
                    var extension =data[i]['extension'];
                    var typename = data[i]['typename'];
                    var swhere = data[i]['swhere'];
                    var no_of_days = "0";
                    var date = data[i]['entrydate'];
                
                    var cd = "";
                    /***/

                    cd = '' +
                        '<tr >' +

                        '<td style="display: none" class="id">' +
                        id+
                        '</td>' +

                        '<td>' +
                        firstname  +'&nbsp'+ mi +'&nbsp'+ lastname + '&nbsp'+ extension+
                        '</td>' +

                        '<td>' +
                        typename+
                        '</td>' +

                        '<td>' +
                        swhere+
                        '</td>' +

                        '<td>' +
                        no_of_days+
                        '</td>' +

                        '<td>'+
                        date+
                        '</td>'+

                        '<td class="w-auto">' +
                        '<div class="flex justify-center items-center">'+
                        ' <div> <button id="'+id+'" class="edit_leave_type_btn" href="javascript:;" data-id="id"  data-tw-toggle="modal" data-tw-target="#edit_leave_type_modal"><i class="fa fa-edit text-primary"></i>&nbsp &nbsp &nbsp '+
                       
                       
                        '</div>'+
                        '</td>' +

                        '</tr>' +
                        '';

                        tbldata_supervisee_submitted_leave_application.row.add($(cd)).draw();


                    /***/

                }

            }
        }

    });

}






