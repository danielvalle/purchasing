<!DOCTYPE html>
<html>
    <head>
        <title>Purchase Request Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">

            table {
                border-collapse: collapse;
                border-top: 1px solid black;
                text-align: center;
            }

            table th{
                border-top: 1px solid black;
                text-align: center;
            }
            
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    
    <body>
        
    <div style="border: solid 1px black"> 
        <div>
            <center>
                <h1>
                    <p style="font-size:20px"><b>PURCHASE REQUEST</b></p> 
                    <div style="font-size: 15px; text-decoration: underline">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 13px;">(Agency)</div>
                    <p style="font-size:-0.5px;"></p>
                </h1>
            </center>
        </div>
        <div>
            <table text-align="left" style=" width: 100%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size:16px; text-align: left;">Department:</td>
                            <td style="font-size:16px; text-align: left; border-right: thin solid black">{{ $pr_header->department_name }}</td>
                            <td style="font-size:16px; text-align: left;">PR No.</td>
                            <td style="font-size:16px; text-align: left;">{{ $pr_header->pr_number }}</td>
                            <td style="font-size:16px; text-align: left">Date:</td>
                            <td style="font-size:16px; text-align: left;">{{ date("M d, Y", strtotime($pr_header->pr_date)) }}</td>
                        </tr>
                        <tr>
                            <td style="font-size:16px; text-align: left;">Section:</td>
                            <td style="font-size:16px; text-align: left; border-right: thin solid black">{{ $pr_header->section_name }}</td>
                            <td style="font-size:16px; text-align: left;">SAI No.</td>
                            <td style="font-size:16px; text-align: left;">{{ $pr_header->sai_number }}</td>
                            <td style="font-size:16px; text-align: left">Date:</td>
                            <td style="font-size:16px; text-align: left;">{{ date("M d, Y", strtotime($pr_header->sai_date)) }}</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div >
            <table text-align="left" style=" width: 100%; ;border-bottom: thin solid black">
                    <thead>
                        <tr>
                            <td style="font-size:16px; text-align: center; border-right: thin solid black">Qty</td>
                            <td style="font-size:16px; text-align: center; border-right: thin solid black">Unit of Issue</td>
                            <td style="font-size:16px; text-align: center; border-right: thin solid black">Item Description</td>
                            <td style="font-size:16px; text-align: center;">Stock No.</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="font-size:16px; text-align: right; border-right: thin solid black" >{{ $item->quantity }}</th>
                            <th style="font-size:16px; text-align: left; border-right: thin solid black" >{{ $item->unit_name }}</th>
                            <th style="font-size:16px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="font-size:16px; text-align: left; " >{{ $item->stock_no}}</th>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:17px; font-weight: bold">Purpose</div> 
            <div style="padding: 2px 10px; text-align: justify">
                <p>{{ $pr_header->purpose }}</p>
            </div>
        </div>
        <div>
            <table text-align="left" style=" width: 100%; ">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="width: 10%; text-align: center; border-right: thin solid black"></td>
                            <td style="font-weight: normal; text-align: center; border-right: thin solid black">Requested by:</td>
                            <td style="font-weight: normal; text-align: center;">Approved by:</td>
                        </tr>
                        <tr>
                            <th style="width: 10%; text-align: left; border-right: thin solid black">Signature:</th>
                            <th style="text-align: left; border-right: thin solid black"></th>
                            <th style="text-align: left; " ></th>
                        </tr>
                        <tr>
                            <th style="width: 10% ; text-align: left; border-right: thin solid black">Printed Name:</th>
                            <th style="font-weight: normal; text-align: center; border-right: thin solid black">{{ $pr_requested_by->first_name }} {{ $pr_requested_by->middle_name }} {{ $pr_requested_by->last_name }}</th>
                            <th style="font-weight: normal; text-align: center; " >{{ $pr_approved_by->first_name }} {{ $pr_approved_by->middle_name }} {{ $pr_approved_by->last_name }}</th>
                        </tr>                      
                        <tr>
                            <th style="width: 10%; text-align: left; border-right: thin solid black">Designation:</th>
                            <th style="font-weight: normal; text-align: center; border-right: thin solid black">{{ $pr_requested_by->designation_name }}</th>
                            <th style="font-weight: normal; text-align: center; " >{{ $pr_approved_by->designation_name }}</th>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
    </body>

</html>
