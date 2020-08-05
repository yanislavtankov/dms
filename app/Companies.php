<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Validator;

class Companies extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'desc',
    ];
}
