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
            
            table thead th{
                border-bottom: thin solid black;
                text-align: center;
                font-weight: normal;
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
            <table style="width: 100%; border-top: 0 !important">
                <thead>
                </thead>    
                <tbody>
                    <tr>
                        <th style="width: 65%; border-right: thin solid black">
                            <div style="font-size: 14px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: center"><span style="text-decoration: underline">{{ $dv->entity_name }}</span></div>
                            <div style="font-size: 14px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: center"><span style="font-weight: bold">Entity Name</span></div>
                        </th>
                        <th style="width: 35%;">
                            <div style="font-size: 14px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: left">Fund Cluster:</div>
                            <div style="font-size: 14px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: left">{{ $dv->fund_cluster }}</div>
                        </th>
                    </tr> 
                    <tr>
                        <th style="width: 65%; border-right: thin solid black">
                            <div style="font-size: 18px; padding: 10px 0px; ">DISBURSEMENT VOUCHER</div>
                        </th>
                        <th style="width: 35%; border-top: thin solid black">
                            <div style="font-size: 14px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: left">Date: <span style="text-decoration: underline">@if($dv->certified_date == null) &nbsp; @else{{ date("M d, Y", strtotime($dv->certified_date)) }}@endif</span></div>
                            <div style="font-size: 14px; padding: 3px 0px 0px 3px; font-weight: normal; text-align: left">No.: <span style="text-decoration: underline">{{ $dv->dv_number }}</span></div>
                        </th>
                    </tr>   
                </tbody>
            </table>
        </div>  
        <div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <th style="font-size: 0px; width: 10%; text-align: center; border-bottom: 0px !important; border-right: thin solid black">&nbsp;</th>
                            <th style="font-size: 0px; width: 19.5%; text-align: center; border-bottom: 0px !important;">&nbsp;</th>
                            <th style="font-size: 0px; width: 22.5%; text-align: center; border-bottom: 0px !important;">&nbsp;</th>
                            <th style="font-size: 0px; width: 17%; text-align: center; border-bottom: 0px !important;">&nbsp;</th>
                            <th style="font-size: 0px; width: 31%; text-align: center; border-bottom: 0px !important;">&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="font-size: 14px; text-align: left; border-right: thin solid black" >
                                <div style="text-align: center; font-weight: normal">Mode of Payment</div>
                            </td>
                            <td style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 1) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        MDS Check
                                    </label>  
                                    </div>
                                </div>
                            </td>
                            <td style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 2) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        Commercial Check
                                    </label>  
                                    </div>
                                </div>
                            </td>
                            <td style="font-size: 14px; text-align: left;" >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                    <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 3) checked @endif>
                                    <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                        ADA
                                    </label>  
                                    </div>
                                </div>
                            </td>
                            <td style="font-size: 14px; text-align: left; " >
                                <div style="padding: 5px 5px 10px 10px;">
                                    <div>
                                        <input style="width: 10%; float: left" for="inspected" type="checkbox" @if($dv->mode_of_payment == 4) checked @endif>
                                        <label id="inspected" name="inspected" style="width: 90%; float: left; font-weight: normal" class="checkbox-inline">
                                            Others(Please specify)
                                        </label>  
                                    </div>
                                    <div>
                                        <span style="text-decoration: underline; font-weight: normal !important">{{ $dv->others }}</span>
                                    </div>  
                                </div>
                            </td>
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
                        <td style="width: 10%; border-right: thin solid black">
                            <div style="font-size: 14px; padding: 10px 0px; font-weight: normal; text-align: center">Payee</div>
                        </td>
                        <td style="width: 40%; border-right: thin solid black; vertical-align: middle">
                            <div style="font-size: 14px; font-weight: normal; text-align: left;"><b>{{ $payee->first_name }} {{ $payee->middle_name }} {{ $payee->last_name }}</b></div>
                        </td>
                        <td style="width: 30%; border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: left">TIN/Employee No.</div>
                            <div style="font-size: 14px; font-weight: normal; text-align: left"><b>{{ $dv->employee_no }}</b></div>
                        </td>
                        <td style="width: 20%;">
                            <div style="font-size: 14px; font-weight: normal; text-align: left">ORS/BUR No.</div>
                            <div style="font-size: 14px; font-weight: normal; text-align: left"><b>{{ $dv->ors_bur_no }}</b></div>
                        </td>
                    </tr>  
                    <tr>
                        <td style="width: 10%; border-right: thin solid black; border-top: thin solid black">
                            <div style="font-size: 14px; padding: 10px 0px; font-weight: normal; text-align: center">Address</div>
                        </td>
                        <td colspan="3" style="border-right: thin solid black; border-top: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: left"><b>{{ $dv->address }}</b></div>
                        </td>
                    </tr>   
                </tbody>
            </table>
        </div> 
        <div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="font-size: 14px; width: 40%; border-right: thin solid black; text-align: center">Particulars</th>
                        <th style="font-size: 14px; border-right: thin solid black; text-align: center">Responsibility Center</th>
                        <th style="font-size: 14px; border-right: thin solid black; text-align: center">MFO/PAP</th>
                        <th style="font-size: 14px; text-align: center">Amount</th>
                    </tr>   
                </thead>    
                <tbody>
                    @foreach($dvd as $det)
                    <tr>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">{{ $det->particulars }}</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">{{ $det->responsibility_center }}</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">{{ $det->mfo_pap }}</div>
                        </td>
                        <td>
                            <div style="font-size: 14px; font-weight: normal; text-align: right">{{ $det->amount }}</div>
                        </td>
                    </tr>
                    @endforeach    
                    <tr>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">&nbsp;</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">&nbsp;</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">&nbsp;</div>
                        </td>
                        <td>
                            <div style="font-size: 14px; font-weight: normal; text-align: right">&nbsp;</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th style="font-size: 14px; text-align: left;"> 
                            <span>A. Certified: Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</span>
                        </th>
                    </tr>    
                </thead>    
                <tbody>
                    <tr>
                        <td style="font-size: 14px; text-align: center;">
                            <div style="font-size: 14px; padding-top: 20px; font-weight: normal; text-align: center">
                                {{ $certifier_expense->first_name }} {{ $certifier_expense->middle_name }} {{ $certifier_expense->last_name }}, {{ $certifier_expense->designation_name }} 
                                &nbsp;
                            </div>
                            <div style="font-size: 14px; padding: 5px; font-weight: normal; text-align: center;">
                                <span style="border-top: solid thin black;">&nbsp;&nbsp;&nbsp;Printed Name, Designation and Signature of Supervisor&nbsp;&nbsp;&nbsp;</span>
                            </div>
                        </td>
                    </tr>  
                </tbody>
            </table>
        </div>
        <div>
            <table style="width: 100%;">
                <thead>
                    <tr>
                        <th colspan="4" style="font-size: 14px; text-align: left">B. Accounting Entry</th>
                    </tr> 
                    <tr>
                        <th style="font-size: 14px; width: 50%; border-right: thin solid black; text-align: center">Accounting Title</th>
                        <th style="font-size: 14px; border-right: thin solid black; text-align: center">UACS Code</th>
                        <th style="font-size: 14px; border-right: thin solid black; text-align: center">Debit</th>
                        <th style="font-size: 14px; text-align: center">Credit</th>
                    </tr>   
                </thead>    
                <tbody>
                    @foreach($dva as $acc)
                    <tr>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">{{ $acc->accounting_title }}</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">{{ $acc->uacs_code }}</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: right">{{ $acc->debit }}</div>
                        </td>
                        <td>
                            <div style="font-size: 14px; font-weight: normal; text-align: right">{{ $acc->credit }}</div>
                        </td>
                    </tr> 
                    @endforeach
                    <tr>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">&nbsp;</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: center">&nbsp;</div>
                        </td>
                        <td style="border-right: thin solid black">
                            <div style="font-size: 14px; font-weight: normal; text-align: right">&nbsp;</div>
                        </td>
                        <td>
                            <div style="font-size: 14px; font-weight: normal; text-align: right">&nbsp;</div>
                        </td>
                    </tr>    
                </tbody>
            </table>
        </div>
        <div>
            <table style=" width: 100%;">
                    <thead>
                        <tr>
                            <th style="font-size: 15px; width: 60%; text-align: left; border-right: thin solid black">C. Certified</th>
                            <th style="font-size: 15px; width: 40%; text-align: left;">D. Approved for Payment</td>
                        </tr>
                    </thead>
                    <tbody>  
                        <tr>
                            <td style="text-align: left; border-right: thin solid black" >
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
                            </td>
                            <td style="text-align: left; font-size: 14px" >
                                <div>
                                    {{ $dv->approved_for_payment }}
                                </div>
                            </td>
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
                            <td style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Signature</td>
                            <td style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;"></td>
                            <td style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Signature</td>
                            <td style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-bottom: thin solid black; font-size: 14px;"></td>
                        </tr>
                        <tr>
                            <td style="vertical-align: middle; width: 10%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 0px; border-right: thin solid black; font-size: 14px">Printed Name</td>
                            <td style="width: 40%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; border-right: thin solid black; font-size: 14px">{{ $certifier->first_name }} {{ $certifier->middle_name }} {{ $certifier->last_name }}&nbsp;</td>
                            <td style="vertical-align: middle; width: 10%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 0px; border-right: thin solid black; font-size: 14px">Printed Name</td>
                            <td style="width: 40%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; font-size: 14px">{{ $approver->first_name }} {{ $approver->middle_name }} {{ $approver->last_name }}&nbsp;</td>
                        </tr>
                        <tr>
                            <td style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px; vertical-align: middle;">Position</td>
                            <td style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">
                                <div style="text-align: center; border-bottom: thin solid black; font-size: 15px">{{ $certifier->designation_name }}&nbsp;</div>
                                <div style="text-align: center; font-size: 14px">Head, Accounting Unit/Authorized Representative</div>
                            </td>
                            <td style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px; vertical-align: middle;">Position</td>
                            <td style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-bottom: thin solid black; font-size: 14px;">
                                <div style="text-align: center; border-bottom: thin solid black; font-size: 15px">{{ $approver->designation_name }}&nbsp;</div>
                                <div style="text-align: center; font-size: 14px">Agency/Head/Authorized Representative</div>
                            </td>
                        </tr>
                        <tr>
                            <td style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Date</td>
                            <td style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;"><b>@if($dv->certified_date == null) &nbsp; @else{{ date("M d, Y", strtotime($dv->certified_date)) }}@endif</b></td>
                            <td style="width: 10%; text-align: center; font-weight: normal; padding: 3px 0px; border-right: thin solid black; border-bottom: thin solid black; font-size: 14px;">Date</td>
                            <td style="width: 40%; text-align: center; font-weight: normal; padding: 3px 0px; border-bottom: thin solid black; font-size: 14px;"><b>@if($dv->approve_date == null) &nbsp; @else{{ date("M d, Y", strtotime($dv->approve_date)) }}@endif</b></td>
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
                            <td colspan="4"style="text-align: left; font-weight: normal; padding: 3px 2px; border-bottom: thin solid black; font-size: 14px; border-right: thin solid black">E. Received Payment</td>
                            <td style="width: 10%; text-align: center; font-weight: normal; font-size: 14px; padding: 3px 0px;">JEV No.</td>
                        </tr>
                        <tr>
                            <td style="width: 10%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">Check/ADA No.</td>
                            <td style="width: 20%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; border-right: thin solid black; font-size: 14px"><b>{{ $dv->ada_no }}</b></td>
                            <td style="width: 20%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 14px">Date</div>
                                <div style="text-align: left; font-size: 14px"><b>@if($dv->payment_check_date == null) &nbsp; @else{{ date("M d, Y", strtotime($dv->payment_check_date)) }}@endif</b></div>
                            </td>
                            <td style="width: 30%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 14px">Bank Name</div>
                                <div style="text-align: left; font-size: 14px"><b>{{ $dv->bank_name }}&nbsp;</b></div>
                            </td>
                            <td style="width: 10%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; font-size: 14px"><b>{{ $dv->jev_no }}</b></td>
                        </tr> 
                        <tr>
                            <td style="width: 10%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">Signature</td>
                            <td style="width: 20%; text-align: center; border-bottom: thin solid black; font-weight: bold; padding: 3px 0px; border-right: thin solid black; font-size: 14px"></td>
                            <td style="width: 20%; text-align: left; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 14px">Date</div>
                                <div style="text-align: left; font-size: 14px">&nbsp;</div>
                            </td>
                            <td style="width: 30%; text-align: center; border-bottom: thin solid black; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 14px">Printed Name</div>
                                <div style="text-align: left; font-size: 14px"><b>{{ $printed_name->first_name }} {{ $printed_name->middle_name }} {{ $printed_name->last_name }}</b></div>
                            </td>
                            <td rowspan="2" style="width: 10%; text-align: center; font-weight: normal; padding: 3px 2px;">
                                <div style="text-align: left; font-size: 14px">Date</div>
                                <div style="text-align: left; font-size: 14px"><b>@if($dv->check_date == null) &nbsp; @else{{ date("M d, Y", strtotime($dv->check_date)) }}@endif</b></div>
                            </td>
                        </tr>  
                        <tr>
                            <td colspan="4" style="text-align: center; font-weight: normal; padding: 3px 2px; border-right: thin solid black; font-size: 14px">
                                <div style="text-align: left; font-size: 14px">Official Receipt/Other Documents</div>
                                <div style="text-align: left; font-size: 14px"><b>{{ $dv->other_docs }}&nbsp;</b></div>
                            </td>
                        </tr>
                    </tbody>
            </table>
        </div>

 
    </div>

    </body>

</html>
