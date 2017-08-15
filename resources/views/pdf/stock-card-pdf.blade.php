<!DOCTYPE html>
<html>
    <head>
        <title>Stock Card</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style type="text/css">

            table {
                border-collapse: collapse;
                border: 1px solid black;
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
    </head>
    
    <body>
        <div>
            <center>  
                <div style="font-size: 14px;">STOCK CARD</div>
                <div style="font-size: 13px;">SLSU</div>
                <div style="font-size: 14px;"><span style="border-top: thin solid black">Agency</span></div>
                <div>&nbsp;</div>
            <center>
        </div>
        <div>
            <table text-align="left" style=" width: 100%;">
                <thead>
                    <tr>
                        <th colspan="3" style="width: 40%; border-right:thin solid black; font-size: 14px;">
                            <div style="text-align: left">Item</div>
                            <div style="text-align: center; font-weight: normal; font-size: 15px;">{{ $item->item_name }}</div>
                        </th>
                        <th colspan="3" style="width: 40%; border-right:thin solid black; font-size: 14px; text-align: left">
                            <div style="text-align: left">Description</div>
                            <div style="text-align: center; font-weight: normal;">{{ $item->item_description }}</div>
                        </th>
                        <th colspan="1" style="width: 20%; font-size: 14px; text-align: left">
                            <div>Stock Card No. <span style="font-weight: normal">{{ sprintf('%04d', $item->id) }}</span></div>
                            <div>Re-Order Pt.</div>
                        </th>
                    </tr>
                    <tr>
                        <td rowspan="2" style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Date</td>
                        <td rowspan="2" style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid border-left: ;">Reference</td>
                        <td style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Received</td>

                        <td colspan="2"  style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Issued</td>
                        <td style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Balance</td>

                        <td style="font-size: 14px; border-bottom: thin solid black">No. Of Days To</td>
                    </tr>
                    <tr>
                        <td style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Qty</td>
                        <td style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Qty</td>
                        <td style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Office</td>
                        <td style="font-size: 14px; border-right: thin solid black; border-bottom: thin solid black">Qty</td>
                        <td style="font-size: 14px; border-bottom: thin solid black">Consume</td>
                    </tr>         
                </thead>
                <tbody>
                    @foreach($sc as $card)
                    <tr>
                        <td style="font-size: 13px; border-right: thin solid black; border-bottom: thin solid black">{{ $card->date }}</td>
                        <td style="font-size: 13px; border-right: thin solid black; border-bottom: thin solid black">{{ $card->reference_no }}</td>
                        <td style="font-size: 13px; border-right: thin solid black; border-bottom: thin solid black">{{ $card->received_quantity }} {{ $card->received_quantity_unit }}</td>
                        <td style="font-size: 13px; border-right: thin solid black; border-bottom: thin solid black">{{ $card->issued_quantity }}</td>
                        <td style="font-size: 13px; border-right: thin solid black; border-bottom: thin solid black">{{ $card->office_name }}</td>
                        <td style="font-size: 13px; border-right: thin solid black; border-bottom: thin solid black">{{ $card->balanced_quantity }} {{ $card->balanced_quantity_unit }}</td>
                        <td style="font-size: 13px; border-bottom: thin solid black">{{ $card->no_of_days_consume }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    
    </body>

</html>

