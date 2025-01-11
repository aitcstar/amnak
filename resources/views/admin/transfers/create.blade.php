@extends('layouts.vertical', ['title' => ' حوالات جديده', 'mode' => 'rtl'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/summernote/summernote.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

  
@endsection
@section('content')

<br><br>

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
    <br><br>
    <div class="container-fluid">


        <div class="row">
         
            <div class="col-lg-12 col-xl-12">
                <div class="card-box">
                    <h4 class="page-title"> حوالات جديده</h4>
                    <form method="POST" action="{{ route('transfersStore', ['admin', 'transfers', 'store']) }}"  enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="created_by" value="{{Auth::user()->id}}">
                        <div class="tab-content">
                            <div class="tab-pane show active" id="aboutme">
                                <br><br>
                                            <div class="col-xl-12 col-md-12">
                                                <div class="card user-card-full">
                                                    <div class="row m-l-0 m-r-0">
                                                      
                                                        <div class="col-sm-12">
                                                            <div class="card-block">
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">إسم المستفيد </p>
                                                                        <input class="form-control {{ $errors->has('first') ? 'is-invalid' : '' }}" type="text" name="name" value="{{ old('first', '') }}" placeholder="إسم المستفيد" required>
                                                                        @if ($errors->has('first'))
                                                                        <span class="text-danger">{{ $errors->first('first') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600"> جوال المستفيد</p>
                                                                        <input class="form-control {{ $errors->has('second') ? 'is-invalid' : '' }}" type="text" name="phone" value="{{ old('second', '') }}"  placeholder="جوال المستفيد">
                                                                        @if ($errors->has('second'))
                                                                        <span class="text-danger">{{ $errors->first('second') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <br>
                                                            
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600"> الجهه</p>
                                                                        <select name="user_id" id="userId" class="form-control select2" >
                                                                            <option value="" disabled selected>اختار</option>
                                                                            @foreach ($users as $user )
                                                                                <option value="{{ $user->id}}">{{ $user->name}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600"> عنوان الجهه</p>
                                                                        <select name="address" id="address" class="form-control select2" disabled>
                                                                            <option value="" disabled selected>اختار</option>
                                                                           
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">العمله المرسله</p>
                                                                        <select name="currency_id" id="currency" class="form-control select2">
                                                                            <option value="" disabled selected>اختار</option>
                                                                            @foreach ($currencies as $currency )
                                                                                <option value="{{ $currency->id}}">{{ $currency->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600"> المبلغ المرسل</p>
                                                                        <input class="form-control  {{ $errors->has('amount_sent') ? 'is-invalid' : '' }}" type="text" id="amount_sent" name="amount_sent" min="1" value="{{ old('amount_sent', '') }}" placeholder="المبلغ المرسل" required>
                                                                        @if ($errors->has('amount_sent'))
                                                                        <span class="text-danger">{{ $errors->first('amount_sent') }}</span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">العمله المستلمه</p>
                                                                        <select name="received_currency_id" id="received_currency" class="form-control select2">
                                                                            <option value="" disabled selected>اختار</option>
                                                                            @foreach ($currencies as $currency )
                                                                                <option value="{{ $currency->id}}">{{ $currency->title}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600"> المبلغ المستلم </p>
                                                                        <input class="form-control  {{ $errors->has('received_amount') ? 'is-invalid' : '' }}" type="number" id="received_amount" name="received_amount" min="1" value="{{ old('received_amount', '') }}" placeholder="المبلغ المستلم " readonly>
                                                                        @if ($errors->has('received_amount'))
                                                                        <span class="text-danger">{{ $errors->first('received_amount') }}</span>
                                                                        @endif
                                                                    </div>
                                                                   
                                                                </div>

                                                                <div class="row">
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">الاجور </p>
                                                                        <input class="form-control  {{ $errors->has('wages') ? 'is-invalid' : '' }}" type="number" name="wages" id="wages" min="1" value="{{ old('wages', '') }}" placeholder="الاجور "  readonly>
                                                                        @if ($errors->has('wages'))
                                                                        <span class="text-danger">{{ $errors->first('wages') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <p class="m-b-10 f-w-600">الملاحظه </p>
                                                                        <textarea class="form-control" rows="5" name="notes" placeholder="اكتب ملاحظتك"></textarea>
                                                                        @if($errors->has('notes'))
                                                                            <span class="text-danger">{{ $errors->first('notes') }}</span>
                                                                        @endif
                                                                    </div>
                                                                    
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                       
                            </div> <!-- end tab-pane -->
                           
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
<script>
    $('#userId').on('change', function() {
       
        userId = $(this).val();
        //alert(userId);
        let url = 'http://127.0.0.1:8000/getaddress/' + userId;
                $.ajax({
                 type: "GET",
                 url: url,
                 success: function(data) {
                    console.log(data) ;
                    $("#address").html('');
                    $("#address").append('<option value="'+ data.current_address + '"> ' + data.current_address  +' </option>' +
                                        '<option value="'+ data.fixed_address + '"> ' + data.fixed_address  +' </option>'
                    );
                 }
             });
    });

    $('#received_currency').on('change', function() {
       
        currency = document.getElementById("currency").value;
        amount_sent = document.getElementById("amount_sent").value;
        received_currency = $(this).val();
        userId = document.getElementById("userId").value;

      // alert(userId);
       if( currency === received_currency){
            document.getElementById("received_amount").value = amount_sent;
       }else{
        let url = 'http://127.0.0.1:8000/getrate/' + currency + '/' + amount_sent + '/' + received_currency;
               $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                   console.log(data) ;
                   $("#received_amount").html('');
                   document.getElementById("received_amount").value = (data *  amount_sent).toFixed(2);
                }
            });
       }
       
       let url = 'http://127.0.0.1:8000/getratetransfer/' + userId;
               $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                   console.log(data) ;
                   $("#wages").html('');
                   vw = (data *  amount_sent) / 100;
                   document.getElementById("wages").value = vw.toFixed(2);
                }
            });

      // document.getElementById("wages").value = 
       
   });


   $('#amount_sent').on('keyup', function() {
       
       currency = document.getElementById("currency").value;
       amount_sent = $(this).val();
       received_currency = document.getElementById("received_currency").value;
       userId = document.getElementById("userId").value;

       //alert(userId);
      if( currency === received_currency){
            document.getElementById("received_amount").value = amount_sent;
       }else{
        let url = 'http://127.0.0.1:8000/getrate/' + currency + '/' + amount_sent + '/' + received_currency;
               $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                   console.log(data) ;
                   $("#received_amount").html('');
                   document.getElementById("received_amount").value = (data *  amount_sent).toFixed(2);;
                }
            });
       }

       let url = 'http://127.0.0.1:8000/getratetransfer/' + userId;
               $.ajax({
                type: "GET",
                url: url,
                success: function(data) {
                   console.log(data) ;
                   $("#wages").html('');
                   vw = (data *  amount_sent) / 100;
                   document.getElementById("wages").value = vw.toFixed(2);
                }
            });
  });


   
    
        /*$("#userId").select2({ placeholder: "الجهه" });  
        $("#address").select2({ placeholder: "عنوان الجهه" });  
        $("#currency").select2({ placeholder: ">العمله المرسله" });  */
</script>
    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ asset('assets/libs/summernote/summernote.min.js') }}"></script>

    <script src="{{ asset('assets/libs/dropzone/dropzone.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>
    <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>
@endsection
