@extends('layouts.vertical', ['title' => 'الرئيسية', 'mode' => 'rtl'])

@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/libs/selectize/selectize.min.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('assets/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/flatpickr/flatpickr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/libs/selectize/selectize.min.css')}}" rel="stylesheet" type="text/css" />

    <style>
        @media screen {
        #printSection {
            display: none;
        }
        }

        @media print {
        body * {
            visibility:hidden;
        }
        #printSection, #printSection * {
            visibility:visible;
        }
        #printSection {
            position:absolute;
            left:0;
            top:0;
        }
        }

        
.slider {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  width: 100%;
  height: 00px;
}

.wrapper {
  overflow: hidden;
  position: relative;
  width: 86%;
  height: $slider-height;
  z-index: 1;
  top: -74px;
}

.slides {
  display: flex;
  position: relative;
  top: -27px;
  left: 0;
  width: 10000px;
  height:200px
}

.slides.shifting {
  transition: left .2s ease-out;
}

.slide {
  width: $slider-width;
  height: $slider-height;
  cursor: pointer;
  display: flex;
  flex-direction: column;
  justify-content: center;
  transition: all 1s;
  position: relative;
  border-radius: 2px;
}

.slider.loaded {
  
}

.control {
  position: absolute;
  top: 50%;
  width: 50px;
  height: 50px;
  background: #fff;
  border-radius: 50px;
  margin-top: -20px;
  box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.3);
  z-index: 2;
}

.prev,
.next {
  background-size: 22px;
  background-position: center;
  background-repeat: no-repeat;
  cursor: pointer;
}

