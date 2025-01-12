@extends('layouts.vertical', ['title' => 'تفاصيل الطلب', 'mode' => 'rtl'])
@section('css')
    <!-- Plugins css -->
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

@section('tab_title', 'تفاصيل الطلب')
@section('content')

<br>
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card-box">
                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            البيانات الطلب
                        </a>
                    </li>
                   
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="aboutme">
                        <br><br>
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                   
                                    <div class="col-sm-10">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الموظف</p>
                                                    <p class="form-control-static">{{ $leave->person->first_name }} {{ $leave->person->last_name }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">نوع الطلب</p>
                                                    <p class="form-control-static">
                                                        @switch($leave->leave_type)
                                                            @case('إجازة')
                                                                إجازة
                                                                @break
                                                            @case('تغطية')
                                                                تغطية
                                                                @break
                                                            @case('مخالفة')
                                                                مخالفة
                                                                @break
                                                            @case('استقالة')
                                                                استقالة
                                                                @break
                                                            @default
                                                                غير محدد
                                                        @endswitch
                                                    </p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">تاريخ البداية</p>
                                                    <p class="form-control-static">{{ $leave->start_date }}</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">تاريخ النهاية</p>
                                                    <p class="form-control-static">{{ $leave->end_date }}</p>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <p class="m-b-10 f-w-600">السبب</p>
                                                    <p class="form-control-static">{{ $leave->reason }}</p>
                                                </div>
                                            </div>

                                            <br>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <form method="POST" action="{{ route('person_leaves.updateStatus', $leave->id) }}">
                                                        @csrf
                                                        @method('PATCH')
                                                        <p class="m-b-10 f-w-600">الحالة</p>
                                                        <select name="status" class="form-control select2" required>
                                                            <option value="pending" {{ $leave->status == 'pending' ? 'selected' : '' }}>بالانتظار</option>
                                                            <option value="approved" {{ $leave->status == 'approved' ? 'selected' : '' }}>مقبول</option>
                                                            <option value="rejected" {{ $leave->status == 'rejected' ? 'selected' : '' }}>مرفوض</option>
                                                        </select>
                                                        <br>
                                                        <button type="submit" class="btn btn-success">تحديث الحالة</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>

                    </div> <!-- end tab-pane -->
                    <!-- end about me section content -->

                   


                </div> <!-- end tab-content -->
            </div> <!-- end card-box-->

           
           
        </div> <!-- end col -->
    </div>

@endsection

@section('script')

<script>
$( "#currency" ).select2({
    theme: "bootstrap"
});
</script>
<!-- Plugins js-->
 <!-- Plugins js-->
 <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
 <script src="{{ asset('assets/libs/summernote/summernote.min.js') }}"></script>

 <script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>

 <!-- Page js-->
 <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>
 <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>
@endsection
