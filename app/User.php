<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'message',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    
    public function isAdmin()
    {
        return $this->role == 1;
    }
    
    
    /**
     * follows
     */
    public function following()
    {
        return $this->belongsToMany('App\User', 'follows', 'follower_id', 'followee_id')
                    ->withTimestamps();
    }
    
    
    public function followers()
    {
        return $this->belongsToMany('App\User', 'follows', 'followee_id', 'follower_id')
                    ->withTimestamps();
    }
    
    
    public function isFollowing($user_id)
    {
        return $this->following()->where('followee_id', $user_id)->exists();
    }
    
    
    public function isBeingFollowed($user_id)
    {
        return $this->followers()->where('follower_id', $user_id)->exists();
    }
    
    
    public function getFolloweeIds()
    {
        return $this->following()->pluck('followee_id')->toArray();
    }
    
    
    public function getFollowerIds()
    {
        return $this->followers()->pluck('follower_id')->toArray();
    }
    
    
    public function getFolloweeCount()
    {
        return $this->following()->count();
    }
    
    
    public function getFollowerCount()
    {
        return $this->followers()->count();
    }
    
    
    public function getFollowListUsers()
    {
        return $this->following()
                    ->with('songs')
                    ->orderBy('follows.created_at', 'desc')
                    ->get();
    }
    
    
    public function getFollowerListUsers()
    {
        return $this->followers()
                    ->with('songs')
                    ->orderBy('follows.created_at', 'desc')
                    ->get();
    }
    
    
    /**
     * songs
     */
    public function songs()
    {
        return $this->belongsToMany('App\Song', 'user_songs')
                    ->withPivot('created_at AS added_at')
                    ->withTimestamps();
    }
    
    
    public function hasSelectSong($song_id)
    {
        return $this->songs->contains('id', $song_id);
    }
    
    
    public function getMySongIds($artist_id = null)
    {
        $query = $this->songs();
        if(isset($artist_id)) {
            $query->where('artist_id', $artist_id);
        }
        return $query->pluck('songs.id')->toArray();
    }
    
    
    public function getMyArtistIds()
    {
        return $this->songs()->distinct()->pluck('artist_id')->toArray();
    }
    
    
    public function getMySongCount()
    {
        return $this->songs()->count();
    }
}
