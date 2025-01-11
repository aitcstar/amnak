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

                <h2 class="page-title">جميع الواردات</h2>
            </div>
        </div>
    </div>
   
    <div class="card" >
        <div class="card-body">
            <table class="table  nowrap w-100">
                <thead>
                    <tr style="color:#16DBAA">
                        <th>
                            رقم المعاملة
                        </th>
                        <th>
                            اسم المستلم
                         </th>
                         <th>
                           الرقم السري
                         </th>
                         <th>
                            التاريخ
                         </th>
                         <th>
                            المبلغ المرسل
                         </th>
                         <th>
                            المبلغ المستلم
                         </th>
                    </tr>
                </thead>
                <tbody>
                   
                    @if($imports->count() != 0)
                        @foreach ($imports as $import)
                            @if($import->user_id != $import->created_by)
                                <tr style="color: #232323;">
                                    <td>
                                        <a  href="#" data-toggle="modal" data-target="#danger-alert-modal{{ $import->id }}">
                                            <b>#{{ $import->transaction_number }}</b>
                                        </a>
                                    </td>
                                    <td>
                                        {{ $import->name }}
                                    </td>
                                    <td>
                                        {{ $import->pin_number }}
                                    </td>
                                    <td>
                                        {{ $import->created_at->format('Y-m-d') }}
                                    </td>
                                    <td>
                                        {{ $import->amount_sent }} {{ App\Models\Receipt::currency($import->currency_id) }}
                                    </td>
                                    <td>
                                        {{ $import->received_amount }} {{ App\Models\Receipt::currency($import->currency_id) }}
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    @else
                            <tr>
                                <td colspan="6" style="text-align: center;font-size: 18px;font-weight: bold;"><br><br>
                                    <i class="fas fa-file-import" style="font-size: 40px;"></i><br><br>
                                     لا توجد واردات حتى الان
                                    </td>
                            </tr>
                    @endif
                </tbody>
            </table>

            @foreach ($imports as $import)
            <!-- Danger Alert Modal -->
            
                <div id="danger-alert-modal{{ $import->id }}" class="modal fade" tabindex="-1" role="dialog"aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content modal-filled" >
                            @php 
                                if($import->created_at->format('A') == "PM")
                                {
                                    $t = 'م' ;
                                }else{
                                        $t = 'ص';
                                }

                                if($import->created_at->format('l') == "Saturday"){
                                    $day = "السبت";
                                }elseif($import->created_at->format('l') == "Sunday"){
                                    $day = "الاحد";
                                }elseif($import->created_at->format('l') == "Monday"){
                                    $day = "الاثنين";
                                }elseif($import->created_at->format('l') == "Tuesday"){
                                    $day = "الثلاثاء";
                                }elseif($import->created_at->format('l') == "Wednesday"){
                                    $day = "الاربعاء";
                                }elseif($import->created_at->format('l') == "Thursday"){
                                    $day = "الجميس";
                                }elseif($import->created_at->format('l') == "Friday"){
                                    $day = "الجمعه";
                                }
                            @endphp
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">نوع الحواله:  {{ $import->type }}
                                    <br>رقم  الحواله:  # {{ $import->transaction_number }}
                                    <br>جهه الاستلام:{{ $import->address }}
                                    <br>تاريخ الاستلام :{{ $import->created_at->format('h:s') . " " . $t }}  |   {{ $day }}   |    {{ $import->created_at->format('Y-m-d') }}
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
                                            <td>{{ $import->name }}</td>
                                            <td>{{ $import->phone }}</td>
                                            <td>{{ $import->pin_number }}</td>
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
                                            <td>{{ $import->amount_sent }}</td>
                                            <td>{{ App\Models\Receipt::currency($import->currency_id) }}</td>
                                            <td>{{ $import->received_amount }}</td>
                                            <td>{{ $import->wages }}</td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer" id="prn" >                                
                                <button class="btn btn-danger btn-rounded waves-effect waves-light"  onclick="myFunction({{$import->id}})"  id="btnPrint"><i class="fa fa-print"></i> طباعه </button>
                            </div>

                        
                        </div><!-- /.modal-content -->
                    </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
            @endforeach

        </div>


    </div>
@endsection



@section('script')

<script>

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
    <script src="{{ asset('assets/libs/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/pdfmake/pdfmake.min.js') }}"></script>

    <!-- Page js-->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endsection
