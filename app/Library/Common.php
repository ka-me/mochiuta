<?php

namespace App\Library;

use App\Artist;


class Common
{
    public static function getHomeData($user, $request)
    {
        $mysong_count = $user->songs()->count();
        
        $artist_ids = $user->getMyArtistIds();
        $song_ids = $user->getMySongIds();
        
        $myartists = Artist::whereIn('id', $artist_ids)->withCount(['songs' => function($q) use($song_ids) {
            $q->whereIn('id', $song_ids);
        }])->orderBy('name')->get();
        
        $display = $request->display;
        $id = $request->id;
        $query = $user->songs();
        
        switch($display) {
            case 'all':
                break;
            case 'artist':
                $query->where('artist_id', $id);
                break;
            default:
                $display = 'all';
        }
        
        $mysongs = $query->orderBy('added_at', 'desc')->get();
        
        return compact('user', 'mysong_count', 'myartists', 'display', 'id', 'mysongs');
    }
}