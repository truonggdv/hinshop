<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = "items";
    protected $guarded=[];
    public function category(){
        return $this->hasOne(Category::class,'id','parent_id');
    }
}
