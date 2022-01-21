<?php

use Illuminate\Database\Seeder;

class ArtistsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = ['米津玄師', 'あいみょん', 'Official髭男dism', 'YOASOBI', 'LiSA'];
        
        foreach($artists as $artist) {
            DB::table('artists')->insert([
                'name' => $artist,
            ]);
        }
    }
}
