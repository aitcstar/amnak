@extends('layouts.vertical', ['title' => 'إنشاء مشروع', 'mode' => 'rtl'])
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

                <h4 class="page-title">إنشاء / مشروع</h4>
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
بيانات المشروع
                            </a>
                        </li>
                        
                      
                        
                    </ul>
                    <form method="POST" action="{{ route('projectsStore', ['admin', 'projects', 'store']) }}"  enctype="multipart/form-data">
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
                                                                        <p class="m-b-10 f-w-600">اسم المشروع</p>
                                                                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('name', '') }}" required>
                                                                        @if ($errors->has('name'))
                                                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">مدة المشروع</p>
                                                                        <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" value="{{ old('duration', '') }}" required>
                                                                        @if ($errors->has('duration'))
                                                                        <span class="text-danger">{{ $errors->first('duration') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">مواقع المشروع</p>
                                                                        <input class="form-control {{ $errors->has('locations') ? 'is-invalid' : '' }}" type="text" name="locations" value="{{ old('locations', '') }}" required>
                                                                        @if ($errors->has('locations'))
                                                                        <span class="text-danger">{{ $errors->first('locations') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">ورديات المشروع</p>
                                                                        <select name="shifts_count" class="form-control select2">
                                                                            <option value="1">1</option>
                                                                            <option value="2">2</option>
                                                                            <option value="3">3</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <p class="m-b-10 f-w-600">عدد أفراد المشروع</p>
                                                                        <input class="form-control {{ $errors->has('members_count') ? 'is-invalid' : '' }}" type="number" name="members_count" value="{{ old('members_count', '') }}" required>
                                                                        @if ($errors->has('members_count'))
                                                                        <span class="text-danger">{{ $errors->first('members_count') }}</span>
                                                                        @endif
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
