<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tim extends Model
{
    protected $table = 'tim';
    protected $primaryKey = 'id_tim';
    public $timestamps = false;
    protected $guarded = [];
}