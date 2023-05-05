
var  _token = $('meta[name="csrf-token"]').attr('content');
var rating_table;
var tbl_applicant_rated;
var Applicant_position_select;
$(document).ready(function () {

    $('#remarks_div').hide();
    $('#tfoot_id').hide();
    $('#saveRate_btn').hide();

    fetchedCriteria();
    action_function();
    cancel();
    dropdown();
    loadTables();
    onChange();
    refresh();
    sum_rate();
    manageRating_Validation();
    onClick_function();
    onSubmit();
    fetched_rated();
    // validate_table_input();



});

function fetchedCriteria(categoryID){
    $.ajax({
        url: '/rating/fetch-criteria',
        type: "get",
        data: {
            _token: _token, categoryID:categoryID,
        },
        success: function(data) {
            $('#tbl_criteria_div').html(data);

            $('#tbl_criteria').DataTable({
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
                "aLengthMenu": [[5,10,25,50,100,150,200,250,300,-1], [5,10,25,50,100,150,200,250,300,"All"]],
                "iDisplayLength": 5,
                "aaSorting": [],

                order: [0, 'desc']

            });
        }
    });
}

function action_function(){
    // CHANGE NAME OF BUTTON
    $("body").on('click', '.addCriteria', function () {
        $('#addAndUpdate_header').text('Add Criteria');
        $('#add_criteria_btn').text("Save");
    });
    // ADD AND UPDATE CRITERIA
    $("body").on('click', '#add_criteria_btn', function () {
        // alert('123')
        if($('#add_criteria_btn').text() == "Save"){
            // alert('Save')
            var crit = $('#criteria').val();
            var position_cat = $('#position_cat').val();
            var maxrate = $('#maxrate').val();

            $.ajax({
                url: '/rating/add-criteria',
                method: 'post',
                data: { _token: _token, crit: crit, position_cat:position_cat, maxrate:maxrate},
                cache:false,
                success: function (r) {
                    if(r.status == 200){
                    __notif_show( 1,"criteria Added Successfully");
                    $('#addCriteriaForm')[0].reset();
                    const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#addCriteria_modal'));
                    mdl.hide();
                    fetchedCriteria(position_cat);
                    dropdown();
                    }
                }
            });
        }else{
            // alert('update')
            var crit = $('#criteria').val();
            var position_cat = $('#position_cat').val();
            var maxrate = $('#maxrate').val();
            var critID = $('#critID').val();

            // console.log(crit+' '+appl+' '+maxrate+' '+critID);
            $.ajax({
                url: '/rating/update-criteria',
                method: 'post',
                data: { _token: _token, crit: crit, position_cat:position_cat, maxrate:maxrate, critID:critID},
                cache:false,
                success: function (r) {
                    if(r.status == 200){
                    __notif_show( 1,"Criteria Updated Successfully");
                    $('#addCriteriaForm')[0].reset();
                    const ediCreteriaModel = tailwind.Modal.getOrCreateInstance(document.querySelector('#addCriteria_modal'));
                    ediCreteriaModel.hide();
                    fetchedCriteria(position_cat);
                    dropdown();
                    }
                }
            });
        }
    });

    // EDIT CRITERIA
    $("body").on('click', '.editCriteria_btn', function () {
        var crit_id = $(this).attr('id');
        var criteria = $(this).data('criteria');
        var maxrate = $(this).data('max-rate');
        var position_id = $(this).data('position');
        // console.log(criteria +' '+crit_id+'  '+maxrate+' '+position_id);
        $('#addAndUpdate_header').text('Update Criteria');
        $('#add_criteria_btn').text('Update')
        const ediCreteriaModel = tailwind.Modal.getOrCreateInstance(document.querySelector('#addCriteria_modal'));
        ediCreteriaModel.show();

        $('#criteria').val(criteria);
        $('#maxrate').val(maxrate);
        $('#critID').val(crit_id);
        $('#position_cat').val(position_id).trigger('change');
        // $.ajax({
        //     url: '/rating/fetched/select-position/'+position_id,
        //     method: 'get',
        //     data: { _token: _token},
        //     success: function (data) {

        //      $('#position_div').html(data);

        //     }
        // });

    });

    //DELETE CRITERIA
    $("body").on("click", ".deleteCriteria_btn", function (ev) {
        ev.preventDefault();
        var position_cat = $('#positioncritPage').val();
        var urlToRedirect = ev.currentTarget.getAttribute('href'); //use currentTarget because the click may be on the nested i tag and not a tag causing the href to be empty

        swal({
            container: 'my-swal',
            title: 'Are you sure?',
            text: "It will permanently deleted !",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value == true) {

                criteria_id = $(this).attr('id');

                // console.log(criteria_id);
                $.ajax({
                    url: '/rating/delete-criteria',
                    method: 'POST',
                    data: {
                        _token:_token,
                        criteria_id: criteria_id,
                    },
                    cache: false,
                    success: function (data) {
                        //console.log(data);
                        var status = data.status;
                        // alert(status)
                        if(status == 200){
                            swal("Deleted!", "your Criteria has been deleted Successfully.", "success");
                            __notif_show( 1,"Successfully Deleted!");
                            fetchedCriteria(position_cat);


                        }else{
                            swal("Warning!", "Deleter Unsuccessful.", "warning");
                        }
                    }
                });
            } else if (
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swal("Cancelled", "Your data is safe :)", "error");
            }
        })
    });
    //Add Area
