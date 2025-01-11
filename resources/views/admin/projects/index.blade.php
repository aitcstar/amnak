@extends('layouts.vertical', ['title' => 'المشاريع', 'mode' => 'rtl'])

@section('css')
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">

@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">

            <h4 class="page-title">قائمة المشاريع</h4>
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
    <a class="btn btn-success btn-rounded waves-effect waves-light" href="{{route('projectsCreate',['admin','projects' ,'create']) }}">
        اضف مشروع </a>
</div><br>
@endif

<div class="card">
    <div class="card-body">
        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
            <thead>
                <tr>
                    <th>
                        إسم المشروع
                    </th>
                    <th>
                        مدة المشروع
                    </th>
                    <th>
                        مواقع المشروع
                    </th>
                    <th>
                        عدد أفراد المشروع
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($projects as $project)
                <tr>
                    <td>
                        <a  href="{{route('projectsShow',['admin','projects' ,'show',$project->id] )}}">
                            <b>{{$project->name}}</b>
                        </a>
                    </td>

                    <td>
                        <b>{{$project->duration}} / يوم</b>
                    </td>

                    <td>
                        <b>{{$project->locations}}</b>
                    </td>
                    <td>
                        <b>{{$project->members_count}}  </b>
                    </td>
                    
                    <td>
                       <a class="action-icon" href="{{route('projectsShow',['admin','projects' ,'show',$project->id] )}}">
                            <i class="mdi mdi-eye"></i>
                        </a>
                        <a class="action-icon" href="{{ route('projectsEdit', ['admin', 'projects', 'edit', $project->id]) }}">
                            <i class="mdi mdi-square-edit-outline"></i>
                        </a>
                        <a class="action-icon" href="#" data-toggle="modal" data-target="#danger-alert-modal{{$project->id}}">
                            <i class="mdi mdi-delete"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @foreach($projects as $project)
        <!-- Danger Alert Modal -->
        <div id="danger-alert-modal{{$project->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content modal-filled bg-danger">
                    <div class="modal-body p-4">
                        <div class="text-center">
                            <input type="hidden" value="{{$project->id}}" name="del_id" id="app_id">
                            <i class="dripicons-wrong h1 text-white"></i>
                            <h4 class="mt-2 text-white">هل انت متأكد من الحذف ؟</h4>
                            <p class="mt-3 text-white">هل تريد حقًا حذف هذه السجلات؟ لا يمكن التراجع عن هذه العملية.</p>
                            <button type="button" onclick="location.href='{{ url('/dashboard/admin/projects/destroy/projects/destroy/'.$project->id) }}';" class="btn btn-light my-2">تاكيد الحذف</button>
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
