@extends('layouts.vertical', ['title' => 'تعديل شركة', 'mode' => 'rtl'])
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
            <h4 class="page-title">تعديل / شركة</h4>
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
                        بيانات الحساب
                    </a>
                </li>
            {{--
                <li class="nav-item">
                    <a href="#timeline" data-toggle="tab" aria-expanded="false" class="nav-link">
                        التفضيلات و الاذونات
                    </a>
                </li>
            --}}
                <li class="nav-item">
                    <a href="#settings" data-toggle="tab" aria-expanded="false" class="nav-link">
                        حماية
                    </a>
                </li>
            </ul>
            <form method="POST" action="{{ route('companiesUpdate', ['admin', 'companies', 'update']) }}"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$company->id}}">
                <div class="tab-content">
                    <div class="tab-pane show active" id="aboutme">
                        <br><br>
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-2 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">
                                                @if($company->logo == null)
                                                    <img src="{{asset('assets/images/profile.png')}}" style="width: 200px;" alt="User-Profile-Image">
                                                 @else
                                                    <img  src="{{url('companies/',$company->logo)}}"  style="width: 200px;" alt="User-Profile-Image">
                                                @endif
                                            </div>
                                            <span class="btn btn-primary btn-file"
                                                style="margin: -92px -107px 0 0; border-radius: 7em; border-color: #01414d;">
                                                <i class="mdi mdi-square-edit-outline"></i> <input type="file"
                                                    name="logo">
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">اسم المسؤل</p>
                                                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ $company->name }}" required>
                                                    @if ($errors->has('name'))
                                                    <span class="text-danger">{{ $errors->first('name') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الجوال</p>
                                                    <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" value="{{ $company->phone  }}">
                                                    @if ($errors->has('phone'))
                                                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">البريد الإلكتروني</p>
                                                    <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" value="{{ $company->email }}" readonly>
                                                    @if ($errors->has('email'))
                                                    <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    &nbsp;
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">رابط الموقع الالكتروني</p>
                                                    <input class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}" type="text" name="website" value="{{  $company->website }}" required>
                                                    @if ($errors->has('website'))
                                                    <span class="text-danger">{{ $errors->first('website') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">العنوان</p>
                                                    <input class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" type="text" name="address" value="{{ $company->address }}" required>
                                                    @if ($errors->has('address'))
                                                    <span class="text-danger">{{ $errors->first('address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        {{--
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">العنوان الثابت</p>
                                                    <input class="form-control {{ $errors->has('fixed_address') ? 'is-invalid' : '' }}" type="text" name="fixed_address" value="{{$company->fixed_address }}" required>
                                                    @if ($errors->has('fixed_address'))
                                                    <span class="text-danger">{{ $errors->first('fixed_address') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">المدينه</p>
                                                    <input class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}" type="text" name="city" value="{{$company->city}}" required>
                                                    @if ($errors->has('city'))
                                                    <span class="text-danger">{{ $errors->first('city') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">نسبه اجور التحويلات </p>
                                                    <input class="form-control {{ $errors->has('rate_transfer') ? 'is-invalid' : '' }}" type="text" name="rate_transfer" value="{{ $user->rate_transfer }}" required>
                                                    @if ($errors->has('rate_transfer'))
                                                    <span class="text-danger">{{ $errors->first('rate_transfer') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">نسبه اجور الاعتمادات</p>
                                                    <input class="form-control {{ $errors->has('rate_credit') ? 'is-invalid' : '' }}" type="text" name="rate_credit" value="{{ $user->rate_credit }}" required>
                                                    @if ($errors->has('rate_credit'))
                                                    <span class="text-danger">{{ $errors->first('rate_credit') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end tab-pane -->
                    <!-- end about me section content -->
                {{--
                    <div class="tab-pane" id="timeline">
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-12">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">العمله الاساسيه</p>
                                                    <select name="currency_id" id="currency" class="form-control select2">
                                                        @foreach ($currencies as $currency )
                                                            <option value="{{ $currency->id}}" {{($currency->id == $user->currency_id)?' selected':''}}>{{ $currency->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">المناطق الزمنية</p>
                                                    <select name="time_zones" class="form-control select2">
                                                            <option value="-12:00" {{($user->time_zones =='-12:00')?' selected':''}}>(GMT -12:00) Eniwetok, Kwajalein</option>
                                                            <option value="-11:00" {{($user->time_zones =='-11:00')?' selected':''}}>(GMT -11:00) Midway Island, Samoa</option>
                                                            <option value="-10:00" {{($user->time_zones =='-10:00')?' selected':''}}>(GMT -10:00) Hawaii</option>
                                                            <option value="-09:50" {{($user->time_zones =='-09:50')?' selected':''}}>(GMT -9:30) Taiohae</option>
                                                            <option value="-09:00" {{($user->time_zones =='-09:00')?' selected':''}}>(GMT -9:00) Alaska</option>
                                                            <option value="-08:00" {{($user->time_zones =='-08:00')?' selected':''}}>(GMT -8:00) Pacific Time (US &amp; Canada)</option>
                                                            <option value="-07:00" {{($user->time_zones =='-07:00')?' selected':''}}>(GMT -7:00) Mountain Time (US &amp; Canada)</option>
                                                            <option value="-06:00" {{($user->time_zones =='-06:00')?' selected':''}}>(GMT -6:00) Central Time (US &amp; Canada), Mexico City</option>
                                                            <option value="-05:00" {{($user->time_zones =='-05:00')?' selected':''}}>(GMT -5:00) Eastern Time (US &amp; Canada), Bogota, Lima</option>
                                                            <option value="-04:50" {{($user->time_zones =='-04:50')?' selected':''}}>(GMT -4:30) Caracas</option>
                                                            <option value="-04:00" {{($user->time_zones =='-04:00')?' selected':''}}>(GMT -4:00) Atlantic Time (Canada), Caracas, La Paz</option>
                                                            <option value="-03:50" {{($user->time_zones =='-03:50')?' selected':''}}>(GMT -3:30) Newfoundland</option>
                                                            <option value="-03:00" {{($user->time_zones =='-03:00')?' selected':''}}>(GMT -3:00) Brazil, Buenos Aires, Georgetown</option>
                                                            <option value="-02:00" {{($user->time_zones =='-02:00')?' selected':''}}>(GMT -2:00) Mid-Atlantic</option>
                                                            <option value="-01:00" {{($user->time_zones =='-01:00')?' selected':''}}>(GMT -1:00) Azores, Cape Verde Islands</option>
                                                            <option value="+00:00" {{($user->time_zones =='+00:00')?' selected':''}}>(GMT) Western Europe Time, London, Lisbon, Casablanca</option>
                                                            <option value="+01:00" {{($user->time_zones =='+10:00')?' selected':''}}>(GMT +1:00) Brussels, Copenhagen, Madrid, Paris</option>
                                                            <option value="+02:00" {{($user->time_zones =='+02:00')?' selected':''}}>(GMT +2:00) Kaliningrad, South Africa</option>
                                                            <option value="+03:00" {{($user->time_zones =='+03:00')?' selected':''}}>(GMT +3:00) Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                                            <option value="+03:50" {{($user->time_zones =='+03:50')?' selected':''}}>(GMT +3:30) Tehran</option>
                                                            <option value="+04:00" {{($user->time_zones =='+04:00')?' selected':''}}>(GMT +4:00) Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                                            <option value="+04:50" {{($user->time_zones =='+04:50')?' selected':''}}>(GMT +4:30) Kabul</option>
                                                            <option value="+05:00" {{($user->time_zones =='+05:00')?' selected':''}}>(GMT +5:00) Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                                            <option value="+05:50" {{($user->time_zones =='+05:50')?' selected':''}}>(GMT +5:30) Bombay, Calcutta, Madras, New Delhi</option>
                                                            <option value="+05:75" {{($user->time_zones =='+05:75')?' selected':''}}>(GMT +5:45) Kathmandu, Pokhara</option>
                                                            <option value="+06:00" {{($user->time_zones =='+06:00')?' selected':''}}>(GMT +6:00) Almaty, Dhaka, Colombo</option>
                                                            <option value="+06:50" {{($user->time_zones =='+06:50')?' selected':''}}>(GMT +6:30) Yangon, Mandalay</option>
                                                            <option value="+07:00" {{($user->time_zones =='+07:00')?' selected':''}}>(GMT +7:00) Bangkok, Hanoi, Jakarta</option>
                                                            <option value="+08:00" {{($user->time_zones =='+08:00')?' selected':''}}>(GMT +8:00) Beijing, Perth, Singapore, Hong Kong</option>
                                                            <option value="+08:75" {{($user->time_zones =='+08:75')?' selected':''}}>(GMT +8:45) Eucla</option>
                                                            <option value="+09:00" {{($user->time_zones =='+09:00')?' selected':''}}>(GMT +9:00) Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                                            <option value="+09:50" {{($user->time_zones =='+09:50')?' selected':''}}>(GMT +9:30) Adelaide, Darwin</option>
                                                            <option value="+10:00" {{($user->time_zones =='+10:00')?' selected':''}}>(GMT +10:00) Eastern Australia, Guam, Vladivostok</option>
                                                            <option value="+10:50" {{($user->time_zones =='+10:50')?' selected':''}}>(GMT +10:30) Lord Howe Island</option>
                                                            <option value="+11:00" {{($user->time_zones =='+11:00')?' selected':''}}>(GMT +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                                            <option value="+11:50" {{($user->time_zones =='+11:50')?' selected':''}}>(GMT +11:30) Norfolk Island</option>
                                                            <option value="+12:00" {{($user->time_zones =='+12:00')?' selected':''}}>(GMT +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                                                            <option value="+12:75" {{($user->time_zones =='+12:75')?' selected':''}}>(GMT +12:45) Chatham Islands</option>
                                                            <option value="+13:00" {{($user->time_zones =='+13:00')?' selected':''}}>(GMT +13:00) Apia, Nukualofa</option>
                                                            <option value="+14:00" {{($user->time_zones =='+14:00')?' selected':''}}>(GMT +14:00) Line Islands, Tokelau</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <p class="m-b-10 f-w-600">الاشعارات</p>
                                            <div class="row">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" @if($user->send_receive == 'on') checked @endif class="custom-control-input" id="customSwitch1" name="send_receive">
                                                    <label class="custom-control-label" for="customSwitch1" style="color: #232323;">أقوم بإرسال أو استقبال العملات الرقمية</label>
                                                  </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" @if($user->receive_merchant == 'on') checked @endif class="custom-control-input" id="customSwitch2" name="receive_merchant">
                                                    <label class="custom-control-label" for="customSwitch2"  style="color: #232323;">أتلقى طلب التاجر</label>
                                                  </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" @if($user->recommendations_account == 'on') checked  @endif class="custom-control-input" id="customSwitch3" name="recommendations_account">
                                                    <label class="custom-control-label" for="customSwitch3"  style="color: #232323;">هناك توصيات لحسابي</label>
                                                  </div>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                --}}
                    <!-- end timeline content-->

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
                                                    <input
                                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        type="password" name="password">
                                                    @if ($errors->has('password'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">كلمه المرور الجديده</p>
                                                    <input
                                                        class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}"
                                                        type="password" name="new_password"
                                                        value="{{ old('new_password', '') }}">
                                                    @if ($errors->has('new_password'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('new_password') }}</span>
                                                    @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
