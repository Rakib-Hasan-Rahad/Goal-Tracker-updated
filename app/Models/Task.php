<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $fillable = ['title','description', 'goal_id','status','priority','level'];
    public function goal()
    {
        # code...
        return $this->belongsTo(Goal::class, 'goal_id','id');
    }
}
