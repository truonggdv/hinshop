<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translate extends Model
{
    protected $table = "language_mapping";
    protected $guarded=[];

    public function translate()
    {
        return $this->belongsTo(LanguageKey::class, 'language_key_id', 'id');
    }
}
