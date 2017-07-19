<!DOCTYPE html>
<html>
    <head>
        <title>Request For Quotation Report</title>
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

            .page-break:last-child {
                page-break-after: avoid;
            }
        </style>
    </head>
    
    <body>
    
    @for($i = 0; $i < count($supp_ids); $i++)
    <div class="page-break"> 
        <div>
            <center>
                <h1>
                    <div style="font-size:15px">Republic of the Philippines</div> 
                    <div style="font-size: 18px;">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 15px;">Sogod, Southern Leyte</div>
                    <div style="font-size: 15px;">Telefax No. (053) 382-2523 </div>
                    <div style="margin: 10px"></div>
                    <div style="font-size: 15px; text-align: center; text-decoration: underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ date("M d, Y", strtotime($header->date)) }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
                    <div style="font-size: 15px;">Date</div>
                    <p style="font-size:-0.5px;"></p>
                </h1>
            </center>
        </div>
        <div>
            <div>To: <span style="font-size: 16px; text-decoration: underline"><b>{{ $supplier[$i]->supplier_name }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>  
            <div>VAT/NON-VAT TIN: <span style="font-size: 16px; text-decoration: underline"><b>{{ $header->vat_nonvat_tin }}</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></div>  
        </div>
            <center>
                <h1>
                    <div style="font-size:18px; text-decoration: underline; margin-bottom: 5px;">REQUEST FOR QUOTATION</div> 
                    <div style="font-size: 15px;">Please quote the prices for each of the following:</div>
                </h1>
            </center>
        <div >
            <table text-align="left" style=" width: 100%; ; border: thin solid black">
                    <thead>
                        <tr>
                            <th style="font-size:16px; text-align: center; border-right: thin solid black">QTY.</th>
                            <th style="font-size:16px; text-align: center; border-right: thin solid black">UNIT</th>
                            <th style="font-size:16px; text-align: center; border-right: thin solid black">REQUEST FOR QUOTATION</th>
                            <th style="font-size:16px; text-align: center; border-right: thin solid black">UNIT PRICE</th>
                            <th style="font-size:16px; text-align: center; border-right: thin solid black">UNIT TOTAL</th>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="font-size:16px; text-align: left; font-weight: normal; border-right: thin solid black" >{{ $item->quantity }}</th>
                            <th style="font-size:16px; text-align: left; font-weight: normal; border-right: thin solid black" >{{ $item->unit_name }}</th>
                            <th style="font-size:16px; text-align: left; font-weight: normal; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="font-size:16px; text-align: left; font-weight: normal; border-right: thin solid black" ></th>
                            <th style="font-size:16px; text-align: left; font-weight: normal; border-right: thin solid black" ></th>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:16px;">Place of Delivery: <span style="text-decoration: underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $header->place_of_delivery }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                    within <span style="text-decoration: underline">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $header->within_no_of_days }}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> days</div> 
            <div style="font-size:16px;">_______________________________________________ from receipt of the delivery order.</div> 
        </div>
        <div style="margin: 20px"></div>
        <div>
            <div style="font-size:16px; width: 50%">I HEREBY CERTIFY that I am in a position to furnish the above articles at the prices shown and in quantities as called for the place of itinerary.</div> 
        </div>
        <div style="margin: 35px"></div>
        <div style="width: 100%;">
            <div style="width: 65%; display:inline-block;">
                <div style="width: 70%; font-size:16px; border-bottom: solid 1px black; text-align: center">{{ $requestor->first_name }} {{ $requestor->middle_name }} {{ $requestor->last_name }}</div> 
                <div style="width: 70%; font-size:16px; font-style: italic; text-align: center;">Signature over Printed Name</div> 
            </div>
            <div style="width: 35%; display:inline-block;">
                <div style="font-size:16px; border-bottom: solid 1px black; text-align: center">{{ $canvasser->first_name }} {{ $canvasser->middle_name }} {{ $canvasser->last_name }}</div> 
                <div style="font-size:16px; font-style: italic; text-align: center;">Canvasser</div> 
            </div>
        </div>
    </div>
    @endfor
    </body>

</html>
