@extends('layouts.vertical', ['title' => 'تعديل بيانات', 'mode' => 'rtl'])
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
            <h4 class="page-title">تعديل / أفراد</h4>
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
                        البيانات الشخصيه
                    </a>
                </li>
            </ul>
            <form method="POST" action="{{ route('personsUpdate', ['admin', 'persons', 'update']) }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$person->id}}">
                <div class="tab-content">
                    <div class="tab-pane show active" id="aboutme">
                        <br><br>
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-2 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">
                                                @if($person->id_image == null)
                                                    <img src="{{asset('assets/images/profile.png')}}" style="width:180px;"  alt="User-Profile-Image">
                                                 @else
                                                    <img  src="{{url('employees/',$person->id_image)}}" style="width:180px;"  alt="User-Profile-Image">
                                                @endif
                                            </div>
                                            <span class="btn btn-primary btn-file"
                                                style="margin: -92px -107px 0 0; border-radius: 7em; border-color: #01414d;">
                                                <i class="mdi mdi-square-edit-outline"></i> <input type="file" name="image">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الاسم الاول</p>
                                                    <input
                                                        class="form-control {{ $errors->has('first_name') ? 'is-invalid' : '' }}"
                                                        type="text" name="first_name" value="{{ $person->first_name }}" required>
                                                    @if ($errors->has('first_name'))
                                                        <span class="text-danger">{{ $errors->first('first_name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الاسم الاخير</p>
                                                    <input
                                                        class="form-control {{ $errors->has('last_name') ? 'is-invalid' : '' }}"
                                                        type="text" name="last_name" value="{{ $person->last_name }}">
                                                    @if ($errors->has('last_name'))
                                                        <span class="text-danger">{{ $errors->first('last_name') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">رقم الهوية الوطنية</p>
                                                    <input
                                                        class="form-control {{ $errors->has('national_id') ? 'is-invalid' : '' }}"
                                                        type="text" name="national_id" value="{{ $person->national_id }}">
                                                    @if ($errors->has('national_id'))
                                                        <span class="text-danger">{{ $errors->first('national_id') }}</span>
                                                    @endif
                                                </div>
                                                <!--
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">كلمه المرور</p>
                                                    <input
                                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        type="password" name="password" readonly>
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            -->
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">تاريخ الميلاد</p>
                                                    <input
                                                        class="form-control {{ $errors->has('date_of_birth') ? 'is-invalid' : '' }}"
                                                        type="date" name="date_of_birth" value="{{ $person->date_of_birth }}"
                                                        required>
                                                    @if ($errors->has('date_of_birth'))
                                                        <span class="text-danger">{{ $errors->first('date_of_birth') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">النوع</p>
                                                    <select name="gender" class="form-control select2">
                                                        <option value="ذكر" {{ $person->gender == 'ذكر' ? 'selected' : '' }}>ذكر</option>
                                                        <option value="انثي" {{ $person->gender == 'انثي' ? 'selected' : '' }}>انثي</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الطول</p>
                                                    <input
                                                        class="form-control {{ $errors->has('height') ? 'is-invalid' : '' }}"
                                                        type="text" name="height"
                                                        value="{{ $person->height }}" required>
                                                    @if ($errors->has('height'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('height') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الوزن</p>
                                                    <input
                                                        class="form-control {{ $errors->has('weight') ? 'is-invalid' : '' }}"
                                                        type="text" name="weight" value="{{ $person->weight }}" required>
                                                    @if ($errors->has('weight'))
                                                        <span class="text-danger">{{ $errors->first('weight') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الراتب </p>
                                                    <input
                                                        class="form-control {{ $errors->has('salary') ? 'is-invalid' : '' }}"
                                                        type="text" name="salary"
                                                        value="{{ $person->salary }}" required>
                                                    @if ($errors->has('salary'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('salary') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الرقم الوظيفي</p>
                                                    <input
                                                        class="form-control {{ $errors->has('job_number') ? 'is-invalid' : '' }}"
                                                        type="text" name="job_number" value="{{ $person->job_number }}">
                                                    @if ($errors->has('job_number'))
                                                        <span class="text-danger">{{ $errors->first('job_number') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end tab-pane -->
                    <!-- end about me section content -->

                  
                    <!-- end timeline content-->

                   
                    <!-- end settings content-->

                </div> <!-- end tab-content -->
                <div class="form-group">
                    <button class="btn btn-danger btn-rounded waves-effect waves-light" type="submit"
                        style="float: left;width: 15%;">
                        حفظ
                    </button>
                    <br><br>
                </div>
            </form>
        </div> <!-- end card-box-->

    </div> <!-- end col -->
    <!-- end col -->
</div>
</div>



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
