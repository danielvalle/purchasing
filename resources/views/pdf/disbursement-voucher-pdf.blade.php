<!DOCTYPE html>
<html>
    <head>
        <title>Disbursement Voucher</title>
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
        
    <div style="border: 1px solid black"> 
        <div>
            <center>
                <h1>
                    <p style="font-size:15px; margin: 0; padding: 0;">Republic of the Philippines</p> 
                    <div style="font-size: 15px;"><b>Southern Leyte State University</b></div>
                    <div style="font-size: 15px;">Sogod, Southern Leyte</div>
                </h1>
            </center>
        </div>
        <div>
            <table style="width: 100%;">
                <thead>
                </thead>    
                <tbody>
                    <tr>
                        <th style="width: 85%; border-right: thin solid black">
                            <div style="font-size: 18px; padding: 10px 0px; ">DISBURSEMENT VOUCHER</div>
                        </th>
                        <th style="width: 15%;">
                            <div style="font-size: 13px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: left">No.</div>
                        </th>
                    </tr>   
                </tbody>
            </table>
        </div>  
        <div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="font-size: 0px; width: 10%; text-align: center; border-bottom: 0px !important; border-right: thin solid black">&nbsp;</td>
                            <td style="font-size: 0px; width: 22.5%; text-align: center; border-bottom: 0px !important;">&nbsp;</td>
                            <td style="font-size: 0px; width: 22.5%; text-align: center; border-bottom: 0px !important;">&nbsp;</td>
                            <td style="font-size: 0px; width: 22.5%; text-align: center; border-bottom: 0px !important;">&nbsp;</td>
                            <td style="font-size: 0px; width: 22.5%; text-align: center; border-bottom: 0px !important;">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="font-size: 14px; text-align: left; border-right: thin solid black" >
                                <div style="text-align: center; font-weight: normal">Mode of Payment</div>
                            </th>
                            <th style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 1) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        MDS Check
                                    </label>  
                                    </div>
                                </div>
                            </th>
                            <th style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 2) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        Commercial Check
                                    </label>  
                                    </div>
                                </div>
                            </th>
                            <th style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 3) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        ADA
                                    </label>  
                                    </div>
                                </div>
                            </th>
                            <th style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 4) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        Others
                                    </label>  
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </tbody>
            </table>            
        </div>

        <div>
            <table style="width: 100%;">
                <thead>
                </thead>    
                <tbody>
                    <tr>
                        <th style="width: 10%; border-right: thin solid black">
                            <div style="font-size: 14px; padding: 10px 0px; font-weight: normal; text-align: center">Payee</div>
                        </th>
                        <th style="width: 40%; border-right: thin solid black; vertical-align: middle">
                            <div style="font-size: 14px; font-weight: normal; text-align: left;">{{ $payee->first_name }} {{ $payee->middle_name }} {{ $payee->last_name }}</div>
                        </th>
                        <th style="width: 30%; border-right: thin solid black">
                            <div style="font-size: 13px; font-weight: normal; text-align: left">TIN/Employee No.</div>
                            <div style="font-size: 14px; font-weight: normal; text-align: left">{{ $dv->employee_no }}</div>
                        </th>
                        <th style="width: 20%;">
                            <div style="font-size: 13px; font-weight: normal; text-align: left">OR/BUR No.</div>
                            <div style="font-size: 14px; font-weight: normal; text-align: left">{{ $dv->or_bur_no }}</div>
                        </th>
                    </tr>  
                    <tr>
                        <th style="width: 10%; border-right: thin solid black; border-top: thin solid black">
                            <div style="font-size: 14px; padding: 10px 0px; font-weight: normal; text-align: center">Address</div>
                        </th>
                        <th style="width: 40%; border-right: thin solid black; border-top: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: left">{{ $dv->address }}</div>
                        </th>
                        <th style="width: 30%; border-right: thin solid black; border-top: 2px solid black">
                            <div style="font-size: 13px; font-weight: normal; text-align: left">Office/Unit/Project</div>
                            <div style="font-size: 14px; font-weight: normal; text-align: left">{{ $dv->project }}</div>
                        </th>
                        <th style="width: 20%; border-top: 2px solid black">
                            <div style="font-size: 13px; font-weight: normal; text-align: left">Code</div>
                            <div style="font-size: 14px; font-weight: normal; text-align: left">{{ $dv->code }}</div>
                        </th>
                    </tr>   
                </tbody>
            </table>
        </div> 
        <div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <td style="font-size: 14px; width: 80%; border-right: thin solid black; text-align: center">EXPLANATION</td>
                        <td style="font-size: 14px; width: 20%; text-align: center">AMOUNT</td>
                    </tr>   
                </thead>    
                <tbody>
                    <tr>
                        <th style="border-right: thin solid black">
                            <div style="font-size: 14px; padding: 10px 0px; font-weight: normal; text-align: center">{{ $dv->explanation }}</div>
                        </th>
                        <th>
                            <div style="font-size: 14px; font-weight: normal; text-align: left">{{ $dv->amount }}</div>
                        </th>
                    </tr>    
                </tbody>
            </table>
        </div>
        <div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <td style="font-size: 15px; width: 60%; text-align: left; border-right: thin solid black">A. Certified</td>
                            <td style="font-size: 15px; width: 40%; text-align: left;">B. Approved for Payment</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="text-align: left; border-right: thin solid black" >
                                <div style="padding: 10px 10px 30px 20px;">
                                    <div>
                                        <input style="width: 5%; float: left" for="inspected" type="checkbox" @if($dv->certified == 1) checked @endif>
                                        <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal; font-size: 14px" class="checkbox-inline">
                                        Cash available
                                        </label>  
                                    </div>
                                    <div>
                                        <input style="width: 5%; float: left" for="inspected" type="checkbox" @if($dv->certified == 2) checked @endif>
                                        <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal; font-size: 14px" class="checkbox-inline">
                                        Subject to Authority to Debit Account (when applicable)
                                        </label>
                                    </div>
                                    <div>
                                        <input style="width: 5%; float: left" for="inspected" type="checkbox" @if($dv->certified == 3) checked @endif>
                                        <label id="inspected" name="inspected" style="width: 95%; float: left; font-weight: normal; font-size: 14px" class="checkbox-inline">
                                        Supporting documents complete
                                        </label>
                                    </div>
                                </div>
                            </th>
                            <th style="text-align: left;" >
                                <div>
                                    {{ $dv->approved_for_payment }}
                                </div>
                            </th>
                        </tr>
                    </tbody>
            </table>
        </div>  
        <div>
            <table style=" width: 100%;">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Signature</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;"></th>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Signature</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-bottom: thin solid black; font-size: 14px;"></th>
                        </tr>
                        <tr>
                            <th style="vertical-align: middle; width: 10%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 0px; border-right: thin solid black; font-size: 14px">Printed Name</th>
                            <th style="width: 40%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; border-right: thin solid black; font-size: 16px">{{ $certifier->first_name }} {{ $certifier->middle_name }} {{ $certifier->last_name }}</th>
                            <th style="vertical-align: middle; width: 10%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 0px; border-right: thin solid black; font-size: 14px">Printed Name</th>
                            <th style="width: 40%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; font-size: 16px">{{ $approver->first_name }} {{ $approver->middle_name }} {{ $approver->last_name }}</th>
                        </tr>
                        <tr>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px; vertical-align: middle;">Position</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">
                                <div style="text-align: center; border-bottom: thin solid black; font-size: 15px">Accountant III</div>
                                <div style="text-align: center; font-size: 13px">Head, Accounting Unit/Authorized Representative</div>
                            </th>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px; vertical-align: middle;">Position</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-bottom: thin solid black; font-size: 14px;">
                                <div style="text-align: center; border-bottom: thin solid black; font-size: 15px">&nbsp;</div>
                                <div style="text-align: center; font-size: 13px">Agency/Head/Authorized Representative</div>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Date</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">{{ $dv->date }}</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Date</th>
                            <th style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-bottom: thin solid black; font-size: 14px;">{{ $dv->approve_date }}</th>
                        </tr>   
                    </tbody>
            </table>
        </div>
        <div>
            <table style=" width: 100%; border-top: 0 !important">
                    <thead>
                    </thead>
                    <tbody>  
                        <tr>
                            <th colspan="4"style="text-align: left; font-weight: normal; padding: 3px 2px; border-bottom: thin solid black; font-size: 14px; border-right: thin solid black">C. Received Payment</th>
                            <th style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; padding: 3px 0px;">JEV No.</th>
                        </tr>
                        <tr>
                            <th style="width: 10%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">Check/ADA No.</th>
                            <th style="width: 20%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; border-right: thin solid black; font-size: 16px">{{ $dv->ada_no }}</th>
                            <th style="width: 20%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 13px">Date</div>
                                <div style="text-align: left; font-size: 13px">{{ $dv->payment_check_date }}</div>
                            </th>
                            <th style="width: 30%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 13px">Bank Name</div>
                                <div style="text-align: left; font-size: 13px">{{ $dv->bank_name }}</div>
                            </th>
                            <th style="width: 10%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; font-size: 16px">{{ $dv->jev_no }}</th>
                        </tr> 
                        <tr>
                            <th style="width: 10%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">Signature</th>
                            <th style="width: 20%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; border-right: thin solid black; font-size: 16px"></th>
                            <th style="width: 20%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 13px">Date</div>
                                <div style="text-align: left; font-size: 13px"></div>
                            </th>
                            <th style="width: 30%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 13px">Printed Name</div>
                                <div style="text-align: left; font-size: 13px">{{ $printed_name->first_name }} {{ $printed_name->middle_name }} {{ $printed_name->last_name }}</div>
                            </th>
                            <th style="width: 10%; text-align: center; font-weight: normal; padding: 3px 2px;">
                                <div style="text-align: left; font-size: 13px">Date</div>
                                <div style="text-align: left; font-size: 13px">&nbsp;</div>
                            </th>
                        </tr>  
                        <tr>
                        <th colspan="4" style="text-align: center; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                            <div style="text-align: left; font-size: 13px">Official Receipt/Other Documents</div>
                            <div style="text-align: left; font-size: 13px">{{ $dv->other_docs }}</div>
                        </th>
                        <th style="text-align: center; font-weight: normal; padding: 3px 2px;">{{ $dv->check_date }}</th>
                    </tr>
                    </tbody>
            </table>
        </div>

 
    </div>

    </body>

</html>
