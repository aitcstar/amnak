@extends('layouts.vertical', ['title' => 'تعديل أدوار', 'mode' => 'rtl'])
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
            <h4 class="page-title">تعديل / أدوار</h4>
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
                        بيانات أدوار
                    </a>
                </li>
            </ul>
            <form method="POST" action="{{ route('rolesUpdate', ['admin', 'roles', 'update']) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$role->id}}">
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
                                                    <p class="m-b-10 f-w-600">الإسم</p>
                                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $role->name }}" required>
                                                    @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
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
