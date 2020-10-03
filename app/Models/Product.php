<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $guarded=[];

    public function product(){
        return $this->hasOne(Category::class,'id','parent_id');
    }
}
