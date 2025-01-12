@extends('layouts.vertical', ['title' => 'إنشاء طلب', 'mode' => 'rtl'])
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
@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h4 class="page-title">إنشاء / طلب</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

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

    <div class="container-fluid">


        <div class="row">
         
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <ul class="nav nav-pills navtab-bg nav-justified">
                        <li class="nav-item">
                            <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link active">
                               بيانات الطلب
                            </a>
                        </li>
                       
                    </ul>
                    <form method="POST" action="{{ route('personleavesStore', ['admin', 'personleaves', 'store']) }}"  enctype="multipart/form-data">
                        @csrf
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
                                                                        <select name="person_id" class="form-control select2" required>
                                                                            <option value="">اختر موظفًا</option>
                                                                            @foreach ($persons as $person)
                                                                                <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">نوع الطلب</p>
                                                                        <select name="leave_type" id="leave_type" class="form-control select2" required>
                                                                            <option value="إجازة">إجازة</option>
                                                                            <option value="تغطية">تغطية</option>
                                                                            <option value="مخالفة">مخالفة</option>
                                                                            <option value="استقالة">استقالة</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">تاريخ البدايه</p>
                                                                        <input class="form-control {{ $errors->has('start_date') ? 'is-invalid' : '' }}" type="date" name="start_date" value="{{ old('start_date', '') }}" required>
                                                                        @if ($errors->has('start_date'))
                                                                        <span class="text-danger">{{ $errors->first('start_date') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">تاريخ النهايه</p>
                                                                        <input class="form-control {{ $errors->has('end_date') ? 'is-invalid' : '' }}" type="date" name="end_date" value="{{ old('end_date', '') }}" required>
                                                                        @if ($errors->has('end_date'))
                                                                        <span class="text-danger">{{ $errors->first('end_date') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <p class="m-b-10 f-w-600">السبب</p>
                                                                        <textarea name="reason" rows="5"  id="reason" class="form-control" required></textarea>
                                                                    </div>
                                                                    
                                                                </div>
                                                               
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       
                            </div> <!-- end tab-pane -->
                            <!-- end about me section content -->

                            <!-- end timeline content

                            <div class="tab-pane" id="settings">
                                <div class="col-xl-12 col-md-12">
                                    <div class="card user-card-full">
                                        <div class="row m-l-0 m-r-0">
                                            <div class="col-sm-12">
                                                <div class="card-block">
                                                    <p class="m-b-10 f-w-600">تغيير كلمه المرور</p><br>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p class="m-b-10 f-w-600">كلمه المرور الحاليه</p>
                                                            <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" type="password" name="password" value="{{ old('password', '') }}">
                                                            @if ($errors->has('password'))
                                                            <span class="text-danger">{{ $errors->first('password') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <p class="m-b-10 f-w-600">كلمه المرور الجديده</p>
                                                            <input class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}" type="password" name="new_password" value="{{ old('new_password', '') }}">
                                                            @if ($errors->has('new_password'))
                                                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- end settings content-->
                           
                        </div> <!-- end tab-content -->
                        <div class="form-group">
                            <button class="btn btn-danger btn-rounded waves-effect waves-light" type="submit" style="float: left;width: 15%;">
                                حفظ
                            </button>
                            <br><br>
                        </div>
                    </form>
                </div> <!-- end card-box-->

            </div> <!-- end col -->
        </div>
        <!-- end row-->

    </div> <!-- container -->

   
@endsection

@section('script')
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/summernote/summernote.min.js') }}"></script>

    <script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>
@endsection
