<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $charactersNum = 1;
        $requests = 1;

        while ($charactersNum <= 50) {

            $url = 'https://www.anapioficeandfire.com/api/characters/' . $requests;
            $dataArray = json_decode(file_get_contents($url), true);

            if ($dataArray['name'] != '') {

                DB::table('characters')->insert([
                    'url' => $dataArray['url'],
                    'name' => $dataArray['name'],
                    'gender' => $dataArray['gender'],
                    'culture' => $dataArray['culture'],
                    'born' => $dataArray['born'],
                    'died' => $dataArray['died'],
                    'titles' => json_encode($dataArray['titles']),
                    'aliases' => json_encode($dataArray['aliases']),
                    'father' => $dataArray['father'],
                    'mother' => $dataArray['mother'],
                    'spouse' => $dataArray['spouse'],
                    'allegiances' => json_encode($dataArray['allegiances']),
                    'books' => json_encode($dataArray['books']),
                    'povBooks' => json_encode($dataArray['povBooks']),
                    'tvSeries' => json_encode($dataArray['tvSeries']),
                    'playedBy' => json_encode($dataArray['playedBy']),
                ]);

                $requests++;
                $charactersNum++;

            } else {
                $requests++;
                continue;
            }
        }
    }
}
