<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>invoice</title>

<style>
 small{
  font-size: 10px!important;
 }
#invoice-POS {
	box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
	padding: 2mm;
	margin: 0 auto;
	width: 44mm;
	background: #FFF;
}

.header{
    font-size: .5rem;
    display: flex;
    justify-content: space-between;
}

#invoice-POS ::moz-selection {
	background: #f31544;
	color: #FFF;
}


#invoice-POS #top, #invoice-POS #mid, #invoice-POS #bot {
    /* Targets all id with 'col-' */
	border-bottom: 1px solid #EEE;
    padding: .3rem 0;
}





#invoice-POS .tabletitle {
	font-size: .5em;
    display: flex;
    justify-content: space-between;
}

#invoice-POS .service {
	border-bottom: 1px solid #EEE;
}



.my-0{
  margin: 0!important;
}

.py-0{
  padding: 0!important;
}
.py-1{
  padding: 4px 0!important;
}
*,p,.itemtext{
    font-family: Arial, Helvetica, sans-serif!important;
    color: #000!important;
  }
  .text-center{
    text-align: center!important;
  }
  @media print{
    .print{
      display: none;
    }
  }
</style>
</head>
<body>
    
@php
    $cms=DB::table('cms')->first();
@endphp

<div class="print text-center" style="background: red;color:white;padding:5px 10px;border-radius:10px;width:150px;cursor:pointer;margin:auto" onclick="print()">
  print
</div>

<div id="invoice-POS">
    <!--End InvoiceTop-->
    <div id="mid">
      <div class="info">
   <div class="header text-center" id="bot">
    <div class="header-text">
      <span  style="font-weight: 600!important">
        {{$cms->company_name}}
        </span>
<br>
{{$cms->address1}}
    </div>
   </div>
   <div class="header important" style="margin-top:5px;font-weight: 600!important;">
    
    <span style="border-bottom: 1px solid #EEE">
      Consumer Details
      <br>
    </span>
    </div>
   <div class="header" style="margin-top:5px;">
    <div class="header-text">Meter No</div>
    <div class="header-text">{{$current->user->meter_id}}</div>
   </div>    
   <div class="header">
    <div class="header-text">Name</div>
    <div class="header-text">{{$current->user->name}}</div>
   </div>

   <div class="header">
    <div class="header-text">Consumer Number</div>
    <div class="header-text">{{$current->user->costumer_id}}</div>
   </div>
       
   <div class="header">
    <div class="header-text">Citizenship number</div>
    <div class="header-text">{{$current->user->detail->citizenship_no}}</div>
   </div>
        
      </div>
    </div>
    <!--End Invoice Mid-->
  
  
    <div id="bot">
      <div class="header text-center" style="margin-top:5px;font-weight: 600!important">
    <span style="border-bottom: 1px solid #EEE">
        Meter Reading Details
    </span>
        </div>
      <div id="table" style="margin-top:5px;">
        <div>
          <div class="tabletitle">
            <span class="item">
              Last  Reading
            </span>
            <span class="item">
                {{$current->last_meter_reading}}
              </span>
          </div>

          <div class="tabletitle">
            <span class="item">
              Current  Reading
            </span>
            <span class="item">
                {{$current->current_total_unit}}

              </span>
          </div>

          <div class="tabletitle">
            <span class="item">
               Consume unit
            </span>
            <span class="item">
                {{$current->unit}}

              </span>
          </div>
{{-- 
          <div class="tabletitle">
            <span class="item">
               Previous Due
            </span>
            <span class="item">
                @if ($price!=0)
                {{$price-$current->price}}
                    @else
                    0
                @endif

              </span>
          </div>
  
          <div class="tabletitle">
            <span class="item">
               Fine
            </span>
            <span class="item">
               {{number_format($fine,2)}}
              </span>
          </div> --}}

          <div class="tabletitle" style="border-top:1px solid #EEE;border-bottom:1px solid #EEE;padding:3px 0;margin-top:2px">
            <span class="item " style="font-weight: 600!important">
               Total  Amount
            </span>
            <span class="item" style="font-weight: 600!important">
              {{number_format($price+$fine,2)}}
              </span>
          </div>
  
        </div>
      </div>
      
      <br>
      <small>
        <span style="font-weight: 600!important;border-bottom:solid 1px #EEE">
          नियमहरु:
        </span>
        <br>
१. मिटर जाँच गर्न आउने कर्मचारीलाई जाँच गर्ने मौका तुरुन्त दिनूपर्नेछ ।
<br>

२. महशुलदाताले प्रत्येक महिनाको शुल्क १५ गते भित्र बुझाउनु पर्नेछ । 
<br>

३. मिटर रिडिङ्ग गरेको दिनदेखि १५ दिनसम्म कुनै जरिवना लाग्ने छैन्  ।
<br>

४. मिटर रिडिङ्ग गरेको १६ दिनदेखि ३० दिनसम्म थप १०% जरिवना लाग्ने छ ।
<br>

५. मिटर रिडिङ्ग गरेको ३० दिनदेखि ५ महिनासम्म थप ५०% जरिवना लाग्ने छ ।
<br>

६. मिटर रिडिङ्ग गरेको ५  महिनामाथी भएमा थप १००% जरिवना लाग्ने छ ।
<br>
<p style="font-weight:600;text-align:center!important">
  पानीको महशुल समयमा नै तिरौ आर्थिक भारबाट
  
  बचौं

</p>
      </small>
  
    </div>
    <!--End InvoiceBot-->
  </div>
  <!--End Invoice-->


</body>
</html>