$   ("body").on('click', '.show_areas', function () {
        var criters_id = $(this).attr('id');
        var criters_name = $(this).data('criteria-name');
        // alert ('123')
        $('#crit_id').val(criters_id);
        $('#criters_name').text(criters_name+'  '+'Area/s');


    });
    //Add Row
    var i = 0;
    $("body").on('click', '#add_more', function () {
       ++i;
       $('#addArea_table').append(
        '<tr>'+
            '<td>'+
            '<input type="hidden" value="0" class="form-control" name="areasID[]" id="areasID">'+
                '<input type="text" id="areaname" class="form-control" name="areaname[]" id="rate_name" placeholder="Enter Area Rate">'+

            '</td>'+
            // '<td>'+

            //     ' <input type="text" id="arearate" class="form-control" name="arearate[]" id="rate_id" placeholder="Enter Area Rate">'+

            // '</td>'+
            '<td>'+
                ' <a href="javascript:;" class="remove-table-row"> <i class="fa fa-trash-alt w-4 h-4 mr-2 text-danger"></i></a>'+
            '</td>'+
        '</tr>');

    });
    //Remove Row
    $("body").on('click', '.remove-table-row', function () {
        $(this).parents('tr').remove();
     });

}

function onClick_function(){
    // show areas
    $("body").on('click', '.show_areas', function () {
        // alert('skdfhgkdfcvbbcgb')
        var id = $(this).attr('id');
        // alert(id)
        $.ajax({
            url: '/rating/show-criteria-areas/'+id,
            method: 'get',
            data: {
                _token:_token,
            },
            cache: false,
            success: function (data) {
                //console.log(data);
                // var status = data.status;
                // alert(status)
				/***/
				var data = JSON.parse(data);
                // alert(data.length)


				if(data.length > 0) {

					for(var i=0;i<data.length;i++) {
							/***/

                            var areas_id = data[i]['id'];
                            var area = data[i]['area'];
                            var rate = data[i]['rate'];


                            $('#addArea_table').append(
                                '<tr>'+
                                    '<td>'+
                                        '<input type="hidden" value="'+areas_id+'" class="form-control" name="areasID[]" id="areasID" placeholder="Enter Area Rate">'+
                                        '<input type="text" value="'+area+'" class="form-control" name="areaname[]" id="rate_name" placeholder="Enter Area Rate">'+

                                    '</td>'+
                                    // '<td>'+

                                    //     ' <input type="text" value="'+rate+'" id="arearate" class="form-control" name="arearate[]" id="rate_id" placeholder="Enter Area Rate">'+

                                    // '</td>'+
                                    '<td>'+
                                        ' <a href="javascript:;" id="'+areas_id+'" class="remove-table-row deleteArea"> <i class="fa fa-trash-alt w-4 h-4 mr-2 text-danger"></i></a>'+
                                    '</td>'+
                                '</tr>');


					}

				}

            }
        });

    });

    //delete Areas
    $("body").on('click', '.deleteArea', function () {
        var id = $(this).attr('id');
        $.ajax({
            url: '/rating/delete-criteria-area/'+id,
            method: 'get',
            data: {
                _token:_token,
            },
            cache: false,
            success: function (response) {
                __notif_show( 1,"Area Deleted");
            }
        });
    });

    //rate area Modal
    $("body").on('click', '.rating_area', function () {
        // alert('123')
        var id = $(this).attr('id');
        var rateValue = $(this).closest('tr').find('.rateClass');
        rateValue.addClass('selected-input');
        var maxrate = $(this).data('max-rate');
        var critname = $(this).data('criteria-name');
        $('#criteria_name').text(critname +' '+'Area/s');
        var applicantID = $('#applicant_ids').val();
        var positionID = $('#position').val();
        // $('#ops_id').text(critname);
        $('#applicant_id').val(applicantID);
        $('#position_id').val(positionID);
        $('#maximumrate').val(maxrate);
        $('#maxratelabel').text(maxrate+'%');

        // alert(maxrate)
        $('#criteria_id').val(id);
        // $('#ratingArea_table').find('for-row-romoval').remove('tr');
        // $('.remove-table-row').parents('tr').remove();
        $("#ratingArea_table").find("tr:gt(0)").remove();
        // alert(id)
        $.ajax({
            url: '/rating/show-rate-criteria-area/'+id,
            method: 'get',
            data: {
                _token:_token, applicantID:applicantID, positionID:positionID,
            },
            cache: false,
            success: function (data) {

                var data = JSON.parse(data);
                // alert(data.length);\
                rateValue.val($('#rateSum').val());
                console.log(data.length);
                if(data.length > 0) {
                    const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#ratingArias_modal"));
                    myModal.show();
                    for(var i=0;i<data.length;i++) {

                        var areas_id = data[i]['id'];
                        var area = data[i]['area'];
                        var rate = data[i]['rate'];
                        var rated_id = data[i]['rated_id'];
                        var sumall = data[i]['sumAll'];

                        $('#sumAll').val(sumall);
                        $('#sumOf_rate').text(sumall+'%');
                        $('#ratingArea_table').append(
                            '<tr>'+

                                '<td class="for-row-romoval">'+
                                    '<input type="hidden" value="'+rated_id+'" class="form-control" name="ratedArea_id[]" id="ratedArea_id">'+
                                    area+
                                '</td>'+

                                '<td>'+
                                    '<input type="hidden" value="'+areas_id+'" class="form-control" name="areas_id[]" id="areas_id">'+
                                    '<input type="text" value="'+rate+'" class="form-control areaClass" name="rate_area[]" maxlength="3" size="2" id="ratearea_name" placeholder="Enter Area Rate">'+
                                '</td>'+


                            '</tr>');

                    }
                }else{
                    const warning = tailwind.Modal.getOrCreateInstance(document.querySelector('#warning_Modal'));
                    warning.show();
                    $('#warning_text').text('This Criteria Does'+"'"+'nt Have Any  Area/s!');

                }


            }
        });
    });

    //onClick Rate Icon
    $("body").on('click','.rate_Icon', function () {
        var applicant = $(this).data('applicant-id');
        var position = $(this).data('position-id');
        var position_type = $(this).data('position-type')
        var applicant_list_id = $(this).data('applicant-list-id')
        var applicant_job_ref = $(this).data('applicant-job-ref')

        $('#applicant_ids').val(applicant);
        $('#position').val(position);
        $('#position_type').val(position_type);
        $('#applicant_list_id').val(applicant_list_id);
        $('#applicant_job_ref').val(applicant_job_ref);

        const rateModal = tailwind.Modal.getOrCreateInstance(document.querySelector('#rateModal'));
        rateModal.show();
        // console.log('applicant: '+applicant+'  Position: '+position+' Position Type: '+position_type);

        showCriteria(position)
    });

    $("body").on('click', '.timer_btn', function(){
        var rate_date = $(this).data('rate-date');
        var row = $(this).closest('tr');
        var p_tag = row.find('p.timer');
        var days_span = time.find('span.timer-days')
        var hour_span = time.find('span.timer-hours')
        var mins_span = time.find('span.timer-mins')
        var secs_span = time.find('span.timer-secs')

        // alert(rate_date)
        // countdouwn_timer(rate_date);
        var endDate = new Date(rate_date).getTime();
    // alert(endDate);
        var timer = setInterval(function() {
            // alert( timer)
    let now = new Date().getTime();
    // alert(now)
    let t = endDate - now;
    
    if (t >= 0) {
    
        let days = Math.floor(t / (1000 * 60 * 60 * 24));
        let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let mins = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        let secs = Math.floor((t % (1000 * 60)) / 1000);
    
        document.getElementById("timer-days").innerHTML = days +
        "<span class='label'> Day(s)</span>";
    
        document.getElementById("timer-hours").innerHTML = ("0"+hours).slice(-2) +
        "<span class='label'> Hr(s)</span>";
    
        document.getElementById("timer-mins").innerHTML = ("0"+mins).slice(-2) +
        "<span class='label'> Min(s)</span>";
    
        document.getElementById("timer-secs").innerHTML = ("0"+secs).slice(-2) +
        "<span class='label'> Sec(s)</span>";
    
    } else {

        document.getElementById(timer).innerHTML = "rating is available";
    
    }
    
}, 1000);

    });
}

