<!DOCTYPE html>
<html>
    <head>
        <title>Acceptance Report</title>
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
                    <p style="font-size:15px">INSPECTION & ACCEPTANCE REPORT</p> 
                    <p style="font-size:-0.5px;"></p>
                    <div style="font-size: 15px; text-decoration: underline">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 15px;">(Agency)</div>
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
                            <td style="font-size: 14px; width: 20%; text-align: left; border-right: thin solid black">Supplier:</td>
                            <td style="font-size: 14px; width: 55%; text-align: left; border-right: thin solid black">{{ $acceptance_header->supplier_name }}</td>
                            <td style="font-size: 14px; width: 10%; text-align: left; border-right: thin solid black">IAR:</td>
                            <td style="font-size: 14px; width: 15%; text-align: left;">{{ $acceptance_header->iar }}</td>
                        </tr>
                    </tbody>
            </table>
            <table text-align="left" style=" width: 100%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">PO No.:</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">{{ $acceptance_header->po_no }}</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">Date:</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">{{ $acceptance_header->po_date }}</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">Invoice No.:</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">{{ $acceptance_header->invoice_no }}</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; border-right: thin solid black">Date:</td>
                            <td style="font-size: 14px; width: 12.5%; text-align: left; ">{{ $acceptance_header->invoice_date }}</td>
                        </tr>
                    </tbody>
            </table>     
            <table text-align="left" style=" width: 100%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 14px; width: 30%; text-align: center; border-right: thin solid black">Requisitioning Office/Dept.:</td>
                            <td style="font-size: 14px; width: 70%; text-align: center;">{{ $acceptance_header->department_name }}</td>
                    </tbody>
            </table>        
        </div>
        <div >
            <table text-align="left" style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="font-size: 14px; text-align: center; border-right: thin solid black">Item No.</td>
                            <td style="font-size: 14px; text-align: center; border-right: thin solid black">Unit</td>
                            <td style="font-size: 14px; width: 60%; text-align: center; border-right: thin solid black">Description</td>
                            <td style="font-size: 14px; text-align: center;">Quantity</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >{{ $item->stock_no}}</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >{{ $item->unit_name }}</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="font-size: 14px; text-align: left; " >{{ $item->quantity }}</th>
                        </tr>
                        @endforeach
                        <tr>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size: 14px; text-align: left; " >&nbsp;</th>
                        </tr>
                    </tbody>
            </table>
        </div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="font-size: 14px; width: 50%; text-align: center; border-right: thin solid black">INSPECTION</td>
                            <td style="font-size: 14px; width: 50%; text-align: center; border-right: thin solid black">ACCEPTANCE</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >
                                <div style="font-weight: normal">Date Inspected: <span style="text-decoration: underline">{{ $acceptance_header->date_inspected }}</span></div>
                                <div style="padding: 10px 10px 30px 20px;">
                                    <input style="width: 5%; float: left" for="inspected" type="checkbox" value="1" @if($acceptance_header->verification == 1) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                    Inspected, verified and found OK as to quantity and specification
                                    </label>  
                                </div>
                                <div style="text-align: center; font-weight: bold; text-transform: uppercase; text-decoration: underline; ">{{ $inspector->first_name }} {{ $inspector->middle_name }} {{ $inspector->last_name }}</div>
                                <div style="text-align: center; font-weight: normal;">University Inspector</div>
                            </th>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black;" >
                                <div style="font-weight: normal">Date Inspected: <span style="text-decoration: underline">{{ $acceptance_header->date_accepted }}</span></div>
                                <div style="padding: 10px 10px 30px 20px;">
                                    <div>
                                    <input style="width: 5%; float: left" for="inspected" type="checkbox" value="1"  @if($acceptance_header->completeness == 1) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                        Complete
                                    </label>  
                                    </div>
                                    <div>
                                    <input for="inspected" type="checkbox" value="1" style="width: 5%; float: left;" @if($acceptance_header->verification == 0) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                        Partial (Pls. Specify Quantity)
                                    </label>  
                                    </div>
                                </div>
                                <div style="text-align: center; font-weight: bold; text-transform: uppercase; text-decoration: underline; ">{{ $property_officer->first_name }} {{ $property_officer->middle_name }} {{ $property_officer->last_name }}</div>
                                <div style="text-align: center; font-weight: normal;">Property Officer</div>
                            </th>
                        </tr>
                    </tbody>
            </table>
    </div>
    </body>

</html>