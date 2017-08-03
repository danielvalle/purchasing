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
            <table text-align="left" style=" width: 100%; border-top: 0">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td colspan="2" style="width: 100%; padding-bottom: 10px; font-size:20px; text-align: center; font-weight: bold">PURCHASE REQUEST</td>
                        </tr>
                        <tr>
                            <td style="width: 65%; font-size:14px; text-align: left;">Entity Name: <span style="text-decoration: underline">{{ $pr_header->entity_name }}</span></td>
                            <td style="width: 35%; font-size:14px; text-align: left;">Fund Cluster: <span style="text-decoration: underline">{{ $pr_header->fund_cluster }}</span></td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div>
            <table text-align="left" style=" width: 100%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black">Office/Section:</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black">PR No. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $pr_header->pr_number }}</span></td>
                            <td style="font-size:14px; text-align: left">Date:</td>
                        </tr>
                        <tr>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $pr_header->office_name }}</span></td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black">Responsibility Center Code: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $pr_header->responsibility_center_code }}</span></td>
                            <td style="font-size:14px; text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date("M d, Y", strtotime($pr_header->pr_date)) }}</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div >
            <table text-align="left" style=" width: 100%; ;border-bottom: thin solid black">
                    <thead>
                        <tr>
                            <th style="width: 10%; font-size:14px; text-align: center; border-right: thin solid black">Stock/Property No.</th>
                            <th style="width: 10%; font-size:14px; text-align: center; border-right: thin solid black">Unit</th>
                            <th style="width: 30%; font-size:14px; text-align: center; border-right: thin solid black">Item Description</th>
                            <th style="width: 10%; font-size:14px; text-align: center; border-right: thin solid black">Quantity</th>
                            <th style="width: 10%; font-size:14px; text-align: center; border-right: thin solid black">Unit Cost</th>
                            <th style="width: 10%; font-size:14px; text-align: center;">Total Cost</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black">{{ $item->stock_no }}</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black">{{ $item->unit_name }}</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black">{{ $item->item_name }}</td>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black">{{ $item->quantity }}</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black"></td>
                            <td style="font-size:14px; text-align: left;"></td>
                        </tr>
                        @endforeach
                        <tr>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " ></td>
                        </tr>
                        <tr>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " ></td>
                        </tr>
                        <tr>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " ></td>
                        </tr>
                        <tr>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " ></td>
                        </tr>
                        <tr>
                            <td style="font-size:14px; text-align: right; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size:14px; text-align: left; " ></td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:14px; font-weight: bold">Purpose:</div> 
            <div style="padding: 2px 10px; text-align: justify; font-size: 14px">
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
                            <td style="font-size:14px; font-weight: normal; text-align: center; border-right: thin solid black">Requested by:</td>
                            <td style="font-size:14px; font-weight: normal; text-align: center;">Approved by:</td>
                        </tr>
                        <tr>
                            <th style="font-size:14px; width: 10%; text-align: left; border-right: thin solid black">Signature:</th>
                            <th style="text-align: left; border-right: thin solid black"></th>
                            <th style="text-align: left; " ></th>
                        </tr>
                        <tr>
                            <th style="font-size:14px; width: 10% ; text-align: left; border-right: thin solid black">Printed Name:</th>
                            <th style="font-weight: normal; text-align: center; border-right: thin solid black">{{ $pr_requested_by->first_name }} {{ $pr_requested_by->last_name }}</th>
                            <th style="font-weight: normal; text-align: center;">{{ $pr_approved_by->first_name }} {{ $pr_approved_by->last_name }}</th>
                        </tr>                      
                        <tr>
                            <th style="font-size:14px; width: 10%; text-align: left; border-right: thin solid black">Designation:</th>
                            <th style="font-weight: normal; text-align: center; border-right: thin solid black">{{ $pr_approved_by->designation_name }}</th>
                            <th style="font-weight: normal; text-align: center;">{{ $pr_approved_by->designation_name }}</th>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
    </body>

</html>
