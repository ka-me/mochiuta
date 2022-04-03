<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $fillable = ['name'];
    
    public static $rules = [
        'name' => 'required',
    ];
    
    
    public function songs()
    {
        return $this->hasMany('App\Song');
    }
    
    
    public static function getMyArtistsWithCount($my_artist_ids, $my_song_ids)
    {
        return Artist::whereIn('id', $my_artist_ids)
                    ->withCount(['songs' => function($q) use($my_song_ids) {
                        $q->whereIn('id', $my_song_ids);
                    }])
                    ->orderBy('name')
                    ->get();
    }
}
