<?php
    
    $columns = 
    [
        'ITEM',
        'FABRIC',
        'DESCRIPTION',
        'BASE PRICE'
    ];
?>

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
                            <td style="size:16px; text-align: left;">Department:</td>
                            <td style="size:16px; text-align: left; border-right: thin solid black">{{ $user }}</td>
                            <td style="size:16px; text-align: left;">PR No.</td>
                            <td style="size:16px; text-align: left;">12345</td>
                            <td style="size:16px; text-align: left">Date:</td>
                            <td style="size:16px; text-align: left;">June 15, 2017</td>
                        </tr>
                        <tr>
                            <td style="size:16px; text-align: left;">Section:</td>
                            <td style="size:16px; text-align: left; border-right: thin solid black">Section 1</td>
                            <td style="size:16px; text-align: left;">SAI No.</td>
                            <td style="size:16px; text-align: left;">123-ABC</td>
                            <td style="size:16px; text-align: left">Date:</td>
                            <td style="size:16px; text-align: left;">June 15, 2017</td>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div >
            <table text-align="left" style=" width: 100%; ;border-bottom: thin solid black">
                    <thead>
                        <tr>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Qty</td>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Unit of Issue</td>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Item Description</td>
                            <td style="size:16px; text-align: center;">Stock No.</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >5</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >Piece</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="size:16px; text-align: left; " >{{ $item->stock_no}}</th>
                        </tr>
                        @endforeach
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:17px; font-weight: bold">Purpose</div> 
            <div style="padding: 2px 10px; text-align: justify">
                <p>Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.
                To make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries.
                Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.
                Save time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.
                Reading is easier, too, in the new Reading view. You can collapse parts of the document and focus on the text you want. If you need to stop reading before you reach the end, Word remembers where you left off - even on another device.

                </p>
            </div>
        </div>
        <div>
            <table text-align="left" style=" width: 100%; ">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="width: 10%; size:16px; text-align: center; border-right: thin solid black"></td>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Requested by:</td>
                            <td style="size:16px; text-align: center;">Approved by:</td>
                        </tr>
                        <tr>
                            <th style="width: 10%; size:16px; text-align: left; border-right: thin solid black">Signature:</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black"></th>
                            <th style="size:16px; text-align: left; " ></th>
                        </tr>
                        <tr>
                            <th style="width: 10% ; size:16px; text-align: left; border-right: thin solid black">Printed Name:</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black"></th>
                            <th style="size:16px; text-align: left; " ></th>
                        </tr>                      
                        <tr>
                            <th style="width: 10%; size:16px; text-align: left; border-right: thin solid black">Designation:</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black"></th>
                            <th style="size:16px; text-align: left; " ></th>
                        </tr>
                    </tbody>
            </table>
        </div>
    </div>
    </body>

</html>