.prev {
  background-image: url(https://cdn0.iconfinder.com/data/icons/navigation-set-arrows-part-one/32/ChevronLeft-512.png);
  left: 20px;
}

.next {
  background-image: url(https://cdn0.iconfinder.com/data/icons/navigation-set-arrows-part-one/32/ChevronRight-512.png);
  right: 20px;
}

.prev:active,
.next:active {
  transform: scale(.8);
}

.dots i{display:inline-block; width:20px; height:20px;}

.dots i.active {background:white;}


    </style>
@endsection

<?php
       
        $days_count = DB::table('transfers')->select('date_order',DB::raw('count(date_order) as total'))->groupBy('date_order')->where('created_at', '>', now()->subDays(7)->endOfDay())->get();
        $listOfDrugs = [];
        $listOfTotal = [];
        foreach($days_count as $day_count){
                $listOfDrugs[] = $day_count->date_order;
                $listOfTotal[] = $day_count->total;
        }

        $users = DB::table('users')->where('role_id',0)->orderBy('id', 'DESC')->get();

       

$jsonfDrugs = json_encode($listOfDrugs,true);

$json = json_encode($listOfTotal,true);
        
//dd($jsonfDrugs);
?>


@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        @if(auth::user()->active == 0)
        <br><br><br><br><br><br><br>
        
            @if (Route::current()->getName() == 'home' || Route::current()->getName() == 'index')
            <div class="col-sm-12">
                <div class="alertPart">
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                         تم تعطيل الحساب يرجي التواصل مع الاداره
                    </div>
                </div>
            </div>
            @endif
        @else
                 <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

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
                            <div class="text-center">
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
                            <div class="text-center">
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
                            <div class="text-center">
                                <h3 class="text-dark mt-1"><span data-plugin="counterup">{{ $euro }}</span></h3>
                                <p class="text-muted mb-1 text-truncate"> اليورو</p>
                            </div>
                        </div>
                    </div> <!-- end row-->
                </div> <!-- end widget-rounded-circle-->
            </div> <!-- end col-->

        </div>
        <!-- end row-->


        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body pb-2">
                      
                        <h4 class="header-title mb-3" style="font-weight: bold;">التحويلات الأسبوعية</h4>

                        <div dir="ltr">
                            
                            <div id="sales-analytics" class="mt-4" data-colors="#1abc9c,#4a81d4"></div>
                                  

                        </div>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col-->

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body pb-2">
                        @if (session()->has('message'))
                        <div class="col-sm-12">
                            <div class="alertPart">
                                <div class="alert alert-danger alert-dismissible">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    {{ session('message') }}
                                </div>
                            </div>
                        </div>
                    @endif
                    <br><br>

                        <h4 class="header-title mb-3" style="font-weight: bold;">تحويل سريع</h4>
                        <form method="POST" action="{{ route('transfersspeed', ['admin', 'transfers', 'speed']) }}"  enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" id="ids" required>

                        <div dir="ltr">
                            <br><br><br><br><br><br><br>
                            <div id="slider" class="slider">
                                <div class="wrapper">
                                  <div id="slides" class="slides">
                                    @foreach ($users as $user)
                                        <div class="slide" style="padding: 0px 10px" id="{{$user->id}}">
                                            <img style="width: 50px;height:50px;border-radius: 70%;" src="{{url('profile/',$user->image)}}" onclick="showIt(this);" class="img-radius"><br>
                                            <font style="color:#718EBF"> {{$user->fullname}}</font>
                                        </div>
                                    @endforeach
                                  </div>
                                </div>
                                <a id="prev" class="control prev"></a>
                                <a id="next" class="control next"></a>
                                <div class="dots" style="display: none;">
                                </div>
                            </div>

                            <br><br><br>
                            <div class="row">
                                
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <button class="btn btn-danger btn-rounded waves-effect waves-light" type="submit" style=" margin: 6px 0 0 37px;z-index: 10;">
                                                إرسال
                                            </button>
                                        </div>
                                        <div class="col-sm-9">
                                            <input class="form-control  {{ $errors->has('amount_sent') ? 'is-invalid' : '' }}" type="number" name="amount_sent" min="1" value="{{ old('amount_sent', '') }}" style="direction: rtl;" required>
                                            @if ($errors->has('amount_sent'))
                                            <span class="text-danger">{{ $errors->first('amount_sent') }}</span>
                                            @endif
                                        </div>
                                        
                                    </div>
                                </div>
                                 <div class="col-sm-3">
                                    &nbsp;
                                    <p class="m-b-10 f-w-600" style="color:#718EBF ;margin: -6px 14px 0 0;">اكتب المبلغ</p>
                                </div>
                               
                            </div>


                        </div>
                        </form>
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col-->

          
        </div>

        <h4 class="header-title mb-3" style="font-weight: bold;">التحويلات الاخيره</h4>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-borderless ">

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
                                                <a  href="#" data-toggle="modal" data-target="#danger-alert-modal{{ $transfer->id }}">
                                                    <b>#{{ $transfer->transaction_number }}</b>
                                                </a>
                                            </td>

                                            <td>
                                                   {{ $transfer->type }}
                                              
                                            </td>
                                            <td>
                                                {{$transfer->created_at->format('Y-m-d h:s A')}}
                                            </td>

                                            <td>
                                                @if($transfer->user_id != $transfer->created_by)
                                                    <font color="#16DBAA">{{$transfer->amount_sent}} {{ App\Models\Receipt::currency($transfer->currency_id) }} </font>  
                                                @else
                                                    <font color="#FE5C73">{{$transfer->amount_sent}} {{ App\Models\Receipt::currency($transfer->currency_id) }}</font> 
                                                @endif
                                            </td>

                                            <td>
                                                <a style="border: 1px solid;" class="btn btn-rounded waves-effect waves-light"  href="#" data-toggle="modal" data-target="#danger-alert-modal{{ $transfer->id }}">
                                                    طباعه
                                                </a>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            @foreach ($transfers as $transfer)
                            <!-- Danger Alert Modal -->
                            
                                <div id="danger-alert-modal{{ $transfer->id }}" class="modal fade" tabindex="-1" role="dialog"aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content modal-filled" >
                                            @php 
                                                if($transfer->created_at->format('A') == "PM")
                                                {
                                                    $t = 'م' ;
                                                }else{
                                                        $t = 'ص';
                                                }
                
                                                if($transfer->created_at->format('l') == "Saturday"){
                                                    $day = "السبت";
                                                }elseif($transfer->created_at->format('l') == "Sunday"){
                                                    $day = "الاحد";
                                                }elseif($transfer->created_at->format('l') == "Monday"){
                                                    $day = "الاثنين";
                                                }elseif($transfer->created_at->format('l') == "Tuesday"){
                                                    $day = "الثلاثاء";
                                                }elseif($transfer->created_at->format('l') == "Wednesday"){
                                                    $day = "الاربعاء";
                                                }elseif($transfer->created_at->format('l') == "Thursday"){
                                                    $day = "الجميس";
                                                }elseif($transfer->created_at->format('l') == "Friday"){
                                                    $day = "الجمعه";
                                                }
                                            @endphp
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">نوع الحواله:  {{ $transfer->type }}
                                                    <br>رقم  الحواله:  # {{ $transfer->transaction_number }}
                                                    <br>جهه الاستلام:{{ $transfer->address }}
                                                    <br>تاريخ الاستلام :{{ $transfer->created_at->format('h:s') . " " . $t }}  |   {{ $day }}   |    {{ $transfer->created_at->format('Y-m-d') }}
                                                </h5>
                                                <img src="{{asset('assets/images/logo-dark.png')}}"alt="" height="80">
                                            </div>
                                            <div class="modal-body">
                                                <h4 class="modal-title">تفاصيل المستلم</h4>
                                                <br>
                                                <div class="form-group">
                                                    <table class="table" style="border: 1px solid #DFEAF2; border-radius: 1.6rem; position: inherit; display: table-cell; width: 800px;">
                                                        <thead>
                                                        <tr>
                                                            <th>اسم المستلم</th>
                                                            <th>رقم الجوال</th>
                                                            <th>الرقم السري</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td>{{ $transfer->name }}</td>
                                                            <td>{{ $transfer->phone }}</td>
                                                            <td>{{ $transfer->pin_number }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                
                                                <h4 class="modal-title"> تفاصيل الحواله</h4>
                                                <br>
                                                <div class="form-group">
                                                    <table class="table" style="border: 1px solid #DFEAF2; border-radius: 1.6rem; position: inherit; display: table-cell; width: 800px;">
                                                        <thead>
                                                        <tr>
                                                            <th>المبلغ المرسل</th>
                                                            <th>العمله</th>
                                                            <th>المبلغ المستلم</th>
                                                            <th>الاجور</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr>
                                                            <td> {{  str_replace('-', '', $transfer->amount_sent) }} </td>
                                                            <td>{{ App\Models\Receipt::currency($transfer->currency_id) }}</td>
                                                            <td>{{  str_replace('-', '', $transfer->received_amount) }}</td>
                                                            <td>{{ $transfer->wages }}</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="modal-footer" id="prn" >                                
                                                <button class="btn btn-danger btn-rounded waves-effect waves-light"  onclick="myFunction({{$transfer->id}})"  id="btnPrint"><i class="fa fa-print"></i> طباعه </button>
                                            </div>
                
                                        
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            @endforeach


                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div>

        @endif
       
    </div>
    <!-- end row -->

    </div> <!-- container -->
@endsection

@section('script')
<script>
  
  function showIt(element) {
  var parent = element.parentNode;
  //alert(parent.id);
  var content = parent.querySelector("div");
  //alert(content.id);
  document.getElementById('ids').value = parent.id;
  
}


  $(function(){
         
    var slider = document.getElementById('slider'),
    sliderItems = document.getElementById('slides'),
    prev = document.getElementById('prev'),
    next = document.getElementById('next'),
    dot = document.querySelector('.dots');

function slide(wrapper, items, prev, next) {
  var posX1 = 0,
      posX2 = 0,
      posInitial,
      posFinal,
      threshold = 100,
      slides = items.getElementsByClassName('slide'),
      slidesLength = slides.length,
      slideSize = items.getElementsByClassName('slide')[0].offsetWidth,
      index = 0,
      allowShift = true;
  
  wrapper.classList.add('loaded');
  
  for (var j = 0; j < slidesLength; j++) {
      var dotItem = document.createElement('i');
      dotItem.dataset.id = j ;
      dot.appendChild(dotItem);
  }
  
  document.querySelector('.dots i:first-child').classList.add('active');

  
  function appendAfter(n, original, appendTo) {
      for(var i = 0; i < n; i++) {
          var clone = original[i].cloneNode(true);
          appendTo.appendChild(clone);
      }
  }
  appendAfter(4, slides, items);
  
  items.insertBefore(slides[slidesLength - 1].cloneNode(true), slides[0]);
  
  // Mouse events
//   items.onmousedown = dragStart;
  
//   // Touch events
//   items.addEventListener('touchstart', dragStart);
//   items.addEventListener('touchend', dragEnd);
//   items.addEventListener('touchmove', dragAction);
  
  // Click events
  prev.addEventListener('click', function () { shiftSlide(-1) });
  next.addEventListener('click', function () { shiftSlide(1) });
  
  // Transition events
  items.addEventListener('transitionend', checkIndex);
  
  function dragStart (e) {
    e = e || window.event;
    e.preventDefault();
    posInitial = items.offsetLeft;
    
    if (e.type == 'touchstart') {
      posX1 = e.touches[0].clientX;
    } else {
      posX1 = e.clientX;
      document.onmouseup = dragEnd;
      document.onmousemove = dragAction;
    }
  }

  function dragAction (e) {
    e = e || window.event;
    
    if (e.type == 'touchmove') {
      posX2 = posX1 - e.touches[0].clientX;
      posX1 = e.touches[0].clientX;
    } else {
      posX2 = posX1 - e.clientX;
      posX1 = e.clientX;
    }
    items.style.left = (items.offsetLeft - posX2) + "px";
  }
  
  function dragEnd (e) {
    posFinal = items.offsetLeft;
    if (posFinal - posInitial < -threshold) {
      shiftSlide(1, 'drag');
    } else if (posFinal - posInitial > threshold) {
      shiftSlide(-1, 'drag');
    } else {
      items.style.left = (posInitial) + "px";
    }

    document.onmouseup = null;
    document.onmousemove = null;
  }
  
  function shiftSlide(dir, action) {
    items.classList.add('shifting');
    
    if (allowShift) {
      if (!action) { posInitial = items.offsetLeft; }

      if (dir ==1) {
        items.style.left = (posInitial - slideSize) + "px";
        index++;      
      } else if (dir == -1) {
        items.style.left = (posInitial + slideSize) + "px";
        index--;      
      }
      
    };
    
    allowShift = false;
  }
    
  function checkIndex (){
    items.classList.remove('shifting');

    if (index == -1) {
      items.style.left = -(slidesLength * slideSize ) + "px";
      index = slidesLength - 1;
    }

    if (index == slidesLength) {
      items.style.left = -(1 * slideSize) + "px";
      index = 0;
    }
    deleteDots();
    dot.children[index].classList.add('active');
    allowShift = true;
  }
  
  dot.addEventListener('click', function(e){
    if(e.target.tagName.toLowerCase() !== 'i') return;
    checkDots(e);
  });
  function checkDots(e) {          
      items.classList.add('shifting');
      deleteDots();
      e.target.classList.add('active');
      items.style.left = -(1 * (slideSize * e.target.dataset.id)) + "px";
    index = e.target.dataset.id;
  }
  
  function deleteDots(e) {
    var dotElements = document.querySelectorAll('.dots i');
    for (var i = 0; i < dotElements.length; i++) {
      dotElements[i].classList.remove('active');
    }
  }
  
}

slide(slider, sliderItems, prev, next);


// Sales Analytics
//JSON.stringify($jsonfDrugs)

var myArrayDay="{{$jsonfDrugs }}";
    myArrayDay=myArrayDay.replace(/&quot;/gi,"\"");
    myArrayDay=myArrayDay.replace(/\[/gi,"");
    myArrayDay=myArrayDay.replace(/\]/gi,"");
    myArrayDay=myArrayDay.split(',');
console.log(myArrayDay);

var myArrayDaycount="{{$json }}";
    myArrayDaycount=myArrayDaycount.replace(/&quot;/gi,"\"");
    myArrayDaycount=myArrayDaycount.replace(/\[/gi,"");
    myArrayDaycount=myArrayDaycount.replace(/\]/gi,"");
    myArrayDaycount=myArrayDaycount.split(',');

console.log(myArrayDaycount);


var colors = ['#1abc9c', '#4a81d4'];
var dataColors = $("#sales-analytics").data('colors');
if (dataColors) {
    colors = dataColors.split(",");
}

var options = {
    series: [{
        name: '',
        type: 'area',
        data: myArrayDaycount
    }],
    chart: {
        height: 278,
        type: 'line',
    },
    stroke: {
        width: [2, 3]
    },
    plotOptions: {
        bar: {
            columnWidth: '50%'
        }
    },
    colors: colors,
    dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
    },//2023-05-02
    labels: myArrayDay,
    xaxis: {
        type: 'date'
    },
    legend: {
        offsetY: 7,
    },
    grid: {
        padding: {
            bottom: 20
        }
    },
    fill: {
        type: 'gradient',
        gradient: {
            shade: 'light',
            type: "horizontal",
            shadeIntensity: 0.25,
            gradientToColors: undefined,
            inverseColors: true,
            opacityFrom: 0.75,
            opacityTo: 0.75,
            stops: [0, 0, 0]
        },
    },
    yaxis: [{
        title: {
            text: '',
        },

    }, {
        opposite: true,
        title: {
            text: ''
        }
    }]
};

var chart = new ApexCharts(document.querySelector("#sales-analytics"), options);
chart.render();

// Datepicker
$('#dash-daterange').flatpickr({
    altInput: true,
    mode: "range",
    altFormat: "F j, y",
    defaultDate: 'today'
});
    });



 function myFunction(id) {
        printElement(document.getElementById("danger-alert-modal"+id));
    }
    
    function printElement(elem) {
        var domClone = elem.cloneNode(true);
       
        var $printSection = document.getElementById("printSection");
         
        if (!$printSection) {
            var $printSection = document.createElement("div");
            $printSection.id = "printSection";
            document.body.appendChild($printSection);
        }
        $printSection.innerHTML = "";
        $printSection.appendChild(domClone);
        
        //document.getElementById("prn").style.display = "none";
        window.print();
    }
    
    </script>

     <!-- Plugins js-->
     <script src="{{asset('assets/libs/flatpickr/flatpickr.min.js')}}"></script>
     <script src="{{asset('assets/libs/apexcharts/apexcharts.min.js')}}"></script>
     <script src="{{asset('assets/libs/selectize/selectize.min.js')}}"></script>


    <!-- Plugins js-->
    <script src="{{ asset('assets/libs/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/libs/selectize/selectize.min.js') }}"></script>

    <!-- Dashboar 1 init js-->
    <script src="{{ asset('assets/js/pages/dashboard-2.init.js') }}"></script>
@endsection
