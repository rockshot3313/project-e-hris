var  _token = $('meta[name="csrf-token"]').attr('content');
var base_url = window.location.origin;
var doc_file_id;

$(document).ready(function (){

    bpath = __basepath + "/";

    // load_top_bar_profile();

});

// function load_top_bar_profile(){
//
//     $.ajax({
//         url: bpath + 'my/load/profile',
//         type: "POST",
//         data: { _token, },
//         success: function(response) {
//
//             var data = JSON.parse(response);
//             // console.log(data);
//
//             if(data.length > 0) {
//                 for (var i = 0; i < data.length; i++) {
//
//                     let last_name = data[i]['last_name'];
//                     let first_name = data[i]['first_name'];
//                     let mid_name = data[i]['mid_name'];
//                     let position = data[i]['position'];
//                     let profile_pic = data[i]['profile_pic'];
//
//                     let hmtl_data = '<img alt="Relax" class="rounded-full" src="'+profile_pic+'">';
//                     $('#top_bar_profile').html(hmtl_data);
//                 }
//             }
//         }
//     });
// }

// $("body").on('click', '#btn_openDocument_Notification', function (){
//
//     let notif_type = $(this).data('notif-type');
//     let full_name = $(this).data('fullname');
//     let notif_title = $(this).data('notif-title');
//     let notif_content = $(this).data('notif-content');
//     let date_created = $(this).data('date-created');
//     let notif_id = $(this).data('notif-id');
//
//     loadNotificationDetails(notif_type, notif_title, notif_content, full_name, date_created);
//
//     $.ajax({
//         url: bpath + 'notification/details/load',
//         type: "POST",
//         data: {
//             _token: _token,
//             notif_id:notif_id,
//         },
//         success: function(response) {
//
//             // var data = JSON.parse(response);
//             $('.__notification').load(location.href+' .__notification');
//
//
//         }
//     });
//
// });
//
// $("body").on('click', '#btn_openGroup_Notification', function (){
//
//     let notif_type = $(this).data('notif-type');
//     let full_name = $(this).data('fullname');
//     let notif_title = $(this).data('notif-title');
//     let notif_content = $(this).data('notif-content');
//     let date_created = $(this).data('date-created');
//     let notif_id = $(this).data('notif-id');
//
//     loadNotificationDetails(notif_type, notif_title, notif_content, full_name, date_created);
//
//     $.ajax({
//         url: bpath + 'notification/details/load',
//         type: "POST",
//         data: {
//             _token: _token,
//             notif_id:notif_id,
//         },
//         success: function(response) {
//
//             // var data = JSON.parse(response);
//
//         }
//     });
//
// });

// function loadNotificationDetails(notif_type, notif_title, notif_content, full_name, date_created){
//
//     let notification_Details = '';
//     let confirm_Button = '';
//     let pre_confirm = true;
//
//     if (notif_type == "document")
//     {
//         confirm_Button +=
//             "Open <span class='ml-2 fa fa-arrow-circle-right'></span>"
//
//     }else {
//         pre_confirm = false;
//     }
//
//     notification_Details +=
//         "<div class='flex justify-start items-center mt-3'> <i class='w-4 h-4 fa fa-clipboard text-slate-500 mr-2'></i>  <span class='font-medium whitespace-nowrap ml-1'>"+ notif_title +"</span></div>" +
//         "<div class='flex justify-start items-center mt-3'> <i class='w-4 h-4 fa fa-user text-slate-500 mr-2'></i><span class='ml-1'>"+ full_name +"</span></div>" +
//         "<div class='flex justify-start items-center mt-3'> <i class='w-4 h-4 fa fa-clock text-slate-500 mr-2'></i><span class='ml-1'>"+ date_created +"</span></div>" +
//         "<div class='flex justify-start mt-3'> <i class='w-4 h-4 fa fa-message text-slate-500 mt-1 mr-2'></i><span style='text-align: left' class='ml-1'>"+ notif_content +"</span></div>"
//
//
//     // notification_Details +=
//     //     "<div class='flex justify-start items-center mt-3'> <i class='w-4 h-4 fa fa-clipboard text-slate-500 mr-2'></i>  <span class='font-medium whitespace-nowrap ml-1'>"+ data['notification_subject'] +"</span></div>" +
//     //     "<div class='flex justify-start items-center mt-3'> <i class='w-4 h-4 fa fa-user text-slate-500 mr-2'></i><span class='ml-1'>"+full_name+"</span></div>" +
//     //     "<div class='flex justify-start items-center mt-3'> <i class='w-4 h-4 fa fa-clock text-slate-500 mr-2'></i><span class='ml-1'>"+data['notification_created']+"</span></div>" +
//     //     "<div class='flex justify-start mt-3'> <i class='w-4 h-4 fa fa-message text-slate-500 mt-1'></i><span class='flex justify-start items-center'>"+data['notification_content']+"</span></div>"
//
//     swal({
//         title: 'Notification Details ',
//         type: 'info',
//         allowOutsideClick: false,
//         allowEscapeKey: false,
//         showCloseButton: true,
//         showConfirmButton: pre_confirm,
//         confirmButtonText: '<div>'+confirm_Button+'</div>',
//         confirmButtonColor: '#1e40af',
//         timer: 6000,
//         // footer: '<div>'+confirm_Button+'</div>',
//         html:
//             '<div class="rounded-md p-5">' +
//             '   <div class="flex items-center border-b border-slate-200/60 dark:border-darkmode-400 pb-5 mb-5"></div>' +
//                     notification_Details +
//             '</div>',
//     }).then((result) => {
//         console.log(result);
//         if (result.value == true) {
//             //Action
//             action(notif_type);
//         }
//     });
// }
//
// function action(notif_type) {
//     if (notif_type == "document")
//     {
//         window.location.href = base_url + '/documents/incoming';
//
//     }else if (notif_type == "group")
//     {
//         window.location.href = base_url;
//
//     }else
//     {
//         window.location.href = base_url;
//     }
// }

$("body").on('click', '#clear_all_notif', function (){

    $.ajax({
        url: bpath + 'notification/clear/all',
        type: "POST",
        data: {
            _token: _token,
        },
        success: function(response) {

            if (response.status == 200)
            {
                $('.__notification').load(location.href+' .__notification');
            }
        }
    });
});
