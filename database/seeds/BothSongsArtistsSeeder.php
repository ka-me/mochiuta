<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class BothSongsArtistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //アクセス準備
        $session = new SpotifyWebAPI\Session(
            config('services.spotify.client_id'),
            config('services.spotify.client_secret'),
        );
        
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        
        $options = [
            'curl_options' => [
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $accessToken,
                    'Accept-Language: ja'
                ],
            ],
        ];
        
        $request = new SpotifyWebAPI\Request($options);
        
        $api = new SpotifyWebAPI\SpotifyWebAPI([], null, $request);
        $api->setAccessToken($accessToken);
        
        
        //アーティスト取得
        $artists = [];
        
        for($i = 0; $i < 8; $i ++) {
            $results = $api->search('genre:j-pop', 'artist', ['market' => 'JP', 'limit' => 50, 'offset' => $i * 50]);
            
            foreach($results->artists->items as $result) {
                $artists[$result->id] = $result;
            }
        }
        
        for($i = 0; $i < 2; $i ++) {
            $results = $api->search('genre:anime', 'artist', ['market' => 'JP', 'limit' => 50, 'offset' => $i * 50]);
        
            foreach($results->artists->items as $result) {
                $artists[$result->id] = $result;
            }
        }
        
        
        //各アーティストのトップトラックを取得
        //1アーティストの曲    - 曲とアーティストをDBに保存
        //複数アーティストの曲 - まとめる
        $artist_id = 1;
        $multiple_artist_tracks = [];
        
        foreach($artists as $artist) {
            $tracks = $api->getArtistTopTracks($artist->id, ['country' => 'JP']);
            $added_tracks = [];
            
            foreach($tracks->tracks as $track) {
                
                if(count($track->artists) === 1) {
                
                    if(! in_array($track->name, $added_tracks)) {
                        DB::table('songs')->insert([
                            'artist_id' => $artist_id,
                            'name' => $track->name,
                            'preview_url' => $track->preview_url,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        
                        $added_tracks[] = $track->name;
                    }
                    
                } else {
                    
                    $name = '';
                    
                    foreach($track->artists as $multiple_artist) {
                        $name .= $multiple_artist->name . ', ';
                    }
                    
                    $multiple_artist_name = substr($name, 0, -2); 
                    
                    if(mb_strlen($multiple_artist_name) > 255) {
                        $multiple_artist_name = $track->artists[0]->name;
                    }
                    
                    $multiple_artist_tracks[$multiple_artist_name][$track->id] = $track;
                }
            }
            
            if(! empty($added_tracks)) {
                DB::table('artists')->insert([
                    'name' => $artist->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                
                $artist_id ++;
            }
        }
        
        
        //複数アーティストの曲をDBに保存
        foreach($multiple_artist_tracks as $multiple_artist_name => $tracks) {
            
            foreach($tracks as $track) {
                DB::table('songs')->insert([
                    'artist_id' => $artist_id,
                    'name' => $track->name,
                    'preview_url' => $track->preview_url,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
            }
            
            DB::table('artists')->insert([
                'name' => $multiple_artist_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
            
            $artist_id ++;
        }
    }
}
