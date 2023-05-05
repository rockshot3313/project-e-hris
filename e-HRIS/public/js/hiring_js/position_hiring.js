var  _token = $('meta[name="csrf-token"]').attr('content');
var filter = $("#filter_status").val();
const myAccordion3 = tailwind.Accordion.getOrCreateInstance(document.querySelector("#faq-accordion-3"));

$(document).ready(function(){

    bpath = __basepath + "/";

    load_select2();
    add_position();
    cancel_modal();
    check_text_length_remarks();
    // check_text_length_doc();
    check_text_length_competency();
    //Added by Montz
    add_document_requirements();
    change_table_border_color();
    //trigger the select2 step
    trigger_salary();
    myAccordion3.hide();
});

//show notification ===============================================================================================
function notification(message)
{
    __notif_show(1,message);
    const hiring_modal = tailwind.Modal.getOrCreateInstance(document.querySelector('#new_hiring_modal'));
    hiring_modal.hide();
}

// load the select2 ===============================================================================================
function load_select2()
{
    $('#position_title').select2({
        placeholder: "Select position title",
        closeOnSelect: true,
    });

    $('#salarygrade').select2({
        placeholder: "Select salary grade",
        closeOnSelect: true,
    });

    $('#position_type').select2({
        placeholder: "Select type of position",
        closeOnSelect: true,
    });

    $('#ratees').select2({
        placeholder: "Select list of panel",
        closeOnSelect: true,
    });

    $('#filter_status').select2({
        placeholder: "Select display position",
        closeOnSelect: true,
    });

    $('#hrmo_head').select2({
        placeholder: "Select the head of the HRMO",
        closeOnSelect: true,
    });

    $('#competency').select2({
        placeholder: "Select list of competencies",
        closeOnSelect: true,
    });

    $('#step').select2({
        placeholder: "Select step",
        closeOnSelect: true,
    });

    $('#tranche').select2({
        placeholder: "Select tranche",
        closeOnSelect: true,
    });

}

