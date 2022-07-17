<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransferMeter extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'transfer_from','id');
    }

    
    public function users()
    {
        return $this->belongsTo(User::class,'transfer_to','id');
    }
}
