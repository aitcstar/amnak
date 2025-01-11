@extends('layouts.vertical', ['title' => 'جميع الواردات', 'mode' => 'rtl'])
@section('css')
    <!-- Plugins css -->
    <link href="{{ asset('assets/libs/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
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

        </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">

                <h2 class="page-title">فاتورة</h2>
            </div>
        </div>
    </div>
   
    <div class="card" id="widget"  dir='rtl' lang='ar'>
        <div class="card-body">
                <div id="danger-alert-modal">
                    <div  class="col-8" style="margin:0 auto;">
                        <div class="modal-content modal-filled" >
                            @php 
                                if($invoice->created_at->format('A') == "PM")
                                {
                                    $t = 'م' ;
                                }else{
                                        $t = 'ص';
                                }

                                if($invoice->created_at->format('l') == "Saturday"){
                                    $day = "السبت";
                                }elseif($invoice->created_at->format('l') == "Sunday"){
                                    $day = "الاحد";
                                }elseif($invoice->created_at->format('l') == "Monday"){
                                    $day = "الاثنين";
                                }elseif($invoice->created_at->format('l') == "Tuesday"){
                                    $day = "الثلاثاء";
                                }elseif($invoice->created_at->format('l') == "Wednesday"){
                                    $day = "الاربعاء";
                                }elseif($invoice->created_at->format('l') == "Thursday"){
                                    $day = "الجميس";
                                }elseif($invoice->created_at->format('l') == "Friday"){
                                    $day = "الجمعه";
                                }
                            @endphp   
                           <div class="modal-header" style="min-height: 30vh; flex-direction: row; background-size: cover; background-image: url('/assets/images/Vector 5.png')">
                                <img src="{{asset('assets/images/logo-dark.png')}}"alt="" height="100">  
                                <h2 class="modal-title" id="exampleModalLabel" style="color: #fff;">
                                    رقم الاشعار <br>
                                   <span style="color: #E2CC07;"> #{{ $invoice->transaction_number }}</span>
                                </h2>        
                            </div>
                           
                            <br>

                            <div class="modal-header">
                               <h4>
                                المصدر: {{ $invoice->user($invoice->created_by) }}<br><br>
                                الوجهه: {{ $invoice->user($invoice->user_id) }} | {{ $invoice->user($invoice->address) }}
                               </h4>

                                <h4 class="modal-title">
                                    التاريخ  : {{ $invoice->created_at->format('h:s') . " " . $t }}  |   {{ $day }}   |    {{ $invoice->created_at->format('Y-m-d') }}
                                </h4>        
                            </div>

                            <div class="modal-body" style="text-align: center;">
                           
                                <h3 class="modal-title" style="text-align: center;"> قيمه الحواله
                                    <br> <br>
                                <span style="background-color: #E2CC07;">{{ $invoice->amount_sent }} {{ App\Models\Receipt::currency($invoice->currency_id) }}</span>
                                </h3>
                                <br> <br>

                                <div class="form-group">
                                    <table class="table" style="border: 1px solid #DFEAF2; border-radius: 1.6rem; position: inherit; display: table-cell">
                                        <tr style="vertical-align: bottom; border-bottom: 1px solid #dee2e6;color: #444444">
                                            <th><h4>المستفيد</h4></th>
                                            <td style="background-color: #f7f7f7;"><h4>{{ $invoice->name }}</h4></td>
                                        </tr>
                                        <tr style="vertical-align: bottom; border-bottom: 1px solid #dee2e6;color: #444444">
                                            <th><h4>الجوال</h4></th>
                                            <td style="background-color: #f7f7f7;"><h4>{{ $invoice->phone }}</h4></td>
                                        </tr>
                                        <tr style="vertical-align: bottom; border-bottom: 1px solid #dee2e6;color: #444444">
                                            <th><h4>الرقم السري</h4></th>
                                            <td style="background-color: #f7f7f7;color: #444444"><p style="font-weight: bold;color:#01414D"><b><h4>{{ $invoice->pin_number }}</h4></b></td>
                                        </tr>
                                        <tr style="vertical-align: bottom; border-bottom: 1px solid #dee2e6;">
                                            <th> <h4>عنوان التسليم</h4></th>
                                            <td style="background-color: #f7f7f7;color: #444444"> <h4>{{ $invoice->address ?? 'لا يوجد'}}</h4></td>
                                        </tr>
                                    </table>
                                </div>
                                <br>
                              <div style="text-align: right;">
                                <h3>ملاحظه: </h3>
                                <h4>
                                يتم تسليم الحواله بيد المستلم حصرا بعد التأكد من الهويه الاصليه
                                </h4>
                              </div>
                            </div>

                           
                            <div class="modal-footer" id="prn" >                                
                                <button class="btn btn-danger btn-rounded waves-effect waves-light"  onclick="myFunction({{$invoice->id}})"  id="btnPrint"><i class="fa fa-print"></i> تحميل الاشعار </button>
                                <button class="btn btn-danger btn-rounded waves-effect waves-light"  onclick="myFunction({{$invoice->id}})"  id="btnPrint"><i class="fab fa-whatsapp fa-1x"></i> 
                                    مشاركه الاشعار </button>

                                    <!--<button id="download-button">Download as PDF</button>--->


                            </div>
                         
                           
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
        </div>

        <div id="img-out"></div>

    </div>
@endsection



@section('script')
<script
			src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"
			integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg=="
			crossorigin="anonymous"
			referrerpolicy="no-referrer"
		></script>
<script>

/*function generatePDF() {
				// Choose the element that your content will be rendered to.
				const element = document.getElementById('widget');
				// Choose the element and save the PDF for your user.
				html2pdf().from(element).save();
			}

            const button = document.getElementById('download-button');

            button.addEventListener('click', generatePDF);*/



    function myFunction(id) {
        printElement(document.getElementById("danger-alert-modal"));
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
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
