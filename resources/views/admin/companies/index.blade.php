@extends('layouts.vertical', ['title' => 'الشركات', 'mode' => 'rtl'])

@section('css')
<!-- Plugins css -->
<link href="{{asset('assets/libs/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">قائمة الشركات</h4>
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

<div class="button-list">
    <a class="btn btn-success btn-rounded waves-effect waves-light" href="{{route('companiesCreate',['admin','companies' ,'create']) }}">
        اضف شركة </a>
</div><br>

<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>
                        اللوجو
                    </th>
                    <th>
                        اسم المسؤل
                    </th>
                    <th>
                        الجوال
                    </th>
                    <th>
                        البريد الإلكتروني
                    </th>
                    <th>
                       تاريخ الانشاء
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($companies as $company)
                <tr>
                   
                    <td>
                        @if ($company->logo == null)
                            <img src="{{ asset('assets/images/profile.png') }}" style="width: 50px;" alt="User-Profile-Image">
                        @else
                            <img src="{{ url('companies/', $company->logo) }}" style="width: 50px;" alt="User-Profile-Image">
                        @endif
                    </td>

                    <td>
                        <a  href="{{route('companiesShow',['admin','companies' ,'show',$company->id] )}}">
                            <b>{{$company->name}}</b>
                        </a>
                    </td>

                    <td>
                            <b>{{$company->phone}}</b>
                    </td>

                    <td>
                        {{$company->email}}
                    </td>
                    <td>
                        {{ $company->created_at->format('Y-m-d') }} - ({{ $company->created_at->diffForHumans() }})
                    </td>
                    
                    <td>
                       <a class="action-icon" href="{{route('companiesShow',['admin','companies' ,'show',$company->id] )}}">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a class="action-icon" href="{{ route('companiesEdit', ['admin', 'companies', 'edit', $company->id]) }}">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        <a class="action-icon" href="#" data-toggle="modal" data-target="#danger-alert-modal{{$company->id}}">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach($companies as $company)
        <!-- Danger Alert Modal -->
        <div id="danger-alert-modal{{$company->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <input type="hidden" value="{{$company->id}}" name="del_id" id="app_id">
                            <i class="dripicons-wrong h1 text-white"></i>
                            <h4 class="mt-2 text-white">هل انت متأكد من الحذف ؟</h4>
                            <p class="mt-3 text-white">هل تريد حقًا حذف هذه السجلات؟ لا يمكن التراجع عن هذه العملية.</p>
                            <button type="button" onclick="location.href='{{ url('/dashboard/admin/companies/destroy/companies/destroy/'.$company->id) }}';" class="btn btn-light my-2">تاكيد الحذف</button>
                        </div>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
        @endforeach
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
