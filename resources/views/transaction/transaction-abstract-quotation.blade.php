@extends('layouts.master')

@section('content')
        <head>
            @if(Session::has('aq_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/abstract-quotation-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">   
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Abstract Quotation</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/abstract-quotation-search']) !!}
                            <div class="form-group">
                                <div class="form-group" style="margin-right: 50px;">
                                    <label for="">Select Request for Quotation Number: </label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                        @foreach($rfqs as $rfq)
                                            <option value="{{ $rfq->id }}">RFQ No. {{ $rfq->id }}</option>
                                        @endforeach
                                    </select>        
                                    <button class="form-control btn btn-success">Select</button>                          
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>          
                    {!! Form::open(['method' => 'post', 'url' => 'transaction/abstract-quotation']) !!}       
                        <input type="hidden" id="Date" name="Date">
                        <input type="hidden" id="transaction_date" name="transaction_date" />

                        <div class="panel-body">
                            <div class="form-inline col-lg-4">
                                <label for="">Supplier 1: </label>   
                                <input class="form-control" type="text" value="{{ $rfq_suppliers[0] }}" readonly>     
                            </div>
                            <div class="form-inline col-lg-4">
                                <label for="">Supplier 2: </label>   
                                <input class="form-control" type="text" value="{{ $rfq_suppliers[1] }}" readonly>    
                            </div>
                            <div class="form-inline col-lg-4">  
                                <label for="">Supplier 3: </label>   
                                <input class="form-control" type="text" value="{{ $rfq_suppliers[2] }}" readonly> 
                            </div>                                
                        </div>  
                        <div class="panel-body">   
                            <div class="form-inline col-lg-4">
                                <label for="">Supplier 4: </label>   
                                <input class="form-control" type="text" value="{{ $rfq_suppliers[3] }}" readonly>  
                            </div>
                            <div class="form-inline col-lg-4">     
                                <label for="">Supplier 5: </label>   
                                <input class="form-control" type="text" value="{{ $rfq_suppliers[4] }}" readonly>   
                            </div>  
                        </div>         

                         <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Unit</th>
                                                    <th>Supplier 1 Amount</th>
                                                    <th>Supplier 2 Amount</th>
                                                    <th>Supplier 3 Amount</th>
                                                    <th>Supplier 4 Amount</th>
                                                    <th>Supplier 5 Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($rfq_items as $i => $rfq_item)
                                            
                                                <tr>
                                                    <td>{{ $rfq_item->item_name }}</td>
                                                    <td>{{ $rfq_item->unit_name }}</td>
                                                    <td><input name="supplier1_amount{{ $i }}" class="form-control" type="number" min="1" @if($rfq_suppliers[0] == null) readonly @endif></td>
                                                    <td><input name="supplier2_amount{{ $i }}" class="form-control" type="number" min="1" @if($rfq_suppliers[1] == null) readonly @endif></td>
                                                    <td><input name="supplier3_amount{{ $i }}" class="form-control" type="number" min="1" @if($rfq_suppliers[2] == null) readonly @endif></td>
                                                    <td><input name="supplier4_amount{{ $i }}" class="form-control" type="number" min="1" @if($rfq_suppliers[3] == null) readonly @endif></td>
                                                    <td><input name="supplier5_amount{{ $i }}" class="form-control" type="number" min="1" @if($rfq_suppliers[4] == null) readonly @endif></td>
                                                </tr>
                                                <input type="hidden" name="add-pr-fk" value="{{ $rfq_item->pr_fk }}">
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <div class="form-group col-lg-4">
                                <label for="">Supervising Admin</label>
                                <select class="form-control" name="add-supervising-admin" id="add-supervising-admin">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-4">
                                <label for="">Admin Officer</label>
                                <select class="form-control" name="add-admin-officer" id="add-admin-officer">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-4">
                                <label for="">Admin Officer</label>
                                <select class="form-control" name="add-admin-officer-2" id="add-admin-officer-2">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-4">
                                <label for="">Board Secretary</label>
                                <select class="form-control" name="add-board-secretary" id="add-board-secretary">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-4">
                                <label for="">VPAF</label>
                                <select class="form-control" name="add-vpaf" id="add-vpaf">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group col-lg-4">
                                <label for="">Approved by</label>
                                <select class="form-control" name="add-approved-by" id="add-approved-by">
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>   
                            </div>                              
                        </div>
                        <button class="btn btn-success" style="float: right; width: 20%;">Convert to PO</button> 
                    {!! Form::close() !!}
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
        </div>
        <!-- /#page-wrapper -->

@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-designation').DataTable({
            responsive: true
        });

        var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());    
        $('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
        $('#transaction_date').val(newDate.getFullYear() + "-" +  (newDate.getMonth()+1) + "-" + newDate.getDate());


    });


    $(document).ready(function(){

        $('#modal-close').click(function(){
            location.reload(true);
        });

        $('#btn-add-supplier').click(function(){

            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: 'purchase-request/add-supplier',
                type: "post",
                data: {
                    'id': $('#select-add-supplier').find('option:selected').val(), 
                    'name' : $('#select-add-supplier').find('option:selected').text()
                },
                dataType: 'json',
                success: function(data){

                    $('#select-add-supplier option[value=' + data.id + ']').remove();
                    $('#table-suppliers tbody').append(
                        '<tr>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' +
                            '<input type="hidden" id="' + data.id + '" value="' + data.id + '" >' +
                            '<button type="button" style="color:red" id="btn-del-supplier"><span class="glyphicon glyphicon-trash"></span></button>' +
                        '</td>' +
                        '</tr>'
                    );

                    if($('#select-add-supplier').has('option').length == 0 ) {
                        $('#btn-add-supplier').prop('disabled', true);
                    }
                }

            });      

        }); 
    
    });

    </script>

@stop