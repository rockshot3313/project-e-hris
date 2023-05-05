<!doctype html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title>{{ $filename }}</title>
        <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">

        <style type = "text/css">
            /** Define the margins of your page **/
            @page {
                    margin: 15px 15px;
                }
            body { margin: 30px 30px;
            }

            * {
                font-family: Arial, Helvetica, sans-serif;
            }

            a {
                color          : #fff;
                text-decoration: none;
            }

            table {
                font-size: x-small;
            }

            header {
                position: fixed;
                top: -53px;
                left: 0px;
                right: 0px;
                height: 50px;
                /** Extra personal styles **/
                background-color: #03a9f4;
                color: white;
                text-align: center;
                line-height: 35px;
            }
            footer {
                position: fixed;
                bottom: 20px;
                left: 0px;
                right: 0px;
                height: 50px;
                /** Extra personal styles **/
                background-color: #03a8f400;
                color: rgb(0, 0, 0);
                text-align: center;
                line-height: 35px;
            }

            .invoice table {
                margin: 15px;
            }
            .invoice h3 {
                margin-left: 5px;
            }
            .information {
                color: rgb(0, 0, 0);
            }
            .information .logo {
                margin: 30px;
            }
            .information table {
                padding: 10px;
            }
            img {
                object-fit: cover;
                }
            .scale-down {
                object-fit: scale-down;
            }
            .grid-container {
            display: grid;
            }
            .grid-container {
                display: inline-grid;
                }
            #data {
                border-collapse: collapse;
            }
            #data th {
                border: 1px solid #000000;
                border-collapse: collapse;
            }
            #data td {
                border: 1px solid #000000;
                border-collapse: collapse;
            }
        .my-table{
            border-collapse: collapse;
            width: 100%;
        }
        .my-table td{
            padding: 0.5rem;
            border-collapse: collapse;
        }
        .text-9px {
            font-size:  0.563rem;
            line-height: 1rem;
        }
        .h2 {
            font-size: 15px;
           }
        .h3 {
            font-size: 14.5px;
        }
        .h4 {
            font-size: 14px;
        }
        .font-style {
            font-family: 'Times New Roman', Times, serif;
        }
        .sub-font-style {
            font-family: Arial, Helvetica, sans-serif;
        }
        .font-text{
            font-weight: bold;
        }
        .sub-font-style{
            font-family:'Times New Roman', Times, serif;
        }
        .mt-5{
            margin-top: 20px;
        }
        .padding{
            border-collapse: collapse;
            width: 100%;
        }
        .mr-5{
            margin-right: 1.25rem;
        }
        .ml-1{
            margin-left: 0.25rem;
        }
        .border-space
        {
            border-collapse: collapse;
            border-spacing: 0;
            padding-right: 20%;
            margin-left: 20%
            width: 100%;
        }


        </style>
    </head>
        <!-- Define header and footer blocks before your content -->
    <body>

        <div style="margin-top: -40px"  class = "information">
            <table class="my-table">
                <tr style="font-size: 14px; padding-right: 100%" class="sub-font-style"><strong>CSC Job Portal</strong></tr>
                <tr class=" h4 sub-font-style">

                    @if(system_settings())
                    @php
                        $system_title = system_settings()->where('key','system_title')->first();
                    @endphp
                    @endif

                    @if($system_title)
                    <bold>{{ $system_title->value }}</bold>
                    @else
                    No title added
                    @endif

                </tr>
                <tr style="padding-left: 40px;>
                    <td colspan="2">
                        <div style="width: 100%; border-bottom: 2px"><hr style="height:1px;border-width:0;color:black;background-color:black">
                    </td>
                </tr>
            </table class="border">
        </div>

        </table>
        <div style="margin-top: -100px"  class = "information">
            <table class="my-table" style="padding-top: 3%" >
                <tr>
                    <td style="width: 40%" class="h2 font-style font-text">
                        Place of Assignment :
                    <td>
                    <td style="width: 60%" class="h3 sub-font-style">

                        @if($get_job_info->assign_agency)
                        {{ $get_job_info->assign_agency }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Position Title :<td>
                    <td class="h3 sub-font-style">
                        @if($get_job_info->pos_title)
                        {{get_position_title($get_job_info->pos_title)->emp_position}}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Plantilla Item No. :<td>
                    <td class="h3 sub-font-style">
                        @if($get_educ_rec->item_no)
                        {{ $get_educ_rec->item_no}}
                        @else
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Salary/Job/Pay Grade :<td>
                    <td class="h3 sub-font-style">
                        @if($get_job_info->sg)
                        {{ get_SG($get_job_info->sg)->code}}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Monthly Salary :<td>
                    <td class="h3 sub-font-style">
                        @if($get_job_info->salary)
                        Php {{ $get_job_info->salary }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Eligibility :<td>
                    <td class="h3 sub-font-style">
                        @if($get_educ_rec->eligibility)
                        {{ $get_educ_rec->eligibility }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Education :<td>
                    <td class="h3 sub-font-style">
                        @if($get_educ_rec->educ)
                        {{ $get_educ_rec->educ }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Training :<td>
                    <td class="h3 sub-font-style">
                        @if($get_educ_rec->training)
                        {{ $get_educ_rec->training }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Work Experience :<td>
                    <td class="h3 sub-font-style">
                        @if($get_educ_rec->work_ex)
                        {{ $get_educ_rec->work_ex }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
                <tr>
                    <td class="h2 font-style font-text">Competency :<td>
                    <td class="h3 sub-font-style">
                        @if(get_competency($get_educ_rec->competency))
                        {{ get_competency($get_educ_rec->competency)->skill }}
                        @else
                        N/A
                        @endif
                        <td>
                </tr>
            </table>

            <table class=" my-table padding mt-2">
                <tr >
                    <td class="h2 font-style font-text">Instructions/Remarks :</td>
                </tr>
                <tr>
                    <td  class="h3 sub-font-style">
                       @if($get_doc_req->remarks)
                       {{ $get_doc_req->remarks }}
                       @else
                       N/A
                       @endif
                    </td>
                </tr>
            </table>
            <table class="mt-2">
                <tr class="my-table">
                    <td class="my-table h2 font-style font-text">Documents :</td>
                </tr>
                    @php($num=1)
                    @forelse (get_Documents_requirements($get_job_info->jobref_no) as $docs)
                        <tr class="">
                            <td  class="h3 sub-font-style" style="padding-left: 1%">
                                 {{ $num++ }}.{{$docs->doc_requirements }}
                            </td>
                        </tr>
                        @empty
                        @endforelse
            </table>
            <table class="mt-3" style="padding-left: 2%">
                <tr >
                    <td class="h2 font-style font-text">QUALIFIED APPLICANTS</td>
                    <td  class="h3 sub-font-style">
                        are advised to hand in or send through courier/email their application to:
                    </td>
                </tr>
            </table>
            <table class="my-table mt-2">
                <tr >
                    <td class="h3 sub-font-style">
                        @if( strtoupper(get_HRMO($get_job_info->email_through)))
                        {{ strtoupper(get_HRMO($get_job_info->email_through)->firstname)}}
                        {{ strtoupper(get_HRMO($get_job_info->email_through)->lastname)}}
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
            </table>
            <table style="padding-left:2%">
                <tr class="mt-2">
                    <td class="h4 sub-font-style"><strong>OIC-Director, Administrative Staff</strong></td>
                </tr>
                <tr class="">
                    <td class="h3 sub-font-style">
                        @if($get_job_info->address)
                         {{ $get_job_info->address }}
                        @else
                        N/A
                        @endif
                    </td>
                </tr>
                <tr class="">
                    <td class="h3 sub-font-style">
                        @if($get_job_info->email_add)
                         {{ $get_job_info->email_add }}
                        @else
                        No email address attached
                        @endif
                    </td>
                </tr>
            </table>
            <table class="my-table mt-4">
                <tr>
                    <td class="h4 font-style font-text">APPLICATIONS WITH INCOMPLETE DOCUMENTS SHALL NOT BE ENTERTAINED.</td>
                </tr>
            </table>
            <table class="mt-4">
                <tr>
                    <td><div style = "font-size: 15px" class="h4 font-style font-text mr-5  font-size: 15px">Posting Date :</div></td>
                    <td><div class="h3 font-style">
                        @if($get_job_info->post_date)
                         {{ $get_job_info->post_date }}
                        @else
                        No Posting date posted
                        @endif
                    </div></td>
                </tr>
            </table>
            <table >
                <tr>
                    <td><div style = "font-size: 15px" class="h4 font-style font-text mr-5">Closing Date :</div></td>
                    <td><div class="h3 font-style">
                        @if($get_job_info->close_date)
                         {{ $get_job_info->close_date }}
                        @else
                        No Closing date posted
                        @endif
                    </div></td>
                </tr>
            </table>
            <table style="padding-bottom: 0%">
                <tr>
                    <td >
                        <div style="width: 4300%; border-bottom: 1px"><hr style="height:1px;border-width:0;color:black;background-color:black">
                    </td>
                </tr>
                <tr>
                    <td style="padding-left: 3300%">
                        1/1
                    </td>
                </tr>
            </table>

        </div>
    </body>
    </html>
