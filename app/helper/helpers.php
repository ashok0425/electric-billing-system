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