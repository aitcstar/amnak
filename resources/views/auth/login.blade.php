<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.shared.title-meta', ['title' => "Log In"])

        @include('layouts.shared.head-css')
        <link href='https://fonts.googleapis.com/css?family=Cairo' rel='stylesheet'>

    </head>

    <body class="auth-fluid-pages pb-0" style="direction: rtl;">

        <div class="auth-fluid">
            <!--Auth fluid left content -->
            <div class="auth-fluid-form-box">
                <div class="align-items-center h-100">
                    <div class="p-3">

                        <!-- Logo -->
                        <div class="text-center w-75">
                            <div class="auth-logo">
                                <a href="{{route('index')}}" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="100"
                                    </span>
                                </a>
            
                                <a href="{{route('index')}}" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{asset('assets/images/logo-dark.png')}}" alt="" height="100"
                                    </span>
                                </a>
                            </div>
                        </div>

                        <!-- title-->
                        <!--<h4 class="mt-0" style="text-align: right;"> <b> شركة الصدارة للصرافه والتحويلات</b></h4><br>-->
                        <h4 class=" mb-4" style="text-align: right;"> <b>  سعداء بإنضمامك إلينا. </b></h4>

                        <!-- form -->
                        <form action="{{route('login')}}" method="POST" novalidate>
                            @csrf

                            <div class="form-group mb-3">
                                <input class="form-control  @if($errors->has('email')) is-invalid @endif" name="email" type="email" 
                                    id="emailaddress" required=""
                                    value="{{ old('email')}}"
                                    placeholder="البريد الإلكتروني" />

                                    @if($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                            </div>

                            <div class="form-group mb-3">
                                <div class="input-group input-group-merge @if($errors->has('password')) is-invalid @endif">
                                    <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" type="password" required=""
                                        id="password" placeholder="كلمة المرور" />
                                        <div class="input-group-append" data-password="false">
                                        <div class="input-group-text">
                                            <span class="password-eye"></span>
                                        </div>
                                    </div>
                                </div>
                                @if($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>

                            <!--<div class="form-group mb-3">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                    <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                </div>
                            </div>-->

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary btn-block" type="submit" style="font-size: 20px;height: 50px;">تسجيل الدخول</button>
                            </div>

                        </form>
                        <!-- end form-->

                       

                    </div> <!-- end .card-body -->
                </div> <!-- end .align-items-center.d-flex.h-100-->
            </div>
            <!-- end auth-fluid-form-box-->
        </div>
        <!-- end auth-fluid-->

        <!-- Authentication js -->
        <script src="assets/js/pages/authentication.init.js"></script>

    
</body>
   {{--
    <body class="authentication-bg authentication-bg-pattern">

        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg-pattern">

                            <div class="card-body p-4">
                                
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="{{route('index')}}" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('frontend/images/logo.png')}}" alt="" height="100"
                                            </span>
                                        </a>
                    
                                        <a href="{{route('index')}}" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('frontend/images/logo.png')}}" alt="" height="100"
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3"> .أدخل عنوان بريدك الإلكتروني وكلمة المرور للوصول إلى لوحة الإدارة</p>
                                </div>

                                <form action="{{route('login')}}" method="POST" novalidate>
                                    @csrf

                                    <div class="form-group mb-3">
                                        <label for="emailaddress">Email address</label>
                                        <input class="form-control  @if($errors->has('email')) is-invalid @endif" name="email" type="email" value="admin@admin.com"
                                            id="emailaddress" required=""
                                            value="{{ old('email')}}"
                                            placeholder="Enter your email" />

                                            @if($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password</label>
                                        <div class="input-group input-group-merge @if($errors->has('password')) is-invalid @endif">
                                            <input class="form-control @if($errors->has('password')) is-invalid @endif" name="password" type="password"  value="password" required=""
                                                id="password" placeholder="Enter your password" />
                                                <div class="input-group-append" data-password="false">
                                                <div class="input-group-text">
                                                    <span class="password-eye"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>

                                    <div class="form-group mb-3">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="checkbox-signin" checked>
                                            <label class="custom-control-label" for="checkbox-signin">Remember me</label>
                                        </div>
                                    </div>

                                    <div class="form-group mb-0 text-center">
                                        <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!--<div class="row mt-3">
                            <div class="col-12 text-center">
                                <p> <a href="{{route('second', ['auth', 'recoverpw-2'])}}" class="text-white-50 ml-1">Forgot your password?</a></p>
                                <p class="text-white-50">Don't have an account? <a href="{{route('register')}}" class="text-white ml-1"><b>Sign Up</b></a></p>
                            </div> 
                        </div>-->
                        <!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->


        <!--<footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> &copy; UBold theme by <a href="" class="text-white-50">Coderthemes</a> 
        </footer>-->

        @include('layouts.shared.footer-script')
        
    </body>
    --}} 
</html>