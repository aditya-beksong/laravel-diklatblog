<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $fillable=['kategori_id','user_id','judul','berita','foto','publish','slug'];

    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
