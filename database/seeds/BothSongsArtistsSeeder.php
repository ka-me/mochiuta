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
        
        
        
        $artist_id = 0;
        
        for($i = 0; $i < 20; $i ++) {
            
            $artists = $api->search('genre:j-pop', 'artist', ['market' => 'JP', 'limit' => 50, 'offset' => $i * 50]);
            
            foreach($artists->artists->items as $artist) {
                DB::table('artists')->insert([
                    'name' => $artist->name,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ]);
                $artist_id ++;
                
                $tracks = $api->getArtistTopTracks($artist->id, ['market' => 'JP']);
                
                foreach($tracks->tracks as $track) {
                    if(count($track->artists) == 1) {
                        DB::table('songs')->insert([
                            'artist_id' => $artist_id,
                            'name' => $track->name,
                            'preview_url' => $track->preview_url,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                    }
                }
            }
        }
    }
}
