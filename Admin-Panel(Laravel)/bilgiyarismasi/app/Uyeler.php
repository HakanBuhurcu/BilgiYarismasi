<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Uyeler extends Model
{
    protected $table = 'uyeler';
    protected $fillable =['Id','Kullancad','Puan'];
    public $timestamps = false;
}