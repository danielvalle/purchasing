@extends('layouts.master')

@section('content')


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
                            <span style="font-size: 20px;">Acceptance</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                        {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/acceptance-search']) !!}
                            <div class="panel-body">   
                                <div class="form-group">
                                    <label for="">Purchase Order Number</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                        @foreach($po_nos as $po_no)
                                            <option value="{{ $po_no->id }}">PO No. {{ $po_no->id }}</option>
                                        @endforeach
                                    </select>     
                                </div>
                                <div class="form-group" style="margin-right: 40px;">
                                    <button class="form-control btn btn-success">Select</button>        
                                </div>    

                                <div class="form-group" style="margin-right: 40px;">
                                    <label for="">Purchase Order Date</label>
                                    <input class="form-control" name="select-rfq-no" id="select-rfq-no" readonly>     
                                </div>
                            </div>
                        {!! Form::close() !!}

                        {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/acceptance']) !!}                    
                            <div class="panel-body"> 

                                <div class="form-group col-lg-4">
                                    <label for="">IAR</label>
                                    <input class="form-control" name="select-rfq-no" id="select-rfq-no">                                
                                </div>
     
                                <div class="form-group col-lg-4">
                                    <label for="">Agency</label>
                                    <input class="form-control" name="select-rfq-no" id="select-rfq-no" readonly>                            
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">Supplier</label>
                                    <input class="form-control" name="select-rfq-no" id="select-rfq-no" readonly>                               
                                </div>

                            </div>

                            <div class="panel-body"> 
                                <div class="form-group col-lg-4">
                                    <label for="">Invoice No.</label>
                                    <input class="form-control" name="select-rfq-no" id="select-rfq-no">                                
                                </div>

                                <div class="form-group col-lg-3" >
                                    <label for="">Invoice Date</label>
                                    <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>                           
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="">Requisitioning Office/Dept.</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">   
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id}}">{{ $department->department_name }}</option>
                                        @endforeach  
                                    </select>                       
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
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Item Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>
                        </div>

                            <div class="panel-body" style="width:50%; float: left">   
                                <div class="panel panel-default">
                                    <div class="panel-heading">Inspection</div>
                                    <div class="panel-body"> 
                                        <div class="form-group col-lg-6">
                                            <label for="">Date Inspected</label>
                                            <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>                               
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Inspector</label>
                                            <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">  
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>                              
                                        </div>

                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group col-lg-12">
                                            <label class=""><input type="checkbox" value="">Inspected, verified and found OK at to quantity and specification</label>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body" style="width:50%; float: left">   
                                <div class="panel panel-default">
                                    <div class="panel-heading">Acceptance</div>
                                    <div class="panel-body"> 
                                        <div class="form-group col-lg-6">
                                            <label for="">Date Inspected</label>
                                            <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>                               
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Property Officer</label>
                                            <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">  
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>                                   
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group col-lg-3">
                                            <label class=""><input type="radio" value="" name="rdb-completeness">Complete</label>  
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class=""><input type="radio" value="" name="rdb-completeness">Partial (Pls. Specify Quantity)</label>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <button type="submit" style="float: right; width: 20%;"class="btn btn-success">Submit Acceptance Form</button>  
                    </div>
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