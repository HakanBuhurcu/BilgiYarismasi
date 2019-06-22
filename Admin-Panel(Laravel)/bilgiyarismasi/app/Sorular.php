<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sorular extends Model
{
    protected $table = 'sorular';
    protected $fillable =['Soruno','Soru','a','b','c','d','Cvp','Puan'];
}
