@extends('layouts.vertical', ['title' => 'انواع الحسابات', 'mode' => 'rtl'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">قائمة انواع الحسابات</h4>
        </div>
    </div>
</div>
@if (session()->has('message'))
<div class="col-sm-6">
    <div class="alertPart">
        <div class="alert alert-danger alert-dismissible">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            {{ session('message') }}
        </div>
    </div>
</div>
@endif

<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                  
                    <th>
                        نوع
                    </th>
                  
                </tr>
            </thead>
            <tbody>
                @foreach($AccountTypes as $AccountType)
                <tr>
                   
                    <td>
                        <a  href="#">
                            <b>{{$AccountType->name}}</b>
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
<!-- Plugins js-->
<script src="{{asset('assets/libs/datatables/datatables.min.js')}}"></script>
<script src="{{asset('assets/libs/pdfmake/pdfmake.min.js')}}"></script>

<!-- Page js-->
<script src="{{asset('assets/js/pages/datatables.init.js')}}"></script>

@endsection
