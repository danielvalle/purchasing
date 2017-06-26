<!DOCTYPE html>
<html>
    <head>
        <title>Issuance Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">

            table {
                border-collapse: collapse;
                border-top: 1px solid black;
                text-align: center;
            }

            table th{
                text-align: center;
                vertical-align: 0
            }
            
            table thead td{
                border-bottom: thin solid black;
                text-align: center;
            }

            .page-break {
                page-break-after: always;
            }
        </style>
        {!! Html::style('../css/bootstrap.min.css') !!}
        {!! Html::script('js/bootstrap.js') !!}
    </head>
    
    <body>
        
    <div style="border: solid 1px black"> 
        <div>
            <center>
                <h1>
                    <p style="font-size:16px; margin: 0; padding: 0;">REQUISITION AND ISSUE SLIP</p> 
                    <div style="font-size: 13px; text-decoration: underline">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 13px;">Agency</div>
                    <div style="margin: 15px"></div>
                </h1>
            </center>
        </div>
        <div>
            <table text-align="left" style=" width: 100%;">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: left;">Division:</td>
                            <td style="font-size: 13px; width: 20%; text-align: left; border-right: thin solid black">{{ $header->department_name }}</td>
                            <td style="font-size: 13px; width: 25%; text-align: left; border-right: thin solid black">Reasonability Center Code:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">RIS No.</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">{{ $header->ris_no }}</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">Date:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left; ">{{ $header->ris_date }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: left;">Office:</td>
                            <td style="font-size: 13px; width: 20%; text-align: left; border-right: thin solid black">{{ $header->office_name }}</td>
                            <td style="font-size: 13px; width: 25%; text-align: left; border-right: thin solid black">{{ $header->reasonability_center_code }}</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">SAI No.</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">{{ $header->sai_no }}</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">Date:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left; ">{{ $header->sai_date }}</td>
                        </tr>
                    </tbody>
            </table> 
        </div>  
        <div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <th style="font-size: 14px; width: 50%; text-align: center;">Requisition</th>
                            <th style="font-size: 14px; width: 50%; text-align: center;">Issuance</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
            </table> 
        </div>
        <div >
            <table text-align="left" style=" width: 100%; border-bottom: thin solid black">
                    <thead>
                        <tr>
                            <td style="font-size:14px; text-align: center; border-right: thin solid black">Stock No.</td>
                            <td style="font-size:14px; text-align: center; border-right: thin solid black">Unit</td>
                            <td style="font-size:14px; width: 30%; text-align: center; border-right: thin solid black">Description</td>
                            <td style="font-size:14px; text-align: text-align: center; border-right: thin solid black;">Quantity</td>
                            <td style="font-size:14px; text-align: text-align: center; border-right: thin solid black;">Quantity</td>
                            <td style="font-size:14px; width: 40%; text-align: text-align: center; border-right: thin solid black;">Remarks</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->stock_no}}</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->unit_name }}</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->quantity }}</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left;">{{ $item->remarks }}</th>
                        </tr>
                        @endforeach
                        <tr>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:15px; font-weight: bold">Purpose</div> 
            <div style="padding: 2px 10px; text-align: justify">
                <p style="font-size: 15px;">{{ $header->purpose }}</p>
            </div>
        </div>
        <div>
            <table text-align="left" style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: center; border-right: thin solid black; border-bottom: 0px solid black !important">&nbsp;</td>
                            <td style="font-size: 13px; width: 25%; text-align: center; border-right: thin solid black">Requested by:</td>
                            <td style="font-size: 13px; width: 20%; text-align: center; border-right: thin solid black">Approved by:</td>
                            <td style="font-size: 13px; width: 20%; text-align: center; border-right: thin solid black">Issued by:</td>
                            <td style="font-size: 13px; width: 20%; text-align: center;">Received by:</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Signature:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Printed Name:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $requested_by->first_name }} {{ $requested_by->middle_name }} {{ $requested_by->last_name }}</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $approved_by->first_name }} {{ $approved_by->middle_name }} {{ $approved_by->last_name }}</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $issued_by->first_name }} {{ $issued_by->middle_name }} {{ $issued_by->last_name }}</th>
                            <th style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">{{ $received_by->first_name }} {{ $received_by->middle_name }} {{ $received_by->last_name }}</th>
                        </tr>
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Designation:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $requested_by->designation_name }}</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $approved_by->designation_name }}</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $issued_by->designation_name }}</th>
                            <th style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">{{ $received_by->designation_name }}</th>
                        </tr>
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Date:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black;">{{ $requested_by->request_date }}</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black;">{{ $approved_by->approved_date }}</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black;">{{ $issued_by->issued_date }}</th>
                            <th style="font-size: 13px; text-align: center;">{{ $received_by->receipt_date }}</th>
                        </tr>
                    </tbody>
            </table> 
        </div> 
    </div>

    </body>

</html>
