<!DOCTYPE html>
<html>
    <head>
        <title>Purchase Order Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">

            table {
                border-collapse: collapse;
                border-top: 2px solid black;
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
        
        <div>
            <center>
                <h1>
                    <div style="font-size:15px"><b>PURCHASE ORDER</b></div> 
                    <div style="font-size: 20px; text-decoration: underline">{{ $pr->entity_name }}</div>
                    <div style="font-size: 13px;">Entity Name</div>
                    <p style="font-size:-0.5px;"></p>
                </h1>
            </center>
        </div>
    <div style="border: solid 2px black"> 
        <div>
            <table text-align="left" style=" width: 100%; border-top: 0px !important; ">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 13px; text-align: left;">Supplier:</td>
                            <td style="font-size: 13px; text-align: left; width: 50%; text-decoration: underline; border-right: solid 2px black">{{ $po_header->supplier_name }}</td>
                            <td style="font-size: 13px; text-align: left;">PO No.:</td>
                            <td style="font-size: 13px; text-align: left; text-decoration: underline;">{{ $po_header->po_number }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: left;">Address:</td>
                            <td style="font-size: 13px; text-align: left; width: 50%; text-decoration: underline; border-right: solid 2px black">{{ $po_header->address }}</td>
                            <td style="font-size: 13px; text-align: left;">Date:</td>
                            <td style="font-size: 13px; text-align: left; text-decoration: underline;">{{ date("M d, Y", strtotime($po_header->invoice_date)) }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: left;">TIN:</td>
                            <td style="font-size: 13px; text-align: left; width: 50%; text-decoration: underline; border-right: solid 2px black">{{ $po_header->tin }}</td>
                            <td style="font-size: 13px; text-align: left;">Mode of Procurement:</td>
                            <td style="font-size: 13px; text-align: left; text-decoration: underline;">{{ $po_header->mode_of_procurement }}</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div style="border-top: 2px solid black">
            <div style="font-size: 13px; text-align: left;">Gentlemen:</div>
            <div style="font-size: 13px; text-align: left; text-indent: 75px">Please furnish this office the following articles subject to the terms and conditions contained herein:</div>
        </div>
        <div>
            <table text-align="left" style=" width: 100%; ">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 13px; text-align: left;">Place of Delivery:</td>
                            <td style="font-size: 13px; text-align: center; width: 50%; ">{{ $po_header->place_of_delivery }}</td>
                            <td style="font-size: 13px; text-align: left;">Delivery Term:</td>
                            <td style="font-size: 13px; text-align: left;">{{ $po_header->delivery_term }}</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: left;">Date of Delivery:</td>
                            <td style="font-size: 13px; text-align: center; width: 50%; ">{{ $po_header->date_of_delivery }}</td>
                            <td style="font-size: 13px; text-align: left;">Payment Term:</td>
                            <td style="font-size: 13px; text-align: left;">{{ $po_header->payment_term }}</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div >
            <table text-align="left" style=" width: 100%; border-bottom: thin solid black">
                    <thead>
                        <tr>
                            <td style="font-size: 13px; text-align: center; width: 10%; border-right: thin solid black">Stock No.</td>
                            <td style="font-size: 13px; text-align: center; width: 10%; border-right: thin solid black">Unit</td>
                            <td style="font-size: 13px; text-align: center; width: 55%; border-right: thin solid black">Item Description</td>
                            <td style="font-size: 13px; text-align: center; width: 10%; border-right: thin solid black">Quantity</td>
                            <td style="font-size: 13px; text-align: center; width: 10%; border-right: thin solid black">Unit Cost</td>
                            <td style="font-size: 13px; text-align: center; width: 15%;">Amount</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black" >{{ $item->stock_no }}</th>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black" >{{ $item->unit_name }}</th>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="font-size: 13px; text-align: right; border-right: thin solid black" >{{ number_format($item->quantity, 2) }}</th>
                            <th style="font-size: 13px; text-align: right; border-right: thin solid black" >{{ number_format($item->unit_cost, 2) }}</th>
                            <th style="font-size: 13px; text-align: right;" >{{ number_format($item->amount, 2) }}</th>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <div >
            <table text-align="left" style=" width: 100%; border-bottom: thin solid black">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="font-size: 13px; text-align: center; width: 25%; ">Total Amount in Words:</th>
                            <th style="font-size: 13px; text-align: center; width: 60%; border-right: thin solid black">{{  }}</th>
                            <th style="font-size: 13px; text-align: center; width: 15%;">{{ number_format($po_header->total_amount, 2) }}</th>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div style="border-top: thin solid black;">
            <div style="text-indent: 30px; font-size: 13px; padding: 5px 10px">In case of failure to make the full delivery within the time specified above, a penalty of one-tenth (1/10) of one percent for every day of delay shall be imposed.</div>
            <div style="margin: 10px"></div>
            <div style="width:100%; font-size: 0; margin-left: 5%; margin-right: 5%;">
                <div style="width: 50%; display:inline-block; padding: 10px 10px;">
                <div style="font-size: 14px; padding-left: 2px; padding-bottom: 40px">Conforme:</div>
                    <div style="font-size:13px; text-indent: 10px;">&nbsp;</div> 
                    <div style="font-size:13px; text-align: center;">&nbsp;</div>
                    <div style="font-size:13px; text-align: center">&nbsp;&nbsp;</div>
                    <div style="font-size:13px; text-align: center; border-top: solid 1px black; width: 90%; margin-left: 5%; margin-right: 5%;">Signature over Printed Name of Supplier</div> 
                    <div style="font-size:13px; text-align: center">&nbsp;&nbsp;</div>
                    <div style="font-size:13px; text-align: center">&nbsp;&nbsp;</div>
                    <div style="font-size:13px; text-align: center">&nbsp;&nbsp;</div>
                    <div style="font-size:13px; text-align: center; border-top: solid 1px black; width: 70%; margin-left: 10%; margin-right: 10%;">Date</div> 
                </div>      
                <div style="width: 40%; display:inline-block; padding: 10px 10px; float: right">
                <div style="font-size: 14px; padding-left: 2px; padding-bottom: 40px">Very truly yours,</div>
                    <div style="font-size:13px; text-indent: 10px;">Authorized Official</div> 
                    <div style="font-size:13px; text-align: center">&nbsp;&nbsp;</div>
                    <div style="font-size:14px; text-align: center">&nbsp;{{ $po_header->first_name }} {{ $po_header->middle_name }} {{ $po_header->last_name }}&nbsp;</div>
                    <div style="font-size:13px; text-align: center; border-top: solid 1px black;">Signature over Printed Name of Authorized Official</div> 
                    <div style="font-size:13px; text-align: center">&nbsp;&nbsp;</div>
                    <div style="font-size:14px; text-align: center">&nbsp;{{ $po_header->designation_name }}&nbsp;</div>
                    <div style="font-size:13px; text-align: center; border-top: solid 1px black;">Designation</div> 
                </div>
            </div>
        </div>
        <div>
            <table text-align="left" style=" width: 100%;">
                    <thead>
                    </thead>
                    <tbody> 
                        <tr>
                            <td style="font-size: 13px; text-align: left; width: 60%; font-weight: bold; border-right: solid 2px black">Fund Cluster: <span style="text-decoration: underline; font-weight: normal !important">{{ $pr->fund_cluster }}</span></td>
                            <td style="font-size: 13px; text-align: left; width: 35%; font-weight: bold;">ORS/BURS No.:</td>
                        </tr> 
                        <tr>
                            <td style="font-size: 13px; text-align: left; width: 60%; font-weight: bold; border-right: solid 2px black">Funds Available: </td>
                            <td style="font-size: 13px; text-align: left; width: 35%; font-weight: bold;">Date of the ORS/BURS: </td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: center; text-transform: uppercase; border-right: solid 2px black">_________________________________________</td>
                            <td style="font-size: 13px; text-align: left; width: 35%; font-weight: bold;">Amount: </td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; text-align: center; width: 60%; font-weight: bold;border-right: solid 2px black">Signature over Printed Name of Chief Accountant/Head of Accounting Division/Unit</td>
                            <td style="font-size: 13px; text-align: center; width: 35%; "></td>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
    </body>

</html>
