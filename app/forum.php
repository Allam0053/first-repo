<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Cviebrock\EloquentSluggable\Sluggable;


class forum extends Model
{
   
    protected $fillable = ['judul','slug','konten','user_id'];

    public function user(){
    	return $this->belongsTo(User::class);
    }
    public function komentar(){
    	return $this->hasMany(komentar::class);
    }
}