function onSubmit(){
     //SAVE AREAS OF CRITERIA
     $('#area_form').submit(function (e) {
        e.preventDefault();
        var pos_id = $('#positioncritPage').val();
        const fd = new FormData(this);

        $.ajax({
            url: '/rating/add-criteria-area',
            method: 'post',
            data: fd,
            cache:false,
            contentType: false,
            processData: false,
            dataType: 'json',

            success: function (r) {
                if(r.status == 200){
                __notif_show( 1," Area/s Save Successfully");
                $('#area_form')[0].reset();
                $('.remove-table-row').parents('tr').remove();
                const mdl = tailwind.Modal.getOrCreateInstance(document.querySelector('#arias_modal'));
                mdl.hide();

                var selected = $('#manageRating_table').find('input.selected-input');
                selected.removeClass('selected-input');

                }
            }
        });

     });

    //SAVE RATINGS
    $('#saveRate_form').submit(function (e) {
            e.preventDefault();
            $('#ops_id').text('');
            var ratessss =   $('#manageRating_table').find('input.rateClass');
            var ffd = ratessss.val() == 0;

                var ff =   $('#manageRating_table').find('div.text-danger').length;
                // var app = $('#applicant').find('selected');
                // var cc =
                // alert(app)
                if( ff != 0)
                {
                    const warning = tailwind.Modal.getOrCreateInstance(document.querySelector('#warning_Modal'));
                    warning.show();
                    $('#warning_text').text('You Can'+"'"+'t rate Above its Maximum Rate!!');

                }
                else{
                    const fd = new FormData(this);
                    $.ajax({
                        url: '/rating/save-rating',
                        method: 'POST',
                        data: fd,
                        cache: false,
                        contentType: false,
                        processData: false,
                        dataType: 'json',
                        success: function (res) {
                            console.log(res);
                            if(res.status == 200){

                                __notif_show( 1,"Applicant Rated Successfully");
                                $('#saveRate_form')[0].reset();
                                const rateModal = tailwind.Modal.getOrCreateInstance(document.querySelector('#rateModal'));
                                rateModal.hide();
                                fetched_rated();
                            }
                        }
                    });
                }

    });

    //SAVE RATED AREA
    $("#ratingarea_form").submit(function (e) {
        e.preventDefault();

       var rates = $('#rateSum').val();
    //    alert(rates);
       var applicantPosition_id = $('#position_id').val();

        var ff =   $('#ratingarea_form').find('a.text-danger').length;

        if( ff != 0){

            $('#errorCacher').addClass('text-danger').text('Unable to Save.!!! You Rated Over its Maximum Rate');

        }else{


            $('#errorCacher').removeClass('text-danger').text('');

            var formdata = new FormData(this);

            $.ajax({
                url: '/rating/store/rated-areas',
                method: 'POST',
                data: formdata,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    if(data.status == 200){

                        __notif_show( 1,"Area rate Save");
                        $('#ratingarea_form')[0].reset();
                        const myModal = tailwind.Modal.getOrCreateInstance(document.querySelector("#ratingArias_modal"));
                        myModal.hide();

                    //     var c_id = $('#criteria_id').val();
                    // // showCriteria(applicantPosition_id);
                    // alert
                    //   var rr =  $('#manageRating_table').find('.criteria-id-classs');
                    //   alert(rr.val());
                    //   var rateValues = rr.closest('tr').find('.rateClass');



                    }
                }
            });
        }
    });


}


