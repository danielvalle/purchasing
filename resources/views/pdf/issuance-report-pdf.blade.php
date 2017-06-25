<!DOCTYPE html>
<html>
    <head>
        <title>Issuance Report</title>
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
                    <p style="font-size:16px; margin: 0; padding: 0;">REQUISITION AND ISSUE SLIP</p> 
                    <div style="font-size: 13px; text-decoration: underline">SOUTHERN LEYTE STATE UNIVERSITY</div>
                    <div style="font-size: 13px;">Agency</div>
                    <div style="margin: 15px"></div>
                </h1>
            </center>
        </div>
        <div>
            <table text-align="left" style=" width: 100%;">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: left;">Division:</td>
                            <td style="font-size: 13px; width: 20%; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-size: 13px; width: 25%; text-align: left; border-right: thin solid black">Reasonability Center Code:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">RIS No.</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">&nbsp;</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">Date:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left; ">&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: left;">Office:</td>
                            <td style="font-size: 13px; width: 20%; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-size: 13px; width: 25%; text-align: left; border-right: thin solid black">&nbsp;</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">SAI No.</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">&nbsp;</td>
                            <td style="font-size: 13px; width: 10%; text-align: left;">Date:</td>
                            <td style="font-size: 13px; width: 10%; text-align: left; ">&nbsp;</td>
                        </tr>
                    </tbody>
            </table> 
        </div>  
        <div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <th style="font-size: 14px; width: 50%; text-align: center;">Requisition</th>
                            <th style="font-size: 14px; width: 50%; text-align: center;">Issuance</th>
                        </tr>
                    </thead>
                    <tbody>  
                    </tbody>
            </table> 
        </div>
        <div >
            <table text-align="left" style=" width: 100%; border-bottom: thin solid black">
                    <thead>
                        <tr>
                            <td style="font-size:14px; text-align: center; border-right: thin solid black">Stock No.</td>
                            <td style="font-size:14px; text-align: center; border-right: thin solid black">Unit</td>
                            <td style="font-size:14px; width: 30%; text-align: center; border-right: thin solid black">Description</td>
                            <td style="font-size:14px; text-align: text-align: center; border-right: thin solid black;">Quantity</td>
                            <td style="font-size:14px; text-align: text-align: center; border-right: thin solid black;">Quantity</td>
                            <td style="font-size:14px; width: 40%; text-align: text-align: center; border-right: thin solid black;">Remarks</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->stock_no}}</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >Piece</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >10</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        @endforeach
                        <tr>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="font-size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:14px; text-align: left; " >&nbsp;</th>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div style="min-height: 70px;">
            <div style="font-size:15px; font-weight: bold">Purpose</div> 
            <div style="padding: 2px 10px; text-align: justify">
                <p style="font-size: 15px;">Video provides a powerful way to help you prove your point. When you click Online Video, you can paste in the embed code for the video you want to add. You can also type a keyword to search online for the video that best fits your document.
                To make your document look professionally produced, Word provides header, footer, cover page, and text box designs that complement each other. For example, you can add a matching cover page, header, and sidebar. Click Insert and then choose the elements you want from the different galleries.
                Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme.
                Save time in Word with new buttons that show up where you need them. To change the way a picture fits in your document, click it and a button for layout options appears next to it. When you work on a table, click where you want to add a row or a column, and then click the plus sign.
                Reading is easier, too, in the new Reading view. You can collapse parts of the document and focus on the text you want. If you need to stop reading before you reach the end, Word remembers where you left off - even on another device.
                </p>
            </div>
        </div>
        <div>
            <table text-align="left" style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="font-size: 13px; width: 15%; text-align: center; border-right: thin solid black; border-bottom: 0px solid black !important">&nbsp;</td>
                            <td style="font-size: 13px; width: 25%; text-align: center; border-right: thin solid black">Requested by:</td>
                            <td style="font-size: 13px; width: 20%; text-align: center; border-right: thin solid black">Approved by:</td>
                            <td style="font-size: 13px; width: 20%; text-align: center; border-right: thin solid black">Issued by:</td>
                            <td style="font-size: 13px; width: 20%; text-align: center;">Received by:</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Signature:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Printed Name:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Designation:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black; border-bottom: thin solid black !important">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-bottom: thin solid black !important">&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="font-size: 13px; text-align: left; border-right: thin solid black">Date:</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black;">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black;">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center; border-right: thin solid black;">&nbsp;</th>
                            <th style="font-size: 13px; text-align: center;">&nbsp;</th>
                        </tr>
                    </tbody>
            </table> 
        </div> 
    </div>

    </body>

</html>
