$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).ready(function() {

    bpath = __basepath + "/";

    load_datatable();
    load_payroll();

});

var  _token = $('meta[name="csrf-token"]').attr('content');
var tbldata;



function load_datatable() {

    try{
        /***/
        tbldata = $('#dt_payroll').DataTable({
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
        });
        /***/
    }catch(err){  }
}

function load_payroll() {

    $.ajax({
        url: bpath + 'payroll/payroll/load',
        type: "POST",
        data: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data) {
            tbldata.clear().draw();
            /***/

            var data = JSON.parse(data);
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/
                    var id = data[i]['id'];
                    var group_name = data[i]['group_name'];
                    var date_desc = data[i]['date_desc'];
                    var date_month = data[i]['date_month'];
                    var date_year = data[i]['date_year'];
                    var employee = data[i]['employee'];
                    var processed_by = data[i]['processed_by'];
                    var status = data[i]['status'];


                    var cd = "";

                    /***/
                    cd = '' +
                        '<tr>' +

                        '<td class="hidden">' +
                        id+
                        '</td>' +

                        '<td>' +
                        group_name+
                        '</td>' +


                        '<td>' +
                        date_desc+
                        '</td>' +


                        '<td>' +
                        date_month+
                        '</td>' +

                        '<td>' +
                        date_year+
                        '</td>' +

                        '<td>' +
                        employee+
                        '</td>' +

                        '<td>' +
                        processed_by+
                        '</td>' +

                        '<td>' +
                        status+
                        '</td>' +

                        '<td>' +
                        '<div class="flex justify-center items-center">'+
                        '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">'+
                        '<a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>'+
                        '<div class="dropdown-menu w-40">'+
                        '<div class="dropdown-content">'+

                        '<a id="btn_showDetails" href="javascript:;" class="dropdown-item" "> <i class="fa fa-tasks w-4 h-4 mr-2 text-success"></i> Details </a>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</div>'+
                        '</td>' +

                        '</tr>' +
                        '';
                    tbldata.row.add($(cd)).draw();
                    /***/
                }
            }
        }
    });
}