function cancel(){
   $("#addCriteriaForm").submit(function (e) {
    e.preventDefault();
    $("#addCriteriaForm")[0].reset();
   });

   $("#editCriteriaForm").submit(function (e) {
    e.preventDefault();
    $("#editCriteriaForm")[0].reset();
   });


   $("body").on('click', '#btn_cancel', function () {
        $('#area_form')[0].reset();
        $('.remove-table-row').parents('tr').remove();
   });

   $("body").on('click', '#cnl_area_rating', function () {
    var sumAll = $('#sumAll').val();
    console.log(sumAll);
    $('#ratingarea_form')[0].reset();

    var selected = $('#manageRating_table').find('input.selected-input');
        selected.val(sumAll);
        selected.removeClass('selected-input');


        $('#sumOf_rate').removeClass('text-danger');
        $('#sumOf_rate').text("");
   });

   $("body").on('click', '#cnl_rate_modal', function () {
    $('#saveRate_form')[0].reset();
    $('#foot_maxrating').text('0%');
    $('#foot_totalrate').text('0%');
});

   dropdown();
}

function dropdown()
{

    $('#positioncritPage').select2({
        placeholder: "Select Position Category",
        closeOnSelect: true,
        allowClear: true
    });


    $('#position1').select2({
        placeholder: "Select Position Category",
        closeOnSelect: true,

    });
    $('#applicant').select2({
        placeholder: "Select Applicant",
        closeOnSelect: true,

    });

    $('#position_cat').select2({
        placeholder: "Select Position",
        closeOnSelect: true,

    });






}
    //////////////////////////////

