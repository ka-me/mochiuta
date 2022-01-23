<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['name'];
    
    public static $rules = [
        'artist_id' => 'required',
        'name' => 'required',
    ];
    
    public function artist()
    {
        return $this->belongsTo('App\Artist');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'user_songs');
    }
    
}
