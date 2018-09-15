<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    protected $fillable=['name','slug'];

    public function beritas()
    {
        return $this->hasMany('App\Berita');
    }
}
