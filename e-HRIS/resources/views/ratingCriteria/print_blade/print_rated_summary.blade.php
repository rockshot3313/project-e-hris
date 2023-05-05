<!doctype html>
<html lang = "en">
    <head>
        <meta charset = "UTF-8">
        <title>{{ $filename }}</title>
        <link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet">
        <style type = "text/css">
            /** Define the margins of your page **/
            @page {
                    margin: 30px 30px;
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
            #logo {
                height: auto;
                width: auto;
                max-width: 100px;
                max-height: 100px;
            }
            table.print-friendly tr td, table.print-friendly tr th {
                    page-break-inside: avoid;
                    border-right: none;
                }
            table.print-friendly {
                width: 100%;
                font-size: 14px;
                }
            table.print-friendly,
            th.print-friendly,
            td.print-friendly {
                    border-collapse: collapse;
                    }
            th.print-friendly,
            td.print-friendly {
                    padding: 5px;
                    text-align: left;
                    }
            table.print-friendly tr:nth-child(even) {
                background-color: rgba(0, 176, 240, 0.1);
                }
            table.print-friendly tr:nth-child(odd) {
                background-color: #fff;
                }
            table.print-friendly th {
                }
            .no-border-right {
                border-right: none;
                }
            .no-border {
                border-right: none;
            }
            .pagenum:before {
                    content: counter(page);
                }

            #wrapper{
                    -moz-column-count: 3;
                    -moz-column-gap: 1em;
                    -webkit-column-count: 3;
                    -webkit-column-gap: 1em;
                    column-count: 3;
                    column-gap: 1em;
                    }
            .itm{
                display:inline-block;
                width:100%;
                border-top:1px solid red;
                border-bottom:1px solid red;
                margin-bottom:1em;
            }
            .itm:nth-child(3n+1){
                clear:left;
            }
            .equ {
                display: inline-block;
                width: 40px;
                height: 180px;
                border-radius: 5px 5px 0 0;
                background:
                linear-gradient(transparent 80%, #333333 20%)0 0/100% 40px,
                linear-gradient(orange, yellow);
                }
        </style>
    </head>
        <!-- Define header and footer blocks before your content -->
    <body>

        <div style="margin-top: -60px"  class = "information">
            <table id="tbl_header">
                <tr><strong>CSC Job Portal</strong></tr>
                <tr class="titleClass"><strong>NATIONAL ECONOMIC AND DEVELOPMENT AUTHORITY (NEDA)</strong></tr>
                <<tr style="padding-left: 30px; padding-top:5px">
                    <div style="width: 100%; border-bottom: 1px"><hr style="height:2px;border-width:0;color:gray;background-color:gray">
                </tr>
            </table class="border">
        </div>
        <div style="margin-top: -100px"  class = "information">
            <table >
                <tr>
                    <th><strong>Place of Assignment :</strong><th>
                    <th>College of Arts and Sciences, Abra State Institute of
                        Sciences & Technology, Bangued Campus
                        <th>
                </tr>
            </table>
        </div>
        {{-- <footer>
            <br>
                <table style="width: 100%">
                    <tr style="text-align: center">
                        <td>
                            <span> This is a (DMS) generated report:</span> <strong></strong>
                        </td>
                        <td>
                            <span> </span>
                        </td>
                        <td>
                            Page <span class="pagenum"></span>
                        </td>
                    </tr>
                </table>
        </footer> --}}
        <main>

                <div   class = "information">
                    <table style="margin-bottom: 20px" style="font-size: 10px"  width = "100%">
                        <tbody>
                            <tr>
                                <th style="padding-bottom: 30px" colspan="2"><h1>Summary of Rating</h1> </th>
                            </tr>
                            <tr>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div   class = "information">
                    <table style="width: 100%" >
                        <tr>
                            <td style="width: 50%;padding-bottom: 50px">
                                <div>Travel Order No. </div>

                            </td>
                            <td style="width: 50%">
                                <div style="text-align: center">Date: </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="padding: 5px">Name:</div>
                                <div style="padding: 5px">Posistion/Designation:
                                </div>
                            </td>

                            <td>

                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div style="padding: 5px">Station: </div>
                                <div style="padding: 5px">Departure Date: </div>
                            </td>

                            <td>
                                <div style="padding: 5px">Destination: </div>
                                <div style="padding: 5px">Return Date:</div>

                            </td>
                        </tr>

                        <tr>
                            <td style="padding-top: 30px;font-size:small ; padding-left:5px">Purpose of Travel:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="2" style="padding-left: 30px; padding-top:10px"><div style="text-align: justify; text-indent: 2em;line-height: 2 ;"></div></td>
                        </tr>

                        <tr>
                            <td style="padding-top: 30px;font-size:small; padding-left:5px">Remarks:</td>
                            <td></td>
                        </tr>

                        <tr>
                            <td colspan="2" style="padding-left: 30px; padding-top:10px"><div style="width: 100%; border-bottom: 1px"><hr style="height:2px;border-width:0;color:gray;background-color:gray"></div></td>
                        </tr>
                    </table>

                </div>

                <div style="font-size: 10px" class = "information">
                    <div>

                    </div>
                </div>

        </main>


    </body>

    </html>
