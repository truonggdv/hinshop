<?php

namespace App\Imports;

use App\Models\Translate;
use App\Models\LanguageNation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class TranslateImport implements ToModel, WithChunkReading, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    public function headingRow() : int
    {
        return 1;
    }

    public function model(array $row)
    {
        $lang = session()->get('locale');
        $language = LanguageNation::where('locale',$lang)->get();

        foreach ($language as $item){
            $id_key = $item->id;
        }
//        dd($id_key);
       return new Translate([
            'language_key_id' => $row['language_key_id'] ?? $row['key_id'],
            'language_nation_id' => $id_key,
            'title' => $row['title'] ?? $row['ban_dich'],
        ]);
//        dd($data);
     }

     public function chunkSize(): int
    {
        return 1000;
    }
}
