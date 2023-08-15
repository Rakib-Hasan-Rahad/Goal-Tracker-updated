<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collaboration extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','collab_id','goal_id','send_status','status'];
    
}
