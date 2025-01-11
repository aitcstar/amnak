@extends('layouts.vertical', ['title' => 'تفاصيل الحساب', 'mode' => 'rtl'])
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

@section('tab_title', 'حساب المستخدم')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card-box">
                <form method="POST" action="{{ route('useractive', ['admin', 'users', 'useractive',$user->id]) }}"  enctype="multipart/form-data">
                    @csrf
                <div class="row">
                    <div class="col-sm-6">
                        @if($user->active == 1)
                        <b>الحاله : مفعل </b>
                        <input type="submit" value="مفعل" name="active"  style="background-color: green;    color: white;" />
                        
                        @else
                        <b>الحاله : غير مفعل</b>
                        <input type="submit" value="غير مفعل" name="active" style="background-color: red;    color: white;" >

                      
                        @endif
                    </div>
                </div>
            </form>

                <ul class="nav nav-pills navtab-bg nav-justified">
                    <li class="nav-item">
                        <a href="#aboutme" data-toggle="tab" aria-expanded="true" class="nav-link active">
                            البيانات الشخصيه
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#timeline" data-toggle="tab" aria-expanded="false" class="nav-link">
                            التفضيلات و الاذونات
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane show active" id="aboutme">
                        <br><br>
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-2 bg-c-lite-green user-profile">
                                        <div class="card-block text-center text-white">
                                            <div class="m-b-25">

                                                @if ($user->image == null)
                                                    <img src="{{ asset('assets/images/profile.png') }}"
                                                        style="border-radius: 50%;" alt="User-Profile-Image">
                                                @else
                                                    <img src="{{ url('profile/', $user->image) }}"
                                                        style="border-radius: 50%;" alt="User-Profile-Image">
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-sm-10">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الاسم الاول</p>
                                                    <input
                                                        class="form-control {{ $errors->has('first') ? 'is-invalid' : '' }}"
                                                        type="text" name="first" value="{{ $user->first }}" required>
                                                    @if ($errors->has('first'))
                                                        <span class="text-danger">{{ $errors->first('first') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">الاسم الاخير</p>
                                                    <input
                                                        class="form-control {{ $errors->has('second') ? 'is-invalid' : '' }}"
                                                        type="text" name="second" value="{{ $user->second }}">
                                                    @if ($errors->has('second'))
                                                        <span class="text-danger">{{ $errors->first('second') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">البريد الالكترونى</p>
                                                    <input
                                                        class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                        type="email" name="email" value="{{ $user->email }}">
                                                    @if ($errors->has('email'))
                                                        <span class="text-danger">{{ $errors->first('email') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">كلمه المرور</p>
                                                    <input
                                                        class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                        type="password" name="password" readonly>
                                                    @if ($errors->has('password'))
                                                        <span class="text-danger">{{ $errors->first('password') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">تاريخ الميلاد</p>
                                                    <input
                                                        class="form-control {{ $errors->has('birth_date') ? 'is-invalid' : '' }}"
                                                        type="date" name="birth_date" value="{{ $user->birth_date }}"
                                                        required>
                                                    @if ($errors->has('birth_date'))
                                                        <span class="text-danger">{{ $errors->first('birth_date') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">العنوان الحالى</p>
                                                    <input
                                                        class="form-control {{ $errors->has('current_address') ? 'is-invalid' : '' }}"
                                                        type="text" name="current_address"
                                                        value="{{ $user->current_address }}" required>
                                                    @if ($errors->has('current_address'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('current_address') }}</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">العنوان الثابت</p>
                                                    <input
                                                        class="form-control {{ $errors->has('fixed_address') ? 'is-invalid' : '' }}"
                                                        type="text" name="fixed_address"
                                                        value="{{ $user->fixed_address }}" required>
                                                    @if ($errors->has('fixed_address'))
                                                        <span
                                                            class="text-danger">{{ $errors->first('fixed_address') }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">المدينه</p>
                                                    <input
                                                        class="form-control {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                        type="text" name="city" value="{{ $user->city }}" required>
                                                    @if ($errors->has('city'))
                                                        <span class="text-danger">{{ $errors->first('city') }}</span>
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

                    <div class="tab-pane" id="timeline">
                        <div class="col-xl-12 col-md-12">
                            <div class="card user-card-full">
                                <div class="row m-l-0 m-r-0">
                                    <div class="col-sm-12">
                                        <div class="card-block">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">العمله الاساسيه</p>
                                                    <select name="currency_id"
                                                        class="form-control select2">
                                                        @foreach ($currencies as $currency)
                                                            <option value="{{ $currency->id }}"
                                                                {{ $currency->id == $user->currency_id ? ' selected' : '' }}>
                                                                {{ $currency->title }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-sm-6">
                                                    <p class="m-b-10 f-w-600">المناطق الزمنية</p>
                                                    <select name="time_zones" class="form-control select2">
                                                        <option value="-12:00"
                                                            {{ $user->time_zones == '-12:00' ? ' selected' : '' }}>(GMT
                                                            -12:00) Eniwetok, Kwajalein</option>
                                                        <option value="-11:00"
                                                            {{ $user->time_zones == '-11:00' ? ' selected' : '' }}>(GMT
                                                            -11:00) Midway Island, Samoa</option>
                                                        <option value="-10:00"
                                                            {{ $user->time_zones == '-10:00' ? ' selected' : '' }}>(GMT
                                                            -10:00) Hawaii</option>
                                                        <option value="-09:50"
                                                            {{ $user->time_zones == '-09:50' ? ' selected' : '' }}>(GMT -9:30)
                                                            Taiohae</option>
                                                        <option value="-09:00"
                                                            {{ $user->time_zones == '-09:00' ? ' selected' : '' }}>(GMT -9:00)
                                                            Alaska</option>
                                                        <option value="-08:00"
                                                            {{ $user->time_zones == '-08:00' ? ' selected' : '' }}>(GMT -8:00)
                                                            Pacific Time (US &amp; Canada)</option>
                                                        <option value="-07:00"
                                                            {{ $user->time_zones == '-07:00' ? ' selected' : '' }}>(GMT -7:00)
                                                            Mountain Time (US &amp; Canada)</option>
                                                        <option value="-06:00"
                                                            {{ $user->time_zones == '-06:00' ? ' selected' : '' }}>(GMT -6:00)
                                                            Central Time (US &amp; Canada), Mexico City</option>
                                                        <option value="-05:00"
                                                            {{ $user->time_zones == '-05:00' ? ' selected' : '' }}>(GMT -5:00)
                                                            Eastern Time (US &amp; Canada), Bogota, Lima</option>
                                                        <option value="-04:50"
                                                            {{ $user->time_zones == '-04:50' ? ' selected' : '' }}>(GMT -4:30)
                                                            Caracas</option>
                                                        <option value="-04:00"
                                                            {{ $user->time_zones == '-04:00' ? ' selected' : '' }}>(GMT -4:00)
                                                            Atlantic Time (Canada), Caracas, La Paz</option>
                                                        <option value="-03:50"
                                                            {{ $user->time_zones == '-03:50' ? ' selected' : '' }}>(GMT -3:30)
                                                            Newfoundland</option>
                                                        <option value="-03:00"
                                                            {{ $user->time_zones == '-03:00' ? ' selected' : '' }}>(GMT -3:00)
                                                            Brazil, Buenos Aires, Georgetown</option>
                                                        <option value="-02:00"
                                                            {{ $user->time_zones == '-02:00' ? ' selected' : '' }}>(GMT -2:00)
                                                            Mid-Atlantic</option>
                                                        <option value="-01:00"
                                                            {{ $user->time_zones == '-01:00' ? ' selected' : '' }}>(GMT -1:00)
                                                            Azores, Cape Verde Islands</option>
                                                        <option value="+00:00"
                                                            {{ $user->time_zones == '+00:00' ? ' selected' : '' }}>(GMT)
                                                            Western Europe Time, London, Lisbon, Casablanca</option>
                                                        <option value="+01:00"
                                                            {{ $user->time_zones == '+10:00' ? ' selected' : '' }}>(GMT +1:00)
                                                            Brussels, Copenhagen, Madrid, Paris</option>
                                                        <option value="+02:00"
                                                            {{ $user->time_zones == '+02:00' ? ' selected' : '' }}>(GMT +2:00)
                                                            Kaliningrad, South Africa</option>
                                                        <option value="+03:00"
                                                            {{ $user->time_zones == '+03:00' ? ' selected' : '' }}>(GMT +3:00)
                                                            Baghdad, Riyadh, Moscow, St. Petersburg</option>
                                                        <option value="+03:50"
                                                            {{ $user->time_zones == '+03:50' ? ' selected' : '' }}>(GMT +3:30)
                                                            Tehran</option>
                                                        <option value="+04:00"
                                                            {{ $user->time_zones == '+04:00' ? ' selected' : '' }}>(GMT +4:00)
                                                            Abu Dhabi, Muscat, Baku, Tbilisi</option>
                                                        <option value="+04:50"
                                                            {{ $user->time_zones == '+04:50' ? ' selected' : '' }}>(GMT +4:30)
                                                            Kabul</option>
                                                        <option value="+05:00"
                                                            {{ $user->time_zones == '+05:00' ? ' selected' : '' }}>(GMT +5:00)
                                                            Ekaterinburg, Islamabad, Karachi, Tashkent</option>
                                                        <option value="+05:50"
                                                            {{ $user->time_zones == '+05:50' ? ' selected' : '' }}>(GMT +5:30)
                                                            Bombay, Calcutta, Madras, New Delhi</option>
                                                        <option value="+05:75"
                                                            {{ $user->time_zones == '+05:75' ? ' selected' : '' }}>(GMT +5:45)
                                                            Kathmandu, Pokhara</option>
                                                        <option value="+06:00"
                                                            {{ $user->time_zones == '+06:00' ? ' selected' : '' }}>(GMT +6:00)
                                                            Almaty, Dhaka, Colombo</option>
                                                        <option value="+06:50"
                                                            {{ $user->time_zones == '+06:50' ? ' selected' : '' }}>(GMT +6:30)
                                                            Yangon, Mandalay</option>
                                                        <option value="+07:00"
                                                            {{ $user->time_zones == '+07:00' ? ' selected' : '' }}>(GMT +7:00)
                                                            Bangkok, Hanoi, Jakarta</option>
                                                        <option value="+08:00"
                                                            {{ $user->time_zones == '+08:00' ? ' selected' : '' }}>(GMT +8:00)
                                                            Beijing, Perth, Singapore, Hong Kong</option>
                                                        <option value="+08:75"
                                                            {{ $user->time_zones == '+08:75' ? ' selected' : '' }}>(GMT +8:45)
                                                            Eucla</option>
                                                        <option value="+09:00"
                                                            {{ $user->time_zones == '+09:00' ? ' selected' : '' }}>(GMT +9:00)
                                                            Tokyo, Seoul, Osaka, Sapporo, Yakutsk</option>
                                                        <option value="+09:50"
                                                            {{ $user->time_zones == '+09:50' ? ' selected' : '' }}>(GMT +9:30)
                                                            Adelaide, Darwin</option>
                                                        <option value="+10:00"
                                                            {{ $user->time_zones == '+10:00' ? ' selected' : '' }}>(GMT
                                                            +10:00) Eastern Australia, Guam, Vladivostok</option>
                                                        <option value="+10:50"
                                                            {{ $user->time_zones == '+10:50' ? ' selected' : '' }}>(GMT
                                                            +10:30) Lord Howe Island</option>
                                                        <option value="+11:00"
                                                            {{ $user->time_zones == '+11:00' ? ' selected' : '' }}>(GMT
                                                            +11:00) Magadan, Solomon Islands, New Caledonia</option>
                                                        <option value="+11:50"
                                                            {{ $user->time_zones == '+11:50' ? ' selected' : '' }}>(GMT
                                                            +11:30) Norfolk Island</option>
                                                        <option value="+12:00"
                                                            {{ $user->time_zones == '+12:00' ? ' selected' : '' }}>(GMT
                                                            +12:00) Auckland, Wellington, Fiji, Kamchatka</option>
                                                        <option value="+12:75"
                                                            {{ $user->time_zones == '+12:75' ? ' selected' : '' }}>(GMT
                                                            +12:45) Chatham Islands</option>
                                                        <option value="+13:00"
                                                            {{ $user->time_zones == '+13:00' ? ' selected' : '' }}>(GMT
                                                            +13:00) Apia, Nukualofa</option>
                                                        <option value="+14:00"
                                                            {{ $user->time_zones == '+14:00' ? ' selected' : '' }}>(GMT
                                                            +14:00) Line Islands, Tokelau</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <br>
                                            <p class="m-b-10 f-w-600">الاشعارات</p>
                                            <div class="row">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" @if ($user->send_receive == 'on') checked @endif
                                                        class="custom-control-input" id="customSwitch1"
                                                        name="send_receive">
                                                    <label class="custom-control-label" for="customSwitch1"
                                                        style="color: #232323;">أقوم بإرسال أو استقبال العملات
                                                        الرقمية</label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        @if ($user->receive_merchant == 'on') checked @endif
                                                        class="custom-control-input" id="customSwitch2"
                                                        name="receive_merchant">
                                                    <label class="custom-control-label" for="customSwitch2"
                                                        style="color: #232323;">أتلقى طلب التاجر</label>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox"
                                                        @if ($user->recommendations_account == 'on') checked @endif
                                                        class="custom-control-input" id="customSwitch3"
                                                        name="recommendations_account">
                                                    <label class="custom-control-label" for="customSwitch3"
                                                        style="color: #232323;">هناك توصيات لحسابي</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div> <!-- end tab-content -->
            </div> <!-- end card-box-->

           
           
        </div> <!-- end col -->
    </div>

    @if(Auth::user()->role_id == 1)
    @if (session()->has('message'))
    <div class="col-sm-12">
        <div class="alertPart">
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('message') }}
            </div>
        </div>
    </div>
@endif

    <div class="row">
        <div class="col-lg-12 col-xl-12">
            <div class="card-box">
        <ul class="nav nav-pills navtab-bg nav-justified">
            <li class="nav-item">
                <a href="#addbalance" data-toggle="tab" aria-expanded="true" class="nav-link active">
                    اضافه رصيد
                </a>
            </li>
            <li class="nav-item">
                <a href="#munbalance" data-toggle="tab" aria-expanded="false" class="nav-link">
                    سحب رصيد
                </a>
            </li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane show active" id="addbalance">
                <br><br>
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            
                            <div class="col-sm-12">
                                <div class="card-block">
                                    <form method="POST" action="{{ route('addbalance', ['admin', 'users', 'addbalance',$user->id]) }}"  enctype="multipart/form-data">
                                        @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> العمله</p>
                                            <select name="currency_id"  class="form-control select2">
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}"
                                                        {{ $currency->id == $user->currency_id ? ' selected' : '' }}>
                                                        {{ $currency->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> المبلغ</p>
                                            <input class="form-control {{ $errors->has('amount_sent') ? 'is-invalid' : '' }}" type="text" name="amount_sent" required>
                                            @if ($errors->has('amount_sent'))
                                                <span class="text-danger">{{ $errors->first('amount_sent') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-danger btn-rounded waves-effect waves-light" type="submit">
                                            تاكيد </button>
                                        </div>
                                    </div>
                                </form>

                                </div>
                            </div>
                      
                        </div>
                    </div>
                </div>

            </div> <!-- end tab-pane -->
            <!-- end about me section content -->

            <div class="tab-pane" id="munbalance">
                <br><br>
                <div class="col-xl-12 col-md-12">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-12">
                                <div class="card-block">
                                    <form method="POST" action="{{ route('munbalance', ['admin', 'users', 'munbalance',$user->id]) }}"  enctype="multipart/form-data">
                                        @csrf
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> العمله</p>
                                            <select name="currency_id"  class="form-control select2">
                                                @foreach ($currencies as $currency)
                                                    <option value="{{ $currency->id }}"
                                                        {{ $currency->id == $user->currency_id ? ' selected' : '' }}>
                                                        {{ $currency->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600"> المبلغ</p>
                                            <input class="form-control {{ $errors->has('amount_sent') ? 'is-invalid' : '' }}"
                                                type="text" name="amount_sent">
                                            @if ($errors->has('amount_sent'))
                                                <span class="text-danger">{{ $errors->first('amount_sent') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button class="btn btn-danger btn-rounded waves-effect waves-light" type="submit">
                                            تاكيد </button>
                                        </div>
                                    </div>
                                </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div> <!-- end tab-content -->
    </div> <!-- end card-box-->
       
           
</div> <!-- end col -->
</div>

    @endif

    <div class="row">
        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-success text-left">
                            <i class="fas fa-lira-sign font-22 avatar-title text-success"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-left">
                            <h3 class="mt-1"> <span data-plugin="counterup">{{ $lira }}</span></h3>
                            <p class="text-muted mb-1 text-truncate"> الليرة التركيه</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-warning">
                            <i class="fas fa-dollar-sign font-22 avatar-title text-warning"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-left">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $dollar }}</span></h3>
                            <p class="text-muted mb-1 text-truncate"> دولار امريكى</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

        <div class="col-md-6 col-xl-4">
            <div class="widget-rounded-circle card-box">
                <div class="row">
                    <div class="col-6">
                        <div class="avatar-lg rounded-circle bg-soft-danger">
                            <i class="fas fa-euro-sign font-22 avatar-title text-danger"></i>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-left">
                            <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $euro }}</span></h3>
                            <p class="text-muted mb-1 text-truncate"> اليورو</p>
                        </div>
                    </div>
                </div> <!-- end row-->
            </div> <!-- end widget-rounded-circle-->
        </div> <!-- end col-->

    </div>


    <h4 class="header-title mb-3" style="font-weight: bold;">المعاملات </h4>

    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="datatable-buttons" class="table table-borderless ">

                            <thead class="table-light">
                                <tr  style="color:#16DBAA">
                                    <th>الوصف</th>
                                    <th>رقم المعاملة</th>
                                    <th>نوع التحويل</th>
                                    <th>التاريخ</th>
                                    <th>المبلغ</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transfers as $transfer)
                                    <tr style="color: #232323;">
                                        <td>
                                            {{$transfer->notes}}
                                        </td>

                                        <td>
                                            {{$transfer->transaction_number}}# 
                                        </td>

                                        <td>
                                        
                                            {{$transfer->type}}
                                          
                                        </td>
                                        <td>
                                            {{$transfer->created_at->format('Y-m-d h:s A')}}
                                        </td>

                                        <td>
                                            @if($user->id != $transfer->created_by)
                                                <font color="#16DBAA">{{$transfer->amount_sent}} {{ App\Models\Receipt::currency($transfer->currency_id) }} </font>  
                                            @else
                                                <font color="#FE5C73">{{$transfer->amount_sent}} {{ App\Models\Receipt::currency($transfer->currency_id) }}</font> 
                                            @endif
                                        </td>

                                        <td>
                                            <button class="btn btn-rounded waves-effect waves-light"  style="border-color: #01414d !important;color: #01414D;" onclick="myFunction()"  id="btnPrint">طباعه </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
