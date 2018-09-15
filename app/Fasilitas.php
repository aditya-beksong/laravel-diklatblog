<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $fillable=['nama','kategorifasilitas_id','foto','slug'];
}