function fetched_rated(){
    $.ajax({
        url: '/rating/filter-rated-applicants',
        type: "get",
        data: {
        _token: _token,
        },
        success: function (response) {
            $('#tbl_applicant_rated_div').html(response);

            $('#tbl_applicant_rated').DataTable({
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
                "aLengthMenu": [[5,10,25,50,100,150,200,250,300,-1], [5,10,25,50,100,150,200,250,300,"All"]],
                "iDisplayLength": 5,
                "aaSorting": [],

                order: [0, 'desc']

            });
        }
    });

}

function loadTables(){

    tbl_applicant_rated = $('#tbl_applicant_rated').DataTable({
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
                            "aLengthMenu": [[5,10,25,50,100,150,200,250,300,-1], [5,10,25,50,100,150,200,250,300,"All"]],
                            "iDisplayLength": 5,
                            "aaSorting": [],

                            order: [0, 'desc']

                        });

    rating_table =  $('#manageRating_table').DataTable({
                        dom: 'lrt',
                        renderer: 'bootstrap',
                        "info": false,
                        "bInfo":true,
                        "bJQueryUI": true,
                        "bProcessing": true,
                        "bPaginate" : false,
                        "aaSorting": [],

                        order: [0, 'desc'],

                    });
}

function onChange(){

    $('#position1').change(function (e) {
        e.preventDefault();
        var id = $(this).val();
        // alert(id)


        $.ajax({
            url: '/rating/filter-by-position/'+id,
            type: "get",
            data: {
                _token: _token,
            },
            success: function(data) {

                rating_table.clear().draw();
				/***/
				var data = JSON.parse(data);

				if(data.length > 0) {
					for(var i=0;i<data.length;i++) {
							/***/

                            var criteria_id = data[i]['id'];
                            var criteria = data[i]['criteria'];
                            var positionID = data[i]['positionID'];
                            var maxrate = data[i]['maxrate'];

                            var cd = "";
							/***/

								cd = '' +

						                    '<td class="group_member_id">' +
                                                '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                    '<a href="" class="font-medium">'+criteria+'</a>'+
                                                    '<div class="text-slate-500 text-xs mt-0.5">Software Engineer</div>'+
                                                '</div>'+

						                    '</td>' +

                                            '<td>' +
                                                '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                    '<div class="text-slate-500 text-xs mt-0.5">Maximum Rating</div>'+
                                                    '<a href="" class="font-medium">'+maxrate+'%</a>'+
                                                '</div>'+
						                    '</td>' +


                                            '<td>' +
                                                '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                    '<div class="text-slate-500 text-xs mt-0.5">Your Rating</div>'+
                                                    '<input id="criteriaID" name="criteriaID[]" value="'+criteria_id+'" type="hidden">'+
                                                    '<input id="rate" name="rate[]" type="text">'+
                                                '</div>'+
						                    '</td>' +



						                '</tr>' +
								'';

								rating_table.row.add($(cd)).draw();


							/***/

					}

				}



            }
        });

    });

    $('#positioncritPage').change(function (e) {
        e.preventDefault();
        var id = $(this).val();
        fetchedCriteria(id);

    });


    $('#applicant').change(function (e) {
        e.preventDefault();
        var applicant_id = $(this).val();
        showPosition(applicant_id)
        // alert(appID)
    });

}

