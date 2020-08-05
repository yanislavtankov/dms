<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Validator;

class Tags extends Model
{
    protected $fillable = [
        'company_id',
        'tag',
    ];
}
