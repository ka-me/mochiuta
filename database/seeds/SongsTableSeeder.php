<?php

use Illuminate\Database\Seeder;

class SongsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $album = [
            '米津玄師' => ['Lemon', 'アイネクライネ', 'ピースサイン', '感電'],
            'あいみょん' => ['マリーゴールド', '裸の心', '君はロックを聴かない', '愛を伝えたいだとか'],
            'Official髭男dism' => ['Cry Baby', 'Pretender', '115万キロのフィルム', 'I LOVE...'],
            'YOASOBI' => ['夜に駆ける', '怪物', '群青', '三原色'],
            'LiSA' => ['炎', '紅蓮華', '明け星', 'Catch the Moment'],
        ];
        
        foreach($album as $artist => $songs) {
            
            $artist_id = DB::table('artists')->where('name', $artist)->value('id');
            
            foreach($songs as $song) {
                
                DB::table('songs')->insert([
                    'artist_id' => $artist_id,
                    'name' => $song,
                ]);
            }
        }
    }
}
