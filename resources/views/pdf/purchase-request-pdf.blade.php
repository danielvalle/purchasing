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
                            <td style="size:16px; text-align: left; border-right: thin solid black">HR</td>
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
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Qty</td>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Unit of Issue</td>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Item Description</td>
                            <td style="size:16px; text-align: center;">Stock No.</td>
                        </tr>
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >5</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >Piece</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >Donut</th>
                            <th style="size:16px; text-align: left; " >DN12</th>
                        </tr>
                    </tbody>
            </table>
        </div>
        <div style="height: 50px">
            <div style="font-size:17px;">Purpose</div> 
            <div></div>
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
