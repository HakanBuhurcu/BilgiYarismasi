<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oduller extends Model
{
    protected $table = 'oduller';
    protected $fillable =['OdulId','OdulIsmi','Derece','Aktiflik'];
    public $timestamps = false;
}