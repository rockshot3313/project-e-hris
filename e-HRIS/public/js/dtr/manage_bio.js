$(document).ready(function() {

    bioengine = new BioEngine();
    bioengine.setCallbackFPGetData(callbackFPGetData);

    load_datatable();
    /*load_data();*/

    bind_events();

    employee_check();

    var tm = setTimeout(function(){
        bioengine.deviceFPCheck(callbackFPCheck);
    }, 800);

});

var  _token = $('meta[name="csrf-token"]').attr('content');
var  bpath = $('meta[name="basepath"]').attr('content') + "/";

var bioengine;

var tbldata;
var tblusers_select;


function bind_events() {
    /***/
    /***/
    try{
        $('.b_action').unbind();
    }catch(err){}
    try{
        $(".b_action").on('click', function(event){
            /***/
            check_action($(this));
            /***/
        });
    }catch(err){}
    /***/
    /***/
    try{
        $('.input_action').unbind();
    }catch(err){}
    try{
        $(".input_action").on('click', function(event){
            /***/
            check_action($(this));
            /***/
        });
    }catch(err){}
    /***/
    /***/
}

function bind_row_events() {
    /***/
    /***/
    try{
        $('.row_action').unbind();
    }catch(err){}
    try{
        $(".row_action").on('click', function(event){
            /***/
            check_action($(this));
            /***/
        });
    }catch(err){}
    /***/
    /***/
}

function check_action(src) {
    try{
        var data_type = src.attr("data-type");
        var data_target = src.attr("data-target");
        /***/
        if(data_type != null) {
            /***/
            if(data_type.trim().toLowerCase() == "action".trim().toLowerCase()) {

                if(data_target.trim().toLowerCase() == "show-add".trim().toLowerCase()) {
                    /***/
                    modal_show("mdl__add");
                    /***/
                }
                if(data_target.trim().toLowerCase() == "show-update".trim().toLowerCase()) {
                    /***/
                    var id = src.attr("data-id");
                    ldt_update(id);
                    /***/
                }
                if(data_target.trim().toLowerCase() == "show-delete".trim().toLowerCase()) {
                    /***/
                    var id = src.attr("data-id");
                    ldt_delete(id);
                    /***/
                }

                if(data_target.trim().toLowerCase() == "data-add".trim().toLowerCase()) {
                    /***/
                    data_add();
                    /***/
                }
                if(data_target.trim().toLowerCase() == "data-update".trim().toLowerCase()) {
                    /***/
                    data_update();
                    /***/
                }
                if(data_target.trim().toLowerCase() == "data-delete".trim().toLowerCase()) {
                    /***/
                    data_delete();
                    /***/
                }


                if(data_target.trim().toLowerCase() == "show-users-select".trim().toLowerCase()) {
                    /***/
                    load_list_users();
                    modal_show("mdl__users__select");
                    /***/
                }

                if(data_target.trim().toLowerCase() == "select-user".trim().toLowerCase()) {
                    /***/
                    $('#' + 'su-id').val(src.attr("data-value"));
                    $('#' + 'su-name').val(src.attr("data-value-2"));
                    employee_check();
                    modal_hide("mdl__users__select");
                    /***/
                }

            }
            /***/
        }
        /***/
    }catch(err){}
}


function load_datatable() {

    try{
        /***/
        tblusers_select = $('#dt_users_select').DataTable({
            dom:
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-6 text_left_1'l><'intro-y col-span-6 text_left_1'f>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'tr>>" +
                "<'grid grid-cols-12 gap-6 mt-5'<'intro-y col-span-12'<'datatable_paging_1'p>>>",
            renderer: 'bootstrap',
            "language": {
              "emptyTable": "..."
            },
            "info": false,
            "bInfo":true,
            "bJQueryUI": true,
            "bProcessing": true,
            "bPaginate" : true,
            "aLengthMenu": [[10,25,50,100,150,200,250,300,-1], [10,25,50,100,150,200,250,300,"All"]],
            "iDisplayLength": 10,
            "aaSorting": [],
            "ordering": true,
        });
        tblusers_select.on('page.dt', function () {
          try{
            bind_row_events();
          }catch(err){}
        })
        .on('order.dt', function () {
          try{
            bind_row_events();
          }catch(err){}
        })
        .on('search.dt', function () {
          try{
            bind_row_events();
          }catch(err){}
        });
        /***/
    }catch(err){  }
}

