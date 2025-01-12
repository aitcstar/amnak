@extends('layouts.vertical', ['title' => ' الطلبات', 'mode' => 'rtl'])

@section('css')
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">


@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">قائمة  الطلبات</h4>
        </div>
    </div>
</div>


@if (session()->has('message'))
<div class="col-sm-6">
    <div class="alertPart">
        <div class="alert alert-success alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
    </div>
</div>
@endif

@if (Auth::user()->role_id == 0)
<div class="button-list">
    <a class="btn btn-success btn-rounded waves-effect waves-light" href="{{route('personleavesCreate',['admin','personleaves' ,'create']) }}">
        اضف طلب </a>
</div><br>
@endif

<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                  
                    <th>
                        اسم الموظف
                    </th>
                    <th>
                       نوع الطلب
                    </th>
                    <th>
                       تاريخ البدايه
                    </th>
                    <th>
                        تاريه النهايه
                    </th>
                    <th>
                        السبب
                    </th>
                    <th>
                        الحاله
                    </th>
                   
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($leaves as $leave)
                <tr>
                   
                    <td>
                        <a  href="{{route('personleavesShow',['admin','personleaves' ,'show',$leave->id] )}}">
                            <b>{{$leave->person->first_name}} {{$leave->person->last_name}}</b>
                        </a>
                    </td>

                    <td>
                        <b>{{$leave->leave_type  }}</b>
                    </td>

                    <td>
                        <b>{{$leave->start_date}}</b>
                    </td>

                    <td>
                        <b>{{$leave->end_date}}</b>
                    </td>

                    <td>
                        <b>{{$leave->reason}}</b>
                    </td>

                    <td>
                        <b>
                            @switch($leave->status)
                            @case('pending')
                                بالانتظار
                                @break
                        
                            @case('approved')
                                مقبول
                                @break
                        
                            @case('rejected')
                                مرفوض
                                @break
                        
                            @default
                                غير معروف
                        @endswitch
                        
                        </b>
                    </td>

                    <td>
                       <a class="action-icon" href="{{route('personleavesShow',['admin','personleaves' ,'show',$leave->id] )}}">
                            <i class="mdi mdi-eye"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       
    </div>


</div>



@endsection
@section('script')
<!-- Plugins js
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>
-->
<!-- Page js
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

-->
<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>



<script>
$(document).ready(function () {
    $('#datatable-buttons').DataTable({
        dom: 'Bfrtip', // لإضافة الأزرار
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'تصدير إلى Excel',
                className: 'btn btn-success'
            },
            {
                extend: 'print',
                text: 'طباعة',
                className: 'btn btn-primary'
            }
        ]
    });
});
</script>

@endsection