function showPosition(applicant_id){

    $.ajax({
        url: '/rating/filter-position-applicant/'+applicant_id,
        type: "get",
        data: {
            _token: _token,
        },
        success: function(data){
            /***/
            $('#positionApplied_div').html(data);

             $('#ApplicantPosition_select').select2();

                $('#ApplicantPosition_select').change(function (e) {
                    e.preventDefault();

                    // alert('potaaaa')

                    var applicantPosition_id = $(this).val();

                    // alert(appl_id)
                    showCriteria(applicantPosition_id);



                });

            }
    });
}

function showCriteria(applicantPosition_id){
    // var applicantid = $('#applicant').val();
    // var position = $('#applicant_ids').val(applicant);
    // var applicant = $('#position').val(position);
    // var applicant = $('#position_type').val(position_type);
    var applicant = $('#applicant_ids').val();

    // alert(applicantid);
    $.ajax({
        url: '/rating/filter-by-position/'+applicantPosition_id,
        type: "get",
        data: {
            _token: _token,applicantid:applicant,
        },
        success: function(data) {
            // console.log(data);
            rating_table.clear().draw();
            /***/
            var data = JSON.parse(data);


            if(data.length > 0) {


                for(var i=0;i<data.length;i++) {
                        /***/

                        var criteria_id = data[i]['id'];
                        var criteria = data[i]['criteria'];
                        var positionID = data[i]['positionID'];
                        var maxrate = data[i]['maxrate'];
                        var p_category = data[i]['p_category'];
                        var p_categoryID = data[i]['p_categoryID'];
                        var totalMax_rate = data[i]['totalMax_rate'];
                        var areaSum = data[i]['areaSum'];
                        var area_sum_all = data[i]['area_sum_all'];


                        $('#foot_maxrating').text(totalMax_rate+'%')
                        $('#p_category').val(p_category);
                        $('#p_categoryID').val(p_categoryID);
                        $('#foot_totalrate').text(area_sum_all+'%');

                        if(totalMax_rate > 100){
                            $('#overrate').text('The rating is Over');
                        }



                        var cd = "";

                        /***/

                            cd = '' +
                                    '<tr >' +

                                        '<td class="group_member_id">' +
                                            '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                '<a href="javascript:;" class="font-medium">'+criteria+'</a>'+

                                            '</div>'+

                                        '</td>' +

                                        '<td>' +
                                            '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                '<div class="text-slate-500 text-xs mt-0.5">Maximum Rating</div>'+
                                                '<input id="maxratehidden" value="'+maxrate+'" type="hidden">'+
                                                '<label>'+maxrate+'</label>'+
                                                '%'+
                                            '</div>'+
                                        '</td>' +

                                        '<td>' +
                                            '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                '<a id="'+criteria_id+'" data-criteria-name="'+
                                                        criteria+'" data-max-rate="'+
                                                        maxrate+'" href="javascript:;"'+
                                                    'class="underline decoration-dotted underline-offset-4 text-primary dark:text-slate-400 cursor-pointer rating_area">'+
                                                    'Areas'+
                                                '</a>'+

                                            '</div>'+
                                        '</td>' +

                                        '<td>' +
                                            '<div class="lg:ml-2 lg:mr-auto text-center lg:text-left mt-3 lg:mt-0">'+
                                                '<div id="rateLabel" class="text-slate-500 text-xs mt-0.5">Your Rating</div>'+
                                                '<input class="criteria-id-classs" id="criteriaID" name="criteriaID[]" value="'+criteria_id+'" type="hidden">'+
                                                '<input id="rate" name="rate[]" value="'+areaSum+'" class="rateClass" maxlength="3" size="1" type="text" required>%'+

                                            '</div>'+
                                        '</td>' +

                                    '</tr>' +
                            '';

                            rating_table.row.add($(cd)).draw();


                        /***/

                }

                $('#tfoot_id').show();
                $('#remarks_div').show();
                $('#saveRate_btn').show();
                // count_ratingTable();
            }else{
            $('#tfoot_id').hide();
            $('#remarks_div').hide();
            $('#saveRate_btn').hide();
            }

        }
    });
}