function load_data() {

    try{

        $.ajax({
            url: bpath + 'competency/skills/data/get',
            type: "POST",
            data: {
                '_token': _token,
            },
            success: function(response) {
                tbldata.clear().draw();
                /***/

                var data = (response);
                if(data.length > 0) {
                    for(var i=0;i<data.length;i++) {
                        try{
                            /***/
                            var id = data[i]['skillid'];
                            var name = data[i]['skill'];
                            var details = data[i]['details'];
                            var points = data[i]['default_points'];

                            var cd = "";

                            /***/
                            cd = '' +
                                '<tr>' +
                                '   <td class="hidden">' + id + '</td>' +
                                '   <td class="w-2/3">' +
                                '       <div class="font-medium">' + name + '</div>' +
                                '       <div class="text-slate-500 text-xs mt-0.5">' + details + '</div>' +
                                '   </td>' +
                                '   <td>' + details + '</td>' +
                                '   <td>' +
                                '       <div class="flex justify-center items-center">'+
                                '       <div class="w-8 h-8 rounded-full flex items-center justify-center border dark:border-darkmode-400 ml-2 text-slate-400 zoom-in tooltip dropdown" title="More Action">'+
                                '           <a class="flex justify-center items-center" href="javascript:;" aria-expanded="false" data-tw-toggle="dropdown"> <i class="fa fa-ellipsis-h items-center text-center text-primary"></i> </a>'+
                                '           <div class="dropdown-menu w-40">'+
                                '               <div class="dropdown-content">'+
                                '                   <a href="javascript:;" class="dropdown-item b_action" data-type="action" data-target="show-update" data-id="' + id + '"> <i class="fa fa-edit w-4 h-4 mr-2"></i> Edit </a>'+
                                '                   <a href="javascript:;" class="dropdown-item b_action" data-type="action" data-target="show-delete" data-id="' + id + '"> <i class="fa fa-trash w-4 h-4 mr-2"></i> Delete </a>'+
                                '               </div>'+
                                '           </div>'+
                                '       </div>'+
                                '       </div>'+
                                '   </td>' +

                                '</tr>' +
                                '';
                            tbldata.row.add($(cd)).draw();
                            /***/
                        }catch(err){}
                    }
                }

                bind_events();

            },
            error: function (response) {

            }
        });
        
    }catch(err){}

}

function data_add() {

    try{

        var name = $('#' + '' + 'name');
        var details = $('#' + '' + 'details');
        var points = $('#' + '' + 'points');

        $.ajax({
            url: bpath + 'competency/skills/data/add',
            type: "POST",
            data: {
                '_token': _token,
                'name': name.val(),
                'details': details.val(),
                'points': points.val(),
            },
            success: function(response) {
                try{

                    var data = response;
                    var res_code = parseInt(data['code']);
                    var res_msg = (data['message']);

                    if(res_code > 0) {
                        __notif_show("1", "Success" , "Skill added.");
                        /**/
                        name.val('');
                        details.val('');
                        points.val('');
                        /**/
                        modal_hide('mdl__add');
                        load_data();
                        /**/
                    }else{
                        __notif_show("-2", "Error" , res_msg);
                    }

                }catch(err){}
            }
        });
        
    }catch(err){}

}

function data_update() {

    try{

        var id = $('#' + 'upd_' + 'id');

        var name = $('#' + 'upd_' + 'name');
        var details = $('#' + 'upd_' + 'details');
        var points = $('#' + 'upd_' + 'points');
        

        $.ajax({
            url: bpath + 'competency/skills/data/update',
            type: "POST",
            data: {
                '_token': _token,
                'id': id.val(),
                'name': name.val(),
                'details': details.val(),
                'points': points.val(),
            },
            success: function(response) {
                try{

                    var data = response;
                    var res_code = parseInt(data['code']);
                    var res_msg = (data['message']);

                    if(res_code > 0) {
                        __notif_show("1", "Success" , "Skill updated.");
                        /**/
                        id.val('');
                        name.val('');
                        details.val('');
                        points.val('');
                        /**/
                        modal_hide('mdl__update');
                        load_data();
                        /**/
                    }else{
                        __notif_show("-2", "Error" , res_msg);
                    }

                }catch(err){}
            }
        });
        
    }catch(err){}

}

function data_delete() {

    try{

        var id = $('#' + 'del_' + 'id');

        $.ajax({
            url: bpath + 'competency/skills/data/delete',
            type: "POST",
            data: {
                '_token': _token,
                'id': id.val(),
            },
            success: function(response) {
                try{

                    var data = response;
                    var res_code = parseInt(data['code']);
                    var res_msg = (data['message']);

                    if(res_code > 0) {
                        __notif_show("1", "Success" , "Skill deleted.");
                        /**/
                        id.val('');
                        /**/
                        modal_hide('mdl__delete');
                        load_data();
                        /**/
                    }else{
                        __notif_show("-2", "Error" , res_msg);
                    }

                }catch(err){}
            }
        });
        
    }catch(err){}

}


