<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FnsLogin extends Model
{
    protected $fillable = ['user_id','username','password'];
}
