@extends('layouts.vertical', ['title' => ' الموظفين', 'mode' => 'rtl'])

@section('css')
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
<link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;   
        cursor: inherit;
        display: block;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">قائمة  الموظفين</h4>
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

@if (Auth::user()->role_id == 0)
<div class="button-list">
    <a class="btn btn-success btn-rounded waves-effect waves-light" href="{{route('employeesCreate',['admin','employees' ,'create']) }}">
        اضف موظف </a>
</div><br>
@endif

<div class="col-sm-12">
    <div class="card" style="padding: 13px 16px;">
        <div class="card-block">
            <form method="GET" action="{{route('employeesIndex',['admin','employees' ,'index']) }}">
                <div class="row">
                    <div class="col-sm-6">
                        <label for="project_id">البحث بالمشروع</label>
                        <select name="project_id" id="project_id" class="form-control select2">
                            <option value="">اختر مشروعًا</option>
                            @foreach ($projects as $project)
                                <option value="{{ $project->id }}" 
                                    {{ request('project_id') == $project->id ? 'selected' : '' }}>
                                    {{ $project->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-6">
                        <button type="submit" class="btn btn-primary mt-4">بحث</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                  
                    <th>
                        الإسم الأول
                    </th>
                    <th>
                        الإسم الأخير
                    </th>
                    <th>
                        رقم الهوية الوطنية
                    </th>
                    <th>
                        النوع
                    </th>
                    <th>
                        الطول
                    </th>
                    <th>
                        الوزن
                    </th>
                    <th>
                        تاريخ الميلاد
                    </th>
                   
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                <tr>
                   
                    <td>
                        <a  href="{{route('employeesShow',['admin','employees' ,'show',$employee->id] )}}">
                            <b>{{$employee->first_name}}</b>
                        </a>
                    </td>

                    <td>
                        <b>{{$employee->last_name}}</b>
                    </td>

                    <td>
                        <b>{{$employee->national_id}}</b>
                    </td>

                    <td>
                        <b>{{$employee->gender}}</b>
                    </td>

                    <td>
                        <b>{{$employee->height}}</b>
                    </td>

                    <td>
                        <b>{{$employee->weight}}</b>
                    </td>

                    <td>
                        <b>{{$employee->date_of_birth}}</b>
                    </td>
                    
                    <td>
                       <a class="action-icon" href="{{route('employeesShow',['admin','employees' ,'show',$employee->id] )}}">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a class="action-icon" href="{{ route('employeesEdit', ['admin', 'employees', 'edit', $employee->id]) }}">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        <a class="action-icon" href="#" data-toggle="modal" data-target="#danger-alert-modal{{$employee->id}}">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach($employees as $employee)
        <!-- Danger Alert Modal -->
        <div id="danger-alert-modal{{$employee->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <input type="hidden" value="{{$employee->id}}" name="del_id" id="app_id">
                            <i class="dripicons-wrong h1 text-white"></i>
                            <h4 class="mt-2 text-white">هل انت متأكد من الحذف ؟</h4>
                            <p class="mt-3 text-white">هل تريد حقًا حذف هذه السجلات؟ لا يمكن التراجع عن هذه العملية.</p>
                            <button type="button" onclick="location.href='{{ url('/dashboard/admin/employees/destroy/employees/destroy/'.$employee->id) }}';" class="btn btn-light my-2">تاكيد الحذف</button>
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
<!-- JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ asset('assets/libs/summernote/summernote.min.js') }}"></script>

<script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>

<!-- Page js-->
<script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>
<script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>


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
