<!DOCTYPE html>
<html>
    <head>
        <title>Abstract Quotation Report</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">

            table {
                border-collapse: collapse;
                text-align: center;
            }

            table th, thead{
                text-align: center;
                border-bottom: solid 1px black;
            }
            
            .page-break {
                page-break-after: always;
            }
        </style>
    </head>
    
    <body>
        
    <div> 
        <div>
            <center>
                <h1>
                    <div style="font-size:14px">Republic of the Philippines</div> 
                    <div style="font-size: 18px;">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 14px;">Sogod, Southern Leyte</div>
                    <div style="font-size: 14px;">Abstract of Quotation/Bids Opened On</div>
                    <div style="margin: 10px"></div>
                    <div style="font-size: 14px; text-align: center; text-decoration: underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;@if($header->date == null) &nbsp; @else{{ date("M d, Y", strtotime($header->date)) }}@endif&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="font-size: 14px;">Date</div>
                    <p style="font-size:-0.5px;"></p>
                </h1>
            </center>
        </div>
        
        <div style="font-size:14px; ">Dealers</div> 
        <div style="border: thin solid black">
            <table text-align="left" style=" width: 100%;">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black">1</td>
                            <td style="font-weight: normal; text-align: left;">{{ $supplier1->supplier_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >2</td>
                            <td style="font-weight: normal; text-align: left;" >{{ $supplier2->supplier_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >3</td>
                            <td style="font-weight: normal; text-align: left;" >{{ $supplier3->supplier_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >4</td>
                            <td style="font-weight: normal; text-align: left;" >{{ $supplier4->supplier_name }}</td>
                        </tr>
                        <tr>
                            <td style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >5</td>
                            <td style="font-weight: normal; text-align: left;" >{{ $supplier5->supplier_name }}</td>
                        </tr>                                                                                            
                    </tbody>
            </table>
            <table text-align="left" style=" width: 100%; border-top: thin solid black">
                    <thead>
                        <tr>
                            <th style="width: 5%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">Items</th>
                            <th style="width: 5%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">QTY</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">UNIT</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">DESCRIPTION</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">1</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">2</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">3</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; border-right: thin solid black">4</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px;">5</th>
                        </tr>                        
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">{{ $item->stock_no }}</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">{{ $item->quantity }}</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">{{ $item->unit_name }}</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: center; border-right: thin solid black">{{ $item->item_name }}</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">@if($item->supplier1_amount != 0){{ number_format($item->supplier1_amount, 2) }}@endif</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">@if($item->supplier2_amount != 0){{ number_format($item->supplier2_amount, 2) }}@endif</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">@if($item->supplier3_amount != 0){{ number_format($item->supplier3_amount, 2) }}@endif</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">@if($item->supplier4_amount != 0){{ number_format($item->supplier4_amount, 2) }}@endif</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">@if($item->supplier5_amount != 0){{ number_format($item->supplier5_amount, 2) }}@endif</td>
                        </tr>
                            @endforeach       
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: center; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: center; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: center; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: center; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: center; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">&nbsp;</td>
                        </tr> 

                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">PR No.: {{ $pr->pr_number }}</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: right;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td colspan="6" style="font-weight: bold; font-size: 14px; text-align: left; border-top: thin solid black">{{ $pr->purpose }}</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-weight: bold; font-size: 14px; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td colspan="6" style="font-weight: bold; font-size: 14px; text-align: left;">&nbsp;</td>
                        </tr>                                                                                
                    </tbody>
            </table>            
        </div>
        
        <div style="margin: 20px"></div>

        <div style="width: 70%; min-height: 70px; border: solid thin black; padding: 5px; margin-left: auto; margin-right: auto;">
            @foreach($items as $item)
                <div style="font-size:16px;">Item # (s): <span style="text-decoration: underline">{{ $item->item_name }}</span> is/are awarded to <span style="text-decoration: underline">{{ $item->supplier_name}}</span></div> 
            @endforeach
        </div>

        <div style="margin: 100px"></div>
        <div style="width: 100%; font-size: 0">
            @if($aq_supervising_admin->id != null)
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_supervising_admin->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_supervising_admin->designation_name }}</div>
            </div>
            @endif
            @if($aq_admin_officer->id != null)
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_admin_officer->first_name }} {{ $aq_admin_officer->middle_name }} {{ $aq_admin_officer->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_admin_officer->designation_name }}</div>
            </div>
            @endif
            @if($aq_admin_officer_2->id != null)
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_admin_officer_2->first_name }} {{ $aq_admin_officer_2->middle_name }} {{ $aq_admin_officer_2->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_admin_officer_2->designation_name }}</div>
            </div>
            @endif
            @if($aq_requesting_officer->id != null)
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_requesting_officer->first_name }} {{ $aq_requesting_officer->middle_name }} {{ $aq_requesting_officer->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_requesting_officer->designation_name }}</div>
            </div>      
            @endif                             
        </div>
        <div style="margin: 5px"></div>
        <div style="width: 100%; font-size: 0">
            <div style="width: 65%; display:inline-block;">&nbsp;</div>
            <div style="width: 30%; display:inline-block;">
                <div style="font-size:14px; ">Approved:</div>
            </div>                                
        </div>
        <div style="margin: 35px"></div>
        <div style="width: 100%; font-size: 0">
            @if($aq_board_secretary->id != null)
            <div style="width: 35%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_board_secretary->first_name }} {{ $aq_board_secretary->middle_name }} {{ $aq_board_secretary->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_board_secretary->designation_name }}</div>
            </div>
            @endif
            @if($aq_vpaf->id != null)
            <div style="width: 40%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_vpaf->first_name }} {{ $aq_vpaf->middle_name }} {{ $aq_vpaf->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_vpaf->designation_name }}</div>
            </div>
            @endif
            @if($aq_approve->id != null)
            <div style="width: 30%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_approve->first_name }} {{ $aq_approve->middle_name }} {{ $aq_approve->last_name }}&nbsp;</div> 
                <div style="font-size:14px; ">{{ $aq_approve->designation_name }}</div>
            </div> 
            @endif                               
        </div>
    </div>
    </body>

</html>
