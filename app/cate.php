<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cate extends Model
{
    protected $table = 'category';

    protected $fillable = [
        'cate', 'status'
    ];
}
