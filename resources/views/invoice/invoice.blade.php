<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Payment Invoice</title>
        
        <!-- Start Common CSS -->
        <style type="text/css">
            #outlook a {padding:0;}
            body{width:100% !important; -webkit-text-size-adjust:100%; -ms-text-size-adjust:100%; margin:0; padding:0; font-family: Helvetica, arial, sans-serif;}
            .ExternalClass {width:100%;}
            .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div {line-height: 100%;}
            .backgroundTable {margin:0; padding:0; width:100% !important; line-height: 100% !important;}
            .main-temp table { border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; font-family: Helvetica, arial, sans-serif;}
            .main-temp table td {border-collapse: collapse;}
            @media print{
    .print{
        display: none!important;

    }
  }
        </style>
        <!-- End Common CSS -->
    </head>
    <body>
        <div class="print text-center" style="background: red;color:white;padding:5px 10px;border-radius:10px;width:150px;cursor:pointer;margin:auto" onclick="print()">
            print
          </div>
          <a href="{{route('admin.consume_units.create')}}" class="print text-center" style="background: rgb(0, 81, 255);color:white;padding:5px 10px;border-radius:10px;width:150px;cursor:pointer;margin:auto;display:flex;justify-content:center;">
            ⬅ Back
          </a>
        @php
        use App\Models\ConsumeUnit;
        use App\Models\User;

        // $id=$id;
            $cms=DB::table('cms')->first();
          
            $user=User::find($id);

              $reading=ConsumeUnit::whereIn('id',session()->get('consume_id'))->get();
                $fine=0;
                $price=0;
                   foreach($reading as $value){
                    $fine+=__fine($value->created_at,today(),$value->price);
                    $price+=$value->price;
        
                   }
                   @endphp
        <table width="100%" cellpadding="0" cellspacing="0" border="0" class="backgroundTable main-temp" style="background-color: #d5d5d5;">
            <tbody>
                <tr>
                    <td>
                        <table width="600" align="center" cellpadding="15" cellspacing="0" border="0" class="devicewidth" style="background-color: #ffffff;">
                            <tbody>
                                <!-- Start header Section -->
                                <tr>
                                    <td style="padding-top: 30px;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee; text-align: center;">
                                            <tbody>
                                                <tr>
                                                    <td style="padding-bottom: 10px;">
                                                        <a href="{{route('/')}}">{{$cms->company_name}}</a>
                                                    </td>
                                                </tr>
                                            
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                        {{$cms->address1}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666;">
                                                        Phone: {{$cms->phone1}} | Email: {{$cms->email1}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 25px;">
                                                        <strong>Invoice Date:</strong> {{__getNepaliDate(today(),1)}} 
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- End header Section -->
                                
                                <!-- Start address Section -->
                                <tr>
                                    <td style="padding-top: 0;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb;">
                                            <tbody>
                                                <tr>
                                                    <td style="width: 55%; font-size: 16px; font-weight: bold; color: #666666; padding-bottom: 5px;">
                                                        Consumer Details
                                                    </td>
                                                 
                                                </tr>
                                                <tr>
                                                  
                                                    <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                        {{$user->name}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                  
                                                    <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666;">
                                                     Meter No:{{$user->meter_id}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                 
                                                    <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                        Customer No:{{$user->costumer_id}}

                                                    </td>
                                                </tr>
                                                <tr>
                                                 
                                                    <td style="width: 45%; font-size: 14px; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                        Voucher No:{{$voucher_no}}

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- End address Section -->
                                
                                <!-- Start product Section -->
                                @foreach ($reading as $item)
                                <tr>
                                    <td style="padding-top: 0;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #eeeeee;">
                                            <tbody>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                         Date: {{__getNepaliDate($item->created_at,1)}}
                                                    </td>
                                                    <td style="width: 130px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; width: 440px;">
                                                        Last Reading: {{$item->last_meter_reading}}
                                                    </td>
                                                    <td style="width: 130px;"></td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575;">
                                                        Current Reading: {{$item->current_total_unit}}

                                                    </td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; text-align: right;">
                                                        @php
               $current_fine= __fine($item->created_at,today(),$item->price)
                                                        @endphp
                                                        Fine: {{$current_fine}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; padding-bottom: 10px;">
                                                       Consume  Unit: {{$item->unit}}
                                                    </td>
                                                    <td style="font-size: 14px; line-height: 18px; color: #757575; text-align: right; padding-bottom: 10px;">
                                                        <b style="color: #666666;">Total:{{$item->price}}</b> 
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                @endforeach
                                
                               
                                <!-- End product Section -->
                                
                                <!-- Start calculation Section -->
                                <tr>
                                    <td style="padding-top: 0;">
                                        <table width="560" align="center" cellpadding="0" cellspacing="0" border="0" class="devicewidthinner" style="border-bottom: 1px solid #bbbbbb; margin-top: -5px;">
                                            <tbody>
                                            
                                                <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px;">
                                                        Sub Total
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-top: 10px; text-align: right;">
                                                       Rs {{$price}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;">
                                                        Total Fine:
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;">
                                                      Rs {{$fine}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666;">
                                                       Total Amount
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right;">
                                                      Rs {{$fine+$price}}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; padding-bottom: 10px;">
                                                       Payment Type
                                                    </td>
                                                    <td style="font-size: 14px; font-weight: bold; line-height: 18px; color: #666666; text-align: right; padding-bottom: 10px;">
                                                      Cash
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <!-- End calculation Section -->
                                <div class="row">
                                    <td>
                                        <br>
                                        <br>
                                        <br>
                                        <br>
                                    </td>
                                </div>
                               
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
           

    </body>
</html>