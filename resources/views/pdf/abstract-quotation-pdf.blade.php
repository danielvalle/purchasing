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
                    <div style="font-size:15px">Republic of the Philippines</div> 
                    <div style="font-size: 18px;">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 15px;">Sogod, Southern Leyte</div>
                    <div style="font-size: 15px;">Abstract of Quotation/Bids Opened On</div>
                    <div style="margin: 10px"></div>
                    <div style="font-size: 15px; text-align: center; text-decoration: underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date("M d, Y", strtotime($header->date)) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="font-size: 15px;">Date</div>
                    <p style="font-size:-0.5px;"></p>
                </h1>
            </center>
        </div>
        
        <div style="font-size:15px; ">Dealers</div> 
        <div style="border: thin solid black">
            <table text-align="left" style=" width: 100%;">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black">1</th>
                            <th style="font-weight: normal; text-align: left;">{{ $supplier1->supplier_name }}</th>
                        </tr>
                        <tr>
                            <th style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >2</th>
                            <th style="font-weight: normal; text-align: left;" >{{ $supplier2->supplier_name }}</th>
                        </tr>
                        <tr>
                            <th style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >3</th>
                            <th style="font-weight: normal; text-align: left;" >{{ $supplier3->supplier_name }}</th>
                        </tr>
                        <tr>
                            <th style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >4</th>
                            <th style="font-weight: normal; text-align: left;" >{{ $supplier4->supplier_name }}</th>
                        </tr>
                        <tr>
                            <th style="width: 5%; font-weight: normal; text-align: left; border-right: thin solid black" >5</th>
                            <th style="font-weight: normal; text-align: left;" >{{ $supplier5->supplier_name }}</th>
                        </tr>                                                                                            
                    </tbody>
            </table>
            <table text-align="left" style=" width: 100%;">
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
                            <th style="font-weight: bold; font-size: 15px; text-align: left; border-right: thin solid black">{{ $item->stock_no }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: left; border-right: thin solid black">{{ $item->quantity }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: left; border-right: thin solid black">{{ $item->unit_name }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: center; border-right: thin solid black">{{ $item->item_name }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: right; border-right: thin solid black">{{ $item->supplier1_amount }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: right; border-right: thin solid black">{{ $item->supplier2_amount }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: right; border-right: thin solid black">{{ $item->supplier3_amount }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: right; border-right: thin solid black">{{ $item->supplier4_amount }}</th>
                            <th style="font-weight: bold; font-size: 15px; text-align: right;">{{ $item->supplier5_amount }}</th>
                        </tr>
                        @endforeach                                                                                          
                    </tbody>
            </table>            
        </div>
        
        <div style="margin: 20px"></div>
        <div style="width: 100%; font-size: 0">
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_supervising_admin->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}</div> 
                <div style="font-size:14px; ">Supervising Admin, Officer</div>
                <div style="font-size:14px; ">Regular Member, BAC</div>
            </div>
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_admin_officer->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}</div> 
                <div style="font-size:14px; ">Supervising Admin, Officer</div>
                <div style="font-size:14px; ">Regular Member, BAC</div>
            </div>
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_admin_officer_2->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}</div> 
                <div style="font-size:14px; ">Supervising Admin, Officer</div>
                <div style="font-size:14px; ">Regular Member, BAC</div>
            </div>
            <div style="width: 25%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">&nbsp;</div> 
                <div style="font-size:14px; ">Head of Requesting Officer or</div>
                <div style="font-size:14px; ">Authorized Representative</div>
                <div style="font-size:14px; ">Provisional Member, BAC</div>
            </div>                                    
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
            <div style="width: 35%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_board_secretary->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}</div> 
                <div style="font-size:14px; ">Board Secretary</div>
                <div style="font-size:14px; ">Vice-Chairperson, BAC</div>
            </div>
            <div style="width: 40%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_vpaf->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}</div> 
                <div style="font-size:14px; ">VPAF</div>
                <div style="font-size:14px; ">Chairperson, BAC</div>
            </div>
            <div style="width: 30%; display:inline-block;">
                <div style="font-size:14px; font-weight: bold; text-transform: uppercase; ">{{ $aq_approve->first_name }} {{ $aq_supervising_admin->middle_name }} {{ $aq_supervising_admin->last_name }}</div> 
                <div style="font-size:14px; ">University President</div>
            </div>                                
        </div>
    </div>
    </body>

</html>
