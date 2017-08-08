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
        
        <div>
            <table text-align="left" style=" width: 100%; border-top: 0; margin-bottom: 10px;">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td colspan="2" style="width: 100%; padding-bottom: 10px; font-size:20px; text-align: center; font-weight: bold">INSPECTION AND ACCEPTANCE REPORT</td>
                        </tr>
                        <tr>
                            <td style="width: 65%; font-size:14px; text-align: left;"><span style="font-weight: bold">Entity Name:</span> <span style="text-decoration: underline">{{ $pr_header->entity_name }}</span></td>
                            <td style="width: 35%; font-size:14px; text-align: left;"><span style="font-weight: bold">Fund Cluster:</span> <span style="text-decoration: underline">{{ $pr_header->fund_cluster }}</span></td>
                        </tr>
                    </tbody>
            </table>
        </div>

    <div style="border: solid 2px black"> 
        <div>
            <table text-align="left" style=" width: 100%; border-top: 0px">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black">Supplier: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $acceptance_header->supplier_name }}</span></td>
                            <td style="font-size: 14px; text-align: left; ">IAR: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $acceptance_header->iar }}</span></td>
                        </tr>

                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black">PO No./Date: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $acceptance_header->po_no }} / {{ date("M d, Y", strtotime($acceptance_header->po_date)) }}</span></td>
                            <td style="font-size: 14px; text-align: left; ">Date: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ date("M d, Y", strtotime($acceptance_header->iar_date)) }}</span></td>
                        </tr>

                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black">Requisitioning Office/Dept.: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $acceptance_header->department_name }} </span></td>
                            <td style="font-size: 14px; text-align: left;">Invoice No.: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $acceptance_header->invoice_no }}</span></td>
                        </tr>


                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black">Responsibility Center Code: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ $pr_header->responsibility_center_code }}</span></td>
                            <td style="font-size: 14px; text-align: left; ">Date: &nbsp;&nbsp;&nbsp;<span style="text-decoration: underline">{{ date("M d, Y", strtotime($acceptance_header->invoice_date)) }}</span></td>
                        </tr>
                    </tbody>
            </table>        
        </div>
        <div >
            <table text-align="left" style=" width: 100%; border-top: 0px !important">
                    <thead>
                        <tr>
                            <th style="font-size: 14px; text-align: center; border-right: thin solid black">Item No.</th>
                            <th style="font-size: 14px; text-align: center; border-right: thin solid black">Unit</th>
                            <th style="font-size: 14px; width: 60%; text-align: center; border-right: thin solid black">Description</th>
                            <th style="font-size: 14px; text-align: center;">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >{{ $item->stock_no}}</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >{{ $item->unit_name }}</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</td>
                            <td style="font-size: 14px; text-align: left; " >{{ $item->quantity }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; " >&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; " >&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >&nbsp;</td>
                            <td style="font-size: 14px; text-align: left; " >&nbsp;</td>
                        </tr>
                    </tbody>
            </table>
        </div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <th style="font-size: 14px; width: 50%; text-align: center; border-right: thin solid black">INSPECTION</th>
                            <th style="font-size: 14px; width: 50%; text-align: center; border-right: thin solid black">ACCEPTANCE</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >
                                <div style="font-weight: normal">Date Inspected: <span style="text-decoration: underline">{{ date("M d, Y", strtotime($acceptance_header->date_inspected)) }}</span></div>
                                <div style="padding: 10px 10px 30px 20px;">
                                    <input style="width: 5%; float: left" for="inspected" type="checkbox" value="1" @if($acceptance_header->verification == 1) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                    Inspected, verified and found OK as to quantity and specification
                                    </label>  
                                </div>
                                <div style="text-align: center; font-weight: bold; text-transform: uppercase; text-decoration: underline; ">{{ $inspector->first_name }} {{ $inspector->middle_name }} {{ $inspector->last_name }}</div>
                                <div style="text-align: center; font-weight: normal;">University Inspector</div>
                            </td>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black;" >
                                <div style="font-weight: normal">Date Inspected: <span style="text-decoration: underline">{{ date("M d, Y", strtotime($acceptance_header->date_accepted)) }}</span></div>
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
                            </td>
                        </tr>
                    </tbody>
            </table>
    </div>
    </body>

</html>
