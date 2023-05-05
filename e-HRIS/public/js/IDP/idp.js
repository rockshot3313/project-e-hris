var  _token = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){

    bpath = __basepath + "/";

    load_Idp_select2();
    trigger_employee();
});


function load_Idp_select2()
{
    $('#emp_name').select2({
        placeholder: "Select employee name",
        closeOnSelect: true,
    });
}

function trigger_employee()
{
    $("#emp_name").on('change',function(){
        let id = $(this).val();
        get_designation_position(id)
    });
}

function get_designation_position(id)
{
    $.ajax({
        type: "POST",
        url: bpath = "/IDP/get-pos",
        data: {_token,id},
        dataType: "json",

        success:function(response)
        {

        },
        error: function(xhr, status, error) {
            console.log("Error in ajax: " + status + "\nError: " + error + "\nError detail: " + xhr.responseText);
        } ,
    });
}


