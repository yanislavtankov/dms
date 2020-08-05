<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = [
        'company_id',
        'title',
        'description',
        'path',
    ];
}
