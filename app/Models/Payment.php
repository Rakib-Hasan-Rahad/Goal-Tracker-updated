<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title','transaction_id','amount','card'];
    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