// validate the user input =================================================================================================================

    function assignment()
    {
        if ($("#assign").val().trim()!="")
        {
            $("#assign").css('border-color', '');
            return true;
        } else{
            $("#assign").css('border-color', '#ff0000');
            return false;
        }
    }

    // function salary()
    // {
    //         if ($("#monthly_salary").val().trim()!=" ")
    //         {
    //             $("#monthly_salary").css('border-color', '');
    //             return true;
    //         } else{
    //             $("#monthly_salary").css('border-color', '#ff0000');
    //             return false;
    //         }
    // }

    function check_salary()
    {
        if ($("#monthly_salary").val().trim()!="")
        {
            $("#monthly_salary").css('border-color', '');
            return true;
        } else{
            $("#monthly_salary").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_item_no()
    {
        if ($("#item_no").val().trim()!="")
        {
            $("#item_no").css('border-color', '');
            return true;
        } else{
            $("#item_no").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_eligibilty()
    {
        if ($("#eligibility").val().trim()!="")
        {
            $("#eligibility").css('border-color', '');
            return true;
        } else{
            $("#eligibility").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_training()
    {
        if ($("#training").val().trim()!="")
        {
            $("#training").css('border-color', '');
            return true;
        } else{
            $("#training").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_workex()
    {
        if ($("#work_ex").val().trim()!="")
        {
            $("#work_ex").css('border-color', '');
            return true;
        } else{
            $("#work_ex").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_entrydate()
    {
        if ($("#date_entry").val().trim()!="")
        {
            $("#date_entry").css('border-color', '');
            return true;
        } else{
            $("#date_entry").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_remarks()
    {
        if ($("#remarks").val().trim()!="")
        {
            $("#remarks").css('border-color', '');
            return true;
        } else{
            $("#remarks").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_doc()
    {
        // if ($("#doc_req").val().trim()!="")
        // {
        //     $("#doc_req").css('border-color', '');
        //     return true;
        // } else{
        //     $("#doc_req").css('border-color', '#ff0000');
        //     return false;
        // }
        return true;
    }


    //validattion for drop down
    function check_position()
    {
        if($("#position_title").val().trim() != "")
        {
            $('#position_title').select2({
                placeholder: "Select Position title",
                closeOnSelect: true,
            });
            return true;
        } else{

            $('#position_title').select2({
                theme: "error",
                placeholder: "This field is required",
            });

            return false;
        }
    }

    function check_salarygrade()
    {
        if($("#salarygrade").val().trim()!= "")
        {
            $('#salarygrade').select2({
                placeholder: "Select Select Salary grade",
                closeOnSelect: true,
            });
            return true;
        }
         else{

            $('#salarygrade').select2({
                theme: "error",
                placeholder: "This field is required",
            });
            return false;
        }
    }

    function check_education()
    {
        if($("#education").val().trim() != "")
        {
            $("#education").css('border-color', '');
            return true;
        } else{
            $("#education").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_email_address()
    {
        if($("#email_address").val().trim() != "")
        {
            $("#email_address").css('border-color', '');
            return true;
        } else{
            $("#email_address").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_address()
    {
        if($("#address").val().trim() != "")
        {
            $("#address").css('border-color', '');
            return true;
        } else{
            $("#address").css('border-color', '#ff0000');
            return false;
        }
    }

    function check_pos_type()
    {
        if($("#position_type").val().trim() != "")
        {
            $('#position_type').select2({
                placeholder: "Select Position type",
                closeOnSelect: true,
            });
            return true;
        } else{

            $('#position_type').select2({
                theme: "error",
                placeholder: "This field is required",
            });

            return false;
        }
    }

    function check_competency()
    {
        if ($("#competency").val() !="")
        {
            $('#competency').select2({
                placeholder: "Select list of competencies",
                closeOnSelect: true,
            });
            return true;
        } else{
                $('#competency').select2({
                theme: "error",
                placeholder: "This field is required",
            });
            return false;
        }
    }

    function check_hrmo()
    {
        if($("#hrmo_head").val()!= "")
        {
            $('#hrmo_head').select2({
                placeholder: "Select the head of the HRMO",
                closeOnSelect: true,
            });
            return true;
        } else{

            $('#hrmo_head').select2({
                theme: "error",
                placeholder: "This field is required",
            });

            return false;
        }
    }

    // function check_panels()
    // {
    //     if($("#ratees").val() != "")
    //     {
    //         $('#ratees').select2({
    //             placeholder: "Select Panel",
    //             closeOnSelect: true,
    //         });
    //         return true;
    //     } else{

    //         $('#ratees').select2-multiple({
    //             theme: "error",
    //             placeholder: "Select Panel is required",
    //         });

    //         return false;
    //     }
    // }

//check the lenght of the  text description
function check_text_length_remarks()
{
        $("#remarks").keyup(function(event){
            let text = $(this).val().length;
            $("#text_remark").text(text);

            if(text > 1000)
            {
                $("#remarks").css('border-color', ' #ff0000');

            } else if(text <= 1000){
                $("#remarks").css('border-color', '');

            } else if(text == 0){
                $("#remarks").css('border-color', '');

            }
        });
}

// function check_text_length_doc()
// {
//         $("#doc_req").keyup(function(event){
//             let text = $(this).val().length;
//             $("#text_doc").text(text);
//             if(text > 500)
//             {
//                 $("#doc_req").css('border-color', ' #ff0000');

//             } else if(text <= 500){
//                 $("#doc_req").css('border-color', '');

//             } else if(text == 0){
//                 $("#doc_req").css('border-color', '');

//             }
//         });
// }

function check_text_length_competency()
{
        $("#competency_details").keyup(function(event){
            let text = $(this).val().length;
            $("#text_competency").text(text);
            if(text > 1000)
            {
                $("#competency_details").css('border-color', ' #ff0000');

            } else if(text <= 1000){
                $("#competency_details").css('border-color', '');

            } else if(text == 0){
                $("#competency_details").css('border-color', '');
            }
        });
}

// //function check length
// function check_length()
// {
//     let remarks = $("#remarks").val(),
//         doc_req = $("#doc_req").val(),
//         competency = $("#competency").val();
//
//     if(remarks.length>500)
//     {
//         $("#remarks").css('border-color', ' #ff0000');
//         return false;
//     } else if (doc_req.length>500){
//         $("#doc_req").css('border-color', ' #ff0000');
//         return false;
//     } else if(competency.length>500)
//     {
//         $("#competency").css('border-color', ' #ff0000');
//         return false;
//     }
//     else{
//         $("#remarks").css('border-color', '');
//         $("#doc_req").css('border-color', '');
//         return true;
//     }
// }

//function check length
function check_length()
{
    let remarks = $("#remarks").val(),
        doc_req = $("#doc_req").val(),
        competency = $("#competency_details").val();

    if(remarks.length > 1000)
    {
        $("#remarks").css('border-color', ' #ff0000');
        return false;
    } else if(competency.length > 1000)
    {
        $("#competency_details").css('border-color', ' #ff0000');
        return false;
    }
    else{
        $("#remarks").css('border-color', '');
        $("#doc_req").css('border-color', '');
        return true;
    }
}





// checking of the input fields ===================================================================================================================================
 function add_position()
{
    $("#btn_save_position").on("click",function(){

        if(assignment())
        {
            if(check_position())
            {
                if(check_salarygrade())
                {
                    if(check_salary())
                    {
                        if(check_item_no())
                        {
                            if(check_eligibilty())
                            {
                                if(check_education())
                                {
                                    if(check_training())
                                    {
                                        if(check_workex())
                                        {
                                            if(check_pos_type())
                                            {
                                                if( check_entrydate())
                                                {
                                                    if(check_competency())
                                                    {
                                                        if(check_remarks())
                                                        {
                                                            if(check_doc())
                                                            {
                                                                if(check_length())
                                                                {
                                                                    if(count_row())
                                                                    {
                                                                        if(check_table_input())
                                                                        {
                                                                            if(check_email_address())
                                                                            {
                                                                                if(check_address())
                                                                                {
                                                                                    if(check_hrmo())
                                                                                    {
                                                                                        if(btn_text.innerText == "Save")
                                                                                        {
                                                                                            save_hiring_position();
                                                                                        } else
                                                                                        {
                                                                                            update_data();
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }

                            }
                        }
                    }
                }
            }

        }

    });
}

//close the modal and remove the red border
function cancel_modal()
{
    $("#btn_cancel_position").on('click',function(){
        btn_text.innerText = "Save";
        $("#pisition_form")[0].reset();
        load_select2();
        $("#assign").css('border-color', '');
        $("#monthly_salary").css('border-color', '');
        $("#item_no").css('border-color', '');
        $("#eligibility").css('border-color', '');
        $("#training").css('border-color', '');
        $("#work_ex").css('border-color', '');
        $("#competency").css('border-color', '');
        $("#date_entry").css('border-color', '');
        $("#remarks").css('border-color', '');
        $("#doc_req").css('border-color', '');
        $("#email_address").css('border-color', '');
        $("#address").css('border-color', '');
         //remove the append td
         $("#dt_job_documents td").remove();
         $('#dt_job_documents tbody tr').detach();
         myAccordion3.hide();
    });
}

// saved the data for position hiring ===================================================================================================================================

// function save_hiring_position()
// {
//     //Document Requirements
//     let td_doc_requirement = [];
//     $('input[name="td_doc_requirement[]"]').each(function (i, _doc_requirement) {
//         if(!$(_doc_requirement).val() == "")
//         {
//             td_doc_requirement[i] = $(_doc_requirement).val();
//         }
//     });
//
//
//     let assign = $("#assign").val(),
//         position_title = $("#position_title").val(),
//         salarygrade = $("#salarygrade").val(),
//         monthly_salary = $("#monthly_salary").val(),
//         item_no = $("#item_no").val(),
//         eligibility = $("#eligibility").val(),
//         education = $("#education").val(),
//         training = $("#training").val(),
//         work_ex = $("#work_ex").val(),
//         competency = $("#competency").val(),
//         position_type = $("#position_type").val(),
//         date_entry = $("#date_entry").val(),
//         ratees = $("#ratees").val(),
//         remarks = $("#remarks").val(),
//         doc_req = $("#doc_req").val();
//
//         //split the date
//         const split_from = date_entry.split("-");
//         console.log(doc_req);
//
//         console.log(assignment(assign));
//
//           $.ajax({
//
//                 type: "POST",
//                 url: bpath = "/hiring/save-position",
//                 data:{assign:assign,
//                     position_title:position_title,
//                     salarygrade:salarygrade,
//                     monthly_salary:monthly_salary,
//                     item_no:item_no,
//                     eligibility:eligibility,
//                     education:education,
//                     training:training,
//                     work_ex:work_ex,
//                     competency:competency,
//                     position_type:position_type,
//                     post_date:split_from[0],
//                     close_date:split_from[1],
//                     ratees:ratees,
//                     remarks:remarks,
//                     doc_req:doc_req,
//                     _token:_token},
//                 dataType: "json",
//
//                 success:function(response)
//                 {
//                     if(response.status == true)
//                     {
//                         notification(response.message);
//                         // $("#pisition_form")[0].reset();
//                         load_select2();
//                         filter = 1;
//                         $("#filter_status").val(filter).trigger("change");
//                         display_hiring_position(filter);
//                     }
//                 },
//                 error: function(xhr, status, error) {
//                     console.log("Error in ajax: " + status + "\nError: " + error + "\nError detail: " + xhr.responseText);
//                          } ,
//             });
// }


function save_hiring_position() {

    //Document Requirements
    let td_doc_requirement = [],td_doc_requirement_type = [];

    $('input[name="td_doc_requirement[]"]').each(function (i, _doc_requirement) {
        if(!$(_doc_requirement).val() == "")
        {
            td_doc_requirement[i] = $(_doc_requirement).val();
        }
    });

    $('input[name="td_doc_requirement_type[]"]').each(function (i, _doc_requirement_type) {
        if(!$(_doc_requirement_type).val() == "")
        {
            td_doc_requirement_type[i] = $(_doc_requirement_type).val();
        }
    });

    console.log(td_doc_requirement_type);

    let assign = $("#assign").val(),
        position_title = $("#position_title").val(),
        salarygrade = $("#salarygrade").val(),
        monthly_salary = $("#monthly_salary").val(),
        item_no = $("#item_no").val(),
        eligibility = $("#eligibility").val(),
        education = $("#education").val(),
        training = $("#training").val(),
        work_ex = $("#work_ex").val(),
        competency = $("#competency").val(),
        position_type = $("#position_type").val(),
        date_entry = $("#date_entry").val(),
        ratees = $("#ratees").val(),
        remarks = $("#remarks").val(),
        hrmo = $("#hrmo_head").val(),
        email_ad = $("#email_address").val(),
        address = $("#address").val();
        step = $("#step").val();

    //split the date
    const split_from = date_entry.split("-");

    $.ajax({

        type: "POST",
        url: bpath = "/hiring/save-position",
        data:{assign:assign,
            position_title:position_title,
            salarygrade:salarygrade,
            monthly_salary:monthly_salary,
            item_no:item_no,
            eligibility:eligibility,
            education:education,
            training:training,
            work_ex:work_ex,
            competency:competency,
            position_type:position_type,
            hrmo:hrmo,
            post_date:split_from[0],
            close_date:split_from[1],
            ratees:ratees,
            remarks:remarks,
            td_doc_requirement,
            td_doc_requirement_type,
            email_ad,
            step,
            address,
            _token:_token},
        dataType: "json",

        success:function(response)
        {
            if(response.status == true)
            {
                notification(response.message);
                $("#pisition_form")[0].reset();
                load_select2();
                filter = 13;
                $("#filter_status").val(filter).trigger("change");
                display_hiring_position(filter);
                //remove the append td
                $('#dt_job_documents tbody tr').detach();
                myAccordion3.hide();
            }
        },
        error: function(xhr, status, error) {
            console.log("Error in ajax: " + status + "\nError: " + error + "\nError detail: " + xhr.responseText);
        } ,
    });
}




//get the salary based on the step
function get_monthly_salary(sg,step)
{
    console.log(sg,step);
    $.ajax({
        type: "POST",
        url: bpath = "/hiring/get-salaries",
        data: {_token,sg,step},
        dataType: "json",

        success:function(response)
        {
            if(response.status == true)
            {
                let get_salary = JSON.stringify(response.message).slice(10).replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
                console.log(get_salary);
                $("#monthly_salary").val(get_salary);

            }

        }
    });
}
//trigger the select 2 to get the salary
function trigger_salary()
{
    $("#step").on('select2:select',function()
    {
        let sg = $("#salarygrade").val(),
            step = $("#step").val();

            get_monthly_salary(sg,step);
    });
}


//Added by MONTZ
function add_document_requirements(){

    $("body").on('click', '#add_document_requirements', function (){
        add_row_work_exp();
    });

    $('#dt_job_documents tbody').on('click','.delete',function(){
        $(this).parent().parent().parent().remove();

    });
}

function add_row_work_exp(){

    var tr=
        '<tr class="hover:bg-gray-200">'+
            '<td style="width:"><input  id="doc_requirement_input" name="td_doc_requirement[]" type="text" class="form-control" placeholder="Document requirements"></td>'+
            '<td style="width:"><input  id="doc_requirement_type_input" name="td_doc_requirement_type[]" type="text" class="form-control" placeholder="Type of document requirements"></td>'+
            '<td style="width: 10%">' +
                '<div class="flex justify-center items-center">' +
                '<a href="javascript:void(0);" class="delete text-center"><i  class="w-4 h-4 text-danger fa-solid fa-trash"></i></a>' +
                '</div>'+
            '</td>'+
        '</tr>';

    $('#dt_job_documents tbody').append(tr);
};

//count the row and check if there are no row available
function count_row()
{
    row = $("#dt_job_documents tr").length;

    if(row=='')
    {
        __notif_show(-1,"Please fill up the documents requirements");
        return false;
    }

    return true;

}

//check if the table input is not empty
function change_table_border_color()
{
    try{

        $("#dt_job_documents").on("change","input", function(){

            let $doc_req_input = $(this).closest('tr').find('td #doc_requirement_input'),
                $doc_type = $(this).closest('tr').find('td #doc_requirement_type_input');

            //check the document input
            $doc_req_input.each(function() {
               if( $(this).val().trim() == '' )
               {
                    $(this).css('border-color', ' #ff0000');

               } else if($(this).val().trim() != ''){

                    $(this).css('border-color', '');
               }
            });

             //check the document type
            $doc_type.each(function() {
                if( $(this).val().trim() == ''){

                    $(this).css('border-color', '#ff0000');

                } else if ($(this).val().trim() !=''){

                    $(this).css('border-color', '');
                }
             });
        });

    }catch(error)
    {
       console.log(error);
    }
}

function check_table_input()
{
    let last = $("#dt_job_documents").find('tr');

      var emptyInputs = last.find("input").filter(function() {
        return this.value === "";
      });

        if ( emptyInputs.length != 0) {

            return false;
          } else {
            return true;
         }
}