function load_list_users() {

    try{

        $.ajax({
            url: bpath + 'dtr/manage/bio/users/list',
            type: "POST",
            data: {
                '_token': _token,
            },
            success: function(response) {
                tblusers_select.clear().draw();
                /***/

                var data = (response);
                if(data.length > 0) {
                    for(var i=0;i<data.length;i++) {
                        try{
                            /***/
                            var id = data[i]['agencyid'];
                            var lastname = data[i]['lastname'];
                            var firstname = data[i]['firstname'];
                            var middlename = data[i]['mi'];
                            var fullname = lastname.trim() + ", " + firstname.trim() + " " + middlename.trim();

                            var cd = "";

                            /***/
                            cd = '' +
                                '<tr class="cursor-pointer row_action" data-type="action" data-target="select-user" data-value="' + id + '" data-value-2="' + fullname + '">' +
                                '   <td class="hidden">' + id + '</td>' +
                                '   <td class="">' +
                                '       <div class="font-medium">' + id + '</div>' +
                                '   </td>' +
                                '   <td class="">' +
                                '       <div class="font-medium">' + fullname + '</div>' +
                                '   </td>' +

                                '</tr>' +
                                '';
                            tblusers_select.row.add($(cd)).draw();
                            /***/
                        }catch(err){}
                    }
                }

                bind_row_events();

            },
            error: function (response) {

            }
        });
        
    }catch(err){}

}

function employee_check() {

    try{

        var tad = '';

        var target = $('#' + 'suc_msgs');
        target.html(tad);

        var employee = $('#' + 'su-id').val();

        if(employee.trim() != "") {

            try{

                $.ajax({
                    url: bpath + 'dtr/manage/bio/check/employee',
                    type: "POST",
                    data: {
                        '_token': _token,
                        'employee': employee,
                    },
                    success: function(response) {
                        /***/
                        var data = (response);
                        /***/
                        /***/
                        if(data.length > 0) {
                            for(var i=0;i<data.length;i++) {
                                try{
                                    /***/
                                    var type = data[i]['type'];
                                    var content = data[i]['content'];

                                    var cd = "";

                                    var css = 'alert-outline-danger';

                                    try{
                                        if(type.toLowerCase().trim() == "danger".toLowerCase().trim()) {
                                            css = 'alert-outline-danger';
                                        }
                                        if(type.toLowerCase().trim() == "warning".toLowerCase().trim()) {
                                            css = 'alert-outline-warning';
                                        }
                                    }catch(err){}

                                    /***/
                                    cd = '' +
                                        '<div class="alert ' + css + ' alert-dismissible show flex items-center mb-2" role="alert"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-alert-octagon"><polygon points="7.86 1 16.14 1 22 7.86 22 16.14 16.14 22 7.86 22 1 16.14 1 7.86 7.86 1"></polygon><line x1="12" x2="12" y1="8" y2="12"></line><line x1="12" x2="12.01" y1="16" y2="16"></line></svg> <div class="pl-3" style="display: inline-block;">' + content.trim() + '</div></div>' +
                                        '';
                                    /***/
                                    tad = tad + cd;
                                    /***/
                                }catch(err){  }
                            }
                        }

                        target.html(tad);

                    },
                    error: function (response) {

                    }
                });

            }catch(err){}

        }
        
    }catch(err){}

}


function callbackFPCheck(data) {

    //console.log(data);

}
function callbackFPGetData(data) {
    
    //console.log(data);
    
    if(data !== null && data !== undefined) {



    }
    
}



function ldt_update(id) {

    try{

        $.ajax({
            url: bpath + 'competency/skills/data/info',
            type: "POST",
            data: {
                '_token': _token,
                'id': id,
            },
            success: function(response) {
                /***/

                var data = (response);
                if(data.length > 0) {
                    for(var i=0;i<data.length;i++) {
                        try{
                            /***/
                            $('#' + 'upd_' + 'id').val(id);
                            /***/
                            $('#' + 'upd_' + 'name').val(data[i]['skill']);
                            $('#' + 'upd_' + 'details').val(data[i]['details']);
                            $('#' + 'upd_' + 'points').val(data[i]['default_points']);
                            /***/
                        }catch(err){}
                    }
                    /***/
                    modal_show('mdl__update');
                    /***/
                }
                
            },
            error: function (response) {

            }
        });
        
    }catch(err){}

}

function ldt_delete(id) {

    try{

        $('#' + 'del_' + 'id').val(id);
        modal_show('mdl__delete');

    }catch(err){}

}

