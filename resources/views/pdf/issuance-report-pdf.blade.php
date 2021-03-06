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
            
            table thead th{
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
                            <td style="font-size: 13px; width: 10%; text-align: left; ">@if($header->ris_date == null) &nbsp; @else{{ date("M d, Y", strtotime($header->ris_date)) }}@endif</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: left;">Office:</td>
                            <td style="font-size: 13px; width: 20%; text-align: left; border-right: thin solid black">{{ $header->office_name }}</td>
                            <td style="font-size: 13px; width: 25%; text-align: left; border-right: thin solid black">{{ $header->reasonability_center_code }}</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">SAI No.</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">{{ $header->sai_no }}</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">Date:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left; ">@if($header->sai_date == null) &nbsp; @else{{ date("M d, Y", strtotime($header->sai_date)) }}@endif</td>
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
                            <th style="font-size:14px; text-align: center; border-right: thin solid black">Stock No.</th>
                            <th style="font-size:14px; text-align: center; border-right: thin solid black">Unit</th>
                            <th style="font-size:14px; width: 30%; text-align: center; border-right: thin solid black">Description</th>
                            <th style="font-size:14px; text-align: text-align: center; border-right: thin solid black;">Quantity</th>
                            <th style="font-size:14px; text-align: text-align: center; border-right: thin solid black;">Quantity</th>
                            <th style="font-size:14px; width: 40%; text-align: text-align: center; border-right: thin solid black;">Remarks</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->stock_no}}</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->unit_name }}</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</td>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >{{ $item->quantity }}</td>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left;">{{ $item->remarks }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " >&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " >&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="size:14px; text-align: left; " >&nbsp;</td>
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
                            <td style="font-size: 13px; width: 15%; text-align: center; border-right: thin solid black; border-bottom: 0px solid black !important">&nbsp;</th>
                            <td style="font-size: 13px; width: 25%; text-align: center; border-right: thin solid black">Requested by:</th>
                            <td style="font-size: 13px; width: 20%; text-align: center; border-right: thin solid black">Approved by:</th>
                            <td style="font-size: 13px; width: 20%; text-align: center; border-right: thin solid black">Issued by:</th>
                            <td style="font-size: 13px; width: 20%; text-align: center;">Received by:</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 13px; text-align: left; border-right: thin solid black">Signature:</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</td>
                            <td style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: left; border-right: thin solid black">Printed Name:</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $requested_by->first_name }} {{ $requested_by->middle_name }} {{ $requested_by->last_name }}</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $approved_by->first_name }} {{ $approved_by->middle_name }} {{ $approved_by->last_name }}</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $issued_by->first_name }} {{ $issued_by->middle_name }} {{ $issued_by->last_name }}</td>
                            <td style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">{{ $received_by->first_name }} {{ $received_by->middle_name }} {{ $received_by->last_name }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: left; border-right: thin solid black">Designation:</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $requested_by->designation_name }}</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $approved_by->designation_name }}</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">{{ $issued_by->designation_name }}</td>
                            <td style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">{{ $received_by->designation_name }}</td>
                        </tr>
                        <tr>          
                            <td style="font-size: 13px; text-align: left; border-right: thin solid black">Date:</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black;">@if($requested_by->request_date == null) &nbsp; @else{{ date("M d, Y", strtotime($requested_by->request_date)) }}@endif</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black;">@if($approved_by->approved_date == null) &nbsp; @else{{ date("M d, Y", strtotime($approved_by->approved_date)) }}@endif</td>
                            <td style="font-size: 13px; text-align: center; border-right: thin solid black;">@if($issued_by->issued_date == null) &nbsp; @else{{ date("M d, Y", strtotime($issued_by->issued_date)) }}@endif</td>
                            <td style="font-size: 13px; text-align: center;">@if($received_by->receipt_date == null) &nbsp; @else{{ date("M d, Y", strtotime($received_by->receipt_date)) }}@endif</td>
                        </tr>
                    </tbody>
            </table> 
        </div> 
    </div>

    </body>

</html>
