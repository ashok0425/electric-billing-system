<?php
use Krishnahimself\DateConverter\DateConverter;

 function __getNepaliDate($created_at,$Istoshow=0){
  if ($Istoshow==1) {
   return DateConverter::fromEnglishDate(\Carbon\Carbon::parse($created_at)->year,\Carbon\Carbon::parse($created_at)->month,\Carbon\Carbon::parse($created_at)->day)->toFormattedNepaliDate();

  }

  return $created_at;
}