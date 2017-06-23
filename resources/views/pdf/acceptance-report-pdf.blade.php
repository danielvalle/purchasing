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
                            <td style="size:16px; width: 20%; text-align: left; border-right: thin solid black">Supplier:</td>
                            <td style="size:16px; width: 60%; text-align: left; border-right: thin solid black"></td>
                            <td style="size:16px; width: 10%; text-align: left; border-right: thin solid black">IAR:</td>
                            <td style="size:16px; width: 10%; text-align: left;"></td>
                        </tr>
                    </tbody>
            </table>
            <table text-align="left" style=" width: 100%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black">PO No.:</td>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black"></td>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black">Date:</td>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black"></td>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black">Invoice No.:</td>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black"></td>
                            <td style="size:16px; width: 12.5%; text-align: left; border-right: thin solid black">Date:</td>
                            <td style="size:16px; width: 12.5%; text-align: left; "></td>
                        </tr>
                    </tbody>
            </table>     
            <table text-align="left" style=" width: 100%">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="size:16px; width: 30%; text-align: center; border-right: thin solid black">Requisitioning Office/Dept.:</td>
                            <td style="size:16px; width: 70%; text-align: center;"></td>
                    </tbody>
            </table>        
        </div>
        <div >
            <table text-align="left" style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Item No.</td>
                            <td style="size:16px; text-align: center; border-right: thin solid black">Unit</td>
                            <td style="size:16px; width: 60%; text-align: center; border-right: thin solid black">Description</td>
                            <td style="size:16px; text-align: center;">Quantity</td>
                        </tr>
                    </thead>
                    <tbody>  
                        @foreach($items as $item)
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >{{ $item->stock_no}}</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >Piece</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >{{ $item->item_name }}</th>
                            <th style="size:16px; text-align: left; " >5</th>
                        </tr>
                        @endforeach
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; " >&nbsp;</th>
                        </tr>
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >&nbsp;</th>
                            <th style="size:16px; text-align: left; " >&nbsp;</th>
                        </tr>
                    </tbody>
            </table>
        </div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="size:16px; width: 50%; text-align: center; border-right: thin solid black">INSPECTION</td>
                            <td style="size:16px; width: 50%; text-align: center; border-right: thin solid black">ACCEPTANCE</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >
                                <div style="font-weight: normal">Date Inspected: _____________</div>
                                <div style="padding: 10px 10px 30px 20px;">
                                    <input style="width: 5%; float: left" for="inspected" type="checkbox" value="1" checked>
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                    Inspected, verified and found OK as to quantity and specification
                                    </label>  
                                </div>
                                <div style="text-align: center; font-weight: bold; text-transform: uppercase; text-decoration: underline; ">Ma. Delia O. Manca</div>
                                <div style="text-align: center; font-weight: normal">University Inspector</div>
                            </th>
                            <th style="size:16px; text-align: left; border-right: thin solid black" >
                                <div style="font-weight: normal">Date Inspected: _____________</div>
                                <div style="padding: 10px 10px 30px 20px;">
                                    <div>
                                    <input style="width: 5%; float: left" for="inspected" type="checkbox" value="1" checked>
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                        Complete
                                    </label>  
                                    </div>
                                    <div>
                                    <input for="inspected" type="checkbox" value="1" checked style="width: 5%; float: left; ">
                                    <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal" class="checkbox-inline">
                                        Partial (Pls. Specify Quantity)
                                    </label>  
                                    </div>
                                </div>
                                <div style="text-align: center; font-weight: bold; text-transform: uppercase; text-decoration: underline; ">Miguel M. Bidon, MM</div>
                                <div style="text-align: center; font-weight: normal">Property Officer</div>
                            </th>
                        </tr>
                    </tbody>
            </table>
    </div>
    </body>

</html>
