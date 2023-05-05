
var  _token = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function () {

    _thisSelect();
    onChange_function();
    fetched_rated_applicants();
    _onClick_function();

});
function _thisSelect(){
    $('#pos_cat').select2({
        placeholder: "Select Position Category",
        closeOnSelect: true,

    });
}

function onChange_function(){
    $("body").on('change', '#pos_cat', function () {
        var post_typeID = $(this).val();
        fetched_rated_applicants(post_typeID)
    });
}
function _onClick_function(){

    $("body").on('click', '#raterStatus', function () {
        var job_ref = $(this).data('job-ref');
        var applicant_id = $(this).data('applicant-id');
        var position_id = $(this).data('position-id');
        const raterStatus_modal = tailwind.Modal.getOrCreateInstance(document.querySelector('#raterStatus_modal'));
        raterStatus_modal.show();

        $.ajax({
            url: '/rating/rater-details',
            method: 'get',
            data: {_token:_token, job_ref:job_ref, applicant_id:applicant_id, position_id:position_id},
            success: function (response) {
                $('#raterDetail_div').html(response);
            }
        });

    });

    $("body").on('click', '.ratedDetails', function () {
        // alert('123')
        var job_ref = $(this).data('job-ref');
        var applicant_id = $(this).data('applicant-id');
        var position_id = $(this).data('position-id');
        var position_type = $(this).data('position-type');
        const detail_modal = tailwind.Modal.getOrCreateInstance(document.querySelector('#SummaryDetail_Modal'));
        detail_modal.show();

        $.ajax({
            url: '/rating/summary-details',
            method: 'get',
            data: {_token:_token, job_ref:job_ref, applicant_id:applicant_id, position_id:position_id, position_type:position_type},
            success: function (response) {
                $('#summary_detail_div').html(response);
            }
        });

    });
}
function fetched_rated_applicants(post_typeID){

    $.ajax({
        url: '/rating/fetched/rated-applicant/'+post_typeID,
        type: "get",
        data: {
            _token: _token,
        },
        success: function(data) {

            $('#summary_div').html(data);
            $('#tbl_summary').DataTable();

        }
    });
}