function refresh(){
    $("body").on('click', '#refresh', function () {
        fetchedCriteria();

            $('.select2-selection__clear').remove();

            $('#positioncritPage').select2({
                placeholder: "Select Position Category",
                closeOnSelect: true,
                allowClear: true
            });


    });
}

function manageRating_Validation(){

  $("#manageRating_table").on('change', 'input', function () {

        var _thisTr = $(this).closest('tr');
        var maxrating = _thisTr.find('td #maxratehidden');

        var _thisMax = maxrating.val();
        var _thisVaue = $(this).val();
        var _ratingLabel = _thisTr.find('td #rateLabel');


        if(_thisVaue <= _thisMax){

            $(this).css('border-color', '');
            _ratingLabel.text('Your Rating').removeClass('text-danger');

        }
        else if(_thisVaue > _thisMax){
            $(this).css('border-color', '#Ff696c');
            _ratingLabel.text('Your Rating must not Exceed the Maximum rate').addClass('text-danger');
        }




    });
}


function sum_rate(){
    // CRITERIA RATE SUM
    $("#manageRating_table").on('input', '.rateClass', function () {
        var calculated_total_sum = 0;

            $("#manageRating_table .rateClass").each(function () {
                var get_textbox_value = $(this).val();
                if ($.isNumeric(get_textbox_value)) {
                calculated_total_sum += parseFloat(get_textbox_value);
                }
             });

               $("#foot_totalrate").text(calculated_total_sum+'%');
        });



        // ARIA RATE SUM
        $("#ratingArea_table").on('input', '.areaClass', function () {
            var area_total_sum = 0;


            $("#ratingArea_table .areaClass").each(function () {
                var get_textbox_value = $(this).val();
                if ($.isNumeric(get_textbox_value)) {
                    area_total_sum += parseFloat(get_textbox_value);
                   }
                 });


                   $("#sumOf_rate").text(area_total_sum+'%');
                   $("#rateSum").val(area_total_sum);

                   if(area_total_sum > $('#maximumrate').val()){
                        $('#sumOf_rate').addClass('text-danger');
                   }
                   else{
                    $('#sumOf_rate').removeClass('text-danger');
                   }
                  var selected = $('#manageRating_table').find('input.selected-input');
                  selected.val(area_total_sum);

            });
}

function countdouwn_timer(rateDate){

    var endDate = new Date(rateDate).getTime();
    // alert(endDate);
var timer = setInterval(function() {

    let now = new Date().getTime();
    let t = endDate - now;
    
    if (t >= 0) {
    
        let days = Math.floor(t / (1000 * 60 * 60 * 24));
        let hours = Math.floor((t % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        let mins = Math.floor((t % (1000 * 60 * 60)) / (1000 * 60));
        let secs = Math.floor((t % (1000 * 60)) / 1000);
    
        document.getElementById("timer-days").innerHTML = days +
        "<span class='label'> Day(s)</span>";
    
        document.getElementById("timer-hours").innerHTML = ("0"+hours).slice(-2) +
        "<span class='label'> Hr(s)</span>";
    
        document.getElementById("timer-mins").innerHTML = ("0"+mins).slice(-2) +
        "<span class='label'> Min(s)</span>";
    
        document.getElementById("timer-secs").innerHTML = ("0"+secs).slice(-2) +
        "<span class='label'> Sec(s)</span>";
    
    } else {

        document.getElementById(timer).innerHTML = "The countdown is over!";
    
    }
    
}, 1000);
}



