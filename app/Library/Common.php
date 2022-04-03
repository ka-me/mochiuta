<?php

namespace App\Library;

use App\Artist;


class Common
{
    public static function getHomeData($user, $request)
    {
        $tabs = [];
        $tabs['my_song_count'] = $user->getMySongCount();
        
        $my_artist_ids = $user->getMyArtistIds();
        $my_song_ids = $user->getMySongIds();
        $tabs['my_artists'] = Artist::getMyArtistsWithCount($my_artist_ids, $my_song_ids);
        
        $query = $user->songs();
        
        if($request->display === 'artist') {
            $query->where('artist_id', $request->id);
        }
        
        $my_songs = $query->orderBy('added_at', 'desc')->get();
        
        return compact('tabs', 'my_songs');
    }
    
    
    public static function keywordTrim($keyword)
    {
        return trim(mb_convert_kana($keyword, 's'));
    }
    
    
    public static function searchByName($query, $keyword)
    {
        $words = str_replace(['%', '_'], ['\%', '\_'], $keyword);
        $words = explode(' ', $words);
        $search_words = array_diff($words, ['']);

        foreach($search_words as $search_word) {
            $query->where('name', 'like', '%' . $search_word . '%');
        }

        return $query->orderBy('name');
    }
}