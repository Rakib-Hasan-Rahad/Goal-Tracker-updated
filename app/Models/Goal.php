<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{
    use HasFactory;
    protected $fillable = ['title','target_date','description','priority','task_amount','type','rate','feedback','comment','user_id'];
    public function user()
    {
        # code...
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
