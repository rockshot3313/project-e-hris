var  _token = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function (){

    bpath = __basepath + "/";
    load_travel_order();

    load_travel_order_data();
});

//Initialize all My Documents DataTables
function load_travel_order(){
    try{
        /***/
        dt__created_travel_order = $('#dt__created_travel_order').DataTable({
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
                    { className: "dt-head-center", targets: [  8 ] },
                ],
        });


        pos_des = $('#pos_des').select2({
            placeholder: "",
            allowClear: true,
            closeOnSelect: false,
            width: "100%",
        });

        trav_emp_list = $('#trav_emp_list').select2({
            placeholder: "Select Employee",
            allowClear: true,
            closeOnSelect: false,
            width: "100%",
        });

        name_modal = $('#name_modal').select2({
            placeholder: "Select Employee",
            allowClear: true,
            closeOnSelect: false,
            width: "100%",
        });


        /***/
    }catch(err){  }
}



function load_travel_order_data() {

    $.ajax({
        url: bpath + 'travel/order/load/travel/order',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(data) {

            dt__created_travel_order.clear().draw();
            /***/
            var data = JSON.parse(data);
            if(data.length > 0) {
                for(var i=0;i<data.length;i++) {

                    /***/

                    var id = data[i]['id'];
                    var name_id = data[i]['name_id'];
                    var name = data[i]['name'];
                    var date = data[i]['date'];
                    var departure_date = data[i]['departure_date'];
                    var return_date = data[i]['return_date'];
                    var pos_des_id = data[i]['pos_des_id'];
                    var pos_des_type = data[i]['pos_des_type'];
                    var station = data[i]['station'];
                    var station_id = data[i]['station_id'];
                    var destination = data[i]['destination'];
                    var purpose = data[i]['purpose'];
                    var created_at = data[i]['created_at'];
                    var interval = data[i]['interval'];
                    var days = data[i]['days'];

                    /***/

                    cd = '' +
                        '<tr >' +


                    //to_id
                        '<td style="display: none" class="to_id">' +
                        id+
                        '</td>' +

                    //user_id
                        '<td style="display: none" class="name_id">' +
                        name_id+
                        '</td>' +

                    //name_created_by
                        '<td><a href="'+name+'/track/doctrack/'+name+'" target="_blank" class="underline decoration-dotted whitespace-nowrap">#'+
                        name+'</a>'+
                        '</td>' +

                    //purpose
                        '<td class="name text-justify">' +

                            '<div data-to-prps="'+purpose+'">'+

                            '<span class="text">'+purpose+'</span>'+

                            '</div>'+

                            '<div class="text-slate-500 text-xs whitespace-nowrap text-secondary mt-0.5 level">'+created_at+'</div>'+

                        '</td>' +

                    //number of days
                        '<td ' +

                        '<div class="whitespace-nowrap type">'+

                        '<span class="text">'+days+'</span>'+

                        '</div>'+

                            '<span class="hidden">'+days+'</span>'+

                        '</td>' +

                    //departure
                        '<td ' +

                        '<div class="whitespace-nowrap type">'+

                        '<span class="text">'+departure_date+'</span>'+

                        '</div>'+

                            '<span class="hidden">'+departure_date+'</span>'+

                        '</td>' +

                    //return
                        '<td >'+
                                '<div class="whitespace-nowrap type">'+
                                '<span class="text">'+return_date+'</span>'+
                                '</div>'+

                                '<span class="hidden">'+return_date+'</span>'+

                        '</td>' +

                    //station
                        '<td class="station">'+

                            '<div class="flex items-center whitespace-nowrap text-'+station+'"><div class="w-2 h-2 bg-'+station+' rounded-full mr-3"></div>'+station+'</div>' +
                            '<span class="hidden">'+station+'</span>'+

                        '</td>' +

                    //destination
                        '<td class="destination">' +

                        '<div class="flex items-center whitespace-nowrap text-'+destination+'"><div class="w-2 h-2 bg-'+destination+' rounded-full mr-3"></div>'+destination+'</div>' +
                        '<span class="hidden">'+destination+'</span>'+

                        '</td>' +
                    //actions
                        '<td>' +
                            '<div class="flex justify-center items-center">'+
                                '<a id="'+name+'" target="_blank" href="/travel/order/print/to/'+id+'/vw" class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip" title="Print" data-to-id="'+id+'"><i class="icofont-print text-success"></i> </a>'+
                                '<div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">'+
                                    '<a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>'+
                                    '<div class="dropdown-menu w-40">'+
                                        '<div class="dropdown-content">'+
                                            '<a id="btn_update_to" href="javascript:;" class="dropdown-item" data-to-id="'+id+'"> <i class="fa fa-pencil-square w-4 h-4 mr-2 text-success"></i> Update </a>'+
                                            '<a id="btn_view_to" href="javascript:;" class="dropdown-item" data-to-id="'+id+'" data-tw-toggle="modal" data-tw-target="#view_travel_order"> <i class="fa fa-eye w-4 h-4 mr-2 text-success"></i> View </a>'+
                                            '<a id="btn_delete_to" href="javascript:;" class="dropdown-item" data-to-id="'+id+'"> <i class="fa fa-trash-alt w-4 h-4 mr-2 text-danger"></i> Delete </a>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</td>' +

                        '</tr>' +
                        '';

                        dt__created_travel_order.row.add($(cd)).draw();
                    /***/
                }
            }
        }
    });
}



    $('#add_row_signatories').on('click',function(){
        //alert('sdf');
        add_row_sig();
    });


    function add_row_sig(){
        var tr='<tr class="hover:bg-gray-200">'+
            '<td>'+$('#trav_emp_list').val()+'</td>'+
            '<td><input type="text" style="display: none" name="table_signatory_emp_id[]" class="form-control "  value="'+$('#trav_emp_list').val()+'">'+$('#trav_emp_list option:selected').text()+'</td>'+
            '<td><input type="text" style="display: none" name="table_signatory_description[]" class="form-control "  value="'+$('#sd_modal_').val()+'">'+$('#sd_modal_').val()+'</td>'+
            '<td><a href="javascript:void(0);" class="flex items-center text-theme-6 delete"><i  class="w-4 h-4 mr-1 far fa-trash-alt">Remove</i></a></td>'+
        '</tr>';
        $('.sig_modal_table tbody').append(tr);
        $('#sd_modal_').val('');
        trav_emp_list.val(null).trigger('change');
    };

    $('.sig_modal_table tbody').on('click','.delete',function(){
        var last=$('.sig_modal_table tbody tr').length;

            $(this).parent().parent().remove();

    });

    $('.sig_modal_table tbody').on('click','.delete',function(){
        var last=$('.sig_modal_table tbody tr').length;
            $(this).parent().parent().remove();
    });




    $('#add_travel_order').on('click',function(){


        let save_or_update = document.getElementById('add_travel_order').innerText;

        var add = '';
        if(save_or_update == 'Save'){
            add = 'added';
        }else{
            add = 'updated';
        }

        let to_id = $('#modal_update_to_id').val();

        let name_modal = $('#name_modal').val();
        let name_modal_text = $('#name_modal').text();
        let modal_date_now = $('#modal_date_now').val();
        let modal_departure_date = $('#modal_departure_date').val();
        let modal_return_date = $('#modal_return_date').val();
        let pos_des = $('#pos_des').val();
        var pos_des_type = $('#pos_des').find(":selected").attr('data-ass-type');
        let modal_station = $('#modal_station').val();
        let modal_destination = $('#modal_destination').val();
        let modal_purpose = $('#modal_purpose').val();
        var table_signatory_emp_id = [];
        var table_signatory_description = [];

        $('input[name="table_signatory_emp_id[]"]').each(function (index, emp_id) {
            table_signatory_emp_id[index] = $(emp_id).val();
        });


        $('input[name="table_signatory_description[]"]').each(function (i, desc) {
            table_signatory_description[i] = $(desc).val();

        });

        $.ajax({
            type: "POST",
            url: bpath + 'travel/order/add/travel/order',
            data: {
                _token: _token,
                name_modal:name_modal,
                name_modal_text:name_modal_text,
                modal_date_now:modal_date_now,
                modal_departure_date:modal_departure_date,
                modal_return_date:modal_return_date,
                pos_des:pos_des,
                pos_des_type:pos_des_type,
                modal_station:modal_station,
                modal_destination:modal_destination,
                modal_purpose:modal_purpose,
                table_signatory_emp_id:table_signatory_emp_id,
                table_signatory_description:table_signatory_description,
                save_or_update:save_or_update,
                to_id:to_id,

            },
            success:function (response) {
                var data = JSON.parse(response);
                //console.log(data);

                    __notif_show( 1, "Success", "Traver Order "+add+" successfully!");
                    const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#make_travel_order_modal'));
                    mdl.hide();
                    clear_add_update_modal();
                    load_travel_order_data();
            }
        });

    });



    $("body").on("click", "#btn_delete_to", function (ev) {
        to_id = $(this).data('to-id');
        console.log( to_id);
        swal({
            container: 'my-swal',
            title: 'Are you sure?',
            text: "It will permanently deleted!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1e40af',
            cancelButtonColor: '#6e6e6e',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value == true) {
                swal({
                    title:"Deleted!",
                    text:"Travel Order deleted permanently!",
                    type:"success",
                    confirmButtonColor: '#1e40af',
                    confirmButtonColor: '#1e40af',
                    timer: 1000
                });

                $.ajax({
                    url: "order/remove",
                    type: "POST",
                    data: {
                        _token:_token,
                        to_id: to_id,
                    },
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        var data = JSON.parse(data);
                        __notif_load_data(__basepath + "/");
                        load_travel_order_data();
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal({
                    title:"Cancelled",
                    text:"No action taken!",
                    type:"error",
                    confirmButtonColor: '#1e40af',
                    confirmButtonColor: '#1e40af',
                    timer: 500
                });
            }
        })
    });


    $("body").on("click", "#btn_update_to", function (ev) {
        to_id = $(this).data('to-id');

        document.getElementById('add_travel_order').innerText = "Update"

        $.ajax({
            url: "order/load/details",
            type: "POST",
            data: {
                _token:_token,
                to_id: to_id,
            },
            cache: false,
            success: function (data) {
                clear_add_update_modal();
                var data = JSON.parse(data);

                const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#make_travel_order_modal'));
                    mdl.toggle();

                    $('#modal_update_to_id').val(data['get_to']['id']);
                    $('#modal_date_now').val(data['get_to']['date']);
                    $('#modal_departure_date').val(data['get_to']['departure_date']);
                    $('#modal_return_date').val(data['get_to']['return_date']);
                    $('#modal_station').val(data['get_to']['station']);
                    $('#modal_destination').val(data['get_to']['destination']);
                    $('#modal_purpose').val(data['get_to']['purpose']);

                    $('.sig_modal_table tbody').append(data['sig_for_table']);

                //console.log(data);
            }
        });
    });

    $("body").on("click", "#make_travel_order", function (ev) {
        document.getElementById('add_travel_order').innerText = "Save";
        clear_add_update_modal();
    });

    function clear_add_update_modal() {
        $('.sig_modal_table tbody tr').detach();
        trav_emp_list.val(null).trigger('change');
        $('#sd_modal_').val('');
        $('#modal_date_now').val('');
        $('#modal_departure_date').val('');
        $('#modal_return_date').val('');
        $('#modal_station').val('');
        $('#modal_destination').val('');
        $('#modal_purpose').val('');

        $('#modal_update_to_id').val('');


    }
