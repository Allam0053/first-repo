<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class komentar extends Model
{
    protected $table = 'komentar';
    protected $fillable = ['konten','user_id','forum_id','parent',];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function forum(){
    	return $this->belongsTo(forum::class);
    }

    public function komentar()
	{
	    return $this->hasMany(komentar::class)->whereNull('parent');
	}

	public function child()
    {
        return $this->hasMany(komentar::class, 'parent');
    }
}
