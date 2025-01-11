@extends('layouts.vertical', ['title' => 'تعديل مشروع', 'mode' => 'rtl'])
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
            <h4 class="page-title">تعديل / مشروع</h4>
        </div>
    </div>
</div>
<!-- end page title -->
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
<div class="container-fluid">

<div class="row">
    <div class="col-lg-12 col-xl-12">
        <div class="card-box">
            <ul class="nav nav-pills navtab-bg nav-justified">
                <li class="nav-item">
                    <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link {{ session('active_tab', 'aboutme') == 'aboutme' ? 'active' : '' }}">
                        بيانات المشروع
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link {{ session('active_tab') == 'settings' ? 'active' : '' }}">
                        موظفين للمشروع
                    </a>
                </li> 
            </ul>
            <form method="POST" action="{{ route('projectsUpdate', ['admin', 'projects', 'update']) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$project->id}}">
                <div class="tab-content">
                    <div class="tab-pane fade {{ session('active_tab', 'aboutme') == 'aboutme' ? 'show active' : '' }}" id="aboutme">
                        <br><br>
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-10">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">إسم المشروع</p>
                                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $project->name }}" required>
                                                    @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">مدة المشروع</p>
                                                    <input class="form-control {{ $errors->has('duration') ? 'is-invalid' : '' }}" type="number" name="duration" value="{{ $project->duration  }}" required>
                                                    @if ($errors->has('duration'))
                                                    <span class="text-danger">{{ $errors->first('duration') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">مواقع المشروع</p>
                                                    <input class="form-control {{ $errors->has('locations') ? 'is-invalid' : '' }}" type="text" name="locations" value="{{ $project->locations }}" required>
                                                    @if ($errors->has('locations'))
                                                    <span class="text-danger">{{ $errors->first('locations') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">ورديات المشروع</p>
                                                    <select name="shifts_count" class="form-control select2">
                                                        <option value="1" {{ $project->shifts_count == '1' ? 'selected' : '' }}>1</option>
                                                        <option value="2" {{ $project->shifts_count == '2' ? 'selected' : '' }}>2</option>
                                                        <option value="3" {{ $project->shifts_count == '3' ? 'selected' : '' }}>3</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                               
                                                <div class="col-sm-12">
                                                    <p class="m-b-10 f-w-600">عدد أفراد المشروع</p>
                                                    <input class="form-control {{ $errors->has('members_count') ? 'is-invalid' : '' }}" type="number" name="members_count" value="{{ $project->members_count }}" required>
                                                    @if ($errors->has('members_count'))
                                                    <span class="text-danger">{{ $errors->first('members_count') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                       
                                        </div>
                                        
                                    </div>
                                </div>
                                <br><br>
                                <div class="form-group">
                                    <button class="btn btn-danger btn-rounded waves-effect waves-light" type="submit"
                                        style="float: left;width: 15%;">
                                        حفظ
                                    </button>
                                    <br><br>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div> <!-- end tab-pane -->
                    <!-- end about me section content -->
              
                    <!-- end timeline content-->

                    <div class="tab-pane fade {{ session('active_tab') == 'settings' ? 'show active' : '' }}" id="settings">
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-12">
                                        <div class="card-block">


                                           

                                           
                                            <p class="m-b-10 f-w-600">إضافة موظف الي مشروع <span style="color: red">( {{ $project->name}} )</span> </p><br>
                                             <!-- إضافة موظف -->
                                            <form action="{{ route('assign-person', $project->id) }}" method="POST" class="mt-3" id="assign-person-form">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <select name="person_id" class="form-control select2" required>
                                                            <option value="">اختر موظفًا</option>
                                                            @foreach ($persons as $person)
                                                                <option value="{{ $person->id }}">{{ $person->first_name }} {{ $person->last_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <select name="role" class="form-control select2" required>
                                                            <option value="">الدور</option>
                                                            @foreach ($roles as $role)
                                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    <div class="col-md-4">
                                                        <button type="submit" id="assign-person-btn"  class="btn btn-primary">إضافة</button>
                                                    </div>
                                                </div>
                                            </form>

                                            <br><hr>
                                            <h5>الموظفون:</h5>
                                            <ul>
                                                @foreach ($project->persons as $person)
                                                <div class="row" style="border: 1px solid #f4f4f4;">
                                                    <div class="col-md-5" style="padding: 10px 0px 10px 0px;">
                                                        {{ $person->first_name }} {{ $person->last_name }}
                                                    </div>

                                                    <div class="col-md-3">
                                                        {{ $person->pivot->role }}
                                                    </div>
                                                    <div class="col-md-2">
                                                        <form action="{{ route('remove-person', [$project->id, $person->id]) }}" method="POST" class="d-inline">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" style="background-color: red;">حذف</button>
                                                        </form>
                                                    </div>
                                                </div>

                                                @endforeach
                                            </ul>
                                            
                                           
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end settings content-->

                </div> <!-- end tab-content -->
              
            
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
<script> 
document.addEventListener('DOMContentLoaded', function () {
    const button = document.querySelector('#assign-person-btn'); // استخدم معرفًا فريدًا للزر
    const form = document.getElementById('assign-person-form');

    if (button && form) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            form.submit();
        });
    } else {
        console.error('Form or button not found in the DOM');
    }


    const activeTab = '{{ session('active_tab', 'aboutme') }}';
        document.querySelector(`a[href="#${activeTab}"]`).click();
});

    
</script>
@endsection
