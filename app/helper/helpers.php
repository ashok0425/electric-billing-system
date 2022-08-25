<?php
use Krishnahimself\DateConverter\DateConverter;

 function __getNepaliDate($created_at,$Istoshow=0){
  if ($Istoshow==1) {
   return DateConverter::fromEnglishDate(\Carbon\Carbon::parse($created_at)->year,\Carbon\Carbon::parse($created_at)->month,\Carbon\Carbon::parse($created_at)->day)->toFormattedNepaliDate();

  }

  return $created_at;
}

function __fine($from,$to,$price){
  $from=\Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$from);
  $to=\Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$to);
$diff_in_day=$to->diffInDays($from);
$fine=0;
if($diff_in_day<=15){
return $fine=0;
}

if($diff_in_day<=30){
  $per=($price*10)/100;
  return $fine=$per;
  }

  if($diff_in_day<=150){
    $per2=($price*50)/100;
  return  $fine=$per2;
    }

    if($diff_in_day>150){
      return  $fine=$price;
    }

}




function __dueDate($from,$to){
  $from=\Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$from);
  $to=\Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$to);
return $diff_in_day=$to->diffInDays($from).' Days';

}

function __getNepaliYear($year){
   return DateConverter::fromEnglishDate(\Carbon\Carbon::parse($year)->year,1,1)->toFormattedNepaliDate();

}


function __sendSms($to,$msg){
  $args = http_build_query(array(
    'auth_token'=> 'a4e1eb2027e5edb5e043d574db2af91cc340879d8aa6295855f3fe2879f19f7b',
    'to'    => "$to",
    'text'  => "$msg"));
$url = "https://sms.aakashsms.com/sms/v3/send/";

# Make the call using API.
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1); ///
curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
// Response
$response = curl_exec($ch);
curl_close($ch);   
return $response;
}